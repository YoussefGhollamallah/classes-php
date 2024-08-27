-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: classes
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'menbas','$2y$10$CZLS/ZRHYJn9kySyARoZz.fnJt9X6TiELMiWYCWwEappBlYINYrgy','youssef.gh@live.fr','Youssef','Ghollamallah'),(2,'allstar','$2y$10$Faju3oOJ/bdxv8LDArjZteFdC8NG16sXN4xFwvztUn4mGYTT/a7LC','ayman@laplateforme.io','ayman','Ghollamallah'),(3,'mikasa','$2y$10$Jg.jvBg4Cz6DF/WxAnreSudlusf3hkRXjtq/pVNdAUf2dtfsRBe42','mikasa@laplateforme.io','mikasa','sukasa'),(4,'alistar','$2y$10$6nMQ35hjFltTtSMVhAD1Ne7/Gu0.7sG/6YdfDHM.tMSCW44o8P986','alistar@live.fr','alistar','crowley'),(5,'test','$2y$10$Pw2Se5.ZeHMLOxsXf75hVOqZbos856eJ4oaCOy3T7ueB/m84Zgkzq','test@test.fr','test','test'),(6,'azz','$2y$10$lAHK0BZd.8gqZiGG2p6QWuLYnw4HIHIj9z6DtpSxRuILCSoLN7X/2','az@az.fr','youssef','ghollamallah'),(7,'magic','$2y$10$EiQ2RxJaQ0IiALT.rp1drOvq44ZC6NtSN5HFJtsEd3Shy1hPo00ru','magic@laplateforme.io','magic','magic'),(8,'pet','$2y$10$q1QOHDtAhXOBdNqbufbWXOk/RcpXLFQfWOKjzI6gGRGc6Nq1spI7S','azererbadjan@gmail.com','youssef','ghollamallah'),(9,'azze','$2y$10$LHWq/jBXXqNOG.EA8xMDmOpfTU0qIKCFP.eg1s1/O5W9w6ak67pE.','ay@gmail.fr','youssef','ghollamallah'),(10,'test2','$2y$10$K9w9E1VPeTjbb/9rAjp6J.cKAy0tyaO5VEM0DT9jpag1r3ODLlgB2','ameli@test.fr','abdelkader','ghollamallah');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-27 14:41:02
