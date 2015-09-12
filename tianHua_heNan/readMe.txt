key = {
        Up: 65362,
        Down: 65364,
        Left: 65361,
        Right: 65363,
        Ok: 65293,
        F1: 32,
        F2: 33,
        F3: 34,
        F4: 35,
        numb1: 49,
        numb2: 50,
        numb3: 51,
        numb4: 52,
        numb5: 53,
        numb6: 54,
        numb7: 55,
        numb8: 56,
        numb9: 57,
        numb0: 48,
        Mute: 63563,
        Back: 65367,
        Track: 65307,
        VolumeUp: 63561,
        VolumeDown: 63562,
        Fav: 36,
        PlayBack: 72,
		PageDown:26,
		PageUp:25,
		Menu:65360
    };


collect:left1065,top51,width71*height33
exit   :left1158,top51,width71*height33

nav  :left50  ,top114,width1270*heigth45
nav0 :left85  ,top114,width185 *height45
nav0 :left270 ,top114,width185 *height45
nav0 :left455 ,top114,width185 *height45
nav0 :left640 ,top114,width185 *height45
nav0 :left825 ,top114,width185 *height45
nav0 :left1010,top114,width185 *height45

loop:left52,top167,width547*height307

zone_img:left52,top517,width265*height153
zone_txt:left52,top486,width265*height31

new _img:left332,top517,width265*height153
new _txt:left332,top486,width265*height31

rank:left612,top200,width301*height317
hot :left928,top200,width301*height317

rank0:left612,top495,width301*height38.25
rank1:left612,top495,width301*height35.25
rank2:left612,top495,width301*height35.25
rank3:left612,top495,width301*height35.25
rank4:left612,top495,width301*height35.25

专区页
log        :left50  ,top50 ,width430 *heigth40
exit       :left1158,top53 ,width71  *height33,
nav        :left50  ,top100,width1270*heigth45
list       :left95  ,top155,width170 *heigth260
listBg_img :left95  ,top155,width170 *height225
listBg_txt :left95  ,top345,width170 *height35
listBg_play:left95  ,top380,width170 *height35
list_箭头  :left50  ,top415
listBg_img :left95  ,top430,width170 *height225
listBg_play:left95  ,top620,width170 *height35
listBg_txt :left95  ,top655,width170 *height35
list_间隔  :60

电影详情页
透明背景left:95;top:100;width:1090;heigth:355
推荐列表：left95,top455
主图：left:95px;top:100px;width:220px;height:300px;

电视选集页
left:95px;top:170px;width:395px;height:523px;

修改记录：
20150902
1、首页排行、热播新增加海报图随焦点切换
2、剧集页光标默认停留在上次点播过的那集
3、优化电影详情页代码，导演等动态数据直接写入div标签

20150906
1、导航支持小于6个
2、导航名称写入数组
3、图片地址写入数组，不需指定图片名称格式

20150907
1、修改剧集页少于30集时焦点问题
2、字符编码改为UTF-8
3、详情页影片介绍文字超长自动截断
4、电影详情页主演人数可以随便几行
5、电影详情页标题文字颜色改为样图一样的
6、调整图片尺寸
7、剧集页加入点评结果百分比

20150909
1、所有图片大小自适应
2、专区、新片加入链接

20150911
1、搜索页做了一半

20150912
1、搜索页结果列表做出来了
2、调整遥控键值，返回键可以随意写哪个页面
2.1 替换global.js文件
2.2 修改遥控按键代码