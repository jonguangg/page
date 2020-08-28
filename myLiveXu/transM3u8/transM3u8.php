<?php
/*
    解析m3u8文件，下载其中的ts文件，删除历史ts文件，实时更新playlist.m3u8文件
*/
//  header('Content-Type: text/plain');
    header('Access-Control-Allow-Origin: *');
    date_default_timezone_set('PRC');
    set_time_limit(0);
    ignore_user_abort(true);
//  echo "<pre>";

    //  源m3u8链接地址
    $m3u8UrlArr = [
        "http://185.180.221.194:8278/2abf80faef/playlist.m3u8",
        "http://185.180.221.194:8278/5b22825b38/playlist.m3u8",
        "http://185.180.221.194:8278/6192529292/playlist.m3u8"
    ];

    //	遍历当前文件夹展示所有的文件和目录
    function list_file($dir){
        $temp = scandir($dir); //首先读取文件夹，得到该文件夹下文件和目录的数组
        if (sizeof($temp) == 2 && strlen($dir) > 36) {
            rmdir($dir); //删除空文件夹
        }
        $fileArr = array();
        foreach ($temp as $v) { 				//遍历文件夹，得到该文件夹内一级文件夹和文件名称$v
        //    $a = $dir . '/' . $v;				//补全文件路径
            $a = $v;
            if (is_dir($a)) {				//如果是文件夹则扫描该文件夹          
                if ($v == '.' || $v == '..') {	//判断是否为系统隐藏的文件.和..  如果是则跳过否则就继续往下走，防止无限循环在这里
                    continue;
                }
                $fileArr = array_merge($fileArr, list_file($a)); //因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
            } else {
                $tmp = explode('.', $a);
                $end = end($tmp);
                if (preg_grep("/$end/i", array('ts'))) {	//过滤非ts文件
                    array_push($fileArr, $a);	//将视频全路径写进数组
                }
            }
        }
        return $fileArr;
    }

/*  function curl_file_get_contents($durl){ //读取远程文件，据说这种方法比file_get_contents效率更高
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $durl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }
    $str = @file_get_contents("http://185.180.221.194:8278/2abf80faef/20081003007178.ts");  
    file_put_contents( './20081003007178.ts',$str );    //下载远程文件到本地，可以代替exec('wget … ')

    $str = curl_file_get_contents("http://185.180.221.194:8278/2abf80faef/20081003007179.ts");
    file_put_contents( './20081003007179.ts',$str );    //下载远程文件到本地，据说这种方法效率更高
*/

//    echo '开始循环m3u8：'.time().'<br>';
    for($j=0;$j<sizeof($m3u8UrlArr);$j++){    //  遍历所有m3u8源
    //  获取ts文件所在文件夹
        $delM3u8 = substr( $m3u8UrlArr[$j], 0, strrpos($m3u8UrlArr[$j],'/') ); //去掉最后的m3u8文件名
        $dirName = substr( $delM3u8, strrpos($delM3u8,'/')+1 );     //  不含路径的文件夹名称
        $dirHttp = rtrim(substr($m3u8UrlArr[$j], 0, strrpos($m3u8UrlArr[$j], '/')), "/") . "/";   // 含路径的文件夹
    
        //  创建文件夹
        if(!is_dir( $dirName)){
            mkdir( $dirName,0777);
        }
    
        //  解析m3u8文件内容
        $str = @file_get_contents($m3u8UrlArr[$j]);
        if( @file_get_contents($m3u8UrlArr[$j]) ){
            $str = $str;
        }else{
            $str = false;
        }

        if( $str ){//  将源m3u8内容写入本地playlistTemp.m3u8文件，供下载使用，不直接写入playlist是为了避免没下载完时，客户端却访问最新的playlist，导致无法播放
            file_put_contents( $dirName.'/playlistTemp.m3u8', $str );
        }else{
            $cTime = date("Y-m-d H:i:s");
            file_put_contents( './connectError', $cTime."_".$m3u8UrlArr[$j]." 连接失败".PHP_EOL ,FILE_APPEND);
        }
        
        $oldTsArr = list_file($dirName.'/');   //   已下载的ts文件 //  var_dump($oldTsArr);    
    //  $file = @fopen($m3u8UrlArr[$j], "r");    //打开网络m3u8文件，最好不要重复请求网络
        $file = @fopen('./'.$dirName.'/playlistTemp.m3u8', "r");    //打开本地m3u8文件
        $i=0;
    //    echo '开始循环ts：'.time().'<br>';
        while( !feof($file)){   //逐行读取，直到行尾，下载新的ts
            $tempStr = str_replace('./','',trim(fgets($file)));  //fgets()函数从文件指针中读取一行
            if( strstr($tempStr, '.ts') ){   //如果该行包含ts
                $newTsArr[$i]= $tempStr;    //记录新的ts，与已下载的对比，如果已下载的ts文件不在新m3u8中，则删之
                if( !in_array($tempStr,$oldTsArr) ){    //新解析到的ts文件不在已下载之中，则继续下载
                    file_put_contents( $dirName.'/'.$tempStr, "先写一个空的ts文件占位，防止下次重新下载" );
                //    exec('wget '.$dirHttp.$tempStr.' -O ./'.$dirName.'/'.$tempStr); 
                    $cmd = 'wget '.$dirHttp.$tempStr.' -O ./'.$dirName.'/'.$tempStr.' &';
                    pclose(popen($cmd,'r')); 
                //    echo $dirHttp.$tempStr.PHP_EOL;
                }
            }
            $i++;
        }
        fclose($file);

        if( $str ){ //  如果获取到了新的源m3u8就将新的m3u8内容写入本地playlist.m3u8文件，并删除过期的ts
            file_put_contents( $dirName.'/playlist.m3u8', $str );
            for($i=0;$i<sizeof($oldTsArr);$i++){  //  删除过期的ts
                if( !in_array($oldTsArr[$i],$newTsArr)){    //如果已下载的ts文件不在新m3u8中，则删之
                    exec('rm -rf '.$dirName.'/'.$oldTsArr[$i]);
                }
            }
        }    

    //    exec('rm -rf '.$dirName.'/playlist2.m3u8');

    }

    sleep(10);
//    echo '重新运行transM3u8.php：'.time().'<br>';
//    exec('nohup curl -i "http://128.1.160.114:925/transM3u8/transM3u8.php" >/dev/null 2>&1');
    $cmd2 = 'nohup curl -i "http://128.1.160.114:925/transM3u8/transM3u8.php" >/dev/null 2>&1';
    pclose(popen($cmd2,'r'));
    

//    exec('rm -rf m3*');


//   curl -i "http://128.1.160.114:925/transM3u8/transM3u8.php"
?>