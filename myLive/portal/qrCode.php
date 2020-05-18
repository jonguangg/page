<?php
//在生成的二维码中加上logo(生成图片文件)
function scerweima($url = ''){
	$sn = $_COOKIE["sn"]; //机顶盒序列号（MAC地址和SN结合体）
	if (strlen($sn) < 1) {
		return;
	}
	$ip = $_COOKIE["ip"];
	$city = $_COOKIE["city"];
	require_once './phpqrcode-2010100721_1.1.4/phpqrcode.php';
	$value = $url;         //二维码内容
	$errorCorrectionLevel = 'H';  //容错级别
	$matrixPointSize = 6;      //生成图片大小
	//生成二维码图片
	$filename = "clientQr/$sn.png"; //microtime().
	if (file_exists($filename)) {	//如果该机顶盒的二维码已经存在了，就不重新生成
		return;
	}
	QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
	$logo = 'ic_launcher.png'; //准备好的logo图片
	$QR = $filename;      //已经生成的原始二维码图
	if (file_exists($logo)) {
		$QR = imagecreatefromstring(file_get_contents($QR));    //目标图象连接资源。
		$logo = imagecreatefromstring(file_get_contents($logo));  //源图象连接资源。
		$QR_width = imagesx($QR);      //二维码图片宽度
		$QR_height = imagesy($QR);     //二维码图片高度
		$logo_width = imagesx($logo);    //logo图片宽度
		$logo_height = imagesy($logo);   //logo图片高度
		$logo_qr_width = $QR_width / 4;   //组合之后logo的宽度(占二维码的1/5)
		$scale = $logo_width / $logo_qr_width;  //logo的宽度缩放比(本身宽度/组合后的宽度)
		$logo_qr_height = $logo_height / $scale; //组合之后logo的高度
		$from_width = ($QR_width - $logo_qr_width) / 2;  //组合之后logo左上角所在坐标点
		//重新组合图片并调整大小
		/*
		 * imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
		 */
		imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
	}
	//输出图片
	imagepng($QR, "clientQr/$sn.png");
	imagedestroy($QR);
	imagedestroy($logo);
	//	return '<img src="'.$sn.'.png" >';
}

//	include_once "rsa.php";	//RSA加解密
//	$rsa = new rsa();

// 私钥加密
//	$privEncrypt = $rsa->privEncrypt($sn);
//	echo $privEncrypt.PHP_EOL.PHP_EOL;

// 公钥解密
//	$publicDecrypt = $rsa->publicDecrypt($privEncrypt);
//	echo $publicDecrypt.PHP_EOL.PHP_EOL;

// 公钥加密
$publicEncrypt = $sn; //$rsa->publicEncrypt($sn);
//	echo $publicEncrypt.PHP_EOL.PHP_EOL;

// 私钥解密
//	$privDecrypt = $rsa->privDecrypt($publicEncrypt);
//	echo $privDecrypt.PHP_EOL.PHP_EOL;

//php get加号后显示为空格，这里将加号转为%2B
//	$snPriv = str_replace("+", "%2B",$privEncrypt); 
$snPub = str_replace("+", "%2B", $publicEncrypt);

//生成二维码
echo scerweima("http://tenstar.synology.me:10025/myLive/portal/mobilePostPIN.php?ip=" . $ip . "&city=" . $city . "&snPub=" . $snPub);
