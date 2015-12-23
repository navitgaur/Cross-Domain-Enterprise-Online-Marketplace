<?php
/**
 * Created by PhpStorm.
 * User: tugceakin
 * Date: 11/20/15
 * Time: 4:43 PM
 */

session_save_path('/tmp');
session_start();
if(!isset($_SESSION['user']) || empty($_SESSION['user'])) {
  header( 'Location: login.php' );
}
$dsn = 'mysql:host=mysql;dbname=onlinemarket';
$username = 'root';
$password = 'password';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO($dsn, $username, $password, $options);

$username = "";

if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
}
$timeQuery = "SET time_zone = '-08:00';";
$db->query($timeQuery);

$query = "SELECT * FROM last_viewed WHERE username = '$username' ORDER BY viewedTime  DESC";
$products = $db->query($query)->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("view/header.php"); ?>

</head>

<body>
<!-- <div id="fb-root"></div> -->
 <script>
//(function(d, s, id) {
//         var js, fjs = d.getElementsByTagName(s)[0];
//         if (d.getElementById(id)) return;
//         js = d.createElement(s); js.id = id;
//         js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
//         fjs.parentNode.insertBefore(js, fjs);
//     }(document, 'script', 'facebook-jssdk'));</script>
<?php include("view/navigation.php"); ?>


<div class="container hidden">


<!--     <div class="fb-like" data-href="http://localhost:63342/termproj272/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
 -->    <table class="table products-table table-hover table-striped">
        <thead>
        <tr>
            <th>Visit Time</th>

            <th>Product Title</th>
            <th>Company</th>

        </tr>
        </thead>
        <tbody>

        <?php
        foreach($products as $p):?>
            <tr>
                <!--            <td><a href="?action=view_product&amp;product_id=--><?php //echo $p['id']; ?><!--">--><?php //echo $p['title'];?><!--</a></td>-->
                <td><?php echo $p['viewedTime'];?></td>
                <td><a href="product.php?product_id=<?php echo $p['product_id']; ?>"><?php echo $p['product_title'];?></a></td>
                <td><?php echo $p['company'];?></td>

            </tr>
        <?php endforeach;?>


        </tbody>
    </table>
</div>

<script src="lib/lib/jquery/dist/jquery.min.js")"></script>
<script src="lib/lib/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="lib/lib/DataTables-1.10.7/media/js/jquery.dataTables.min.js"></script>
<script src="lib/lib/main.js"></script>

</body>
</html>