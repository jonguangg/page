<?php
include "connectMysql.php";
set_time_limit(0); //	设置超时时间

// 1.导入配置文件
//require "dbconfig.php";
// 2. 连接mysql
//$connect = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
//	选择数据库,如果连接时没加DBNAME就要加下面这行
//mysql_select_db(DBNAME,$connect);
//	编码设置
//mysql_set_charset('utf8',$connect);
// 3. 从DBNAME中查询数据，返回数据库结果集
$queryStb = 'select * from license order by expiretime asc';    

//	结果集
$resultStb = mysqli_query($connect,$queryStb);

$stbArr = array(); 	//总的机顶盒数组	

$newStbArr = array(	//	初始化一个机顶盒数组
	"sn" => "",
	"mark" => "",
	"ip" => "",
	"city" => "",
	"logintime" => "",
	"expiretime" => "",
	"lasttime" => "",
	"isonline" => 0
);

//	向总数组添加机顶盒
while( $rowStb = mysqli_fetch_assoc($resultStb) ){
	$newStbArr["sn"] = $rowStb["sn"];
	$newStbArr["mark"] = $rowStb["mark"];
	$newStbArr["ip"] = $rowStb["ip"];
	$newStbArr["city"] = $rowStb["city"];
	$newStbArr["logintime"] = $rowStb["logintime"];
	$newStbArr["expiretime"] = $rowStb["expiretime"];
	$newStbArr["lasttime"] = $rowStb["lasttime"];
	$newStbArr["isonline"] = $rowStb["isonline"];
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