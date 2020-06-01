<?php
/*
	写播放历史进数据库
*/
	set_time_limit(0);				//	设置超时时间	
	include "../connectMysql.php";	//	连接数据库	

	$sn = @$_POST['sn'];
	$id = @$_POST['id'];
	$currentTime = @$_POST['currentTime'];

	//	写播放历史
	if( $currentTime >1 ){	//大于1的才记录播放位置，否则没太大意义
		$sql = mysqli_query($connect, "UPDATE history SET currentTime=$currentTime WHERE sn='$sn' AND id='$id' ") or die(mysqli_error($connect));	 //更新在线状态
	}

	/*
	if( $sql ){
		$playJson['status'] = "success";
		echo json_encode($playJson,true);
	}else{
		$playJson['status'] = "error";
		echo json_encode($playJson,true);
	}*/



?>