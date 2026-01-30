<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../LoginApply.html");
        exit;
    }

    ini_set('display_errors','off');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    include_once("01_conn.php");

    $id = $_GET["id"];
    $post_id = $_GET["pid"];

    try{
        $sql = "DELETE FROM comments where id = '$id'";
        $result = $connect->exec($sql);
        echo "<script>";
        echo "alert('刪除成功。');";
        echo "window.location.href = '../private/detailpost.php?id=$post_id';";
        echo "</script>";
    }catch (PDOException $e){
        echo "<script>";
        echo "alert('刪除失敗。');";
        echo "window.location.href = '../private/detailpost.php?id=$post_id';";
        echo "</script>";
    }
?>