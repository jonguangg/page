#mySQL5.7脚本内不要写密码，直接改/etc/my.cnf
#[mysqldump]
#user=root
#password=10Star.925

time=` date +%Y%m%d_%H%M%S`
backupDir=/usr/local/nginx/html/myLive/backup/

/usr/local/mysql/bin/mysqldump myLive | gzip > $backupDir"myLive"$time.sql.gz 
find  $backupDir/ -name "myLive*.sql.gz" -type f -mtime +5 -exec rm {} \; > /dev/null 2>&1 

#crontab -e
#0 2 * * * /usr/local/nginx/html/myLive/backupMySQL5.7.sh
