-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Jul-2021 às 14:13
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
CREATE DATABASE IF NOT EXISTS `psigamesbd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `psigamesbd`;

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
(1, 'admin', 'admin@admin', '21232f297a57a5a743894a0e4a801fc3');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carrinhos`
--

INSERT INTO `carrinhos` (`pk_id_car`, `fk_id_jogador`, `data_compra`) VALUES
(1, 1, '2021-06-07'),
(2, 2, '2021-06-07'),
(3, 2, '2021-06-07'),
(4, 2, '2021-06-07'),
(5, 3, '2021-06-07');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `car_compra_jogo`
--

INSERT INTO `car_compra_jogo` (`pk_id_compra`, `fk_id_car`, `fk_id_jogo`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 3),
(5, 5, 1),
(6, 5, 2),
(7, 5, 3);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jogadores`
--

INSERT INTO `jogadores` (`pk_id_jogador`, `nome`, `nickname`, `email`, `senha`) VALUES
(1, 'Jogador 1', 'Player One', 'jogador1@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'Jogador 2', 'Player Two', 'jogador2@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'Jogador 3', 'Player Three', 'jogador3@gmail.com', '202cb962ac59075b964b07152d234b70');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jogos`
--

INSERT INTO `jogos` (`pk_id_jogo`, `preco`, `nome`, `requisitos`, `descricao`, `sistema`, `data_lancamento`) VALUES
(1, '59.99', 'Ark Survival Evolved', 'Processador: Intel Core i5-2400/AMD FX-8320 ou melhor\r\n\r\nMemória: 8 GB de RAM\r\n\r\nVídeo: NVIDIA GTX 670 2GB/AMD Radeon HD 7870 2GB ou melhor\r\n\r\nDirectX: Versão 10\r\n\r\nArmazenamento: 60 GB de espaço disponível', 'ARK Survival Evolved é um jogo desenvolvido pela Studio Wildcard do gênero Ação-Aventura com um mapa Mundo Aberto. O jogo foi desenvolvido utilizando o motor gráfico Unreal Engine. O jogo consiste em sobreviver em uma ilha repleta de dinossauros e outras criaturas pré-históricas.', 'Windows 7/8.1/10', '2015-07-02'),
(2, '40.00', 'Resident evil 4', 'Processador Intel Core 2 Quad 2,7 GHz (ou superior) ou AMD Phenom II X4 3 GHz (ou superior)\r\n4 GB de RAM.\r\n15 GB de espaço disponível para armazenamento.\r\nPlaca de vídeo NVIDIA GeForce GTX 560 (ou superior)', 'Resident Evil 4, conhecido no Japão como Biohazard 4 (バイオハザード4 Baiohazādo Fō?), é um jogo eletrônico de survival horror e tiro em terceira pessoa desenvolvido e publicado pela Capcom, lançado originalmente para o Nintendo GameCube em 2005. É o sexto jogo principal da franquia Resident Evil.', 'Windows XP /7 /8', '2005-01-11'),
(3, '250.00', 'NBA2K21', 'Processador: Intel® Core™ i5-4430 de 3 GHz / AMD FX-8370 de 3,4 GHz ou superior.\r\nMemória RAM: 8 GB.\r\nArmazenamento: 80 GB de espaço disponível.\r\nPlaca de vídeo: NVIDIA® GeForce® GTX 770 (2 GB) / AMD® Radeon™ R9 270 (2 GB) ou superior.', 'O NBA 2K21 da Take Two para PS4 é o novo jogo da renomada franquia de sucesso NBA 2K, que traz uma experiência esportiva líder de mercado. Com os melhores gráficos e jogabilidade da categoria, funcionalidades online competitivas e da comunidade, e modos de jogos variados e aprofundados, o NBA 2K21 oferece uma imersão sem igual no mundo e na cultura do basquete da NBA', 'Windows 7/ 8/ 10 ', '2020-11-04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
