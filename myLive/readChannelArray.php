<?php
include "connectMysql.php";
set_time_limit(600); //	设置超时时间

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

$channelArr = array(); //给机顶盒页面显示用的总数组	
//$channelListArr = array();	//给后台频道列表显示用的总数组	

/*
$initGroupArr = array(//初始化单个频道组
	"group" => "",
	"groupLogo" => "",
	"channel" => array()
);*/

$newGroupArr = array(//初始化一个频道组
	"group" => "",
	"groupLogo" => "",
	"channel" => array()
);

$newChannelArr = array(//初始化一个频道
	"groupId" => 1,
	"groupName" => "",
	"channelId" => 1,
	"name" => "",
	"videoUrl" => "",
);

//	更新js文件的频道组
//	$currRow = 0;
while( $rowGroup = mysqli_fetch_assoc($resultGroup) ){;
//	$newGroupArr = $initGroupArr;
	$newGroupArr["group"] = $rowGroup["groupName"];	
	$newGroupArr["groupLogo"] = $rowGroup["groupLogo"];	

	//向总频道组添加一个频道组
	array_push($channelArr,$newGroupArr);
//	print_r($rowGroup);
}

//	向各组添加频道
while( $rowChannel = mysqli_fetch_assoc($resultChannel) ){
	$newChannelArr["groupId"] = $rowChannel["groupId"];
	$newChannelArr["groupName"] = $rowChannel["groupName"];
	$newChannelArr["channelId"] = $rowChannel["channelId"];
	$newChannelArr["name"] = $rowChannel["channelName"];
	$newChannelArr["videoUrl"] = $rowChannel["videoUrl"];
	//向频道组中添加一个频道
	if( $rowChannel["groupId"] < count($channelArr)  ){	//加这个判断是解决在后台页面上删除了组,但数据库内还有该组的数据,预览就会报错
		array_push($channelArr[ $rowChannel["groupId"] ]["channel"],$newChannelArr);
	}
}
//	echo '<pre>';
//	print_r($channelArr);

//	将数组格式化为json
//	$json=json_encode($channelArr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//	将json写入文件
//	file_put_contents('myLive/channelArr.js', 'var dataArr = '.print_r($json, true) );

?>