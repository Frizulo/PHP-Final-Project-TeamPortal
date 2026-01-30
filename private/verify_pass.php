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
    
    // 查詢申請人資料
    try{
        $sql = "SELECT stu_id, fullname, email, acc, pwd FROM review WHERE id = '$id'";
        $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $result = $connect->query($sql);
        $result->setFetchMode(PDO::FETCH_BOTH);
        $row = $result->fetch();
        $stu_id = $row["stu_id"];
        $name = $row["fullname"];
        $mail = $row["email"];
        $acc = $row["acc"];
        $pwd = $row["pwd"];
    }catch (PDOException $e){
        echo "<script>";
        echo "alert('審核失敗。');";
        echo "window.location.href = 'verify_check.php?id=$id';";
        echo "</script>";
    }

    // 更新審核狀態
    try{
        $sql = "UPDATE review SET checked = 1, pass = 1 where id = '$id'";
        $result = $connect->exec($sql);
    }catch (PDOException $e){
        echo "<script>";
        echo "alert('審核失敗。');";
        echo "window.location.href = 'verify_check.php?id=$id';";
        echo "</script>";
    }

    // 新增帳號
    try{
        $sql = "INSERT INTO account (acc, pwd) VALUES ('$acc', '$pwd')";
        $result = $connect->exec($sql);
    }catch (PDOException $e){
        echo "<script>";
        echo "alert('審核失敗。');";
        echo "window.location.href = 'verify_check.php?id=$id';";
        echo "</script>";
    }

    // 查詢 acc_id
    try{
        $sql = "SELECT id FROM account WHERE acc = '$acc'";
        $connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $result = $connect->query($sql);
        $result->setFetchMode(PDO::FETCH_BOTH);
        $row = $result->fetch();
        $acc_id = $row["id"];
    }catch (PDOException $e){
        echo "<script>";
        echo "alert('審核失敗。');";
        echo "window.location.href = 'verify_check.php?id=$id';";
        echo "</script>";
    }

    // 新增使用者資料
    try{
        $sql = "INSERT INTO personal_info (stu_id, `name`, mail, acc_id) VALUES ('$stu_id', '$name', '$mail', '$acc_id')";
        $result = $connect->exec($sql);
    }catch (PDOException $e){
        echo "<script>";
        echo "alert('審核失敗。');";
        echo "window.location.href = 'verify_check.php?id=$id';";
        echo "</script>";
    }

    echo "<script>";
    echo "alert('審核成功。');";
    echo "window.location.href = 'verify.php';";
    echo "</script>";
?>