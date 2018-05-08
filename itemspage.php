<?php require "session.php" ?>
<?php
  //utilities is our connection establisher with the database
  require "utilities.php";

  // call function to gain a connection to the database
  $connection = getConnection();
  //pbe. if any of them fail, spit out the error message
  if (!$stmt = $connection->prepare(
    "SELECT * FROM items"
  )) {
    die("Prepare error: " . $connection->error);
  }

  // if prepare succeeds, try to execute the query
  if (!$stmt->execute()) {
    die("Exec error: " . $connection->error);
  }

  $items = [];
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $items[] = $row;
  }

?>

<?php require "header.php" ?>
<?php require "navbar.php" ?>

<h2>All Items</h2>
<div id="all-items">
  <!-- php for loop to gather all items in the data base -->
  <?php foreach($items as $item) { ?>
  <div class="indiv-item">
    <!-- use the img tag from the database in the html -->
    <a href="indiv-item.php?id=<?php echo $item['id'] ?>"><img class="product-img" src="<?php echo $item['itemImg'] ?>" alt=""></a>
    <!-- same for item name and price -->
    <h4><?php echo $item['itemName'] ?></h4>
    <h5>$<?php echo $item['itemPrice'] ?></h5>
    <h5>Quantity: <?php echo $item['quantity'] ?></h5>
  </div>
  <!-- close the php loop  -->
<?php } ?>
</div>
<div id="bottom">
</div>

<?php require "footer.php" ?>
