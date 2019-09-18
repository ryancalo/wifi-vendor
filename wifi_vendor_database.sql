-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: wifi_vendor
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.17.10.1

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
-- Table structure for table `alive_log`
--

DROP TABLE IF EXISTS `alive_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alive_log` (
  `alive_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_name` varchar(20) NOT NULL,
  `device_action` varchar(20) NOT NULL,
  `device_status` varchar(20) NOT NULL,
  `log_date` datetime NOT NULL,
  PRIMARY KEY (`alive_log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1455 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alive_log`
--

LOCK TABLES `alive_log` WRITE;
/*!40000 ALTER TABLE `alive_log` DISABLE KEYS */;
INSERT INTO `alive_log` VALUES (1442,'Printer','','Online','2018-11-23 14:25:11'),(1443,'Internet','','Online','2018-11-27 14:12:11'),(1444,'Controller','','Online','2018-11-27 14:12:11'),(1445,'NUC','','Online','2018-11-27 14:12:11'),(1446,'Galileo','','Online','2018-11-27 14:12:11'),(1447,'Printer','','Offline','2018-11-23 14:26:13'),(1448,'Printer','','Online','2018-11-23 18:19:11'),(1449,'Printer','','Offline','2018-11-23 18:20:12'),(1450,'Printer','','Online','2018-11-24 15:59:11'),(1451,'Printer','','Offline','2018-11-24 16:00:22'),(1452,'Printer','','Online','2018-11-26 18:20:11'),(1453,'Printer','','Offline','2018-11-26 18:21:21'),(1454,'Printer','','Online','2018-11-27 14:12:11');
/*!40000 ALTER TABLE `alive_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cloud`
--

DROP TABLE IF EXISTS `cloud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cloud` (
  `cloud_ip` varchar(25) NOT NULL,
  `cloud_port` int(11) NOT NULL,
  `cloud_mqtt_port` int(11) NOT NULL,
  `cloud_token` varchar(50) NOT NULL,
  UNIQUE KEY `cloud_ip` (`cloud_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cloud`
--

LOCK TABLES `cloud` WRITE;
/*!40000 ALTER TABLE `cloud` DISABLE KEYS */;
INSERT INTO `cloud` VALUES ('wiredsystems.com',8082,1883,'c6ANnbh0chQL1IZ');
/*!40000 ALTER TABLE `cloud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controller`
--

DROP TABLE IF EXISTS `controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controller` (
  `controller_ip` varchar(25) NOT NULL,
  `controller_port` int(4) NOT NULL,
  `controller_username` varchar(30) NOT NULL,
  `controller_password` varchar(30) NOT NULL,
  `controller_status` varchar(15) NOT NULL,
  `date_updated` datetime NOT NULL,
  UNIQUE KEY `controller_ip` (`controller_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES ('https://10.0.0.160',8443,'ubnt','Wiredpasscod3','Online','2018-11-23 16:00:03');
/*!40000 ALTER TABLE `controller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device` (
  `device_token` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL,
  UNIQUE KEY `device_token` (`device_token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galileo`
--

DROP TABLE IF EXISTS `galileo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galileo` (
  `galileo_ip` varchar(20) NOT NULL,
  `galileo_status` varchar(10) NOT NULL,
  UNIQUE KEY `galileo_ip` (`galileo_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galileo`
--

LOCK TABLES `galileo` WRITE;
/*!40000 ALTER TABLE `galileo` DISABLE KEYS */;
INSERT INTO `galileo` VALUES ('10.0.0.72','Online');
/*!40000 ALTER TABLE `galileo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(30) NOT NULL,
  `log_details` text NOT NULL,
  `log_date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (25,'Controller','Print Voucher Message: Couldnt Create Voucher Connection Falied','2018-11-21 13:13:29'),(26,'Controller','Print Voucher Message: Couldnt Create Voucher Connection Falied','2018-11-21 14:51:11'),(27,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(28,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(29,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(30,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(31,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(32,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(33,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(34,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(35,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(36,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(37,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(38,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(39,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(40,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(41,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(42,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(43,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(44,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(45,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(46,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(47,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(48,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(49,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(50,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(51,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01'),(52,'Cloud','Message: Could not connect to : 0: php_network_getaddresses: getaddrinfo failed: Name or service not known','2018-11-24 09:30:01');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance` (
  `maintenance_id` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance_type` varchar(30) NOT NULL,
  `maintenance_details` text NOT NULL,
  `maintenance_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`maintenance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance`
--

LOCK TABLES `maintenance` WRITE;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
INSERT INTO `maintenance` VALUES (6,'collection','Collection: 50','2018-11-20 09:27:00',3),(7,'collection','Collection: 10','2018-11-21 09:54:00',3);
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printer`
--

DROP TABLE IF EXISTS `printer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printer` (
  `printer_ip` varchar(25) NOT NULL,
  `printer_port` int(11) NOT NULL,
  `printer_status` varchar(15) NOT NULL,
  UNIQUE KEY `printer_ip` (`printer_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printer`
--

LOCK TABLES `printer` WRITE;
/*!40000 ALTER TABLE `printer` DISABLE KEYS */;
INSERT INTO `printer` VALUES ('10.0.0.14',9100,'Online');
/*!40000 ALTER TABLE `printer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `user_status` varchar(15) NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Admin','wifiadmin','$2y$10$nn6xsy1JSYe4mCctMDVo8u5SCFlwgnXdv4pXqevKzJWPyaRYub3ee','admin','Active','2018-11-22 16:40:00'),(5,'Technician','tech01','$2y$10$lFY6oqRD7QBKz4blzjK.R.gp1GshwgAl9A3l2Qge2v3O7fyTDHc2u','technician','Active','2018-11-23 09:24:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voucher`
--

DROP TABLE IF EXISTS `voucher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_duration` int(11) NOT NULL,
  `bandwidth_limit` int(11) NOT NULL,
  `bandwidth` int(11) NOT NULL,
  `voucher_logo` varchar(30) NOT NULL,
  `voucher_steps` text NOT NULL,
  `voucher_notes` text NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voucher`
--

LOCK TABLES `voucher` WRITE;
/*!40000 ALTER TABLE `voucher` DISABLE KEYS */;
INSERT INTO `voucher` VALUES (3,30,200,800,'c6ANnbh0chQL1IZ.png','1. Connect to WIRED_GUEST','ENJOY WIFI             ','2018-11-22 15:18:00');
/*!40000 ALTER TABLE `voucher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voucher_record`
--

DROP TABLE IF EXISTS `voucher_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voucher_record` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher` int(25) NOT NULL,
  `voucher_type` varchar(15) NOT NULL,
  `record_date` datetime NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voucher_record`
--

LOCK TABLES `voucher_record` WRITE;
/*!40000 ALTER TABLE `voucher_record` DISABLE KEYS */;
INSERT INTO `voucher_record` VALUES (11,2147483647,'Paid','2018-11-21 09:51:37'),(12,1608680257,'Paid','2018-11-21 09:53:37'),(13,1806548749,'Paid','2018-11-24 09:03:58');
/*!40000 ALTER TABLE `voucher_record` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-27 14:12:34
