<?php
session_save_path('/tmp');
session_start();

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
  header( 'Location: home.php' );
}

if(isset($_SESSION['fb-name']) && !empty($_SESSION['fb-name'])) {
  header( 'Location: home.php' );
}


if($_GET['result'] == 'success'){
echo '<div class="alert alert-success" style="text-align: center;"><strong>Success!</strong> Registration is complete.</div>';
}

if(isset($_POST['loginButton'])) {
    extract($_POST);
    $dsn = 'mysql:host=mysql;dbname=onlinemarket';
    $username = 'root';
    $password = 'password';
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $db = new PDO($dsn, $username, $password, $options);

    $query = "SELECT * FROM Users";
    $isUserFound = false;
    $users = $db->query($query)->fetchAll();
    foreach($users as $u){
       // echo $u['email'];
        if($u["email"] == $_POST["email"] && $u["password"] == $_POST["password"]) {

            $_SESSION['user'] = $_POST["email"];
            $_SESSION['user_id'] = $u["id"];
            $_SESSION['user_name'] = $u["name"];

            header( 'Location: home.php' );

        }
    }}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" crossorigin="anonymous">

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">-->

    <!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--lib/jquery.dataTables.min.css" />-->
    <!---->
    <!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--lib/main.css" />-->
</head>
<body style="background-color: #2b3d4e">
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      // document.getElementById('status').innerHTML = 'Please log ' +
      //   'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      // document.getElementById('status').innerHTML = 'Please log ' +
      //   'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1736611106567805',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      console.log(response.id);

      // document.getElementById('status').innerHTML =
      //   'Thanks for logging in, ' + response.name + '!';

           var fbid  = response.id;
           var name = response.name;
           var emailuser = response.id + '@facebook.com';

        var data = {'fb_id': response.id, 'fullname': name, 'email': emailuser};

        $.ajax({
            url: "facebook_login.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            //dataType: 'json',
            success: function(data)   // A function to be called if request succeeds
            {
               console.log(data);
               location.href = "http://www.tugceakin.com/onlinemarket/home.php";
               //window.location.reload();

            }
            ,
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
        }
    });
        e.preventDefault();

    },{'scope':'email'});
  }
 </script>
<div class="container">
    <div class="row" style="margin-top:150px;">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In to Enter Marketplace</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="email" autofocus required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                            </div>
                            <!--                                 <div class="checkbox">
                                                                <label>
                                                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                                                </label>
                                                            </div> -->
                            <!-- Change this to a button or input when using this as a form -->
                            <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                            <button type="submit" class="btn btn-md btn-success btn-block" name="loginButton"> Login </button>
                            <a href="register" style="margin-top:5px; margin-bottom: 5px;">Not registered? Click here to sign up.</a>
                        </fieldset>
                    </form>
<!--                     <div class ="fb-login-button" data-scope="public_profile,email"></div>
 --><button data-scope="public_profile,email" style="background-color: white;"class="btn btn-md btn-block fb-login-button" name="fbloginButton" autologoutlink=true onlogin="checkLoginState()"> Login with Facebook</button>
<!-- <div><fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button> -->

<div id="status">
</div></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="lib/lib/jquery/dist/jquery.min.js")"></script>
<script src="lib/lib/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="lib/lib/DataTables-1.10.7/media/js/jquery.dataTables.min.js"></script>
<script src="lib/lib/main.js"></script>
<?php //include 'view/header.php'; ?>
<!---->
<?php //include 'view/footer.php'; ?>
</body>
</html>