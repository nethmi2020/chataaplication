

<?php

include('database_connection.php');
$error = ''; //add this var

session_start();

$message='';

if(isset($_SESSION['user_id'])){

    header('location:index.php');
    exit();
}



if(isset($_POST['login'])){

    // var_dump($_POST);
    $uname=$_POST["username"];

    $query="
    SELECT * FROM login 
    WHERE username= :username";

    $statement=$connect->prepare("
    SELECT * FROM login 
    WHERE username= :username");
    $statement->execute(
        array(':username' => $_POST["username"]
        )
    );
        $count=$statement->rowCount(); //number of rows store in $count variable
       
        if($count > 0){
            // echo 'hello';
            $result=$statement->fetchAll(); //store query result under $result variable
            foreach($result as $row){
                //   var_dump($_POST);
                // echo $_POST['password'];
                // echo $row['password'];
                if(($_POST['password'] == $row['password'])){

                    
                    $_SESSION['user_id']=$row['id'];
                    $_SESSION['username']=$row['username'];
                    echo $row['id'];
                    $sub_query="
                    
                    INSERT INTO login_details 
                    (user_id) 
                    VALUES ('".$row['id']."')";
                        
                         $statement = $connect->prepare($sub_query);
                         $statement->execute();
                         $_SESSION['login_details_id'] = $connect->lastInsertId();
                          header('location:index.php');
                          exit();

                }
                else{
                    $message='<label>Wrong Password</label>';
                }
            }
        }
        else{
           
            $message='<label>Error</label>';
        }
}

if($error){
    echo $error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat application</title>
    
    <link rel="alternate" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="application/atom+xml" title="Atom">
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <br>
        <h3 align="center" >Chat Application using PHP Ajax Jquery</h3>
        <div class="panel panel-default mt-5">
            <div class="panel-heading mt-5 text-center mt-5">Chat Application Login</div>
            <div class="panel-body">
                <p class="text-danger"><?php echo $message;  ?></p>
                <form action="" method="post">
                                       
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="" required>
                        </div>
                         
                                                   
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="" name="password" required>
                        </div>
                        
                        <input type="submit" class="form-control btn btn-primary" name="login" value="Login">
                     
                </form>
            </div>
        </div>
    </div>
</body>
</html>