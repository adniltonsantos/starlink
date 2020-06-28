-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19-Jul-2015 às 23:34
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `merceariagomes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagveado`
--

CREATE TABLE IF NOT EXISTS `pagveado` (
  `id_pagveado` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente_pagveado` int(11) NOT NULL,
  `valor_pagveado` decimal(10,2) NOT NULL,
  `data_pagveado` datetime NOT NULL,
  `status_pagveado` varchar(5) NOT NULL,
  PRIMARY KEY (`id_pagveado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `pagveado`
--

INSERT INTO `pagveado` (`id_pagveado`, `id_cliente_pagveado`, `valor_pagveado`, `data_pagveado`, `status_pagveado`) VALUES
(1, 24, '10.00', '2015-07-13 11:32:07', 'ok'),
(2, 24, '3.00', '2015-07-13 11:35:16', 'ok'),
(3, 24, '3.00', '2015-07-13 11:40:13', 'ok'),
(4, 49, '2.00', '2015-07-13 11:49:06', 'ok'),
(5, 49, '5.00', '2015-07-13 11:49:18', 'ok'),
(6, 49, '0.50', '2015-07-13 11:49:25', 'ok'),
(7, 24, '1.00', '2015-07-13 11:55:02', 'ok'),
(8, 24, '1.00', '2015-07-13 11:55:10', 'ok'),
(9, 24, '0.50', '2015-07-13 11:55:16', 'ok');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
