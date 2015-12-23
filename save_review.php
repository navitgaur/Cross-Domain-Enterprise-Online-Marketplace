<?php
/**
 * Created by PhpStorm.
 * User: tugceakin
 * Date: 11/19/15
 * Time: 7:17 PM
 */
//header("Content-Type: application/json", true);
$arr = array(

    'id'=>$_POST['id'],
    'rating_qu'=>$_POST['rating_quality'],
     'username'=>$_POST['username'],
    'company'=>$_POST['company'],
    'text'=>$_POST['text']

);

$text = json_encode($arr['text']);

// $dsn = 'mysql:host=mysql;dbname=onlinemarket';
// $username = 'root';
// $password = 'password';
// $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
// $db = new PDO($dsn, $username, $password, $options);

// // $sql = "INSERT INTO Comments (text, rating_quality, rating_service, product_id, company, username) VALUES ('".$_POST['text']."', '".$_POST['rating_quality']."', '".$_POST['rating_service']."', '".$_POST['id']."', '".$_POST['company']."', '".$_POST['username']."')";
// $sql = "INSERT INTO Comments (text, rating_quality, rating_service, product_id, company, username)
// VALUES ('$text', '2', '3', '2', 'ssd', 'user')";
// $db->exec($sql);

// $db = null;
$servername = "mysql";
$username = "root";
$password = "password";
$dbname = "onlinemarket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$sql = "INSERT INTO Comments (text, rating_quality, rating_service, product_id, company, username, user_id)
VALUES ('".$_POST['text']."', '".$_POST['rating_quality']."', '".$_POST['rating_service']."', '".$_POST['id']."', '".$_POST['company']."', '".$_POST['username']."', '".$_POST['user_id']."')";
//
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
echo json_encode($arr);

 ?>