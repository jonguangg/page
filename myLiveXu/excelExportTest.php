<?php
/** 
 * 定义导出excel的函数	 
 * @param array $title   标题行名称 
 * @param array $data   导出数据 
 * @param string $fileName 文件名 
 * @param string $savePath 保存路径 
 * @param $type   是否下载  false--保存   true--下载 
 * @return string   返回文件全路径 
 * @throws PHPExcel_Exception 
 * @throws PHPExcel_Reader_Exception 
*/ 
set_time_limit(600); //	设置超时时间，防止导入文件出错	

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
        $obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, '数据导出：'.date('Y-m-d H:i:s'));  //设置合并后的单元格内容  
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
    }     echo $fileName;

    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');    

    if(	$isDown){   //网页下载  
		ob_end_clean();
		ob_start();
		header('pragma:public');  
		header("Content-Disposition:attachment;filename=$fileName.xlsx"); //	提供给浏览器下载
		$objWrite->save('php://output');
//		exit;  // 	退出函数，不执行后续操作
    }     

	$_fileName = iconv("utf-8", "gb2312", $fileName);   //转码  
	$_savePath = $savePath.$_fileName.'.xlsx';  
	$objWrite->save($_savePath); 	//	下载表格文件到函数参数设置的路径
	return $savePath.$fileName.'.xlsx';  
}    

exportExcel(array('姓名','年龄',"性别"), array(array('a',21),array('b',23)), '生成的文件名', './', true);

?>