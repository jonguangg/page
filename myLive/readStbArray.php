<?php
/*
	供导出excel表格使用
*/
	include "connectMysql.php";
	set_time_limit(0); //	设置超时时间

	// 3. 从DBNAME中查询数据，返回数据库结果集
	$queryStb = 'select * from client order by expireTime asc';    

	//	结果集
	$resultStb = mysqli_query($connect,$queryStb);
	$stbArr = array(); 	//总的机顶盒数组	
	$newStbArr = array(	//	初始化一个机顶盒数组
		"sn" => "",
		"mark" => "",
		"ip" => "",
		"city" => "",
		"loginTime" => "",
		"expireTime" => "",
		"lastTime" => "",
		"isOnLine" => 0
	);

	//	向总数组添加机顶盒
	while( $rowStb = mysqli_fetch_assoc($resultStb) ){
		$newStbArr["sn"] = $rowStb["sn"];
		$newStbArr["mark"] = $rowStb["mark"];
		$newStbArr["ip"] = $rowStb["ip"];
		$newStbArr["city"] = $rowStb["city"];
		$newStbArr["loginTime"] = $rowStb["loginTime"];
		$newStbArr["expireTime"] = $rowStb["expireTime"];
		$newStbArr["lastTime"] = $rowStb["lastTime"];
		$newStbArr["isOnLine"] = $rowStb["isOnLine"];
		//向机顶盒数组中添加一个机顶盒
	//	if( $rowStb["sn"] < count($stbArr)  ){	//加这个判断是解决在后台页面上删除了组,但数据库内还有该组的数据,预览就会报错
			array_push($stbArr,$newStbArr);
	//	}
	}
//	print_r($stbArr);




//	将数组格式化为json
//	$json=json_encode($stbArr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//	将json写入文件
//	file_put_contents('myLive/stbArr.js', 'var dataArr = '.print_r($json, true) );

?>