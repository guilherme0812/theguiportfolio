-- MySQL dump 10.17  Distrib 10.3.16-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: pizzaria
-- ------------------------------------------------------
-- Server version	10.3.16-MariaDB

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
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administradores` (
  `administradorID` int(11) NOT NULL AUTO_INCREMENT,
  `nomeadministrador` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`administradorID`),
  UNIQUE KEY `nomeadministrador` (`nomeadministrador`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'guilhermeadm','guiiuggui0911');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `pedidoID` int(11) NOT NULL AUTO_INCREMENT,
  `fk_usuario` int(11) NOT NULL,
  `tamanho` varchar(50) DEFAULT NULL,
  `sabor1` varchar(50) NOT NULL,
  `sabor2` varchar(50) DEFAULT NULL,
  `sabor3` varchar(50) DEFAULT NULL,
  `bebida` varchar(20) DEFAULT NULL,
  `qnt_bebida` int(11) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `forma_de_pagamento` varchar(20) DEFAULT NULL,
  `valor_total` decimal(6,2) DEFAULT NULL,
  `data_pedido` date NOT NULL,
  `horario_pedido` time NOT NULL,
  PRIMARY KEY (`pedidoID`),
  KEY `fk_usuario` (`fk_usuario`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`usuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,5,'pequena','6 queijos',' ',' ','Coca-Cola 2l',1,'','Dinheiro',0.00,'2019-09-21','09:36:50'),(2,5,'pequena','6 queijos',' ',' ','Coca-Cola 2l',1,'','Dinheiro',0.00,'2019-09-21','09:36:50'),(3,5,'pequena','6 queijos',' ',' ','Coca-Cola 2l',1,'','Dinheiro',0.00,'2019-09-21','09:36:50'),(4,5,'pequena','6 queijos',' ',' ','Coca-Cola 2l',1,'','Dinheiro',0.00,'2019-09-21','09:36:50');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_pendentes`
--

DROP TABLE IF EXISTS `pedidos_pendentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos_pendentes` (
  `pedido_pendenteID` int(11) NOT NULL AUTO_INCREMENT,
  `fk_usuario` int(11) NOT NULL,
  `tamanho` enum('P','M','G','TF') DEFAULT NULL,
  `sabor1` varchar(255) DEFAULT NULL,
  `sabor2` varchar(255) DEFAULT NULL,
  `sabor3` varchar(255) DEFAULT NULL,
  `bebida` varchar(255) DEFAULT NULL,
  `qnt_bebida` int(11) DEFAULT 0,
  `valor` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`pedido_pendenteID`),
  KEY `fk_usuario` (`fk_usuario`),
  CONSTRAINT `pedidos_pendentes_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`usuarioID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_pendentes`
--

LOCK TABLES `pedidos_pendentes` WRITE;
/*!40000 ALTER TABLE `pedidos_pendentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos_pendentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sabores`
--

DROP TABLE IF EXISTS `sabores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sabores` (
  `saborID` int(11) NOT NULL AUTO_INCREMENT,
  `nomesabor` varchar(50) NOT NULL,
  `ingredientes` text NOT NULL,
  `saborespecial` bit(1) DEFAULT b'0',
  PRIMARY KEY (`saborID`),
  UNIQUE KEY `nomesabor` (`nomesabor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sabores`
--

LOCK TABLES `sabores` WRITE;
/*!40000 ALTER TABLE `sabores` DISABLE KEYS */;
INSERT INTO `sabores` VALUES (1,'mussarela','mussarela, oregãno','\0'),(2,'Calabresa','mussarela, calabresa, cebola, oregãno.','\0'),(3,'6 queijos','mussarela, parmesão, provolone, requeijão.','\0'),(4,'Frango com requeijão','Mussarela, frango, requeijão, orégano','\0');
/*!40000 ALTER TABLE `sabores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuarioID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `sexo` enum('M','F','O') DEFAULT 'O',
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL DEFAULT 'Não especificado',
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`usuarioID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Gabriel corso da Rocha','47991385663','M','Rua Orca','Bombas','babrielcorso@gmail.com','741852963'),(3,'Gabriel corso da Rocha','47991385663','M','Rua Orca','Bombas','babrielcorso47@gmail.com','741852963'),(4,'Lhorran Charles','47997391131','M','Rua Onça Pintada n° 748','Bombas','lhorran3@gmail.com','741852963'),(5,'Guilherme','991385663','M','Rua Orca','Centro','gulherme09112001@gmail.com','741852963a'),(6,'Cristiane Corso Da Rocha','47992228632','M','Rua Orca n ° 591, casa 3','Bombas','cristianecorso_11@hotmail.com','cristianecorso');
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

-- Dump completed on 2019-09-21 12:15:33
