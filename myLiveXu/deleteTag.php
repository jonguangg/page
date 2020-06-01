<?php
/*
	删除分类节目
*/
	include_once('connectMysql.php');  
	ignore_user_abort(true);	//允许PHP后台运行
	
	$tagNow = $_POST['tagNow'];	
	$onOffArr = json_decode($_POST['onOffArr'],true);	
	
	//在数据库内删除该文件
	for( $i=0;$i<sizeof($onOffArr);$i++ ){
		$sql = mysqli_query($connect,"UPDATE video SET types='' WHERE name='$onOffArr[$i]' ") or die(mysqli_error()) ;
	}

	if( $sql ){
		$msg = '{"status":"succeed"}';
		echo $msg;
	}else{
		$msg = '{"status":"未知错误"}';
	}

?>