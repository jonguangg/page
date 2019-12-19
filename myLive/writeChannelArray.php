<?php
header("Content-Type:text/html;charset=utf-8");
include "connectMysql.php";
set_time_limit(0); //	设置超时时间
echo '<pre>';

// 1.导入配置文件
//require "dbconfig.php";
// 2. 连接mysql
//$connect = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
//	选择数据库,如果连接时没加DBNAME就要加下面这行
//mysql_select_db(DBNAME,$connect);
//	编码设置
//mysql_set_charset('utf8',$connect);
// 3. 从DBNAME中查询数据，返回数据库结果集
$queryGroup = 'select * from groups';   
$queryChannel = 'select * from channel'; 

//	结果集
$resultGroup = mysqli_query($connect,$queryGroup);
$resultChannel = mysqli_query($connect,$queryChannel);	

$channelArr = array(); //总的数组

$initGroupArr = array(//初始化单个频道组
	"group" => "",
	"channel" => array()
);

$newGroupArr = array(//单个频道组
	"group" => "",
	"channel" => array()
);

$newChannelArr = array(//初始化一个频道
	"groupId" => 1,
	"channelId" => 1,
	"name" => "",
	"videoUrl" => "",
);

//	更新js文件的频道组
//	$currRow = 0;
while( $rowGroup = mysqli_fetch_assoc($resultGroup) ){;
	$newGroupArr = $initGroupArr;
	$newGroupArr["group"] = $rowGroup["groupName"];	
	//向总频道组添加一个频道组
	array_push($channelArr,$newGroupArr);
//	print_r($rowGroup);
}

//	向各组添加频道
while( $rowChannel = mysqli_fetch_assoc($resultChannel) ){
	$newChannelArr["groupId"] = $rowChannel["groupId"];
	$newChannelArr["channelId"] = $rowChannel["channelId"];
	$newChannelArr["name"] = $rowChannel["channelName"];
	$newChannelArr["videoUrl"] = $rowChannel["videoUrl"];
	//向频道组中添加一个频道
	array_push($channelArr[ $rowChannel["groupId"] ]["channel"],$newChannelArr);
}

//将数组格式化为json
$json=json_encode($channelArr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//将json写入文件
file_put_contents('myLive/channelArr.js', 'var dataArr = '.print_r($json, true) );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
<script>
	function getID(id){return document.getElementById(id);}
	window.setTimeout("location.href='update.php?from=writeChannelArr?'+Math.random()",500);
//	var channelArr= <?php echo json_encode($channelArr);?>;
//	console.log(channelArr);
</script>
</head>
<body>
	<div style="position:absolute;top:0px;left:0px;width:100%;height:100%;background:url(loading.gif); background-size:100% 100%;"></div>    
</body>
</html>