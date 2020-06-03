<?php
/*
	供导出excel表格使用
*/
	include "connectMysql.php";
	set_time_limit(0); //	设置超时时间

	// 从DBNAME中查询数据，返回数据库结果集
	$query = 'select * from video order by uploadTime asc';    

	//	结果集
	$result = mysqli_query($connect,$query);
	$Arr = array(); 	//总的机顶盒数组	
	$newArr = array(	//	初始化一个机顶盒数组
		"name" => "",
		"duration" => "",
		"second" => "",
		"bitrate" => "",
		"resolution" => "",
		"vcodec" => "",
		"vformat" => "",
		"acodec" => "",
		"asamplerate" => "",
		"size" => "",
		"uploadTime" => ""
	);

	//	向总数组添加机顶盒
	while( $row = mysqli_fetch_assoc($result) ){	
		$newArr["name"] = $row["name"];
		$newArr["duration"] = $row["duration"];
		$newArr["second"] = $row["second"];
		$newArr["bitrate"] = $row["bitrate"];
		$newArr["resolution"] = $row["resolution"];
		$newArr["vcodec"] = $row["vcodec"];
		$newArr["vformat"] = $row["vformat"];
		$newArr["acodec"] = $row["acodec"];
		$newArr["asamplerate"] = $row["asamplerate"];
		$newArr["size"] = $row["size"];
		$newArr["uploadTime"] = $row["uploadTime"];
		
		array_push($Arr,$newArr);//向机顶盒数组中添加一个机顶盒
	}





//	print_r($Arr);
//	将数组格式化为json
//	$json=json_encode($Arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//	将json写入文件
//	file_put_contents('myLive/Arr.js', 'var dataArr = '.print_r($json, true) );

?>