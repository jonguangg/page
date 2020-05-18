<?php
/*
	修改收藏表
*/
	header('Content-type:text/html;charset=utf-8');
	//	连接数据库	
	include "../connectMysql.php";

	set_time_limit(0); //	设置超时时间


	$sn = @$_POST['sn'];
	$id = @$_POST['id'];
	$father = @$_POST['father'];
	$poster = @$_POST['poster'];
	$isCollect = @$_POST['isCollect'];

	//	写或删收藏表
	if( $isCollect==1 ){
		$sql2 = mysqli_query($connect, "replace into collect(id,sn,father,poster) values ('$id','$sn','$father','$poster') ") or die(mysqli_error($connect));
	}else{
		$sql22 = mysqli_query($connect,"DELETE FROM collect WHERE sn='$sn' AND father='$father' ") or die(mysqli_error()) ;
	}

//	$collectJson['isCollect'] = "success";
	
//	echo json_encode($collectJson);









?>