-- MySQL dump 10.13  Distrib 5.7.28, for linux-glibc2.12 (x86_64)
--
-- Host: localhost    Database: myLive
-- ------------------------------------------------------
-- Server version	5.7.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `channel`
--

DROP TABLE IF EXISTS `channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` tinyint(4) NOT NULL,
  `groupName` varchar(20) DEFAULT NULL,
  `channelId` int(11) NOT NULL,
  `channelName` varchar(255) NOT NULL,
  `videoUrl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel`
--

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;
INSERT INTO `channel` VALUES (1,0,'北邮央视',1,'CCTV1综合','http://ivi.bupt.edu.cn/hls/cctv1hd.m3u8'),(2,0,'北邮央视',2,'CCTV2财经','http://ivi.bupt.edu.cn/hls/cctv2.m3u8'),(3,0,'北邮央视',3,'CCTV3综艺','http://ivi.bupt.edu.cn/hls/cctv3hd.m3u8'),(4,0,'北邮央视',4,'CCTV4中文国际','http://ivi.bupt.edu.cn/hls/cctv4hd.m3u8'),(5,0,'北邮央视',5,'CCTV5+','http://ivi.bupt.edu.cn/hls/cctv5phd.m3u8'),(6,0,'北邮央视',6,'CCTV6电影','http://ivi.bupt.edu.cn/hls/cctv6hd.m3u8'),(7,0,'北邮央视',7,'CCTV7军事农业','http://ivi.bupt.edu.cn/hls/cctv7.m3u8'),(8,0,'北邮央视',8,'CCTV8电视剧','http://ivi.bupt.edu.cn/hls/cctv8hd.m3u8'),(9,0,'北邮央视',9,'CCTV9纪录','http://ivi.bupt.edu.cn/hls/cctv9.m3u8'),(10,0,'北邮央视',10,'CCTV10科教','http://ivi.bupt.edu.cn/hls/cctv10.m3u8'),(11,0,'北邮央视',11,'CCTV11戏剧','http://ivi.bupt.edu.cn/hls/cctv11.m3u8'),(12,0,'北邮央视',12,'CCTV12社会与法','http://ivi.bupt.edu.cn/hls/cctv12.m3u8'),(13,0,'北邮央视',13,'CCTV13新闻','http://ivi.bupt.edu.cn/hls/cctv13.m3u8'),(14,0,'北邮央视',14,'CCTV14少儿','http://ivi.bupt.edu.cn/hls/cctv14.m3u8'),(15,0,'北邮央视',15,'CCTV15音乐','http://ivi.bupt.edu.cn/hls/cctv15.m3u8'),(16,0,'北邮央视',16,'CCTV-NEWS','http://ivi.bupt.edu.cn/hls/cctv16.m3u8'),(17,0,'北邮央视',17,'CCTV17农业农村','http://ivi.bupt.edu.cn/hls/cctv17hd.m3u8'),(18,1,'北邮卫视',17,'安徽卫视','http://ivi.bupt.edu.cn/hls/ahtv.m3u8'),(19,1,'北邮卫视',18,'江西卫视','http://ivi.bupt.edu.cn/hls/jxtv.m3u8'),(20,1,'北邮卫视',19,'北京卫视','http://ivi.bupt.edu.cn/hls/btv1.m3u8'),(21,1,'北邮卫视',20,'东方卫视','http://ivi.bupt.edu.cn/hls/dftv.m3u8'),(22,1,'北邮卫视',21,'江苏卫视','http://ivi.bupt.edu.cn/hls/jstv.m3u8'),(23,1,'北邮卫视',22,'浙江卫视','http://ivi.bupt.edu.cn/hls/zjtv.m3u8'),(24,1,'北邮卫视',23,'湖南卫视','http://ivi.bupt.edu.cn/hls/hunantv.m3u8'),(25,1,'北邮卫视',24,'深圳卫视','http://ivi.bupt.edu.cn/hls/sztv.m3u8'),(26,1,'北邮卫视',25,'河南卫视','http://ivi.bupt.edu.cn/hls/hntv.m3u8'),(27,1,'北邮卫视',26,'陕西卫视','http://ivi.bupt.edu.cn/hls/sxtv.m3u8'),(28,1,'北邮卫视',27,'吉林卫视','http://ivi.bupt.edu.cn/hls/jltv.m3u8'),(29,1,'北邮卫视',28,'广东卫视','http://ivi.bupt.edu.cn/hls/gdtv.m3u8'),(30,1,'北邮卫视',29,'山东卫视','http://ivi.bupt.edu.cn/hls/sdtv.m3u8'),(31,1,'北邮卫视',30,'湖北卫视','http://ivi.bupt.edu.cn/hls/hbtv.m3u8'),(32,1,'北邮卫视',31,'广西卫视','http://ivi.bupt.edu.cn/hls/gxtv.m3u8'),(33,1,'北邮卫视',32,'河北卫视','http://ivi.bupt.edu.cn/hls/hebtv.m3u8'),(34,1,'北邮卫视',33,'西藏卫视','http://ivi.bupt.edu.cn/hls/xztv.m3u8'),(35,1,'北邮卫视',34,'内蒙古卫视','http://ivi.bupt.edu.cn/hls/nmtv.m3u8'),(36,1,'北邮卫视',35,'青海卫视','http://ivi.bupt.edu.cn/hls/qhtv.m3u8'),(37,1,'北邮卫视',36,'四川卫视','http://ivi.bupt.edu.cn/hls/sctv.m3u8'),(38,1,'北邮卫视',37,'天津卫视','http://ivi.bupt.edu.cn/hls/tjtv.m3u8'),(39,1,'北邮卫视',38,'山西卫视','http://ivi.bupt.edu.cn/hls/sxrtv.m3u8'),(40,1,'北邮卫视',39,'辽宁卫视','http://ivi.bupt.edu.cn/hls/lntv.m3u8'),(41,1,'北邮卫视',40,'厦门卫视','http://ivi.bupt.edu.cn/hls/xmtv.m3u8'),(42,1,'北邮卫视',41,'新疆卫视','http://ivi.bupt.edu.cn/hls/xjtv.m3u8'),(43,1,'北邮卫视',42,'黑龙江卫视','http://ivi.bupt.edu.cn/hls/hljtv.m3u8'),(44,1,'北邮卫视',43,'云南卫视','http://ivi.bupt.edu.cn/hls/yntv.m3u8'),(45,1,'北邮卫视',44,'东南卫视','http://ivi.bupt.edu.cn/hls/dntv.m3u8'),(46,1,'北邮卫视',45,'贵州卫视','http://ivi.bupt.edu.cn/hls/gztv.m3u8'),(47,1,'北邮卫视',46,'宁夏卫视','http://ivi.bupt.edu.cn/hls/nxtv.m3u8'),(48,1,'北邮卫视',47,'甘肃卫视','http://ivi.bupt.edu.cn/hls/gstv.m3u8'),(49,1,'北邮卫视',48,'重庆卫视','http://ivi.bupt.edu.cn/hls/cqtv.m3u8'),(50,1,'北邮卫视',49,'兵团卫视','http://ivi.bupt.edu.cn/hls/bttv.m3u8'),(51,1,'北邮卫视',50,'海南卫视','http://ivi.bupt.edu.cn/hls/lytv.m3u8'),(52,2,'北邮高清',51,'安徽卫视高清','http://ivi.bupt.edu.cn/hls/ahhd.m3u8'),(53,2,'北邮高清',52,'北京卫视高清','http://ivi.bupt.edu.cn/hls/btv1hd.m3u8'),(54,2,'北邮高清',53,'北京文艺高清','http://ivi.bupt.edu.cn/hls/btv2hd.m3u8'),(55,2,'北邮高清',54,'北京纪实高清','http://ivi.bupt.edu.cn/hls/btv11hd.m3u8'),(56,2,'北邮高清',55,'江苏卫视高清','http://ivi.bupt.edu.cn/hls/jshd.m3u8'),(57,2,'北邮高清',56,'浙江卫视高清','http://ivi.bupt.edu.cn/hls/zjhd.m3u8'),(58,2,'北邮高清',57,'湖南卫视高清','http://ivi.bupt.edu.cn/hls/hunanhd.m3u8'),(59,2,'北邮高清',58,'东方卫视高清','http://ivi.bupt.edu.cn/hls/dfhd.m3u8'),(60,2,'北邮高清',59,'黑龙江高清','http://ivi.bupt.edu.cn/hls/hljhd.m3u8'),(61,2,'北邮高清',60,'辽宁卫视高清','http://ivi.bupt.edu.cn/hls/lnhd.m3u8'),(62,2,'北邮高清',61,'深圳卫视高清','http://ivi.bupt.edu.cn/hls/szhd.m3u8'),(63,2,'北邮高清',62,'广东卫视高清','http://ivi.bupt.edu.cn/hls/gdhd.m3u8'),(64,2,'北邮高清',63,'天津卫视高清','http://ivi.bupt.edu.cn/hls/tjhd.m3u8'),(65,2,'北邮高清',64,'湖北卫视高清','http://ivi.bupt.edu.cn/hls/hbhd.m3u8'),(66,2,'北邮高清',65,'山东卫视高清','http://ivi.bupt.edu.cn/hls/sdhd.m3u8'),(67,2,'北邮高清',66,'重庆卫视高清','http://ivi.bupt.edu.cn/hls/cqhd.m3u8'),(68,2,'北邮高清',67,'CHC高清电影','http://ivi.bupt.edu.cn/hls/chchd.m3u8'),(69,2,'北邮高清',68,'CGTN高清','http://ivi.bupt.edu.cn/hls/cgtnhd.m3u8'),(70,2,'北邮高清',69,'CGTNDOC高清','http://ivi.bupt.edu.cn/hls/cgtndochd.m3u8'),(71,3,'北邮北京',68,'北京文艺','http://ivi.bupt.edu.cn/hls/btv2.m3u8'),(72,3,'北邮北京',69,'北京科教','http://ivi.bupt.edu.cn/hls/btv3.m3u8'),(73,3,'北邮北京',70,'北京影视','http://ivi.bupt.edu.cn/hls/btv4.m3u8'),(74,3,'北邮北京',71,'北京财经','http://ivi.bupt.edu.cn/hls/btv5.m3u8'),(75,3,'北邮北京',72,'北京生活','http://ivi.bupt.edu.cn/hls/btv7.m3u8'),(76,3,'北邮北京',73,'北京青年','http://ivi.bupt.edu.cn/hls/btv8.m3u8'),(77,3,'北邮北京',74,'北京新闻','http://ivi.bupt.edu.cn/hls/btv9.m3u8'),(78,3,'北邮北京',75,'北京体育','http://ivi.bupt.edu.cn/hls/btv6.m3u8'),(79,3,'北邮北京',76,'北京体育','http://ivi.bupt.edu.cn/hls/btv6hd.m3u8'),(80,4,'儿童动画',77,'南京少儿','http://live.nbs.cn/channels/njtv/sepd/m3u8:500k/live.m3u8'),(81,4,'儿童动画',78,'河北少儿','http://weblive.hebtv.com/live/hbse_bq/index.m3u8'),(82,4,'儿童动画',79,'福州少儿','http://live.zohi.tv/video/s10001-sepd-4/index.m3u8'),(83,4,'儿童动画',80,'福州少儿','http://live1.fzntv.cn/live/zohi_fztv4/playlist.m3u8'),(84,4,'儿童动画',81,'济南少儿','http://ts2.ijntv.cn/jnse/sd1/live.m3u8?_upt=c3e918011515232399'),(85,4,'儿童动画',82,'甘肃少儿','http://stream.gstv.com.cn/sepd/sd/live.m3u8'),(86,4,'儿童动画',83,'重庆少儿','http://219.153.252.50/PLTV/88888888/224/3221225625/chunklist.m3u8'),(87,4,'儿童动画',84,'重庆少儿','http://219.153.252.50/PLTV/88888888/224/3221225646/chunklist.m3u8'),(88,4,'儿童动画',85,'南方少儿TVS5','http://nclive.grtn.cn/tvs5/sd/live.m3u8'),(89,4,'儿童动画',86,'北京卡酷少儿','http://ivi.bupt.edu.cn/hls/btv10.m3u8'),(90,4,'儿童动画',87,'嘉佳卡通','http://nclive.grtn.cn/jjkt/sd/live.m3u8'),(91,4,'儿童动画',88,'炫动卡通','http://223.110.245.163/ott.js.chinamobile.com/PLTV/3/224/3221226388/index.m3u8'),(92,4,'儿童动画',89,'金鹰卡通 ','http://223.110.245.145/ott.js.chinamobile.com/PLTV/3/224/3221226303/index.m3u8'),(93,4,'儿童动画',90,'金鹰卡通3','http://223.82.250.72/live/jinyingkaton/1.m3u8'),(94,4,'儿童动画',91,'优漫卡通','http://223.110.243.171/PLTV/3/224/3221226982/index.m3u8'),(95,4,'儿童动画',92,'动漫秀场','http://183.207.249.15/PLTV/2/224/3221226037/index.m3u8'),(96,4,'儿童动画',93,'嘉佳卡通','http://183.207.249.9/PLTV/2/224/3221226099/index.m3u8'),(97,4,'儿童动画',94,'嘉佳卡通2','http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221226099/index.m3u8'),(98,4,'儿童动画',95,'卡卡少儿','http://223.110.245.143/ott.js.chinamobile.com/PLTV/3/224/3221226097/index.m3u8'),(99,4,'儿童动画',96,'喵咪Miao-Mi','https://d3kw4vhbdpgtqk.cloudfront.net/hls/miaomipcweb/prog_index.m3u8'),(100,4,'儿童动画',97,'Newtv动画王国1','http://183.207.249.15/PLTV/3/224/3221225555/index.m3u8'),(101,4,'儿童动画',98,'Newtv动画王国2','http://183.207.249.8/PLTV/3/224/3221225555/index.m3u8'),(102,4,'儿童动画',99,'CCTV-14','http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221225813/index.m3u8'),(103,4,'儿童动画',100,'CCTV-14','http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227201/index.m3u8'),(104,5,'体育频道',101,'博斯魅力','http://ms003.happytv.com.tw/live/OcScNdWHvBx5P4w3/index.m3u8'),(105,5,'体育频道',102,'五星体育','http://111.48.34.209/huaweicdn.hb.chinamobile.com/PLTV/2510088/224/3221225964/3.m3u8?icpid=88888888&from=1&ocs=2_111.48.34.209_80&hms_devid=443'),(106,5,'体育频道',103,'CCTV高尔夫网球','http://223.110.245.151/ott.js.chinamobile.com/PLTV/3/224/3221226420/index.m3u8'),(107,5,'体育频道',104,'NewTV搏击2','http://223.110.245.151/ott.js.chinamobile.com/PLTV/3/224/3221226803/index.m3u8'),(108,5,'体育频道',105,'百视通NBA1HD','http://223.110.243.170/PLTV/2/224/3221226795/index.m3u8'),(109,5,'体育频道',106,'百视通NBA2HD','http://223.110.243.170/PLTV/2/224/3221226797/index.m3u8'),(110,5,'体育频道',107,'百视通NBA3HD','http://223.110.243.170/PLTV/2/224/3221226799/index.m3u8'),(111,5,'体育频道',108,'百视通NBA4HD','http://223.110.243.170/PLTV/2/224/3221226801/index.m3u8'),(112,5,'体育频道',109,'百视通NBA5HD','http://223.110.243.170/PLTV/2/224/3221226803/index.m3u8'),(113,5,'体育频道',110,'百视通NBA6HD','http://223.110.243.170/PLTV/2/224/3221226805/index.m3u8'),(114,5,'体育频道',111,'百视通NBA7HD','http://223.110.243.170/PLTV/2/224/3221226807/index.m3u8'),(115,5,'体育频道',112,'百事通3','http://39.134.52.180/wh7f454c46tw3571653152_-2066612672/hwottcdn.ln.chinamobile.com/PLTV/88888890/224/3221226023/index.m3u8'),(116,5,'体育频道',113,'百事通5','http://39.134.52.172/wh7f454c46tw3633585374_215135606/hwottcdn.ln.chinamobile.com/PLTV/88888890/224/3221226027/index.m3u8'),(117,5,'体育频道',114,'百事通6','http://39.134.52.183/wh7f454c46tw3669132437_-1850260639/hwottcdn.ln.chinamobile.com/PLTV/88888890/224/3221226030/index.m3u8'),(118,6,'CCTV_1-4',115,'CCTV1_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv1_2/index.m3u8'),(119,6,'CCTV_1-4',116,'CCTV-1','http://223.110.245.147/ott.js.chinamobile.com/PLTV/3/224/3221226998/index.m3u8'),(120,6,'CCTV_1-4',117,'CCTV-1','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221225530/index.m3u8'),(121,6,'CCTV_1-4',118,'CCTV-1','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227462/index.m3u8'),(122,6,'CCTV_1-4',119,'CCTV-1','http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221226316/index.m3u8'),(123,6,'CCTV_1-4',120,'CCTV2_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv2_2/index.m3u8'),(124,6,'CCTV_1-4',121,'CCTV-2','http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227207/index.m3u8'),(125,6,'CCTV_1-4',122,'CCTV3_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv3_2/index.m3u8'),(126,6,'CCTV_1-4',123,'CCTV-3南京移动','http://183.207.249.6/PLTV/3/224/3221225588/index.m3u8'),(127,6,'CCTV_1-4',124,'CCTV-3','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227295/index.m3u8'),(128,6,'CCTV_1-4',125,'CCTV-3','http://223.110.245.167/ott.js.chinamobile.com/PLTV/3/224/3221226360/index.m3u8'),(129,6,'CCTV_1-4',126,'CCTV4_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv4_2/index.m3u8'),(130,6,'CCTV_1-4',127,'CCTV4','http://183.207.249.6/PLTV/3/224/3221225534/index.m3u8'),(131,6,'CCTV_1-4',128,'CCTV-4','http://112.50.243.7/PLTV/88888888/224/3221226511/index.m3u8'),(132,6,'CCTV_1-4',129,'CCTV-4','http://223.82.250.72/live/cctv-4/1.m3u8'),(133,7,'CCTV_56',130,'CCTV5_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv5_2/index.m3u8'),(134,7,'CCTV_56',131,'CCTV-5','http://223.110.245.139:80/PLTV/4/224/3221227298/index.m3u8'),(135,7,'CCTV_56',132,'CCTV-5','http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221226362/index.m3u8'),(136,7,'CCTV_56',133,'CCTV-5','http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221227401/index.m3u8'),(137,7,'CCTV_56',134,'CCTV-5','http://124.47.33.200/PLTV/88888888/224/3221225489/index.m3u8'),(138,7,'CCTV_56',135,'CCTV-5','http://124.47.33.211/PLTV/88888888/224/3221225489/index.m3u8'),(139,7,'CCTV_56',136,'CCTV5FHD4','http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227166/index.m3u8'),(140,7,'CCTV_56',137,'CCTV5FHD5','http://223.110.245.170/PLTV/3/224/3221227166/index.m3u8'),(141,7,'CCTV_56',138,'CCTV5+HD','http://183.207.249.6/PLTV/3/224/3221225604/index.m3u8'),(142,7,'CCTV_56',139,'CCTV5+','http://124.47.33.200/PLTV/88888888/224/3221225494/index.m3u8'),(143,7,'CCTV_56',140,'CCTV5+','http://124.47.33.211/PLTV/88888888/224/3221225494/index.m3u8'),(144,7,'CCTV_56',141,'CCTV-5+','http://223.110.245.139:80/PLTV/4/224/3221227480/index.m3u8'),(145,7,'CCTV_56',142,'CCTV6_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv6_2/index.m3u8'),(146,7,'CCTV_56',143,'CCTV-6','http://183.207.249.9/PLTV/3/224/3221225548/index.m3u8'),(147,7,'CCTV_56',144,'CCTV-6','http://223.110.245.139/ott.js.chinamobile.com/PLTV/3/224/3221227209/index.m3u8'),(148,7,'CCTV_56',145,'CCTV-6','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221225548/index.m3u8'),(149,7,'CCTV_56',146,'CCTV-6','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227209/index.m3u8'),(150,7,'CCTV_56',147,'CCTV-6','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227301/index.m3u8'),(151,7,'CCTV_56',148,'CCTV-6-1080p-1','http://117.169.79.106:8080/PLTV/88888888/224/3221225634/index.m3u8'),(152,7,'CCTV_56',149,'CCTV-6-1080p-3','http://223.110.245.172/PLTV/3/224/3221225548/index.m3u8'),(153,7,'CCTV_56',150,'CCTV-6-1080p-4','http://223.110.245.173/PLTV/3/224/3221225548/index.m3u8'),(154,8,'CCTV_789',151,'CCTV7_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv7_2/index.m3u8'),(155,8,'CCTV_789',152,'CCTV7','http://183.207.249.6/PLTV/3/224/3221225546/index.m3u8'),(156,8,'CCTV_789',153,'CCTV8_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv8_2/index.m3u8'),(157,8,'CCTV_789',154,'CCTV-8','http://223.110.245.139:80/PLTV/4/224/3221227304/index.m3u8'),(158,8,'CCTV_789',155,'CCTV-8','http://223.110.245.141/ott.js.chinamobile.com/PLTV/3/224/3221225866/index.m3u8'),(159,8,'CCTV_789',156,'CCTV-8','http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221227304/index.m3u8'),(160,8,'CCTV_789',157,'CCTV-8','http://223.110.245.167/ott.js.chinamobile.com/PLTV/3/224/3221227204/index.m3u8'),(161,8,'CCTV_789',158,'CCTV-8','http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227204/index.m3u8'),(162,8,'CCTV_789',159,'CCTV-8','http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227205/index.m3u8'),(163,8,'CCTV_789',160,'CCTV9','http://183.207.249.6/PLTV/3/224/3221225532/index.m3u8'),(164,8,'CCTV_789',161,'CCTV-9','http://112.50.243.7/PLTV/88888888/224/3221226566/index.m3u8'),(165,8,'CCTV_789',162,'CCTV-9','http://223.110.245.161/ott.js.chinamobile.com/PLTV/3/224/3221225868/index.m3u8'),(166,9,'CCTV_10-12',163,'CCTV10_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv10_2/index.m3u8'),(167,9,'CCTV_10-12',164,'CCTV-10','http://112.50.243.7/PLTV/88888888/224/3221225814/index.m3u8'),(168,9,'CCTV_10-12',165,'CCTV-10','http://112.50.243.7/PLTV/88888888/224/3221226488/index.m3u8'),(169,9,'CCTV_10-12',166,'CCTV-10','http://223.110.245.163/ott.js.chinamobile.com/PLTV/3/224/3221227317/index.m3u8'),(170,9,'CCTV_10-12',167,'CCTV-10','http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221225550/index.m3u8'),(171,9,'CCTV_10-12',168,'CCTV-10','http://223.110.245.170/PLTV/3/224/3221225550/index.m3u8'),(172,9,'CCTV_10-12',169,'CCTV11_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv11_2/index.m3u8'),(173,9,'CCTV_10-12',170,'CCTV-11','http://112.50.243.7/PLTV/88888888/224/3221226493/index.m3u8'),(174,9,'CCTV_10-12',171,'CCTV-11','http://223.110.245.153/ott.js.chinamobile.com/PLTV/3/224/3221227384/index.m3u8'),(175,9,'CCTV_10-12',172,'CCTV-11','http://223.82.250.72/live/cctv-11/1.m3u8'),(176,9,'CCTV_10-12',173,'CCTV12_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv12_2/index.m3u8'),(177,9,'CCTV_10-12',174,'CCTV-12','http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221226019/index.m3u8'),(178,9,'CCTV_10-12',175,'CCTV-12','http://223.110.245.163/ott.js.chinamobile.com/PLTV/3/224/3221225556/index.m3u8'),(179,9,'CCTV_10-12',176,'CCTV-12','http://223.110.245.170/PLTV/3/224/3221225556/index.m3u8'),(180,9,'CCTV_10-12',177,'CCTV-12','http://223.82.250.72/live/cctv-12/1.m3u8'),(181,10,'CCTV_13+',178,'CCTV13_myalicdn','http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8'),(182,10,'CCTV_13+',179,'CCTV-13','http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221226021/index.m3u8'),(183,10,'CCTV_13+',180,'CCTV-13','http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221225560/index.m3u8'),(184,10,'CCTV_13+',181,'CCTV-15','http://124.47.34.186/PLTV/88888888/224/3221225854/index.m3u8'),(185,10,'CCTV_13+',182,'CCTV-15','http://223.110.245.143/ott.js.chinamobile.com/PLTV/3/224/3221225817/index.m3u8'),(186,10,'CCTV_13+',183,'CCTV-15','http://223.110.245.143/ott.js.chinamobile.com/PLTV/3/224/3221226025/index.m3u8'),(187,10,'CCTV_13+',184,'CGNTV中文台','http://cgntv-glive.ofsdelivery.net/live/_definst_/cgntv_ch/playlist.m3u8'),(188,10,'CCTV_13+',185,'CCTV老故事','http://223.110.245.145/ott.js.chinamobile.com/PLTV/3/224/3221227043/index.m3u8'),(189,10,'CCTV_13+',186,'CCTV女性时尚','http://223.110.245.153/ott.js.chinamobile.com/PLTV/3/224/3221227026/index.m3u8'),(190,10,'CCTV_13+',187,'CGTN','http://112.50.243.7/PLTV/88888888/224/3221226509/index.m3u8'),(191,10,'CCTV_13+',188,'CGTN','https://live.cgtn.com/manifest.m3u8'),(192,10,'CCTV_13+',189,'CGTN-DOC','https://news.cgtn.com/resource/live/document/cgtn-doc.m3u8'),(193,11,'卫视备源',190,'安徽卫视3','http://223.110.245.147/ott.js.chinamobile.com/PLTV/3/224/3221225634/index.m3u8'),(194,11,'卫视备源',191,'北京卫视3','http://117.169.72.6:8080/ysten-businessmobile/live/hdbeijingstv/1.m3u8'),(195,11,'卫视备源',192,'北京卫视4','http://223.110.243.173/PLTV/3/224/3221227246/index.m3u8'),(196,11,'卫视备源',193,'东方卫视3','http://223.110.243.138/PLTV/3/224/3221227208/index.m3u8'),(197,11,'卫视备源',194,'福建卫视1','http://223.110.242.130:6610/cntv/live1/dongnanstv/1.m3u8'),(198,11,'卫视备源',195,'广东卫视2','http://183.207.249.9/PLTV/3/224/3221225592/index.m3u8'),(199,11,'卫视备源',196,'广东卫视5','http://nclive.grtn.cn/gdws/sd/live.m3u8?_upt=4fbd1f881539858465'),(200,11,'卫视备源',197,'广东卫视6','http://223.110.243.136/PLTV/3/224/3221227249/index.m3u8'),(201,11,'卫视备源',198,'广东卫视7','http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221225906/index.m3u8'),(202,11,'卫视备源',199,'广西卫视3','http://223.82.250.72/live/guangxistv/1.m3u8'),(203,11,'卫视备源',200,'贵州卫视3','http://223.82.250.72/live/guizhoustv/1.m3u8'),(204,11,'卫视备源',201,'贵州卫视4','http://m-tvlmedia.public.bcs.ysten.com/ysten-business/live/guizhoustv/1.m3u8'),(205,11,'卫视备源',202,'河北卫视3','http://223.82.250.72/live/hebeistv/1.m3u8'),(206,11,'卫视备源',203,'河北卫视4','http://weblive.hebtv.com/live/hbws_lc/index.m3u8'),(207,11,'卫视备源',204,'河南卫视1','http://121.31.30.90:8085/ysten-business/live/henanstv/1.m3u8'),(208,11,'卫视备源',205,'河南卫视4','http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221225815/index.m3u8'),(209,11,'卫视备源',206,'黑龙江1','http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221227323/index.m3u8'),(210,11,'卫视备源',207,'黑龙江2','http://223.110.243.169/PLTV/3/224/3221227252/index.m3u8'),(211,11,'卫视备源',208,'黑龙江3','http://117.169.72.6:8080/ysten-businessmobile/live/hdheilongjiangstv/1.m3u8'),(212,11,'卫视备源',209,'湖北卫视1','http://117.169.72.6:8080/ysten-businessmobile/live/hubeistv/1.m3u8'),(213,11,'卫视备源',210,'湖北卫视4','http://223.110.243.171/PLTV/3/224/3221227211/index.m3u8'),(214,11,'卫视备源',211,'湖南 RTMP','rtmp://58.200.131.2:1935/livetv/hunantv'),(215,11,'卫视备源',212,'湖南卫视3','http://117.169.72.6:8080/ysten-businessmobile/live/hdhunanstv/1.m3u8'),(216,11,'卫视备源',213,'湖南卫视4','http://223.110.243.173/PLTV/3/224/3221227220/index.m3u8'),(217,11,'卫视备源',214,'湖南卫视5','http://223.110.245.147/ott.js.chinamobile.com/PLTV/3/224/3221225908/index.m3u8'),(218,11,'卫视备源',215,'湖南卫视6','http://223.82.250.72/live/hdhunanstv/1.m3u8'),(219,11,'卫视备源',216,'厦门卫视','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221226996/index.m3u8'),(220,11,'卫视备源',217,'山东卫视2','http://117.169.72.6:8080/ysten-businessmobile/live/shandongstv/1.m3u8'),(221,11,'卫视备源',218,'山东卫视HD1','http://117.169.72.6:8080/ysten-businessmobile/live/hdshandongstv/1.m3u8'),(222,11,'卫视备源',219,'山东卫视HD2','http://223.110.243.171/PLTV/3/224/3221227258/index.m3u8'),(223,11,'卫视备源',220,'山东卫视HD3','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221226003/index.m3u8'),(224,11,'卫视备源',221,'山西卫视3','http://223.82.250.72/live/shanxistv/1.m3u8'),(225,11,'卫视备源',222,'陕西卫视3','http://223.82.250.72/live/shanxi1stv/1.m3u8'),(226,11,'卫视备源',223,'深圳卫视HD1','http://117.169.72.6:8080/ysten-businessmobile/live/hdshenzhenstv/1.m3u8'),(227,11,'卫视备源',224,'深圳卫视HD2','http://223.110.243.171/PLTV/3/224/3221227217/index.m3u8'),(228,11,'卫视备源',225,'深圳卫视HD3','http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221225997/index.m3u8'),(229,11,'卫视备源',226,'四川卫视HD','http://223.110.245.145/ott.js.chinamobile.com/PLTV/3/224/3221225814/index.m3u8'),(230,11,'卫视备源',227,'天津卫视3','http://223.110.243.170/PLTV/3/224/3221227212/index.m3u8'),(231,11,'卫视备源',228,'天津卫视4FHD','http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227212/index.m3u8'),(232,11,'卫视备源',229,'新疆卫视3','http://223.82.250.72/live/xinjiangstv/1.m3u8'),(233,11,'卫视备源',230,'云南卫视1','http://117.169.72.6:8080/ysten-businessmobile/live/yunnanstv/1.m3u8'),(234,11,'卫视备源',231,'浙江卫视FHD','http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227393/index.m3u8'),(235,11,'卫视备源',232,'浙江卫视HD','http://117.169.72.6:8080/ysten-businessmobile/live/hdzhejiangstv/1.m3u8'),(236,11,'卫视备源',233,'浙江卫视HD2','http://223.110.243.173/PLTV/3/224/3221227215/index.m3u8'),(237,11,'卫视备源',234,'重庆卫视3','http://223.82.250.72/live/chongqingstv/1.m3u8'),(238,12,'测试频道',235,'凤凰香港','http://183.207.249.35/PLTV/3/224/3221226975/index.m3u8'),(239,12,'测试频道',236,'凤凰中文','http://223.110.245.139/PLTV/3/224/3221226922/index.m3u8'),(240,12,'测试频道',237,'凤凰资讯','http://223.110.245.167/ott.js.chinamobile.com/PLTV/3/224/3221226923/index.m3u8'),(241,12,'测试频道',238,'凤凰资讯HD','http://117.169.120.138:8080/live/fhzixun/.m3u8'),(242,12,'测试频道',239,'澳亚卫视','http://stream.mastvnet.com/MASTV/sd/live.m3u8'),(243,12,'测试频道',240,'好消息综合台','http://live.streamingfast.net/osmflivech1.m3u8'),(244,12,'测试频道',241,'好消息真理台','http://live.streamingfast.net/osmflivech2.m3u8'),(245,12,'测试频道',242,'韩国GoodTV','rtmp://mobliestream.c3tv.com:554/live/goodtv.sdp'),(246,12,'测试频道',243,'GoodTV幸福家庭','http://live.streamingfast.net/osmflivech3.m3u8'),(247,12,'测试频道',244,'GoodTV生活台','http://live.streamingfast.net/osmflivech12.m3u8'),(248,12,'测试频道',245,'GoodTV美食旅游','http://live.streamingfast.net/osmflivech14.m3u8'),(249,12,'测试频道',246,'耀财财经','rtmp://202.69.69.180:443/webcast/bshdlive-pc'),(250,12,'测试频道',247,'耀才财经','http://fc_video.bsgroup.com.hk:443/webcast/bshdlive-pc/playlist.m3u8'),(251,12,'测试频道',248,'優視頻道','http://1-fss24-s0.streamhoster.com/lv_uchannel/_definst_/broadcast1/chunklist.m3u8'),(252,12,'测试频道',249,'優視頻道','http://1-fss24-s0.streamhoster.com/lv_uchannel/broadcast1/chunklist.m3u8'),(253,12,'测试频道',250,'RHK-31','http://rthklive1-lh.akamaihd.net/i/rthk31_1@167495/index_2052_av-b.m3u8'),(254,12,'测试频道',251,'RHK-312','http://rthklive1-lh.akamaihd.net:80/i/rthk31_1@167495/index_1296_av-b.m3u8'),(255,12,'测试频道',252,'环球电视台','http://live-cdn.xzxwhcb.com/hls/r86am856.m3u8'),(256,12,'测试频道',253,'Bloomberg TV','http://cdn-videos.akamaized.net/btv/desktop/akamai/europe/live/primary.m3u8'),(257,12,'测试频道',254,'KR-arirang','http://amdlive.ctnd.com.edgesuite.net/arirang_1ch/smil:arirang_1ch.smil/playlist.m3u8'),(258,12,'测试频道',255,'UK-SkyNews','http://skydvn-nowtv-atv-prod.skydvn.com/atv/skynews/1404/live/04.m3u8'),(259,12,'测试频道',256,'US-Newsmax','https://nmxlive.akamaized.net/hls/live/529965/Live_1/index.m3u8'),(260,12,'测试频道',257,'Al Jazeera','http://aljazeera-eng-apple-live.adaptive.level3.net/apple/aljazeera/english/appleman.m3u8'),(261,12,'测试频道',258,'Al Jazeera','http://aljazeera-eng-hd-live.hls.adaptive.level3.net/aljazeera/english2/index.m3u8'),(262,12,'测试频道',259,'IPTV-3+','http://117.156.28.119/270000001111/1110000051/index.m3u8'),(263,12,'测试频道',260,'IPTV-6+','http://117.156.28.119/270000001111/1110000055/index.m3u8'),(264,12,'测试频道',261,'IPTV-8+','http://117.156.28.119/270000001111/1110000057/index.m3u8'),(265,12,'测试频道',262,'IPTV-谍战剧场','http://117.156.28.119/270000001111/1110000110/index.m3u8'),(266,12,'测试频道',263,'IPTV-法治','http://117.156.28.119/270000001111/1110000111/index.m3u8'),(267,12,'测试频道',264,'IPTV-相声小品','http://117.156.28.119/270000001111/1110000112/index.m3u8'),(268,12,'测试频道',265,'第一财经2','https://w1live.livecdn.yicai.com/live/cbn.m3u8'),(269,12,'测试频道',266,'点掌财经2','http://cclive.aniu.tv/live/anzb.m3u8'),(270,12,'测试频道',267,'点掌财经3','http://cclive2.aniu.tv/live/anzb.m3u8'),(271,12,'测试频道',268,'东方财经2','http://w1.livecdn.yicai.com/hls/live/dftv_ld/live.m3u8'),(272,12,'测试频道',269,'清华大学电视台','http://v.cic.tsinghua.edu.cn/hls/tsinghuatv.m3u8'),(273,12,'测试频道',270,'戏曲梨园频道','http://117.158.206.60:9080/live/lypd.m3u8'),(274,12,'测试频道',271,'美国 RTMP 1','rtmp://ns8.indexforce.com/home/mystream'),(275,12,'测试频道',272,'美国 RTMP 2','rtmp://media3.scctv.net/live/scctv_800'),(276,12,'测试频道',273,'美国中文电视 RTMP','rtmp://media3.sinovision.net:1935/live/livestream'),(277,13,'江苏移动',274,'CETV1-2','http://223.110.245.143/ott.js.chinamobile.com/PLTV/3/224/3221227355/index.m3u8'),(278,13,'江苏移动',275,'NewTV精品电影','http://223.110.245.153/ott.js.chinamobile.com/PLTV/3/224/3221225567/index.m3u8'),(279,13,'江苏移动',276,'东方财经','http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221226033/index.m3u8'),(280,13,'江苏移动',277,'都市剧场','http://223.110.245.149/ott.js.chinamobile.com/PLTV/3/224/3221226029/index.m3u8'),(281,13,'江苏移动',278,'国学与家道','http://223.110.245.147/ott.js.chinamobile.com/PLTV/3/224/3221226392/index.m3u8'),(282,13,'江苏移动',279,'家庭理财','http://223.110.245.139:80/PLTV/4/224/3221227011/index.m3u8'),(283,13,'江苏移动',280,'南京教科','http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221227194/index.m3u8'),(284,13,'江苏移动',281,'上海纪实','http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221227420/index.m3u8'),(285,13,'江苏移动',282,'生活','http://223.110.245.153/ott.js.chinamobile.com/PLTV/3/224/3221227311/index.m3u8'),(286,13,'江苏移动',283,'新娱乐','http://223.110.245.141/ott.js.chinamobile.com/PLTV/3/224/3221227021/index.m3u8'),(287,13,'江苏移动',284,'幸福彩','http://223.110.245.163/ott.js.chinamobile.com/PLTV/3/224/3221227447/index.m3u8'),(288,13,'江苏移动',285,'影视剧','http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221227372/index.m3u8'),(289,13,'江苏移动',286,'置业','http://223.110.245.161/ott.js.chinamobile.com/PLTV/3/224/3221227037/index.m3u8'),(290,13,'江苏移动',287,'中国交通','http://223.110.245.161/ott.js.chinamobile.com/PLTV/3/224/3221227027/index.m3u8'),(291,13,'江苏移动',288,'中国气象','http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221227438/index.m3u8');
/*!40000 ALTER TABLE `channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `sn` varchar(255) NOT NULL,
  `mark` varchar(100) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `loginTime` date DEFAULT NULL,
  `expireTime` date DEFAULT NULL,
  `lastTime` datetime DEFAULT NULL,
  `isOnLine` varchar(10) DEFAULT NULL,
  `cardId` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`sn`),
  UNIQUE KEY `sn` (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES ('0800274F30AB020000000000','vivo vivo X9','59.37.97.52','广东省深圳市','2020-02-25','2020-02-26','2020-02-25 15:48:56','离线',NULL),('0C4933649E1304BA3666308E','HiSTBAndroidV5 PTV-8098','116.149.283.127','安徽池州','2019-08-01','2020-08-15','2019-08-27 17:46:56','离线',NULL),('1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','小米4','114.103.33.213','','2019-12-24','2024-09-12','2020-03-06 15:05:57','离线',NULL),('293c66612a6C7660D89DD5','KDDI KYT31','116.149.29.181','安徽省池州市','2020-02-28','1999-01-29','2020-03-01 08:01:26','离线',NULL),('293c66612a6C7660D89DD5KDDIKYT31','KDDI KYT31 ','114.106.188.10','安徽省池州市','2020-03-01','2021-03-06','2020-03-13 10:30:04','离线',NULL),('404a163764b4733c78a3','Xiaomi MI 3C','192.168.1.121','','2019-08-01','2020-08-05','2020-02-23 16:46:52','离线',NULL),('42952e700631b00f0800270E38B3020000000000','xiaomi Mi A1','103.82.219.79','吉隆坡XX','2019-11-05','2019-11-12','2019-11-15 21:55:59','离线',NULL),('459dca0a7d24F4F5DB387C3B','Redmi 4X','36.33.115.235','地球','2019-08-10','2020-08-08','2019-08-10 12:59:29','离线',NULL),('4827070016756C7660F4D11B','OYA Red ','116.149.29.181','安徽省池州市','2019-07-31','2020-01-01','2020-02-29 08:37:13','离线',NULL),('48610700351980739F00462B','HSB Gray','116.149.29.181','安徽省池州市','2019-07-31','2020-01-02','2020-02-29 08:36:39','离线',NULL),('4e71cd9b48FDA310EB02','Redmi Note 7','36.33.59.62','海王星','2019-07-31','2020-08-13','2019-07-31 23:14:48','离线',NULL),('513681e7C421C8ACA118','KDDI KYY23','116.149.29.181','安徽省池州市','2019-07-31','2020-01-24','2020-02-29 08:38:35','离线',NULL),('513681e7C421C8ACA118KDDIKYY23','KDDI KYY23','114.106.190.228','安徽省池州市','2020-03-01','2020-04-02','2020-03-12 10:43:19','离线',NULL),('525400123456googleNexus4','google_Nexus4','180.163.235.91','上海市','2020-03-03','2020-03-04','2020-03-03 11:29:51','离线',NULL),('5fa08c069E99A02746F39C99A02746F3','Xiaomi 2014112','116.149.31.252','冥王星','2019-08-10','2020-08-14','2019-08-10 08:04:20','离线',NULL),('7gb4cfc6027420c60800270E38B358EF1424E4B6','SM-G900F     ','113.111.48.17','广东广州','2019-11-10','2019-11-17','2019-11-14 15:32:50','离线',NULL),('7sz95tfirwz5badyD8CE3AD30A53','蒋昭洁     ','120.229.93.160','广东省深圳市','2020-02-25','2020-03-06','2020-02-29 22:29:54','离线',NULL),('7sz95tfirwz5badyD8CE3AD30A53RedmiRedmiNote8Pro','Redmi RedmiNote8Pro','120.229.96.136','广东省深圳市','2020-03-01','2020-03-19','2020-03-12 18:24:11','离线',NULL),('8b0b88adD86375AEA207','Xiaomi MI 6          ','116.149.29.181','安徽省池州市','2020-02-24','2020-03-01','2020-03-01 10:36:13','离线',NULL),('8b0b88adD86375AEA207XiaomiMI6','Xiaomi MI6 ','114.103.33.17','安徽省池州市','2020-03-01','2020-04-02','2020-03-14 16:33:18','离线',NULL),('9319d36d7d2b70BBE9E842AD','Redmi 6A','36.33.118.183','木星','2019-08-01','2020-08-10','2019-09-06 11:34:42','离线',NULL),('94772bfe5faa94772BFE5261','HuaweiY635','58.243.25.57','天王星','2019-07-20','2020-08-12','2019-07-28 22:30:22','离线',NULL),('a231ea567d942047daf3532c','Redmi 4A','36.34.24.200','火星','2019-08-01','2020-08-09','2019-08-02 10:58:12','离线',NULL),('b10bc3af38A4ED1BAE89','Xiaomi MI 5','116.149.29.181','安徽省池州市','2020-02-28','2020-03-01','2020-03-01 10:54:26','离线',NULL),('b10bc3af38A4ED1BAE89XiaomiMI5','Xiaomi MI5  ','58.243.254.220','安徽省合肥市','2020-03-01','2021-04-02','2020-03-10 23:18:14','离线',NULL),('cdf5f23408c570160800270E38B3','OnePlus ONEPLUS A3010','114.103.32.221','池州','2020-03-07','2020-03-14','2020-03-07 18:08:35','离线',NULL),('d5750gfb0gc5e0c70800270E38B3020000000000','OnePlus ONEPLUS A3010','114.103.34.212','安徽','2019-09-20','2019-09-27','2019-09-26 07:34:03','离线',NULL),('F01091990070321000003CDA2AD1802B3CDA2AD1802B04E67605FD8F','Mebox B860A','114.103.32.179','','2019-08-11','2019-08-16','2020-03-02 17:58:28','离线',NULL),('MSM8625QSKUD921D277F707A901D277FF07A','ZTE_N909','58.243.25.57','土星','2019-07-20','2020-08-11','2019-07-28 22:32:06','离线',NULL),('W8RDU1630800607850680a49896d','HONOR PLK-UL00','123.120.95.1','北京市','2020-02-26','2020-02-27','2020-02-26 01:13:31','离线',NULL),('W8RDU1630800607850680a49896dHONORPLK-UL00','HONOR_PLK-UL00','103.82.219.84','香港特别行政','2020-03-05','2020-03-06','2020-03-08 00:14:27','离线',NULL);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `groupId` tinyint(4) NOT NULL,
  `groupName` varchar(20) NOT NULL,
  UNIQUE KEY `groupId` (`groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (0,'北邮央视'),(1,'北邮卫视'),(2,'北邮高清'),(3,'北邮北京'),(4,'儿童动画'),(5,'体育频道'),(6,'CCTV_1-4'),(7,'CCTV_56'),(8,'CCTV_789'),(9,'CCTV_10-12'),(10,'CCTV_13+'),(11,'卫视备源'),(12,'测试频道'),(13,'江苏移动');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sold`
--

DROP TABLE IF EXISTS `sold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sold` (
  `soldTime` datetime DEFAULT NULL,
  `sn` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cardId` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `licenseDays` int(8) DEFAULT NULL,
  PRIMARY KEY (`cardId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sold`
--

LOCK TABLES `sold` WRITE;
/*!40000 ALTER TABLE `sold` DISABLE KEYS */;
INSERT INTO `sold` VALUES ('2019-12-25 11:07:32','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','中国湖北武汉','1',30),('2019-12-25 11:08:53','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','10',365),('2019-12-23 18:52:18','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','湖北省武汉市','1234567812345678',60),('2019-12-25 15:15:09','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','1577256551868400',1),('2019-12-25 15:57:30','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','1577256551868401',1),('2020-02-23 14:36:51','293c66612a6C7660D89DD5','192.168.1.120','','1577548008808700',1),('2020-02-23 14:39:11','513681e7C421C8ACA118','192.168.1.119','','1577548155549100',1),('2020-02-23 15:30:09','b10bc3af38A4ED1BAE89','192.168.1.109','','1577550468382500',11),('2020-02-25 15:12:29','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','1582558970523000',10),('2020-02-25 17:27:58','7sz95tfirwz5badyD8CE3AD30A53','120.229.93.134','广东省深圳市','1582558970523001',10),('2019-12-25 11:07:40','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','2',60),('2019-12-23 18:52:53','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','3',90),('2019-12-25 11:07:56','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','4',120),('2020-03-01 15:10:25','293c66612a6C7660D89DD5KDDIKYT31','116.149.29.181','安徽省池州市','46549426',1),('2020-03-01 15:13:40','293c66612a6C7660D89DD5KDDIKYT31','116.149.29.181','安徽省池州市','46549427',1),('2019-12-24 10:54:35','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','5',150),('2019-12-25 11:08:16','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','6',180),('2019-12-25 11:08:23','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','7',210),('2020-02-27 12:17:21','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','76514001',1),('2020-02-27 14:54:54','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','76514002',1),('2019-12-25 11:08:30','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','8',240),('2020-02-27 15:02:39','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','86922725',1),('2020-02-27 15:11:42','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','86922726',1),('2020-02-27 15:04:55','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','87054180',365),('2020-02-27 15:09:01','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','87054181',365),('2019-12-25 11:08:36','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','9',270),('2020-02-27 16:14:32','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','90821718',1),('2020-02-27 19:56:30','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','90821719',1),('2020-02-28 00:18:15','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','90821720',1),('2020-02-28 15:14:15','8b0b88adD86375AEA207','','','90821721',1),('2020-02-28 17:56:00','8b0b88adD86375AEA207','','','90821722',1),('2020-02-28 19:49:07','8b0b88adD86375AEA207','','','90821723',1),('2020-02-28 19:55:23','8b0b88adD86375AEA207','','','90821724',1),('2020-02-28 20:01:23','8b0b88adD86375AEA207','','','90821725 ',1),('2020-02-28 20:04:29','8b0b88adD86375AEA207','','','90821726',1),('2020-02-28 20:06:20','8b0b88adD86375AEA207','','','90821727',1),('2020-02-28 21:27:20','b10bc3af38A4ED1BAE89','116.149.29.181','安徽省池州市','96400781',1),('2020-02-28 21:46:05','b10bc3af38A4ED1BAE89','116.149.29.181','安徽省池州市','96400782',1),('2020-02-29 11:31:21','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400783',1),('2020-02-29 11:35:22','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400784',1),('2020-02-29 11:45:22','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400785',1),('2020-02-29 11:46:56','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400786',1),('2020-02-29 11:49:52','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400787',1),('2020-02-29 13:24:47','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400788',1),('2020-03-01 15:05:09','293c66612a6C7660D89DD5KDDIKYT31','116.149.29.181','安徽省池州市','96400789',1),('2020-03-01 15:07:23','293c66612a6C7660D89DD5KDDIKYT31','116.149.29.181','安徽省池州市','96400790',1);
/*!40000 ALTER TABLE `sold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagChinese`
--

DROP TABLE IF EXISTS `tagChinese`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagChinese` (
  `fileName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editor` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `editTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fileName`),
  KEY `tagChinese_ibfk_2` (`title`),
  CONSTRAINT `tagChinese_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagChinese_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagChinese`
--

LOCK TABLES `tagChinese` WRITE;
/*!40000 ALTER TABLE `tagChinese` DISABLE KEYS */;
INSERT INTO `tagChinese` VALUES ('/usr/local/nginx/html/myLive/vod/59s1/59s1.mp4','59秒没有声音',1,20,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/59s2/59s2.mp4','59秒有声音',1,21,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/64号病历.Journal.64.2018.HD1080P.X264.AAC.Danish.CHS.Mp4Ba1/64号病历.Journal.64.2018.HD1080P.X264.AAC.Danish.CHS.Mp4Ba1.mp4','广州转码视频测试',1,1,'admin','2020-03-12 18:16:48'),('/usr/local/nginx/html/myLive/vod/MV_1/MV_1.mp4','MTV 音乐视频 1',1,12,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_2/MV_2.mp4','MTV 音乐视频 2',1,13,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_3/MV_3.mp4','MTV 音乐视频 3',1,14,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_4/MV_4.mp4','MTV 音乐视频 4',1,15,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_5/MV_5.mp4','MTV 音乐视频 5',1,16,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_6/MV_6.mp4','MTV 音乐视频 6',1,17,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/Tshow/Tshow.mp4','T show party',1,30,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/avi/avi.mp4','24式太极教学视频 女',1,3,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/f4v/f4v.mp4','中国通史',1,19,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/lostStar/lostStar.mp4','MTV 音乐视频 7',1,18,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/mpg/mpg.mp4','24式太极教学视频 男',1,4,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/multiShow/multiShow.mp4','多画面演示视频',1,22,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2014/newYear2014.mp4','2014年新贺词',1,5,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2015/newYear2015.mp4','2015年新贺词',1,6,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2016/newYear2016.mp4','2016年新贺词',1,7,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2017/newYear2017.mp4','2017年新贺词',1,8,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2018/newYear2018.mp4','2018年新贺词',1,9,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2019/newYear2019.mp4','2019年新贺词',1,10,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2020/newYear2020.mp4','2020年新贺词',1,11,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/read1/read1.mp4','朗读',1,23,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/rmvb/rmvb.mp4','黄梅戏梁山泊与祝英台',1,24,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/series/series.mp4','电视剧',1,26,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/ts/ts.mp4','音乐演唱视频',1,29,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/variety/variety.mp4','好声音国庆演唱会',1,27,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/variety2/variety2.mp4','郭德纲单口相声',1,28,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/wmv/wmv.mp4','Win7高清演示视频',1,2,'admin','2020-03-09 14:22:31'),('/usr/local/nginx/html/myLive/vod/电影/电影.mp4','电影 荒岛求生',1,25,'admin','2020-03-09 13:14:46');
/*!40000 ALTER TABLE `tagChinese` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagEurUSA`
--

DROP TABLE IF EXISTS `tagEurUSA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagEurUSA` (
  `fileName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editor` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `editTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fileName`),
  KEY `tagEurUSA_ibfk_2` (`title`),
  CONSTRAINT `tagEurUSA_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagEurUSA_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagEurUSA`
--

LOCK TABLES `tagEurUSA` WRITE;
/*!40000 ALTER TABLE `tagEurUSA` DISABLE KEYS */;
INSERT INTO `tagEurUSA` VALUES ('/usr/local/nginx/html/myLive/vod/MV_1/MV_1.mp4','MTV 音乐视频 1',1,1,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_2/MV_2.mp4','MTV 音乐视频 2',1,2,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_3/MV_3.mp4','MTV 音乐视频 3',1,3,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_4/MV_4.mp4','MTV 音乐视频 4',1,4,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_5/MV_5.mp4','MTV 音乐视频 5',1,5,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/MV_6/MV_6.mp4','MTV 音乐视频 6',1,6,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/lostStar/lostStar.mp4','MTV 音乐视频 7',1,7,'admin','2020-03-09 13:14:46');
/*!40000 ALTER TABLE `tagEurUSA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagJapan`
--

DROP TABLE IF EXISTS `tagJapan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagJapan` (
  `fileName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editor` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `editTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fileName`),
  KEY `title` (`title`),
  CONSTRAINT `tagJapan_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJapan_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagJapan`
--

LOCK TABLES `tagJapan` WRITE;
/*!40000 ALTER TABLE `tagJapan` DISABLE KEYS */;
INSERT INTO `tagJapan` VALUES ('/usr/local/nginx/html/myLive/vod/newYear2014/newYear2014.mp4','2014年新贺词',1,1,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2015/newYear2015.mp4','2015年新贺词',1,2,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2016/newYear2016.mp4','2016年新贺词',1,3,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2017/newYear2017.mp4','2017年新贺词',1,4,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2018/newYear2018.mp4','2018年新贺词',1,5,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2019/newYear2019.mp4','2019年新贺词',1,6,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/newYear2020/newYear2020.mp4','2020年新贺词',1,7,'admin','2020-03-09 13:14:46');
/*!40000 ALTER TABLE `tagJapan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagMosaic`
--

DROP TABLE IF EXISTS `tagMosaic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagMosaic` (
  `fileName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editor` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `editTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fileName`),
  KEY `tagMosaic_ibfk_2` (`title`),
  CONSTRAINT `tagMosaic_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMosaic_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagMosaic`
--

LOCK TABLES `tagMosaic` WRITE;
/*!40000 ALTER TABLE `tagMosaic` DISABLE KEYS */;
INSERT INTO `tagMosaic` VALUES ('/usr/local/nginx/html/myLive/vod/59s1/59s1.mp4','59秒没有声音',1,2,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/59s2/59s2.mp4','59秒有声音',1,3,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/f4v/f4v.mp4','中国通史',1,1,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/multiShow/multiShow.mp4','多画面演示视频',1,4,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/read1/read1.mp4','朗读',1,5,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/rmvb/rmvb.mp4','黄梅戏梁山泊与祝英台',1,6,'admin','2020-03-09 13:14:46');
/*!40000 ALTER TABLE `tagMosaic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagNP`
--

DROP TABLE IF EXISTS `tagNP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagNP` (
  `fileName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editor` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `editTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fileName`),
  KEY `title` (`title`),
  CONSTRAINT `tagNP_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagNP_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagNP`
--

LOCK TABLES `tagNP` WRITE;
/*!40000 ALTER TABLE `tagNP` DISABLE KEYS */;
INSERT INTO `tagNP` VALUES ('/usr/local/nginx/html/myLive/vod/Tshow/Tshow.mp4','T show party',1,2,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/ts/ts.mp4','音乐演唱视频',1,1,'admin','2020-03-09 13:14:46');
/*!40000 ALTER TABLE `tagNP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagRole`
--

DROP TABLE IF EXISTS `tagRole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagRole` (
  `fileName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editor` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `editTime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fileName`),
  KEY `title` (`title`),
  CONSTRAINT `tagRole_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagRole_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagRole`
--

LOCK TABLES `tagRole` WRITE;
/*!40000 ALTER TABLE `tagRole` DISABLE KEYS */;
INSERT INTO `tagRole` VALUES ('/usr/local/nginx/html/myLive/vod/series/series.mp4','电视剧',1,2,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/variety/variety.mp4','好声音国庆演唱会',1,3,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/variety2/variety2.mp4','郭德纲单口相声',1,4,'admin','2020-03-09 13:14:46'),('/usr/local/nginx/html/myLive/vod/电影/电影.mp4','电影 荒岛求生',1,1,'admin','2020-03-09 13:14:46');
/*!40000 ALTER TABLE `tagRole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `role` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mark` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('1','admin','管理员','$2y$10$kzuT9aAjqkT4e1USI4.aj.swxQYoVag6zqf.NnrFzwhZoP.IiUuF.'),('0','superAdmin','admin','$2y$10$pspwipV28EPiRIyNrZVMSuym3xGrk72DZ6CXLuMQ5LqqHoSzEF/Cm'),('2','test','测试用户','$2y$10$gPrKdERFDHfy.87a80dB7OdwnlbEaRgdabZ4jazY2d9Q7E8ZvrK6C'),('0','戢永广','戢永广','$2y$10$tpozu09eMFk428Hp0sdorOrMzuc6Rqh.VY6VuH1hfCjpMb16KHncO');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT ' ',
  `tag` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `uploadTime` datetime DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `second` float DEFAULT NULL,
  `bitrate` int(11) DEFAULT NULL,
  `vcodec` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `vformat` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `acodec` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `asamplerate` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `resolution` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `id` (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (NULL,'/usr/local/nginx/html/myLive/vod/59s1/59s1.mp4','59秒没有声音','|中文|马赛克|','2020-03-11 08:37:34','00:00:59.17',59.17,219,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','764x492','1.55MB'),(NULL,'/usr/local/nginx/html/myLive/vod/59s2/59s2.mp4','59秒有声音','|中文|马赛克|','2020-03-10 21:57:22','00:00:59.84',59.84,244,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1182x556','1.74MB'),(NULL,'/usr/local/nginx/html/myLive/vod/64号病历.Journal.64.2018.HD1080P.X264.AAC.Danish.CHS.Mp4Ba1/64号病历.Journal.64.2018.HD1080P.X264.AAC.Danish.CHS.Mp4Ba1.mp4','广州转码视频测试','|中文|','2020-03-12 18:13:54','00:31:43.15',1903.15,2157,'h264 (High) (avc1 / 0x31637661)','yuv420p(tv','aac (LC) (mp4a / 0x6134706D)','44100','bt709)','489.58MB'),(NULL,'/usr/local/nginx/html/myLive/vod/MV_1/MV_1.mp4','MTV 音乐视频 1','|中文|欧美|','2020-03-06 13:57:33','00:03:10.06',190.06,876,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.86MB'),(NULL,'/usr/local/nginx/html/myLive/vod/MV_2/MV_2.mp4','MTV 音乐视频 2','|中文|欧美|','2020-03-06 13:57:32','00:03:37.34',217.34,642,'h264 (High) (avc1 / 0x31637661)','yuv420p(tv','aac (LC) (mp4a / 0x6134706D)','44100','bt709/unknown/bt709)','16.64MB'),(NULL,'/usr/local/nginx/html/myLive/vod/MV_3/MV_3.mp4','MTV 音乐视频 3','|中文|欧美|','2020-03-06 13:57:28','00:02:59.03',179.03,508,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','640x360','10.84MB'),(NULL,'/usr/local/nginx/html/myLive/vod/MV_4/MV_4.mp4','MTV 音乐视频 4','|中文|欧美|','2020-03-06 13:57:30','00:04:12.33',252.33,427,'h264 (High) (avc1 / 0x31637661)','yuv420p(tv','aac (HE-AAC) (mp4a / 0x6134706D)','48000','bt709)','12.85MB'),(NULL,'/usr/local/nginx/html/myLive/vod/MV_5/MV_5.mp4','MTV 音乐视频 5','|中文|欧美|','2020-03-06 13:57:27','00:01:30.54',90.54,853,'h264 (High) (avc1 / 0x31637661)','yuv420p(tv','aac (HE-AAC) (mp4a / 0x6134706D)','48000','bt709)','9.22MB'),(NULL,'/usr/local/nginx/html/myLive/vod/MV_6/MV_6.mp4','MTV 音乐视频 6','|中文|欧美|','2020-03-06 13:57:29','00:01:47.52',107.52,848,'h264 (High) (avc1 / 0x31637661)','yuv420p(tv)','aac (HE-AAC) (mp4a / 0x6134706D)','48000','864x486','10.87MB'),(NULL,'/usr/local/nginx/html/myLive/vod/Tshow/Tshow.mp4','T show party','|中文|多人|','2020-03-06 14:39:10','00:40:32.78',2432.78,1850,'h264 (High) (avc1 / 0x31637661)','yuv420p(tv','aac (LC) (mp4a / 0x6134706D)','44100','bt709)','536.57MB'),(NULL,'/usr/local/nginx/html/myLive/vod/avi/avi.mp4','24式太极教学视频 女','|中文|','2020-03-06 13:22:32','00:09:25.44',565.44,268,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','18.07MB'),(NULL,'/usr/local/nginx/html/myLive/vod/f4v/f4v.mp4','中国通史','|中文|马赛克|','2020-03-06 13:24:34','00:46:44.02',2804.02,849,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','283.8MB'),(NULL,'/usr/local/nginx/html/myLive/vod/lostStar/lostStar.mp4','MTV 音乐视频 7','|中文|欧美|','2020-03-06 19:12:12','00:03:46.26',226.26,783,'h264 (Main) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','768x432','21.13MB'),(NULL,'/usr/local/nginx/html/myLive/vod/mpg/mpg.mp4','24式太极教学视频 男','|中文|','2020-03-06 13:22:55','00:06:14.04',374.04,1112,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','49.6MB'),(NULL,'/usr/local/nginx/html/myLive/vod/multiShow/multiShow.mp4','多画面演示视频','|欧美|角色|','2020-03-06 13:24:12','00:19:36.56',1176.56,1371,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1272x712','192.36MB'),(NULL,'/usr/local/nginx/html/myLive/vod/newYear2014/newYear2014.mp4','2014年新贺词','|中文|日本|','2020-03-08 13:15:46','00:04:23.85',263.85,855,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (HE-AACv2) (mp4a / 0x6134706D)','48000','480x360','26.91MB'),(NULL,'/usr/local/nginx/html/myLive/vod/newYear2015/newYear2015.mp4','2015年新贺词','|中文|日本|','2020-03-06 14:14:38','00:09:34.55',574.55,849,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (HE-AACv2) (mp4a / 0x6134706D)','48000','480x360','58.18MB'),(NULL,'/usr/local/nginx/html/myLive/vod/newYear2016/newYear2016.mp4','2016年新贺词','|中文|日本|','2020-03-06 14:14:25','00:07:59.10',479.1,871,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (HE-AACv2) (mp4a / 0x6134706D)','48000','480x360','49.77MB'),(NULL,'/usr/local/nginx/html/myLive/vod/newYear2017/newYear2017.mp4','2017年新贺词','|中文|日本|','2020-03-06 14:15:09','00:10:02.05',602.05,1233,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','48000','720x576','88.55MB'),(NULL,'/usr/local/nginx/html/myLive/vod/newYear2018/newYear2018.mp4','2018年新贺词','|中文|日本|','2020-03-06 14:16:13','00:11:42.81',702.81,2111,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','48000','1920x1080','176.86MB'),(NULL,'/usr/local/nginx/html/myLive/vod/newYear2019/newYear2019.mp4','2019年新贺词','|中文|日本|','2020-03-06 14:16:19','00:12:11.93',731.93,2111,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','48000','1920x1080','184.25MB'),(NULL,'/usr/local/nginx/html/myLive/vod/newYear2020/newYear2020.mp4','2020年新贺词','|中文|日本|','2020-03-06 14:16:26','00:14:51.73',891.73,2057,'h264 (Main) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','48000','720x576','218.7MB'),(NULL,'/usr/local/nginx/html/myLive/vod/read1/read1.mp4','朗读','|中文|马赛克|','2020-03-06 14:40:34','01:00:00.84',3600.84,2015,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','48000','1280x720','865.06MB'),(NULL,'/usr/local/nginx/html/myLive/vod/rmvb/rmvb.mp4','黄梅戏梁山泊与祝英台','|中文|马赛克|','2020-03-06 14:34:24','00:23:41.02',1421.02,523,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','88.72MB'),(NULL,'/usr/local/nginx/html/myLive/vod/series/series.mp4','电视剧','|中文|角色|','2020-03-06 14:37:40','00:43:38.76',2618.76,1126,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','351.54MB'),(NULL,'/usr/local/nginx/html/myLive/vod/ts/ts.mp4','音乐演唱视频','|中文|多人|','2020-03-06 14:33:20','00:03:03.92',183.92,1127,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','24.71MB'),(NULL,'/usr/local/nginx/html/myLive/vod/variety/variety.mp4','好声音国庆演唱会','|中文|角色|','2020-03-06 19:46:37','01:40:56.61',6056.61,1741,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','1.23GB'),(NULL,'/usr/local/nginx/html/myLive/vod/variety2/variety2.mp4','郭德纲单口相声','|中文|角色|','2020-03-06 19:50:38','01:00:23.28',3623.28,1117,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','482.58MB'),(NULL,'/usr/local/nginx/html/myLive/vod/wmv/wmv.mp4','Win7高清演示视频','|中文|','2020-03-06 19:13:43','00:00:30.12',30.12,1136,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','4.08MB'),(NULL,'/usr/local/nginx/html/myLive/vod/电影/电影.mp4','电影 荒岛求生','|中文|角色|','2020-03-06 12:23:38','01:35:10.37',5710.37,1118,'h264 (High) (avc1 / 0x31637661)','yuvj420p(pc)','aac (LC) (mp4a / 0x6134706D)','44100','1280x720','761.07MB');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videoScanTime`
--

DROP TABLE IF EXISTS `videoScanTime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videoScanTime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastScanTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videoScanTime`
--

LOCK TABLES `videoScanTime` WRITE;
/*!40000 ALTER TABLE `videoScanTime` DISABLE KEYS */;
INSERT INTO `videoScanTime` VALUES (1,'2020-03-14 23:52:01');
/*!40000 ALTER TABLE `videoScanTime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vipCard`
--

DROP TABLE IF EXISTS `vipCard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vipCard` (
  `cardId` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cardKey` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `licenseDays` int(4) NOT NULL,
  PRIMARY KEY (`cardId`),
  UNIQUE KEY `cardId` (`cardId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vipCard`
--

LOCK TABLES `vipCard` WRITE;
/*!40000 ALTER TABLE `vipCard` DISABLE KEYS */;
INSERT INTO `vipCard` VALUES ('46549428','61092573',1),('46549429','20196387',1),('46549430','81265349',1),('46549431','02381547',1),('46549432','84501729',1),('46549433','62543079',1),('46549434','09723165',1),('46549435','48065372',1),('51703462','13052897',1),('51703463','96705218',1),('51703464','68931724',1),('51703465','94562378',1),('51703466','79036125',1),('51703467','18654209',1),('51703468','23418075',1),('51703469','31029756',1),('51703470','03458672',1),('51703471','41920578',1),('51703472','35026497',1);
/*!40000 ALTER TABLE `vipCard` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-16  2:00:01
