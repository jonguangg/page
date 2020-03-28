<?php
/*
			获取栏目分类，给后台管理页面和前台导航使用
*/

//	header("Content-Type:text/html;charset=utf-8");
include "connectMysql.php";
set_time_limit(600); //	设置超时时间

// 3. 从DBNAME中查询到数据库
$sql = 'select * from tag order by tagSort ';

// 结果集
$result = mysqli_query($connect, $sql);

//总的分类组，包含多个级别
$tagArr = array(
	array()
);

//初始化一个分类 
$arrInit = array(
	"tagSort" => 0,
	"tagName" => "",
	"tagTable" => "",
	"tagLevel" => 1,
);

//扫描数据库分类表，写入总的数组
while ($row = mysqli_fetch_assoc($result)) {
	$arrInit["tagSort"] = (int) $row["tagSort"];
	$arrInit["tagName"] = $row["tagName"];
	$arrInit["tagTable"] = $row["tagTable"];
	$arrInit["tagLevel"] = $row["tagLevel"];

	//根据tagLevel，将当前分类插入总数组相应级别内
	$tagArr[$row["tagLevel"]][] = $arrInit;
}
//	echo "<pre>";
//	print_r($tagArr);




	//将数组格式化为json
	//	$json=json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	//	将json写入文件
	//	file_put_contents('tagArr.js', 'var tagArr = '.print_r($json, true) );

	// echo "<script>alert('成功更新频道组'); </script>";   
