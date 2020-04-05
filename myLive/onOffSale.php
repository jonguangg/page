<?php
/*
	获取分类上架节目
*/
	include_once('connectMysql.php');  
	ignore_user_abort(true);	//允许PHP后台运行
	$onOffArr = json_decode($_POST['onOffArr'],true);	  
//	echo sizeof($onOffArr);
	$onOff = $_POST['onOff'];	 
	$tagNow = $_POST['tagNow'];
	$editTime = date("Y-m-d H:i:s");
//	echo $tagNow.'<br>';

	for( $i=0;$i<sizeof($onOffArr);$i++ ){
		$sql = mysqli_query($connect,"UPDATE video set statuss='$onOff',editTime='$editTime' where name='$onOffArr[$i]' ") or die(mysqli_error($connect));//更新上架状态
	}

	if( $sql ){
	//	$msg = "\n提交成功";				//这样在error内用data.responseText接收
		$msg = '{"status":"succeed"}';	//这样在success内用data.status接收
		echo $msg;
	}

	

?>   