<?php
/*
	获取许API首页数据
*/
	set_time_limit(0);
//	echo "<pre>";

// 首页轮图
	$url="http://mixtvapi.mixtvapp.com/ott/homeswipe/getList";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$homeLoopArr = $tempArr["data"];

//	首页上方专栏	
	$url="http://mixtvapi.mixtvapp.com/ott/homecolumn/getList";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$homeZoneArr = $tempArr["data"];

	for($l=0;$l<sizeof($homeZoneArr);$l++){	//将首页上方专栏名称放入数组，供拼接首页下方专题使用，因为要排除重复的
		$homeZoneName[$l] = $homeZoneArr[$l]["columnName"];
	}	

// Mix推荐
	$url="http://mixtvapi.mixtvapp.com/ott/homerecommend/getList";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$homeRecommendArr = $tempArr["data"];

//	Hot榜
	$url="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=7&size=10";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$hotArr[0] = $tempArr["data"];

	$url="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=8&size=10";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$hotArr[1] = $tempArr["data"];
	
	$url="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=12&size=10";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$hotArr[2] = $tempArr["data"];
	
	$url="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=9&size=10";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$hotArr[3] = $tempArr["data"];

//	New榜
	$url="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=7&size=10&orderByDate=no";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$newArr[0] = $tempArr["data"];

	$url="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=8&size=10&orderByDate=no";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$newArr[1] = $tempArr["data"];
	
	$url="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=12&size=10&orderByDate=no";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$newArr[2] = $tempArr["data"];
	
	$url="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=9&size=10&orderByDate=no";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$newArr[3] = $tempArr["data"];

	// 近期高分口碑榜
	$url="http://mixtvapi.mixtvapp.com/ott/homerating/getList";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$highScoreArr = $tempArr["data"];

	// 首页下方专题
	$url="http://mixtvapi.mixtvapp.com/ott/channelcolumn/getDetailList?display=2";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$homeBottomZoneArr = $tempArr["data"];

	// 电影下方专题
	$url="http://mixtvapi.mixtvapp.com/ott/channelcolumn/getDetailList?display=3&channelId=7";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$movieBottomZoneArr = $tempArr["data"];

	for($i=0;$i<sizeof($homeBottomZoneArr);$i++){	//将首页下方专题名称放入数组，供拼接首页下方专题使用，排除重复的
		$homeZoneName[sizeof($homeZoneName)] = $homeBottomZoneArr[$i]["title"];
	}
	for($j=0;$j<sizeof($movieBottomZoneArr);$j++){	//循环电影下方专题
		if( !in_array($movieBottomZoneArr[$j]["title"],$homeZoneName) ){//屏蔽已有的
			$homeBottomZoneArr[sizeof($homeBottomZoneArr)] = $movieBottomZoneArr[$j];
		}
	}

	// 电视剧下方专题
	$url="http://mixtvapi.mixtvapp.com/ott/channelcolumn/getDetailList?display=3&channelId=8";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$seriesBottomZoneArr = $tempArr["data"];

	for($k=0;$k<sizeof($seriesBottomZoneArr);$k++){	//循环电视剧下方专题，K不从0开始 ，是因为前面几个在上方圆图专题入口已有
		if( !in_array($seriesBottomZoneArr[$k]["title"],$homeZoneName) ){//屏蔽已有的
			$homeBottomZoneArr[sizeof($homeBottomZoneArr)] = $seriesBottomZoneArr[$k];
		}
	}

	// 热搜
	$url="http://mixtvapi.mixtvapp.com/ott/hotsearch/getList";
	$jsonStr= file_get_contents($url);
	$tempArr = json_decode($jsonStr,true);
	$hotSearchArr = $tempArr["data"];



//	var_dump($hotSearchArr);
//	echo json_encode($hotMovieArr ,true);

?>