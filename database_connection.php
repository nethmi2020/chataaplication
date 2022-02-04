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
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


function fetch_user_chat_history($from_user_id, $to_user_id, $connect){
  $query="

    SELECT *FROM chat_message
    WHERE (from_user_id ='".$from_user_id."'
    AND to_user_id ='".$to_user_id."')
    OR(from_user_id='".$to_user_id."'
    AND to_user_id='".$from_user_id."')
    ORDER BY timestamp DESC
    
  ";

  $statement=$connect->prepare($query);
  $statement->execute();
  $result=$statement->fetchAll();
  $output='<ul class="list-unstyled">';
  foreach($result as $row){
    $user_name='';
    if($row["from_user_id"] == $from_user_id){
      $user_name='<b class="text-success">You</b>';

    }
    else{
      $user_name='<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
    }

    $output.='<li style="border-bottom:1px dotted #ccc>
    <p>'.$user_name.' - '.$row["chat_message"].'
      <div align="right">
        -<small><em>'.$row['timestamp'].'</em></small>
      </div>
    
    </p>
    
    </li>';
  }
  $output .='<ul>';
  $query="
  UPDATE chat_message
  SET status='0'
  WHERE from_user_id='".$to_user_id."'
  AND to_user_id='".$from_user_id."'
  AND status ='1'
  ";
  $statement=$connect->prepare($query);
$statement->execute();
  return $output;

}

function get_user_name($user_id, $connect)
{
  $query=" SELECT username FROM login WHERE id ='$user_id'";
    $statement=$connect->prepare($query);
    $statement->execute();
    $result=$statement->fetchAll();
    foreach($result as $row){
      return $row['username'];
    }
  
}


function count_unseen_message($from_user_id, $to_user_id,$connect){

  $query="
  
  SELECT * FROM chat_message
  WHERE from_user_id ='$from_user_id'
  AND to_user_id='$to_user_id'
  AND status='1'
  ";

  $statement=$connect->prepare($query);
  $statement->execute();
  $count=$statement->rowCount();
  $output='';
  if($count>0){
    $output='<span class="label label-success">'.$count.'</span>';
  }
  return $output;

}

?>