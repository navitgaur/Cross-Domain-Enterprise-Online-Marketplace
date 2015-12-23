<?php if($_SESSION['fblogin'] == true):?>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().

if (response.status === 'unknown') {
     $.ajax({
            url: "logout.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: {}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
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
        e.preventDefault();    }
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
  // function logout() {
  //           FB.logout(function(response) {

  //               var data = {"token" = response.authResponse.accessToken};
  //       $.ajax({
  //           url: "logout.php", // Url to which the request is send
  //           type: "POST",             // Type of request to be send, called as method
  //           data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
  //           //dataType: 'json',
  //           success: function(data)   // A function to be called if request succeeds
  //           {
  //              console.log(data);
  //              location.href = "http://www.tugceakin.com/onlinemarket/home.php";

  //           }
  //           ,
  //           error: function(jqXHR, textStatus, errorThrown){
  //               console.log(textStatus);
  //       }
  //   });
  //       e.preventDefault();            });
  //       }
  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      console.log(response.id);
      // document.getElementById('status').innerHTML =
      //   'Thanks for logging in, ' + response.name + '!';
    },{'scope':'email'});
  }
 </script>

<?php endif;?>



<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Online Market Place</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="home.php">Products</a></li>
                <li><a href="lastViewed.php">Last Viewed Products</a></li>


                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Stats
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="stats.php">All</a></li>
                        <li><a href="stats.php?company=arcadia">Arcadia</a></li>
                        <li><a href="stats.php?company=discover_istanbul">Discover Istanbul</a></li>
                        <li><a href="stats.php?company=footprints_preschool">Footprints Preschool</a></li>
                        <li><a href="stats.php?company=little_school_home">Little School Home</a></li>
                        <li><a href="stats.php?company=cycles">Shunur Cycles</a></li>
                        <li><a href="stats.php?company=fast_food">Yummy Tummy Fast Food</a></li>



                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Download App
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="http://apps.appypie.com/media/appfile/kindle_26eddf4ba2f2.apk">Amazon Devices</a></li>
                        <li><a href="http://apps.appypie.com/media/appfile/26eddf4ba2f2.apk">Android</a></li>
                        <li><a href="http://apps.appypie.com/app/download-plist/appId/26eddf4ba2f2">IOS</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">


                <!--                    --><?php //if($this->session->userdata('logged_in') == 1):?>
                <!--                        <li><a href="--><?php //echo site_url('logout') ?><!--">Logout</a></li>-->
                <!--                    --><?php //else:?>
<!--                 <li><a href="logout.php" id="logoutlink">Logout</a></li>
 -->
            <?php if($_SESSION['fblogin'] == true):?>


 <a data-scope="public_profile,email" style=""class="btn btn-md btn-block fb-login-button" name="fbloginButton" autologoutlink=true onlogin="checkLoginState()"> </a>

                <?php else:?>
                <li><a href="logout.php" id="logoutlink">Logout</a></li>


            <?php endif;?>
                <!--                    --><?php //endif;?>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
