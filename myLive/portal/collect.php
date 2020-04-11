<?php
/*
	修改收藏表
*/
	header('Content-type:text/html;charset=utf-8');
	//	连接数据库	
	include "../connectMysql.php";

	set_time_limit(0); //	设置超时时间

	$id = @$_POST['id'];
	$sn = @$_POST['sn'];
	$father = "";
	$isCollect = @$_POST['isCollect'];

	//	根据id去video表查询视频名称，再拼出播放串
	$sql1 = mysqli_query($connect,"SELECT * from video WHERE id='$id' ") or die(mysqli_error($connect));

	while($row=mysqli_fetch_array($sql1)){ //遍历查询结果，将结果写入数组 
		$father = $row['father'];
	} 
	
	//	写或删收藏表
	if( $isCollect==1 ){
		$sql2 = mysqli_query($connect, "replace into collect(id,sn,father) values ($id,'$sn','$father') ") or die(mysqli_error($connect));
	}else{
		$sql22 = mysqli_query($connect,"DELETE FROM collect WHERE sn='$sn' AND father='$father' ") or die(mysqli_error()) ;
	}

//	$collectJson['isCollect'] = 10;
	
//	echo json_encode($collectJson);









?>