<?php
	/*
		获取节目详情
	*/
    //	error_reporting(E_ALL^E_NOTICE^E_WARNING);
    
	include_once('../connectMysql.php');   
	
    $father = (@$_POST['father'])?$_POST['father']:"";
    $sn = @$_POST['sn'];
    $tag = "";

    //  查询节目ADI信息
    $sql1 = mysqli_query($connect,"SELECT * from video WHERE father='$father' LIMIT 0,1 ") or die(mysqli_error($connect));

    while($row=mysqli_fetch_array($sql1)){ //遍历查询结果，将每条结果写入数组    
        $detailJson['detailId'] = $row['id']; 
        $detailJson['detailName'] = $row['father'];
        $detailJson['detailDirector'] = $row['director'];
        $detailJson['detailActor'] = $row['actor'];
        $detailJson['detailYear'] = $row['year'];
        $detailJson['detailRegion'] = $row['region'];
        $detailJson['detailDuration'] = $row['duration'];
        $detailJson['detailScore'] = $row['score'];
        $detailJson['detailTag'] = $row['tag'];
        $detailJson['detailDescription'] = $row['details'];
        $detailJson['detailEpisodes'] = $row['episodes']; 
        $tag = $row['tag'];
    } 
  
    //  查询剧集信息
    $sql2 = mysqli_query($connect,"SELECT * from video WHERE father='$father' ORDER BY episode ASC ") or die(mysqli_error($connect));

    while($row=mysqli_fetch_array($sql2)){ //遍历查询结果，将集数信息写入数组  
        $detailJson['list'][] = array(
            'id' => $row['id'],
			'name' => $row['name'],
			'episode' => $row['episode'],
		);  
    }

    //  查询历史记录
    $sql3 = mysqli_query($connect,"SELECT * FROM history WHERE father='$father' AND sn='$sn' ORDER BY time ASC ");

    if( mysqli_num_rows($sql3) > 0 ){
        while($row=mysqli_fetch_array($sql3)){ //遍历查询结果，将结果写入数组    
            $detailJson['detailId'] = $row['id'];
            $detailJson['episodePos'] = $row['episode'];
        } 
    }else{
        $detailJson['episodePos'] = 1;  //没有历史记录就从第1集开始播
    }

    //  查询收藏记录
    $sql3 = mysqli_query($connect,"SELECT * from collect WHERE sn='$sn' AND father='$father' ") or die(mysqli_error($connect));
    if( mysqli_num_rows($sql3)>0 ){
        $detailJson['isCollect'] = 1;
    }else{
        $detailJson['isCollect'] = 0;
    }

    


	/*
		echo "<pre>";
		print_r($detailJson);  
		echo "</pre>";
	*/


		echo json_encode($detailJson);
		

?>   