<?php
  require "utilities.php";
  require_once "session.php";

  //Check that they filled all the info

  if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    (empty($_POST["password"]) ||
    empty($_POST["confirmPassword"]) ||
    empty($_POST["firstName"]) ||
    empty($_POST["lastName"]) ||
    empty($_POST["address"]) ||
    empty($_POST["cardInfo"]))
  ) {
    die("You need to fill in all required fields");
  }
  else if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    $_POST['password'] != $_POST['confirmPassword']) {
    die("Your passwords don't match");
  }
  else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //passes all validation, so save user and redirect to login

    //make connection
    $connection = getConnection();

    $_POST['password'] = md5($_POST['password']);

    if (!$stmt = $connection->prepare(
      "INSERT INTO users (username, password, first_name, last_name, address, card_info) VALUES (?, ?, ?, ?, ?, ?)")) {
      die("Prepare failed: " . $connection->error);
    }

    if (!$stmt->bind_param(
      "ssssss",
      $_POST["username"],
      $_POST["password"],
      $_POST["firstName"],
      $_POST["lastName"],
      $_POST["address"],
      $_POST["cardInfo"]
    )) {
      die("Bind failed: " . $connection->error);
    }

    if (!$stmt->execute()) {
      die("Execution failed: " . $connection->error);
    }

    header("Location: login.php");
  }
 ?>

 <?php require "header.php" ?>
 <?php require "navbar.php" ?>

 <h2 class="register-header">Register Your Account</h2>
<hr>
<form class="register-form" method="post">
  <label class="register-labels" for="username">Username:</label>
  <input class="register-inputs" type="text" name="username" id="username">
  <br><br>
  <label class="register-labels" for="password">Password:</label>
  <input class="register-inputs" type="password" name="password" id="password">
  <br><br>
  <label class="register-labels" for="confirmPassword">Confirm Password:</label>
  <input class="register-inputs" type="password" name="confirmPassword" id="confirmPassword">
  <br><br>
  <label class="register-labels" for="firstName">First Name:</label>
  <input class="register-inputs" type="text" name="firstName" id="firstName">
  <br><br>
  <label class="register-labels" for="lastName">Last Name:</label>
  <input class="register-inputs" type="text" name="lastName" id="lastName">
  <br><br>
  <label class="register-labels" for="address">Address:</label>
  <input class="register-inputs" type="text" name="address" id="address">
  <br><br>
  <label class="register-labels" for="cardInfo">Enter Card:</label>
  <input class="register-inputs" type="text" name="cardInfo" id="cardInfo">
  <br><br>

  <button class="register-button">Register</button>

</form>

<?php require "footer.php" ?>
