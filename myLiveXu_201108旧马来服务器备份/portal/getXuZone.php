<?php

/*
	根据前端POST的id，去许API获取专栏详情和列表
*/
	include_once('../connectMysql.php'); 

	$columnId = @$_POST["columnId"];    //	"b9a3a094501f974e0bee41e18d6de837";	// 
	


//	获取专栏内容列表
	$url = "http://mixtvapi.mixtvapp.com/ott/channelcolumnvideo/page?size=9999&columnId=".$columnId;	//用前端POST请求的id拼接url，用于对接许的API，获取信息
	$strJson = file_get_contents($url);		//从许的后台获取数据
//	$tempArr = json_decode($strJson,true);	//将从后台获取的json数据转为PHP数组
	$tempArr["list"] = json_decode($strJson,true)["data"]["records"];

//	echo "<pre>";
//	print_r($tempArr);
    
//	获取专栏详情
	$url = "http://mixtvapi.mixtvapp.com/ott/channelcolumn/getById?id=".$columnId;	//用前端POST请求的id拼接url，用于对接许的API，获取信息
	$strJson = file_get_contents($url);		//从许的后台获取数据
	$tempArr2 = json_decode($strJson,true);	//将从后台获取的json数据转为PHP数组

	$tempArr["title"] = $tempArr2["data"]["title"];
	$tempArr["remark"] = $tempArr2["data"]["remark"];
	$tempArr["backgroundImgUrl"] = $tempArr2["data"]["backgroundImgUrl"];

//	print_r($tempArr);

//	将从后台获取的json数组转为json字符串，用于ajax传输
	echo json_encode($tempArr,true);




?>