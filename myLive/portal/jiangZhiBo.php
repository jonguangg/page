<?php

	set_time_limit(0); 

	// 从文件中读取数据到PHP变量  
 //	$json_string = file_get_contents('json.json');
    $json_string = file_get_contents('http://api.hclyz.com:81/mf/json.txt');
      
    // 用参数true把JSON字符串强制转成PHP数组  
    $data = json_decode($json_string, true);
      
// 显示出来看看  
//	echo "<pre>";
//  var_dump($json_string); 
//  var_dump ($data); 
//  print_r($data); 

	$addressArr = array();
	$arr = array();
	$arrInit = array(
		"poster" => "",
		"url" => "",
		"title" => "",
	);
	$filename="/usr/local/nginx/html/jiangZhiBo/download/zhubo.txt";
	$filename1="/usr/local/nginx/html/jiangZhiBo/download/zhiBoArr1.js";

	//清空js文件
	$handle2=fopen($filename1,"w");
	$str1=fwrite($handle2,"");
	fclose($handle2);

	//写数组头
	$handle2=fopen($filename1,"a+");
	$str2=fwrite($handle2,"var listenArr = [\n");
	fclose($handle2);

	for( $i=0; $i<sizeof($data["pingtai"]); $i++ ){
	//	echo "http://api.hclyz.com:81/mf/".$data["pingtai"][$i]["address"]."<br><br>";
		$file = "http://api.hclyz.com:81/mf/".$data["pingtai"][$i]["address"];
		$title1 = $data["pingtai"][$i]["title"];
		$img1 = $data["pingtai"][$i]["xinimg"];
		$Number = $data["pingtai"][$i]["Number"];
		$json_string2 = file_get_contents($file); 
		$data2 = json_decode($json_string2, true);
	
	//	echo $data2["zhubo"][$i]["title"]."<br>";

//	下载原txt文件
//	exec('wget '.$file.' -O download/'.$i.'_'.$title1.'.txt'); 

		for( $j=0; $j<sizeof($data2["zhubo"]); $j++){		
			
			$handle=fopen($filename,"a+");

			$address = (@$data2["zhubo"][$j]["address"])?$data2["zhubo"][$j]["address"]:"无";
			$img = (@$data2["zhubo"][$j]["img"])?$data2["zhubo"][$j]["img"]:"无";
			$title2 = (@$data2["zhubo"][$j]["title"])?$data2["zhubo"][$j]["title"]:"无";
			
			//判断是否重复
			if( !in_array($address,$addressArr) ){
		//		拼接字符串，写入txt，便于转为excel
		//		$str=fwrite($handle,$j.",".$Number.",".$title1.",".$img1.','.$address.",".$img.",". $title2."\n");
				
				if( strpos($address,".m3u8") || strpos($address,"tmp:")  && !strpos($address,"lilaibuy") ){	//包含.m3u8和rtmp:
					//循环追加写json文件，得到zhiBo.js
					$handle2=fopen($filename1,"a+");
					$str2=fwrite($handle2,"'".$address."',"."\n");
					fclose($handle2);

					$arrInit["poster"] = $img;
					$arrInit["url"] = $address;
					$arrInit["title"] = $title2;

					array_push($arr,$arrInit);
					array_push($addressArr,$address);	//把不重复的地址加入临时数组，用于下次判断
				}
			}

			//扫描结束后给个提示
			if( $i==sizeof($data["pingtai"])-1 && $j==sizeof($data2["zhubo"])-1 ){
			//	$str2=fwrite($handle,"over!\n");
				echo "over!";
			}

			fclose($handle);
		}

	}


	//写json尾
	$handle2=fopen($filename1,"a+");
	$str2=fwrite($handle2,"]\n");
	fclose($handle2);


//	将数组格式化为json
	$json=json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//	将json写入文件，没有则新建，有会先清空之前的文件，
	file_put_contents('/usr/local/nginx/html/myLive/portal/js/zhiBoArr.js', 'var zhiBoArr = '.print_r($json, true) );











?>