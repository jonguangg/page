<?php
include "readStbArray.php";
//echo "<pre>";
//print_r($stbArr);
set_time_limit(0); //	设置超时时间，防止导入文件出错	

//echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

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
        $obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, '注册机顶盒信息导出时间：'.date('Y-m-d H:i:s'));  //设置合并后的单元格内容  
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
	console.log($fileName);
	echo $fileName;

    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');       

//	$_fileName = iconv("utf-8", "gb2312", $fileName);   //转码  
	$_fileName = iconv("utf-8", "utf-8", $fileName);   //用上面的，在xftp utf8格式时显示乱码
	$_savePath = $savePath.$_fileName.'.xlsx';  
	$objWrite->save($_savePath); 	//	下载表格文件到函数参数设置的路径
	
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
	exportExcel(array('机顶盒号','备注','登陆IP','登陆地区','注册时间',"到期时间","最近登陆","导出时是否在线"), $stbArr, '注册机顶盒信息导出文件_', './', true);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
<script>
	function getID(id){return document.getElementById(id);}
	window.setTimeout("location.href='update.php?from=excelExportStb?'+Math.random()",500);
</script>

</head>
<body>
	<div style="position:absolute;top:0px;left:0px;width:100%;height:100%;background:url(loading.gif); background-size:100% 100%;"></div>	
</body>
</html>