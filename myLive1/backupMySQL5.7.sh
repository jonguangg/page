#mySQL5.7脚本内不要写密码，直接改/etc/my.cnf
#[mysqldump]
#user=root
#password=10Star.925
time=` date +%Y%m%d_%H%M%S`
/usr/local/mysql/bin/mysqldump myLive1 | gzip > /usr/local/nginx/html/myLive/myLive$time.sql.gz 
find /home/ -name "myLive*.sql.gz" -type f -mtime +5000 -exec rm {} \; > /dev/null 2>&1 myLive

#crontab -e
#0 2 * * * /usr/local/nginx/html/myLive/backupMySQL5.7.sh
