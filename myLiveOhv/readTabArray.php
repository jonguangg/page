<?php
/*
	供导出excel表格使用
*/
	include "connectMysql.php";
	set_time_limit(0); //	设置超时时间

	// 3. 从DBNAME中查询数据，返回数据库结果集
	$tagNow = $_COOKIE['tagNow'];
//	echo $tagNow;
	$query = "select * from ".$tagNow." order by sort asc";    //这里from 需改成video

	//	结果集
	$result = mysqli_query($connect,$query);
	$Arr = array(); 	//总的机顶盒数组	
	$newArr = array(	//	初始化一个机顶盒数组
		"sort" => "",
		"fileName" => "",
		"title" => "",
		"status" => "",
		"editTime" => "",
		"editor" => "",
	);

	//	向总数组添加机顶盒
	while( $row = mysqli_fetch_assoc($result) ){
		$newArr["sort"] = $row["sort"];
		$newArr["fileName"] = substr($row["fileName"],strripos($row["fileName"],"/")+1);
		$newArr["title"] = $row["title"];
		$newArr["status"] = $row["status"];
		$newArr["editTime"] = $row["editTime"];
		$newArr["editor"] = $row["editor"];
		
		array_push($Arr,$newArr);//向机顶盒数组中添加一个机顶盒
	}
	//	print_r($Arr);






//	将数组格式化为json
//	$json=json_encode($Arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//	将json写入文件
//	file_put_contents('myLive/Arr.js', 'var dataArr = '.print_r($json, true) );

?>