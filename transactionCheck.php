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

  $day = date("Y-m-d");
  $week_start = "2018-05-06";
  $month_start = "2018-04-01"

 ?>

 <?php require "header.php" ?>
 <?php require "navbar.php" ?>

<a class="date-button" href="transactions.php?dateCheck=<?php echo $day ?>">Day</a>
<a class="date-button" href="transactions.php?dateCheck=<?php echo $week_start ?>">Week</a>
<a class="date-button" href="transactions.php?dateCheck=<?php echo $month_start ?>">Month</a>
