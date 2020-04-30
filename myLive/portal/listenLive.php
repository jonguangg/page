<?php
	/*
		获取直播播放状态 并写入txt文件
	*/
    error_reporting(E_ALL^E_NOTICE^E_WARNING);

    $sn = $_COOKIE["sn"];
	
    $groupId = (@$_POST['groupId'])?$_POST['groupId']:"0";

    $groupName = (@$_POST['groupName'])?$_POST['groupName']:"";

    $channelId = (@$_POST['channelId'])?$_POST['channelId']:"0";

    $channelName = (@$_POST['channelName'])?$_POST['channelName']:"";

    $playUrl = (@$_POST['playUrl'])?$_POST['playUrl']:"";

    $playState = (@$_POST['playState'])?$_POST['playState']:0;

    $startTime = (@$_POST['startTime'])?$_POST['startTime']:0;

    function getMilliSecond(){//计算当前时间 精确到毫秒(13位),14位就乘以10000
        list($msec, $sec) = explode(' ', microtime());
        $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    	return $msectime;
    }
    $msectime = getMilliSecond();

//    echo $msectime;

    $filename="./戢无地方和影视v2r_".$sn.".txt";

    $handle=fopen($filename,"a+");

    $str=fwrite($handle,$groupId.",".$groupName.",".$channelId.",".$channelName.",".$playUrl.",".$playState.",". $startTime.",".$msectime.",".($msectime-$startTime)."\n");

    fclose($handle);



?>