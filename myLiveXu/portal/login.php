<?php
	/*
		见面版注册
	*/

	//	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	date_default_timezone_set("PRC");
	set_time_limit(0); //限制页面执行时间,0为不限制
	include_once('../connectMysql.php');

	$sn = $_POST['username'];
	$password = $_POST['password'];
	$ip = $_COOKIE['ip'];
	$city = $_COOKIE['city'];
	$loginTime =  date("Y-m-d");
	$expireTime = date("Y-m-d", strtotime("-1 day"));
	$lastTime = date("Y-m-d H:i:s"); 

	$sql = mysqli_query($connect,"select * from client where sn='$sn' ") or die(mysqli_error($connect));
	if( mysqli_num_rows($sql)>0 ){//如果数据库中有当前用户名,再检测密码
		$sql2 = mysqli_query($connect,"select * from client where sn='$sn' AND password='$password' ") or die(mysqli_error($connect));
		if( mysqli_num_rows($sql2)>0 ){	//密码正确
			$loginJson['status'] = "密码正确";
			echo json_encode($loginJson,true);
		}else{
			$loginJson['status'] = "密码错误";
			echo json_encode($loginJson,true);
		}
	}else{	//没有当前用户名，当作是新注册，直接记录密码，在数据库中添加该用户
		$sql = mysqli_query($connect, "replace into client(sn,mark,password,ip,city,loginTime,expireTime,lastTime,isOnLine) values ('$sn','$sn','$password','$ip','$city','$loginTime','$expireTime','$lastTime','在线')") or die(mysqli_error($connect));		
		$loginJson['status'] = "注册成功";
		echo json_encode($loginJson,true);
	}




?>   