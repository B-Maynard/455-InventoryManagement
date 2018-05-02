<?php
  require "session.php";

  //check if there's an active session
  if (isset($_SESSION['user_id'])) {
    $sessionPage = "logout.php";
    $sessionPageLink = "Log Out";
    //if not, then direct to login
  } else {
    $sessionPage = "login.php";
    $sessionPageLink = "Log In";
  }
 ?>

<div id="nav">
  <div class="navBox" id="box1"><a href="index.php">Home</a></div>
  <div class="navBox" id="box2">Items</div>
  <div class="navBox" id="box3">Transactions</div>
  <div class="navBox" id="box4"><a href="<?php echo $sessionPage ?>"><?php echo $sessionPageLink ?></a></div>
</div>
