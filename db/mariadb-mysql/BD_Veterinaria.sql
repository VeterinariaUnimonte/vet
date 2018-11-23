-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23-Nov-2018 às 23:42
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_veterinaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_agendamento`
--

CREATE TABLE `tab_agendamento` (
  `COD_AGENDAMENTO` int(13) NOT NULL,
  `COD_PROCEDIMENTO` int(13) NOT NULL,
  `COD_FUNCIONARIO` int(13) NOT NULL,
  `COD_CLIENTE` int(13) NOT NULL,
  `DATA` date NOT NULL,
  `HORA` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tab_agendamento`
--

INSERT INTO `tab_agendamento` (`COD_AGENDAMENTO`, `COD_PROCEDIMENTO`, `COD_FUNCIONARIO`, `COD_CLIENTE`, `DATA`, `HORA`) VALUES
(17, 1, 11, 20, '2018-11-23', '14:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_cliente`
--

CREATE TABLE `tab_cliente` (
  `COD_CLIENTE` int(13) NOT NULL,
  `NOME_CLIENTE` varchar(200) NOT NULL,
  `CPF` varchar(30) NOT NULL,
  `RG` varchar(30) NOT NULL,
  `CEP` varchar(30) NOT NULL,
  `ENDERECO` varchar(100) NOT NULL,
  `BAIRRO` varchar(100) NOT NULL,
  `CIDADE` varchar(100) NOT NULL,
  `UF` varchar(50) NOT NULL,
  `TELEFONE` varchar(30) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tab_cliente`
--

INSERT INTO `tab_cliente` (`COD_CLIENTE`, `NOME_CLIENTE`, `CPF`, `RG`, `CEP`, `ENDERECO`, `BAIRRO`, `CIDADE`, `UF`, `TELEFONE`, `EMAIL`, `CADASTRO`) VALUES
(19, 'João Victor Nunes dos Santos', '453.453.453-45', '43.423.423-4', '11451-320', 'Avenida Luís Gama 513', 'Sítio Paecara (Vicente de Carvalho)', 'Guarujá', 'SP', '(13) 99799-2234', 'jvnsantos@outlook.com', '2018-11-18 19:00:26'),
(20, 'Victor Silverio de Souza Junior', '469.884.798-21', '54.011.011-5', '11075-410', 'Rua Pará 02', 'Campo Grande', 'Santos', 'SP', '(13) 99648-7140', 'vsilverio97@gmail.com', '2018-11-23 22:28:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_disponibilidade`
--

CREATE TABLE `tab_disponibilidade` (
  `COD_DISPONIBILIDADE` int(13) NOT NULL,
  `COD_FUNCIONARIO` int(13) NOT NULL,
  `DIAS_SEMANA` varchar(20) NOT NULL,
  `HORARIOS` varchar(50) NOT NULL,
  `DURACAO` int(3) NOT NULL,
  `ATENDER_FERIADOS` int(1) NOT NULL,
  `EXCECOES` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tab_disponibilidade`
--

INSERT INTO `tab_disponibilidade` (`COD_DISPONIBILIDADE`, `COD_FUNCIONARIO`, `DIAS_SEMANA`, `HORARIOS`, `DURACAO`, `ATENDER_FERIADOS`, `EXCECOES`) VALUES
(3, 11, '1, 2, 3, 4, 5', '09:00-12:00, 13:00-17:00', 60, 0, '05/08/2018, 07/12/2018'),
(4, 12, '1, 2, 3, 4, 5', '08:00-12:00, 13:00-17:00', 30, 0, '12/09/2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_especialidade`
--

CREATE TABLE `tab_especialidade` (
  `COD_ESPECIALIDADE` int(13) NOT NULL,
  `DESCRICAO` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tab_especialidade`
--

INSERT INTO `tab_especialidade` (`COD_ESPECIALIDADE`, `DESCRICAO`) VALUES
(1, 'Veterinário'),
(2, 'Veterinário Cirurgião');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_funcionario`
--

CREATE TABLE `tab_funcionario` (
  `COD_FUNCIONARIO` int(13) NOT NULL,
  `COD_ESPECIALIDADE` int(13) NOT NULL,
  `NOME_FUNCIONARIO` varchar(100) NOT NULL,
  `CPF` varchar(30) NOT NULL,
  `RG` varchar(30) NOT NULL,
  `TELEFONE` varchar(30) NOT NULL,
  `TIPO` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `CADASTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tab_funcionario`
--

INSERT INTO `tab_funcionario` (`COD_FUNCIONARIO`, `COD_ESPECIALIDADE`, `NOME_FUNCIONARIO`, `CPF`, `RG`, `TELEFONE`, `TIPO`, `EMAIL`, `CADASTRO`) VALUES
(11, 2, 'Valéria', '462.738.951-87', '52.345.559-9', '(13) 98154-6472', 'Cirurgião Gastro', 'valeria_vet@unimonte.br', '2018-11-20 20:11:01'),
(12, 1, 'Valdir Santos Junior', '234.765.439-81', '48.765.893-4', '(13) 99854-6635', 'Clinico Geral', 'valdir_vet@unimonte.br', '2018-11-20 20:12:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_pet`
--

CREATE TABLE `tab_pet` (
  `COD_PET` int(13) NOT NULL,
  `COD_CLIENTE` int(13) NOT NULL,
  `NOME_PET` varchar(100) NOT NULL,
  `IDADE` decimal(4,2) NOT NULL,
  `SEXO` varchar(1) NOT NULL,
  `TIPO` varchar(50) NOT NULL,
  `PELAGEM` varchar(50) NOT NULL,
  `RACA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tab_pet`
--

INSERT INTO `tab_pet` (`COD_PET`, `COD_CLIENTE`, `NOME_PET`, `IDADE`, `SEXO`, `TIPO`, `PELAGEM`, `RACA`) VALUES
(35, 20, 'Amumu', '0.07', 'm', 'Cachorro', 'Branco', 'Golden Retriever'),
(36, 19, 'Catucha', '7.00', 'f', 'Cachorro', 'Preto', 'Labrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_procedimento`
--

CREATE TABLE `tab_procedimento` (
  `COD_PROCEDIMENTO` int(13) NOT NULL,
  `COD_TIPO_PROCEDIMENTO` int(13) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL,
  `JEJUM` varchar(3) NOT NULL,
  `VALOR_PROCEDIMENTO` decimal(12,2) NOT NULL,
  `OBSERVACAO` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tab_procedimento`
--

INSERT INTO `tab_procedimento` (`COD_PROCEDIMENTO`, `COD_TIPO_PROCEDIMENTO`, `DESCRICAO`, `JEJUM`, `VALOR_PROCEDIMENTO`, `OBSERVACAO`) VALUES
(1, 1, 'Raio-x', 'Sim', '80.00', 'Exame de imagem raio-x.'),
(9, 2, 'Gastro Intestnal', 'Sim', '250.00', 'Cirurgia gastro intestinal.'),
(10, 3, 'Geral', 'Não', '80.00', 'Consulta geral.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_tipo_procedimento`
--

CREATE TABLE `tab_tipo_procedimento` (
  `COD_TIPO_PROCEDIMENTO` int(13) NOT NULL,
  `DESCRICAO` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tab_tipo_procedimento`
--

INSERT INTO `tab_tipo_procedimento` (`COD_TIPO_PROCEDIMENTO`, `DESCRICAO`) VALUES
(1, 'Imagem'),
(2, 'Cirurgia'),
(3, 'Consulta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_agendamento`
--
ALTER TABLE `tab_agendamento`
  ADD PRIMARY KEY (`COD_AGENDAMENTO`),
  ADD UNIQUE KEY `PK_AGENDAMENTO` (`COD_AGENDAMENTO`),
  ADD KEY `FK_AGENDAMENTO_COD_PROCEDIMENTO` (`COD_PROCEDIMENTO`),
  ADD KEY `FK_AGENDAMENTO_COD_FUNCIONARIO` (`COD_FUNCIONARIO`),
  ADD KEY `FK_AGENDAMENTO_COD_CLIENTE` (`COD_CLIENTE`);

--
-- Indexes for table `tab_cliente`
--
ALTER TABLE `tab_cliente`
  ADD PRIMARY KEY (`COD_CLIENTE`),
  ADD UNIQUE KEY `PK_CLIENTE` (`COD_CLIENTE`);

--
-- Indexes for table `tab_disponibilidade`
--
ALTER TABLE `tab_disponibilidade`
  ADD PRIMARY KEY (`COD_DISPONIBILIDADE`),
  ADD UNIQUE KEY `PK_DISPONIBILIDADE` (`COD_DISPONIBILIDADE`),
  ADD KEY `FK_DISPONIBILIDADE_COD_FUNCIONARIO` (`COD_FUNCIONARIO`);

--
-- Indexes for table `tab_especialidade`
--
ALTER TABLE `tab_especialidade`
  ADD PRIMARY KEY (`COD_ESPECIALIDADE`),
  ADD UNIQUE KEY `PK_ESPECIALIDADE` (`COD_ESPECIALIDADE`);

--
-- Indexes for table `tab_funcionario`
--
ALTER TABLE `tab_funcionario`
  ADD PRIMARY KEY (`COD_FUNCIONARIO`),
  ADD UNIQUE KEY `PK_FUNCIONARIO` (`COD_FUNCIONARIO`),
  ADD KEY `FK_FUNCIONARIO_COD_ESPECIALIDADE` (`COD_ESPECIALIDADE`);

--
-- Indexes for table `tab_pet`
--
ALTER TABLE `tab_pet`
  ADD PRIMARY KEY (`COD_PET`),
  ADD UNIQUE KEY `PK_PET` (`COD_PET`),
  ADD KEY `FK_PET_COD_CLIENTE` (`COD_CLIENTE`);

--
-- Indexes for table `tab_procedimento`
--
ALTER TABLE `tab_procedimento`
  ADD PRIMARY KEY (`COD_PROCEDIMENTO`),
  ADD UNIQUE KEY `PK_PROCEDIMENTO` (`COD_PROCEDIMENTO`),
  ADD KEY `FK_PROCEDIMENTO_COD_TIPO_PROCEDIMENTO` (`COD_TIPO_PROCEDIMENTO`);

--
-- Indexes for table `tab_tipo_procedimento`
--
ALTER TABLE `tab_tipo_procedimento`
  ADD PRIMARY KEY (`COD_TIPO_PROCEDIMENTO`),
  ADD UNIQUE KEY `PK_TIPO_PROCEDIMENTO` (`COD_TIPO_PROCEDIMENTO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_agendamento`
--
ALTER TABLE `tab_agendamento`
  MODIFY `COD_AGENDAMENTO` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tab_cliente`
--
ALTER TABLE `tab_cliente`
  MODIFY `COD_CLIENTE` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tab_disponibilidade`
--
ALTER TABLE `tab_disponibilidade`
  MODIFY `COD_DISPONIBILIDADE` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tab_especialidade`
--
ALTER TABLE `tab_especialidade`
  MODIFY `COD_ESPECIALIDADE` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tab_funcionario`
--
ALTER TABLE `tab_funcionario`
  MODIFY `COD_FUNCIONARIO` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tab_pet`
--
ALTER TABLE `tab_pet`
  MODIFY `COD_PET` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tab_procedimento`
--
ALTER TABLE `tab_procedimento`
  MODIFY `COD_PROCEDIMENTO` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tab_tipo_procedimento`
--
ALTER TABLE `tab_tipo_procedimento`
  MODIFY `COD_TIPO_PROCEDIMENTO` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tab_agendamento`
--
ALTER TABLE `tab_agendamento`
  ADD CONSTRAINT `FK_AGENDAMENTO_COD_CLIENTE` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `tab_cliente` (`COD_CLIENTE`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_AGENDAMENTO_COD_FUNCIONARIO` FOREIGN KEY (`COD_FUNCIONARIO`) REFERENCES `tab_funcionario` (`COD_FUNCIONARIO`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_AGENDAMENTO_COD_PROCEDIMENTO` FOREIGN KEY (`COD_PROCEDIMENTO`) REFERENCES `tab_procedimento` (`COD_PROCEDIMENTO`) ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_disponibilidade`
--
ALTER TABLE `tab_disponibilidade`
  ADD CONSTRAINT `FK_DISPONIBILIDADE_COD_FUNCIONARIO` FOREIGN KEY (`COD_FUNCIONARIO`) REFERENCES `tab_funcionario` (`COD_FUNCIONARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_funcionario`
--
ALTER TABLE `tab_funcionario`
  ADD CONSTRAINT `FK_FUNCIONARIO_COD_ESPECIALIDADE` FOREIGN KEY (`COD_ESPECIALIDADE`) REFERENCES `tab_especialidade` (`COD_ESPECIALIDADE`) ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_pet`
--
ALTER TABLE `tab_pet`
  ADD CONSTRAINT `FK_PET_COD_CLIENTE` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `tab_cliente` (`COD_CLIENTE`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tab_procedimento`
--
ALTER TABLE `tab_procedimento`
  ADD CONSTRAINT `FK_PROCEDIMENTO_COD_TIPO_PROCEDIMENTO` FOREIGN KEY (`COD_TIPO_PROCEDIMENTO`) REFERENCES `tab_tipo_procedimento` (`COD_TIPO_PROCEDIMENTO`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
