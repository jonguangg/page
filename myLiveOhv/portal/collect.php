<?php
/*
	修改收藏表
*/
//	header('Content-type:text/html;charset=utf-8');
	//	连接数据库	
	include "../connectMysql.php";
	set_time_limit(0); //	设置超时时间

	$id = @$_POST['id'];
	$sn = @$_POST['sn'];
	$name = "";
	$father = "";
	$poster = "";

	//	根据id去video表查询视频名称，再拼出播放串
	$sql1 = mysqli_query($connect,"SELECT * from video WHERE id='$id' ") or die(mysqli_error($connect));

	while($row=mysqli_fetch_array($sql1)){ //遍历查询结果，将结果写入数组
		$name = $row['name'];
		$father = $row['father'];
		$poster = $row['poster'];
	} 

	//	根据id去收藏表查看是否已收藏
	$query = mysqli_query($connect,"SELECT * from collect WHERE sn='$sn' AND id='$id' AND statuss=1 order by id ASC") or die(mysqli_error($connect));
	$total = mysqli_num_rows($query);		//总记录数
	$isCollect =($total>0)?0:1;	//应反过来设置，因为下面写删收藏表是根据isCollect来的，为1就是写
	
	//	写或删收藏表
	if( $isCollect==1 ){
		$sql2 = mysqli_query($connect, "replace into collect(id,sn,name,father,poster) values ($id,'$sn','$name','$father','$poster') ") or die(mysqli_error($connect));
	}else{
		$sql22 = mysqli_query($connect,"DELETE FROM collect WHERE sn='$sn' AND father='$father' ") or die(mysqli_error()) ;
	}

	$collectJson['isCollect'] = $isCollect;	
	echo json_encode($collectJson);
?>