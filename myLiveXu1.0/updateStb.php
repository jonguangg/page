<?php
//header('Access-Control-Allow-Origin:*');
//	header("Content-type: text/html; charset=UTF-8");
include_once "./connectMysql.php";

	$sn = $_POST['sn'];
	$mark = $_POST['mark'];
	$expireTime = $_POST['expireTime'];
	
	//修改机顶盒信息
	$sql = mysqli_query($connect,"update client set mark='$mark',expireTime='$expireTime' where sn='$sn' ") or die(mysqli_error()) ;

	if( $sql ){
		$msg = '{"status":"succeed"}';
		echo $msg;
	}else{
		echo "未知错误！";
	}

?>