<?php
/*
	删除历史收藏表
*/
//	header('Content-type:text/html;charset=utf-8');
	//	连接数据库	
	include "../connectMysql.php";
	set_time_limit(0); //	设置超时时间

	$sn = @$_POST['sn'];
	$area = (@$_POST['area'])?$_POST['area']:"history";

	//	删历史或收藏表
	$sql = mysqli_query($connect,"DELETE FROM $area WHERE sn='$sn' ") or die(mysqli_error()) ;	

	$collectJson['status'] = "success";	
	echo json_encode($collectJson);
?>