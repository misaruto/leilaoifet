-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 04, 2018 at 07:13 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_leilao`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_administradores`
--

CREATE TABLE `tbl_administradores` (
  `id_adm` int(11) NOT NULL,
  `nome_adm` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_administradores`
--

INSERT INTO `tbl_administradores` (`id_adm`, `nome_adm`, `login`, `senha`, `email`, `cpf`) VALUES
(1, 'misa', 'misa', '123', '', 0),
(2, 'Jaqueline', 'jaqueline', 'jaqueline123', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_animais`
--

CREATE TABLE `tbl_animais` (
  `id_animal` int(11) NOT NULL,
  `id_animal_ano` int(11) NOT NULL,
  `nome_animal` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `brinco` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `peso` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_pesagem` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nascimento` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `raca` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `ano` year(4) NOT NULL,
  `avaliado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_animais`
--

INSERT INTO `tbl_animais` (`id_animal`, `id_animal_ano`, `nome_animal`, `brinco`, `peso`, `data_pesagem`, `nascimento`, `raca`, `descricao`, `ano`, `avaliado`) VALUES
(1, 1, 'Bonita', '35c', '77.6', '2016-06-06', '2016-06-15', 'GIrolando', 'Bonito rajado de marron								', 2018, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_avaliacoes`
--

CREATE TABLE `tbl_avaliacoes` (
  `id_avaliacao` int(11) NOT NULL,
  `id_avaliacao_ano` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `avaliacao1` decimal(10,0) NOT NULL,
  `avaliacao2` decimal(10,0) NOT NULL,
  `avaliacao3` decimal(10,0) NOT NULL,
  `media_avaliacao` decimal(10,2) NOT NULL,
  `avaliacao_corrigida` decimal(10,0) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_avaliacoes`
--

INSERT INTO `tbl_avaliacoes` (`id_avaliacao`, `id_avaliacao_ano`, `id_animal`, `avaliacao1`, `avaliacao2`, `avaliacao3`, `media_avaliacao`, `avaliacao_corrigida`, `ano`) VALUES
(1, 2, 1, '1000', '1120', '1322', '1147.33', '1150', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compradores`
--

CREATE TABLE `tbl_compradores` (
  `id_comprador` int(11) NOT NULL,
  `id_comprador_ano` int(11) NOT NULL,
  `nome_comprador` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nascimento` date NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` int(11) NOT NULL,
  `rg` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `cnpj` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nome_representante` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cs` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `id_procurador` int(11) NOT NULL,
  `estado` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `p_r_fiscal` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `p_r_fgts` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `p_i_debitos` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_compradores`
--

INSERT INTO `tbl_compradores` (`id_comprador`, `id_comprador_ano`, `nome_comprador`, `nascimento`, `login`, `senha`, `imagem`, `telefone`, `endereco`, `bairro`, `cpf`, `rg`, `cnpj`, `nome_representante`, `cs`, `id_procurador`, `estado`, `cidade`, `p_r_fiscal`, `p_r_fgts`, `p_i_debitos`, `ano`) VALUES
(1, 1, 'Misael Guilhardes de Freitas', '0000-00-00', 'ms', '1', '21462577_519675701718027_892447649821319377_n.png', '32 99999', 'rua a 123', 'l', 323424, '234234', '000101010101001', 'Misael', 'x', 0, 'minas', 'guara', '', '', '', 2018),
(5, 2, 'misael', '0000-00-00', '-', '-', 'default.jpg', '3299999', 'rua a 123', '', 323424, '234234', '', '', '', 0, 'minas', 'guara', '', '', '', 2018),
(6, 3, 'misael', '0000-00-00', '-', '-', 'default.jpg', '3299999', 'rua a 123', '', 323424, '234234', '', '', '', 0, 'minas', 'guara', '', '', '', 2018),
(7, 4, 'misael', '0000-00-00', '-', '-', 'default.jpg', '3299999', 'rua a 123', '', 323424, '234234', '', '', '', 0, 'minas', 'guara', '', '', '', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documentos`
--

CREATE TABLE `tbl_documentos` (
  `id_documento` int(11) NOT NULL,
  `id_documento_ano` int(11) NOT NULL,
  `nome` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_comprador` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_documentos`
--

INSERT INTO `tbl_documentos` (`id_documento`, `id_documento_ano`, `nome`, `tipo`, `id_comprador`, `ano`) VALUES
(23, 23, 'cad_comprador1.pdf', 'application/pdf', 1, 2018),
(24, 24, 'cad_comprador2.pdf', 'application/pdf', 2, 2018),
(25, 25, 'cad_comprador2.pdf', 'application/pdf', 2, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id_feedback` int(11) NOT NULL,
  `id_feedback_ano` int(11) NOT NULL,
  `nome` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(35) COLLATE latin1_general_ci NOT NULL,
  `msg` text COLLATE latin1_general_ci NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id_feedback`, `id_feedback_ano`, `nome`, `email`, `msg`, `ano`) VALUES
(1, 1, 'Mirian', 'mrafrt@gmail.com', 'tudo bugado kkk\r\n					', 2018),
(2, 2, 'Mirian', 'mrafrt@gmail.com', 'tudo bugado kkk\r\n					', 2018),
(3, 3, 'Mirian', 'mrafrt@gmail.com', 'tudo bugado kkk\r\n					', 2018),
(4, 4, 'Mirian', 'mrafrt@gmail.com', 'tudo bugado kkk\r\n					', 2018),
(5, 5, 'Mirian', 'mrafrt@gmail.com', 'Tudo bugado kkkk			', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_lotes`
--

CREATE TABLE `tbl_item_lotes` (
  `id_item` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item_lotes`
--

INSERT INTO `tbl_item_lotes` (`id_item`, `id_animal`, `id_lote`, `ano`) VALUES
(1, 1, 2, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logo`
--

CREATE TABLE `tbl_logo` (
  `id_imagem` int(11) NOT NULL,
  `nome` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `descricao` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_logo`
--

INSERT INTO `tbl_logo` (`id_imagem`, `nome`, `descricao`) VALUES
(6, 'IMG_1805.jpeg', ''),
(7, 'IMG_5296.jpeg', ''),
(8, 'images.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lotes`
--

CREATE TABLE `tbl_lotes` (
  `id_lote` int(11) NOT NULL,
  `id_lote_ano` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_lotes`
--

INSERT INTO `tbl_lotes` (`id_lote`, `id_lote_ano`, `ano`) VALUES
(1, 1, 2018),
(2, 2, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_procuradores`
--

CREATE TABLE `tbl_procuradores` (
  `id_procurador` int(11) NOT NULL,
  `id_procurador_ano` int(11) NOT NULL,
  `nome_procurador` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `rg_p` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cpf_p` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_procuradores`
--

INSERT INTO `tbl_procuradores` (`id_procurador`, `id_procurador_ano`, `nome_procurador`, `rg_p`, `cpf_p`, `ano`) VALUES
(1, 0, 'l', '1', '2', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tarefas`
--

CREATE TABLE `tbl_tarefas` (
  `id_tarefas` int(11) NOT NULL,
  `id_tarefas_ano` int(11) NOT NULL,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `responsavel` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `quantidade` int(11) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dia` int(2) NOT NULL,
  `mes` int(2) NOT NULL,
  `status` int(1) NOT NULL,
  `data_realizada` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_tarefas`
--

INSERT INTO `tbl_tarefas` (`id_tarefas`, `id_tarefas_ano`, `nome`, `responsavel`, `quantidade`, `tipo`, `dia`, `mes`, `status`, `data_realizada`, `ano`) VALUES
(1, 0, 'Leilão', '', 0, 'Data', 14, 9, 0, '', 2018);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_administradores`
--
ALTER TABLE `tbl_administradores`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `tbl_animais`
--
ALTER TABLE `tbl_animais`
  ADD PRIMARY KEY (`id_animal`);

--
-- Indexes for table `tbl_avaliacoes`
--
ALTER TABLE `tbl_avaliacoes`
  ADD PRIMARY KEY (`id_avaliacao`),
  ADD KEY `id_aniaml` (`id_animal`);

--
-- Indexes for table `tbl_compradores`
--
ALTER TABLE `tbl_compradores`
  ADD PRIMARY KEY (`id_comprador`),
  ADD KEY `id_procurador` (`id_procurador`) USING BTREE;

--
-- Indexes for table `tbl_documentos`
--
ALTER TABLE `tbl_documentos`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indexes for table `tbl_item_lotes`
--
ALTER TABLE `tbl_item_lotes`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `id_lote` (`id_lote`);

--
-- Indexes for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  ADD PRIMARY KEY (`id_imagem`);

--
-- Indexes for table `tbl_lotes`
--
ALTER TABLE `tbl_lotes`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indexes for table `tbl_procuradores`
--
ALTER TABLE `tbl_procuradores`
  ADD PRIMARY KEY (`id_procurador`);

--
-- Indexes for table `tbl_tarefas`
--
ALTER TABLE `tbl_tarefas`
  ADD PRIMARY KEY (`id_tarefas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_administradores`
--
ALTER TABLE `tbl_administradores`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_animais`
--
ALTER TABLE `tbl_animais`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_avaliacoes`
--
ALTER TABLE `tbl_avaliacoes`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_compradores`
--
ALTER TABLE `tbl_compradores`
  MODIFY `id_comprador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_documentos`
--
ALTER TABLE `tbl_documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_item_lotes`
--
ALTER TABLE `tbl_item_lotes`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_lotes`
--
ALTER TABLE `tbl_lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_procuradores`
--
ALTER TABLE `tbl_procuradores`
  MODIFY `id_procurador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_tarefas`
--
ALTER TABLE `tbl_tarefas`
  MODIFY `id_tarefas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_avaliacoes`
--
ALTER TABLE `tbl_avaliacoes`
  ADD CONSTRAINT `tbl_avaliacoes_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `tbl_animais` (`id_animal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_item_lotes`
--
ALTER TABLE `tbl_item_lotes`
  ADD CONSTRAINT `tbl_item_lotes_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `tbl_lotes` (`id_lote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_item_lotes_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `tbl_animais` (`id_animal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
