<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
        header("Location: ../LoginApply.html");
        exit;
    }
    // 確定是從POST來的
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        ini_set('display_errors', 'off');
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
        include_once("01_conn.php");

        // 拿到大家！
        $title = $_POST["title"];
        $content = $_POST["content"];

        // 給到資料庫
        $sql = "INSERT INTO announcements (title, content) VALUES ('$title', '$content')";
        $result = $connect->exec($sql);
        
        // 做到了(❁´◡`❁)
        echo "<script>";
        echo "alert('公告新增成功！');";
        echo "window.location.href =  '../private/bulletin.php';";
        echo "</script>";
    } else {
        // 提示使用 POST 方法提交表單的錯誤
        echo "<script>";
        echo "alert('請使用 POST 方法提交表單');";
        echo "window.location.href = '../private/bulletin.php';";
        echo "</script>";
    }
?>