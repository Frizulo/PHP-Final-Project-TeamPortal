<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../LoginApply.html");
        exit;
    }
    // 確定是從POST來的
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        ini_set('display_errors', 'off');
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
        include_once("01_conn.php");

        // 拿到大家！
        $post_id = $_GET["id"];
        $content = $_POST["content"];
        $acc_id = $_SESSION["user_id"];

        // 給到資料庫
        try{
            $sql = "INSERT INTO comments (post_id, acc_id, content) VALUES ('$post_id', '$acc_id', '$content')";
            $result = $connect->exec($sql);
            
            // 做到了(❁´◡`❁)
            echo "<script>";
            echo "alert('新增留言成功！');";
            echo "window.location.href =  '../private/detailpost.php?id=$post_id';";
            echo "</script>";
        }catch (PDOException $e) {
            echo "<script>";
            echo "alert('新增留言失敗！');";
            echo "window.location.href =  '../private/detailpost.php?id=$post_id';";
            echo "</script>";
        }
        
    } else {
        // 提示使用 POST 方法提交表單的錯誤
        echo "<script>";
        echo "alert('請使用 POST 方法提交表單');";
        echo "window.location.href = '../private/detailpost.php?id=$post_id';";
        echo "</script>";
    }
?>