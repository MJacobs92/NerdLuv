CREATE DATABASE  IF NOT EXISTS `nerdluv` /*!40100 DEFAULT CHARACTER SET big5 */;
USE `nerdluv`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: nerdluv
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `favorite_os`
--

DROP TABLE IF EXISTS `favorite_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite_os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `single_id` int(11) NOT NULL,
  `os` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favOS_fk` (`single_id`),
  CONSTRAINT `favOS_fk` FOREIGN KEY (`single_id`) REFERENCES `singles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_os`
--

LOCK TABLES `favorite_os` WRITE;
/*!40000 ALTER TABLE `favorite_os` DISABLE KEYS */;
INSERT INTO `favorite_os` VALUES (5,6,'Windows'),(6,7,'Windows');
/*!40000 ALTER TABLE `favorite_os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personality_types`
--

DROP TABLE IF EXISTS `personality_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personality_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `single_id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`single_id`),
  CONSTRAINT `personality_fk` FOREIGN KEY (`single_id`) REFERENCES `singles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personality_types`
--

LOCK TABLES `personality_types` WRITE;
/*!40000 ALTER TABLE `personality_types` DISABLE KEYS */;
INSERT INTO `personality_types` VALUES (5,6,'ENTP'),(6,7,'ENTP');
/*!40000 ALTER TABLE `personality_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seeking_age`
--

DROP TABLE IF EXISTS `seeking_age`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seeking_age` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `single_id` int(11) NOT NULL,
  `min_age` int(11) DEFAULT NULL,
  `max_age` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seekingAge_fk_idx` (`single_id`),
  CONSTRAINT `seekingAge_fk` FOREIGN KEY (`single_id`) REFERENCES `singles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seeking_age`
--

LOCK TABLES `seeking_age` WRITE;
/*!40000 ALTER TABLE `seeking_age` DISABLE KEYS */;
INSERT INTO `seeking_age` VALUES (1,6,23,55),(2,7,23,70);
/*!40000 ALTER TABLE `seeking_age` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `singles`
--

DROP TABLE IF EXISTS `singles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `singles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `singles`
--

LOCK TABLES `singles` WRITE;
/*!40000 ALTER TABLE `singles` DISABLE KEYS */;
INSERT INTO `singles` VALUES (3,'Nia Long','F','46'),(4,'Matthew Jacobs','M','23'),(5,'Marlo Jacobs','M','45'),(6,'Nia Long','F','46'),(7,'Matthew Jacobs','M','23');
/*!40000 ALTER TABLE `singles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-03  0:03:03
