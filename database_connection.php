<?php

// $connect=new PDO("mysql:host-localhost;dbname:chatapplication", "root", "");
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "chatapplication";

// // Create connection
// $connect = mysqli_connect($servername, $username, $password, $dbname);
$servername = "localhost";
$username = "root";
$password = "";

try {
  $connect = new PDO("mysql:host=$servername;dbname=chatapplication", $username, $password);
  // set the PDO error mode to exception
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>