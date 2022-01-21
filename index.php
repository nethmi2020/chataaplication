

<?php

include('database_connection.php');

session_start();
if(!isset($_SESSSION['user_id'])){
    //  header("location:login.php");
    //  exit();
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat application</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <br>
        <h3 align="center" >Chat Application using PHP Ajax Jquery</h3>
        <br>

        <div class="table-responsive">
            <h4 align="center">Online User</h4>
            <p align="right"> Hi- <?php echo $_SESSION['username']; ?> <a href="logout.php">Logout</a> </p>
            <div class="" id="user-detail"></div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
        fetch_user();

// every 5 seconds user last activity table is updates
        setInterval(function(){
            update_last_activity();
            fetch_user();
        }, 5000)





        function fetch_user(){
           
            $.ajax({
                url:"fetch_user.php",
                method:"POST",
                success:function(data){
                    $('#user-detail').html(data);
                }
            })
        }

        function update_last_activity(){
            $.ajax({
                url:"update_last_activity.php",
                success:function(){

                }
            })
        }
    })
</script>