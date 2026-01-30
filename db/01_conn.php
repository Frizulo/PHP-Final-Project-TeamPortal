<?php
//$db_host = 'mysql:host=localhost;dbname=...';
ini_set('display_errors','off');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$db_host = "localhost";
$db_user = "your_username";
$db_password = "your_password";
try{
    $connect = new PDO($db_host,$db_user,$db_password);
    $connect->exec("SET NAMES utf8");
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo "conn success!";
}
catch(PDOException $e){
    echo "error : ".$e->getMessage();
}
?>

