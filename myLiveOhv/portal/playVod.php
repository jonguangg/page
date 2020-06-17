<?php
/*
	获取播放串给AP，写播放历史进数据库
*/
//	header('Content-type:text/html;charset=utf-8');

	//	连接数据库	
	include "../connectMysql.php";

	//	设置超时时间
	set_time_limit(0); 

	$sn = @$_POST['sn'];
	$id = @$_POST['id'];
	$name = "";
	$father = "";
	$episodePos = 0;

	//	根据id去video表查询视频名称，再拼出播放串
	$sql1 = mysqli_query($connect,"SELECT * from video WHERE id='$id' ") or die(mysqli_error($connect));

	while($row=mysqli_fetch_array($sql1)){ //遍历查询结果，将每条结果写入数组        
		$name = $row['name'];    
		$father = $row['father'];
		$poster = $row['poster'];
		$episodePos = $row['episode'];
		if( $row['isOutsite'] ==0 ){	//非外链
			$fileName = substr($name,strripos($name,"/")+1);	//带扩展名的文件名
			$shortName = ltrim(substr($fileName, 0, strrpos($fileName, '.')), "/");		//不带扩展名的文件名
			$playUrl = "http://tenstar.synology.me:10025/myLive/vod/".$shortName.'/index.m3u8' ;
			$playJson['playUrl'] = $playUrl;
		}else{
			$playJson['playUrl'] = $name;
		}		
	}	

	//	写播放历史
	$sql2 = mysqli_query($connect, "replace into history(sn,id,name,father,episode,poster) values ('$sn',$id,'$name','$father',$episodePos,'$poster') ") or die(mysqli_error($connect));

	//	只保留20条历史
	$sql22 = mysqli_query($connect, "delete a from history a ,(select historyID from history WHERE sn='$sn' ORDER BY historyID desc limit 19,1) b WHERE a.historyID<b.historyID AND a.sn='$sn' ") or die(mysqli_error($connect));

	//	写播放次数
	$sq3 = mysqli_query($connect, "UPDATE video set playNum=playNum+1 WHERE id='$id' ") or die(mysqli_error($connect));


	echo json_encode($playJson);



?>