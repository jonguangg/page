<?php
//	连接数据库	
include "connectMysql.php";
set_time_limit(600); //	设置超时时间
header('Content-type:text/html;charset=utf-8');
$currUser = ($_COOKIE["currUser"])?$_COOKIE["currUser"]:"null";

//	定义需处理的excel文件
$fileName = $_COOKIE["randname"];	//	"./channelList.xlsx";

// 引入PHPExcel
require_once "./PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";

// 载入当前文件
$phpExcel = PHPExcel_IOFactory::load("./backup/".$fileName);

// 设置为默认表
$phpExcel->setActiveSheetIndex(0);

// 获取表格数量
$sheetCount = $phpExcel->getSheetCount();

// 获取行数
$row = $phpExcel->getActiveSheet()->getHighestRow();

// 获取列数
$column = $phpExcel->getActiveSheet()->getHighestColumn();

//	echo "表格数目为：$sheetCount" . "<br>表格的行数：$row" . "<br>列数：$column";

// 遍历表格行列，将数据写入mysql
if( stripos($fileName,"hannelList") ){
//	在$fileName中查找hannelList第一次出现的位置，如果没有就返回false，
//	如果后面用channelList就会返回0，导致if判断的结果为假，这样会返回1
	$sql = mysqli_query($connect,"TRUNCATE TABLE groups");//先清空频道组
	$sql = mysqli_query($connect,"TRUNCATE TABLE channel");//先清空

	for ($i = 1; $i <= $row; $i++) {
		$excelData = array();//	每换一行都清空临时数组	
		for ($c = 'A'; $c <= $column; $c++) {// 列数循环	
			$excelData[] = $phpExcel->getActiveSheet()->getCell($c . $i)->getValue();//	向临时数组写入当前行的数据
		}
	//	echo "<pre>";
	//	print_r($excelData);//	输出临时数组显示当前行的内容，实际项目中应该写入数据库	
		if( $i>1 ){//如果没有表头就用0
			$sql = mysqli_query($connect,"replace into groups(groupId,groupName) values ($excelData[0],'$excelData[1]')") or die(mysqli_error()) ;
			$sql = mysqli_query($connect,"replace into channel(groupId,groupName,channelId,channelName,videoUrl) values ($excelData[0],'$excelData[1]',$excelData[2],'$excelData[3]','$excelData[4]')") or die(mysqli_error()) ;
		}
	}

	if( $sql ){
		echo "<script>location.href='writeChannelArray.php'</script>";    
	}else{
		echo "Error";
	}
}else if( stripos($fileName,"ipCard") ){//导入VIP卡数据
	for ($i = 1; $i <= $row; $i++) {
		$excelData = array();//	每换一行都清空临时数组	
		for ($c = 'A'; $c <= $column; $c++) {// 列数循环	
			$excelData[] = $phpExcel->getActiveSheet()->getCell($c . $i)->getValue();//	向临时数组写入当前行的数据
		}
		if( $i>1 ){//如果没有表头就用0
			$sql = mysqli_query($connect,"replace into vipCard(cardId,cardKey,licenseDays) values ($excelData[0],'$excelData[1]',$excelData[2] )") or die(mysqli_error()) ;
		}
	}

	if( $sql ){
		echo "<script>alert('已成功将VIP卡密写入数据库！');location.href='update.php?'</script>";    
	}else{
		echo "Error";
	}	
}else if( stripos($fileName,"ideoTag") ){	//导入分类数据
	$tagArr = array(
		array("tagChinese","中文"),
		array("tagJapan","日本"),
		array("tagEurUSA","欧美"),
		array("tagMosaic","马赛克"),
		array("tagNP","多人"),
		array("tagRole","角色"),
	);
	//将原排序统一加新增总数，即新的插在前面
	for($k=0;$k<sizeof($tagArr);$k++){	
		$tagTable = $tagArr[$k][0];	
		$sql = mysqli_query($connect,"UPDATE $tagTable set sort=sort+$row-1 ") or die(mysqli_error($connect));
	}
//	echo $tagArr[0][1];
	for ($i = 1; $i <= $row; $i++) {			//行数循环		
		$excelData = array();					//每换一行都清空临时数组	
		for ($c = 'A'; $c <= $column; $c++) {	//列数循环	
			$excelData[] = $phpExcel->getActiveSheet()->getCell($c . $i)->getValue();//	向临时数组写入当前行的数据
		}
		if( $i>1 ){	//如果没有表头就用0
			$nameShort = str_replace(strrchr($excelData[0], "."),"",$excelData[0]);//去掉扩展名
			$name = '/usr/local/nginx/html/myLive/vod/'.$nameShort.'/'.$excelData[0];
		//	echo "<script>alert('".$name."')</script>"; 
			$tag1 = (strlen($excelData[4])>0)?$excelData[4]."|":"";
			$tag2 = (strlen($excelData[5])>0)?$excelData[5]."|":"";
			$tag3 = (strlen($excelData[6])>0)?$excelData[6]."|":"";
			$tag4 = (strlen($excelData[7])>0)?$excelData[7]."|":"";
			$tag5 = (strlen($excelData[8])>0)?$excelData[8]."|":"";
			$tag6 = (strlen($excelData[9])>0)?$excelData[9]."|":"";
			$tagCurr = "|".$tag1.$tag2.$tag3.$tag4.$tag5.$tag6; 	//当前行数据所有分类（像这样的：|中文|多人|欧美|）	
			if( (int)$excelData[3]<1 ){	//没填排序的默认按表中从上到下递增
				$excelData[3] = $i;
			}
			// 更新video表
			$sql = mysqli_query($connect,"UPDATE video set title='$excelData[1]' ,tag='$tagCurr' where name='$name' ") or die(mysqli_error($connect));
		
			// 向分类表中插入数据
			for($j = 0; $j < sizeof($tagArr); $j++){	//循环匹配所有分类
				$tagTable = $tagArr[$j][0];				//当前匹配分类所在的数据表（像这样的：tagJapan）
						
				//在当前类型表内删除当前数据，如果该类型内有此数据，下面再重新插入
				$sql = mysqli_query($connect,"DELETE FROM $tagTable WHERE fileName='$name' ")or die(mysqli_error($connect));
				if( strpos($tagCurr,$tagArr[$j][1])>0 ){//当前行的分类内有当前匹配的分类
					$sql = mysqli_query($connect,"select * from video where name='$name' ") or die(mysqli_error($connect));
					if( mysqli_num_rows($sql)>0 ){	
					//判断video表是否有当前行的节目，否则插入失败，导致不继续插入下面的数据
						$sql = mysqli_query($connect,"replace into $tagTable (fileName,title,editor,status,sort) values ('$name','$excelData[1]','$currUser','$excelData[2]','$excelData[3]' )") or die(mysqli_error($connect));
					}
				}				
			}			
		}
	}
	
	//修改新表的排序，因为之前把老排序统一加了所有行，实际上有些行没有这个分类，所以导致有空排序数据
	for($l=0;$l<sizeof($tagArr);$l++){	//遍历每个分类表
		$tagTable = $tagArr[$l][0];	
		$sql = mysqli_query($connect,"select * from $tagTable order by sort ASC"); 
		if( $sql){	//如果该表有数据
			$tagTotal = mysqli_num_rows($sql);	//总记录数
		//	for($newS=1;$newS<$tagTotal+1;$newS++){				
				$newS = 1;
				while( $rows = mysqli_fetch_assoc($sql) ){
					$oldS = $rows["sort"];
				//	echo "<script>alert('".$oldS."');</script>";   
					$sql2 = mysqli_query($connect,"UPDATE $tagTable set sort=$newS where sort=$oldS ") or die(mysqli_error($connect));
					$newS ++;
				}			
		//	}			
		}else{
			echo "<script>alert('分类表内没有内容！');</script>"; 
			$sql2 = 0;
		}
	}

	if( $sql2 ){
		echo "<script>alert('已成功将节目信息写入数据库！');location.href='update.php?'</script>";  
	//	echo "<script>alert('已成功将节目信息写入数据库！');</script>";   
	}else{
		echo "<script>alert('分类表内没有内容！');location.href='update.php?'</script>";  
	}
}

?>