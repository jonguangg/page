<?php
//header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=UTF-8");
error_reporting(0);// 关闭所有PHP错误报告
include_once "../connectMysql.php";
date_default_timezone_set("PRC");
$sn = ($_POST['sn'])?$_POST['sn']:$_COOKIE["sn"];
$soldTime = date("Y-m-d H:i:s");
$lastTime2 = date("Y-m-d H:i:s");	//机顶盒上一次打开APP的时间
function getIP(){	//获取用户真实 IP
	static $realip;
	if (isset($_SERVER)){
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR")){
			$realip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("HTTP_CLIENT_IP")) {
			$realip = getenv("HTTP_CLIENT_IP");
		} else {
			$realip = getenv("REMOTE_ADDR");
		}
	}
	if( strpos($realip,",")>0 ){//有两个IP
		$douHaoPos = strpos($realip,",");
		$realip = substr($realip,0,$douHaoPos);
	}
	return $realip;
}
	
function getCity(){			// 获取当前IP所在城市 
	$tpyApi = "http://whois.pconline.com.cn/ip.jsp?ip=".getIP();
	$city = file_get_contents($tpyApi);
	$city = iconv('GBK', 'UTF-8', $city);
	$city = trim($city);
	return $city;
}
$ip = getIP();//($_COOKIE["ip"])?$_COOKIE["ip"]:getIP();
$city = getCity();//($_COOKIE["city"])?$_COOKIE["city"]:getCity();
sleep(10);

if( $_POST['cardId'] ){//用户提交了卡号和密码
	$cardId = $_POST['cardId'];
	$cardKey = $_POST['cardKey'];
	
	$sql = mysqli_query($connect,"select * from client where sn='$sn' ") or die(mysqli_error($connect));//查找当前机顶盒

	if( mysqli_num_rows($sql)>0 ){//如果数据库中有当前机顶盒
	//	$sql = mysqli_query($connect,"select * from vipCard where cardId='$cardId' ") or die(mysqli_error($connect));//查找当前卡号
		$sql = mysqli_query($connect,"select * from vipCard where cardKey='$cardKey' ") or die(mysqli_error($connect));//查找当前卡密
		if( mysqli_num_rows($sql)>0 ){//如果数据库中有当前卡号
			$row = mysqli_fetch_array($sql);//sql查询数据集
			if( $cardKey == $row["cardKey"] ){//用户输入的key等于数据库中的key
				$licenseDays = $row["licenseDays"];
				$sql = mysqli_query($connect,"select * from client where sn='$sn' ") or die(mysqli_error($connect));//查找当前用户的授权到期日期
				$row = mysqli_fetch_array($sql);//sql查询数据集
				$expireTime = $row["expireTime"];//原到期时间
				if( strtotime( date("Y-m-d") ) > strtotime($expireTime)){//数据库的到期时间在当天之前，即早过期了，则授权日期从当天递加
					$expireTime = date("Y-m-d");
				}			
				$expireTime = date("Y-m-d", strtotime("+$licenseDays day", strtotime($expireTime)));//加上这次卡密授权时间后的到期时间
				
				$sql = mysqli_query($connect,"UPDATE client set expireTime='$expireTime' where sn='$sn' ") or die(mysqli_error($connect));
				if( $sql ){//成功更新了授权信息，返回信息给前端，并迁移当前卡号到已售表sold
					echo "Succeed".$intExpireTime."expireTime".$expireTime;		//授权成功后给机顶盒显示用
					$intExpireTime = str_replace("-","",$expireTime);			//为了便于比大小将时间内的-删掉
					$sql = mysqli_query($connect,"insert ignore sold(soldTime,sn,ip,city,cardId,licenseDays) values ('$soldTime','$sn','$ip','$city','$cardId','$licenseDays')") or die(mysqli_error($connect));
					if( $sql ){	//假如成功写入售出表
						$sql = mysqli_query($connect,"DELETE FROM vipCard WHERE cardId='$cardId' ") or die( mysqli_error($connect) );
					}
				}
			}else{
				echo "errorPIN code error !";//提示用户输入的密码不对
			}
		}else{
			echo "errorCard number error !";//提示用户卡输入的卡号不对
		}
	}	
}

if( $_POST['imOnlineSN'] ){//机顶盒自动上报在线状态
	echo '<script>alert("'.$lastTime2.'")</script>';
	$sn = $_POST['imOnlineSN'];
	$sql = mysqli_query($connect,"update client set isonline='在线' where sn='$sn' ") or die(mysqli_error()) ;
}

if( $_POST['imBackSN'] ){	//从后台切回来上报在线状态（解决IOS不退出浏览器，切回前面不上报的bug）
	$sn = $_POST['imBackSN'];
//	$ip = getIP();
//	$city = getCity();
	$sql = mysqli_query($connect, "UPDATE client set isOnLine='在线',ip='$ip',city='$city',lastTime='$lastTime2' where sn='$sn' ") or die(mysqli_error($connect));	 //更新登陆时间
	$sql2 = mysqli_query($connect, "INSERT INTO login SET sn='$sn',ip='$ip',city='$city' ") or die(mysqli_error($connect)); 	//记录登陆时间
}

if( $_POST['checkLicenseSN'] ){
	$sn = $_POST['checkLicenseSN'];	
	$expireTime = date("Y-m-d",strtotime("+1 day")); 	//初次安装的授权到期时间
	$sql = mysqli_query($connect,"select * from client where sn='$sn' ") or die(mysqli_error($connect));
	if( mysqli_num_rows($sql)>0 ){//如果数据库中有当前机顶盒
		while($row=mysqli_fetch_array($sql)){
			$expireTime = $row["expireTime"];						//从数据库获取真实的到期时间
			$intExpireTime = str_replace("-","",$expireTime);		//为了便于比大小将时间内的-删掉
			echo "Succeed".$intExpireTime."expireTime".$expireTime;
		}
	}
}




?>