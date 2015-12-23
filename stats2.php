<?php
/**
 * Created by PhpStorm.
 * User: tugceakin
 * Date: 11/13/15
 * Time: 2:12 AM
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

//$query = "SELECT * FROM Products";
//$products = $db->query($query)->fetchAll();
$company = "";

if(isset($_GET['company'])){
    $company = $_GET['company'];
}

if($company == "cycles"){
    $company = "Shunur Cycles";
    $query = "SELECT * FROM Products WHERE company = '$company'";
    $products = $db->query($query)->fetchAll();
}else if($company == "arcadia"){
    $company = "Arcadia";
    $query = "SELECT * FROM Products WHERE company = '$company'";
    $products = $db->query($query)->fetchAll();
}
else if($company == "fast_food"){
    $company = "Yummy Tummy Fast Food";
    $query = "SELECT * FROM Products WHERE company = '$company'";
    $products = $db->query($query)->fetchAll();
}else if($company == "discover_istanbul"){
    $company = "Discover Istanbul";
    $query = "SELECT * FROM Products WHERE company = '$company'";
    $products = $db->query($query)->fetchAll();
}else if($company == "footprints_preschool"){
    $company = "Footprints Preschool";
    $query = "SELECT * FROM Products WHERE company = '$company'";
    $products = $db->query($query)->fetchAll();
}
else if($company == "little_school_home"){
    $company = "Little School Home";
    $query = "SELECT * FROM Products WHERE company = '$company'";
    $products = $db->query($query)->fetchAll();
}
else{
    $query = "SELECT * FROM Products";
    $products = $db->query($query)->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("view/header.php"); ?>

</head>

<body>

<?php include("view/navigation.php"); ?>


<div class="container hidden">


<table class="table products-table table-hover table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Company</th>
        <th>Price</th>
        <th>Reviews</th>
        <th>Quality</th>
        <th>Customer Service</th>
        <th>Visit Count</th>

    </tr>
    </thead>
    <tbody>

    <?php
    foreach($products as $p):?>
        <tr>
<!--            <td><a href="?action=view_product&amp;product_id=--><?php //echo $p['id']; ?><!--">--><?php //echo $p['title'];?><!--</a></td>-->
            <td><a href="product.php?product_id=<?php echo $p['id']; ?>"><?php echo $p['title'];?></a></td>
            <td><?php echo $p['company'];?></td>
            <td><?php echo $p['price'];?></td>
                 <?php
                 $p_id = $p['id'];
                $query = "SELECT AVG( rating_quality ) AS quality_avg
                FROM Comments
                WHERE product_id = '$p_id'
                AND rating_quality > 0";
                $quality_avg = $db->query($query)->fetch();

                $query = "SELECT AVG( rating_service ) AS service_avg
                FROM Comments
                WHERE product_id = '$p_id'
                AND rating_service > 0";
                $service_avg = $db->query($query)->fetch();

                $query = "SELECT COUNT(*) as total_reviews FROM Comments WHERE product_id =  '$p_id'";
                $count = $db->query($query)->fetch();
                ?> 
            <td><?php echo $count['total_reviews'];?></td>
            <td><?php echo $quality_avg['quality_avg'];?></td>
            <td><?php echo $service_avg['service_avg'];?></td>
            <td><?php echo $p['visit_count'];?></td>

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