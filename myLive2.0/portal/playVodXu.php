<?php
/*
	写播放历史进数据库
*/
	header('Content-type:text/html;charset=utf-8');

	//	连接数据库	
	include "../connectMysql.php";

	//	设置超时时间
	set_time_limit(0); 

	$sn = @$_POST['sn'];
	$id = @$_POST['id'];
//	$name = @$_POST['name'];
	$father = @$_POST['father'];
	$poster = @$_POST['poster'];
	$episodePos = @$_POST['episodePos'];

	//	写播放历史
	$sql = mysqli_query($connect, "replace into history(sn,id,father,poster,episode) values ('$sn','$id','$father','$poster',$episodePos) ") or die(mysqli_error($connect));

	if( $sql ){
	//	$playJson['status'] = "success";
		echo json_encode($playJson,true);
	}else{
	//	$playJson['status'] = "error";
		echo json_encode($playJson,true);
	}



?>