<?php
//	连接数据库	
include "connectMysql.php";
set_time_limit(600); //	设置超时时间

//	定义需处理的excel文件
$fileName = $_COOKIE["randname"];	//	"./channelList.xlsx";

// 引入PHPExcel
require_once "./PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";

// 载入当前文件
$phpExcel = PHPExcel_IOFactory::load($fileName);

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
}else if( stripos($fileName,"ipCard") ){
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
}

?>
