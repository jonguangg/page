<?php
/*
	获取客户端管理页面换页数据
*/
include_once('connectMysql.php');    
 
/*统计总记录数方法一
$sql = mysqli_query($connect,"SELECT COUNT('record_sn') FROM iqiyi_record");
$row = mysqli_fetch_row( $sql );
$recordTotal = $row[0]; //记录总数
*/

//统计总记录数方法二 
$sql = mysqli_query($connect,"select * from client"); 
$stbTotal = mysqli_num_rows($sql);			//总记录数  
if( $stbTotal==0 ){
	return ;
}
$sql = mysqli_query($connect,"select * from client where isOnLine='在线'"); 
$onLine = mysqli_num_rows($sql);			//总在线人数 

$pageSize = 10; //每页显示数  
//	$pageNow = intval($_POST['pageNow']-1);  			//获取当前页
$pageNow = intval($_COOKIE['pageNow']-1);			//从缓存取当前页
$pageAll = ceil($stbTotal/$pageSize);		//总页数  
$startPage = $pageNow*$pageSize;				//起始页

$stbArr['stbTotal'] = $stbTotal; 
$stbArr['onLine'] = $onLine;  
$stbArr['pageSize'] = $pageSize;  
$stbArr['pageAll'] = $pageAll;  

$query = mysqli_query($connect,"select * from client order by lastTime DESC,loginTime DESC limit $startPage,$pageSize");  
while($row=mysqli_fetch_array($query)){//遍历查询结果，将每条结果写入数组
	$stbArr['list'][] = array(
		'sn' => $row['sn'],  
		'mark' => $row['mark'], 
		'ip' => $row['ip'],  
		'city' => $row['city'], 
		'loginTime' => $row['loginTime'],  
		'expireTime' => $row['expireTime'],
		'lastTime' => $row['lastTime'], 
		'isOnLine' => $row['isOnLine'], 
	);  
} 

//	echo "<pre>";
//	print_r($stbArr);  
//	echo "</pre>";
	
	echo json_encode($stbArr);
	
//	echo "<br>";
//	echo "上面是json_encode<br>";
//	echo "<br>";
//	echo "<pre>";	
//	var_dump($stbArr); 
//	echo "</pre>";

?>   