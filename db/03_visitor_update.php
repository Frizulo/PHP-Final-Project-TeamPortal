<?php
ini_set('display_errors','off');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once("01_conn.php");

try{
    $sql = "UPDATE visitor SET visitor = visitor + 1 where vid = 1";
	//echo $sql."<br>\n";
	$msg='';

	$result =$connect->exec($sql);
	if($result === false){
		$msg="fail update. <br>\n";
	} 
	if($msg != '') echo $msg;
}catch(PDOException $e){
    echo $e->getMessage() . "<br>\n";
}
$sql2="SELECT * FROM visitor WHERE vid = 1";
$connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
$rs2=$connect->query($sql2);
$rs2->setFetchMode(PDO::FETCH_BOTH);
$row2=$rs2->fetch();
echo  "累計訪客人數: ".$row2["visitor"]."<br>";
$n = $row2["visitor"] ;
for ($i = 0; $i < strlen($n); $i++) {
	echo '<img alt="number '.$n[$i] .' " style="padding:0 2.5px;" src=pic/counter/'.$n[$i] .'.PNG height=48 />';
}
echo "<br>";
?>