<?php
session_start();

ini_set('display_errors','on');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once("01_conn.php");

$sql2 = "SELECT * FROM member WHERE uid='" . $_SESSION["UID"]."'";
$connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
$rs2 = $connect->query($sql2);
$rs2->setFetchMode(PDO::FETCH_BOTH);
$row2 = $rs2->fetch();
?>
<form method="post" action="">
<input type="hidden" name="mid" value="<?php echo $row2['mid'];?>"><br>
<input type="text" name="uid" value="<?php echo $row2['uid'];?>"><br>
<input type="text" name="passwd" value="<?php echo $row2['passwd'];?>"><br>
<input type="text" name="name" value="<?php echo $row2['name'];?>"><br>
<input type="text" name="birthday" value="<?php echo $row2['birthday'];?>"><br>
<input type="text" name="mobile" value="<?php echo $row2['mobile'];?>"><br>
<button type="submit" name="submit" value="submit">修改</button>
</form>
<a href="../private/bulletin.html">go to home page</a>
<?php
if(isset($_POST['uid'])) {
    $mid = $_POST['mid'];
    $uid = $_POST['uid'];
    $passwd = $_POST['passwd'];
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $mobile = $_POST['mobile'];
    $submit = $_POST['submit'];
}
$sql = "UPDATE member SET passwd='$passwd', name='$name', birthday='$birthday', mobile='$mobile' WHERE uid='$uid'";
$connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
$connect->query($sql);
if($submit == "submit") {
    echo "<script>";
    echo "alert('修改成功');";
    echo "</script>";
    header("refresh:0;url=member_modify.php");
}
?>