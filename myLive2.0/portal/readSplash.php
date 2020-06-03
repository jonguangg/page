<?php
header("Content-Type:text/html;charset=utf-8");
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
date_default_timezone_set('PRC'); // 切换到中国的时间
ignore_user_abort(true);	//允许PHP后台运行

	/*
	扫描splash文件夹内所有图片文件，返回数组供手机循环显示		
	*/
//	echo "<pre>";

//	遍历当前文件夹展示所有的文件和目录
function list_file($dir){
	$temp = scandir($dir); //首先读取文件夹，得到该文件夹下文件和目录的数组

	$splashArr = array();
	foreach ($temp as $v) { 				//遍历文件夹，得到该文件夹内一级文件夹和文件名称$v
		$a = $dir . '/' . $v;				//补全文件路径
		if (is_dir($a)) {				//如果是文件夹则扫描该文件夹          
			if ($v == '.' || $v == '..') {	//判断是否为系统隐藏的文件.和..  如果是则跳过否则就继续往下走，防止无限循环在这里
				continue;
			}
			//	echo "<font color='red'>$a</font></br>"; //把文件夹名输出
			$splashArr = array_merge($splashArr, list_file($a)); //因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
		} else {
			//	echo $a."</br>";
			$tmp = explode('.', $a);
			$end = end($tmp);
			if (preg_grep("/$end/i", array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {	//过滤非视频文件
				$aa = ltrim(substr($a, strrpos($a, '/')), "/");	//带扩展名的文件名
				array_push($splashArr, $aa);	//将全路径写进数组
			}
		}
	}
	return $splashArr;
}
	$splashArr = list_file("/usr/local/nginx/html/myLive/portal/splash");	//扫描路径下所有视频文件，得到数组

//	print_r($splashArr);





