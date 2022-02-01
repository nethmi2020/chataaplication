<?php
include('database_connection.php');




// print_r($_POST['chat_message']);

session_start();
$data= array(

    ':to_user_id'   => $_POST['to_user_id'],
    ':from_user_id' =>$_SESSION['user_id'],
   ' :chat_message' =>$_POST['chat_message'],
   ':status'        =>'1'


);
$to_user_id=$_POST['to_user_id'];
$from_user_id=$_SESSION['user_id'];
$chat_message=$_POST['chat_message'];
$status='1';

// print_r($data);

$query="

    INSERT INTO chat_message
    (to_user_id, from_user_id, chat_message,status)
    VALUES(:to_user_id,:from_user_id,:chat_message,:status);
";

$statement=$connect->prepare($query);



$statement->bindvalue(':to_user_id', $to_user_id);
$statement->bindvalue(':from_user_id', $from_user_id);
$statement->bindvalue(':chat_message', $chat_message);
$statement->bindvalue(':status', $status);

if($statement->execute()){
    echo fetch_user_chat_history($_SESSION['user_id'], $to_user_id, $connect);
    
}


?>