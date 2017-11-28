-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Nov-2017 às 00:12
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.9

create database locadora;

--
-- Database: `locadora`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `cod_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `ddd` varchar(10) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes`
--

CREATE TABLE `filmes` (
  `cod_filme` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filmes`
--

INSERT INTO `filmes` (`cod_filme`, `nome`, `genero`, `status`, `preco`) VALUES
(1, 'Lagoa Azul', 'Romance', 1, '3.50'),
(2, 'Lagoa Azul 2', 'Romance', 1, '3.00'),
(4, 'adsfasdf', 'asdfasdf', 1, '2.00'),
(5, 'teste', 'asdfasdf', 1, '5.00'),
(6, 'asdfasdf', 'asdfasdf', 1, '3.00'),
(7, 'testando', 'asdasd', 1, '2.00'),
(8, 'asdfasdf', 'asdfasdf', 1, '2.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `cod_funcionario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `rg` varchar(10) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `data_admissao` varchar(10) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`cod_funcionario`, `nome`, `rua`, `cep`, `bairro`, `cidade`, `cpf`, `rg`, `sexo`, `data_admissao`, `telefone`) VALUES
(1, 'Funcionario 1', '321321', '321321321', '321321', '321321', '321321', '321321', '321321', '28/11/2017', '321321');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_locacao`
--

CREATE TABLE `itens_locacao` (
  `codigo` int(11) NOT NULL,
  `cod_filme` int(11) NOT NULL,
  `cod_locacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacoes`
--

CREATE TABLE `locacoes` (
  `cod_locacao` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_funcionario` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indexes for table `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`cod_filme`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`cod_funcionario`);

--
-- Indexes for table `itens_locacao`
--
ALTER TABLE `itens_locacao`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `cod_locacao` (`cod_locacao`),
  ADD KEY `cod_filme` (`cod_filme`);

--
-- Indexes for table `locacoes`
--
ALTER TABLE `locacoes`
  ADD PRIMARY KEY (`cod_locacao`),
  ADD KEY `cod_cliente` (`cod_cliente`),
  ADD KEY `cod_funcionario` (`cod_funcionario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filmes`
--
ALTER TABLE `filmes`
  MODIFY `cod_filme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `cod_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `itens_locacao`
--
ALTER TABLE `itens_locacao`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locacoes`
--
ALTER TABLE `locacoes`
  MODIFY `cod_locacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `itens_locacao`
--
ALTER TABLE `itens_locacao`
  ADD CONSTRAINT `cod_filme` FOREIGN KEY (`cod_filme`) REFERENCES `filmes` (`cod_filme`),
  ADD CONSTRAINT `cod_locacao` FOREIGN KEY (`cod_locacao`) REFERENCES `locacoes` (`cod_locacao`);

--
-- Limitadores para a tabela `locacoes`
--
ALTER TABLE `locacoes`
  ADD CONSTRAINT `cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`),
  ADD CONSTRAINT `cod_funcionario` FOREIGN KEY (`cod_funcionario`) REFERENCES `funcionarios` (`cod_funcionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
