<?php require "session.php" ?>
<?php
  require "utilities.php";

  $connection = getConnection();

  if (!$stmt = $connection->prepare(
    "SELECT itemImg, itemDescription, itemPrice, itemName FROM items WHERE id = ?"
  )) {
    die("Prepare Error: " . $connection->error);
  }

  if (!$stmt->bind_param("i", $_GET['id'])) {
    die("Bind Error: " . $connection->error);
  }

  if (!$stmt->execute()) {
    die("Exec Error: " . $connection->error);
  }

  if (!$stmt->bind_result($image, $description, $price, $name)) {
    die("Result Error: " . $connection->error);
  }

  $stmt->fetch();

 ?>

 <?php require "header.php" ?>
 <?php require "navbar.php" ?>
 <hr>

 <article id="indiv-item">
   <div id="left-side-item">
     <img id="item-img" src="<?php echo $image ?>" alt="item-img">
   </div>
   <div id="right-side-item">
     <h2 id="item-name"><?php echo $name ?></h2>
     <p id="item-desc"><?php echo $description ?></p>
     <h3 id="item-price">$<?php echo $price ?></h3>
     <a  id="order-button" href="orders.php?id=<?php echo $_GET['id'] ?>&price=<?php echo $price ?>&img=<?php echo $image ?>">Order Now</a>
   </div>
 </article>

 <?php require "footer.php" ?>
