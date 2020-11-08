<?php

/*
	根据前端POST的id，去许API获取详情数据和猜您喜欢
*/
	include_once('../connectMysql.php'); 

	$id = @$_POST["id"];    //"5897ed81795979c8abb986f474cf7863";   //从前端获取id去后台取详情信息
	$sn = @$_POST["sn"];	//从前端获取sn去后台取收藏和播放记录

//	获取详情信息
	$urlXuDetail = "http://mixtvapi.mixtvapp.com/ott/videoinfo/getById?id=".$id;	//用前端POST请求的id拼接url，用于对接许的API，获取详情信息
	$detailJson = file_get_contents($urlXuDetail);	//从许的后台获取详情数据
	$detailArr = json_decode($detailJson,true);	//将从后台获取的json数据转为PHP数组

//	根据当前栏目和节目类型随机选猜您喜欢
	$channelId = $detailArr["data"]["channelId"];
	$videoTopic = $detailArr["data"]["videoTopic"];
    $urlXuGuess = "http://mixtvapi.mixtvapp.com/ott/videoinfo/getVideoInfoByRandom?channelId=".$channelId."&videoId=".$id."&videoTopic=".urlencode($videoTopic)."&limit=6";
	$guess = file_get_contents($urlXuGuess);	//从许的后台获取猜您喜欢数据
	$guess = json_decode($guess,true);	//将从后台获取的json数据转为PHP数组

	$detailArr["guess"] = $guess["data"] ;

//	针对多集的获取上次播放第几集
    $sql1 = mysqli_query($connect,"SELECT * FROM history WHERE id='$id' AND sn='$sn' ");

    if( mysqli_num_rows($sql1) > 0 ){
        while($row=mysqli_fetch_array($sql1)){ //遍历查询结果，将结果写入数组    
            $detailArr['episodePos'] = $row['episode'];          //用于定位选集第几集
            $detailArr['currentTime'] = $row['currentTime'];    //用于定位视频播放的位置
        } 
    }else{
        $detailArr['episodePos'] = 0;  //没有历史记录就从第1集开始播
        $detailArr['currentTime'] = 0;    //用于定位视频播放的位置
    }

//  查询收藏记录
    $sql2 = mysqli_query($connect,"SELECT * from collect WHERE sn='$sn' AND id='$id' ") or die(mysqli_error($connect));
    if( mysqli_num_rows($sql2)>0 ){
        $detailArr['isCollect'] = 1;
    }else{
        $detailArr['isCollect'] = 0;
    }
//	echo "<pre>";
//	print_r($detailArr);

//    $detailArr["urlXuGuess"] = $urlXuGuess; //输出猜您喜欢的请求地址，供调试
//	将从后台获取的json数组转为json字符串，用于ajax传输
	echo json_encode($detailArr,true);




?>