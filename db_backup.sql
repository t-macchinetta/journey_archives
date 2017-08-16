-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: c9
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `u_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dep_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `length` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `traffic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (7,'tatsuya kosuge','castero1219@gmail.com','93f80736116fb2845c768f7485ecbcee','東海道五十三次をまたぐ','2017-12-12','4日','\\1-\\10,000','鉄道','2017-08-05 01:49:19','2017-08-06 07:23:59'),(10,'taro','taro@taro.com','9bb2551591457bc92302a70ceba564a8','学会のためポルト訪問','2011-08-30','5日','\\50,001-\\60,000','鉄道, 飛行機, 徒歩','2017-08-05 02:41:13','2017-08-06 07:26:18'),(11,'taro','taro@taro.com','6a4c8128cbf41e35ff78992a3b39cd54','揚州と四川','2011-10-08','6日','\\50,001-\\60,000','飛行機, 自動車, 徒歩','2017-08-05 02:41:56','2017-08-06 07:27:03'),(12,'taro','taro@taro.com','fc82abcefe1d8e0ada14208beecb4c1c','新潟→会津','2015-09-20','3日','\\20,001-\\20,000','鉄道, バス, 徒歩','2017-08-05 02:42:25','2017-08-06 07:27:47'),(13,'taro','taro@taro.com','d9c1566e018b50e9cf2a61b2f7f932b1','ポーランドバルト三国','2016-09-25','7日','\\50,001-\\60,000','バス, 飛行機, 徒歩','2017-08-06 03:50:52','2017-08-06 03:50:52'),(14,'taro','taro@taro.com','70c309824e07c4464fa6aaaa717e9595','ラスベガスとロサンゼルス','2011-03-06','7日','\\50,001-\\60,000','飛行機, 自動車, 徒歩','2017-08-06 07:25:23','2017-08-06 07:25:23'),(15,'taro','taro@taro.com','5b8566dc67c389b6af33acdb52bd04f9','リオデジャネイロ訪問','2016-09-07','7日','\\10,001-\\20,000','バス, 飛行機, 徒歩','2017-08-06 07:28:35','2017-08-12 08:23:52'),(16,'taro','taro@taro.com','5e81c6a7aed74a988ad5f31555a22b63','箱根温泉ツアー','2017-06-04','3日','\\20,001-\\30,000','鉄道, 徒歩','2017-08-06 07:29:24','2017-08-06 07:29:24');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journeys`
--

DROP TABLE IF EXISTS `journeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journeys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `u_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dep_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departure` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `img1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journeys`
--

LOCK TABLES `journeys` WRITE;
/*!40000 ALTER TABLE `journeys` DISABLE KEYS */;
INSERT INTO `journeys` VALUES (23,'taro','taro@taro.com','70c309824e07c4464fa6aaaa717e9595','10:00','成田空港','アメリカン航空747','10:30','ロサンゼルス空港','席が後ろのほうだったので4席使ってフルフラット．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 04:56:05','2017-08-07 04:56:05'),(25,'taro','taro@taro.com','70c309824e07c4464fa6aaaa717e9595','12:00','ロサンゼルス空港','サウスウエスト航空','13:00','ラスベガス空港','席は自由席．短いフライトだが軽食が出てくる．10分くらい早着．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 04:57:54','2017-08-07 04:57:54'),(26,'taro','taro@taro.com','9bb2551591457bc92302a70ceba564a8','15:00','成田空港','ルフトハンザドイツ航空A380','15:00','フランクフルト空港','初A380．乗り心地が良い．フランクフルトでは5時間待ちだったので暇．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 04:59:21','2017-08-07 04:59:21'),(27,'taro','taro@taro.com','9bb2551591457bc92302a70ceba564a8','20:00','フランクフルト空港','TAPポルトガル航空','21:00','リスボン空港','夜なので眠い．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 05:01:03','2017-08-07 05:01:03'),(28,'taro','taro@taro.com','9bb2551591457bc92302a70ceba564a8','22:00','リスボン空港','TAPポルトガル航空','23:30','ポルト空港','機材がボンバルディア．30席くらい．まさかの軽食付き．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 05:02:08','2017-08-07 05:02:08'),(29,'taro','taro@taro.com','5b8566dc67c389b6af33acdb52bd04f9','21:30','成田空港','エミレーツ航空','13:00','ドバイ国際空港','10時間位のフライト．機内食は全部ハラール食で味はなかなか．ウイスキーを飲みつつ読書して過ごす．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 05:04:35','2017-08-07 05:04:35'),(30,'taro','taro@taro.com','5b8566dc67c389b6af33acdb52bd04f9','18:00','ドバイ国際空港','エミレーツ航空','15:00','リオデジャネイロ国際空港','アフリカが長い．大西洋も長い．ひたすらウイスキーを飲みつつ読書．本は余裕で2-3冊読み終わるレベル．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 05:05:55','2017-08-07 05:05:55'),(31,'taro','taro@taro.com','6a4c8128cbf41e35ff78992a3b39cd54','10:00','羽田空港','中国東方航空','12:00','上海浦東国際空港','天気がいいのにどことなく霞んでいる．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 05:52:04','2017-08-07 05:52:04'),(32,'taro','taro@taro.com','d9c1566e018b50e9cf2a61b2f7f932b1','11:00','成田空港','フィンランド航空AY0074','15:20','ヘルシンキ空港','10時間程度のフライト．ずっと昼．機内食美味しい(まさかのブラックサンダーつき)．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 05:55:07','2017-08-15 02:39:01'),(33,'taro','taro@taro.com','d9c1566e018b50e9cf2a61b2f7f932b1','20:15','ヘルシンキ空港','フィンランド航空AY0747','21:15','クラクフ空港','短時間だが軽食あり(ピザ)．',NULL,NULL,NULL,NULL,NULL,'2017-08-07 05:56:27','2017-08-15 02:39:01');
/*!40000 ALTER TABLE `journeys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2017_07_18_123645_create_journey_table',1),('2017_07_29_022049_create_articles_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'taro','taro@taro.com','$2y$10$4z3Y7ac2As7pWwVa5UYp7elwuMrV7YRP/jjM0v304tpZfDlnHivsS','R7UYXzmWcHrfEXSiGMr5QjGkInzeN4ACgQVt9gJnbwRsdY2PWR2HHyIotTNH','2017-07-29 02:46:54','2017-08-07 23:47:26'),(2,'jiro','jiro@jiro.com','$2y$10$UHKeCJWoqLQcyLtaCcQ8r.0xQBRI4SpHgOd4rWA/KQr/scL4T9oKS','ss42HjLEJphYSb6pHAk0F1qWjjGZoMuQhY9qv72DmMueXGLiQARUWEApGbF4','2017-07-29 05:24:10','2017-07-29 05:25:48'),(3,'tatsuya kosuge','castero1219@gmail.com','$2y$10$j/C7TzCb8a.ckSkg4oWY3.FUYGCe3HYa/6uaoTGHJ7XqraLuQD8Q6',NULL,'2017-08-05 01:47:42','2017-08-05 01:47:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-16  8:23:21
