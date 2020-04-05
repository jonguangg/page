<?php
/*
	供首页显示前4个
*/
	include "connectMysql.php";
	set_time_limit(0); //	设置超时时间

	$homeArr4 = array(); 	
	$newArr = array(	
		"fileName" => "",
		"title" => "",
	);

	$sql1 = mysqli_query($connect,"SELECT * from video WHERE types='电影' ORDER by sort ASC LIMIT 0,4");
	//	向总数组添加
	while( $row = mysqli_fetch_assoc($sql1) ){
		$newArr["name"] = substr($row["name"],strripos($row["name"],"/")+1);
		$newArr["father"] = $row["father"];		
		array_push($homeArr4,$newArr);
	}

	$sql2 = mysqli_query($connect,"SELECT * from video 	WHERE types='电视剧' ORDER by sort ASC LIMIT 0,4");
	//	向总数组添加
	while( $row = mysqli_fetch_assoc($sql2) ){
		$newArr["name"] = substr($row["name"],strripos($row["name"],"/")+1);
		$newArr["father"] = $row["father"];		
		array_push($homeArr4,$newArr);
	}

	$sql3 = mysqli_query($connect,"SELECT * from video 	WHERE types='综艺' ORDER by sort ASC LIMIT 0,4");
	//	向总数组添加
	while( $row = mysqli_fetch_assoc($sql3) ){
		$newArr["name"] = substr($row["name"],strripos($row["name"],"/")+1);
		$newArr["father"] = $row["father"];		
		array_push($homeArr4,$newArr);
	}

	$sql4 = mysqli_query($connect,"SELECT * from video 	WHERE types='动漫' ORDER by sort ASC LIMIT 0,4");
	//	向总数组添加
	while( $row = mysqli_fetch_assoc($sql4) ){
		$newArr["name"] = substr($row["name"],strripos($row["name"],"/")+1);
		$newArr["father"] = $row["father"];		
		array_push($homeArr4,$newArr);
	}



//		echo "<pre>";
//		print_r($homeArr4);






//	将数组格式化为json
//	$json=json_encode($Arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//	将json写入文件
//	file_put_contents('myLive/Arr.js', 'var dataArr = '.print_r($json, true) );

?>