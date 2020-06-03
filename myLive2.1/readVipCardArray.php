<?php
/*
	供导出excel表格使用
*/
	include "connectMysql.php";
	set_time_limit(0); //	设置超时时间
//	echo "<pre>";
//	从DBNAME中查询数据，返回数据库结果集
	$from = ($_GET["from"])?$_GET["from"]:"vipCard";
//	echo $from."<br/>";
	if( $from=="addVipCard"){
		$startCardId = $_COOKIE["startCardId"]-1;
		$query = "select * from vipCard where cardId>$startCardId";  
	}else if( $from=="vipCard"){
		$query = "select * from vipCard order by cardId asc";  
	}
	  

	//	结果集
	$result = mysqli_query($connect,$query);
	$Arr = array(); 	//总的机顶盒数组	
	$newArr = array(	//	初始化一个机顶盒数组
		"cardId" => "",
		"cardKey" => "",
		"licenseDays" => ""
	);

	//	向卡号数组添加卡号
	while( $row = mysqli_fetch_assoc($result) ){
		$newArr["cardId"] = $row["cardId"]."\t";//超长的加这个使在excel正常显示
		$newArr["cardKey"] = $row["cardKey"];
		$newArr["licenseDays"] = $row["licenseDays"];
		array_push($Arr,$newArr);//向机顶盒数组中添加一个机顶盒
	}

//	print_r($Arr);



//	将数组格式化为json
//	$json=json_encode($Arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//	将json写入文件
//	file_put_contents('myLive/Arr.js', 'var dataArr = '.print_r($json, true) );

?>