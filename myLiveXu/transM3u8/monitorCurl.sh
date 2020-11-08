#!/bin/sh
. /etc/profile
. ~/.bash_profile

cTime=`date "+%Y-%m-%d %H:%M:%S"`

if [ $( ps aux |grep "transM3u8.php" | sort -k 3 -rn |head |awk 'NR==1{print $3}' | awk '{print int($0)}' ) -gt 1 ]; then
    echo $cTime 'php-fpm CPU:'$(ps aux |grep "transM3u8.php" | sort -k 3 -rn |head |awk 'NR==1{print $3}') '重新启动PHP' >> /home/admin/web/www/transM3u8/error ;
    docker restart mPHP ;
elif [ $( ps -ef | grep -v grep | grep -c "transM3u8.php" ) -lt 2 ]; then
    echo $cTime "php脚本异常结束，重新启动transM3u8.php" >> /home/admin/web/www/transM3u8/error ;
    nohup curl -i "http://128.1.160.114:925/transM3u8/transM3u8.php" >/dev/null 2>&1 ;
#else
#    echo $(ps -ef | grep -v grep | grep "transM3u8.php" ) >> /home/admin/web/www/transM3u8/log ;
#    echo $cTime "nginx响应码:" $(curl -I -m 10 -o /dev/null -s -w %{http_code}  http://128.1.160.114:925/transM3u8/index.php ) >> /home/admin/web/www/transM3u8/log ;
#    nohup curl -i "http://128.1.160.114:925/transM3u8/test.php" >/dev/null 2>&1 ;
fi