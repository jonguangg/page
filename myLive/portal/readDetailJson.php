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
  
    //  查询集数信息
    $sql2 = mysqli_query($connect,"SELECT * from video WHERE father='$father' ORDER BY episode ASC ") or die(mysqli_error($connect));

    while($row=mysqli_fetch_array($sql2)){ //遍历查询结果，将集数信息写入数组  
        $detailJson['list'][] = array(
            'id' => $row['id'],
		//	'name' => $row['name'],
			'episode' => $row['episode'],
		);  
    }

    //  查询历史记录
    $sql3 = mysqli_query($connect,"SELECT * FROM history WHERE father='$father' AND sn='$sn' ORDER BY editTime ASC ");

    if( mysqli_num_rows($sql3) > 0 ){
        while($row=mysqli_fetch_array($sql3)){ //遍历查询结果，将结果写入数组    
            $detailJson['detailId'] = $row['id'];
            $detailJson['episodePos'] = $row['episode'];
        } 
    }else{
        $detailJson['episodePos'] = 1;  //没有历史记录就从第1集开始播
    }

    //  查询收藏记录
    $sql3 = mysqli_query($connect,"SELECT * from collect WHERE sn='$sn' AND father='$father' ORDER BY editTime ASC ") or die(mysqli_error($connect));
    if( mysqli_num_rows($sql3)>0 ){
        $detailJson['isCollect'] = 1;
    }else{
        $detailJson['isCollect'] = 0;
    }

    //  根据当前节目的类型推荐猜您喜欢，每个分类选播放数最高的1个
    $tagArr = explode("|",$tag) ;
    $guessFatherArr = [];
    for($i=1; $i<sizeof($tagArr)-1; $i++){
        $sql4 = mysqli_query($connect,"SELECT * from video WHERE statuss=1 AND father!='$father' AND tag LIKE '%$tagArr[$i]%' ORDER BY playNum DESC limit 0,1 ") or die(mysqli_error($connect));
        while($row=mysqli_fetch_array($sql4)){//遍历查询结果，将每条结果写入数组
            if( !in_array($row['father'], $guessFatherArr) ){   //如果当前节目没推荐过才推荐
                $detailJson['guess'][] = array(
                    'name' => $row['name'],
                    'father' => $row['father'],
                ); 
                array_push( $guessFatherArr,$row['father'] );   //将推荐的影片暂存供下次排除，否则可能重复推荐
            }
        }
    }

    //  防止分类不足3个，致使推荐位排不满，故再选3个最新上线的
    $guessCollect = 0;  //从收藏表内推荐的数量，只需要3个，但可能前面两个已推荐了，所以取前20个
    $sql5 = mysqli_query($connect,"SELECT * from video WHERE statuss=1 AND father!='$father' ORDER BY uploadTime DESC limit 0,20 ") or die(mysqli_error($connect));
     while($row=mysqli_fetch_array($sql5)){//遍历查询结果，将每条结果写入数组
        if( !in_array($row['father'], $guessFatherArr)  && $guessCollect < 3){   //如果当前节目没推荐过才推荐
            $detailJson['guess'][] = array(
                'name' => $row['name'],
                'father' => $row['father'],
            ); 
            $guessCollect ++;
            array_push( $guessFatherArr,$row['father'] );   //将推荐的影片暂存供下次排除，否则可能重复推荐
        }
    } 
    


	/*
		echo "<pre>";
		print_r($detailJson);  
		echo "</pre>";
	*/


		echo json_encode($detailJson);
		

?>   