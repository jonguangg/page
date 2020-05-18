<?php
/*
	根据前端POST的地址，去许API获取数据
*/
	set_time_limit(0);
//	echo "<pre>";

	$channelId = (@$_POST["channelId"])?@$_POST["channelId"]:7;
	$tab2 = ($_POST["tab2"])?$_POST["tab2"]:"";
	$tab3 = ($_POST["tab3"])?$_POST["tab3"]:"";
	$pageNow = ($_POST["pageNow"])?$_POST["pageNow"]:1;

//	$dataXu =  array();

//	if( $_POST["channelId"] != null ){	//有频道ID，说明是请求当前频道的海报列表
	//	$urlChannelList="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=".$channelId."&filterCondition0=".urlencode($tab2)."&filterCondition1=".urlencode($tab3)."&current=".$pageNow."&size=12&orderByDate=yes";

		$urlChannelList="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?channelId=".$channelId."&filterCondition0=".urlencode($tab2)."&filterCondition1=".urlencode($tab3)."&current=".$pageNow."&size=12";

		$channelListJsonStr = file_get_contents($urlChannelList);

		$channelListArr = json_decode($channelListJsonStr,true);

		$dataXu = $channelListArr["data"];

	//	var_dump($dataXu);

		echo json_encode($dataXu ,true);
//	}


















?>