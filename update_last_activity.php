<?php
include('database_connection.php');
session_start();

$query="
UPDATE login_details
 SET last-activity= now()
 WHERE login_detail_id='".$_SESSION["login_detail_id"]."'
 ";
$statement=$connect->prepare($query);
$statement->execute();


 ?>