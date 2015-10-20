CREATE DATABASE  IF NOT EXISTS `swinn` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `swinn`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: swinn
-- ------------------------------------------------------
-- Server version	5.6.25

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
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_access_profile1_idx` (`profile_id`),
  KEY `fk_access_module1_idx` (`module_id`),
  CONSTRAINT `fk_access_module1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_access_profile1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access`
--

LOCK TABLES `access` WRITE;
/*!40000 ALTER TABLE `access` DISABLE KEYS */;
INSERT INTO `access` (`id`, `profile_id`, `module_id`) VALUES (2,1,2),(3,1,3),(4,1,1),(5,1,4),(6,1,5),(7,2,1),(8,2,2);
/*!40000 ALTER TABLE `access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iconfa` varchar(100) DEFAULT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_controller_type1_idx` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` (`id`, `iconfa`, `label`, `description`, `controller`, `active`, `type_id`) VALUES (1,'fa-users','Users','Modulo de Usuarios','users',1,2),(2,'fa-tags','Access Profiles','Modulo de Perfiles de Acceso','profile',1,2),(3,'fa-cogs','Modules','Modulo de Controladores','module',1,2),(4,'fa-cog','Type','Module Type','type',1,2),(5,'fa-cog','State','Module State','state',1,2);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`id`, `name`, `description`, `category`, `active`) VALUES (1,'App Manager','Management Modules','app',1),(2,'Test','Test','app',1);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` (`id`, `state`, `category`, `active`) VALUES (1,'active','user',1);
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` (`id`, `type`, `category`, `active`) VALUES (1,'admin','user',1),(2,'application','app',1);
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(100) NOT NULL,
  `surnames` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `sex` char(1) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `authKey` varchar(45) DEFAULT NULL,
  `accessToken` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_tipo1_idx` (`type_id`),
  KEY `fk_usuario_estado1_idx` (`state_id`),
  KEY `fk_user_profile1_idx` (`profile_id`),
  CONSTRAINT `fk_user_profile1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_estado1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipo1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `names`, `surnames`, `email`, `username`, `password`, `active`, `lastupdate`, `type_id`, `state_id`, `sex`, `profile_id`, `authKey`, `accessToken`) VALUES (1,'Alfredo Antonio','Sotil Pastor','alfredosotil@gmail.com','asotilp','asotilp',1,'2015-08-10 21:29:24',1,1,'M',1,NULL,NULL),(2,'test','test','test','test','test',1,'2015-09-24 17:38:45',1,1,'M',1,'','');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'swinn'
--

--
-- Dumping routines for database 'swinn'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-20 17:31:21
