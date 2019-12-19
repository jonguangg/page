<?php
	header('Access-Control-Allow-Origin:*');
	header('Content-type: application/json');
//	header("Content-type:text/html;charset=utf-8");

	$data = json_decode(file_get_contents("php://input"), true);
	$info = $data["jonguang"];  // 这个时候的info是一个字符串
    $result = json_decode($info);   // 这个时候的result已经被还原成对象

    print_r($result);
	echo '收到的内容为：'.$data;
	var_dump($info);
	echo $info;


?>