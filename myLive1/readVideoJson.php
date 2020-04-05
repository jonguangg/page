<?php

include_once('connectMysql.php');

/*统计总记录数方法一
$sql = mysqli_query($connect,"SELECT COUNT('record_sn') FROM iqiyi_record");
$row = mysqli_fetch_row( $sql );
$recordTotal = $row[0]; //记录总数
*/

//统计总记录数方法二 
$sql = mysqli_query($connect, "select * from video");
$videoTotal = mysqli_num_rows($sql);			//总记录数  
if ($videoTotal == 0) {
	return;
}
$pageSize = intval($_POST['pageSize']);	//每页显示数  
$pageNow = intval($_COOKIE['pageNow'] - 1);			//从缓存取当前页
$pageAll = ceil($videoTotal / $pageSize);		//总页数  
$startPage = $pageNow * $pageSize;				//起始页

$videoArr['videoTotal'] = $videoTotal;
$videoArr['pageSize'] = $pageSize;
$videoArr['pageAll'] = $pageAll;

$query = mysqli_query($connect, "select * from video order by uploadTime DESC limit $startPage,$pageSize");
while ($row = mysqli_fetch_array($query)) { //遍历查询结果，将每条结果写入数组
	$videoArr['list'][] = array(
		'id' => $row['id'],
		'name' => $row['name'],
		'title' => $row['title'],
		'tag' => $row['tag'],
		'uploadTime' => $row['uploadTime'],
		'duration' => $row['duration'],
		'bitrate' => $row['bitrate'],
		'vcodec' => $row['vcodec'],
		'vformat' => $row['vformat'],
		'acodec' => $row['acodec'],
		'asamplerate' => $row['asamplerate'],
		'resolution' => $row['resolution'],
		'size' => $row['size'],
	);
}

//	echo "<pre>";
//	print_r($videoArr);  
//	echo "</pre>";

echo json_encode($videoArr);
	
//	echo "<br>";
//	echo "上面是json_encode<br>";
//	echo "<br>";
//	echo "<pre>";	
//	var_dump($videoArr); 
//	echo "</pre>";
