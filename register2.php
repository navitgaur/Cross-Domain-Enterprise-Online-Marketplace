<?php
session_save_path('/tmp');
session_start();

define('DB_HOST', 'mysql');
define('DB_NAME', 'onlinemarket');
define('DB_USER','root');
define('DB_PASSWORD','password');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());


function SignUp()
{

$name = $_POST['name'];
$email = $_POST['email'];
$password =  $_POST['password'];
$confirmpassword =  $_POST['confirmpassword']; 

$query = mysql_query(" SELECT * FROM Users WHERE email = '$email'");
$row = mysql_fetch_array($query);
 if($row['email'] == $email)
    { 
        echo '<div class="alert alert-danger" style="text-align: center;"><strong>Error!</strong> You are already registered.</div>';
    }else if($email == '' || $name == '' || $password == '' || $confirmpassword == ''){
        echo '<div class="alert alert-danger" style="text-align: center;"><strong>Error!</strong> All fields are required.</div>';
    }
    else if($password != $confirmpassword){
        echo '<div class="alert alert-danger" style="text-align: center;"><strong>Error!</strong> Passwords should match.</div>';
    }

else
{       
    $query = "INSERT INTO Users (name,email,password) VALUES ('$name','$email','$password')";
    $data = mysql_query ($query)or die(mysql_error());
    if($data)
    {
      header( 'Location: login.php' );

    }

    }

}

if(isset($_POST['registerButton']))
{
    SignUp();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" crossorigin="anonymous">

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">-->

    <!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--lib/jquery.dataTables.min.css" />-->
    <!---->
        <link rel="stylesheet" href="lib/lib/main.css" />
</head>
<body style="background-color: #2b3d4e">

<div class="container">
    <div class="row" style="margin-top:150px;">
        <div class="col-md-4 col-md-offset-4" id="loginDiv">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Enter Your Account Details</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" autofocus required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="email" type ="email" autofocus required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                            </div>
                                <div class="form-group">
                                <input class="form-control" placeholder="Confirm Password" name="confirmpassword" type="password" value="" required>
                            </div>
                            <!--                                 <div class="checkbox">
                                                                <label>
                                                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                                                </label>
                                                            </div> -->
                            <!-- Change this to a button or input when using this as a form -->
                            <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                            <button type="submit" class="btn btn-md btn-success btn-block" name="registerButton"> Register </button>

                            <div id="status">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="lib/lib/jquery/dist/jquery.min.js")"></script>
<script src="lib/lib/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="lib/lib/DataTables-1.10.7/media/js/jquery.dataTables.min.js"></script>
<script src="lib/lib/main.js"></script>

</body>
</html>