<?php
	/*
		获取 收藏 数组
	*/

	//	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	include_once('../connectMysql.php');

	$sn = $_COOKIE["sn"];

	$query = mysqli_query($connect,"SELECT * from collect WHERE sn='$sn' AND  statuss=1 order by id ASC") or die(mysqli_error($connect));

	$collectArr[] = "null";	//先定义一个值，否则收藏为空会出错

	while($row=mysqli_fetch_array($query)){//遍历查询结果，将每条结果写入数组
		$collectArr[] = $row['id'];  
	} 

//	echo json_encode($collectArr);
		

		
	/*
		echo "<pre>";
		print_r($collectArr);  
		echo "</pre>";
	*/

?>   