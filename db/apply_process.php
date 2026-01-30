<?php

session_start();
// 確定是從POST來的
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    ini_set('display_errors', 'off');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    include_once("01_conn.php");

    // 拿到大家！
    $stu_id = $_POST["stu_id"];
    $fullname = $_POST["fullname"];
    $acc = $_POST["acc"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    $q1 = $_POST["q1"];
    $ApcsC = $_POST["ApcsC"] !== '' ? $_POST["ApcsC"] : NULL;
    $ApcsP = $_POST["ApcsP"] !== '' ? $_POST["ApcsP"] : NULL;
    $rawApcsC = $_POST["rawApcsC"] !== '' ? $_POST["rawApcsC"] : NULL;
    $rawApcsP = $_POST["rawApcsP"] !== '' ? $_POST["rawApcsP"] : NULL;
    $ApcsReason = $_POST["ApcsReason"];
    $q2 = $_POST["q2"];
    $q3 = $_POST["q3"];
    $q3_1 = $_POST["q3_1"] !== '' ? $_POST["q3_1"] : NULL;
    $q3_2 = $_POST["q3_2"];
    $q3_3 = $_POST["q3_3"];
    $q4 = $_POST["q4"];
    $q5 = $_POST["q5"];
    $q6 = $_POST["q6"];
    $q7 = $_POST["q7"];
    $q8 = $_POST["q8"];
    $q9 = $_POST["q9"];
    // echo "stu_id: " . $stu_id . "<br>";
    // echo "name: " . $fullname . "<br>";
    // echo "q1: " . $q1 . "<br>";
    // echo "ApcsC: " . $ApcsC . "<br>";
    // echo "ApcsP: " . $ApcsP . "<br>";
    // echo "rawApcsC: " . $rawApcsC . "<br>";
    // echo "rawApcsP: " . $rawApcsP . "<br>";
    // echo "ApcsReason: " . $ApcsReason . "<br>";
    // echo "q2: " . $q2 . "<br>";
    // echo "q3: " . $q3 . "<br>";
    // echo "q3_1: " . $q3_1 . "<br>";
    // echo "q3_2: " . $q3_2 . "<br>";
    // echo "q3_3: " . $q3_3 . "<br>";
    // echo "q4: " . $q4 . "<br>";
    // echo "q5: " . $q5 . "<br>";
    // echo "q6: " . $q6 . "<br>";
    // echo "q7: " . $q7 . "<br>";
    // echo "q8: " . $q8 . "<br>";
    // echo "q9: " . $q9 . "<br>";
    // echo "q10: " . $q10 . "<br>";
    // echo "q10_1: " . $q10_1 . "<br>";
    // echo "q10_2: " . $q10_2 . "<br>";
    // echo "q11: " . $q11 . "<br>";

    
    $check = $_POST["checkword2"];
    if ($check != $_SESSION["check_word2"]){
        echo "<script>";
        echo "alert('驗證碼錯誤。');";
        echo "window.location.href = '../LoginApply.html';";
        echo "</script>";
        exit;
    }

    // 給到資料庫
    // prepare() 準備 execute() 會插入那些 ? 中 
    
    // 檢查是否已存在於資料庫中
    $sql_check = "SELECT * FROM review WHERE stu_id = ? OR fullname = ? OR acc = ?";
    $stmt_check = $connect->prepare($sql_check);
    $stmt_check->execute([$stu_id, $fullname, $acc]);
    $existing_row = $stmt_check->fetch();

    if($existing_row){
        $show = [];
        if($existing_row['stu_id'] === $stu_id){
            $show[] = '學號';
        }
        if($existing_row['fullname'] === $fullname){
            $show[] = '姓名';
        }
        if($existing_row['acc'] === $acc){
            $show[] = '預期帳號';
        }
    
        $show_str = implode(', ', $show);
    
        echo "<script>";
        echo "alert('以下欄位相同資料已被使用了(˘･_･˘): $show_str');";
        echo "window.location.href = '../LoginApply.html';";
        echo "</script>";
    } 
    else{
        $sql = "INSERT INTO review (stu_id, fullname, acc, pwd, email, q1, ApcsC, ApcsP, rawApcsC, rawApcsP, ApcsReason, q2, q3, q3_1, q3_2, q3_3, q4, q5, q6, q7, q8, q9) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->execute([$stu_id, $fullname, $acc, $pwd, $email, $q1, $ApcsC, $ApcsP, $rawApcsC, $rawApcsP, $ApcsReason, $q2, $q3, $q3_1, $q3_2, $q3_3, $q4, $q5, $q6, $q7, $q8, $q9]);
        // 做到了(❁´◡`❁)
        echo "<script>";
        echo "alert('表單提交成功！等待人工審核中...審核通過會再mail到您的電子郵件！');";
        echo "window.location.href =  '../LoginApply.html';";
        echo "</script>";
    }   
} else {
    // 提示使用 POST 方法提交表單的錯誤
    echo "<script>";
    echo "alert('請使用 POST 方法提交表單');";
    echo "window.location.href = '../LoginApply.html';";
    echo "</script>";
}
?>
