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
  `channelLogo` varchar(255) DEFAULT NULL,
  `videoUrl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel`
--

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;
INSERT INTO `channel` VALUES (1,0,'北邮央视',1,'CCTV1综合',NULL,'http://ivi.bupt.edu.cn/hls/cctv1hd.m3u8'),(2,0,'北邮央视',2,'CCTV2财经',NULL,'http://ivi.bupt.edu.cn/hls/cctv2.m3u8'),(3,0,'北邮央视',3,'CCTV3综艺',NULL,'http://ivi.bupt.edu.cn/hls/cctv3hd.m3u8'),(4,0,'北邮央视',4,'CCTV4中文国际',NULL,'http://ivi.bupt.edu.cn/hls/cctv4hd.m3u8'),(5,0,'北邮央视',5,'CCTV5+',NULL,'http://ivi.bupt.edu.cn/hls/cctv5phd.m3u8'),(6,0,'北邮央视',6,'CCTV6电影',NULL,'http://ivi.bupt.edu.cn/hls/cctv6hd.m3u8'),(7,0,'北邮央视',7,'CCTV7军事农业',NULL,'http://ivi.bupt.edu.cn/hls/cctv7.m3u8'),(8,0,'北邮央视',8,'CCTV8电视剧',NULL,'http://ivi.bupt.edu.cn/hls/cctv8hd.m3u8'),(9,0,'北邮央视',9,'CCTV9纪录',NULL,'http://ivi.bupt.edu.cn/hls/cctv9.m3u8'),(10,0,'北邮央视',10,'CCTV10科教',NULL,'http://ivi.bupt.edu.cn/hls/cctv10.m3u8'),(11,0,'北邮央视',11,'CCTV11戏剧',NULL,'http://ivi.bupt.edu.cn/hls/cctv11.m3u8'),(12,0,'北邮央视',12,'CCTV12社会与法',NULL,'http://ivi.bupt.edu.cn/hls/cctv12.m3u8'),(13,0,'北邮央视',13,'CCTV13新闻',NULL,'http://ivi.bupt.edu.cn/hls/cctv13.m3u8'),(14,0,'北邮央视',14,'CCTV14少儿',NULL,'http://ivi.bupt.edu.cn/hls/cctv14.m3u8'),(15,0,'北邮央视',15,'CCTV15音乐',NULL,'http://ivi.bupt.edu.cn/hls/cctv15.m3u8'),(16,0,'北邮央视',16,'CCTV-NEWS',NULL,'http://ivi.bupt.edu.cn/hls/cctv16.m3u8'),(17,0,'北邮央视',17,'CCTV17农业农村',NULL,'http://ivi.bupt.edu.cn/hls/cctv17hd.m3u8'),(18,1,'北邮卫视',17,'安徽卫视',NULL,'http://ivi.bupt.edu.cn/hls/ahtv.m3u8'),(19,1,'北邮卫视',18,'江西卫视',NULL,'http://ivi.bupt.edu.cn/hls/jxtv.m3u8'),(20,1,'北邮卫视',19,'北京卫视',NULL,'http://ivi.bupt.edu.cn/hls/btv1.m3u8'),(21,1,'北邮卫视',20,'东方卫视',NULL,'http://ivi.bupt.edu.cn/hls/dftv.m3u8'),(22,1,'北邮卫视',21,'江苏卫视',NULL,'http://ivi.bupt.edu.cn/hls/jstv.m3u8'),(23,1,'北邮卫视',22,'浙江卫视',NULL,'http://ivi.bupt.edu.cn/hls/zjtv.m3u8'),(24,1,'北邮卫视',23,'湖南卫视',NULL,'http://ivi.bupt.edu.cn/hls/hunantv.m3u8'),(25,1,'北邮卫视',24,'深圳卫视',NULL,'http://ivi.bupt.edu.cn/hls/sztv.m3u8'),(26,1,'北邮卫视',25,'河南卫视',NULL,'http://ivi.bupt.edu.cn/hls/hntv.m3u8'),(27,1,'北邮卫视',26,'陕西卫视',NULL,'http://ivi.bupt.edu.cn/hls/sxtv.m3u8'),(28,1,'北邮卫视',27,'吉林卫视',NULL,'http://ivi.bupt.edu.cn/hls/jltv.m3u8'),(29,1,'北邮卫视',28,'广东卫视',NULL,'http://ivi.bupt.edu.cn/hls/gdtv.m3u8'),(30,1,'北邮卫视',29,'山东卫视',NULL,'http://ivi.bupt.edu.cn/hls/sdtv.m3u8'),(31,1,'北邮卫视',30,'湖北卫视',NULL,'http://ivi.bupt.edu.cn/hls/hbtv.m3u8'),(32,1,'北邮卫视',31,'广西卫视',NULL,'http://ivi.bupt.edu.cn/hls/gxtv.m3u8'),(33,1,'北邮卫视',32,'河北卫视',NULL,'http://ivi.bupt.edu.cn/hls/hebtv.m3u8'),(34,1,'北邮卫视',33,'西藏卫视',NULL,'http://ivi.bupt.edu.cn/hls/xztv.m3u8'),(35,1,'北邮卫视',34,'内蒙古卫视',NULL,'http://ivi.bupt.edu.cn/hls/nmtv.m3u8'),(36,1,'北邮卫视',35,'青海卫视',NULL,'http://ivi.bupt.edu.cn/hls/qhtv.m3u8'),(37,1,'北邮卫视',36,'四川卫视',NULL,'http://ivi.bupt.edu.cn/hls/sctv.m3u8'),(38,1,'北邮卫视',37,'天津卫视',NULL,'http://ivi.bupt.edu.cn/hls/tjtv.m3u8'),(39,1,'北邮卫视',38,'山西卫视',NULL,'http://ivi.bupt.edu.cn/hls/sxrtv.m3u8'),(40,1,'北邮卫视',39,'辽宁卫视',NULL,'http://ivi.bupt.edu.cn/hls/lntv.m3u8'),(41,1,'北邮卫视',40,'厦门卫视',NULL,'http://ivi.bupt.edu.cn/hls/xmtv.m3u8'),(42,1,'北邮卫视',41,'新疆卫视',NULL,'http://ivi.bupt.edu.cn/hls/xjtv.m3u8'),(43,1,'北邮卫视',42,'黑龙江卫视',NULL,'http://ivi.bupt.edu.cn/hls/hljtv.m3u8'),(44,1,'北邮卫视',43,'云南卫视',NULL,'http://ivi.bupt.edu.cn/hls/yntv.m3u8'),(45,1,'北邮卫视',44,'东南卫视',NULL,'http://ivi.bupt.edu.cn/hls/dntv.m3u8'),(46,1,'北邮卫视',45,'贵州卫视',NULL,'http://ivi.bupt.edu.cn/hls/gztv.m3u8'),(47,1,'北邮卫视',46,'宁夏卫视',NULL,'http://ivi.bupt.edu.cn/hls/nxtv.m3u8'),(48,1,'北邮卫视',47,'甘肃卫视',NULL,'http://ivi.bupt.edu.cn/hls/gstv.m3u8'),(49,1,'北邮卫视',48,'重庆卫视',NULL,'http://ivi.bupt.edu.cn/hls/cqtv.m3u8'),(50,1,'北邮卫视',49,'兵团卫视',NULL,'http://ivi.bupt.edu.cn/hls/bttv.m3u8'),(51,1,'北邮卫视',50,'海南卫视',NULL,'http://ivi.bupt.edu.cn/hls/lytv.m3u8'),(52,2,'北邮高清',51,'安徽卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/ahhd.m3u8'),(53,2,'北邮高清',52,'北京卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/btv1hd.m3u8'),(54,2,'北邮高清',53,'北京文艺高清',NULL,'http://ivi.bupt.edu.cn/hls/btv2hd.m3u8'),(55,2,'北邮高清',54,'北京纪实高清',NULL,'http://ivi.bupt.edu.cn/hls/btv11hd.m3u8'),(56,2,'北邮高清',55,'江苏卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/jshd.m3u8'),(57,2,'北邮高清',56,'浙江卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/zjhd.m3u8'),(58,2,'北邮高清',57,'湖南卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/hunanhd.m3u8'),(59,2,'北邮高清',58,'东方卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/dfhd.m3u8'),(60,2,'北邮高清',59,'黑龙江高清',NULL,'http://ivi.bupt.edu.cn/hls/hljhd.m3u8'),(61,2,'北邮高清',60,'辽宁卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/lnhd.m3u8'),(62,2,'北邮高清',61,'深圳卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/szhd.m3u8'),(63,2,'北邮高清',62,'广东卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/gdhd.m3u8'),(64,2,'北邮高清',63,'天津卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/tjhd.m3u8'),(65,2,'北邮高清',64,'湖北卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/hbhd.m3u8'),(66,2,'北邮高清',65,'山东卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/sdhd.m3u8'),(67,2,'北邮高清',66,'重庆卫视高清',NULL,'http://ivi.bupt.edu.cn/hls/cqhd.m3u8'),(68,2,'北邮高清',67,'CHC高清电影',NULL,'http://ivi.bupt.edu.cn/hls/chchd.m3u8'),(69,2,'北邮高清',68,'CGTN高清',NULL,'http://ivi.bupt.edu.cn/hls/cgtnhd.m3u8'),(70,2,'北邮高清',69,'CGTNDOC高清',NULL,'http://ivi.bupt.edu.cn/hls/cgtndochd.m3u8'),(71,3,'北邮北京',68,'北京文艺',NULL,'http://ivi.bupt.edu.cn/hls/btv2.m3u8'),(72,3,'北邮北京',69,'北京科教',NULL,'http://ivi.bupt.edu.cn/hls/btv3.m3u8'),(73,3,'北邮北京',70,'北京影视',NULL,'http://ivi.bupt.edu.cn/hls/btv4.m3u8'),(74,3,'北邮北京',71,'北京财经',NULL,'http://ivi.bupt.edu.cn/hls/btv5.m3u8'),(75,3,'北邮北京',72,'北京生活',NULL,'http://ivi.bupt.edu.cn/hls/btv7.m3u8'),(76,3,'北邮北京',73,'北京青年',NULL,'http://ivi.bupt.edu.cn/hls/btv8.m3u8'),(77,3,'北邮北京',74,'北京新闻',NULL,'http://ivi.bupt.edu.cn/hls/btv9.m3u8'),(78,3,'北邮北京',75,'北京体育',NULL,'http://ivi.bupt.edu.cn/hls/btv6.m3u8'),(79,3,'北邮北京',76,'北京体育',NULL,'http://ivi.bupt.edu.cn/hls/btv6hd.m3u8'),(80,4,'儿童动画',77,'南京少儿',NULL,'http://live.nbs.cn/channels/njtv/sepd/m3u8:500k/live.m3u8'),(81,4,'儿童动画',78,'河北少儿',NULL,'http://weblive.hebtv.com/live/hbse_bq/index.m3u8'),(82,4,'儿童动画',79,'福州少儿',NULL,'http://live.zohi.tv/video/s10001-sepd-4/index.m3u8'),(83,4,'儿童动画',80,'福州少儿',NULL,'http://live1.fzntv.cn/live/zohi_fztv4/playlist.m3u8'),(84,4,'儿童动画',81,'济南少儿',NULL,'http://ts2.ijntv.cn/jnse/sd1/live.m3u8?_upt=c3e918011515232399'),(85,4,'儿童动画',82,'甘肃少儿',NULL,'http://stream.gstv.com.cn/sepd/sd/live.m3u8'),(86,4,'儿童动画',83,'重庆少儿',NULL,'http://219.153.252.50/PLTV/88888888/224/3221225625/chunklist.m3u8'),(87,4,'儿童动画',84,'重庆少儿',NULL,'http://219.153.252.50/PLTV/88888888/224/3221225646/chunklist.m3u8'),(88,4,'儿童动画',85,'南方少儿TVS5',NULL,'http://nclive.grtn.cn/tvs5/sd/live.m3u8'),(89,4,'儿童动画',86,'北京卡酷少儿',NULL,'http://ivi.bupt.edu.cn/hls/btv10.m3u8'),(90,4,'儿童动画',87,'嘉佳卡通',NULL,'http://nclive.grtn.cn/jjkt/sd/live.m3u8'),(91,4,'儿童动画',88,'炫动卡通',NULL,'http://223.110.245.163/ott.js.chinamobile.com/PLTV/3/224/3221226388/index.m3u8'),(92,4,'儿童动画',89,'金鹰卡通 ',NULL,'http://223.110.245.145/ott.js.chinamobile.com/PLTV/3/224/3221226303/index.m3u8'),(93,4,'儿童动画',90,'金鹰卡通3',NULL,'http://223.82.250.72/live/jinyingkaton/1.m3u8'),(94,4,'儿童动画',91,'优漫卡通',NULL,'http://223.110.243.171/PLTV/3/224/3221226982/index.m3u8'),(95,4,'儿童动画',92,'动漫秀场',NULL,'http://183.207.249.15/PLTV/2/224/3221226037/index.m3u8'),(96,4,'儿童动画',93,'嘉佳卡通',NULL,'http://183.207.249.9/PLTV/2/224/3221226099/index.m3u8'),(97,4,'儿童动画',94,'嘉佳卡通2',NULL,'http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221226099/index.m3u8'),(98,4,'儿童动画',95,'卡卡少儿',NULL,'http://223.110.245.143/ott.js.chinamobile.com/PLTV/3/224/3221226097/index.m3u8'),(99,4,'儿童动画',96,'喵咪Miao-Mi',NULL,'https://d3kw4vhbdpgtqk.cloudfront.net/hls/miaomipcweb/prog_index.m3u8'),(100,4,'儿童动画',97,'Newtv动画王国1',NULL,'http://183.207.249.15/PLTV/3/224/3221225555/index.m3u8'),(101,4,'儿童动画',98,'Newtv动画王国2',NULL,'http://183.207.249.8/PLTV/3/224/3221225555/index.m3u8'),(102,4,'儿童动画',99,'CCTV-14',NULL,'http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221225813/index.m3u8'),(103,4,'儿童动画',100,'CCTV-14',NULL,'http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227201/index.m3u8'),(104,5,'体育频道',101,'博斯魅力',NULL,'http://ms003.happytv.com.tw/live/OcScNdWHvBx5P4w3/index.m3u8'),(105,5,'体育频道',102,'五星体育',NULL,'http://111.48.34.209/huaweicdn.hb.chinamobile.com/PLTV/2510088/224/3221225964/3.m3u8?icpid=88888888&from=1&ocs=2_111.48.34.209_80&hms_devid=443'),(106,5,'体育频道',103,'CCTV高尔夫网球',NULL,'http://223.110.245.151/ott.js.chinamobile.com/PLTV/3/224/3221226420/index.m3u8'),(107,5,'体育频道',104,'NewTV搏击2',NULL,'http://223.110.245.151/ott.js.chinamobile.com/PLTV/3/224/3221226803/index.m3u8'),(108,5,'体育频道',105,'百视通NBA1HD',NULL,'http://223.110.243.170/PLTV/2/224/3221226795/index.m3u8'),(109,5,'体育频道',106,'百视通NBA2HD',NULL,'http://223.110.243.170/PLTV/2/224/3221226797/index.m3u8'),(110,5,'体育频道',107,'百视通NBA3HD',NULL,'http://223.110.243.170/PLTV/2/224/3221226799/index.m3u8'),(111,5,'体育频道',108,'百视通NBA4HD',NULL,'http://223.110.243.170/PLTV/2/224/3221226801/index.m3u8'),(112,5,'体育频道',109,'百视通NBA5HD',NULL,'http://223.110.243.170/PLTV/2/224/3221226803/index.m3u8'),(113,5,'体育频道',110,'百视通NBA6HD',NULL,'http://223.110.243.170/PLTV/2/224/3221226805/index.m3u8'),(114,5,'体育频道',111,'百视通NBA7HD',NULL,'http://223.110.243.170/PLTV/2/224/3221226807/index.m3u8'),(115,5,'体育频道',112,'百事通3',NULL,'http://39.134.52.180/wh7f454c46tw3571653152_-2066612672/hwottcdn.ln.chinamobile.com/PLTV/88888890/224/3221226023/index.m3u8'),(116,5,'体育频道',113,'百事通5',NULL,'http://39.134.52.172/wh7f454c46tw3633585374_215135606/hwottcdn.ln.chinamobile.com/PLTV/88888890/224/3221226027/index.m3u8'),(117,5,'体育频道',114,'百事通6',NULL,'http://39.134.52.183/wh7f454c46tw3669132437_-1850260639/hwottcdn.ln.chinamobile.com/PLTV/88888890/224/3221226030/index.m3u8'),(118,6,'CCTV_1-4',115,'CCTV1_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv1_2/index.m3u8'),(119,6,'CCTV_1-4',116,'CCTV-1',NULL,'http://223.110.245.147/ott.js.chinamobile.com/PLTV/3/224/3221226998/index.m3u8'),(120,6,'CCTV_1-4',117,'CCTV-1',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221225530/index.m3u8'),(121,6,'CCTV_1-4',118,'CCTV-1',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227462/index.m3u8'),(122,6,'CCTV_1-4',119,'CCTV-1',NULL,'http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221226316/index.m3u8'),(123,6,'CCTV_1-4',120,'CCTV2_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv2_2/index.m3u8'),(124,6,'CCTV_1-4',121,'CCTV-2',NULL,'http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227207/index.m3u8'),(125,6,'CCTV_1-4',122,'CCTV3_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv3_2/index.m3u8'),(126,6,'CCTV_1-4',123,'CCTV-3南京移动',NULL,'http://183.207.249.6/PLTV/3/224/3221225588/index.m3u8'),(127,6,'CCTV_1-4',124,'CCTV-3',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227295/index.m3u8'),(128,6,'CCTV_1-4',125,'CCTV-3',NULL,'http://223.110.245.167/ott.js.chinamobile.com/PLTV/3/224/3221226360/index.m3u8'),(129,6,'CCTV_1-4',126,'CCTV4_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv4_2/index.m3u8'),(130,6,'CCTV_1-4',127,'CCTV4',NULL,'http://183.207.249.6/PLTV/3/224/3221225534/index.m3u8'),(131,6,'CCTV_1-4',128,'CCTV-4',NULL,'http://112.50.243.7/PLTV/88888888/224/3221226511/index.m3u8'),(132,6,'CCTV_1-4',129,'CCTV-4',NULL,'http://223.82.250.72/live/cctv-4/1.m3u8'),(133,7,'CCTV_56',130,'CCTV5_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv5_2/index.m3u8'),(134,7,'CCTV_56',131,'CCTV-5',NULL,'http://223.110.245.139:80/PLTV/4/224/3221227298/index.m3u8'),(135,7,'CCTV_56',132,'CCTV-5',NULL,'http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221226362/index.m3u8'),(136,7,'CCTV_56',133,'CCTV-5',NULL,'http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221227401/index.m3u8'),(137,7,'CCTV_56',134,'CCTV-5',NULL,'http://124.47.33.200/PLTV/88888888/224/3221225489/index.m3u8'),(138,7,'CCTV_56',135,'CCTV-5',NULL,'http://124.47.33.211/PLTV/88888888/224/3221225489/index.m3u8'),(139,7,'CCTV_56',136,'CCTV5FHD4',NULL,'http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227166/index.m3u8'),(140,7,'CCTV_56',137,'CCTV5FHD5',NULL,'http://223.110.245.170/PLTV/3/224/3221227166/index.m3u8'),(141,7,'CCTV_56',138,'CCTV5+HD',NULL,'http://183.207.249.6/PLTV/3/224/3221225604/index.m3u8'),(142,7,'CCTV_56',139,'CCTV5+',NULL,'http://124.47.33.200/PLTV/88888888/224/3221225494/index.m3u8'),(143,7,'CCTV_56',140,'CCTV5+',NULL,'http://124.47.33.211/PLTV/88888888/224/3221225494/index.m3u8'),(144,7,'CCTV_56',141,'CCTV-5+',NULL,'http://223.110.245.139:80/PLTV/4/224/3221227480/index.m3u8'),(145,7,'CCTV_56',142,'CCTV6_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv6_2/index.m3u8'),(146,7,'CCTV_56',143,'CCTV-6',NULL,'http://183.207.249.9/PLTV/3/224/3221225548/index.m3u8'),(147,7,'CCTV_56',144,'CCTV-6',NULL,'http://223.110.245.139/ott.js.chinamobile.com/PLTV/3/224/3221227209/index.m3u8'),(148,7,'CCTV_56',145,'CCTV-6',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221225548/index.m3u8'),(149,7,'CCTV_56',146,'CCTV-6',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227209/index.m3u8'),(150,7,'CCTV_56',147,'CCTV-6',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227301/index.m3u8'),(151,7,'CCTV_56',148,'CCTV-6-1080p-1',NULL,'http://117.169.79.106:8080/PLTV/88888888/224/3221225634/index.m3u8'),(152,7,'CCTV_56',149,'CCTV-6-1080p-3',NULL,'http://223.110.245.172/PLTV/3/224/3221225548/index.m3u8'),(153,7,'CCTV_56',150,'CCTV-6-1080p-4',NULL,'http://223.110.245.173/PLTV/3/224/3221225548/index.m3u8'),(154,8,'CCTV_789',151,'CCTV7_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv7_2/index.m3u8'),(155,8,'CCTV_789',152,'CCTV7',NULL,'http://183.207.249.6/PLTV/3/224/3221225546/index.m3u8'),(156,8,'CCTV_789',153,'CCTV8_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv8_2/index.m3u8'),(157,8,'CCTV_789',154,'CCTV-8',NULL,'http://223.110.245.139:80/PLTV/4/224/3221227304/index.m3u8'),(158,8,'CCTV_789',155,'CCTV-8',NULL,'http://223.110.245.141/ott.js.chinamobile.com/PLTV/3/224/3221225866/index.m3u8'),(159,8,'CCTV_789',156,'CCTV-8',NULL,'http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221227304/index.m3u8'),(160,8,'CCTV_789',157,'CCTV-8',NULL,'http://223.110.245.167/ott.js.chinamobile.com/PLTV/3/224/3221227204/index.m3u8'),(161,8,'CCTV_789',158,'CCTV-8',NULL,'http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227204/index.m3u8'),(162,8,'CCTV_789',159,'CCTV-8',NULL,'http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227205/index.m3u8'),(163,8,'CCTV_789',160,'CCTV9',NULL,'http://183.207.249.6/PLTV/3/224/3221225532/index.m3u8'),(164,8,'CCTV_789',161,'CCTV-9',NULL,'http://112.50.243.7/PLTV/88888888/224/3221226566/index.m3u8'),(165,8,'CCTV_789',162,'CCTV-9',NULL,'http://223.110.245.161/ott.js.chinamobile.com/PLTV/3/224/3221225868/index.m3u8'),(166,9,'CCTV_10-12',163,'CCTV10_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv10_2/index.m3u8'),(167,9,'CCTV_10-12',164,'CCTV-10',NULL,'http://112.50.243.7/PLTV/88888888/224/3221225814/index.m3u8'),(168,9,'CCTV_10-12',165,'CCTV-10',NULL,'http://112.50.243.7/PLTV/88888888/224/3221226488/index.m3u8'),(169,9,'CCTV_10-12',166,'CCTV-10',NULL,'http://223.110.245.163/ott.js.chinamobile.com/PLTV/3/224/3221227317/index.m3u8'),(170,9,'CCTV_10-12',167,'CCTV-10',NULL,'http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221225550/index.m3u8'),(171,9,'CCTV_10-12',168,'CCTV-10',NULL,'http://223.110.245.170/PLTV/3/224/3221225550/index.m3u8'),(172,9,'CCTV_10-12',169,'CCTV11_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv11_2/index.m3u8'),(173,9,'CCTV_10-12',170,'CCTV-11',NULL,'http://112.50.243.7/PLTV/88888888/224/3221226493/index.m3u8'),(174,9,'CCTV_10-12',171,'CCTV-11',NULL,'http://223.110.245.153/ott.js.chinamobile.com/PLTV/3/224/3221227384/index.m3u8'),(175,9,'CCTV_10-12',172,'CCTV-11',NULL,'http://223.82.250.72/live/cctv-11/1.m3u8'),(176,9,'CCTV_10-12',173,'CCTV12_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv12_2/index.m3u8'),(177,9,'CCTV_10-12',174,'CCTV-12',NULL,'http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221226019/index.m3u8'),(178,9,'CCTV_10-12',175,'CCTV-12',NULL,'http://223.110.245.163/ott.js.chinamobile.com/PLTV/3/224/3221225556/index.m3u8'),(179,9,'CCTV_10-12',176,'CCTV-12',NULL,'http://223.110.245.170/PLTV/3/224/3221225556/index.m3u8'),(180,9,'CCTV_10-12',177,'CCTV-12',NULL,'http://223.82.250.72/live/cctv-12/1.m3u8'),(181,10,'CCTV_13+',178,'CCTV13_myalicdn',NULL,'http://cctvalih5ca.v.myalicdn.com/live/cctv13_2/index.m3u8'),(182,10,'CCTV_13+',179,'CCTV-13',NULL,'http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221226021/index.m3u8'),(183,10,'CCTV_13+',180,'CCTV-13',NULL,'http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221225560/index.m3u8'),(184,10,'CCTV_13+',181,'CCTV-15',NULL,'http://124.47.34.186/PLTV/88888888/224/3221225854/index.m3u8'),(185,10,'CCTV_13+',182,'CCTV-15',NULL,'http://223.110.245.143/ott.js.chinamobile.com/PLTV/3/224/3221225817/index.m3u8'),(186,10,'CCTV_13+',183,'CCTV-15',NULL,'http://223.110.245.143/ott.js.chinamobile.com/PLTV/3/224/3221226025/index.m3u8'),(187,10,'CCTV_13+',184,'CGNTV中文台',NULL,'http://cgntv-glive.ofsdelivery.net/live/_definst_/cgntv_ch/playlist.m3u8'),(188,10,'CCTV_13+',185,'CCTV老故事',NULL,'http://223.110.245.145/ott.js.chinamobile.com/PLTV/3/224/3221227043/index.m3u8'),(189,10,'CCTV_13+',186,'CCTV女性时尚',NULL,'http://223.110.245.153/ott.js.chinamobile.com/PLTV/3/224/3221227026/index.m3u8'),(190,10,'CCTV_13+',187,'CGTN',NULL,'http://112.50.243.7/PLTV/88888888/224/3221226509/index.m3u8'),(191,10,'CCTV_13+',188,'CGTN',NULL,'https://live.cgtn.com/manifest.m3u8'),(192,10,'CCTV_13+',189,'CGTN-DOC',NULL,'https://news.cgtn.com/resource/live/document/cgtn-doc.m3u8'),(193,11,'卫视备源',190,'安徽卫视3',NULL,'http://223.110.245.147/ott.js.chinamobile.com/PLTV/3/224/3221225634/index.m3u8'),(194,11,'卫视备源',191,'北京卫视3',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/hdbeijingstv/1.m3u8'),(195,11,'卫视备源',192,'北京卫视4',NULL,'http://223.110.243.173/PLTV/3/224/3221227246/index.m3u8'),(196,11,'卫视备源',193,'东方卫视3',NULL,'http://223.110.243.138/PLTV/3/224/3221227208/index.m3u8'),(197,11,'卫视备源',194,'福建卫视1',NULL,'http://223.110.242.130:6610/cntv/live1/dongnanstv/1.m3u8'),(198,11,'卫视备源',195,'广东卫视2',NULL,'http://183.207.249.9/PLTV/3/224/3221225592/index.m3u8'),(199,11,'卫视备源',196,'广东卫视5',NULL,'http://nclive.grtn.cn/gdws/sd/live.m3u8?_upt=4fbd1f881539858465'),(200,11,'卫视备源',197,'广东卫视6',NULL,'http://223.110.243.136/PLTV/3/224/3221227249/index.m3u8'),(201,11,'卫视备源',198,'广东卫视7',NULL,'http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221225906/index.m3u8'),(202,11,'卫视备源',199,'广西卫视3',NULL,'http://223.82.250.72/live/guangxistv/1.m3u8'),(203,11,'卫视备源',200,'贵州卫视3',NULL,'http://223.82.250.72/live/guizhoustv/1.m3u8'),(204,11,'卫视备源',201,'贵州卫视4',NULL,'http://m-tvlmedia.public.bcs.ysten.com/ysten-business/live/guizhoustv/1.m3u8'),(205,11,'卫视备源',202,'河北卫视3',NULL,'http://223.82.250.72/live/hebeistv/1.m3u8'),(206,11,'卫视备源',203,'河北卫视4',NULL,'http://weblive.hebtv.com/live/hbws_lc/index.m3u8'),(207,11,'卫视备源',204,'河南卫视1',NULL,'http://121.31.30.90:8085/ysten-business/live/henanstv/1.m3u8'),(208,11,'卫视备源',205,'河南卫视4',NULL,'http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221225815/index.m3u8'),(209,11,'卫视备源',206,'黑龙江1',NULL,'http://223.110.245.165/ott.js.chinamobile.com/PLTV/3/224/3221227323/index.m3u8'),(210,11,'卫视备源',207,'黑龙江2',NULL,'http://223.110.243.169/PLTV/3/224/3221227252/index.m3u8'),(211,11,'卫视备源',208,'黑龙江3',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/hdheilongjiangstv/1.m3u8'),(212,11,'卫视备源',209,'湖北卫视1',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/hubeistv/1.m3u8'),(213,11,'卫视备源',210,'湖北卫视4',NULL,'http://223.110.243.171/PLTV/3/224/3221227211/index.m3u8'),(214,11,'卫视备源',211,'湖南 RTMP',NULL,'rtmp://58.200.131.2:1935/livetv/hunantv'),(215,11,'卫视备源',212,'湖南卫视3',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/hdhunanstv/1.m3u8'),(216,11,'卫视备源',213,'湖南卫视4',NULL,'http://223.110.243.173/PLTV/3/224/3221227220/index.m3u8'),(217,11,'卫视备源',214,'湖南卫视5',NULL,'http://223.110.245.147/ott.js.chinamobile.com/PLTV/3/224/3221225908/index.m3u8'),(218,11,'卫视备源',215,'湖南卫视6',NULL,'http://223.82.250.72/live/hdhunanstv/1.m3u8'),(219,11,'卫视备源',216,'厦门卫视',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221226996/index.m3u8'),(220,11,'卫视备源',217,'山东卫视2',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/shandongstv/1.m3u8'),(221,11,'卫视备源',218,'山东卫视HD1',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/hdshandongstv/1.m3u8'),(222,11,'卫视备源',219,'山东卫视HD2',NULL,'http://223.110.243.171/PLTV/3/224/3221227258/index.m3u8'),(223,11,'卫视备源',220,'山东卫视HD3',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221226003/index.m3u8'),(224,11,'卫视备源',221,'山西卫视3',NULL,'http://223.82.250.72/live/shanxistv/1.m3u8'),(225,11,'卫视备源',222,'陕西卫视3',NULL,'http://223.82.250.72/live/shanxi1stv/1.m3u8'),(226,11,'卫视备源',223,'深圳卫视HD1',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/hdshenzhenstv/1.m3u8'),(227,11,'卫视备源',224,'深圳卫视HD2',NULL,'http://223.110.243.171/PLTV/3/224/3221227217/index.m3u8'),(228,11,'卫视备源',225,'深圳卫视HD3',NULL,'http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221225997/index.m3u8'),(229,11,'卫视备源',226,'四川卫视HD',NULL,'http://223.110.245.145/ott.js.chinamobile.com/PLTV/3/224/3221225814/index.m3u8'),(230,11,'卫视备源',227,'天津卫视3',NULL,'http://223.110.243.170/PLTV/3/224/3221227212/index.m3u8'),(231,11,'卫视备源',228,'天津卫视4FHD',NULL,'http://223.110.245.170/ott.js.chinamobile.com/PLTV/3/224/3221227212/index.m3u8'),(232,11,'卫视备源',229,'新疆卫视3',NULL,'http://223.82.250.72/live/xinjiangstv/1.m3u8'),(233,11,'卫视备源',230,'云南卫视1',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/yunnanstv/1.m3u8'),(234,11,'卫视备源',231,'浙江卫视FHD',NULL,'http://223.110.245.159/ott.js.chinamobile.com/PLTV/3/224/3221227393/index.m3u8'),(235,11,'卫视备源',232,'浙江卫视HD',NULL,'http://117.169.72.6:8080/ysten-businessmobile/live/hdzhejiangstv/1.m3u8'),(236,11,'卫视备源',233,'浙江卫视HD2',NULL,'http://223.110.243.173/PLTV/3/224/3221227215/index.m3u8'),(237,11,'卫视备源',234,'重庆卫视3',NULL,'http://223.82.250.72/live/chongqingstv/1.m3u8'),(238,12,'测试频道',235,'凤凰香港',NULL,'http://183.207.249.35/PLTV/3/224/3221226975/index.m3u8'),(239,12,'测试频道',236,'凤凰中文',NULL,'http://223.110.245.139/PLTV/3/224/3221226922/index.m3u8'),(240,12,'测试频道',237,'凤凰资讯',NULL,'http://223.110.245.167/ott.js.chinamobile.com/PLTV/3/224/3221226923/index.m3u8'),(241,12,'测试频道',238,'凤凰资讯HD',NULL,'http://117.169.120.138:8080/live/fhzixun/.m3u8'),(242,12,'测试频道',239,'澳亚卫视',NULL,'http://stream.mastvnet.com/MASTV/sd/live.m3u8'),(243,12,'测试频道',240,'好消息综合台',NULL,'http://live.streamingfast.net/osmflivech1.m3u8'),(244,12,'测试频道',241,'好消息真理台',NULL,'http://live.streamingfast.net/osmflivech2.m3u8'),(245,12,'测试频道',242,'韩国GoodTV',NULL,'rtmp://mobliestream.c3tv.com:554/live/goodtv.sdp'),(246,12,'测试频道',243,'GoodTV幸福家庭',NULL,'http://live.streamingfast.net/osmflivech3.m3u8'),(247,12,'测试频道',244,'GoodTV生活台',NULL,'http://live.streamingfast.net/osmflivech12.m3u8'),(248,12,'测试频道',245,'GoodTV美食旅游',NULL,'http://live.streamingfast.net/osmflivech14.m3u8'),(249,12,'测试频道',246,'耀财财经',NULL,'rtmp://202.69.69.180:443/webcast/bshdlive-pc'),(250,12,'测试频道',247,'耀才财经',NULL,'http://fc_video.bsgroup.com.hk:443/webcast/bshdlive-pc/playlist.m3u8'),(251,12,'测试频道',248,'優視頻道',NULL,'http://1-fss24-s0.streamhoster.com/lv_uchannel/_definst_/broadcast1/chunklist.m3u8'),(252,12,'测试频道',249,'優視頻道',NULL,'http://1-fss24-s0.streamhoster.com/lv_uchannel/broadcast1/chunklist.m3u8'),(253,12,'测试频道',250,'RHK-31',NULL,'http://rthklive1-lh.akamaihd.net/i/rthk31_1@167495/index_2052_av-b.m3u8'),(254,12,'测试频道',251,'RHK-312',NULL,'http://rthklive1-lh.akamaihd.net:80/i/rthk31_1@167495/index_1296_av-b.m3u8'),(255,12,'测试频道',252,'环球电视台',NULL,'http://live-cdn.xzxwhcb.com/hls/r86am856.m3u8'),(256,12,'测试频道',253,'Bloomberg TV',NULL,'http://cdn-videos.akamaized.net/btv/desktop/akamai/europe/live/primary.m3u8'),(257,12,'测试频道',254,'KR-arirang',NULL,'http://amdlive.ctnd.com.edgesuite.net/arirang_1ch/smil:arirang_1ch.smil/playlist.m3u8'),(258,12,'测试频道',255,'UK-SkyNews',NULL,'http://skydvn-nowtv-atv-prod.skydvn.com/atv/skynews/1404/live/04.m3u8'),(259,12,'测试频道',256,'US-Newsmax',NULL,'https://nmxlive.akamaized.net/hls/live/529965/Live_1/index.m3u8'),(260,12,'测试频道',257,'Al Jazeera',NULL,'http://aljazeera-eng-apple-live.adaptive.level3.net/apple/aljazeera/english/appleman.m3u8'),(261,12,'测试频道',258,'Al Jazeera',NULL,'http://aljazeera-eng-hd-live.hls.adaptive.level3.net/aljazeera/english2/index.m3u8'),(262,12,'测试频道',259,'IPTV-3+',NULL,'http://117.156.28.119/270000001111/1110000051/index.m3u8'),(263,12,'测试频道',260,'IPTV-6+',NULL,'http://117.156.28.119/270000001111/1110000055/index.m3u8'),(264,12,'测试频道',261,'IPTV-8+',NULL,'http://117.156.28.119/270000001111/1110000057/index.m3u8'),(265,12,'测试频道',262,'IPTV-谍战剧场',NULL,'http://117.156.28.119/270000001111/1110000110/index.m3u8'),(266,12,'测试频道',263,'IPTV-法治',NULL,'http://117.156.28.119/270000001111/1110000111/index.m3u8'),(267,12,'测试频道',264,'IPTV-相声小品',NULL,'http://117.156.28.119/270000001111/1110000112/index.m3u8'),(268,12,'测试频道',265,'第一财经2',NULL,'https://w1live.livecdn.yicai.com/live/cbn.m3u8'),(269,12,'测试频道',266,'点掌财经2',NULL,'http://cclive.aniu.tv/live/anzb.m3u8'),(270,12,'测试频道',267,'点掌财经3',NULL,'http://cclive2.aniu.tv/live/anzb.m3u8'),(271,12,'测试频道',268,'东方财经2',NULL,'http://w1.livecdn.yicai.com/hls/live/dftv_ld/live.m3u8'),(272,12,'测试频道',269,'清华大学电视台',NULL,'http://v.cic.tsinghua.edu.cn/hls/tsinghuatv.m3u8'),(273,12,'测试频道',270,'戏曲梨园频道',NULL,'http://117.158.206.60:9080/live/lypd.m3u8'),(274,12,'测试频道',271,'美国 RTMP 1',NULL,'rtmp://ns8.indexforce.com/home/mystream'),(275,12,'测试频道',272,'美国 RTMP 2',NULL,'rtmp://media3.scctv.net/live/scctv_800'),(276,12,'测试频道',273,'美国中文电视 RTMP',NULL,'rtmp://media3.sinovision.net:1935/live/livestream'),(277,13,'江苏移动',274,'CETV1-2',NULL,'http://223.110.245.143/ott.js.chinamobile.com/PLTV/3/224/3221227355/index.m3u8'),(278,13,'江苏移动',275,'NewTV精品电影',NULL,'http://223.110.245.153/ott.js.chinamobile.com/PLTV/3/224/3221225567/index.m3u8'),(279,13,'江苏移动',276,'东方财经',NULL,'http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221226033/index.m3u8'),(280,13,'江苏移动',277,'都市剧场',NULL,'http://223.110.245.149/ott.js.chinamobile.com/PLTV/3/224/3221226029/index.m3u8'),(281,13,'江苏移动',278,'国学与家道',NULL,'http://223.110.245.147/ott.js.chinamobile.com/PLTV/3/224/3221226392/index.m3u8'),(282,13,'江苏移动',279,'家庭理财',NULL,'http://223.110.245.139:80/PLTV/4/224/3221227011/index.m3u8'),(283,13,'江苏移动',280,'南京教科',NULL,'http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221227194/index.m3u8'),(284,13,'江苏移动',281,'上海纪实',NULL,'http://223.110.245.155/ott.js.chinamobile.com/PLTV/3/224/3221227420/index.m3u8'),(285,13,'江苏移动',282,'生活',NULL,'http://223.110.245.153/ott.js.chinamobile.com/PLTV/3/224/3221227311/index.m3u8'),(286,13,'江苏移动',283,'新娱乐',NULL,'http://223.110.245.141/ott.js.chinamobile.com/PLTV/3/224/3221227021/index.m3u8'),(287,13,'江苏移动',284,'幸福彩',NULL,'http://223.110.245.163/ott.js.chinamobile.com/PLTV/3/224/3221227447/index.m3u8'),(288,13,'江苏移动',285,'影视剧',NULL,'http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221227372/index.m3u8'),(289,13,'江苏移动',286,'置业',NULL,'http://223.110.245.161/ott.js.chinamobile.com/PLTV/3/224/3221227037/index.m3u8'),(290,13,'江苏移动',287,'中国交通',NULL,'http://223.110.245.161/ott.js.chinamobile.com/PLTV/3/224/3221227027/index.m3u8'),(291,13,'江苏移动',288,'中国气象',NULL,'http://223.110.245.157/ott.js.chinamobile.com/PLTV/3/224/3221227438/index.m3u8');
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
INSERT INTO `client` VALUES ('0800274F30AB020000000000','vivo vivo X9','59.37.97.52','广东省深圳市','2020-02-25','2020-02-26','2020-02-25 15:48:56','离线',NULL),('0C4933649E1304BA3666308E','HiSTBAndroidV5 PTV-8098','116.149.283.127','安徽池州','2019-08-01','2020-08-15','2019-08-27 17:46:56','离线',NULL),('1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','小米4','114.103.33.213','','2019-12-24','2024-09-12','2020-03-06 15:05:57','离线',NULL),('293c66612a6C7660D89DD5','KDDI KYT31','116.149.29.181','安徽省池州市','2020-02-28','1999-01-29','2020-03-01 08:01:26','离线',NULL),('293c66612a6C7660D89DD5KDDIKYT31','KDDI KYT31 ','114.103.32.121','安徽省池州市','2020-03-01','2021-03-06','2020-03-30 15:16:06','离线',NULL),('404a163764b4733c78a3','Xiaomi MI 3C','192.168.1.121','','2019-08-01','2020-08-05','2020-02-23 16:46:52','离线',NULL),('42952e700631b00f0800270E38B3020000000000','xiaomi Mi A1','103.82.219.79','吉隆坡XX','2019-11-05','2019-11-12','2019-11-15 21:55:59','离线',NULL),('459dca0a7d24F4F5DB387C3B','Redmi 4X','36.33.115.235','地球','2019-08-10','2020-08-08','2019-08-10 12:59:29','离线',NULL),('4827070016756C7660F4D11B','OYA Red ','116.149.29.181','安徽省池州市','2019-07-31','2020-01-01','2020-02-29 08:37:13','离线',NULL),('48610700351980739F00462B','HSB Gray','116.149.29.181','安徽省池州市','2019-07-31','2020-01-02','2020-02-29 08:36:39','离线',NULL),('4e71cd9b48FDA310EB02','Redmi Note 7','36.33.59.62','海王星','2019-07-31','2020-08-13','2019-07-31 23:14:48','离线',NULL),('4e71cd9b48FDA310EB02xiaomiRedmiNote7','xiaomi_RedmiNote7','114.106.188.178','安徽省池州市','2020-03-23','2020-03-24','2020-03-23 19:53:03','离线',NULL),('513681e7C421C8ACA118','KDDI KYY23','116.149.29.181','安徽省池州市','2019-07-31','2020-01-24','2020-02-29 08:38:35','离线',NULL),('513681e7C421C8ACA118KDDIKYY23','KDDI KYY23','114.106.188.178','安徽省池州市','2020-03-01','2020-04-02','2020-03-23 14:01:14','离线',NULL),('525400123456AndroidAndroidSDKbuiltforx86','Android_AndroidSDKbuiltforx86','114.106.188.178','安徽省池州市','2020-03-23','2020-03-24','2020-03-23 12:24:52','离线',NULL),('525400123456googleNexus4','google_Nexus4','180.163.235.91','上海市','2020-03-03','2020-03-04','2020-03-03 11:29:51','离线',NULL),('5fa08c069E99A02746F39C99A02746F3','Xiaomi 2014112','116.149.31.252','冥王星','2019-08-10','2020-08-14','2019-08-10 08:04:20','离线',NULL),('7gb4cfc6027420c60800270E38B358EF1424E4B6','SM-G900F     ','113.111.48.17','广东广州','2019-11-10','2019-11-17','2019-11-14 15:32:50','离线',NULL),('7sz95tfirwz5badyD8CE3AD30A53','蒋昭洁     ','120.229.93.160','广东省深圳市','2020-02-25','2020-03-06','2020-02-29 22:29:54','离线',NULL),('7sz95tfirwz5badyD8CE3AD30A53RedmiRedmiNote8Pro','Redmi RedmiNote8Pro','120.229.96.130','广东省深圳市','2020-03-01','2020-04-29','2020-03-29 20:34:09','离线',NULL),('8b0b88adD86375AEA207XiaomiMI6','Xiaomi_MI6  ','114.103.32.121','安徽省池州市','2020-03-26','2020-05-30','2020-03-31 01:42:49','离线',NULL),('9319d36d7d2b70BBE9E842AD','Redmi 6A','36.33.118.183','木星','2019-08-01','2020-08-10','2019-09-06 11:34:42','离线',NULL),('94772bfe5faa94772BFE5261','HuaweiY635','58.243.25.57','天王星','2019-07-20','2020-08-12','2019-07-28 22:30:22','离线',NULL),('a231ea567d942047daf3532c','Redmi 4A','36.34.24.200','火星','2019-08-01','2020-08-09','2019-08-02 10:58:12','离线',NULL),('b10bc3af38A4ED1BAE89','Xiaomi MI 5','116.149.29.181','安徽省池州市','2020-02-28','2020-03-01','2020-03-01 10:54:26','离线',NULL),('b10bc3af38A4ED1BAE89XiaomiMI5','Xiaomi MI5  ','114.103.32.121','安徽省池州市','2020-03-01','2021-04-02','2020-03-31 01:55:27','在线',NULL),('c6238a0B40B44518E51SMARTISANOS105','SMARTISAN_OS105  ','218.79.135.15','上海市','2020-03-22','2020-04-28','2020-03-30 14:32:17','在线',NULL),('cdf5f23408c570160800270E38B3','OnePlus ONEPLUS A3010','114.103.32.221','池州','2020-03-07','2020-03-14','2020-03-07 18:08:35','离线',NULL),('d5750gfb0gc5e0c70800270E38B3020000000000','OnePlus ONEPLUS A3010','114.103.34.212','安徽','2019-09-20','2019-09-27','2019-09-26 07:34:03','离线',NULL),('F01091990070321000003CDA2AD1802B3CDA2AD1802B04E67605FD8F','Mebox B860A','114.103.33.15','','2019-08-11','2019-08-16','2020-03-20 23:53:05','离线',NULL),('MSM8625QSKUD921D277F707A901D277FF07A','ZTE_N909','58.243.25.57','土星','2019-07-20','2020-08-11','2019-07-28 22:32:06','离线',NULL),('W8RDU1630800607850680a49896d','HONOR PLK-UL00','123.120.95.1','北京市','2020-02-26','2020-02-27','2020-02-26 01:13:31','离线',NULL),('W8RDU1630800607850680a49896dHONORPLK-UL00','HONOR_PLK-UL00 ','103.82.219.84','香港特别行政','2020-03-05','2020-03-30','2020-03-08 00:14:27','离线',NULL);
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
  `groupLogo` varchar(255) DEFAULT NULL,
  UNIQUE KEY `groupId` (`groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (0,'北邮央视','group0.jpg'),(1,'北邮卫视','group1.jpg'),(2,'北邮高清','group2.jpg'),(3,'北邮北京','group3.jpg'),(4,'儿童动画','group4.jpg'),(5,'体育频道',NULL),(6,'CCTV_1-4',NULL),(7,'CCTV_56',NULL),(8,'CCTV_789',NULL),(9,'CCTV_10-12',NULL),(10,'CCTV_13+',NULL),(11,'卫视备源','group11.jpg'),(12,'测试频道','group12.jpg'),(13,'江苏移动','group13.jpg');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `browse` int(11) DEFAULT NULL,
  `play` int(11) DEFAULT NULL,
  `collect` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `sn` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lastTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `sn` (`sn`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`sn`) REFERENCES `client` (`sn`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionAll`
--

DROP TABLE IF EXISTS `regionAll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionAll` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `regionAll_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionAll_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionAll_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionAll_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionAll_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionAll_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionAll_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionAll_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionAll_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionAll`
--

LOCK TABLES `regionAll` WRITE;
/*!40000 ALTER TABLE `regionAll` DISABLE KEYS */;
/*!40000 ALTER TABLE `regionAll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionEurUSA`
--

DROP TABLE IF EXISTS `regionEurUSA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionEurUSA` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `regionEurUSA_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionEurUSA_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionEurUSA_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionEurUSA_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionEurUSA_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionEurUSA_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionEurUSA_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionEurUSA_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionEurUSA_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionEurUSA`
--

LOCK TABLES `regionEurUSA` WRITE;
/*!40000 ALTER TABLE `regionEurUSA` DISABLE KEYS */;
/*!40000 ALTER TABLE `regionEurUSA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionHongkong`
--

DROP TABLE IF EXISTS `regionHongkong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionHongkong` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `regionHongkong_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionHongkong_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionHongkong_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionHongkong_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionHongkong_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionHongkong_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionHongkong_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionHongkong_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionHongkong_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionHongkong`
--

LOCK TABLES `regionHongkong` WRITE;
/*!40000 ALTER TABLE `regionHongkong` DISABLE KEYS */;
/*!40000 ALTER TABLE `regionHongkong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionJapan`
--

DROP TABLE IF EXISTS `regionJapan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionJapan` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `regionJapan_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionJapan_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionJapan_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionJapan_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionJapan_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionJapan_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionJapan_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionJapan_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionJapan_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionJapan`
--

LOCK TABLES `regionJapan` WRITE;
/*!40000 ALTER TABLE `regionJapan` DISABLE KEYS */;
/*!40000 ALTER TABLE `regionJapan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionKorea`
--

DROP TABLE IF EXISTS `regionKorea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionKorea` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `regionKorea_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionKorea_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionKorea_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionKorea_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionKorea_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionKorea_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionKorea_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionKorea_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionKorea_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionKorea`
--

LOCK TABLES `regionKorea` WRITE;
/*!40000 ALTER TABLE `regionKorea` DISABLE KEYS */;
/*!40000 ALTER TABLE `regionKorea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionMainland`
--

DROP TABLE IF EXISTS `regionMainland`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionMainland` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `regionMainland_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionMainland_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionMainland_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionMainland_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionMainland_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionMainland_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionMainland_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionMainland_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionMainland_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionMainland`
--

LOCK TABLES `regionMainland` WRITE;
/*!40000 ALTER TABLE `regionMainland` DISABLE KEYS */;
/*!40000 ALTER TABLE `regionMainland` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionOther`
--

DROP TABLE IF EXISTS `regionOther`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionOther` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `regionOther_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionOther_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionOther_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionOther_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionOther_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionOther_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionOther_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionOther_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionOther_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionOther`
--

LOCK TABLES `regionOther` WRITE;
/*!40000 ALTER TABLE `regionOther` DISABLE KEYS */;
/*!40000 ALTER TABLE `regionOther` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionTaiwan`
--

DROP TABLE IF EXISTS `regionTaiwan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionTaiwan` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `regionTaiwan_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionTaiwan_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionTaiwan_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionTaiwan_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionTaiwan_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionTaiwan_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionTaiwan_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionTaiwan_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `regionTaiwan_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionTaiwan`
--

LOCK TABLES `regionTaiwan` WRITE;
/*!40000 ALTER TABLE `regionTaiwan` DISABLE KEYS */;
/*!40000 ALTER TABLE `regionTaiwan` ENABLE KEYS */;
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
INSERT INTO `sold` VALUES ('2019-12-25 11:07:32','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','中国湖北武汉','1',30),('2019-12-25 11:08:53','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','10',365),('2019-12-23 18:52:18','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','湖北省武汉市','1234567812345678',60),('2019-12-25 15:15:09','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','1577256551868400',1),('2019-12-25 15:57:30','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','1577256551868401',1),('2020-02-23 14:36:51','293c66612a6C7660D89DD5','192.168.1.120','','1577548008808700',1),('2020-02-23 14:39:11','513681e7C421C8ACA118','192.168.1.119','','1577548155549100',1),('2020-02-23 15:30:09','b10bc3af38A4ED1BAE89','192.168.1.109','','1577550468382500',11),('2020-02-25 15:12:29','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','1582558970523000',10),('2020-02-25 17:27:58','7sz95tfirwz5badyD8CE3AD30A53','120.229.93.134','广东省深圳市','1582558970523001',10),('2019-12-25 11:07:40','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','2',60),('2019-12-23 18:52:53','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','3',90),('2019-12-25 11:07:56','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','4',120),('2020-03-01 15:10:25','293c66612a6C7660D89DD5KDDIKYT31','116.149.29.181','安徽省池州市','46549426',1),('2020-03-01 15:13:40','293c66612a6C7660D89DD5KDDIKYT31','116.149.29.181','安徽省池州市','46549427',1),('2020-03-24 14:30:00','8b0b88adD86375AEA207XiaomiMI6','114.103.32.240','安徽省池州市','46549428',1),('2019-12-24 10:54:35','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','5',150),('2020-03-29 20:25:48','8b0b88adD86375AEA207XiaomiMI6','114.106.189.119','安徽省池州市','51703472',1),('2019-12-25 11:08:16','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','6',180),('2019-12-25 11:08:23','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','7',210),('2020-02-27 12:17:21','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','76514001',1),('2020-02-27 14:54:54','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','76514002',1),('2019-12-25 11:08:30','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','8',240),('2020-03-29 20:23:57','c6238a0B40B44518E51SMARTISANOS105','218.79.135.15','上海市','84240161',30),('2020-02-27 15:02:39','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','86922725',1),('2020-02-27 15:11:42','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','86922726',1),('2020-02-27 15:04:55','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','87054180',365),('2020-02-27 15:09:01','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','87054181',365),('2019-12-25 11:08:36','1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097','192.168.31.214','','9',270),('2020-02-27 16:14:32','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','90821718',1),('2020-02-27 19:56:30','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','90821719',1),('2020-02-28 00:18:15','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','90821720',1),('2020-02-28 15:14:15','8b0b88adD86375AEA207','','','90821721',1),('2020-02-28 17:56:00','8b0b88adD86375AEA207','','','90821722',1),('2020-02-28 19:49:07','8b0b88adD86375AEA207','','','90821723',1),('2020-02-28 19:55:23','8b0b88adD86375AEA207','','','90821724',1),('2020-02-28 20:01:23','8b0b88adD86375AEA207','','','90821725 ',1),('2020-02-28 20:04:29','8b0b88adD86375AEA207','','','90821726',1),('2020-02-28 20:06:20','8b0b88adD86375AEA207','','','90821727',1),('2020-02-28 21:27:20','b10bc3af38A4ED1BAE89','116.149.29.181','安徽省池州市','96400781',1),('2020-02-28 21:46:05','b10bc3af38A4ED1BAE89','116.149.29.181','安徽省池州市','96400782',1),('2020-02-29 11:31:21','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400783',1),('2020-02-29 11:35:22','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400784',1),('2020-02-29 11:45:22','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400785',1),('2020-02-29 11:46:56','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400786',1),('2020-02-29 11:49:52','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400787',1),('2020-02-29 13:24:47','8b0b88adD86375AEA207','116.149.29.181','安徽省池州市','96400788',1),('2020-03-01 15:05:09','293c66612a6C7660D89DD5KDDIKYT31','116.149.29.181','安徽省池州市','96400789',1),('2020-03-01 15:07:23','293c66612a6C7660D89DD5KDDIKYT31','116.149.29.181','安徽省池州市','96400790',1);
/*!40000 ALTER TABLE `sold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `tagTable` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tagName` varchar(11) CHARACTER SET utf8 NOT NULL,
  `tagSort` int(11) NOT NULL DEFAULT '99',
  `tagLevel` int(3) DEFAULT '1',
  PRIMARY KEY (`tagTable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES ('regionAll','全部',6,2),('regionEurUSA','欧美',9,2),('regionHongkong','香港',7,2),('regionJapan','日本',10,2),('regionKorea','韩国',11,2),('regionMainland','大陆',6,2),('regionOther','其他',12,2),('regionTaiwan','台湾',8,2),('tagAll','全部',13,3),('tagDongZuo','动作',25,3),('tagFamily','家庭',17,3),('tagFanZui','犯罪',29,3),('tagGeWu','歌舞',21,3),('tagGuZhuang','古装',24,3),('tagJingSong','惊悚',27,3),('tagJuQing','剧情',15,3),('tagKeHuan','科幻',34,3),('tagKongBu','恐怖',26,3),('tagLove','爱情',14,3),('tagLunLi','伦理',18,3),('tagMaoXian','冒险',28,3),('tagMoHuan','魔幻',35,3),('tagMusic','音乐',20,3),('tagQiHuan','奇幻',36,3),('tagSports','体育',33,3),('tagWar','战争',31,3),('tagWenYi','文艺',19,3),('tagWest','西部',22,3),('tagWuXia','武侠',23,3),('tagXiJu','喜剧',16,3),('tagXuanYi','悬疑',30,3),('tagYuanXian','院线',13,3),('tagZhuanJi','传记',32,3),('typeCartoon','动漫',4,1),('typeDocument','纪录片',5,1),('typeHome','首页',0,1),('typeMovie','电影',1,1),('typeSeries','电视剧',2,1),('typeVariety','综艺',3,1);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagAll`
--

DROP TABLE IF EXISTS `tagAll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagAll` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagAll_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagAll_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagAll_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagAll_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagAll_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagAll_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagAll_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagAll_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagAll_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagAll`
--

LOCK TABLES `tagAll` WRITE;
/*!40000 ALTER TABLE `tagAll` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagAll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagDongZuo`
--

DROP TABLE IF EXISTS `tagDongZuo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagDongZuo` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagDongZuo_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagDongZuo_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagDongZuo_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagDongZuo_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagDongZuo_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagDongZuo_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagDongZuo_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagDongZuo_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagDongZuo_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagDongZuo`
--

LOCK TABLES `tagDongZuo` WRITE;
/*!40000 ALTER TABLE `tagDongZuo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagDongZuo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagFamily`
--

DROP TABLE IF EXISTS `tagFamily`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagFamily` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagFamily_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFamily_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFamily_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFamily_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFamily_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFamily_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFamily_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFamily_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFamily_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagFamily`
--

LOCK TABLES `tagFamily` WRITE;
/*!40000 ALTER TABLE `tagFamily` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagFamily` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagFanZui`
--

DROP TABLE IF EXISTS `tagFanZui`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagFanZui` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagFanZui_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFanZui_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFanZui_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFanZui_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFanZui_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFanZui_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFanZui_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFanZui_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagFanZui_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagFanZui`
--

LOCK TABLES `tagFanZui` WRITE;
/*!40000 ALTER TABLE `tagFanZui` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagFanZui` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagGeWu`
--

DROP TABLE IF EXISTS `tagGeWu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagGeWu` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagGeWu_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGeWu_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGeWu_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGeWu_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGeWu_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGeWu_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGeWu_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGeWu_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGeWu_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagGeWu`
--

LOCK TABLES `tagGeWu` WRITE;
/*!40000 ALTER TABLE `tagGeWu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagGeWu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagGuZhuang`
--

DROP TABLE IF EXISTS `tagGuZhuang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagGuZhuang` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagGuZhuang_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGuZhuang_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGuZhuang_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGuZhuang_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGuZhuang_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGuZhuang_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGuZhuang_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGuZhuang_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagGuZhuang_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagGuZhuang`
--

LOCK TABLES `tagGuZhuang` WRITE;
/*!40000 ALTER TABLE `tagGuZhuang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagGuZhuang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagJingSong`
--

DROP TABLE IF EXISTS `tagJingSong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagJingSong` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagJingSong_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJingSong_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJingSong_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJingSong_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJingSong_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJingSong_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJingSong_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJingSong_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJingSong_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagJingSong`
--

LOCK TABLES `tagJingSong` WRITE;
/*!40000 ALTER TABLE `tagJingSong` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagJingSong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagJuQing`
--

DROP TABLE IF EXISTS `tagJuQing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagJuQing` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagJuQing_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJuQing_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJuQing_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJuQing_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJuQing_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJuQing_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJuQing_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJuQing_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagJuQing_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagJuQing`
--

LOCK TABLES `tagJuQing` WRITE;
/*!40000 ALTER TABLE `tagJuQing` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagJuQing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagKeHuan`
--

DROP TABLE IF EXISTS `tagKeHuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagKeHuan` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagKeHuan_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKeHuan_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKeHuan_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKeHuan_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKeHuan_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKeHuan_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKeHuan_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKeHuan_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKeHuan_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagKeHuan`
--

LOCK TABLES `tagKeHuan` WRITE;
/*!40000 ALTER TABLE `tagKeHuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagKeHuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagKongBu`
--

DROP TABLE IF EXISTS `tagKongBu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagKongBu` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagKongBu_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKongBu_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKongBu_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKongBu_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKongBu_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKongBu_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKongBu_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKongBu_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagKongBu_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagKongBu`
--

LOCK TABLES `tagKongBu` WRITE;
/*!40000 ALTER TABLE `tagKongBu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagKongBu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagLove`
--

DROP TABLE IF EXISTS `tagLove`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagLove` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagLove_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLove_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLove_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLove_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLove_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLove_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLove_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLove_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLove_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagLove`
--

LOCK TABLES `tagLove` WRITE;
/*!40000 ALTER TABLE `tagLove` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagLove` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagLunLi`
--

DROP TABLE IF EXISTS `tagLunLi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagLunLi` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagLunLi_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLunLi_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLunLi_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLunLi_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLunLi_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLunLi_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLunLi_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLunLi_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagLunLi_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagLunLi`
--

LOCK TABLES `tagLunLi` WRITE;
/*!40000 ALTER TABLE `tagLunLi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagLunLi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagMaoXian`
--

DROP TABLE IF EXISTS `tagMaoXian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagMaoXian` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagMaoXian_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMaoXian_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMaoXian_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMaoXian_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMaoXian_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMaoXian_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMaoXian_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMaoXian_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMaoXian_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagMaoXian`
--

LOCK TABLES `tagMaoXian` WRITE;
/*!40000 ALTER TABLE `tagMaoXian` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagMaoXian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagMoHuan`
--

DROP TABLE IF EXISTS `tagMoHuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagMoHuan` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagMoHuan_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMoHuan_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMoHuan_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMoHuan_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMoHuan_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMoHuan_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMoHuan_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMoHuan_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMoHuan_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagMoHuan`
--

LOCK TABLES `tagMoHuan` WRITE;
/*!40000 ALTER TABLE `tagMoHuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagMoHuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagModel`
--

DROP TABLE IF EXISTS `tagModel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagModel` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagModel`
--

LOCK TABLES `tagModel` WRITE;
/*!40000 ALTER TABLE `tagModel` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagModel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagMusic`
--

DROP TABLE IF EXISTS `tagMusic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagMusic` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagMusic_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMusic_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMusic_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMusic_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMusic_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMusic_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMusic_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMusic_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagMusic_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagMusic`
--

LOCK TABLES `tagMusic` WRITE;
/*!40000 ALTER TABLE `tagMusic` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagMusic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagQiHuan`
--

DROP TABLE IF EXISTS `tagQiHuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagQiHuan` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagQiHuan_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagQiHuan_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagQiHuan_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagQiHuan_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagQiHuan_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagQiHuan_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagQiHuan_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagQiHuan_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagQiHuan_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagQiHuan`
--

LOCK TABLES `tagQiHuan` WRITE;
/*!40000 ALTER TABLE `tagQiHuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagQiHuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagSports`
--

DROP TABLE IF EXISTS `tagSports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagSports` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagSports_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagSports_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagSports_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagSports_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagSports_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagSports_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagSports_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagSports_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagSports_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagSports`
--

LOCK TABLES `tagSports` WRITE;
/*!40000 ALTER TABLE `tagSports` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagSports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagWar`
--

DROP TABLE IF EXISTS `tagWar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagWar` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagWar_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWar_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWar_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWar_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWar_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWar_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWar_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWar_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWar_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagWar`
--

LOCK TABLES `tagWar` WRITE;
/*!40000 ALTER TABLE `tagWar` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagWar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagWenYi`
--

DROP TABLE IF EXISTS `tagWenYi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagWenYi` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagWenYi_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWenYi_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWenYi_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWenYi_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWenYi_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWenYi_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWenYi_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWenYi_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWenYi_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagWenYi`
--

LOCK TABLES `tagWenYi` WRITE;
/*!40000 ALTER TABLE `tagWenYi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagWenYi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagWest`
--

DROP TABLE IF EXISTS `tagWest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagWest` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagWest_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWest_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWest_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWest_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWest_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWest_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWest_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWest_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWest_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagWest`
--

LOCK TABLES `tagWest` WRITE;
/*!40000 ALTER TABLE `tagWest` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagWest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagWuXia`
--

DROP TABLE IF EXISTS `tagWuXia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagWuXia` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagWuXia_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWuXia_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWuXia_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWuXia_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWuXia_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWuXia_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWuXia_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWuXia_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagWuXia_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagWuXia`
--

LOCK TABLES `tagWuXia` WRITE;
/*!40000 ALTER TABLE `tagWuXia` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagWuXia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagXiJu`
--

DROP TABLE IF EXISTS `tagXiJu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagXiJu` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagXiJu_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXiJu_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXiJu_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXiJu_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXiJu_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXiJu_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXiJu_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXiJu_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXiJu_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagXiJu`
--

LOCK TABLES `tagXiJu` WRITE;
/*!40000 ALTER TABLE `tagXiJu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagXiJu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagXuanYi`
--

DROP TABLE IF EXISTS `tagXuanYi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagXuanYi` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagXuanYi_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXuanYi_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXuanYi_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXuanYi_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXuanYi_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXuanYi_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXuanYi_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXuanYi_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagXuanYi_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagXuanYi`
--

LOCK TABLES `tagXuanYi` WRITE;
/*!40000 ALTER TABLE `tagXuanYi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagXuanYi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagYuanXian`
--

DROP TABLE IF EXISTS `tagYuanXian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagYuanXian` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagYuanXian_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagYuanXian_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagYuanXian_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagYuanXian_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagYuanXian_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagYuanXian_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagYuanXian_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagYuanXian_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagYuanXian_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagYuanXian`
--

LOCK TABLES `tagYuanXian` WRITE;
/*!40000 ALTER TABLE `tagYuanXian` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagYuanXian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagZhuanJi`
--

DROP TABLE IF EXISTS `tagZhuanJi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagZhuanJi` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `tagZhuanJi_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagZhuanJi_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagZhuanJi_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagZhuanJi_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagZhuanJi_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagZhuanJi_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagZhuanJi_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagZhuanJi_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagZhuanJi_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagZhuanJi`
--

LOCK TABLES `tagZhuanJi` WRITE;
/*!40000 ALTER TABLE `tagZhuanJi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagZhuanJi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeCartoon`
--

DROP TABLE IF EXISTS `typeCartoon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeCartoon` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `typeCartoon_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeCartoon_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeCartoon_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeCartoon_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeCartoon_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeCartoon_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeCartoon_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeCartoon_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeCartoon_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeCartoon`
--

LOCK TABLES `typeCartoon` WRITE;
/*!40000 ALTER TABLE `typeCartoon` DISABLE KEYS */;
INSERT INTO `typeCartoon` VALUES ('/usr/local/nginx/html/myLive/vod/12-01宋词概述/12-01宋词概述.mp4','宋词概述',149,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,1,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-02李煜及其创作/12-02李煜及其创作.mp4','李煜及其创作',150,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,2,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-03《虞美人春花秋月何时了》导读/12-03《虞美人春花秋月何时了》导读.mp4','《虞美人春花秋月何时了》导读',151,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,3,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-04《相见欢》导读/12-04《相见欢》导读.mp4','《相见欢》导读',152,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,4,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-05《浪淘沙令帘外雨潺潺》导读/12-05《浪淘沙令帘外雨潺潺》导读.mp4','《浪淘沙令帘外雨潺潺》导读',153,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,5,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-06柳永及其创作/12-06柳永及其创作.mp4','柳永及其创作',154,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,6,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-07《雨霖铃寒蝉凄切》导读/12-07《雨霖铃寒蝉凄切》导读.mp4','《雨霖铃寒蝉凄切》导读',155,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,7,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-08《望海潮东南形胜》导读/12-08《望海潮东南形胜》导读.mp4','《望海潮东南形胜》导读',156,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,8,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-09晏殊及其创作/12-09晏殊及其创作.mp4','晏殊及其创作',157,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,9,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-10《蝶恋花槛菊愁烟兰泣露》导读/12-10《蝶恋花槛菊愁烟兰泣露》导读.mp4','《蝶恋花槛菊愁烟兰泣露》导读',158,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,10,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-11《浣溪沙一曲新词酒一杯》导读/12-11《浣溪沙一曲新词酒一杯》导读.mp4','《浣溪沙一曲新词酒一杯》导读',159,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,11,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-12范仲淹及其创作/12-12范仲淹及其创作.mp4','范仲淹及其创作',160,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,12,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-13《渔家傲秋思》导读/12-13《渔家傲秋思》导读.mp4','《渔家傲秋思》导读',161,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,13,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-14《岳阳楼记》导读/12-14《岳阳楼记》导读.mp4','《岳阳楼记》导读',162,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,14,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-15欧阳修及其创作/12-15欧阳修及其创作.mp4','欧阳修及其创作',163,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,15,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-16《蝶恋花庭院深深深几许》导读/12-16《蝶恋花庭院深深深几许》导读.mp4','《蝶恋花庭院深深深几许》导读',164,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,16,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/12-17《醉翁亭记》导读/12-17《醉翁亭记》导读.mp4','《醉翁亭记》导读',165,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,17,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-01王安石及其创作/13-01王安石及其创作.mp4','王安石及其创作',166,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,18,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-02《桂枝香金陵怀古》导读/13-02《桂枝香金陵怀古》导读.mp4','《桂枝香金陵怀古》导读',167,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,19,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-03《登飞来峰》导读/13-03《登飞来峰》导读.mp4','《登飞来峰》导读',168,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,20,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-04《泊船瓜洲》导读/13-04《泊船瓜洲》导读.mp4','《泊船瓜洲》导读',169,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,21,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-05苏轼及其创作/13-05苏轼及其创作.mp4','苏轼及其创作',170,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,22,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-06《念奴娇赤壁怀古》导读/13-06《念奴娇赤壁怀古》导读.mp4','《念奴娇赤壁怀古》导读',171,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,23,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-07《水调歌头明月几时有》导读/13-07《水调歌头明月几时有》导读.mp4','《水调歌头明月几时有》导读',172,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,24,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-08《饮湖上初晴后雨》导读/13-08《饮湖上初晴后雨》导读.mp4','《饮湖上初晴后雨》导读',173,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,25,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-09《定风波》导读/13-09《定风波》导读.mp4','《定风波》导读',174,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,26,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-10《江城子密州出猎》导读/13-10《江城子密州出猎》导读.mp4','《江城子密州出猎》导读',175,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,27,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-11《江城子乙卯正月二十夜记梦》导读/13-11《江城子乙卯正月二十夜记梦》导读.mp4','《江城子乙卯正月二十夜记梦》导读',176,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,28,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-12秦观及其创作/13-12秦观及其创作.mp4','秦观及其创作',177,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,29,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-13《鹊桥仙纤云弄巧》导读/13-13《鹊桥仙纤云弄巧》导读.mp4','《鹊桥仙纤云弄巧》导读',178,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,30,'2020-03-29 01:21:24','admin');
/*!40000 ALTER TABLE `typeCartoon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeDocument`
--

DROP TABLE IF EXISTS `typeDocument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeDocument` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `typeDocument_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeDocument_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeDocument_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeDocument_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeDocument_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeDocument_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeDocument_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeDocument_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeDocument_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeDocument`
--

LOCK TABLES `typeDocument` WRITE;
/*!40000 ALTER TABLE `typeDocument` DISABLE KEYS */;
INSERT INTO `typeDocument` VALUES ('/usr/local/nginx/html/myLive/vod/13-14《踏莎行郴州旅舍》导读/13-14《踏莎行郴州旅舍》导读.mp4','《踏莎行郴州旅舍》导读',179,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,1,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-15周邦彦及其创作/13-15周邦彦及其创作.mp4','周邦彦及其创作',180,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,2,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/13-16《苏幕遮燎沉香》导读/13-16《苏幕遮燎沉香》导读.mp4','《苏幕遮燎沉香》导读',181,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,3,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/14-01李清照及其创作/14-01李清照及其创作.mp4','李清照及其创作',182,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,4,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/14-02《声声慢》导读/14-02《声声慢》导读.mp4','《声声慢》导读',183,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,5,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/14-03《夏日绝句》导读/14-03《夏日绝句》导读.mp4','《夏日绝句》导读',184,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,6,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/14-04《如梦令》导读/14-04《如梦令》导读.mp4','《如梦令》导读',185,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,7,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/14-05《一剪梅红藕香残玉簟秋》导读/14-05《一剪梅红藕香残玉簟秋》导读.mp4','《一剪梅红藕香残玉簟秋》导读',186,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,8,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/14-06《醉花阴薄雾浓云愁永昼》导读/14-06《醉花阴薄雾浓云愁永昼》导读.mp4','《醉花阴薄雾浓云愁永昼》导读',187,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',0,9,'2020-03-29 12:53:29','admin'),('/usr/local/nginx/html/myLive/vod/14-07《武陵春春晚》导读/14-07《武陵春春晚》导读.mp4','《武陵春春晚》导读',188,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',0,10,'2020-03-29 12:53:29','admin'),('/usr/local/nginx/html/myLive/vod/14-08岳飞及其创作/14-08岳飞及其创作.mp4','岳飞及其创作',189,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',0,11,'2020-03-29 12:53:29','admin'),('/usr/local/nginx/html/myLive/vod/14-09《满江红》导读/14-09《满江红》导读.mp4','《满江红》导读',190,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',0,12,'2020-03-29 12:53:29','admin'),('/usr/local/nginx/html/myLive/vod/14-10《小重山昨夜寒蛩不住鸣》导读/14-10《小重山昨夜寒蛩不住鸣》导读.mp4','=-《小重山昨夜寒蛩不住鸣》导读',191,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',0,13,'2020-03-29 12:53:29','admin'),('/usr/local/nginx/html/myLive/vod/15-01陆游及其创作/15-01陆游及其创作.mp4','陆游及其创作',192,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',0,14,'2020-03-29 12:53:29','admin'),('/usr/local/nginx/html/myLive/vod/15-02《卜算子咏梅》导读/15-02《卜算子咏梅》导读.mp4','《卜算子咏梅》导读',193,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',0,15,'2020-03-29 12:53:29','admin'),('/usr/local/nginx/html/myLive/vod/15-03《书愤》导读/15-03《书愤》导读.mp4','《书愤》导读',194,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,16,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/15-04《示儿》导读/15-04《示儿》导读.mp4','《示儿》导读',195,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,17,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/15-05《游山西村》导读/15-05《游山西村》导读.mp4','《游山西村》导读',196,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,18,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/15-06《临安春雨初霁》导读/15-06《临安春雨初霁》导读.mp4','《临安春雨初霁》导读',197,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,19,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/15-07辛弃疾及其创作/15-07辛弃疾及其创作.mp4','辛弃疾及其创作',198,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,20,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/15-08《青玉案元夕》导读/15-08《青玉案元夕》导读.mp4','《青玉案元夕》导读',199,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,21,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/15-09《破阵子为陈同甫赋壮词以寄之》导读/15-09《破阵子为陈同甫赋壮词以寄之》导读.mp4','《破阵子为陈同甫赋壮词以寄之》导读',200,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,22,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/15-10《清平乐村居》导读/15-10《清平乐村居》导读.mp4','《清平乐村居》导读',201,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,23,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/15-11《西江月夜行黄沙道中》导读/15-11《西江月夜行黄沙道中》导读.mp4','《西江月夜行黄沙道中》导读',202,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,24,'2020-03-29 01:21:25','admin'),('/usr/local/nginx/html/myLive/vod/15-12姜夔及其创作/15-12姜夔及其创作.mp4','姜夔及其创作',203,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,25,'2020-03-29 01:21:25','admin'),('/usr/local/nginx/html/myLive/vod/15-13《扬州慢淮左名都》导读/15-13《扬州慢淮左名都》导读.mp4','《扬州慢淮左名都》导读',204,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,26,'2020-03-29 01:21:25','admin');
/*!40000 ALTER TABLE `typeDocument` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeHome`
--

DROP TABLE IF EXISTS `typeHome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeHome` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `typeHome_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeHome_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeHome_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeHome_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeHome_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeHome_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeHome_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeHome_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeHome_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeHome`
--

LOCK TABLES `typeHome` WRITE;
/*!40000 ALTER TABLE `typeHome` DISABLE KEYS */;
/*!40000 ALTER TABLE `typeHome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeMovie`
--

DROP TABLE IF EXISTS `typeMovie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeMovie` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `typeMovie_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeMovie_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeMovie_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeMovie_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeMovie_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeMovie_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeMovie_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeMovie_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeMovie_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeMovie`
--

LOCK TABLES `typeMovie` WRITE;
/*!40000 ALTER TABLE `typeMovie` DISABLE KEYS */;
INSERT INTO `typeMovie` VALUES ('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第002集/乐乐课堂-三国演义-第002集.mp4','乐乐课堂-三国演义-第002集',2,111,'大陆',2021,'乐乐课堂','乐乐',10,'|',1,1,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第003集/乐乐课堂-三国演义-第003集.mp4','乐乐课堂-三国演义-第003集',3,111,'大陆',2022,'乐乐课堂','乐乐',10,'|',1,2,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第004集/乐乐课堂-三国演义-第004集.mp4','乐乐课堂-三国演义-第004集',4,111,'大陆',2023,'乐乐课堂','乐乐',10,'|',1,3,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第005集/乐乐课堂-三国演义-第005集.mp4','乐乐课堂-三国演义-第005集',5,111,'大陆',2024,'乐乐课堂','乐乐',10,'|',1,4,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第006集/乐乐课堂-三国演义-第006集.mp4','乐乐课堂-三国演义-第006集',6,111,'大陆',2025,'乐乐课堂','乐乐',10,'|',1,5,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第007集/乐乐课堂-三国演义-第007集.mp4','乐乐课堂-三国演义-第007集',7,111,'大陆',2026,'乐乐课堂','乐乐',10,'|',1,6,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第008集/乐乐课堂-三国演义-第008集.mp4','乐乐课堂-三国演义-第008集',8,111,'大陆',2027,'乐乐课堂','乐乐',10,'|',1,7,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第009集/乐乐课堂-三国演义-第009集.mp4','乐乐课堂-三国演义-第009集',9,111,'大陆',2028,'乐乐课堂','乐乐',10,'|',1,8,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第010集/乐乐课堂-三国演义-第010集.mp4','乐乐课堂-三国演义-第010集',10,111,'大陆',2029,'乐乐课堂','乐乐',10,'|',1,9,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第011集/乐乐课堂-三国演义-第011集.mp4','乐乐课堂-三国演义-第011集',11,111,'大陆',2030,'乐乐课堂','乐乐',10,'|',1,10,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第012集/乐乐课堂-三国演义-第012集.mp4','乐乐课堂-三国演义-第012集',12,111,'香港',2031,'乐乐课堂','乐乐',10,'|',1,11,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第013集/乐乐课堂-三国演义-第013集.mp4','乐乐课堂-三国演义-第013集',13,111,'香港',2032,'乐乐课堂','乐乐',10,'|',1,12,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第014集/乐乐课堂-三国演义-第014集.mp4','乐乐课堂-三国演义-第014集',14,111,'香港',2033,'乐乐课堂','乐乐',10,'|',1,13,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第015集/乐乐课堂-三国演义-第015集.mp4','乐乐课堂-三国演义-第015集',15,111,'香港',2034,'乐乐课堂','乐乐',10,'|',1,14,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第016集/乐乐课堂-三国演义-第016集.mp4','乐乐课堂-三国演义-第016集',16,111,'香港',2035,'乐乐课堂','乐乐',10,'|',1,15,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第017集/乐乐课堂-三国演义-第017集.mp4','乐乐课堂-三国演义-第017集',17,111,'香港',2036,'乐乐课堂','乐乐',10,'|',1,16,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第018集/乐乐课堂-三国演义-第018集.mp4','乐乐课堂-三国演义-第018集',18,111,'香港',2037,'乐乐课堂','乐乐',10,'|',1,17,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第019集/乐乐课堂-三国演义-第019集.mp4','乐乐课堂-三国演义-第019集',19,111,'香港',2038,'乐乐课堂','乐乐',10,'|',1,18,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第020集/乐乐课堂-三国演义-第020集.mp4','乐乐课堂-三国演义-第020集',20,111,'香港',2039,'乐乐课堂','乐乐',10,'|',1,19,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第021集/乐乐课堂-三国演义-第021集.mp4','乐乐课堂-三国演义-第021集',21,111,'香港',2040,'乐乐课堂','乐乐',10,'|',1,20,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第022集/乐乐课堂-三国演义-第022集.mp4','乐乐课堂-三国演义-第022集',22,111,'香港',2041,'乐乐课堂','乐乐',10,'|',1,21,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第023集/乐乐课堂-三国演义-第023集.mp4','乐乐课堂-三国演义-第023集',23,111,'香港',2042,'乐乐课堂','乐乐',10,'|',1,22,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第024集/乐乐课堂-三国演义-第024集.mp4','乐乐课堂-三国演义-第024集',24,111,'香港',2043,'乐乐课堂','乐乐',10,'|',1,23,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第025集/乐乐课堂-三国演义-第025集.mp4','乐乐课堂-三国演义-第025集',25,111,'香港',2044,'乐乐课堂','乐乐',10,'|',1,24,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第026集/乐乐课堂-三国演义-第026集.mp4','乐乐课堂-三国演义-第026集',26,111,'香港',2045,'乐乐课堂','乐乐',10,'|',1,25,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第027集/乐乐课堂-三国演义-第027集.mp4','乐乐课堂-三国演义-第027集',27,111,'香港',2046,'乐乐课堂','乐乐',10,'|',1,26,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第028集/乐乐课堂-三国演义-第028集.mp4','乐乐课堂-三国演义-第028集',28,111,'台湾',2047,'乐乐课堂','乐乐',10,'|',1,27,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第029集/乐乐课堂-三国演义-第029集.mp4','乐乐课堂-三国演义-第029集',29,111,'台湾',2048,'乐乐课堂','乐乐',10,'|',1,28,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第030集/乐乐课堂-三国演义-第030集.mp4','乐乐课堂-三国演义-第030集',30,111,'台湾',2049,'乐乐课堂','乐乐',10,'|',1,29,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第031集/乐乐课堂-三国演义-第031集.mp4','乐乐课堂-三国演义-第031集',31,111,'台湾',2050,'乐乐课堂','乐乐',10,'|',1,30,'2020-03-29 01:21:23','admin');
/*!40000 ALTER TABLE `typeMovie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeSeries`
--

DROP TABLE IF EXISTS `typeSeries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeSeries` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `typeSeries_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeSeries_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeSeries_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeSeries_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeSeries_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeSeries_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeSeries_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeSeries_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeSeries_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeSeries`
--

LOCK TABLES `typeSeries` WRITE;
/*!40000 ALTER TABLE `typeSeries` DISABLE KEYS */;
INSERT INTO `typeSeries` VALUES ('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_001/乐乐课堂_水浒传_001.mp4','乐乐课堂_水浒传_001',1,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,1,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_002/乐乐课堂_水浒传_002.mp4','乐乐课堂_水浒传_002',2,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,2,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_003/乐乐课堂_水浒传_003.mp4','乐乐课堂_水浒传_003',3,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,3,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_004/乐乐课堂_水浒传_004.mp4','乐乐课堂_水浒传_004',4,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,4,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_005/乐乐课堂_水浒传_005.mp4','乐乐课堂_水浒传_005',5,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,5,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_006/乐乐课堂_水浒传_006.mp4','乐乐课堂_水浒传_006',6,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,6,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_007/乐乐课堂_水浒传_007.mp4','乐乐课堂_水浒传_007',7,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,7,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_008/乐乐课堂_水浒传_008.mp4','乐乐课堂_水浒传_008',8,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,8,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_009/乐乐课堂_水浒传_009.mp4','乐乐课堂_水浒传_009',9,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,9,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_010/乐乐课堂_水浒传_010.mp4','乐乐课堂_水浒传_010',10,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,10,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_011/乐乐课堂_水浒传_011.mp4','乐乐课堂_水浒传_011',11,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,11,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_012/乐乐课堂_水浒传_012.mp4','乐乐课堂_水浒传_012',12,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,12,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_013/乐乐课堂_水浒传_013.mp4','乐乐课堂_水浒传_013',13,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,13,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_014/乐乐课堂_水浒传_014.mp4','乐乐课堂_水浒传_014',14,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,14,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_015/乐乐课堂_水浒传_015.mp4','乐乐课堂_水浒传_015',15,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,15,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_016/乐乐课堂_水浒传_016.mp4','乐乐课堂_水浒传_016',16,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,16,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_017/乐乐课堂_水浒传_017.mp4','乐乐课堂_水浒传_017',17,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,17,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_018/乐乐课堂_水浒传_018.mp4','乐乐课堂_水浒传_018',18,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,18,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_019/乐乐课堂_水浒传_019.mp4','乐乐课堂_水浒传_019',19,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,19,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_020/乐乐课堂_水浒传_020.mp4','乐乐课堂_水浒传_020',20,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,20,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_021/乐乐课堂_水浒传_021.mp4','乐乐课堂_水浒传_021',21,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,21,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_022/乐乐课堂_水浒传_022.mp4','乐乐课堂_水浒传_022',22,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,22,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_023/乐乐课堂_水浒传_023.mp4','乐乐课堂_水浒传_023',23,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,23,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_024/乐乐课堂_水浒传_024.mp4','乐乐课堂_水浒传_024',24,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,24,'2020-03-29 01:21:23','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_025/乐乐课堂_水浒传_025.mp4','乐乐课堂_水浒传_025',25,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,25,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_026/乐乐课堂_水浒传_026.mp4','乐乐课堂_水浒传_026',26,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,26,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_027/乐乐课堂_水浒传_027.mp4','乐乐课堂_水浒传_027',27,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,27,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_028/乐乐课堂_水浒传_028.mp4','乐乐课堂_水浒传_028',28,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,28,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_029/乐乐课堂_水浒传_029.mp4','乐乐课堂_水浒传_029',29,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,29,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_030/乐乐课堂_水浒传_030.mp4','乐乐课堂_水浒传_030',30,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,30,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_031/乐乐课堂_水浒传_031.mp4','乐乐课堂_水浒传_031',31,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,31,'2020-03-29 01:21:24','admin');
/*!40000 ALTER TABLE `typeSeries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeVariety`
--

DROP TABLE IF EXISTS `typeVariety`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeVariety` (
  `fileName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) NOT NULL,
  `episodes` int(4) NOT NULL,
  `region` varchar(255) CHARACTER SET utf8 NOT NULL,
  `year` int(11) NOT NULL,
  `director` varchar(255) CHARACTER SET utf8 NOT NULL,
  `actor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(4) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT '1',
  `editTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `fileName` (`fileName`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`),
  CONSTRAINT `typeVariety_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `video` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeVariety_ibfk_2` FOREIGN KEY (`title`) REFERENCES `video` (`title`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeVariety_ibfk_3` FOREIGN KEY (`episode`) REFERENCES `video` (`episode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeVariety_ibfk_4` FOREIGN KEY (`episodes`) REFERENCES `video` (`episodes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeVariety_ibfk_5` FOREIGN KEY (`region`) REFERENCES `video` (`region`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeVariety_ibfk_6` FOREIGN KEY (`year`) REFERENCES `video` (`year`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeVariety_ibfk_7` FOREIGN KEY (`director`) REFERENCES `video` (`director`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeVariety_ibfk_8` FOREIGN KEY (`actor`) REFERENCES `video` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeVariety_ibfk_9` FOREIGN KEY (`score`) REFERENCES `video` (`score`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeVariety`
--

LOCK TABLES `typeVariety` WRITE;
/*!40000 ALTER TABLE `typeVariety` DISABLE KEYS */;
INSERT INTO `typeVariety` VALUES ('/usr/local/nginx/html/myLive/vod/01-01唐朝的诗歌概况/01-01唐朝的诗歌概况.mp4','唐朝的诗歌概况',121,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,1,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/01-02王勃的创作风格、代表作品/01-02王勃的创作风格、代表作品.mp4','王勃的创作风格、代表作品',122,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,2,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/01-03王勃《送杜少府之任蜀州》赏析/01-03王勃《送杜少府之任蜀州》赏析.mp4','王勃《送杜少府之任蜀州》赏析',123,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,3,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/01-04杨炯《从军行》赏析/01-04杨炯《从军行》赏析.mp4','杨炯《从军行》赏析',124,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,4,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/01-05骆宾王《咏鹅》赏析/01-05骆宾王《咏鹅》赏析.mp4','骆宾王《咏鹅》赏析',125,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,5,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/01-06李峤《风》赏析/01-06李峤《风》赏析.mp4','李峤《风》赏析',126,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,6,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/01-07陈子昂的诗歌创作风格/01-07陈子昂的诗歌创作风格.mp4','陈子昂的诗歌创作风格',127,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,7,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/01-08陈子昂《登幽州台歌》赏析/01-08陈子昂《登幽州台歌》赏析.mp4','陈子昂《登幽州台歌》赏析',128,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,8,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-01【英】安东尼·布朗的创作风格/10-01【英】安东尼·布朗的创作风格.mp4','【英】安东尼·布朗的创作风格',129,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,9,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-04【英】罗尔德·达尔的创作风格/10-04【英】罗尔德·达尔的创作风格.mp4','【英】罗尔德·达尔的创作风格',132,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,10,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-07【德】米切尔·恩德的创作风格/10-07【德】米切尔·恩德的创作风格.mp4','【德】米切尔·恩德的创作风格',135,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,11,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-09【德】米切尔·恩德《永远讲不完的故事》赏析/10-09【德】米切尔·恩德《永远讲不完的故事》赏析.mp4','【德】米切尔·恩德《永远讲不完的故事》赏析',137,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,12,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-10【日】安房直子的创作风格/10-10【日】安房直子的创作风格.mp4','【日】安房直子的创作风格',138,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,13,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-11【日】安房直子《狐狸的窗户》赏析/10-11【日】安房直子《狐狸的窗户》赏析.mp4','【日】安房直子《狐狸的窗户》赏析',139,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,14,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-12【日】安房直子《系围裙的母鸡》赏析/10-12【日】安房直子《系围裙的母鸡》赏析.mp4','【日】安房直子《系围裙的母鸡》赏析',140,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,15,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-13【丹】《安徒生童话》创作风格/10-13【丹】《安徒生童话》创作风格.mp4','【丹】《安徒生童话》创作风格',141,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,16,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-14【阿】《一千零一夜》创作风格/10-14【阿】《一千零一夜》创作风格.mp4','【阿】《一千零一夜》创作风格',142,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,17,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-15曹文轩的创作风格/10-15曹文轩的创作风格.mp4','曹文轩的创作风格',143,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,18,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-16曹文轩《第十一根红布条》赏析/10-16曹文轩《第十一根红布条》赏析.mp4','曹文轩《第十一根红布条》赏析',144,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,19,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-17曹文轩《草房子》赏析/10-17曹文轩《草房子》赏析.mp4','曹文轩《草房子》赏析',145,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,20,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-18沈石溪的创作风格/10-18沈石溪的创作风格.mp4','沈石溪的创作风格',146,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,21,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-19沈石溪《狼王梦》赏析/10-19沈石溪《狼王梦》赏析.mp4','沈石溪《狼王梦》赏析',147,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,22,'2020-03-29 01:21:24','admin'),('/usr/local/nginx/html/myLive/vod/10-20沈石溪《再被狐狸骗一次》赏析/10-20沈石溪《再被狐狸骗一次》赏析.mp4','沈石溪《再被狐狸骗一次》赏析',148,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',1,23,'2020-03-29 01:21:24','admin');
/*!40000 ALTER TABLE `typeVariety` ENABLE KEYS */;
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
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT ' ',
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `episode` int(4) DEFAULT '1',
  `episodes` int(4) NOT NULL DEFAULT '1',
  `region` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `director` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `actor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `score` int(4) DEFAULT NULL,
  `tag` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `playnum` int(8) DEFAULT NULL,
  `uploadTime` datetime DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `second` float DEFAULT NULL,
  `bitrate` int(11) DEFAULT NULL,
  `vcodec` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `vformat` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `acodec` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `asamplerate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `resolution` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `id` (`id`),
  KEY `title` (`title`),
  KEY `episode` (`episode`),
  KEY `episodes` (`episodes`),
  KEY `region` (`region`),
  KEY `year` (`year`),
  KEY `director` (`director`),
  KEY `actor` (`actor`),
  KEY `score` (`score`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,'/usr/local/nginx/html/myLive/vod/01-01唐朝的诗歌概况/01-01唐朝的诗歌概况.mp4','唐朝的诗歌概况','综艺',121,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 20:54:34','00:04:15.40',255.4,445,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.56MB'),(2,'/usr/local/nginx/html/myLive/vod/01-02王勃的创作风格、代表作品/01-02王勃的创作风格、代表作品.mp4','王勃的创作风格、代表作品','综艺',122,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 20:55:30','00:04:28.70',268.7,483,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','15.47MB'),(3,'/usr/local/nginx/html/myLive/vod/01-03王勃《送杜少府之任蜀州》赏析/01-03王勃《送杜少府之任蜀州》赏析.mp4','王勃《送杜少府之任蜀州》赏析','综艺',123,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 20:57:30','00:04:56.26',296.26,392,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.86MB'),(4,'/usr/local/nginx/html/myLive/vod/01-04杨炯《从军行》赏析/01-04杨炯《从军行》赏析.mp4','杨炯《从军行》赏析','综艺',124,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 20:58:16','00:04:41.43',281.43,524,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.6MB'),(5,'/usr/local/nginx/html/myLive/vod/01-05骆宾王《咏鹅》赏析/01-05骆宾王《咏鹅》赏析.mp4','骆宾王《咏鹅》赏析','综艺',125,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 21:02:13','00:04:25.31',265.31,635,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.09MB'),(6,'/usr/local/nginx/html/myLive/vod/01-06李峤《风》赏析/01-06李峤《风》赏析.mp4','李峤《风》赏析','综艺',126,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 21:02:31','00:04:20.46',260.46,633,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.68MB'),(7,'/usr/local/nginx/html/myLive/vod/01-07陈子昂的诗歌创作风格/01-07陈子昂的诗歌创作风格.mp4','陈子昂的诗歌创作风格','综艺',127,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 21:02:30','00:03:54.80',234.8,470,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.16MB'),(8,'/usr/local/nginx/html/myLive/vod/01-08陈子昂《登幽州台歌》赏析/01-08陈子昂《登幽州台歌》赏析.mp4','陈子昂《登幽州台歌》赏析','综艺',128,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 21:02:34','00:04:47.44',287.44,517,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.75MB'),(9,'/usr/local/nginx/html/myLive/vod/02-01贺知章的诗歌创作风格/02-01贺知章的诗歌创作风格.mp4','02-01贺知章的诗歌创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:42:07','00:03:54.82',234.82,461,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.92MB'),(10,'/usr/local/nginx/html/myLive/vod/02-02贺知章《咏柳》赏析/02-02贺知章《咏柳》赏析.mp4','02-02贺知章《咏柳》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:43:16','00:04:11.56',251.56,943,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','28.29MB'),(11,'/usr/local/nginx/html/myLive/vod/02-03贺知章《回乡偶书（其一）》赏析/02-03贺知章《回乡偶书（其一）》赏析.mp4','02-03贺知章《回乡偶书（其一）》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:42:03','00:04:30.33',270.33,354,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.43MB'),(12,'/usr/local/nginx/html/myLive/vod/02-04孟浩然的诗歌创作风格/02-04孟浩然的诗歌创作风格.mp4','02-04孟浩然的诗歌创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:42:27','00:04:04.88',244.88,589,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.2MB'),(13,'/usr/local/nginx/html/myLive/vod/02-05孟浩然《春晓》赏析/02-05孟浩然《春晓》赏析.mp4','02-05孟浩然《春晓》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:43:18','00:04:47.14',287.14,839,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','28.75MB'),(14,'/usr/local/nginx/html/myLive/vod/02-06孟浩然《过故人庄》赏析/02-06孟浩然《过故人庄》赏析.mp4','02-06孟浩然《过故人庄》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:43:28','00:05:14.07',314.07,840,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','31.47MB'),(15,'/usr/local/nginx/html/myLive/vod/02-07王维的诗歌创作风格/02-07王维的诗歌创作风格.mp4','02-07王维的诗歌创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:42:04','00:03:44.03',224.03,422,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.28MB'),(16,'/usr/local/nginx/html/myLive/vod/02-08王维《九月九日忆山东兄弟》赏析/02-08王维《九月九日忆山东兄弟》赏析.mp4','02-08王维《九月九日忆山东兄弟》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:43:19','00:04:47.32',287.32,836,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','28.65MB'),(17,'/usr/local/nginx/html/myLive/vod/02-09王维《鸟鸣涧》赏析/02-09王维《鸟鸣涧》赏析.mp4','02-09王维《鸟鸣涧》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:43:24','00:05:05.67',305.67,834,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.42MB'),(18,'/usr/local/nginx/html/myLive/vod/02-10王维《使至塞上》赏析/02-10王维《使至塞上》赏析.mp4','02-10王维《使至塞上》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:44:10','00:04:51.76',291.76,836,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.09MB'),(19,'/usr/local/nginx/html/myLive/vod/02-11王维《送元二使安西》赏析/02-11王维《送元二使安西》赏析.mp4','02-11王维《送元二使安西》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:44:15','00:05:04.74',304.74,841,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.56MB'),(20,'/usr/local/nginx/html/myLive/vod/02-12王维《鹿柴》赏析/02-12王维《鹿柴》赏析.mp4','02-12王维《鹿柴》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:44:00','00:04:17.16',257.16,826,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.35MB'),(21,'/usr/local/nginx/html/myLive/vod/02-13王维《竹里馆》赏析/02-13王维《竹里馆》赏析.mp4','02-13王维《竹里馆》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:44:35','00:05:01.53',301.53,828,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.79MB'),(22,'/usr/local/nginx/html/myLive/vod/02-14王维《山居秋暝》赏析/02-14王维《山居秋暝》赏析.mp4','02-14王维《山居秋暝》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:45:13','00:04:41.66',281.66,836,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','28.08MB'),(23,'/usr/local/nginx/html/myLive/vod/03-01王之涣的创作风格/03-01王之涣的创作风格.mp4','03-01王之涣的创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:44:10','00:03:41.54',221.54,443,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.71MB'),(24,'/usr/local/nginx/html/myLive/vod/03-02王之涣《登鹳雀楼》赏析/03-02王之涣《登鹳雀楼》赏析.mp4','03-02王之涣《登鹳雀楼》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:45:24','00:04:43.40',283.4,892,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.15MB'),(25,'/usr/local/nginx/html/myLive/vod/03-03王之涣《凉州词》赏析/03-03王之涣《凉州词》赏析.mp4','03-03王之涣《凉州词》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:44:47','00:04:44.63',284.63,584,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.82MB'),(26,'/usr/local/nginx/html/myLive/vod/03-04王昌龄的创作风格/03-04王昌龄的创作风格.mp4','03-04王昌龄的创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:44:31','00:04:05.83',245.83,487,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.3MB'),(27,'/usr/local/nginx/html/myLive/vod/03-05王昌龄《从军行（其四）》赏析/03-05王昌龄《从军行（其四）》赏析.mp4','03-05王昌龄《从军行（其四）》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:45:26','00:04:57.03',297.03,581,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.59MB'),(28,'/usr/local/nginx/html/myLive/vod/03-06王昌龄《出塞》赏析/03-06王昌龄《出塞》赏析.mp4','03-06王昌龄《出塞》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:46:06','00:04:52.64',292.64,887,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.96MB'),(29,'/usr/local/nginx/html/myLive/vod/03-07王昌龄《芙蓉楼送辛渐》赏析/03-07王昌龄《芙蓉楼送辛渐》赏析.mp4','03-07王昌龄《芙蓉楼送辛渐》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:46:11','00:05:09.71',309.71,891,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','32.9MB'),(30,'/usr/local/nginx/html/myLive/vod/03-08岑参的诗歌创作风格/03-08岑参的诗歌创作风格.mp4','03-08岑参的诗歌创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:45:35','00:04:07.50',247.5,633,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','18.68MB'),(31,'/usr/local/nginx/html/myLive/vod/03-09高适的诗歌创作风格/03-09高适的诗歌创作风格.mp4','03-09高适的诗歌创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:45:49','00:03:57.19',237.19,678,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.18MB'),(32,'/usr/local/nginx/html/myLive/vod/03-10高适《别董大》赏析/03-10高适《别董大》赏析.mp4','03-10高适《别董大》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:45:35','00:04:39.50',279.5,417,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.92MB'),(33,'/usr/local/nginx/html/myLive/vod/03-11张旭《桃花溪》赏析/03-11张旭《桃花溪》赏析.mp4','03-11张旭《桃花溪》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:46:28','00:05:23.83',323.83,841,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','32.47MB'),(34,'/usr/local/nginx/html/myLive/vod/03-12崔颢《黄鹤楼》赏析/03-12崔颢《黄鹤楼》赏析.mp4','03-12崔颢《黄鹤楼》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:46:33','00:04:41.70',281.7,891,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.95MB'),(35,'/usr/local/nginx/html/myLive/vod/03-13王湾《次北固山下》赏析/03-13王湾《次北固山下》赏析.mp4','03-13王湾《次北固山下》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:46:45','00:05:02.97',302.97,1420,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','800x480','51.29MB'),(36,'/usr/local/nginx/html/myLive/vod/03-14王翰《凉州词》赏析/03-14王翰《凉州词》赏析.mp4','03-14王翰《凉州词》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|',NULL,'2020-03-20 00:46:34','00:04:35.04',275.04,841,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','27.58MB'),(37,'/usr/local/nginx/html/myLive/vod/04-01李白的诗歌创作风格/04-01李白的诗歌创作风格.mp4','04-01李白的诗歌创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:07:49','00:03:51.36',231.36,369,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','10.19MB'),(38,'/usr/local/nginx/html/myLive/vod/04-02李白《峨眉山月歌》/04-02李白《峨眉山月歌》.mp4','04-02李白《峨眉山月歌》',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:08:39','00:04:40.31',280.31,633,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','21.18MB'),(39,'/usr/local/nginx/html/myLive/vod/04-03李白《望天门山》赏析/04-03李白《望天门山》赏析.mp4','04-03李白《望天门山》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:08:37','00:04:33.58',273.58,635,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.72MB'),(40,'/usr/local/nginx/html/myLive/vod/04-04李白《望庐山瀑布》赏析/04-04李白《望庐山瀑布》赏析.mp4','04-04李白《望庐山瀑布》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:08:36','00:04:29.54',269.54,635,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.42MB'),(41,'/usr/local/nginx/html/myLive/vod/04-05李白《夜宿山寺》赏析/04-05李白《夜宿山寺》赏析.mp4','04-05李白《夜宿山寺》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:08:44','00:04:57.94',297.94,637,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','22.64MB'),(42,'/usr/local/nginx/html/myLive/vod/04-06李白《黄鹤楼送孟浩然之广陵》赏析/04-06李白《黄鹤楼送孟浩然之广陵》赏析.mp4','04-06李白《黄鹤楼送孟浩然之广陵》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:09:01','00:05:32.51',332.51,705,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','27.98MB'),(43,'/usr/local/nginx/html/myLive/vod/04-07李白《静夜思》赏析/04-07李白《静夜思》赏析.mp4','04-07李白《静夜思》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:08:39','00:04:42.26',282.26,638,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','21.5MB'),(44,'/usr/local/nginx/html/myLive/vod/04-08李白《闻王昌龄左迁龙标遥有此寄》赏析/04-08李白《闻王昌龄左迁龙标遥有此寄》赏析.mp4','04-08李白《闻王昌龄左迁龙标遥有此寄》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:09:07','00:05:00.07',300.07,837,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.97MB'),(45,'/usr/local/nginx/html/myLive/vod/04-09李白《月下独酌》赏析/04-09李白《月下独酌》赏析.mp4','04-09李白《月下独酌》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:08:37','00:05:21.67',321.67,510,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.56MB'),(46,'/usr/local/nginx/html/myLive/vod/04-10李白《古朗月行》赏析/04-10李白《古朗月行》赏析.mp4','04-10李白《古朗月行》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:09:17','00:05:19.67',319.67,614,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','23.42MB'),(47,'/usr/local/nginx/html/myLive/vod/04-11李白《赠汪伦》赏析/04-11李白《赠汪伦》赏析.mp4','04-11李白《赠汪伦》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:09:32','00:04:43.91',283.91,638,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','21.61MB'),(48,'/usr/local/nginx/html/myLive/vod/04-12李白《秋浦歌》赏析/04-12李白《秋浦歌》赏析.mp4','04-12李白《秋浦歌》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:09:29','00:04:14.17',254.17,632,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.17MB'),(49,'/usr/local/nginx/html/myLive/vod/04-13李白《独坐敬亭山》赏析/04-13李白《独坐敬亭山》赏析.mp4','04-13李白《独坐敬亭山》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:09:20','00:04:44.37',284.37,391,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.27MB'),(50,'/usr/local/nginx/html/myLive/vod/04-14李白《早发白帝城》赏析/04-14李白《早发白帝城》赏析.mp4','04-14李白《早发白帝城》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:09:32','00:04:52.34',292.34,636,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','22.17MB'),(51,'/usr/local/nginx/html/myLive/vod/05-01杜甫的诗歌创作风格/05-01杜甫的诗歌创作风格.mp4','05-01杜甫的诗歌创作风格',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:14:45','00:04:39.01',279.01,438,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.57MB'),(52,'/usr/local/nginx/html/myLive/vod/05-02杜甫《望岳》赏析/05-02杜甫《望岳》赏析.mp4','05-02杜甫《望岳》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:14:51','00:04:43.70',283.7,481,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.3MB'),(53,'/usr/local/nginx/html/myLive/vod/05-03杜甫《房兵曹胡马》赏析/05-03杜甫《房兵曹胡马》赏析.mp4','05-03杜甫《房兵曹胡马》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:15:43','00:05:28.84',328.84,838,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','32.88MB'),(54,'/usr/local/nginx/html/myLive/vod/05-04杜甫《春望》赏析/05-04杜甫《春望》赏析.mp4','05-04杜甫《春望》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:14:54','00:05:06.11',306.11,460,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.82MB'),(55,'/usr/local/nginx/html/myLive/vod/05-05杜甫《石壕吏》赏析/05-05杜甫《石壕吏》赏析.mp4','05-05杜甫《石壕吏》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:14:58','00:05:38.96',338.96,443,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.91MB'),(56,'/usr/local/nginx/html/myLive/vod/05-06杜甫《春夜喜雨》赏析/05-06杜甫《春夜喜雨》赏析.mp4','05-06杜甫《春夜喜雨》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:15:40','00:05:09.03',309.03,841,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.99MB'),(57,'/usr/local/nginx/html/myLive/vod/05-07杜甫《江畔独步寻花》赏析/05-07杜甫《江畔独步寻花》赏析.mp4','05-07杜甫《江畔独步寻花》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:15:25','00:04:19.46',259.46,839,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.97MB'),(58,'/usr/local/nginx/html/myLive/vod/05-08杜甫《赠花卿》赏析/05-08杜甫《赠花卿》赏析.mp4','05-08杜甫《赠花卿》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:15:38','00:05:00.98',300.98,832,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.88MB'),(59,'/usr/local/nginx/html/myLive/vod/05-09杜甫《绝句・两个黄鹂鸣翠柳》赏析/05-09杜甫《绝句・两个黄鹂鸣翠柳》赏析.mp4','05-09杜甫《绝句・两个黄鹂鸣翠柳》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:15:38','00:04:57.61',297.61,841,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.87MB'),(60,'/usr/local/nginx/html/myLive/vod/05-10杜甫《绝句・迟日江山丽》赏析/05-10杜甫《绝句・迟日江山丽》赏析.mp4','05-10杜甫《绝句・迟日江山丽》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:15:53','00:04:29.77',269.77,838,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','26.96MB'),(61,'/usr/local/nginx/html/myLive/vod/05-11杜甫《闻官军收河南河北》赏析/05-11杜甫《闻官军收河南河北》赏析.mp4','05-11杜甫《闻官军收河南河北》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|唐朝|李杜|',NULL,'2020-03-20 08:15:56','00:05:08.64',308.64,836,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.77MB'),(62,'/usr/local/nginx/html/myLive/vod/10-01【英】安东尼·布朗的创作风格/10-01【英】安东尼·布朗的创作风格.mp4','【英】安东尼·布朗的创作风格','综艺',129,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:17:30','00:04:07.34',247.34,387,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.41MB'),(63,'/usr/local/nginx/html/myLive/vod/10-02【英】安东尼・布朗《隧道》赏析/10-02【英】安东尼・布朗《隧道》赏析.mp4','10-02【英】安东尼・布朗《隧道》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|儿童|',NULL,'2020-03-20 09:17:29','00:04:20.81',260.81,352,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','10.97MB'),(64,'/usr/local/nginx/html/myLive/vod/10-03【英】安东尼・布朗《形状游戏》赏析/10-03【英】安东尼・布朗《形状游戏》赏析.mp4','10-03【英】安东尼・布朗《形状游戏》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|儿童|',NULL,'2020-03-20 09:17:22','00:03:34.34',214.34,353,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','9.04MB'),(65,'/usr/local/nginx/html/myLive/vod/10-04【英】罗尔德·达尔的创作风格/10-04【英】罗尔德·达尔的创作风格.mp4','【英】罗尔德·达尔的创作风格','综艺',132,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:17:47','00:03:45.79',225.79,561,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','15.1MB'),(66,'/usr/local/nginx/html/myLive/vod/10-05【英】罗尔德・达尔《查理和巧克力工厂》赏析/10-05【英】罗尔德・达尔《查理和巧克力工厂》赏析.mp4','10-05【英】罗尔德・达尔《查理和巧克力工厂》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|儿童|',NULL,'2020-03-20 09:17:26','00:03:36.13',216.13,377,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','9.73MB'),(67,'/usr/local/nginx/html/myLive/vod/10-06【英】罗尔德・达尔《女巫》赏析/10-06【英】罗尔德・达尔《女巫》赏析.mp4','10-06【英】罗尔德・达尔《女巫》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|儿童|',NULL,'2020-03-20 09:17:46','00:04:04.27',244.27,499,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.54MB'),(68,'/usr/local/nginx/html/myLive/vod/10-07【德】米切尔·恩德的创作风格/10-07【德】米切尔·恩德的创作风格.mp4','【德】米切尔·恩德的创作风格','综艺',135,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:17:44','00:03:57.19',237.19,498,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.1MB'),(69,'/usr/local/nginx/html/myLive/vod/10-08【德】米切尔・恩德《毛毛》赏析/10-08【德】米切尔・恩德《毛毛》赏析.mp4','10-08【德】米切尔・恩德《毛毛》赏析',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|儿童|',NULL,'2020-03-20 09:17:57','00:04:35.53',275.53,540,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.75MB'),(70,'/usr/local/nginx/html/myLive/vod/10-09【德】米切尔·恩德《永远讲不完的故事》赏析/10-09【德】米切尔·恩德《永远讲不完的故事》赏析.mp4','【德】米切尔·恩德《永远讲不完的故事》赏析','综艺',137,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:17:51','00:04:21.97',261.97,515,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.11MB'),(71,'/usr/local/nginx/html/myLive/vod/10-10【日】安房直子的创作风格/10-10【日】安房直子的创作风格.mp4','【日】安房直子的创作风格','综艺',138,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:18:12','00:03:27.73',207.73,456,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.3MB'),(72,'/usr/local/nginx/html/myLive/vod/10-11【日】安房直子《狐狸的窗户》赏析/10-11【日】安房直子《狐狸的窗户》赏析.mp4','【日】安房直子《狐狸的窗户》赏析','综艺',139,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:18:11','00:03:49.90',229.9,379,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','10.39MB'),(73,'/usr/local/nginx/html/myLive/vod/10-12【日】安房直子《系围裙的母鸡》赏析/10-12【日】安房直子《系围裙的母鸡》赏析.mp4','【日】安房直子《系围裙的母鸡》赏析','综艺',140,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:18:43','00:03:41.96',221.96,672,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.8MB'),(74,'/usr/local/nginx/html/myLive/vod/10-13【丹】《安徒生童话》创作风格/10-13【丹】《安徒生童话》创作风格.mp4','【丹】《安徒生童话》创作风格','综艺',141,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:18:21','00:04:06.06',246.06,403,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.83MB'),(75,'/usr/local/nginx/html/myLive/vod/10-14【阿】《一千零一夜》创作风格/10-14【阿】《一千零一夜》创作风格.mp4','【阿】《一千零一夜》创作风格','综艺',142,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:18:53','00:03:57.87',237.87,628,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.84MB'),(76,'/usr/local/nginx/html/myLive/vod/10-15曹文轩的创作风格/10-15曹文轩的创作风格.mp4','曹文轩的创作风格','综艺',143,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:18:54','00:03:56.61',236.61,635,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.94MB'),(77,'/usr/local/nginx/html/myLive/vod/10-16曹文轩《第十一根红布条》赏析/10-16曹文轩《第十一根红布条》赏析.mp4','曹文轩《第十一根红布条》赏析','综艺',144,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:19:02','00:04:17.28',257.28,770,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','23.62MB'),(78,'/usr/local/nginx/html/myLive/vod/10-17曹文轩《草房子》赏析/10-17曹文轩《草房子》赏析.mp4','曹文轩《草房子》赏析','综艺',145,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:18:43','00:04:28.84',268.84,365,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.7MB'),(79,'/usr/local/nginx/html/myLive/vod/10-18沈石溪的创作风格/10-18沈石溪的创作风格.mp4','沈石溪的创作风格','综艺',146,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:18:59','00:03:52.97',232.97,623,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.32MB'),(80,'/usr/local/nginx/html/myLive/vod/10-19沈石溪《狼王梦》赏析/10-19沈石溪《狼王梦》赏析.mp4','沈石溪《狼王梦》赏析','综艺',147,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:19:00','00:04:06.53',246.53,496,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.6MB'),(81,'/usr/local/nginx/html/myLive/vod/10-20沈石溪《再被狐狸骗一次》赏析/10-20沈石溪《再被狐狸骗一次》赏析.mp4','沈石溪《再被狐狸骗一次》赏析','综艺',148,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 09:19:02','00:04:07.73',247.73,555,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.42MB'),(82,'/usr/local/nginx/html/myLive/vod/12-01宋词概述/12-01宋词概述.mp4','宋词概述','动漫',149,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:15:47','00:04:42.47',282.47,386,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.01MB'),(83,'/usr/local/nginx/html/myLive/vod/12-02李煜及其创作/12-02李煜及其创作.mp4','李煜及其创作','动漫',150,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:15:50','00:04:03.28',243.28,489,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.2MB'),(84,'/usr/local/nginx/html/myLive/vod/12-03《虞美人春花秋月何时了》导读/12-03《虞美人春花秋月何时了》导读.mp4','《虞美人春花秋月何时了》导读','动漫',151,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:15:46','00:04:49.99',289.99,361,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.51MB'),(85,'/usr/local/nginx/html/myLive/vod/12-04《相见欢》导读/12-04《相见欢》导读.mp4','《相见欢》导读','动漫',152,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:15:30','00:04:29.49',269.49,252,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','8.11MB'),(86,'/usr/local/nginx/html/myLive/vod/12-05《浪淘沙令帘外雨潺潺》导读/12-05《浪淘沙令帘外雨潺潺》导读.mp4','《浪淘沙令帘外雨潺潺》导读','动漫',153,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:14','00:04:04.88',244.88,711,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.77MB'),(87,'/usr/local/nginx/html/myLive/vod/12-06柳永及其创作/12-06柳永及其创作.mp4','柳永及其创作','动漫',154,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:15:50','00:03:39.80',219.8,528,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.85MB'),(88,'/usr/local/nginx/html/myLive/vod/12-07《雨霖铃寒蝉凄切》导读/12-07《雨霖铃寒蝉凄切》导读.mp4','《雨霖铃寒蝉凄切》导读','动漫',155,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:15:48','00:05:04.90',304.9,366,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.33MB'),(89,'/usr/local/nginx/html/myLive/vod/12-08《望海潮东南形胜》导读/12-08《望海潮东南形胜》导读.mp4','《望海潮东南形胜》导读','动漫',156,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:03','00:05:17.16',317.16,449,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.01MB'),(90,'/usr/local/nginx/html/myLive/vod/12-09晏殊及其创作/12-09晏殊及其创作.mp4','晏殊及其创作','动漫',157,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:15:44','00:04:30.21',270.21,352,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.35MB'),(91,'/usr/local/nginx/html/myLive/vod/12-10《蝶恋花槛菊愁烟兰泣露》导读/12-10《蝶恋花槛菊愁烟兰泣露》导读.mp4','《蝶恋花槛菊愁烟兰泣露》导读','动漫',158,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:18','00:04:45.98',285.98,361,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.31MB'),(92,'/usr/local/nginx/html/myLive/vod/12-11《浣溪沙一曲新词酒一杯》导读/12-11《浣溪沙一曲新词酒一杯》导读.mp4','《浣溪沙一曲新词酒一杯》导读','动漫',159,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:24','00:04:15.51',255.51,330,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','10.08MB'),(93,'/usr/local/nginx/html/myLive/vod/12-12范仲淹及其创作/12-12范仲淹及其创作.mp4','范仲淹及其创作','动漫',160,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:37','00:05:00.54',300.54,356,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.79MB'),(94,'/usr/local/nginx/html/myLive/vod/12-13《渔家傲秋思》导读/12-13《渔家傲秋思》导读.mp4','《渔家傲秋思》导读','动漫',161,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:41','00:05:06.71',306.71,378,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.83MB'),(95,'/usr/local/nginx/html/myLive/vod/12-14《岳阳楼记》导读/12-14《岳阳楼记》导读.mp4','《岳阳楼记》导读','动漫',162,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:56','00:05:33.21',333.21,450,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.9MB'),(96,'/usr/local/nginx/html/myLive/vod/12-15欧阳修及其创作/12-15欧阳修及其创作.mp4','欧阳修及其创作','动漫',163,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:34','00:04:26.10',266.1,360,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.44MB'),(97,'/usr/local/nginx/html/myLive/vod/12-16《蝶恋花庭院深深深几许》导读/12-16《蝶恋花庭院深深深几许》导读.mp4','《蝶恋花庭院深深深几许》导读','动漫',164,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:16:50','00:04:45.14',285.14,444,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','15.12MB'),(98,'/usr/local/nginx/html/myLive/vod/12-17《醉翁亭记》导读/12-17《醉翁亭记》导读.mp4','《醉翁亭记》导读','动漫',165,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:21','00:05:34.88',334.88,502,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.05MB'),(99,'/usr/local/nginx/html/myLive/vod/13-01王安石及其创作/13-01王安石及其创作.mp4','王安石及其创作','动漫',166,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:08','00:04:47.67',287.67,380,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.06MB'),(100,'/usr/local/nginx/html/myLive/vod/13-02《桂枝香金陵怀古》导读/13-02《桂枝香金陵怀古》导读.mp4','《桂枝香金陵怀古》导读','动漫',167,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:22','00:05:57.10',357.1,392,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.69MB'),(101,'/usr/local/nginx/html/myLive/vod/13-03《登飞来峰》导读/13-03《登飞来峰》导读.mp4','《登飞来峰》导读','动漫',168,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:10','00:03:48.23',228.23,421,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.47MB'),(102,'/usr/local/nginx/html/myLive/vod/13-04《泊船瓜洲》导读/13-04《泊船瓜洲》导读.mp4','《泊船瓜洲》导读','动漫',169,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:18','00:03:54.89',234.89,390,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','10.94MB'),(103,'/usr/local/nginx/html/myLive/vod/13-05苏轼及其创作/13-05苏轼及其创作.mp4','苏轼及其创作','动漫',170,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:38','00:05:01.51',301.51,470,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.92MB'),(104,'/usr/local/nginx/html/myLive/vod/13-06《念奴娇赤壁怀古》导读/13-06《念奴娇赤壁怀古》导读.mp4','《念奴娇赤壁怀古》导读','动漫',171,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:18:08','00:05:31.23',331.23,644,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.46MB'),(105,'/usr/local/nginx/html/myLive/vod/13-07《水调歌头明月几时有》导读/13-07《水调歌头明月几时有》导读.mp4','《水调歌头明月几时有》导读','动漫',172,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:34','00:05:22.53',322.53,306,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.79MB'),(106,'/usr/local/nginx/html/myLive/vod/13-08《饮湖上初晴后雨》导读/13-08《饮湖上初晴后雨》导读.mp4','《饮湖上初晴后雨》导读','动漫',173,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:52','00:03:48.60',228.6,543,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.82MB'),(107,'/usr/local/nginx/html/myLive/vod/13-09《定风波》导读/13-09《定风波》导读.mp4','《定风波》导读','动漫',174,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:18:09','00:04:07.71',247.71,599,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.69MB'),(108,'/usr/local/nginx/html/myLive/vod/13-10《江城子密州出猎》导读/13-10《江城子密州出猎》导读.mp4','《江城子密州出猎》导读','动漫',175,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:18:07','00:04:40.13',280.13,469,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','15.69MB'),(109,'/usr/local/nginx/html/myLive/vod/13-11《江城子乙卯正月二十夜记梦》导读/13-11《江城子乙卯正月二十夜记梦》导读.mp4','《江城子乙卯正月二十夜记梦》导读','动漫',176,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:18:00','00:04:27.38',267.38,348,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.11MB'),(110,'/usr/local/nginx/html/myLive/vod/13-12秦观及其创作/13-12秦观及其创作.mp4','秦观及其创作','动漫',177,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:17:58','00:03:48.35',228.35,353,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','9.62MB'),(111,'/usr/local/nginx/html/myLive/vod/13-13《鹊桥仙纤云弄巧》导读/13-13《鹊桥仙纤云弄巧》导读.mp4','《鹊桥仙纤云弄巧》导读','动漫',178,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:18:06','00:04:22.11',262.11,395,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.37MB'),(112,'/usr/local/nginx/html/myLive/vod/13-14《踏莎行郴州旅舍》导读/13-14《踏莎行郴州旅舍》导读.mp4','《踏莎行郴州旅舍》导读','纪录片',179,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:18:10','00:04:46.09',286.09,334,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.4MB'),(113,'/usr/local/nginx/html/myLive/vod/13-15周邦彦及其创作/13-15周邦彦及其创作.mp4','周邦彦及其创作','纪录片',180,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:18:12','00:04:05.27',245.27,447,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.08MB'),(114,'/usr/local/nginx/html/myLive/vod/13-16《苏幕遮燎沉香》导读/13-16《苏幕遮燎沉香》导读.mp4','《苏幕遮燎沉香》导读','纪录片',181,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:18:14','00:04:19.11',259.11,386,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.94MB'),(115,'/usr/local/nginx/html/myLive/vod/14-01李清照及其创作/14-01李清照及其创作.mp4','李清照及其创作','纪录片',182,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:30:56','00:04:11.03',251.03,439,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.14MB'),(116,'/usr/local/nginx/html/myLive/vod/14-02《声声慢》导读/14-02《声声慢》导读.mp4','《声声慢》导读','纪录片',183,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:30:55','00:05:17.67',317.67,331,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.54MB'),(117,'/usr/local/nginx/html/myLive/vod/14-03《夏日绝句》导读/14-03《夏日绝句》导读.mp4','《夏日绝句》导读','纪录片',184,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:30:54','00:03:20.04',200.04,516,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.33MB'),(118,'/usr/local/nginx/html/myLive/vod/14-04《如梦令》导读/14-04《如梦令》导读.mp4','《如梦令》导读','纪录片',185,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:30:47','00:03:07.59',187.59,445,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','9.96MB'),(119,'/usr/local/nginx/html/myLive/vod/14-05《一剪梅红藕香残玉簟秋》导读/14-05《一剪梅红藕香残玉簟秋》导读.mp4','《一剪梅红藕香残玉簟秋》导读','纪录片',186,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:30:52','00:04:18.53',258.53,364,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.24MB'),(120,'/usr/local/nginx/html/myLive/vod/14-06《醉花阴薄雾浓云愁永昼》导读/14-06《醉花阴薄雾浓云愁永昼》导读.mp4','《醉花阴薄雾浓云愁永昼》导读','纪录片',187,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:05','00:04:29.63',269.63,505,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.23MB'),(121,'/usr/local/nginx/html/myLive/vod/14-07《武陵春春晚》导读/14-07《武陵春春晚》导读.mp4','《武陵春春晚》导读','纪录片',188,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:30:58','00:05:04.74',304.74,378,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.75MB'),(122,'/usr/local/nginx/html/myLive/vod/14-08岳飞及其创作/14-08岳飞及其创作.mp4','岳飞及其创作','纪录片',189,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:30:50','00:03:36.87',216.87,417,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','10.81MB'),(123,'/usr/local/nginx/html/myLive/vod/14-09《满江红》导读/14-09《满江红》导读.mp4','《满江红》导读','纪录片',190,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:30:58','00:05:08.04',308.04,375,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.78MB'),(124,'/usr/local/nginx/html/myLive/vod/14-10《小重山昨夜寒蛩不住鸣》导读/14-10《小重山昨夜寒蛩不住鸣》导读.mp4','=-《小重山昨夜寒蛩不住鸣》导读','纪录片',191,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:25','00:04:32.53',272.53,344,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.18MB'),(125,'/usr/local/nginx/html/myLive/vod/15-01陆游及其创作/15-01陆游及其创作.mp4','陆游及其创作','纪录片',192,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:35','00:04:13.47',253.47,442,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.38MB'),(126,'/usr/local/nginx/html/myLive/vod/15-02《卜算子咏梅》导读/15-02《卜算子咏梅》导读.mp4','《卜算子咏梅》导读','纪录片',193,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:25','00:03:40.10',220.1,378,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','9.94MB'),(127,'/usr/local/nginx/html/myLive/vod/15-03《书愤》导读/15-03《书愤》导读.mp4','《书愤》导读','纪录片',194,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:33','00:04:10.54',250.54,376,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.24MB'),(128,'/usr/local/nginx/html/myLive/vod/15-04《示儿》导读/15-04《示儿》导读.mp4','《示儿》导读','纪录片',195,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:23','00:03:01.09',181.09,349,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','7.55MB'),(129,'/usr/local/nginx/html/myLive/vod/15-05《游山西村》导读/15-05《游山西村》导读.mp4','《游山西村》导读','纪录片',196,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:50','00:04:06.04',246.04,544,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','15.96MB'),(130,'/usr/local/nginx/html/myLive/vod/15-06《临安春雨初霁》导读/15-06《临安春雨初霁》导读.mp4','《临安春雨初霁》导读','纪录片',197,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:47','00:04:29.79',269.79,427,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.75MB'),(131,'/usr/local/nginx/html/myLive/vod/15-07辛弃疾及其创作/15-07辛弃疾及其创作.mp4','辛弃疾及其创作','纪录片',198,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:31:47','00:04:13.03',253.03,447,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.5MB'),(132,'/usr/local/nginx/html/myLive/vod/15-08《青玉案元夕》导读/15-08《青玉案元夕》导读.mp4','《青玉案元夕》导读','纪录片',199,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:32:08','00:05:19.11',319.11,540,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.57MB'),(133,'/usr/local/nginx/html/myLive/vod/15-09《破阵子为陈同甫赋壮词以寄之》导读/15-09《破阵子为陈同甫赋壮词以寄之》导读.mp4','《破阵子为陈同甫赋壮词以寄之》导读','纪录片',200,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:32:06','00:04:52.52',292.52,420,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.67MB'),(134,'/usr/local/nginx/html/myLive/vod/15-10《清平乐村居》导读/15-10《清平乐村居》导读.mp4','《清平乐村居》导读','纪录片',201,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:32:07','00:04:30.61',270.61,441,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.25MB'),(135,'/usr/local/nginx/html/myLive/vod/15-11《西江月夜行黄沙道中》导读/15-11《西江月夜行黄沙道中》导读.mp4','《西江月夜行黄沙道中》导读','纪录片',202,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:32:02','00:04:08.13',248.13,399,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.8MB'),(136,'/usr/local/nginx/html/myLive/vod/15-12姜夔及其创作/15-12姜夔及其创作.mp4','姜夔及其创作','纪录片',203,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:32:08','00:04:49.04',289.04,390,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.45MB'),(137,'/usr/local/nginx/html/myLive/vod/15-13《扬州慢淮左名都》导读/15-13《扬州慢淮左名都》导读.mp4','《扬州慢淮左名都》导读','纪录片',204,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-20 18:32:11','00:06:22.04',382.04,407,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','18.58MB'),(139,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第002集/乐乐课堂-三国演义-第002集.mp4','乐乐课堂-三国演义-第002集','电影',2,111,'大陆',2021,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:15:50','00:04:24.96',264.96,431,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.64MB'),(140,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第003集/乐乐课堂-三国演义-第003集.mp4','乐乐课堂-三国演义-第003集','电影',3,111,'大陆',2022,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:16:07','00:04:22.57',262.57,556,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.42MB'),(141,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第004集/乐乐课堂-三国演义-第004集.mp4','乐乐课堂-三国演义-第004集','电影',4,111,'大陆',2023,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:18:37','00:05:14.64',314.64,1244,'h264 (High)','yuv420p(progressive)','aac (LC)','44100','848x462','46.69MB'),(142,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第005集/乐乐课堂-三国演义-第005集.mp4','乐乐课堂-三国演义-第005集','电影',5,111,'大陆',2024,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:18:37','00:05:03.81',303.81,1284,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','46.53MB'),(143,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第006集/乐乐课堂-三国演义-第006集.mp4','乐乐课堂-三国演义-第006集','电影',6,111,'大陆',2025,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:16:38','00:04:38.96',278.96,704,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','23.44MB'),(144,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第007集/乐乐课堂-三国演义-第007集.mp4','乐乐课堂-三国演义-第007集','电影',7,111,'大陆',2026,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:16:37','00:04:07.50',247.5,774,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','22.85MB'),(145,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第008集/乐乐课堂-三国演义-第008集.mp4','乐乐课堂-三国演义-第008集','电影',8,111,'大陆',2027,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:16:25','00:04:41.40',281.4,598,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.08MB'),(146,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第009集/乐乐课堂-三国演义-第009集.mp4','乐乐课堂-三国演义-第009集','电影',9,111,'大陆',2028,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:16:09','00:04:28.72',268.72,516,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.53MB'),(147,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第010集/乐乐课堂-三国演义-第010集.mp4','乐乐课堂-三国演义-第010集','电影',10,111,'大陆',2029,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:18:05','00:05:01.93',301.93,709,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.52MB'),(148,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第011集/乐乐课堂-三国演义-第011集.mp4','乐乐课堂-三国演义-第011集','电影',11,111,'大陆',2030,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:19:35','00:04:56.33',296.33,1108,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','39.15MB'),(149,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第012集/乐乐课堂-三国演义-第012集.mp4','乐乐课堂-三国演义-第012集','电影',12,111,'香港',2031,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:20:16','00:05:04.44',304.44,1272,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','46.17MB'),(150,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第013集/乐乐课堂-三国演义-第013集.mp4','乐乐课堂-三国演义-第013集','电影',13,111,'香港',2032,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:19:25','00:04:48.09',288.09,977,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','33.59MB'),(151,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第014集/乐乐课堂-三国演义-第014集.mp4','乐乐课堂-三国演义-第014集','电影',14,111,'香港',2033,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:18:28','00:05:06.43',306.43,552,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.17MB'),(152,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第015集/乐乐课堂-三国演义-第015集.mp4','乐乐课堂-三国演义-第015集','电影',15,111,'香港',2034,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:18:15','00:05:16.09',316.09,467,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.6MB'),(153,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第016集/乐乐课堂-三国演义-第016集.mp4','乐乐课堂-三国演义-第016集','电影',16,111,'香港',2035,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:19:07','00:05:10.96',310.96,745,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','27.62MB'),(154,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第017集/乐乐课堂-三国演义-第017集.mp4','乐乐课堂-三国演义-第017集','电影',17,111,'香港',2036,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:20:37','00:05:37.11',337.11,665,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','26.74MB'),(155,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第018集/乐乐课堂-三国演义-第018集.mp4','乐乐课堂-三国演义-第018集','电影',18,111,'香港',2037,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:20:49','00:05:16.56',316.56,713,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','26.94MB'),(156,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第019集/乐乐课堂-三国演义-第019集.mp4','乐乐课堂-三国演义-第019集','电影',19,111,'香港',2038,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:20:52','00:05:38.25',338.25,625,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.21MB'),(157,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第020集/乐乐课堂-三国演义-第020集.mp4','乐乐课堂-三国演义-第020集','电影',20,111,'香港',2039,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:20:47','00:05:16.86',316.86,592,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','22.37MB'),(158,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第021集/乐乐课堂-三国演义-第021集.mp4','乐乐课堂-三国演义-第021集','电影',21,111,'香港',2040,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:21:33','00:05:30.51',330.51,762,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.04MB'),(159,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第022集/乐乐课堂-三国演义-第022集.mp4','乐乐课堂-三国演义-第022集','电影',22,111,'香港',2041,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:22:22','00:04:54.34',294.34,948,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','33.28MB'),(160,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第023集/乐乐课堂-三国演义-第023集.mp4','乐乐课堂-三国演义-第023集','电影',23,111,'香港',2042,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:21:23','00:04:56.96',296.96,541,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.16MB'),(161,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第024集/乐乐课堂-三国演义-第024集.mp4','乐乐课堂-三国演义-第024集','电影',24,111,'香港',2043,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:21:59','00:04:40.71',280.71,706,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','23.64MB'),(162,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第025集/乐乐课堂-三国演义-第025集.mp4','乐乐课堂-三国演义-第025集','电影',25,111,'香港',2044,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:22:35','00:05:38.27',338.27,592,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','23.88MB'),(163,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第026集/乐乐课堂-三国演义-第026集.mp4','乐乐课堂-三国演义-第026集','电影',26,111,'香港',2045,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:22:54','00:04:56.17',296.17,732,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.85MB'),(164,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第027集/乐乐课堂-三国演义-第027集.mp4','乐乐课堂-三国演义-第027集','电影',27,111,'香港',2046,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:22:36','00:05:20.95',320.95,490,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','18.78MB'),(165,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第028集/乐乐课堂-三国演义-第028集.mp4','乐乐课堂-三国演义-第028集','电影',28,111,'台湾',2047,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:23:14','00:05:02.70',302.7,994,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','35.87MB'),(166,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第029集/乐乐课堂-三国演义-第029集.mp4','乐乐课堂-三国演义-第029集','电影',29,111,'台湾',2048,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:22:56','00:05:24.57',324.57,610,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','23.62MB'),(167,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第030集/乐乐课堂-三国演义-第030集.mp4','乐乐课堂-三国演义-第030集','电影',30,111,'台湾',2049,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:23:12','00:04:39.20',279.2,825,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','27.49MB'),(168,'/usr/local/nginx/html/myLive/vod/乐乐课堂-三国演义-第031集/乐乐课堂-三国演义-第031集.mp4','乐乐课堂-三国演义-第031集','电影',31,111,'台湾',2050,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:23:12','00:05:08.93',308.93,695,'h264 (High) (avc1 / 0x31637661)','yuv420p','aac (LC) (mp4a / 0x6134706D)','44100','858x480','25.6MB'),(169,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第001集/乐乐课堂-西游记-第001集.mp4','乐乐课堂-西游记-第001集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:07:30','00:02:59.54',179.54,619,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.26MB'),(170,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第002集/乐乐课堂-西游记-第002集.mp4','乐乐课堂-西游记-第002集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:07:30','00:03:06.71',186.71,593,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.22MB'),(171,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第003集/乐乐课堂-西游记-第003集.mp4','乐乐课堂-西游记-第003集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:07:43','00:03:38.73',218.73,632,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.48MB'),(172,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第004集/乐乐课堂-西游记-第004集.mp4','乐乐课堂-西游记-第004集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:07:39','00:03:01.56',181.56,701,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','15.18MB'),(173,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第005集/乐乐课堂-西游记-第005集.mp4','乐乐课堂-西游记-第005集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:08:44','00:02:56.56',176.56,1363,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','28.69MB'),(174,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第006集/乐乐课堂-西游记-第006集.mp4','乐乐课堂-西游记-第006集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:08:08','00:03:55.03',235.03,752,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','21.08MB'),(175,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第007集/乐乐课堂-西游记-第007集.mp4','乐乐课堂-西游记-第007集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:07:57','00:03:53.50',233.5,691,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.26MB'),(176,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第008集/乐乐课堂-西游记-第008集.mp4','乐乐课堂-西游记-第008集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:07:51','00:02:57.33',177.33,843,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.83MB'),(177,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第009集/乐乐课堂-西游记-第009集.mp4','乐乐课堂-西游记-第009集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:07:56','00:03:40.71',220.71,715,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','18.81MB'),(178,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第010集/乐乐课堂-西游记-第010集.mp4','乐乐课堂-西游记-第010集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:08:36','00:02:52.73',172.73,625,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.88MB'),(179,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第011集/乐乐课堂-西游记-第011集.mp4','乐乐课堂-西游记-第011集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:08:39','00:02:39.10',159.1,701,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.31MB'),(180,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第013集/乐乐课堂-西游记-第013集.mp4','乐乐课堂-西游记-第013集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:09:23','00:02:59.84',179.84,873,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','18.72MB'),(181,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第014集/乐乐课堂-西游记-第014集.mp4','乐乐课堂-西游记-第014集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:09:50','00:04:06.22',246.22,735,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','21.58MB'),(182,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第015集/乐乐课堂-西游记-第015集.mp4','乐乐课堂-西游记-第015集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:10:10','00:02:48.37',168.37,1190,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','23.9MB'),(183,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第016集/乐乐课堂-西游记-第016集.mp4','乐乐课堂-西游记-第016集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:09:43','00:02:57.17',177.17,852,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','18.01MB'),(184,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第017集/乐乐课堂-西游记-第017集.mp4','乐乐课堂-西游记-第017集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:09:40','00:02:42.24',162.24,897,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.36MB'),(185,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第018集/乐乐课堂-西游记-第018集.mp4','乐乐课堂-西游记-第018集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:09:22','00:02:18.92',138.92,746,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','12.37MB'),(186,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第019集/乐乐课堂-西游记-第019集.mp4','乐乐课堂-西游记-第019集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:10:52','00:03:16.53',196.53,932,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','21.84MB'),(187,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第020集/乐乐课堂-西游记-第020集.mp4','乐乐课堂-西游记-第020集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:10:08','00:02:02.69',122.69,954,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','13.96MB'),(188,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第021集/乐乐课堂-西游记-第021集.mp4','乐乐课堂-西游记-第021集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:10:33','00:03:05.06',185.06,760,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.77MB'),(189,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第022集/乐乐课堂-西游记-第022集.mp4','乐乐课堂-西游记-第022集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:12:09','00:03:38.41',218.41,1056,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','27.5MB'),(190,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第023集/乐乐课堂-西游记-第023集.mp4','乐乐课堂-西游记-第023集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:11:14','00:02:43.72',163.72,872,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.03MB'),(191,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第024集/乐乐课堂-西游记-第024集.mp4','乐乐课堂-西游记-第024集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:11:34','00:03:57.49',237.49,620,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.56MB'),(192,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第025集/乐乐课堂-西游记-第025集.mp4','乐乐课堂-西游记-第025集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:11:58','00:02:51.41',171.41,1031,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','21.07MB'),(193,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第026集/乐乐课堂-西游记-第026集.mp4','乐乐课堂-西游记-第026集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:12:08','00:03:12.77',192.77,1010,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','23.22MB'),(194,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第027集/乐乐课堂-西游记-第027集.mp4','乐乐课堂-西游记-第027集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:12:08','00:04:04.76',244.76,699,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.41MB'),(195,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第028集/乐乐课堂-西游记-第028集.mp4','乐乐课堂-西游记-第028集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:11:29','00:02:08.29',128.29,768,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','11.75MB'),(196,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第029集/乐乐课堂-西游记-第029集.mp4','乐乐课堂-西游记-第029集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:12:18','00:03:09.47',189.47,914,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','20.65MB'),(197,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第030集/乐乐课堂-西游记-第030集.mp4','乐乐课堂-西游记-第030集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:12:18','00:03:10.03',190.03,757,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','17.17MB'),(198,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第031集/乐乐课堂-西游记-第031集.mp4','乐乐课堂-西游记-第031集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:12:21','00:02:56.31',176.31,798,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','16.78MB'),(199,'/usr/local/nginx/html/myLive/vod/乐乐课堂-西游记-第032集/乐乐课堂-西游记-第032集.mp4','乐乐课堂-西游记-第032集',NULL,1,1,NULL,NULL,NULL,NULL,NULL,'|西游|',NULL,'2020-03-19 21:12:21','00:02:25.73',145.73,835,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','14.52MB'),(200,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_001/乐乐课堂_水浒传_001.mp4','乐乐课堂_水浒传_001','电视剧',1,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:30:26','00:05:56.94',356.94,815,'h264 (High) (avc1 / 0x31637661)','yuv420p(tv','aac (LC) (mp4a / 0x6134706D)','44100','smpte170m/bt709/bt709)','34.71MB'),(201,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_002/乐乐课堂_水浒传_002.mp4','乐乐课堂_水浒传_002','电视剧',2,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:32:13','00:07:03.14',423.14,993,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','50.1MB'),(202,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_003/乐乐课堂_水浒传_003.mp4','乐乐课堂_水浒传_003','电视剧',3,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:29:59','00:06:34.65',394.65,622,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.31MB'),(203,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_004/乐乐课堂_水浒传_004.mp4','乐乐课堂_水浒传_004','电视剧',4,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:30:02','00:07:13.03',433.03,578,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.84MB'),(204,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_005/乐乐课堂_水浒传_005.mp4','乐乐课堂_水浒传_005','电视剧',5,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:30:04','00:07:26.01',446.01,564,'h264 (Baseline) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.02MB'),(205,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_006/乐乐课堂_水浒传_006.mp4','乐乐课堂_水浒传_006','电视剧',6,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:30:25','00:06:35.92',395.92,725,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','34.24MB'),(206,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_007/乐乐课堂_水浒传_007.mp4','乐乐课堂_水浒传_007','电视剧',7,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:30:00','00:07:17.56',437.56,558,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.11MB'),(207,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_008/乐乐课堂_水浒传_008.mp4','乐乐课堂_水浒传_008','电视剧',8,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:29:49','00:06:17.63',377.63,601,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','27.1MB'),(208,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_009/乐乐课堂_水浒传_009.mp4','乐乐课堂_水浒传_009','电视剧',9,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:30:19','00:07:13.73',433.73,635,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','32.83MB'),(209,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_010/乐乐课堂_水浒传_010.mp4','乐乐课堂_水浒传_010','电视剧',10,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:34:17','00:06:57.94',417.94,837,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','41.74MB'),(210,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_011/乐乐课堂_水浒传_011.mp4','乐乐课堂_水浒传_011','电视剧',11,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:33:01','00:06:19.99',379.99,595,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','26.95MB'),(211,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_012/乐乐课堂_水浒传_012.mp4','乐乐课堂_水浒传_012','电视剧',12,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:32:26','00:06:10.85',370.85,481,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','21.27MB'),(212,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_013/乐乐课堂_水浒传_013.mp4','乐乐课堂_水浒传_013','电视剧',13,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:32:58','00:05:15.14',315.14,684,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.73MB'),(213,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_014/乐乐课堂_水浒传_014.mp4','乐乐课堂_水浒传_014','电视剧',14,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:33:37','00:06:26.96',386.96,693,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','31.97MB'),(214,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_015/乐乐课堂_水浒传_015.mp4','乐乐课堂_水浒传_015','电视剧',15,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:34:14','00:06:41.10',401.1,743,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','35.53MB'),(215,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_016/乐乐课堂_水浒传_016.mp4','乐乐课堂_水浒传_016','电视剧',16,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:35:52','00:07:34.14',454.14,940,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','50.89MB'),(216,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_017/乐乐课堂_水浒传_017.mp4','乐乐课堂_水浒传_017','电视剧',17,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:34:38','00:05:42.63',342.63,948,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','38.75MB'),(217,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_018/乐乐课堂_水浒传_018.mp4','乐乐课堂_水浒传_018','电视剧',18,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:34:50','00:05:32.93',332.93,641,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.46MB'),(218,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_019/乐乐课堂_水浒传_019.mp4','乐乐课堂_水浒传_019','电视剧',19,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:37:18','00:05:19.65',319.65,1238,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','47.19MB'),(219,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_020/乐乐课堂_水浒传_020.mp4','乐乐课堂_水浒传_020','电视剧',20,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:36:04','00:05:50.23',350.23,720,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','30.1MB'),(220,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_021/乐乐课堂_水浒传_021.mp4','乐乐课堂_水浒传_021','电视剧',21,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:35:27','00:06:09.10',369.1,555,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','24.46MB'),(221,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_022/乐乐课堂_水浒传_022.mp4','乐乐课堂_水浒传_022','电视剧',22,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:36:17','00:06:08.71',368.71,574,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.23MB'),(222,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_023/乐乐课堂_水浒传_023.mp4','乐乐课堂_水浒传_023','电视剧',23,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:37:19','00:06:55.34',415.34,587,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','29.11MB'),(223,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_024/乐乐课堂_水浒传_024.mp4','乐乐课堂_水浒传_024','电视剧',24,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:36:57','00:07:05.64',425.64,486,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','24.69MB'),(224,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_025/乐乐课堂_水浒传_025.mp4','乐乐课堂_水浒传_025','电视剧',25,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:36:53','00:05:46.28',346.28,476,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','19.67MB'),(225,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_026/乐乐课堂_水浒传_026.mp4','乐乐课堂_水浒传_026','电视剧',26,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:37:35','00:06:29.38',389.38,572,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','26.59MB'),(226,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_027/乐乐课堂_水浒传_027.mp4','乐乐课堂_水浒传_027','电视剧',27,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:37:55','00:06:02.77',362.77,613,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','26.51MB'),(227,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_028/乐乐课堂_水浒传_028.mp4','乐乐课堂_水浒传_028','电视剧',28,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:38:06','00:06:10.43',370.43,648,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','28.66MB'),(228,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_029/乐乐课堂_水浒传_029.mp4','乐乐课堂_水浒传_029','电视剧',29,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:38:00','00:05:39.36',339.36,568,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','22.99MB'),(229,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_030/乐乐课堂_水浒传_030.mp4','乐乐课堂_水浒传_030','电视剧',30,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:38:07','00:06:12.15',372.15,582,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','25.86MB'),(230,'/usr/local/nginx/html/myLive/vod/乐乐课堂_水浒传_031/乐乐课堂_水浒传_031.mp4','乐乐课堂_水浒传_031','电视剧',31,120,'大陆',2130,'乐乐课堂','乐乐',10,'|',NULL,'2020-03-19 20:38:20','00:05:50.97',350.97,902,'h264 (Main) (avc1 / 0x31637661)','yuv420p(tv)','aac (LC) (mp4a / 0x6134706D)','44100','854x480','37.74MB');
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
INSERT INTO `videoScanTime` VALUES (1,'2020-03-31 01:58:01');
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
INSERT INTO `vipCard` VALUES ('46549429','20196387',1),('46549430','81265349',1),('46549431','02381547',1),('46549432','84501729',1),('46549433','62543079',1),('46549434','09723165',1),('46549435','48065372',1),('51703462','13052897',1),('51703463','96705218',1),('51703464','68931724',1),('51703465','94562378',1),('51703466','79036125',1),('51703467','18654209',1),('51703468','23418075',1),('51703469','31029756',1),('51703470','03458672',1),('51703471','41920578',1);
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

-- Dump completed on 2020-03-31  2:00:01
