<?php
/*
$upload_path = "./"; //上传文件的存放路径
$file = $_FILES['img'];//得到传输的数据//得到文件名称
$name = $file['name'];
$type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
$allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型

$name = 'aaa.jpg';

//判断文件类型是否被允许上传
if(in_array($type, $allow_type)){//如果不被允许，则直接停止程序运行
    //判断是否是通过HTTP POST上传的
	if(!is_uploaded_file($file['tmp_name'])){//如果不是通过HTTP POST上传的
		return ;
	}
	
	//开始移动文件到相应的文件夹
	if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
		echo '<font style="font-size:30px; ">上传成功!</font>';
	}else{
		echo '<font style="font-size:30px; ">上传失败!</font>';
	}
}else{
	echo '<font style="font-size:30px; color:red;">图片格式不支持！只能上传jpg格式的图片</font>';
}
*/

header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai'); 

/* 解析获取php.ini 的upload_max_filesize（单位：byte）
 * @param $dec int 小数位数
 * @return float （单位：byte）
 * 
function get_upload_max_filesize_byte($dec=2){
    $max_size=ini_get('upload_max_filesize');
    preg_match('/(^[0-9\.]+)(\w+)/',$max_size,$info);
    $size=$info[1];
    $suffix=strtoupper($info[2]);
    $a = array_flip(array("B", "KB", "MB", "GB", "TB", "PB"));
    $b = array_flip(array("B", "K", "M", "G", "T", "P"));
    $pos = $a[$suffix]&&$a[$suffix]!==0?$a[$suffix]:$b[$suffix];
    return round($size*pow(1024,$pos),$dec);
}
echo get_upload_max_filesize_byte(2);
*/

//step 1 使用$_FILES['pic']["error"] 检查错误
if( isset($_GET["action"])&& $_GET["action"]=="excel" ){
	if( $_FILES["excelCard"]["error"] > 0){
		switch($_FILES["excelCard"]["error"]){
			case 1:
				echo "<script type='text/javascript'>alert('上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值：".ini_get('upload_max_filesize')."');history.back();</script>";
			break;
			case 2:
				echo "<script type='text/javascript'>alert('上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值：".($_POST['MAX_FILE_SIZE']/1024/1024)."M');history.back();</script>";
			break;
			case 3:
				echo "<script type='text/javascript'>alert('文件只有部分被上传');history.back();</script>";
			break;
			case 4:
				echo "<script type='text/javascript'>alert('没有文件被上传');history.back();</script>";
			break;
			default:
				echo "<script type='text/javascript'>alert('末知错误');history.back();</script>";
		}
		exit;
	}else{
	//	echo "<script type='text/javascript'>alert('没有错误');</script>";
	}
}
	
//step 2 使用$_FILES["pic"]["size"] 限制大小 单位是字节 2M=2000000 这一步应该取消掉，因为频道列表的excel文件可能很大，不能加大小限制，这里只是以前上传图片的步骤
$maxsize = 104857600;//1024=1K，1048576=1M
$maxSize = $maxsize/1024/1024;//加这个只是为了提示用户时用K作单位便于理解一些
if( $_FILES["excelCard"]["size"] > $maxsize ){
	echo "<script type='text/javascript'>alert('上传的文件太大，不能超过{$maxSize}M');history.back();</script>";
	exit;
}else{
//	echo "<script type='text/javascript'>alert('上传的文件没超过{$maxSize}K');history.back();</script>";
}

//step 3 使用文件的扩展名 限制文件类型 其实这一步可以不要，因为上传的input已经设置了accept=".xls,.xlsx" ，但是还是可以选择其它类型的文件，为了防止用户手贱，非要上传不支持的文件格式，所以加了这一步 
$allowtype = array("xls","xlsx");	//	设置允许的扩展名
$arr = explode(".", $_FILES["excelCard"]["name"]);//用点将上传的文件名分隔成数组
$kuoZhanMing = $arr[count($arr)-1];//取数组最后一个，即是上传文件的扩展名
if( !in_array($kuoZhanMing, $allowtype)){
	echo "<script type='text/javascript'>alert('这是不支持的扩展名\\n或者您上传的文件大小超过1G\\n只支持xls或xlsx格式的excel表格文件！');history.back();</script>";
	exit;
}else{
//	echo "<script type='text/javascript'>alert('这是支持的扩展名\\n只支持xls或xlsx格式的excel表格文件！');history.back();</script>";
}

//step 4 将让传后的文件名改名 
$fileimgweb= "./backup/";    
$randname  = "vipCard_".date("Y").date("m").date("d")."_".date("H").date("i").date("s")."_".rand(100, 999).".".$kuoZhanMing;
setCookie("randname", $randname, time()+3600);//	记录上传的excel文件名,给excelImpor.php读取
//将临时位置的文件移动到指定的目录上即可      
if(is_uploaded_file($_FILES["excelCard"]["tmp_name"])){
	if(move_uploaded_file($_FILES["excelCard"]["tmp_name"],$fileimgweb.$randname)){
	//	echo "<script type='text/javascript'>alert('上传成功');</script>";
		echo '<div style="position:absolute;top:0px;left:0px;width:100%;height:100%;background:url(loading.gif); background-size:100% 100%;"></div>';		
		echo "<script>location.href='excelImport.php'</script>";  
        exit;
	//	session_start();
	//	$_SESSION['images'] = $fileimgweb.$randname;
	}else{
		echo "<script type='text/javascript'>alert('上传失败');history.back();</script>";
	}
}else{
   echo"<script type='text/javascript'>alert('不是一个上传文件');history.back();</script>";
}
