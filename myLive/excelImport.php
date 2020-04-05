<?php
	//	连接数据库	
	include "connectMysql.php";
//	include_once "readTagNav.php";

	set_time_limit(0); //	设置超时时间
//	ini_set('max_execution_time', '0');
	header('Content-type:text/html;charset=utf-8');
	$currUser = ($_COOKIE["currUser"]) ? $_COOKIE["currUser"] : "null";

	//	定义需处理的excel文件
	$fileName = $_COOKIE["randname"];	//	"./channelList.xlsx";

	// 引入PHPExcel
	require_once "./PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";

	// 载入当前文件
	$phpExcel = PHPExcel_IOFactory::load("./backup/" . $fileName);

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
if (stripos($fileName, "hannelList")) {
	//	在$fileName中查找hannelList第一次出现的位置，如果没有就返回false，
	//	如果后面用channelList就会返回0，导致if判断的结果为假，这样会返回1
	$sql = mysqli_query($connect, "TRUNCATE TABLE groups"); //先清空频道组
	$sql = mysqli_query($connect, "TRUNCATE TABLE channel"); //先清空

	for ($i = 1; $i <= $row; $i++) {
		$excelData = array(); //	每换一行都清空临时数组	
		for ($c = 'A'; $c <= $column; $c++) { // 列数循环	
			$excelData[] = $phpExcel->getActiveSheet()->getCell($c . $i)->getValue(); //	向临时数组写入当前行的数据
		}
		//	echo "<pre>";
		//	print_r($excelData);//	输出临时数组显示当前行的内容，实际项目中应该写入数据库	
		if ($i > 1) { //如果没有表头就用0
			$sql = mysqli_query($connect, "replace into groups(groupId,groupName,groupLogo) values ($excelData[0],'$excelData[1]', '$excelData[2]')  ") or die(mysqli_error());

			$sql = mysqli_query($connect, "replace into channel(groupId,groupName,channelId,channelName,videoUrl,channelLogo) values ($excelData[0],'$excelData[1]',$excelData[3],'$excelData[4]','$excelData[5]','$excelData[6]')") or die(mysqli_error());
		}
	}

	if ($sql) {
		echo "<script>location.href='writeChannelArray.php'</script>";
	} else {
		echo "Error";
	}
} else if (stripos($fileName, "ipCard")) { //导入VIP卡数据
	for ($i = 1; $i <= $row; $i++) {
		$excelData = array(); //	每换一行都清空临时数组	
		for ($c = 'A'; $c <= $column; $c++) { // 列数循环	
			$excelData[] = $phpExcel->getActiveSheet()->getCell($c . $i)->getValue(); //	向临时数组写入当前行的数据
		}
		if ($i > 1) { //如果没有表头就用0
			$sql = mysqli_query($connect, "replace into vipCard(cardId,cardKey,licenseDays) values ($excelData[0],'$excelData[1]',$excelData[2] )") or die(mysqli_error());
		}
	}

	if ($sql) {
		echo "<script>alert('已成功将VIP卡密写入数据库！');location.href='update.php?'</script>";
	} else {
		echo "Error";
	}
} else if (stripos($fileName, "ideoTag")) {	//导入分类数据
	echo "<script>alert('".$row."');'</script>";
	//先将原表排序统一加上当前excel表格行数，即新数据插在前面
	$sql = mysqli_query($connect, "UPDATE video set sort=sort+$row-1 ") or die(mysqli_error($connect));

	for ($i = 1; $i <= $row; $i++) {			//行数循环		
		$excelData = array();					//每换一行都清空临时数组	
		for ($c = 0; $c <= PHPExcel_Cell::columnIndexFromString($column); $c++) {	//列数循环	
			$excelData[] = $phpExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($c) . $i)->getValue(); //	向临时数组写入当前行的数据
		}
		if ($i > 1) {	//如果没有表头就用0
			$nameShort = str_replace(strrchr($excelData[4], "."), "", $excelData[4]); //去掉扩展名
			$name = '/usr/local/nginx/html/myLive/vod/' . $nameShort . '/' . $excelData[4];
			$tagCurr = "|" ; 	
			for($m=14;$m<42;$m++){	//分类标签
				if( strlen($excelData[$m]) > 0 ){	//如果当前单元格有标签信息则获取此标签
					$tagCurr = $tagCurr.$excelData[$m]."|";
				}				
			}			

			if ( strlen($excelData[1]) == 0 ) {	//没填是否上架，默认不上架
				$excelData[1] = 0;
			}

			if ((int) $excelData[2] < 1) {	//没填排序的默认按表中从上到下递增
				$excelData[2] = $i;
			}
			// 更新video表内容
			if($excelData[0]>0){	//外链
				$sql = mysqli_query($connect, "replace into video (isOutside,status,sort,type,name,father,episode,episodes,region,year,director,actor,score,details,tag,editor) values ($excelData[0],$excelData[1],$excelData[2],'$excelData[3]','$excelData[4]','$excelData[5]','$excelData[6]','$excelData[7]','$excelData[8]',$excelData[9],'$excelData[10]','$excelData[11]',$excelData[12],'$excelData[13]','$tagCurr','$currUser')") or die(mysqli_error($connect));
			}else{
			//	echo "<script>alert('".$excelData[1].$excelData[2].$excelData[3].$excelData[4].$excelData[5].$excelData[6]."');</script>";
				
			//	$sql = mysqli_query($connect, "UPDATE video SET statuss=$excelData[1],sort=$excelData[2],types='$excelData[3]',father='$excelData[5]',episode='$excelData[6]',episodes='$excelData[7]',region='$excelData[8]',year='$excelData[9]',director='$excelData[10]',actor='$excelData[11]',score='$excelData[12]',details='$excelData[13]',tag='$tagCurr',editor='$currUser' WHERE name='$name' ");// or die(mysqli_error($connect));
			}
		}
	}
	//改写排序数字，否则不连贯
	$sql = mysqli_query($connect, "UPDATE video set sort=sort+$row-1 ") or die(mysqli_error($connect));


	if ($sql) {
		echo "<script>alert('已成功将节目信息写入数据库！');location.href='update.php?'</script>";
		//	echo "<script>alert('已成功将节目信息写入数据库！');</script>";   
	} else {
		echo "<script>alert('导入失败！');location.href='update.php?'</script>";
	}
}










?>