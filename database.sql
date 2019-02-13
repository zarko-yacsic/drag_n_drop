-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: desarrollo.cool    Database: db_zyacsic
-- ------------------------------------------------------
-- Server version	5.5.60-MariaDB

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
-- Table structure for table `test_categorias`
--

DROP TABLE IF EXISTS `test_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_categorias`
--

LOCK TABLES `test_categorias` WRITE;
/*!40000 ALTER TABLE `test_categorias` DISABLE KEYS */;
INSERT INTO `test_categorias` VALUES (1,'Categoria 01',1),(2,'Categoria 02',2),(3,'Categoria 03',3);
/*!40000 ALTER TABLE `test_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_preguntas`
--

DROP TABLE IF EXISTS `test_preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `test_preguntas_test_categorias_FK` (`categoria`),
  CONSTRAINT `test_preguntas_test_categorias_FK` FOREIGN KEY (`categoria`) REFERENCES `test_categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_preguntas`
--

LOCK TABLES `test_preguntas` WRITE;
/*!40000 ALTER TABLE `test_preguntas` DISABLE KEYS */;
INSERT INTO `test_preguntas` VALUES (1,'Pregunta 01',NULL,0),(2,'Pregunta 02',NULL,0),(3,'Pregunta 03',NULL,0),(4,'Pregunta 04',NULL,0),(5,'Pregunta 05',NULL,0),(6,'Pregunta 06',NULL,0),(7,'Pregunta 07',NULL,0),(8,'Pregunta 08',NULL,0);
/*!40000 ALTER TABLE `test_preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_zyacsic'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-13 17:21:06
