<?php
/*
	写播放历史进数据库
*/
//	header('Content-type:text/html;charset=utf-8');		//	不能加这个，否则前端接收不到echo json_encode($playJson,true)的消息
	set_time_limit(0);				//	设置超时时间	
	include "../connectMysql.php";	//	连接数据库	

	$sn = @$_POST['sn'];
	$id = @$_POST['id'];
//	$name = @$_POST['name'];
	$father = @$_POST['father'];
	$poster = @$_POST['poster'];
	$episodePos = @$_POST['episodePos'];
	$currentTime = @$_POST['currentTime'];

	$playJson['status'] = "success";

	//	写播放历史
	$sql = mysqli_query($connect, "replace into history(sn,id,father,poster,episode,currentTime) values ('$sn','$id','$father','$poster',$episodePos,$currentTime) ") or die(mysqli_error($connect));

	//	只保留20条历史
	$sql22 = mysqli_query($connect, "delete a from history a ,(select historyID from history WHERE sn='$sn' ORDER BY historyID desc limit 29,1) b WHERE a.historyID<b.historyID AND a.sn='$sn' ") or die(mysqli_error($connect));

	if( $sql ){
		$playJson['status'] = "success";
		echo json_encode($playJson,true);
	}else{
		$playJson['status'] = "error";
		echo json_encode($playJson,true);
	}



?>