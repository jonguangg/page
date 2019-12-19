<?php
//header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=UTF-8");
include "../connectMysql.php";

//$sql = mysqli_query($connect,"update license set isonline='在线' where sn='b10bc3af38A4ED1BAE89' ") or die(mysqli_error()) ;

if( $_POST['sn'] ){
	$sn = $_POST['sn'];
	$sql = mysqli_query($connect,"update license set isonline='在线' where sn='$sn' ") or die(mysqli_error()) ;
}

?>
