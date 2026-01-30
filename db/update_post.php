<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../LoginApply.html");
        exit;
    }
    // GET 有值
    if (isset($_GET['id'])){
        ini_set('display_errors', 'off');
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
        include_once("01_conn.php");

        // 拿到大家！
        $post_id = $_GET['id'];
        $title = $_POST['title'];
        $keywords = $_POST['keywords'];
        $category = $_POST['category'];
        $content = $_POST['content'];

        // 給到資料庫
        try{
            // 更新討論
            $update_sql = "UPDATE posts SET title = :title, keywords = :keywords, category = :category, content = :content WHERE id = :post_id";
            $update_stmt = $connect->prepare($update_sql);
            $update_stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $update_stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $update_stmt->bindParam(':keywords', $keywords, PDO::PARAM_STR);
            $update_stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $update_stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $update_stmt->execute();

            // 做到了(❁´◡`❁)
            echo "<script>";
            echo "alert('更新討論成功！');";
            echo "window.location.href =  '../private/detailpost.php?id=".$post_id."';";
            echo "</script>";
        }catch (PDOException $e) {
            echo "<script>";
            echo "alert('更新討論失敗！');";
            echo "window.location.href =   '../private/detailpost.php?id=".$post_id."';";
            echo "</script>";
        }
        
    } else {
        // 提示使用 POST 方法提交表單的錯誤
        echo "<script>";
        echo "alert('反正你不對');";
        echo "window.location.href = '../private/discuss.php';";
        echo "</script>";
    }
?>