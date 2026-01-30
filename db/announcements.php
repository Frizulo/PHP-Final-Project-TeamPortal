<?php
session_start();
include_once("01_conn.php");

// 處理新增公告的 POST 請求
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
        echo json_encode(["success" => false, "error" => "未授權的操作"]);
        exit;
    }

    // 取得表單提交的資料
    $title = $_POST['title'];
    $content = $_POST['content'];
    $pid = $_SESSION['id'];  // 假設 'id' 是使用者的 session 變數
    $date = $_POST['date'];

    // 準備 SQL 插入語句，使用準備語句來防止 SQL 注入攻擊
    $stmt = $connect->prepare("INSERT INTO announcements (title, content, pid, date) VALUES (:title, :content, :pid, :date)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':pid', $pid);
    $stmt->bindParam(':date', $date);

    // 執行 SQL 語句並處理結果
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->errorInfo()]);
    }

    exit;
}
?>
