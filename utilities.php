<?php

function getConnection()
  {
    $host = "project.jcheung.net";
    $user = "root";
    $password = "455Fredonia!";
    $db = "455final";
    $connection = new mysqli($host, $user, $password, $db);

    if($connection -> connect_error) {
      header("Location: errorpage.php");
    }

    //Sent the connection back
    return $connection;
  }
