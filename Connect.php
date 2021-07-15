<?php
    $host="localhost";
    $user="root";
    $password="";
    $db_name="busmanagement";

    $connection=mysqli_connect($host,$user,$password,$db_name);
    if ($db_name) {
    echo "Connected!";
  } else {
    echo "Connection Failed";
  }
?>