<?php
	/*
		获取分类上架节目
	*/

	//	error_reporting(E_ALL^E_NOTICE^E_WARNING);
		include_once('connectMysql.php');    
	 
	/*统计总记录数方法一
	$sql = mysqli_query($connect,"SELECT COUNT('record_sn') FROM iqiyi_record");
	$row = mysqli_fetch_row( $sql );
	$recordTotal = $row[0]; //记录总数
	*/
//	$tagNow = $_COOKIE['tagNow'];
	$tagNow = $_POST['tagNow'];
	$mobile = (@$_POST['mobile'])?$_POST['mobile']:"pc";
	$pageSize = $_POST['pageSize'];	//每页显示数  
//	$pageNow = intval($_COOKIE['pageNow']-1);			//从缓存取当前页
	$pageNow = $_POST['pageNow'];			//从post取当前页

	//统计总记录数方法二 
	if( $mobile=="mobile"){
		$sql = mysqli_query($connect,"select * from $tagNow WHERE status=1 ");  
	}else{
		$sql = mysqli_query($connect,"select * from $tagNow "); 
	}
	$tagTotal = mysqli_num_rows($sql);			//总记录数 
	$pageAll = ceil($tagTotal/$pageSize);		//总页数  
	$startPage = ($pageNow-1)*$pageSize;				//起始页
	if( $tagTotal==0 ){
		return ;
	}

	$tagArr['tagTotal'] = $tagTotal; 
	$tagArr['pageSize'] = $pageSize;  
	$tagArr['pageAll'] = $pageAll;  

	if( $mobile=="mobile"){
		$query = mysqli_query($connect,"select * from $tagNow WHERE status=1 order by sort ASC,editTime DESC limit $startPage,$pageSize"); 
	}else{
		$query = mysqli_query($connect,"select * from $tagNow order by sort ASC,editTime DESC limit $startPage,$pageSize"); 
	}
	while($row=mysqli_fetch_array($query)){//遍历查询结果，将每条结果写入数组
		$tagArr['list'][] = array(
			'fileName' => $row['fileName'],
			'title' => $row['title'],
			'status' => $row['status'],
			'sort' => $row['sort'], 
			'editor' => $row['editor'],  
			'editTime' => $row['editTime'], 
		);  
	} 

	/*
		echo "<pre>";
		print_r($tagArr);  
		echo "</pre>";
	*/	
		echo json_encode($tagArr);
		
	//	echo "<br>";
	//	echo "上面是json_encode<br>";
	//	echo "<br>";
	//	echo "<pre>";	
	//	var_dump($videoArr); 
	//	echo "</pre>";

?>   