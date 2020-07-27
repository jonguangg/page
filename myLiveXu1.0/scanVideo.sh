#00,05,10,15,20,25,30,35,40,45,50,55 * * * *
#/usr/bin/php /usr/local/nginx/html/myLive/downLine.php

#01,06,11,16,21,26,31,36,41,46,51,56 * * * * 
cd /usr/local/nginx/html/myLive
/usr/bin/php /usr/local/nginx/html/myLive/readDirList.php

#01,06,11,16,21,26,31,36,41,46,51,56 * * * * 
#chmod -R 777 /usr/local/nginx/html/nvod/video

