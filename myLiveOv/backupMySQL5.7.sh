#mySQL5.7脚本内不要写密码，直接改/etc/my.cnf
#[mysqldump]
#user=root
#password=123456

time=` date +%Y%m%d_%H%M%S`
backupDir=/usr/local/web/www/myLiveOv/backup/

#如果mysql不是安装在docker
#mysql5.7
#/usr/local/mysql/bin/mysqldump myLive | gzip > $backupDir"myLive"$time.sql.gz 
#mysql5.6
#/usr/local/mysql/bin/mysqldump -uroot -p123456 myLive | gzip > $backupDir"myLive"$time.sql.gz 




#如果mysql安装在docker,不能用-it,否则crontab执行结果为空
#mysql5.7
docker exec -i mMysql /usr/bin/mysqldump myLiveOv | gzip > $backupDir"myLiveOv_docker"$time.sql.gz

#mysql5.6
#docker exec -i mMysql /usr/bin/mysqldump -uroot -p123456 myLive | gzip > $backupDir"myLive_docker"$time.sql.gz


#删除5天前的，数字是几就表示保留当日前几天
find  $backupDir/ -name "myLive*.sql.gz" -type f -mtime +555 -exec rm {} \; > /dev/null 2>&1 



#crontab -e
#0 2 * * * /usr/local/nginx/html/myLive/backupMySQL5.7.sh
#0 2 * * * /usr/local/web/www/myLive/backupMySQL5.7.sh

#*/2 * * * * /usr/local/nginx/html/myLive/scanVideo.sh
#*/2 * * * * /usr/local/web/www/myLive/scanVideo.sh


