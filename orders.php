<?php
  //if users are not logged in, they cant order
  require "session.php";

  if (isset($_SESSION['user_id']) == false) {
    header("Location: login.php");
  }

 ?>
<?php

  //get connection
  //insert new order into orders table
  //alert saying that the order was submitted successfully

  require "utilities.php";

  //use current session id as the customer id in orders table
  $userid = $_SESSION['user_id'];
  $date = date("Y-m-d");


  $connection = getConnection();

  if (!$stmt = $connection->prepare(
    "INSERT INTO orders(itemId, itemPrice, userId, date)
    VALUES (?, ?, ?, ?)
  ")) {
    die ("Prepare error: " . $connection->error);
  }

  if (!$stmt->bind_param(
    "iiis",
    $_GET['id'],
    $_GET['price'],
    $userid,
    $date
  )) {
    die("Bind failed: " . $connection->error);
  }

  if (!$stmt->execute()) {
    die("Exec Failed: " . $connection->error);
  }

  //after order submitted, change quantity value of item in items table

  if (!$update = $connection->prepare(
    "UPDATE items SET quantity = quantity - 1 WHERE id = ? AND quantity > 0"
  )) {
    die("Prepare error: " . $connection->error);
  }

  if (!$update->bind_param(
    "i",
    $_GET['id']
  )) {
    die("Bind failed: " . $connection->error);
  }

  if (!$update->execute()) {
    die("Exec error: " . $connection->error);
  }


   echo "<script type='text/javascript'>alert('Order Successfully Submitted!');</script>";

 ?>

 <?php require "header.php" ?>
 <?php require "navbar.php" ?>
 <hr>
 <article id="indiv-item">
   <div id="left-side-item">
     <img id="item-img" src="<?php echo $_GET['img'] ?>" alt="item-img">
   </div>
   <div id="right-side-item">
     <h2 id="item-name">Order of item <?php echo $_GET['id'] ?> successfully submitted.</h2>
     <p id="item-desc">Total cost of order: $<?php echo $_GET['price'] ?></p>
   </div>
 </article>

 <?php require "footer.php" ?>
