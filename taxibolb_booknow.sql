-- MariaDB dump 10.19  Distrib 10.6.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: taxibolb_booknow
-- ------------------------------------------------------
-- Server version	10.6.17-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `taxibolb_booknow`
--


--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admintype` int(11) NOT NULL,
  `adminstatus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `name`, `password`, `admintype`, `adminstatus`) VALUES (1,'Taxi316','Taxi316',2,1),(2,'a','a',2,1),(4,'Admin','1',1,1),(9,'Taxi209','Taxi209',2,1),(12,'Taxi337','Taxi337',1,1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookindorder`
--

DROP TABLE IF EXISTS `bookindorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookindorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `bookingdate` varchar(255) NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `orderdate` varchar(255) NOT NULL,
  `description` varchar(1600) DEFAULT NULL,
  `cabs` int(11) NOT NULL,
  `rent` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `cabdatacount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=360 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookindorder`
--

LOCK TABLES `bookindorder` WRITE;
/*!40000 ALTER TABLE `bookindorder` DISABLE KEYS */;
INSERT INTO `bookindorder` (`id`, `hotel`, `destination`, `bookingdate`, `time`, `orderdate`, `description`, `cabs`, `rent`, `status`, `month`, `year`, `cabdatacount`) VALUES (229,'Sirene','Airport','22-01-2024',NULL,'16:10','',1,43,0,'January','2024','502 '),(230,'Sirene','Airport','22-01-2024',NULL,'16:11','',1,43,0,'January','2024','503 '),(231,'Sirene','Airport','22-01-2024',NULL,'16:14','',1,43,0,'January','2024','504 '),(232,'Sirene','Airport','22-01-2024',NULL,'16:21','2 backge taxi number please',1,43,2,'January','2024','501 '),(233,'Sirene','Airport','22-01-2024',NULL,'16:24','',1,43,0,'January','2024','505 '),(234,'Sunday','Airport','22-01-2024',NULL,'16:25','',1,23,0,'January','2024','506 '),(235,'D','Airport','22-01-2024',NULL,'20:27','',1,45,0,'January','2024','502 '),(236,'D','Airport','31-01-2024',NULL,'20:30','',1,45,3,'January','2024','503 '),(237,'D','Airport','31-01-2024',NULL,'20:31','',1,45,3,'January','2024','504 '),(238,'Sirene','Rhodos','23-01-2024',NULL,'16:35','Randevou ',3,102,3,'January','2024','502 503 504 '),(239,'Sunday','Airport','22-01-2024',NULL,'16:57','',1,23,3,'January','2024','507 '),(240,'Sunday','Airport','22-01-2024',NULL,'16:57','',1,23,3,'January','2024','508 '),(241,'Sunday','Airport','22-01-2024',NULL,'16:59','',1,23,3,'January','2024','509 '),(242,'Sunday','Airport','23-01-2024',NULL,'18:49','',1,23,3,'January','2024','501 '),(243,'Sunday','Airport','23-01-2024',NULL,'18:50','',1,23,3,'January','2024','502 '),(244,'D','Airport','25-01-2024','11:40','11:39','',1,45,3,'January','2024','502 '),(245,'D','Airport','25-01-2024','13:40','11:40','test',1,45,3,'January','2024','503 '),(246,'Sunday','Airport','25-01-2024','08:50','08:47','',1,23,3,'January','2024','501 '),(248,'Sunday','Airport','31-01-2024','08:50','08:48','',1,23,3,'January','2024','502 '),(249,'Sunday','Airport','31-01-2024','08:51','08:51','',1,23,3,'January','2024','503 '),(250,'Sunday','Airport','31-01-2024','08:55','08:55','',1,23,3,'January','2024','504 '),(251,'Sunday','Airport','31-01-2024','09:55','09:11','',1,23,3,'January','2024','505 '),(252,'D','Airport','25-01-2024','15:05','15:03','',1,45,3,'January','2024','504 '),(253,'D','Airport','25-01-2024','15:40','15:03','',1,45,3,'January','2024','505 '),(255,'D','Airport','30-01-2024','15:13','15:13','',1,45,2,'January','2024','507 '),(256,'D','Rhodos','25-01-2024','15:15','15:13','',2,58,3,'January','2024','508 509 '),(257,'Sunday','Airport','25-01-2024','11:15','11:14','',1,23,3,'January','2024','506 '),(258,'Sunday','Airport','25-01-2024','11:15','11:15','',1,23,3,'January','2024','507 '),(259,'Sunday','Airport','25-01-2024','11:55','11:15','',1,23,3,'January','2024','508 '),(260,'D','Airport','25-01-2024','15:35','15:31','',1,45,3,'January','2024','510 '),(261,'D','Airport','25-01-2024','17:35','15:34','',1,45,2,'January','2024','511 '),(262,'D','Airport','25-01-2024','15:35','15:35','',1,45,2,'January','2024','512 '),(263,'D','Airport','25-01-2024','18:10','18:08','',1,45,2,'January','2024','513 '),(264,'D','Airport','25-01-2024','18:10','18:09','',1,45,0,'January','2024','514 '),(265,'D','Airport','25-01-2024','21:10','18:10','something for test',1,45,0,'January','2024','515 '),(266,'D','Rhodos','25-01-2024','19:15','19:13','',2,58,0,'January','2024','516 517 '),(267,'Sunday','Airport','25-01-2024','15:20','15:19','',1,23,0,'January','2024','509 '),(268,'Sunday','Airport','25-01-2024','15:20','15:19','',1,23,0,'January','2024','510 '),(269,'Sunday','Airport','25-01-2024','15:20','15:20','',1,23,0,'January','2024','511 '),(270,'Sunday','Airport','25-01-2024','15:24','15:24','',1,23,0,'January','2024','512 '),(271,'Sunday','Airport','25-01-2024','18:24','15:24','',1,23,0,'January','2024','513 '),(272,'Sunday','Airport','25-01-2024','16:25','15:24','',1,23,0,'January','2024','514 '),(273,'Sunday','Airport','25-01-2024','16:26','15:26','',1,23,0,'January','2024','515 '),(274,'Sunday','Airport','25-01-2024','16:27','15:27','',1,23,0,'January','2024','516 '),(275,'D','Airport','26-01-2024','10:55','10:52','',1,45,0,'January','2024','501 '),(276,'D','Airport','26-01-2024','11:55','10:52','',1,45,2,'January','2024','502 '),(277,'D','Airport','26-01-2024','11:52','10:52','',1,45,0,'January','2024','503 '),(278,'D','Airport','26-01-2024','11:10','11:07','',1,45,2,'January','2024','504 '),(279,'D','Airport','26-01-2024','12:10','11:07','',1,45,0,'January','2024','505 '),(280,'D','Airport','26-01-2024','12:00','11:07','',1,45,0,'January','2024','506 '),(281,'Sunday','Airport','26-01-2024','14:40','14:38','',1,23,0,'January','2024','501 '),(282,'Sunday','Airport','26-01-2024','14:40','14:39','',1,23,0,'January','2024','502 '),(283,'Sunday','Airport','26-01-2024','17:50','14:39','',1,23,0,'January','2024','503 '),(284,'Sunday','Airport','26-01-2024','14:45','14:41','',1,23,0,'January','2024','504 '),(285,'Sunday','Airport','26-01-2024','14:45','14:41','',1,23,0,'January','2024','505 '),(286,'Sunday','Airport','26-01-2024','14:45','14:43','',1,23,0,'January','2024','506 '),(287,'Sirene','Rhodos','26-01-2024','14:50','14:48','',1,34,0,'January','2024','501 '),(358,'Hotel Grand','Airport','29-01-2024','19:14','19:14','',1,45,0,'January','2024','511 '),(359,'Hotel Grand','Airport','29-01-2024','19:15','19:15','',1,45,0,'January','2024','512 ');
/*!40000 ALTER TABLE `bookindorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destination`
--

DROP TABLE IF EXISTS `destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destname` varchar(255) NOT NULL,
  `deststatus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destination`
--

LOCK TABLES `destination` WRITE;
/*!40000 ALTER TABLE `destination` DISABLE KEYS */;
INSERT INTO `destination` (`id`, `destname`, `deststatus`) VALUES (1,'Airport',1),(2,'Rhodos',0),(3,'Lindos',1),(4,'Butterfly',1),(6,'Waterpark',1);
/*!40000 ALTER TABLE `destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES ('DoctrineMigrations\\Version20231125134313','2023-11-25 14:43:31',465),('DoctrineMigrations\\Version20231127130517','2023-11-27 14:05:29',628),('DoctrineMigrations\\Version20231128133828','2023-11-28 14:38:43',364),('DoctrineMigrations\\Version20231129085451','2023-11-29 09:57:26',194),('DoctrineMigrations\\Version20231129092843','2023-11-29 10:28:51',87),('DoctrineMigrations\\Version20231129093053','2023-11-29 10:31:01',65),('DoctrineMigrations\\Version20231129153448','2023-12-09 06:28:01',3),('DoctrineMigrations\\Version20231209052738','2023-12-09 06:29:56',130),('DoctrineMigrations\\Version20231209145845','2023-12-09 15:59:08',213),('DoctrineMigrations\\Version20231220155741','2023-12-20 16:57:53',309),('DoctrineMigrations\\Version20231220155926','2023-12-20 16:59:31',110),('DoctrineMigrations\\Version20231220160324','2023-12-20 17:03:30',70),('DoctrineMigrations\\Version20231221040323','2023-12-21 05:03:33',113);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=322 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setdest`
--

DROP TABLE IF EXISTS `setdest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setdest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `clientname` varchar(255) NOT NULL,
  `destid_id` int(11) NOT NULL,
  `hotelid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BDA53BA18BD886F2` (`destid_id`),
  CONSTRAINT `FK_BDA53BA18BD886F2` FOREIGN KEY (`destid_id`) REFERENCES `destination` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setdest`
--

LOCK TABLES `setdest` WRITE;
/*!40000 ALTER TABLE `setdest` DISABLE KEYS */;
INSERT INTO `setdest` (`id`, `price`, `status`, `clientname`, `destid_id`, `hotelid`) VALUES (1,'43',1,'Sarina',1,1),(2,'34',1,'Sarina',2,1),(3,'50',0,'Lake View',3,2),(4,'22',1,'Sarina',4,1),(5,'22',1,'Hotel Grand',4,6),(6,'45',1,'Hotel Grand',1,6),(7,'23',1,'Hotel Grand',2,6),(8,'26',1,'Lake View',4,2),(9,'26',1,'d',1,7),(10,'54',1,'d',2,7),(11,'31',1,'d',4,7),(12,'45',1,'D',1,8),(13,'29',1,'D',2,8),(14,'39',1,'Palace',6,9),(15,'22',1,'Palace',4,9),(16,'23',1,'Sunday',1,10);
/*!40000 ALTER TABLE `setdest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8D93D6492786CAC` (`adminid_id`),
  CONSTRAINT `FK_8D93D6492786CAC` FOREIGN KEY (`adminid_id`) REFERENCES `admin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `adminid_id`, `name`, `password`, `status`) VALUES (1,1,'Sirene','Sirene123',1),(2,2,'Lake View','1234567',1),(6,1,'Hotel Grand','asddddd',1),(8,1,'D','d',1),(9,1,'Posidonis','12345',1),(10,1,'Sunday','Sunday',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'taxibolb_booknow'
--

--
-- Dumping routines for database 'taxibolb_booknow'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-16  4:01:50
