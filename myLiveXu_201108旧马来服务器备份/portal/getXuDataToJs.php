<?php
/*
	为了提高前端显示速度 ，先将不大改变的数据（一级栏目和二三级分类标签）获取到，写进数组，并不每次都去许的后台获取
	然后再用定时任务，隔一定时间再更新一个这个数组
	或者许的后台有更新时自动curl这个php文件
*/
	set_time_limit(0);
//	ini_set('max_execution_time', '0')
	file_put_contents('/usr/local/nginx/html/myLive/portal/js/getXuDataToJs.js', '' );	//先清空老数据

//	一级栏目
	$urlTab1="http://mixtvapi.mixtvapp.com/ott/ottchannel/getAllOttChannel";
	$tab1JsonStr = file_get_contents($urlTab1);	//从许的后台获取数据
	sleep(5);
	$tab1Arr = json_decode($tab1JsonStr,true);		//将从后台获取的json数据转为PHP数组
	file_put_contents('/usr/local/nginx/html/myLive/portal/js/getXuDataToJs.js', 'var tab1Arr = '.print_r($tab1JsonStr, true)."\r\n" , FILE_APPEND);

//	二、三级分类标签
	for( $i=0;$i<sizeof($tab1Arr["data"]);$i++ ){
		$urlTab2="http://mixtvapi.mixtvapp.com/ott/filtercondition/getList?level=0&display=0&channelId=".$tab1Arr["data"][$i]["channelId"];
		$tab2JsonStr = file_get_contents($urlTab2);
		sleep(3);
		$tab2Arr[$i] = json_decode($tab2JsonStr,true)["data"];

		$urlTab3="http://mixtvapi.mixtvapp.com/ott/filtercondition/getList?level=1&display=0&channelId=".$tab1Arr["data"][$i]["channelId"];
		$tab3JsonStr = file_get_contents($urlTab3);
		sleep(3);
		$tab3Arr[$i] = json_decode($tab3JsonStr,true)["data"];
	}
	$tab2Arr = json_encode($tab2Arr,TRUE|JSON_UNESCAPED_UNICODE);	//将数组格式化为json
	$tab3Arr = json_encode($tab3Arr,TRUE|JSON_UNESCAPED_UNICODE);	//将数组格式化为json
//	$tab2Arr = json_encode($tab2Arr,TRUE|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);	//将数组格式化为json，显示中文

	file_put_contents('/usr/local/nginx/html/myLive/portal/js/getXuDataToJs.js', 'var tab2Arr = '.print_r($tab2Arr, true)."\r\n" , FILE_APPEND);
	file_put_contents('/usr/local/nginx/html/myLive/portal/js/getXuDataToJs.js', 'var tab3Arr = '.print_r($tab3Arr, true)."\r\n" , FILE_APPEND);




?>