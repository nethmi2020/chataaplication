<?php

include('database_connection.php');

session_start();
$query="
SELECT * FROM login
WHERE id!='".$_SESSION['user_id']."'";

$statement=$connect->prepare($query);
$statement->execute();
$result=$statement->fetchAll();
// var_dump($result);


$output='
<table class="table table-bordered table-striped">
    <tr>
       <td>UserName</td>
       <td>Status</td>
       <td>Action</td>
</tr>
';

foreach($result as $row){
    $status='';
    $current_timestamp= strtotime(date('Y-m-d H:i:s'). '-10 second');
    $current_timestamp =date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity=fetch_user_last_activity($row['id'], $connect);
    if($user_last_activity>$current_timestamp) {
        $status='<span class="btn btn-success">Online</span>';

    }
    else{

        $status='<span class="btn btn-danger">Offline</span>';
    }
    $output.='
    <tr>
        <td>'.$row['username'].'</td>
        <td>'.$status.'</td>
        <td>
            <button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['id'].'" 
            data-tousername="'.$row['username'].'">Start Chat </button></td>
    </tr>
    ';
}
$output.='</table>';
echo $output;

?>