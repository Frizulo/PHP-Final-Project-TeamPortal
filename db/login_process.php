<?php
// 因為要判斷會員登入沒so...
session_start();
// 確定是從POST來的
if($_SERVER["REQUEST_METHOD"] == "POST"){
    ini_set('display_errors','off');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    include_once("01_conn.php");
    $acc = $_POST["username"];
    $pwd = $_POST["password"];
    
    $check = $_POST["checkword"];
    if ($check != $_SESSION["check_word"]){
        echo "<script>";
        echo "alert('驗證碼錯誤。');";
        echo "window.location.href = '../LoginApply.html';";
        echo "</script>";
        exit;
    }
    
    // 檢查帳號是否存在
    $stmt = $connect->prepare("SELECT * FROM account WHERE acc = ?");
    $stmt->execute([$acc]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row){
        echo "<script>";
        echo "alert('帳號名稱不存在於會員中。');";
        echo "window.location.href = '../LoginApply.html';";
        echo "</script>";
    }
    else{
        // 帳號存在，檢查密碼是否正確
        if($row['pwd'] === $pwd){
            // 因為要判斷會員登入沒so...

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['acc'] = $row['acc'];
            $_SESSION['role'] = $row['role'];

            // 找名字
            $sql_name = "SELECT name FROM personal_info WHERE acc_id = :acc_id";
            $stmt_name = $connect->prepare($sql_name);
            $stmt_name->bindParam(':acc_id', $row['id']);
            $stmt_name->execute();
            $row_name = $stmt_name->fetch(PDO::FETCH_ASSOC);

            // 登入成功，彈出提示窗
            echo "<script>";
            echo "alert('登入成功！歡迎回來，" . $row_name['name'] . "！');";
            echo "window.location.href = '../private/bulletin.php';"; // 內部首頁
            echo "</script>";
        }
        else{
            echo "<script>";
            echo "alert('密碼錯誤！！！');";
            echo "window.location.href = '../LoginApply.html';";
            echo "</script>";
        }
    }
} 
else{
    echo "<script>";
    echo "alert('請使用 POST 方法提交表單');";
    echo "window.location.href = '../LoginApply.html';";
    echo "</script>";
}
?>
