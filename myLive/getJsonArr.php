<?php

// 从文件中读取数据到PHP变量 
$json_string = file_get_contents('getJsonArr.json'); 
   
// 用参数true把JSON字符串强制转成PHP数组 
$data = json_decode($json_string, true); 
   
// 显示出来看看 
//  var_dump($json_string); 
//	echo count($data["channelList"]);
//	var_dump ($data["channelList"]); 
//	var_dump ($data["channelList"][0]["channel"][0]["name"]); 
//  print_r($data); 


//循环遍历，将频道参数写进mysql数据库
foreach($data["channelList"] as $value){
	echo "<pre>";
	print_r($value["group"]);
	echo "<br>";
	foreach($value["channel"] as $value){
		print_r($value["name"])."url:".print_r($value["videoUrl"]);
		echo "<br>";
	}
}


 
?>