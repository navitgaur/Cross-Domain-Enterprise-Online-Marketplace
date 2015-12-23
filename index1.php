<?php
//header('Location: http://www.tugceakin.com/online-market');
  //exit;
//require_once('util/main.php');
require_once('model/product_db.php');

//// Set the featured product IDs in an array
//$product_ids = array(1, 7, 9);
//// Note: You could also store a list of featured products in the database
//
// Get an array of featured products from the database
$products = get_products();

// Display the home page
include('login.php');

?>