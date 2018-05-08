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
    "SELECT * FROM orders WHERE userId = ?"
  )) {
    die ("Prepare error: " . $connection->error);
  }

  if (!$stmt->bind_param(
    "i",
    $userid
  )) {
    die("Bind failed: " . $connection->error);
  }

  if (!$stmt->execute()) {
    die("Exec Failed: " . $connection->error);
  }

  $orders = [];
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
  }

 ?>

 <?php require "header.php" ?>
 <?php require "navbar.php" ?>

 <table class="edit-table">
   <thead>
     <tr>
       <th>Order ID</th>
       <th>Item ID</th>
       <th>Total Cost</th>
       <th>Customer ID</th>
       <th>Date</th>
       <th>Return</th>
     </tr>
   </thead>

     <tbody>
       <?php foreach($orders as $order) { ?>
         <tr>
           <td><?php echo $order['orderId'] ?></td>
           <td><?php echo $order['itemId'] ?></td>
           <td><?php echo $order['itemPrice'] ?></td>
           <td><?php echo $order['userId'] ?></td>
           <td><?php echo $order['date'] ?></td>
           <td><a  id="return-button" href="return.php?orderId=<?php $order['orderId'] ?>&itemId=<?php $order['itemId'] ?>">Return</a></td>
         </tr>
       <?php } ?>
     </tbody>
   </table>
