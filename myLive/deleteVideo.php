<?php
//	header('Access-Control-Allow-Origin:*');
//	header("Content-type: text/html; charset=UTF-8");
	include_once "./connectMysql.php";
	ignore_user_abort(true);	//允许PHP后台运行
	$name = $_POST['name'];	
//	unlink($name);	//删除硬盘内的文件

	$path_parts['dirname'] = rtrim(substr($name, 0, strrpos($name, '/')),"/")."/";   //所在文件夹   
	$path_parts['extension'] = substr(strrchr($name, '.'), 1);   //扩展名
	$path_parts['basename'] = ltrim(substr($name, strrpos($name, '/')),"/");	//带扩展名的文件名
	$path_parts['filename'] = ltrim(substr($path_parts ['basename'], 0, strrpos($path_parts ['basename'], '.')),"/"); 		
	$nameShort = $path_parts ['filename'];//pathinfo($name, PATHINFO_FILENAME);//这个不支持中文

	
	exec('rm -rf '.$path_parts["dirname"] );

	function deleteEmptyDir($path){
		$dir = substr($path,0,strripos($path,"/") );	//欲删除文件所在的文件夹	
		$diff = array_diff(scandir($dir),array('..','.'));	//比较两个数组的差别，结果为空代表dir文件夹为空	
		if( sizeof($diff)==0 && $dir!="/usr/local/nginx/html/video" ){
			rmdir($dir); 	//删除空文件夹
			$dir2 = substr($dir,0,strripos($dir,"/") );	//欲删除文件所在的文件夹	
			$diff = array_diff(scandir($dir2),array('..','.'));	//比较两个数组的差别，结果为空代表dir文件夹为空	
			if( sizeof($diff)==0 && $dir2!="/usr/local/nginx/html/video"  ){
				deleteEmptyDir( $dir );
			}
		}
	}
//	deleteEmptyDir($name);
	
	//在数据库内删除该文件
	$sql = mysqli_query($connect,"DELETE FROM video WHERE name='$name' ") or die(mysqli_error()) ;
	$sql2 = mysqli_query($connect,"DELETE FROM collect WHERE name='$name' ") or die(mysqli_error()) ;
	$sql3 = mysqli_query($connect,"UPDATE history SET statuss=0 WHERE name='$name' ") or die(mysqli_error()) ;

	if( $sql ){
		$msg = '{"status":"succeed"}';
		echo $msg;
	}else{
		echo $path_parts["dirname"]."未知错误！";
	}











?>