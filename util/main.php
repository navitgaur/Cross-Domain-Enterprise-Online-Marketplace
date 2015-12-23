<?php
/**
 * Created by PhpStorm.
 * User: tugceakin
 * Date: 11/13/15
 * Time: 1:47 PM
 */


// Get the document root
$doc_root = $_SERVER['DOCUMENT_ROOT'];

// Get the application path
$uri = $_SERVER['REQUEST_URI'];
$dirs = explode('/', $uri);
$app_path = '/' . $dirs[1] . '/' . $dirs[2] . '/';

// Set the include path
set_include_path($doc_root . $app_path);

// Get common code
//require_once('util/tags.php');
require_once('model/database.php');


function redirect($url) {
    session_write_close();
    header("Location: " . $url);
    exit;
}

// Start session to store user and cart data
session_save_path("/tmp");
session_start();
?>
