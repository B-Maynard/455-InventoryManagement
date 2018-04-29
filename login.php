<?php
  require "session.php";

  //If coming from the POST form:

  if(isset($_POST['username'])) {
    $userid = $_POST['username'];
    //make a connection to the db
    require "utilities.php";
    //find one user by username
    $connection = getConnection();
    //hash the password
    $password = md5($_POST['password']);
    //check it against the one in the record


    if (!$stmt = $connection->prepare (
      "SELECT password, user_id FROM users WHERE username = '$userid'"
    )) {
      die("Error: " . $connection->error);
    }

    if (!$stmt->execute()) {
      die("Execution error: " . $connection->error);
    }

    if (!$stmt->bind_result($userpassword, $useridnumber)) {
      die("Bind error: " . $connection->error);
    }

    $stmt->fetch();

    //if good, redirect to index.php, if not
    // redirect to login.php
    if (empty($userid)) {
      header("Location: login.php");
    } else if ($password == $userpassword) {
      $_SESSION['user_id'] = $useridnumber;
      header("Location: index.php");
    } else {
      header("Location: login.php");
    }
  }

  ?>
<?php require "header.php" ?>
<?php require "navbar.php" ?>

<h2>Sign In</h2>
<hr>
<form id="login-form" method="post">
  <label for="username" class="login-labels">Username</label>
  <input type="text" class="login_inputs" id="username" name="username">
  <br><br>
  <label for="password" class="login-labels">Password</label>
  <input type="password" class="login_inputs" name="password" id="password">
  <br>
  <br>
  <br>
  <br>
  <button>Log In</button>
  <p>Not a member? Click <a href="register.php">here</a> to sign up!</p>
</form>


<?php require "footer.php" ?>
