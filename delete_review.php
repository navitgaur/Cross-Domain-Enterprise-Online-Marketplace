<?php

    $comment_id = $_GET['comment_id'];
    $product_id = trim($_GET['product_id']);

define('DB_HOST', 'mysql');
define('DB_NAME', 'onlinemarket');
define('DB_USER','root');
define('DB_PASSWORD','password');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$query = "DELETE FROM Comments WHERE id = '$comment_id'";
$retval = mysql_query( $query, $con );
if(! $retval )
{
  die('Could not delete data: ' . mysql_error());
}

      header( "Location: product.php?product_id=".$product_id );

     ?>