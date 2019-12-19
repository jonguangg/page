<?php
include "connectMysql.php";
set_time_limit(30); //	设置超时时间，防止导入文件出错	

// 从json文件中读取数据到PHP变量 
$json_string = file_get_contents('getJsonArr.json'); 
   
// 用参数true把JSON字符串强制转成PHP数组 
$data = json_decode($json_string, true); 
   
// 显示出来看看 
	echo '<pre>';
//  var_dump($json_string); 
//	echo count($data["channelList"]);
//	var_dump ($data["channelList"]); 
//	var_dump ($data["channelList"][0]); 
//	var_dump ($data["channelList"][0]["channel"][0]["name"]); 
//  print_r($data); 

//循环遍历，将频道参数写进mysql数据库或excel表格
$channelArr = array(); //	定义一个新的数组接收所有数据
foreach($data["channelList"] as $key=>$value){
	echo "<pre>";
	$cuurGroupName = $value["group"];
	$cuurGroupId = $key;
//	print_r($value["group"]);
//	echo "<br>";
	foreach( $value["channel"] as $value){
		$value = array_merge(array('groupName' => $cuurGroupName), $value);	 //在关联数组前面插入频道名称
		$value = array_merge(array('groupId' => $cuurGroupId), $value);	 //在关联数组前面插入频道名称
	//	array_splice($value,0,0,$cuurGroupName);// 将每组内的频道组名放入时新的数组前面
		array_push($channelArr,$value);// 将每组内的频道放时新的数组
//		print_r($value["name"])."url:".print_r($value["videoUrl"]);
//		echo "<br>";
	}
}
	print_r( $channelArr );
	exportExcel(array(groupId,'groupName',channelId,'channelName','videoUrl'), $channelArr, '频道列表', './', true);	

//	定义导出excel的函数	
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
    }     

    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');    

    if(	$isDown){   //网页下载  
		ob_end_clean();
		ob_start();
//		header('pragma:public');  
//		header("Content-Disposition:attachment;filename=$fileName.xlsx");  //	提供给浏览器下载
//		$objWrite->save('php://output');
//		exit;  // 	退出函数，不执行后续操作
    }     

    $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码  
    $_savePath = $savePath.$_fileName.'.xlsx';  
	$objWrite->save($_savePath);    //	保存表格文件到函数参数设置的路径
	return $savePath.$fileName.'.xlsx';  
}    

//	exportExcel(array('姓名','年龄'), array(array('a',21),array('b',23)), '生成的文件名', './', true);
?>