<?php
header("Content-Type:text/html;charset=utf-8");
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
date_default_timezone_set('PRC'); // 切换到中国的时间
ignore_user_abort(true);	//允许PHP后台运行
include_once "connectMysql.php";
define('FFMPEG_CMD', 'ffmpeg -i "%s" 2>&1');	// 定义ffmpeg路径及命令常量
//define('FFMPEG_CMD', 'whoami');	// 定义ffmpeg路径及命令常量

/*
	先扫描文件内所有文件
	获取文件修改时间
	修改时间在上次运行ffmpeg的时间之后的
		如果数据库已有，就对比两个修改时间
			如果修改时间一样，说明上传完成，就启动ffmpeg，读取视频参数
			如果修改时间不同，说明没上传完，就更新时间
		如果数据库没有，就记录该文件名和修改时间	
	*/
//echo "<pre>";


//	遍历当前文件夹展示所有的文件和目录
function list_file($dir){
	$temp = scandir($dir); //首先读取文件夹，得到该文件夹下文件和目录的数组
	if (sizeof($temp) == 2 && strlen($dir) > 36) {
		rmdir($dir); //删除空文件夹
	}
	$fileArr = array();
	foreach ($temp as $v) { 				//遍历文件夹，得到该文件夹内一级文件夹和文件名称$v
		$a = $dir . '/' . $v;				//补全文件路径
		if (is_dir($a)) {				//如果是文件夹则扫描该文件夹          
			if ($v == '.' || $v == '..') {	//判断是否为系统隐藏的文件.和..  如果是则跳过否则就继续往下走，防止无限循环在这里
				continue;
			}
			//	echo "<font color='red'>$a</font></br>"; //把文件夹红名输出
			$fileArr = array_merge($fileArr, list_file($a)); //因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
		} else {
			//	echo $a."</br>";
			$tmp = explode('.', $a);
			$end = end($tmp);
			if (preg_grep("/$end/i", array('mp4', 'm4v', 'avi', 'flv', 'wmv', 'asf', 'ts', 'mpg', 'mpeg', 'vob', 'rmvb', 'rm', 'f4v', 'mkv', 'mov', 'qt', 'dat'))) {	//过滤非视频文件
				array_push($fileArr, $a);	//将视频全路径写进数组
			}
		}
	}
	return $fileArr;
}
	$fileArr = list_file("/usr/local/nginx/html/myLive1/upload");	//扫描路径下所有视频文件，得到数组
	print_r($fileArr);

function isEmptyDir($fp)
{
	$H = @opendir($fp);
	$i = 0;
	while ($_file = readdir($H)) {
		$i++;
	}
	closedir($H);
	if ($i > 2) {
		return "非空";
	} else {
		return "空";  //true
	}
}

function getVideoInfo($file)
{	//获取视频参数
	ob_start(); //开启缓存
	passthru(sprintf(FFMPEG_CMD, $file)); //将视频文件名放入ffmpeg命令串
	$video_info = ob_get_contents(); //从缓存中获取ffmpeg命令串
	ob_end_clean(); //清空缓存
	//	echo '未经处理的视频信息var_dump：<br>';
	//	var_dump($video_info);
	//	echo '未经处理的视频信息print_r：<br>';
		print_r($video_info);

	//	使用输出缓冲，获取ffmpeg所有输出内容
	$ret = array();

	// Duration: 00:33:42.64, start: 0.000000, bitrate: 152 kb/s
	if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $video_info, $matches)) {
		$ret['duration'] = $matches[1]; // 视频长度
		$duration = explode(':', $matches[1]);
		$ret['seconds'] = $duration[0] * 3600 + $duration[1] * 60 + $duration[2]; // 转为秒数
		$ret['start'] = $matches[2]; // 开始时间
		$ret['bitrate'] = $matches[3]; // bitrate 码率 单位kb
	}
	// Stream #0:1: Video: rv20 (RV20 / 0x30325652), yuv420p, 352x288, 117 kb/s, 15 fps, 15 tbr, 1k tbn, 1k tbc
	if (preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $video_info, $matches)) {
		$ret['vcodec'] = $matches[1];     // 编码格式
		$ret['vformat'] = $matches[2];    // 视频格式
		$ret['resolution'] = $matches[3]; // 分辨率
		list($width, $height) = explode('x', $matches[3]);
		$ret['width'] = $width;
		$ret['height'] = $height;
	}
	// Stream #0:0: Audio: cook (cook / 0x6B6F6F63), 22050 Hz, stereo, fltp, 32 kb/s
	if (preg_match("/Audio: (.*), (\d*) Hz/", $video_info, $matches)) {
		$ret['acodec'] = $matches[1];      // 音频编码
		$ret['asamplerate'] = $matches[2]; // 音频采样频率
	}
	if (isset($ret['seconds']) && isset($ret['start'])) {
		$ret['play_time'] = $ret['seconds'] + $ret['start']; // 实际播放时间
	}
	$ret['size'] = filesize($file); // 视频文件大小
	$video_info = iconv('gbk', 'utf8', $video_info);
	return array($ret, $video_info);
}

