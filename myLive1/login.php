<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="expires" content="0">
<link rel="shortcut icon" href="portal/ic_launcher.png" type="image/x-icon">	<!-- 网页收藏夹图标 -->
<title>VC直播管理系统</title>
<style>
	*{background-size:100% 100% !important;color:yellow;}
	table{border-collapse:collapse;}
	td{border:1px #0066ff solid;height:25px;valign:middle;}
	a{text-decoration:none;}
	.button{width:100px;height:35px;color:blue;font-size:20px;}
	input{width:60%;height:25px;text-align:center;font-size:20px;color:black;}
</style>
</head>

<body onload="init();">
<div style="position:absolute;left:0px;top:0px;width:100%;height:100%;background:url(bg.png);"></div>
<div style="position:fixed;top:50px;left:50px;width:90%;text-align:left;font-size:25px;color:white;">VC直播管理系统</div>

<!-- 用户登陆 -->
<div id="login" style="position:absolute;top:25%;left:35%;width:20%; font-size:22px; text-align:center;">
    <form action="login.php" method="post" id="loginForm">
		<a style="width:100%;text-align:center;">用户登录</a></br></br>
		用户名：
		<input type="text" id="user" name="user" required="required" placeholder="请输入用户名" ></br></br>
		
		密&emsp;码：
		<input type="password" id="password" name="password" required="required" placeholder="请输入密码" ><br><br><br>
		
		<input type="submit" name="submitUser" value="提 交" style="position:absolute;width:40%;height:33px;left:0px;cursor:pointer;background-color:green;color:yellow;">
		
		<input type="reset" name="reset" value="重 置" style="position:absolute;width:40%;height:33px;right:0px;cursor:pointer;background-color:green;color:yellow;">
    </form>
</div>

</body>
</html>
<!-- script src="jquery-1.11.0.min.js"></script-->
<script>
function getID(id){return document.getElementById(id);}

function init(){
	getID('user').innerHTML = "";
	getID('password').innerHTML = "";
}

</script>

<?php
error_reporting(E_ALL^E_NOTICE);
include "connectMysql.php";
set_time_limit(0); //	设置超时时间

if( @$_POST['submitUser'] ){	  
    $user = $_POST['user'];
    $password = $_POST['password'];
	$queryUser = "select * from user where username='$user'";
	$resultUser = mysqli_query($connect,$queryUser);
	if( mysqli_fetch_assoc($resultUser) ){	//查询到用户，核对密码
	//	echo "<script>alert('有这个用户！');</script>";
		$queryPassword = "select password from user where username='$user'";//查询该用户密码的mysql命令
		$resultPassword = mysqli_fetch_assoc( mysqli_query( $connect,$queryPassword) );//先执行查询命令，再从结果集中取一行
		
		$queryMark = "select mark from user where username='$user'";//查询该用户密码的mysql命令
		$resultMark = mysqli_fetch_assoc( mysqli_query( $connect,$queryMark) );
		
		if( password_verify( $password,$resultPassword[password] ) ){	//密码一致，前面是用户输入的，后面是数据库中的 
			setCookie("currUser",$user);		//设置cookie，会话结束时失效
			setCookie("currUserMark",urlencode($resultMark[mark]));
			echo "<script>location.href='update.php'</script>";
		}else{//密码不一致
			echo "<script>alert('密码不正确！');</script>";
		}
	}else{	//没有这个用户，提示没有这个用户
		echo "<script>alert('没有这个用户！');</script>";    
	} 
}

?>