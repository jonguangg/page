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