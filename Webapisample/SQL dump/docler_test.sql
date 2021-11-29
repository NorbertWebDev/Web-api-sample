CREATE DATABASE  IF NOT EXISTS `webapisample` /*!40100 DEFAULT CHARACTER SET utf32 COLLATE utf32_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `webapisample`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: webapisample
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary view structure for view `get_users_with_result`
--

DROP TABLE IF EXISTS `get_users_with_result`;
/*!50001 DROP VIEW IF EXISTS `get_users_with_result`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `get_users_with_result` AS SELECT 
 1 AS `Firstname`,
 1 AS `Middle_name`,
 1 AS `Lastname`,
 1 AS `Email`,
 1 AS `Phone`,
 1 AS `Mobile`,
 1 AS `Programming`,
 1 AS `Networking`,
 1 AS `Op_systems`,
 1 AS `Databases`,
 1 AS `Version_control`,
 1 AS `Testing`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participants` (
  `id` mediumint unsigned NOT NULL,
  `firstname` char(50) COLLATE utf32_unicode_ci NOT NULL,
  `middle_name` char(50) COLLATE utf32_unicode_ci DEFAULT NULL,
  `lastname` char(50) COLLATE utf32_unicode_ci NOT NULL,
  `email` char(120) COLLATE utf32_unicode_ci DEFAULT NULL,
  `phone` char(11) COLLATE utf32_unicode_ci DEFAULT NULL,
  `mobile` char(11) COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `email_INDEX` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci PACK_KEYS=1 KEY_BLOCK_SIZE=4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
REPLACE  IGNORE INTO `participants` (`id`, `firstname`, `middle_name`, `lastname`, `email`, `phone`, `mobile`) VALUES (0,'Tester','Testing','Tested','test@test.com','0610000000',NULL);
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `results` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `user_id` mediumint NOT NULL,
  `programming` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf32_unicode_ci NOT NULL,
  `networking` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf32_unicode_ci NOT NULL,
  `op_systems` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf32_unicode_ci NOT NULL,
  `database_systems` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf32_unicode_ci NOT NULL,
  `version_control` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf32_unicode_ci NOT NULL,
  `testing` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_INDEX` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci PACK_KEYS=1 KEY_BLOCK_SIZE=4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
REPLACE  IGNORE INTO `results` (`id`, `user_id`, `programming`, `networking`, `op_systems`, `database_systems`, `version_control`, `testing`) VALUES (1,0,'10','10','10','10','10','10'),(4,1,'10','10','10','10','10','10'),(5,1,'1','1','1','1','1','1'),(6,1,'1','1','1','1','1','1'),(7,1,'1','1','1','1','1','1'),(8,0,'1','2','3','4','5','6');
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'webapisample'
--

--
-- Dumping routines for database 'webapisample'
--
/*!50003 DROP PROCEDURE IF EXISTS `insert_test_result` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `insert_test_result`(in user_id mediumint,in programming enum('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),in networking enum('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),in op_systems enum('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),in database_systems enum('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),in version_control enum('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),in testing enum('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'))
BEGIN
	INSERT INTO webapisample.results (user_id,programming,networking,op_systems,database_systems,version_control,testing)
    VALUES (user_id,programming,networking,op_systems,database_systems,version_control,testing);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `get_users_with_result`
--

/*!50001 DROP VIEW IF EXISTS `get_users_with_result`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER */
/*!50001 VIEW `get_users_with_result` AS select `p`.`firstname` AS `Firstname`,`p`.`middle_name` AS `Middle_name`,`p`.`lastname` AS `Lastname`,`p`.`email` AS `Email`,`p`.`phone` AS `Phone`,`p`.`mobile` AS `Mobile`,`r`.`programming` AS `Programming`,`r`.`networking` AS `Networking`,`r`.`op_systems` AS `Op_systems`,`r`.`database_systems` AS `Databases`,`r`.`version_control` AS `Version_control`,`r`.`testing` AS `Testing` from (`results` `r` join `participants` `p`) where (`r`.`user_id` = `p`.`id`) order by `r`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-03  1:11:55
