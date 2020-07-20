
CREATE TABLE `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `nome_item` varchar(50) NOT NULL,
  `codbarra_item` text NOT NULL,
  `qtd` varchar(255) NOT NULL,
  `minimo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;



CREATE TABLE `tecnicos` (
  `id_tecnico` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `status` varchar(15) NOT NULL,
  `tipo` varchar(55) NOT NULL,
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
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cliente` int(11) NOT NULL,
  `data_cadastro` date NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `referencia` varchar(150),
  `celular` varchar(50) NOT NULL,
  `celular2` varchar(50) ,
  `telefone` varchar(50) ,    
  `tipo` varchar(50) NOT NULL,
  `status_cliente` varchar(50) NOT NULL,
   `fk_id_bairro` int NOT NULL,
   PRIMARY KEY (`id_cliente`),
    FOREIGN KEY (`fk_id_bairro`) REFERENCES bairros(`id_bairro`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `instalacoes` (
  `id_instalacao` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_tecnico` int(11) NOT NULL,
  `fk_id_cliente` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `data_fechamento` date ,
  `status_agendamento` varchar(50) NOT NULL,
  `tipo` varchar(50),
   PRIMARY KEY (`id_instalacao`),
   FOREIGN KEY (`fk_id_usuario`) REFERENCES usuarios(`idusuario`),
   FOREIGN KEY (`fk_id_tecnico`) REFERENCES tecnicos(`id_tecnico`),
   FOREIGN KEY (`fk_id_cliente`) REFERENCES clientes(`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `transferencias` (
  `id_transferencia` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_cliente` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `data_transferencia` date NOT NULL,
  `addressOld` varchar(255) NOT NULL,
  `addressNew` varchar(255) NOT NULL,
   PRIMARY KEY (`id_transferencia`),
   FOREIGN KEY (`fk_id_cliente`) REFERENCES clientes(`id_cliente`),
   FOREIGN KEY (`fk_id_usuario`) REFERENCES usuarios(`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text NOT NULL,
  `data_comentario` datetime NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_comentario`),
  FOREIGN KEY (`fk_id_usuario`) REFERENCES usuarios(`id_usuario`),
  FOREIGN KEY (`fk_id_cliente`) REFERENCES clientes(`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;