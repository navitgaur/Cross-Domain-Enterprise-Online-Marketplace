<?php
$dsn = 'mysql:host=mysql;dbname=onlinemarket';
$username = 'root';
$password = 'password';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO($dsn, $username, $password, $options);


function get_products() {
   global $db;
//    $query = 'SELECT * FROM Products';
//    try {
//        $statement = $db->prepare($query);
//        $statement->execute();
//        $result = $statement->fetchAll();
//        $statement->closeCursor();
//        return $result;
//    } catch (PDOException $e) {
//        $error_message = $e->getMessage();
//        display_db_error($error_message);
//    }
    $query = "SELECT * FROM Products";
    return $db->query($query)->fetchAll();
}

function get_product($product_id) {
    global $db;
    $query = '
        SELECT * FROM Products p';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>