//	遍历文件数组，获取视频参数	
$fileInfoArr = array();
$fileInfoArrTemp = array();
$nowScanTime = date("Y-m-d H:i:s"); //此次扫描时间
//	echo "当前时间".strtotime($nowScanTime)."<br/>";

$sql = mysqli_query($connect, "select * from videoScanTime where id=1 ") or die(mysqli_error($connect));
while ($row = mysqli_fetch_array($sql)) {
	$lastScanTime = $row["lastScanTime"];		//从数据库获取上次扫描的时间
	//	echo "上次扫描时间".$lastScanTime."<br/>";
}

for ($i = 0; $i < count($fileArr); $i++) {
	$name = $fileArr[$i];
	$path_parts = array();
	$path_parts['dirname'] = rtrim(substr($name, 0, strrpos($name, '/')), "/") . "/";   //所在文件夹   
	//	$path_parts['extension'] = substr(strrchr($name, '.'), 1);   //扩展名
	$path_parts['basename'] = ltrim(substr($name, strrpos($name, '/')), "/");	//带扩展名的文件名
	$path_parts['filename'] = ltrim(substr($path_parts['basename'], 0, strrpos($path_parts['basename'], '.')), "/");
	$nameShort = $path_parts['filename']; //pathinfo($name, PATHINFO_FILENAME);//这个不支持中文
	$nameShort = str_replace(" ", "", $nameShort); //删除空格
	$name2 = '/usr/local/nginx/html/myLive1/vod/' . $nameShort . '/' . $path_parts['basename'];

//	echo '文件夹：' . $path_parts['dirname'] . '<br>' . '原路径：' . $name . '<br>' . '文件名：' . $nameShort . "<br/>" . '新路径：' . $name2 . '<br><br>';

	$filemtime = date("Y-m-d H:i:s", filemtime($fileArr[$i])); //内容改变时间	改名称，内容时间不变
	//	$filectime = date("Y-m-d H:i:s",filectime($fileArr[$i]));//索引改变时间	改内容，索引时间一起变
	//	$fileatime = date("Y-m-d H:i:s",fileatime($fileArr[$i]));//访问时间

	if (strtotime($filemtime) + 29999999 * 60 > strtotime($lastScanTime)) {	//文件时间在上上次获取视频参数之后，说明是新文件，因为第一次只记录文件名和上传时间，第二次再对比时间，所以要比较上上次的扫描时间
		$sql = mysqli_query($connect, "select * from video where name='$name2' ") or die(mysqli_error($connect));
		if (mysqli_num_rows($sql) > 0) {	//有这个文件
			//	echo $filemtime."<br/>";
			while ($row = mysqli_fetch_array($sql)) {
				$uploadTime = $row["uploadTime"];		//从数据库获取上次记录的上传时间（没传完的，每次扫描会更新时间）
			}
			if (strtotime($uploadTime) == strtotime($filemtime)) { //传完的文件，两个时间是一样的				
				//	调用ffmpeg获取视频信息，存进mysql
				$video_info = getVideoInfo($fileArr[$i]);
				if ($video_info[0]["seconds"] >0 ) { //只有能正常获取节目信息的时候才切片
					//	切片 
					$time = date("Y-m-d_H:i:s_");
					//	exec('mkdir ./vod/'.$nameShort.' && nohup ffmpeg -i '.$name.' -c copy -map 0 -f segment -segment_list ./vod/'.$nameShort.'/index.m3u8 ./vod/'.$nameShort.'/%03d.ts >  /dev/null 2>&1 &');

					exec('mkdir ./vod/' . $nameShort . ' && nohup ffmpeg -i ' . $name . ' -c copy -map 0 -f segment -segment_list ./vod/' . $nameShort . '/index.m3u8 ./vod/' . $nameShort . '/%03d.ts >> ./sliceLog/' . $time . $nameShort . '.log 2>&1 &');

					//截取图片
					exec('ffmpeg -ss 00:00:08  -i ' . $name . ' ./vod/' . $nameShort . '/poster.jpg -r 1 -vframes 1 -an -f mjpeg 1>/dev/null');

					$duration = $video_info[0]["duration"];
					echo $duration;
					$second = $video_info[0]["seconds"];
					$bitrate = $video_info[0]["bitrate"];
					$vcodec = $video_info[0]["vcodec"];
					$vformat = $video_info[0]["vformat"];
					$acodec = $video_info[0]["acodec"];
					$asamplerate = $video_info[0]["asamplerate"];
					$resolution = $video_info[0]["resolution"];
					$size = $video_info[0]["size"];
					if ($size > 1024 * 1024 * 1024) {
						$size = round(($size / 1024 / 1024 / 1024), 2) . "GB";
					} else if ($size > 1024 * 1024) {
						$size = round(($size / 1024 / 1024), 2) . "MB";
					} else {
						$size = round(($size / 1024), 2) . "KB";
					}

					//	将视频参数写进数据库	
					$sql = mysqli_query($connect, "replace into video(name,uploadTime,duration,second,bitrate,vcodec,vformat,acodec,asamplerate,resolution,size) values ('$name2','$filemtime','$duration','$second','$bitrate','$vcodec','$vformat','$acodec','$asamplerate','$resolution','$size')") or die(mysqli_error($connect));
					$fileInfoArrTemp["name"] = $name;
					//	$fileInfoArrTemp["filectime"] = $filectime;
					$fileInfoArrTemp["filemtime"] = $filemtime;
					//	$fileInfoArrTemp["fileatime"] = $fileatime;
					$fileInfoArrTemp["duration"] = $duration;
					$fileInfoArrTemp["second"] = $second;
					$fileInfoArrTemp["bitrate"] = $bitrate;
					$fileInfoArrTemp["vcodec"] = $vcodec;
					$fileInfoArrTemp["vformat"] = $vformat;
					$fileInfoArrTemp["acodec"] = $acodec;
					$fileInfoArrTemp["asamplerate"] = $asamplerate;
					$fileInfoArrTemp["resolution"] = $resolution;
					$fileInfoArrTemp["size"] = $size;
					array_push($fileInfoArr, $fileInfoArrTemp);

					//	移动视频文件到vod文件夹 并更新数据库内的文件路径
					//	exec('mv ' . $path_parts['dirname'] . $nameShort . '* ./vod/' . $nameShort . '/');
						exec('chmod -R 777 ./vod/' . $nameShort);
					//	或者删除
					exec('rm -f ' . $path_parts['dirname'] . $nameShort . '*' );
					$sql = mysqli_query($connect, "UPDATE video set name='$name2' where name='$name' ") or die(mysqli_error($connect));

					if (strlen($path_parts['dirname']) > 36 && isEmptyDir($path_parts['dirname']) == "空") { //删除空文件夹
						exec('rm -rf ' . $path_parts['dirname']);
					}
				}
			} else {	//没传完的，更新上传时间
				$sql = mysqli_query($connect, "UPDATE video set uploadTime='$filemtime' where name='$name2' ") or die(mysqli_error($connect));
			}
		} else {	//没有这个文件，就在数据库插入这个文件
			$sql = mysqli_query($connect, "replace into video(name,uploadTime) values ('$name2','$filemtime')") or die(mysqli_error($connect));
		}
	}
}
//每扫完一轮更改数据库记录的扫描时间
$sql = mysqli_query($connect, "UPDATE videoScanTime set lastScanTime='$nowScanTime' where id=1 ") or die(mysqli_error($connect));
//	print_r($fileInfoArr);
	
//	echo "<br>";
//	print_r($video_info);
//	echo '<br>提取出来的显示各个参数的数组：<br>';
//	print_r($video_info[0]);
//	echo $video_info[0]["seconds"];









//	另一种获取视频参数的方法，如果需要获取多个参数，就要多次执行不同的ffmpeg命令
/*
	$fileInfoArr2 = array();
	function getTime($file){
		$vtime = exec("ffmpeg -i ".$file." 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");//总长度
		$ctime = date("Y-m-d H:i:s",filectime($file));//创建时间
	//	$duration = explode(":",$vtime);
	//	$duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);//转化为秒
		return $vtime;
	}
	for($i=0;$i<sizeof($fileArr);$i++){
		$s = getTime($fileArr[$i]);
		array_push($fileInfoArr2,$s);
	}
	print_r($fileInfoArr2);
*/
