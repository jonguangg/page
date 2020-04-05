<?php
//header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=UTF-8");
include_once "../connectMysql.php";

//	$sql = mysqli_query($connect,"update client set isonline='在线' where sn='1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097' ") or die(mysqli_error()) ;

if( $_POST['sn'] ){
	$sn = $_POST['sn'];
	$sql = mysqli_query($connect,"update client set isonline='在线' where sn='$sn' ") or die(mysqli_error()) ;
}

?>
