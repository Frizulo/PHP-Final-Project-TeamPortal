<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
        header("Location: ../LoginApply.html");
        exit;
    }

    ini_set('display_errors','off');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    include_once("../db/01_conn.php");

    $id = $_GET["id"];

    try{
        $sql = "DELETE FROM announcements where id = '$id'";
        $result = $connect->exec($sql);
        echo "<script>";
        echo "alert('刪除成功。');";
        echo "window.location.href = 'bulletin.php';";
        echo "</script>";
    }catch (PDOException $e){
        echo "<script>";
        echo "alert('刪除失敗。');";
        echo "window.location.href = 'bulletin.php';";
        echo "</script>";
    }
?>