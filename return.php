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


  $connection = getConnection();

  if (!$stmt = $connection->prepare(
    "UPDATE items SET quantity = quantity + 1 WHERE id = ?"
  )) {
    die ("Prepare error: " . $connection->error);
  }

  if (!$stmt->bind_param(
    "i",
    $_GET['itemId']
  )) {
    die("Bind failed: " . $connection->error);
  }

  if (!$stmt->execute()) {
    die("Exec Failed: " . $connection->error);
  }


  if (!$delete = $connection->prepare(
    "DELETE FROM orders WHERE orderId = ?"
  )) {
    die ("Prepare error: " . $connection->error);
  }

  if (!$delete->bind_param(
    "i",
    $_GET['orderId']
  )) {
    die("Bind failed: " . $connection->error);
  }

  if (!$delete->execute()) {
    die("Exec Failed: " . $connection->error);
  }


 ?>


 <?php require "header.php" ?>
 <?php require "navbar.php" ?>
 <hr>
 <article id="indiv-item">
   <div id="right-side-item">
     <h2 id="item-name">Order of item <?php echo $_GET['itemId'] ?> successfully returned.</h2>
     <p id="item-desc">Order number: <?php echo $_GET['orderId'] ?></p>
   </div>
 </article>

 <?php require "footer.php" ?>
