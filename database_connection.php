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

  function fetch_user_last_activity($user_id, $connect){
    $query="
    SELECT *FROM login_details
    WHERE user_id='$user_id'
    ORDER BY last_activity DESC
    LIMIT 1
    ";

    $statement=$connect->prepare($query);
    $statement ->execute();
    $result=$statement->fetchAll();
    foreach($result as $row){
      return $row['last_activity'];
    }

  }
  // set the PDO error mode to exception
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>