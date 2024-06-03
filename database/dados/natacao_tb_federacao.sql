-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: natacao
-- ------------------------------------------------------
-- Server version	8.4.0

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
-- Dumping data for table `tb_federacao`
--

LOCK TABLES `tb_federacao` WRITE;
/*!40000 ALTER TABLE `tb_federacao` DISABLE KEYS */;
INSERT INTO `tb_federacao` VALUES (1,'Confederacao Brasileira de Desportos Aquaticos','CBDA','./images/logos/logoCBDA.png',NULL,NULL,NULL,NULL,NULL,24),(2,'Federacao Aquatica Paulista','FAP','./images/logos/logoFAP.png',NULL,NULL,NULL,NULL,NULL,24),(3,'Federacao Aquatica do Rio de Janeiro','FARJ','./images/logos/logoFARJ.png',NULL,NULL,NULL,NULL,NULL,23),(4,'Federacao Aquatica Mineira','FAM','./images/logos/logoFAM.png',NULL,NULL,NULL,NULL,NULL,22),(5,'Federacao Aquatica Capixaba','FAC','./images/logos/logoFAC.png',NULL,NULL,NULL,NULL,NULL,21);
/*!40000 ALTER TABLE `tb_federacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-02 21:47:08
