<?php
//header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=UTF-8");
include_once "../connectMysql.php";

	$ip = ($_COOKIE["ip"])?$_COOKIE["ip"]:"";
	$city = isset($_COOKIE["city"])?$_COOKIE["city"]:"";
	$soldTime = date("Y-m-d H:i:s");
	$sn = $_POST['sn'];
	
if( $_POST['cardId'] ){//用户提交了卡号和密码
	$cardId = $_POST['cardId'];
	$cardKey = $_POST['cardKey'];
	
	$sql = mysqli_query($connect,"select * from client where sn='$sn' ") or die(mysqli_error($connect));//查找当前机顶盒

	if( mysqli_num_rows($sql)>0 ){//如果数据库中有当前机顶盒
		$sql = mysqli_query($connect,"select * from vipCard where cardId='$cardId' ") or die(mysqli_error($connect));//查找当前卡号
		if( mysqli_num_rows($sql)>0 ){//如果数据库中有当前卡号
			$row = mysqli_fetch_array($sql);//sql查询数据集
			if( $cardKey == $row["cardKey"] ){//用户输入的key等于数据库中的key
				$licenseDays = $row["licenseDays"];
				$sql = mysqli_query($connect,"select * from client where sn='$sn' ") or die(mysqli_error($connect));//查找当前用户的授权到期日期
				$row = mysqli_fetch_array($sql);//sql查询数据集
				$expireTime = $row["expireTime"];//原到期时间
		 	//	$today = date("Y-m-d");			
				if( strtotime( date("Y-m-d") ) > strtotime($expireTime)){//数据库的到期时间在当天之前，即早过期了，是授权日期从当天递加
					$expireTime = date("Y-m-d");
				}			
				$expireTime = date("Y-m-d", strtotime("+$licenseDays day", strtotime($expireTime)));//加上这次卡密授权时间后的到期时间
				
				$sql = mysqli_query($connect,"UPDATE client set expireTime='$expireTime' where sn='$sn' ") or die(mysqli_error($connect));
				if( $sql ){//成功更新了授权信息，返回信息给前端，并迁移当前卡号到已售表sold
					echo "Succeed".$expireTime;//授权成功后给机顶盒显示用的
					$sql = mysqli_query($connect,"insert ignore sold(soldTime,sn,ip,city,cardId,licenseDays) values ('$soldTime','$sn','$ip','$city','$cardId','$licenseDays')") or die(mysqli_error($connect));
					if( $sql ){	//成功写入售出表
						$sql = mysqli_query($connect,"DELETE FROM vipCard WHERE cardId='$cardId' ") or die( mysqli_error() );
					}
				}
			}else{
				echo "errorPlease enter a right PIN code!";//提示用户输入的密码不对
			}
		}else{
			echo "errorPlease enter a right card number!";//提示用户卡输入的卡号不对
		}
	}	
}

if( $_POST['sn'] ){//机顶盒自动上报在线状态
	$sql = mysqli_query($connect,"update client set isonline='在线' where sn='$sn' ") or die(mysqli_error()) ;
}





?>
