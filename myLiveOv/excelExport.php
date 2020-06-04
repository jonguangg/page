<?php
	set_time_limit(0); //	设置超时时间，防止导入文件出错	
	
	$from = $_GET["from"];

	if( $from=="stb"){
		include "readStbArray.php";
		$fileInfo = "注册机顶盒信息_";
	}else if( $from=="sold"){
		include "readSoldArray.php";
		$fileInfo = "销售记录_";
	}else if( $from=="video"){
		include "readVideoArray.php";
		$fileInfo = "媒资信息_";
	}else if( $from=="vipCard" ){
		include "readVipCardArray.php";
		$fileInfo = "待售VIP卡信息_";
	}else if( $from=="addVipCard"){
		include "readVipCardArray.php";
		$fileInfo = "新生成VIP卡信息_";
	}else if( $from=="sale"){
		include "readTagArray.php";
		$tagNow = $_COOKIE['tagNow'];
		$fileInfo = substr($tagNow,3)."节目分类信息_";
	}
//echo "<pre>";
//	sleep(5);

function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){
    include('./PHPExcel-1.8/Classes/PHPExcel.php');  
    $obj = new PHPExcel();  

    //横向单元格标识 
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');        

    $obj->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称  
    $_row = 1;   //设置纵向单元格标识  
    if($title){  
        $_cnt = count($title);  
        $obj->getActiveSheet(0)->mergeCells('A'.$_row.':'.$cellName[$_cnt-1].$_row);   //合并单元格  
        $obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, $fileName.'导出时间：'.date('Y-m-d H:i:s'));  //设置合并后的单元格内容  
		$obj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$obj->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $_row++;  
        $i = 0;  
        foreach($title AS $v){   //设置列标题  
            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);  
            $i++;  
        }  
        $_row++;  
    }    

    //填写数据  
    if($data){  
        $i = 0;  
        foreach($data AS $_v){  
            $j = 0;   
		//	$obj->getActiveSheet()->getColumnDimension('$j')->setAutoSize(true);
            foreach($_v AS $_cell){  
                $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell); 
                $j++;  
            }  
            $i++;  
        }  
    }         

    //文件名处理  
    if(!$fileName){  
        $fileName = uniqid(time(),true);  
    }else{
		$fileName = $fileName.date("Ymd_His");
	}
//	console.log($fileName);
//	echo $fileName;

    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');       

//	$_fileName = iconv("utf-8", "gb2312", $fileName);   //转码  
	$_fileName = iconv("utf-8", "utf-8", $fileName);   //用上面的，在xftp utf8格式时显示乱码，不用这行，不显示文件名
	$_savePath = $savePath.$_fileName.'.xlsx';  
//	$objWrite->save($_savePath); 	//	下载表格文件到函数参数设置的路径
	
	if(	$isDown){   //网页下载  
		ob_end_clean();
		ob_start();
		header('pragma:public');  
		header("Content-Disposition:attachment;filename=$fileName.xlsx"); //	提供给浏览器下载
		$objWrite->save('php://output');
		exit;  // 	退出函数，不执行后续操作
    } 
	return $savePath.$fileName.'.xlsx';  	
}    


	if( $from=="stb"){
		exportExcel(array('机顶盒号','备注','登陆IP','登陆地区','注册时间',"到期时间","最近登陆","导出时是否在线"), $stbArr, $fileInfo, './', true);
	}else if( $from=="sold"){
		exportExcel(array('激活时间','客户号','登陆IP','登陆地区','VIP卡号',"授权天数"), $Arr, $fileInfo, './', true);
	}else if( $from=="video"){
		exportExcel(array('文件名','时长','秒数','码率','分辨率','视频编码',"视频格式","音频编码","音频采样率","视频大小","上传日期"), $Arr, $fileInfo, './', true);
	}else if( $from=="vipCard" ||  $from=="addVipCard"){
		exportExcel(array('卡号','卡密','授权天数'), $Arr, $fileInfo, './', true);
	}else if( $from=="sale"){
		exportExcel(array('排序','节目名','描述','在线状态','入库时间','操作者'), $Arr, $fileInfo, './', true);
	}
	  
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
<script>
//	window.setTimeout("location.href='http://www.baidu.com?update.php?'+Math.random()",5000);
</script>

</head>
<body>
	<div style="position:absolute;top:0px;left:0px;width:100%;height:100%;background:url(img/loading.gif); background-size:100% 100%;"></div>	
</body>
</html>