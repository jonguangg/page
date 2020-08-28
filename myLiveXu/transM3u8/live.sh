nohup ffmpeg -i http://edge.linknetott.swiftserve.com/live/BsNew/amlst:bsworld/playlist.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a1 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://edge.metrotvnews.com:1935/live-edge/smil:metro.smil/playlist.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a2 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://edge.vediostream.com:80/abr/tvikim/live/tvikim_source/chunks.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a5 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://59d7d6f47d7fc.streamlock.net/canale51/canale51/playlist.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a7 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://210.210.155.66/h/h19/01.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/cctv1 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://210.210.155.66/h/h08/01.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a9 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://live.prd.go.th:1935/live/ch1_L.sdp/chunklist.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a10 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://cctvalih5ca.v.myalicdn.com/live/cctv4_2/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a11 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://cctvalih5ca.v.myalicdn.com/live/cctv5_2/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a12 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://111.40.205.87/PLTV/88888888/224/3221225689/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a13 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://cctvalih5ca.v.myalicdn.com/live/cctv6_2/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a14 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://cctvalih5ca.v.myalicdn.com/live/cctv7_2/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a15 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://cctvalih5ca.v.myalicdn.com/live/cctv8_2/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a16 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://111.40.205.76/PLTV/88888888/224/3221225734/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a17 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://cctvalih5ca.v.myalicdn.com/live/cctv10_2/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a18 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://cctvalih5ca.v.myalicdn.com/live/cctv11_2/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a19 >/dev/null 2>&1 &
sleep 5

nohup ffmpeg -i http://cctvalih5ca.v.myalicdn.com/live/cctv12_2/index.m3u8 -vcodec copy -vprofile baseline -acodec copy -strict -2 -ac 1 -f flv -y rtmp://localhost:1935/show/a20 >/dev/null 2>&1 &
sleep 5

#http://128.1.160.114:925/hls/a1.m3u8
#ffmpeg -re -stream_loop -1 -i /usr/local/nginx/html/lostStar.mp4 -vcodec copy -vprofile baseline -acodec copy -ar 44100 -strict -2 -ac 1 -f flv -s 1280x720 -y rtmp://localhost:1935/show/lostStar