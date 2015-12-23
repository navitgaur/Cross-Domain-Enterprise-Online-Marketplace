<?php

session_save_path('/tmp');
session_start();
/**
 * Created by PhpStorm.
 * User: tugceakin
 * Date: 11/19/15
 * Time: 7:17 PM
 */
//header("Content-Type: application/json", true);
$arr = array(

    'fb_id'=>$_POST['fb_id'],
    'email'=>$_POST['email'],
     'name'=>$_POST['fullname'],
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
$fb_id = $_POST['fb_id'];
$sql = "SELECT * FROM Users WHERE fb_id = '".$_POST['fb_id']."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

$total = $row[0];
if ($total==0) {
	$sql = "INSERT INTO Users (fb_id, name, email)
	VALUES ('".$_POST['fb_id']."', '".$_POST['fullname']."', '".$_POST['email']."')";
	$conn->query($sql);
	   echo "New record created successfully '$total'";
	   $sql = "SELECT * FROM Users WHERE fb_id = '".$_POST['fb_id']."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

$userid = $row[2];
	$_SESSION['user'] = $_POST['email'];
 	$_SESSION['user_id'] = $userid;
 	$_SESSION['user_name'] = $_POST['fullname'];
 	$_SESSION['fblogin'] = true;

 	            header( 'Location: home.php' );


}else{
	echo "Already exists '$total'";
	$userid = $row[2];

	$_SESSION['user'] = $_POST['email'];
 	$_SESSION['user_id'] = $userid ;
 	$_SESSION['user_name'] = $_POST['fullname'];
 	$_SESSION['fblogin'] = true;
            header( 'Location: home.php' );

}

//
// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }
$conn->close();
echo json_encode($arr);

 ?>