<?php require "session.php" ?>
<?php
  //utilities is our connection establisher with the database
  require "utilities.php";

  // call function to gain a connection to the database
  $connection = getConnection();
  //pbe. if any of them fail, spit out the error message
  if (!$stmt = $connection->prepare(
    "SELECT itemName, itemDescription, itemPrice, itemImg FROM items"
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

<body>
  <div id="top">
    <img id="logo" src="https://www.graphicsprings.com/filestorage/stencils/fef1c295c28fa66259d253156c63a459.svg" alt="logo">
    <br>
    <h1>OnlineRetail</h1>
  </div>

  <?php require "navbar.php" ?>

  <div id="featured-items">
    <!-- php for loop to gather all items in the data base -->
    <?php foreach($items as $item) { ?>
    <div class="indiv-item">
      <!-- use the img tag from the database in the html -->
      <img class="product-img" src="<?php echo $item['itemImg'] ?>" alt="">
      <!-- same for item name and price -->
      <h4><?php echo $item['itemName'] ?></h4>
      <h5>$<?php echo $item['itemPrice'] ?></h5>
    </div>
    <!-- close the php loop  -->
  <?php } ?>
  </div>
  <div id="bottom">
  </div>

<?php require "footer.php" ?>
