nohup ffmpeg -re -i http://185.180.221.194:8278/2abf80faef/playlist.m3u8 -vcodec copy -vprofile baseline -acodec copy -ar 44100 -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/Warna >/dev/null 2>&1 &

nohup ffmpeg -re -i http://185.180.221.194:8278/5b22825b38/playlist.m3u8 -vcodec copy -vprofile baseline -acodec copy -ar 44100 -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/Supersports4HD >/dev/null 2>&1 &

nohup ffmpeg -re -i http://185.180.221.194:8278/6192529292/playlist.m3u8 -vcodec libx264 -vprofile baseline -acodec aac -ar 44100 -strict -2 -ac 1 -f flv -s 1280x720 -y rtmp://localhost:1935/show/HuanxiTai >/dev/null 2>&1 &

http://zhibo.hkstv.tv/livestream/mutfysrq/playlist.m3u8?wsSession=02fb23ce4b5cc72b541a64d5-158850904615014&wsIPSercert=530efd7e1bce06f6ff46bdc0d5d25f2c&wsMonitor=0




http://128.1.160.114:925/myhls/2abf80faef/playlist.m3u8

http://128.1.160.114:925/myhls/5b22825b38/playlist.m3u8

http://128.1.160.114:925/myhls/6192529292/playlist.m3u8



http://128.1.160.114:925/transM3u8/2abf80faef/playlist.m3u8

http://128.1.160.114:925/transM3u8/5b22825b38/playlist.m3u8

http://128.1.160.114:925/transM3u8/6192529292/playlist.m3u8


http://tenstar.synology.me:10025/transM3u8/3221225646/playlist.m3u8