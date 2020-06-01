<?php
	/*
		获取 搜索 历史 收藏
	*/

	//	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	set_time_limit(0); //限制页面执行时间,0为不限制
	include_once('../connectMysql.php');

	$sn = $_COOKIE["sn"];	
	$area = (@$_POST['area'])?$_POST['area']:"history";
	$pageNow = (@$_POST['pageNow'])?$_POST['pageNow']:1;
	$key = (@$_POST['key'])?$_POST['key']:"null";
	$pageSize = 30;			//每页显示数  				//从post取当前页
	$startPage = ($pageNow-1)*$pageSize;			   //起始页

	if( $area == "search"){	//搜索
		$urlSearchList="http://mixtvapi.mixtvapp.com/ott/videoinfo/page?videoName=".urlencode($key)."&current=".$pageNow."&size=".$pageSize;

		$searchlListJsonStr = file_get_contents($urlSearchList);
		$searchlListArr = json_decode($searchlListJsonStr,true);
		$dataXu = $searchlListArr["data"];
		echo json_encode($dataXu ,true);
	}else{	//	历史和收藏		
		$query = mysqli_query($connect,"SELECT * from $area WHERE sn='$sn' AND  statuss=1 order by editTime DESC limit $startPage,$pageSize") or die(mysqli_error($connect));

		while($row=mysqli_fetch_array($query)){//遍历查询结果，将每条结果写入数组
			$arrJson['list'][] = array(
				'id' => $row['id'],
				'father' => $row['father'],
				'poster' => $row['poster']
			);  
		} 

		$sql = mysqli_query($connect,"SELECT * from $area WHERE sn='$sn' AND statuss=1 ORDER BY editTime DESC ") or die(mysqli_error($connect));
		$total = mysqli_num_rows($sql);		//总记录数 
		$pageAll = ceil($total/$pageSize);	//总页数 
		$arrJson['pageAll'] = $pageAll; 

		echo json_encode($arrJson);
	}




?>   