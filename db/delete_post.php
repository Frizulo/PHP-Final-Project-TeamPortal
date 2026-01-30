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

        // 給到資料庫
        try{
            // 刪除公告
            $delete_sql = "DELETE FROM posts WHERE id = :post_id";
            $delete_stmt = $connect->prepare($delete_sql);
            $delete_stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $delete_stmt->execute();

            // 做到了(❁´◡`❁)
            echo "<script>";
            echo "alert('刪除討論成功！');";
            echo "window.location.href =  '../private/discuss.php';";
            echo "</script>";
        }catch (PDOException $e) {
            echo "<script>";
            echo "alert('刪除討論失敗！');";
            echo "window.location.href =  '../private/discuss.php';";
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