<?php
include_once('connectMysql.php');    
 
/*统计总记录数方法一
$sql = mysqli_query($connect,"SELECT COUNT('record_sn') FROM iqiyi_record");
$row = mysqli_fetch_row( $sql );
$recordTotal = $row[0]; //记录总数
*/

//统计总记录数方法二 
$sql = mysqli_query($connect,"select * from sold"); 
$soldTotal = mysqli_num_rows($sql);			//总记录数  
if( $soldTotal==0 ){
	return ;
}
$pageSize = 15; //每页显示数  
$pageNow = intval($_COOKIE['pageNow']-1);			//从缓存取当前页
$pageAll = ceil($soldTotal/$pageSize);		//总页数  
$startPage = $pageNow*$pageSize;				//起始页

$soldArr['soldTotal'] = $soldTotal; 
$soldArr['pageSize'] = $pageSize;  
$soldArr['pageAll'] = $pageAll;  

$query = mysqli_query($connect,"select * from sold order by soldTime DESC limit $startPage,$pageSize");  
while($row=mysqli_fetch_array($query)){//遍历查询结果，将每条结果写入数组
	$soldArr['list'][] = array(
		'soldTime' => $row['soldTime'],
		'sn' => $row['sn'],  
		'ip' => $row['ip'],  
		'city' => $row['city'], 
		'cardId' => $row['cardId'],  
		'licenseDays' => $row['licenseDays']
	);  
} 

//	echo "<pre>";
//	print_r($soldArr);  
//	echo "</pre>";
	
	echo json_encode($soldArr);
	
//	echo "<br>";
//	echo "上面是json_encode<br>";
//	echo "<br>";
//	echo "<pre>";	
//	var_dump($soldArr); 
//	echo "</pre>";

?>   