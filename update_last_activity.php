<?php
include('database_connection.php');
session_start();

// mysql now() return  current date and time. 
$query="
UPDATE login_details
 SET last_activity= now() 
 WHERE login_detail_id='".$_SESSION["login_detail_id"]."'
 ";
$statement=$connect->prepare($query);
$statement->execute();





 ?>