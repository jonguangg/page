<?php
	/*
		获取分类上架节目
	*/

	//	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	include_once('connectMysql.php');   
	
	$tag1 = (@$_POST['tag1'])?$_POST['tag1']:"电影";
	$tag2 = (@$_POST['tag2'])?$_POST['tag2']:"全部";
	$tag3 = (@$_POST['tag3'])?$_POST['tag3']:"全部";
	$mobile = (@$_POST['mobile'])?$_POST['mobile']:"pc";
	$pageSize = (@$_POST['pageSize'])?$_POST['pageSize']:15;			//每页显示数  
	$pageNow = ($_POST['pageNow'])?$_POST['pageNow']:1;				//从post取当前页
	$startPage = ($pageNow-1)*$pageSize;		//起始页

	/*统计总记录数方法一
	$sql = mysqli_query($connect,"SELECT COUNT('record_sn') FROM iqiyi_record");
	$row = mysqli_fetch_row( $sql );
	$recordTotal = $row[0]; //记录总数
	*/

	if( $mobile=="mobile"){	//手机访问
		if($tag2=="全部"){	//全部地区
			if($tag3=="全部"){
				$query = mysqli_query($connect,"select * from video WHERE types='$tag1' AND  status=1 order by sort ASC,editTime DESC limit $startPage,$pageSize"); 
				$sql = mysqli_query($connect,"select * from video WHERE types='$tag1' AND  status=1 order by sort ASC,editTime DESC "); 
				$tagTotal = mysqli_num_rows($sql);		//总记录数 
			}else{
				$query = mysqli_query($connect,"select * from video WHERE types='$tag1' AND status=1 AND tag LIKE '%$tag3%' order by sort ASC,editTime DESC limit $startPage,$pageSize"); 
				$sql = mysqli_query($connect,"select * from video WHERE types='$tag1' AND status=1 AND tag LIKE '%$tag3%' order by sort ASC,editTime DESC "); 
				$tagTotal = mysqli_num_rows($sql);		//总记录数 
			}
		}else{	//用户选择了别的地区
			if($tag3=="全部"){	//用户选择了地区，没选标签
				$query = mysqli_query($connect,"select * from video WHERE types='$tag1' AND status=1 AND region='$tag2' order by sort ASC,editTime DESC limit $startPage,$pageSize"); 
				$sql = mysqli_query($connect,"select * from video WHERE types='$tag1' AND status=1 AND region='$tag2' order by sort ASC,editTime DESC "); 
				$tagTotal = mysqli_num_rows($sql);		//总记录数 
			}else{	//用户选择了地区和标签
				$query = mysqli_query($connect,"select * from video WHERE types='$tag1' AND status=1 AND region='$tag2' AND tag LIKE '%$tag3%' order by sort ASC,editTime DESC limit $startPage,$pageSize"); 
				$sql = mysqli_query($connect,"select * from video WHERE types='$tag1' AND status=1 AND region='$tag2' AND tag LIKE '%$tag3%' order by sort ASC,editTime DESC "); 
				$tagTotal = mysqli_num_rows($sql);		//总记录数 
			}			
		}
	}else{	//CMS后台访问
		$query = mysqli_query($connect,"select * from video WHERE types='$tag1' AND episode=1 order by sort ASC,editTime DESC limit $startPage,$pageSize");
		$sql  = mysqli_query($connect,"select * from video WHERE types='$tag1' AND episode=1 ");
		$tagTotal = mysqli_num_rows($sql);		//总记录数 
	}

	//统计总记录数方法二 
//	$tagTotal = mysqli_num_rows($query);		//总记录数 
	$pageAll = ceil($tagTotal/$pageSize);		//总页数  
	if( $tagTotal==0 ){
	//	return ;
	}
	$tagArrJson['tagTotal'] = $tagTotal; 
	$tagArrJson['pageSize'] = $pageSize;  
	$tagArrJson['pageAll'] = $pageAll;  

	while($row=mysqli_fetch_array($query)){//遍历查询结果，将每条结果写入数组
		$tagArrJson['list'][] = array(
			'name' => $row['name'],
			'father' => $row['father'],
			'tag' => $row['tag'],
			'statuss' => $row['statuss'],
			'sort' => $row['sort'], 
			'editor' => $row['editor'],  
			'editTime' => $row['editTime'], 
		);  
	} 

	/*
		echo "<pre>";
		print_r($tagArrJson);  
		echo "</pre>";
	*/
		echo json_encode($tagArrJson);
		





















	//	echo "<br>";
	//	echo "上面是json_encode<br>";
	//	echo "<br>";
	//	echo "<pre>";	
	//	var_dump($videoArr); 
	//	echo "</pre>";

?>   