<?php
  $hostname = "localhost";
  $username = "root";
  $password = "iforce123";
  $dbname = "chatapp_arif";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
