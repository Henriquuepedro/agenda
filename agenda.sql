-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Nov-2018 às 03:13
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `accounts`
--

CREATE TABLE `accounts` (
  `NCODUSER` int(11) NOT NULL,
  `CNAME` varchar(250) NOT NULL,
  `CPASSWORD` varchar(250) NOT NULL,
  `CLOGIN` varchar(250) NOT NULL,
  `CEMAIL` varchar(250) NOT NULL,
  `NTEL` varchar(20) NOT NULL,
  `CEMPRESA` varchar(250) NOT NULL,
  `CCARGO` varchar(250) NOT NULL,
  `CENDERECO` varchar(150) NOT NULL,
  `NNUMERO` varchar(50) NOT NULL,
  `CCIDADE` varchar(50) NOT NULL,
  `CESTADO` varchar(2) NOT NULL,
  `NCEP` varchar(10) NOT NULL,
  `CSTATUS` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `accounts`
--

INSERT INTO `accounts` (`NCODUSER`, `CNAME`, `CPASSWORD`, `CLOGIN`, `CEMAIL`, `NTEL`, `CEMPRESA`, `CCARGO`, `CENDERECO`, `NNUMERO`, `CCIDADE`, `CESTADO`, `NCEP`, `CSTATUS`) VALUES
(1, 'Pedro Henrique', '123456', 'pedro123', 'pedrohenrique.sc.96@gmail.com', '48996677961', 'EMPRESA', 'Desenvolvedor', 'Rua Teste', '123', 'Florianópolis', 'SC', '88010000', 'Status sobre mim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `NCODCONTACT` int(11) NOT NULL,
  `CNAME` varchar(200) NOT NULL,
  `CEMPRESA` varchar(200) NOT NULL,
  `NTEL` varchar(20) NOT NULL,
  `CIMG` varchar(200) NOT NULL,
  `CCARGO` mediumtext NOT NULL,
  `CEMAIL` varchar(200) NOT NULL,
  `NCODUSER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contacts`
--

INSERT INTO `contacts` (`NCODCONTACT`, `CNAME`, `CEMPRESA`, `NTEL`, `CIMG`, `CCARGO`, `CEMAIL`, `NCODUSER`) VALUES
(20, 'Pedro Henrique', 'APRESI', '48996677961', '280ba44db4135011ba13a3be8eed4ff5.png', 'Desenvolvedor', 'pedrohenrique.sc.96@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`NCODUSER`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`NCODCONTACT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `NCODUSER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `NCODCONTACT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
