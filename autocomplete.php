<?php

define('DB_HOST', 'mysql');
define('DB_NAME', 'onlinemarket');
define('DB_USER','root');
define('DB_PASSWORD','password');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

//connect to your database

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$qstring = "SELECT * FROM Products WHERE title LIKE '%".$term."%' or body LIKE '%".$term."%' or company LIKE '%".$term."%'";
$result = mysql_query($qstring);//query the database for entries containing the term

while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
{
		$row['value']=htmlentities(stripslashes($row['title']));
		$row['id']=(int)$row['id'];
		$row_set[] = $row;//build an array
}
echo json_encode($row_set);//format the array into json data



  ?>
