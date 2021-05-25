-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Maio-2021 às 03:28
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `psigamesbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `pk_id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  PRIMARY KEY (`pk_id_adm`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`pk_id_adm`, `nome`, `email`, `senha`) VALUES
(1, 'admin', 'admin@admin', 'admin'),
(2, 'admin2', 'admin2@admin', 'admin'),
(3, 'admin3', 'admin3@admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinhos`
--

DROP TABLE IF EXISTS `carrinhos`;
CREATE TABLE IF NOT EXISTS `carrinhos` (
  `pk_id_car` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_jogador` int(11) NOT NULL,
  `data_compra` date NOT NULL,
  PRIMARY KEY (`pk_id_car`),
  KEY `fk_id_jogador` (`fk_id_jogador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `car_compra_jogo`
--

DROP TABLE IF EXISTS `car_compra_jogo`;
CREATE TABLE IF NOT EXISTS `car_compra_jogo` (
  `pk_id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_car` int(11) NOT NULL,
  `fk_id_jogo` int(11) NOT NULL,
  PRIMARY KEY (`pk_id_compra`),
  KEY `fk_id_car` (`fk_id_car`),
  KEY `fk_id_jogo` (`fk_id_jogo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogadores`
--

DROP TABLE IF EXISTS `jogadores`;
CREATE TABLE IF NOT EXISTS `jogadores` (
  `pk_id_jogador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  PRIMARY KEY (`pk_id_jogador`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jogadores`
--

INSERT INTO `jogadores` (`pk_id_jogador`, `nome`, `nickname`, `email`, `senha`) VALUES
(1, 'joaozinhoGameplays123', 'theKILLER', 'joaozinhoGameplays123@gmail.com', '123'),
(2, 'daniel', 'zinha MÃO', 'mao@gmail.com', '123'),
(3, '123', '123', '123@gmail.com', '123'),
(4, 'ehe', 'waifu hunter', 'mail@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

DROP TABLE IF EXISTS `jogos`;
CREATE TABLE IF NOT EXISTS `jogos` (
  `pk_id_jogo` int(11) NOT NULL AUTO_INCREMENT,
  `preco` decimal(9,2) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `requisitos` text NOT NULL,
  `descricao` text,
  `sistema` varchar(200) NOT NULL,
  `data_lancamento` date NOT NULL,
  PRIMARY KEY (`pk_id_jogo`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
