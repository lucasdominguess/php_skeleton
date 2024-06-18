-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_usuarios
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime NOT NULL COMMENT 'Create Time',
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `tmp_name` varchar(255) NOT NULL,
  `error` tinyint(4) NOT NULL,
  `size` int(11) NOT NULL,
  `id_adm` int(11) NOT NULL,
  `full_path` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_adm` (`id_adm`),
  CONSTRAINT `arquivos_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `usuarios` (`id_adm`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivos`
--

LOCK TABLES `arquivos` WRITE;
/*!40000 ALTER TABLE `arquivos` DISABLE KEYS */;
INSERT INTO `arquivos` VALUES (10,'2024-06-18 10:56:57','exemplo_tabela.png','image/png','C:\\xampp\\tmp\\phpAF76.tmp',0,100689,3,'exemplo_tabela.png','ID_03_LUCAS','C:\\Users\\x492420\\OneDrive - rede.sp\\Área de Trabalho\\php_skeleton\\src\\classes/../Application/files/arquivos/ID_03_LUCAS/'),(11,'2024-06-18 10:56:57','imagem.jpg','image/jpeg','C:\\xampp\\tmp\\phpAF77.tmp',0,83992,3,'imagem.jpg','ID_03_LUCAS','C:\\Users\\x492420\\OneDrive - rede.sp\\Área de Trabalho\\php_skeleton\\src\\classes/../Application/files/arquivos/ID_03_LUCAS/'),(12,'2024-06-18 10:56:57','print_tabela.png','image/png','C:\\xampp\\tmp\\phpAF78.tmp',0,58210,3,'print_tabela.png','ID_03_LUCAS','C:\\Users\\x492420\\OneDrive - rede.sp\\Área de Trabalho\\php_skeleton\\src\\classes/../Application/files/arquivos/ID_03_LUCAS/'),(13,'2024-06-18 10:59:16','root.png','image/png','C:\\xampp\\tmp\\phpD094.tmp',0,58210,4,'root.png','ID_04_ROOT','C:\\Users\\x492420\\OneDrive - rede.sp\\Área de Trabalho\\php_skeleton\\src\\classes/../Application/files/arquivos/ID_04_ROOT/'),(14,'2024-06-18 10:59:16','root_exemplo_tabela.png','image/png','C:\\xampp\\tmp\\phpD095.tmp',0,100689,4,'root_exemplo_tabela.png','ID_04_ROOT','C:\\Users\\x492420\\OneDrive - rede.sp\\Área de Trabalho\\php_skeleton\\src\\classes/../Application/files/arquivos/ID_04_ROOT/'),(15,'2024-06-18 10:59:16','root_imagem.jpg','image/jpeg','C:\\xampp\\tmp\\phpD096.tmp',0,83992,4,'root_imagem.jpg','ID_04_ROOT','C:\\Users\\x492420\\OneDrive - rede.sp\\Área de Trabalho\\php_skeleton\\src\\classes/../Application/files/arquivos/ID_04_ROOT/');
/*!40000 ALTER TABLE `arquivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estagiarios`
--

DROP TABLE IF EXISTS `estagiarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estagiarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `id_adm` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `id_adm` (`id_adm`),
  CONSTRAINT `estagiarios_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `usuarios` (`id_adm`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estagiarios`
--

LOCK TABLES `estagiarios` WRITE;
/*!40000 ALTER TABLE `estagiarios` DISABLE KEYS */;
INSERT INTO `estagiarios` VALUES (0,'UM THIAGO DBA','1998-01-01',4),(54,'RODRIGO DESENVOLVEDOR QUA','2000-12-12',4),(66,'TIAGO O DBA MASTER','1998-01-01',4),(68,'CAMILA DO POWER BIIIIIIII','1999-01-01',4),(71,'RODRIGO O CSSMAN','1999-05-01',4),(72,'CSS é COM O RODRIGO MESMO','1999-12-05',4),(74,'RODRIGO O FRONT END MASTE','1999-12-05',4),(75,'THI ECO','1999-01-01',4),(78,'RODRIGO CSS E THIAGO DBA','1999-01-01',4),(84,'ET DO VARGINHASSSSSS','1993-01-01',4),(85,'CADASTRO','1999-12-19',4),(86,'HORA DE MOSSAR','1999-01-01',4),(91,'HORA DE MOSSAR CABO','1999-01-01',4),(94,'MARIA JUAQUINA','1999-01-01',4),(98,'KARINA S','1999-01-01',4),(100,'EX AASDASD','2001-01-01',4),(102,'TESTE USUARIO','1999-01-01',4),(106,'RODRIGO O MOSTRO DO JWT I','1999-01-02',3),(107,'RODRIGO SEM TECLADO','1998-01-01',3),(108,'THIAGO SULUSSUS','1998-01-01',3),(112,'QLQ COISA','2000-12-12',4),(113,'QUALQUER COISA DOIS','1999-01-01',4),(117,'NOVO USER','1999-01-01',3),(118,'ALEATORIO','1999-01-01',3),(119,'OUTRO ALEATORIO','1999-01-01',4),(120,'LUCAS DOMINGUES','1999-01-01',3),(121,'THIAGO SANTOS','1998-01-01',3),(122,'RODRIGO DESENVOLVEDOR CSS','2000-12-12',3),(124,'DOIS THIAGO DBA','1998-01-01',3);
/*!40000 ALTER TABLE `estagiarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `Column1` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset`
--

DROP TABLE IF EXISTS `reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset` (
  `date` datetime DEFAULT NULL COMMENT 'Create Time',
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset`
--

LOCK TABLES `reset` WRITE;
/*!40000 ALTER TABLE `reset` DISABLE KEYS */;
INSERT INTO `reset` VALUES ('2024-06-13 10:27:45','lucasdomingues@prefeitura.sp.gov.br','a1419aaf5d7b4b11a1ea71bc9870a3d0'),('2024-06-13 11:33:05','lucasdomingues@prefeitura.sp.gov.br','3a8497e4aea49f7319a431a5491b2d6f'),('2024-06-13 12:32:53','lucasdomingues@prefeitura.sp.gov.br','d1c81e28230262cb41ea8bf74ea86cac'),('2024-06-17 08:12:23','lucasdomingues@prefeitura.sp.gov.br','496a936ad3c600864482f404bdd12ed3'),('2024-06-17 08:12:28','tlettieri@prefeitura.sp.gov.br','1f423cd5e7e87c290c34654b989e575b'),('2024-06-17 08:15:28','tlettieri@prefeitura.sp.gov.br','d95f996ff00cfd2fa5dccae4a9408067'),('2024-06-17 08:15:32','tlettieri@prefeitura.sp.gov.br','d8ad9b36b220becf4aa74a3dd1f5579b'),('2024-06-17 08:16:36','tlettieri@prefeitura.sp.gov.br','6f7b849ba17ce54d3ddd8ad21e8fd392');
/*!40000 ALTER TABLE `reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tentativa`
--

DROP TABLE IF EXISTS `tentativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tentativa` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `emails` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tentativa`
--

LOCK TABLES `tentativa` WRITE;
/*!40000 ALTER TABLE `tentativa` DISABLE KEYS */;
INSERT INTO `tentativa` VALUES (62,'lucasdominguesofficial@gmail.com','2024-06-12 13:46:07'),(63,'lucasdominguesofficial@gmail.com','2024-06-12 13:46:22'),(64,'lucasdominguesofficial@gmail.com','2024-06-12 13:47:27'),(65,'lucasdominguesofficial@gmail.com','2024-09-12 13:49:52'),(67,'tlettieri@prefeitura.sp.gov.br','2024-06-13 12:56:12'),(69,'rodrigosoaresp@prefeitura.sp.gov.br','2024-06-13 12:58:10'),(70,'rodrigosoaresp@prefeitura.sp.gov.br','2024-06-13 12:58:17'),(71,'lucasdomingues@prefeitura.sp.gov.br','2024-06-13 13:33:54'),(72,'lucasdomingues@prefeitura.sp.gov.br','2024-06-14 08:02:50'),(73,'ROOT','2024-06-14 13:41:15'),(74,'root','2024-06-17 12:49:00');
/*!40000 ALTER TABLE `tentativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nivel` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_adm`),
  UNIQUE KEY `usuarios_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'Lucas','lucasdomingues@prefeitura.sp.gov.br','$2y$10$SFHFVar1Z8g6RElUMRN/Iube6MwMJkEMcs4ehSjAIQtmyX9Q.BKXO',5),(4,'ROOT','root','$2y$10$z6uwZWX0YFMELzZ7gvGsYu8GqnEoeIRGYmGyLtdlyCOnOLY.QRscC',5),(8,'Rodrigo Soares Pimenta','rodrigosoaresp@prefeitura.sp.gov.br','$2y$10$GSY4DFwvjg9eGswZXGvK6.SexyGJ0q2EiCaN/bOnooQ/bxTgw9B9K',1),(28,'Rodrigo','tlettieri@prefeitura.sp.gov.br','$2y$10$dSur5hWFaeQx5dfllbgIke.hg7TRQLi.5Vos0QH6Uf4epqY8dPZva',0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-18 11:05:40
