<?php
header("Content-Type:text/html;charset=utf-8");
include "connectMysql.php";
set_time_limit(0); //	设置超时时间

// 1.导入配置文件
//require "dbconfig.php";
// 2. 连接mysql
//$connect = mysqli_connect("localhost","root","10Star.925") or die("提示：数据库连接失败！");
//	选择数据库,如果连接时没加DBNAME就要加下面这行
//mysqli_select_db($connect,"mylive");
//	编码设置
//mysqli_set_charset($connect,'utf8');

// 3. 从DBNAME中查询到数据库
$sql = 'select * from groups'; 

// 结果集
$result = mysqli_query($connect,$sql);

//总的频道组
$groupArr = array();

//初始化一个频道组 
$groupArrInit = array(
	"groupId" => 0,
	"groupName" => "",
);

//扫描数据库频道组，写入总的频道组数组
while( $row = mysqli_fetch_assoc($result) ){
	$groupArrInit["groupId"] = (int)$row["groupId"];
	$groupArrInit["groupName"] = $row["groupName"];
	array_push($groupArr,$groupArrInit);
//	echo $row["groupName"].'<br>';
}

//将数组格式化为json
$json=json_encode($groupArr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//将json写入文件
file_put_contents('groupArr.js', 'var groupArr = '.print_r($json, true) );

// echo "<script>alert('成功更新频道组'); </script>";   

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
<script>
	function getID(id){return document.getElementById(id);}
	window.setTimeout("location.href='update.php?from=writeGroupArr?'+Math.random()",500);
</script>

</head>
<body>
	<div style="position:absolute;top:0px;left:0px;width:100%;height:100%;background:url(loading.gif); background-size:100% 100%;"></div>	
</body>
</html>