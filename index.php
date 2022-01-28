

<?php

include('database_connection.php');

session_start();
if(!isset($_SESSSION['user_id'])){
    //  header("location:login.php");
    //  exit();
}


?>

<!-- https://www.webslesson.info/2018/07/live-chat-system-in-php-using-ajax-jquery.html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">7
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat application</title>
<!--    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script> -->

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



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
            <div id="user_model_details"></div>
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

        function make_chat_dialog_box(to_user_id, to_user_name){
            // alert('hi');



         var modal_content = '<div  id="user_dialog'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';        
            modal_content += '<div style="height:200px; z-index:10;  border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
            modal_content+='</div>';
            modal_content+='<div class="form-group">';
            modal_content+='<textarea name="chat_message_ '+to_user_id+'" id="chat_message_ '+to_user_id+'" class="form-control"></textarea>';
            modal_content +='</div><div class="form-group" align="right">';
            
            modal_content +='<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
            // var modal_content='<div style=" height:400px; border:1px solid #ccc; overflow-y:scroll; margin-bottom:24px; padding:16px;">Hi</div>';
            $('#user_model_details').html(modal_content);

        }
        $(document).on('click', '.start_chat', function(){

            var to_user_id =$(this).data('touserid');
            var to_user_name=$(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);
            $("#user_dialog" +to_user_id). dialog({
                autoOpen:true,
                width:200
            });
            $('#user_dialog'+to_user_id).dialog('open');
        });
    })
</script>