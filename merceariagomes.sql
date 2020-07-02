-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: merceariagomes
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

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
-- Table structure for table `despesa`
--

DROP TABLE IF EXISTS `despesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesa` (
  `idDespesa` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`idDespesa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesa`
--

LOCK TABLES `despesa` WRITE;
/*!40000 ALTER TABLE `despesa` DISABLE KEYS */;
/*!40000 ALTER TABLE `despesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesas`
--

DROP TABLE IF EXISTS `despesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesas` (
  `idDespesa` int(11) NOT NULL AUTO_INCREMENT,
  `idDespesaN` int(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `valorDespesa` decimal(10,2) NOT NULL,
  `dataDespesa` date NOT NULL,
  PRIMARY KEY (`idDespesa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesas`
--

LOCK TABLES `despesas` WRITE;
/*!40000 ALTER TABLE `despesas` DISABLE KEYS */;
INSERT INTO `despesas` VALUES (1,2,'Devedor',50.00,'2020-06-13');
/*!40000 ALTER TABLE `despesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `nome_item` varchar(50) NOT NULL,
  `codbarra_item` text NOT NULL,
  `qtd` varchar(255) NOT NULL,
  `minimo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'BALA','123'),(2,'NESCAU','159');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamentodespesa`
--

DROP TABLE IF EXISTS `pagamentodespesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentodespesa` (
  `idpagamento` int(11) NOT NULL AUTO_INCREMENT,
  `idDespesaN` int(50) NOT NULL,
  `idDespesaP` int(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `datapagamento` datetime NOT NULL,
  PRIMARY KEY (`idpagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamentodespesa`
--

LOCK TABLES `pagamentodespesa` WRITE;
/*!40000 ALTER TABLE `pagamentodespesa` DISABLE KEYS */;
INSERT INTO `pagamentodespesa` VALUES (141,2,1,50.00,'2020-06-13 14:06:45'),(142,2,1,50.00,'2020-06-13 14:06:51'),(143,2,1,50.00,'2020-06-13 14:14:34'),(144,2,1,50.00,'2020-06-13 14:16:55'),(145,2,1,50.00,'2020-06-13 14:20:37'),(146,2,1,20.00,'2020-06-13 14:21:20');
/*!40000 ALTER TABLE `pagamentodespesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagveado`
--

DROP TABLE IF EXISTS `pagveado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagveado` (
  `id_pagveado` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente_pagveado` int(11) NOT NULL,
  `valor_pagveado` decimal(10,2) NOT NULL,
  `data_pagveado` datetime NOT NULL,
  `status_pagveado` varchar(5) NOT NULL,
  PRIMARY KEY (`id_pagveado`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagveado`
--

LOCK TABLES `pagveado` WRITE;
/*!40000 ALTER TABLE `pagveado` DISABLE KEYS */;
INSERT INTO `pagveado` VALUES (1,24,10.00,'2015-07-13 11:32:07','ok'),(2,24,3.00,'2015-07-13 11:35:16','ok'),(3,24,3.00,'2015-07-13 11:40:13','ok'),(4,49,2.00,'2015-07-13 11:49:06','ok'),(5,49,5.00,'2015-07-13 11:49:18','ok'),(6,49,0.50,'2015-07-13 11:49:25','ok'),(7,24,1.00,'2015-07-13 11:55:02','ok'),(8,24,1.00,'2015-07-13 11:55:10','ok'),(9,24,0.50,'2015-07-13 11:55:16','ok');
/*!40000 ALTER TABLE `pagveado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id_item` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valordecusto` decimal(10,2) NOT NULL,
  `qtd` varchar(15) NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

CREATE TABLE `tecnicos` (
  `id_tecnico` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_tecnico`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

CREATE TABLE `fornecedoras` (
  `id_fornecedora` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL, 
  `cnpj` varchar(255) ,
  `contato` varchar(255) ,
  `telefone` varchar(255) ,
  `sites` varchar(255),
  PRIMARY KEY (`id_fornecedora`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_fornecedora` varchar(255) NOT NULL,
  `id_item` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `data_compra` datetime NOT NULL,
  PRIMARY KEY (`id_compra`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `retiradas` (
  `id_retirada` int(11) NOT NULL AUTO_INCREMENT,
  `id_tecnico` varchar(255) NOT NULL,
  `id_item` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_retirada` datetime NOT NULL,
  PRIMARY KEY (`id_retirada`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `tipodespesa` (
  `idtipodespesa` int(11) NOT NULL AUTO_INCREMENT,
  `nometipodespesa` text NOT NULL,
  PRIMARY KEY (`idtipodespesa`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodespesa`
--

LOCK TABLES `tipodespesa` WRITE;
/*!40000 ALTER TABLE `tipodespesa` DISABLE KEYS */;
INSERT INTO `tipodespesa` VALUES (1,'ENERGIA'),(2,'AGUA');
/*!40000 ALTER TABLE `tipodespesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

--
-- Table structure for table `vendaprovisoria`
--

DROP TABLE IF EXISTS `vendaprovisoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendaprovisoria` (
  `id_venda` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id_item` int(11) NOT NULL,
  `nome_item` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valordecusto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_venda`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendaprovisoria`
--


CREATE TABLE `setores` (
  `id_setor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id_setor`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `bairros` (
  `id_bairro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `fk_id_setor` int,
   PRIMARY KEY (`id_bairro`),
   FOREIGN KEY (`fk_id_setor`) REFERENCES setores(`id_setor`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `prevclientes` (
  `id_prevcliente` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cliente` int(11) NOT NULL,
  `data_cadastro` date NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `referencia` varchar(150) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `celular` varchar(50) NOT NULL,
   PRIMARY KEY (`id_prevcliente`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `clientes` (
  `id_clientes` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cliente` int(11) NOT NULL,
  `data_cadastro` date NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `referencia` varchar(150) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `status_cliente` varchar(50) NOT NULL,
   `fk_id_bairro` int NOT NULL,
   PRIMARY KEY (`id_clientes`),
    FOREIGN KEY (`fk_id_bairro`) REFERENCES bairros(`id_bairro`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;