<?php
/*
	供首页显示前4个，后来改成3个了
*/
	include "connectMysql.php";
	set_time_limit(0); //	设置超时时间

	$homeArr4 = array(); 	
	$newArr = array(	
		"name" => "",
		"father" => "",
	);

	$sql1 = mysqli_query($connect,"SELECT * from video WHERE statuss=1 AND types='电影' AND episode=1 ORDER by sort ASC LIMIT 0,4");
	//	向总数组添加
	while( $row = mysqli_fetch_assoc($sql1) ){	
		$newArr["id"] = $row["id"];	
		$newArr["name"] = substr($row["name"],strripos($row["name"],"/")+1);
		$newArr["father"] = $row["father"];	
		array_push($homeArr4,$newArr);
	}

	$sql2 = mysqli_query($connect,"SELECT * from video 	WHERE statuss=1 AND types='电视剧' AND episode=1 ORDER by sort ASC LIMIT 0,4");
	//	向总数组添加
	while( $row = mysqli_fetch_assoc($sql2) ){	
		$newArr["id"] = $row["id"];	
		$newArr["name"] = substr($row["name"],strripos($row["name"],"/")+1);
		$newArr["father"] = $row["father"];		
		array_push($homeArr4,$newArr);
	}

	$sql3 = mysqli_query($connect,"SELECT * from video 	WHERE statuss=1 AND types='综艺' AND episode=1 ORDER by sort ASC LIMIT 0,4");
	//	向总数组添加
	while( $row = mysqli_fetch_assoc($sql3) ){	
		$newArr["id"] = $row["id"];	
		$newArr["name"] = substr($row["name"],strripos($row["name"],"/")+1);
		$newArr["father"] = $row["father"];		
		array_push($homeArr4,$newArr);
	}

	$sql4 = mysqli_query($connect,"SELECT * from video 	WHERE statuss=1 AND types='动漫' AND episode=1 ORDER by sort ASC LIMIT 0,4");
	//	向总数组添加
	while( $row = mysqli_fetch_assoc($sql4) ){	
		$newArr["id"] = $row["id"];	
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