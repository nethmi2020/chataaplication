<?php

include('database_connection.php');

// we can get value of session variable using this session-start()
session_start();  

echo fetch_user_chat_history($_SESSION['user_id'], $_POST["to_user_id"], $connect)


?>