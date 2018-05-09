<?php

function getConnection()
  {
    $host = "localhost:3306";
    $user = "root";
    $password = "root";
    $db = "455-final";
    $connection = new mysqli($host, $user, $password, $db);

    if($connection -> connect_error) {
      die("Could not connect: " . $connection->connect_error);
    }

    //Sent the connection back
    return $connection;
  }
