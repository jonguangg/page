<?php
	header('Access-Control-Allow-Origin:*');
	header('application/x-www-form-urlencoded');
//	header("Content-type:text/html;charset=utf-8");
//	header("Content-type:text/html;charset=utf-8");


if( @$_POST['jonguang'] ){
	$data = $_POST["jonguang"];  // 这个时候的info是一个字符串
	echo $data;
}else{
	echo 'no ajax data';
}
	echo "before";
	echo "<pre>";
	print_r($data);
	echo "</pre>";

	$result = json_decode($data);   // 这个时候的result已经被还原成对象
	
	echo "after json_decode";
	echo "<pre>";
	print_r($result);
	echo "</pre>";
