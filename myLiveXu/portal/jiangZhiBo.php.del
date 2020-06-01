<?php

	set_time_limit(0); 

//	从文件中读取数据到PHP变量  
//	$json_string = file_get_contents('json.json');
    $json_string = file_get_contents('http://api.hclyz.com:81/mf/json.txt');
      
//	用参数true把JSON字符串强制转成PHP数组  
    $data = json_decode($json_string, true);
      
//	显示出来看看  
//	echo "<pre>";
//	var_dump($json_string); 
//	var_dump ($data); 
//	print_r($data); 

	$zhuBoArr = array();

	for( $i=0; $i<sizeof($data["pingtai"]); $i++ ){
	//	echo "http://api.hclyz.com:81/mf/".$data["pingtai"][$i]["address"]."<br><br>";
		$file = "http://api.hclyz.com:81/mf/".$data["pingtai"][$i]["address"];
		$json_string2 = file_get_contents($file); 
		$data2 = json_decode($json_string2, true);

	//	下载原txt文件
	//	exec('wget '.$file.' -O download/'.$i.'_'.$title1.'.txt'); 

		for( $j=0; $j<sizeof($data2["zhubo"]); $j++){		
		
			$address = (@$data2["zhubo"][$j]["address"])?$data2["zhubo"][$j]["address"]:"无";
			$img = (@$data2["zhubo"][$j]["img"])?$data2["zhubo"][$j]["img"]:"无";
			$title2 = (@$data2["zhubo"][$j]["title"])?$data2["zhubo"][$j]["title"]:"无";
			
			//判断是否重复
			if( !in_array($address,$zhuBoArr) ){				
				array_push($zhuBoArr,$address);//把不重复的地址加入临时数组，用于下次判断
			}

		}

	}

//	将数组格式化为json
	$json=json_encode($zhuBoArr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//	将json写入文件，没有则新建，有会先清空之前的文件，
	file_put_contents('./zhiBo/listenZhuBo.js', 'var listenArr = '.print_r($json, true) );

	echo "<pre>";
	print_r($zhuBoArr);











?>