-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Maio-2017 às 05:29
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.21


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lanchonetedb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `cod_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `telefone_cliente` varchar(20) NOT NULL,
  `cpf_cliente` bigint(20) NOT NULL,
  `endereco_cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`cod_cliente`, `nome_cliente`, `telefone_cliente`, `cpf_cliente`, `endereco_cliente`) VALUES
(1, 'Timoteo', '3433-6337', 1234567890, 'Rua 20, nobre, paulista.'),
(2, 'Paula Santos', '81 988554226', 1910000000, 'Rua 50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estoque`
--

CREATE TABLE `tb_estoque` (
  `nome_produto` varchar(100) DEFAULT NULL,
  `preco_produto` decimal(10,2) DEFAULT NULL,
  `data_validade` date NOT NULL,
  `qtd_disponivel` int(11) DEFAULT NULL,
  `cod_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_estoque`
--

INSERT INTO `tb_estoque` (`nome_produto`, `preco_produto`, `data_validade`, `qtd_disponivel`, `cod_produto`) VALUES
('X-Tudo', '9.00', '2017-05-21', 10, 1),
('Antartica', '3.50', '2017-06-06', 23, 2),
('Fanta', '3.50', '2017-08-10', 20, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_itens_pedido`
--

CREATE TABLE `tb_itens_pedido` (
  `id` int(11) NOT NULL,
  `cod_produto` int(11) DEFAULT NULL,
  `cod_pedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_itens_pedido`
--

INSERT INTO `tb_itens_pedido` (`id`, `cod_produto`, `cod_pedido`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mesas`
--

CREATE TABLE `tb_mesas` (
	`status` VARCHAR(50) NOT NULL,
	`cod_mesa` INT(11) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`cod_mesa`)
);


--
-- Extraindo dados da tabela `tb_mesas`
--

INSERT INTO `tb_mesas` (`status`, `cod_mesa`) VALUES
( '1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedidos`
--

CREATE TABLE `tb_pedidos` (
	`cod_pedido` INT(11) NOT NULL,
	`cod_cliente` INT(11) NULL,
	`total` DECIMAL(10,2) UNSIGNED NOT NULL,
	`data` DATE NULL DEFAULT NULL,
	`status` INT(11) NOT NULL,
	`cod_mesa` INT(11) NOT NULL,
	PRIMARY KEY (`cod_pedido`),
	INDEX `fk_cod_cliente` (`cod_cliente`),
	INDEX `fk_cod_mesa` (`cod_mesa`),
	CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `tb_clientes` (`cod_cliente`),
	CONSTRAINT `fk_cod_mesa` FOREIGN KEY (`cod_mesa`) REFERENCES `tb_mesas` (`cod_mesa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_pedidos`
--

INSERT INTO `tb_pedidos` (`cod_pedido`, `cod_cliente`, `total`, `data`, `status`, `cod_mesa`) VALUES
(1, 1, '9.00', '2017-05-20', 3, 1),
(2, 2, '12.00', '2017-05-21', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `nome_user` varchar(100) DEFAULT NULL,
  `cpf_user` varchar(50) NOT NULL,
  `login_user` varchar(50) DEFAULT NULL,
  `senha_user` varchar(50) DEFAULT NULL,
  `perfil_user` int(11) DEFAULT NULL,
  `cod_user` int(11) NOT NULL,
  `qtd_alerta_nivel_estoque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_users`
--

INSERT INTO `tb_users` (`nome_user`, `cpf_user`, `login_user`, `senha_user`, `perfil_user`, `cod_user`, `qtd_alerta_nivel_estoque`) VALUES
('admin', '01234567890', 'admin', 'admin', 1, 1, 10),
('José da Silva', '00191000000', 'jose', 'jose', 2, 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indexes for table `tb_estoque`
--
ALTER TABLE `tb_estoque`
  ADD PRIMARY KEY (`cod_produto`);

--
-- Indexes for table `tb_itens_pedido`
--
ALTER TABLE `tb_itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cod_produto` (`cod_produto`),
  ADD KEY `fk_cod_pedido` (`cod_pedido`);

--
-- Indexes for table `tb_mesas`
--
ALTER TABLE `tb_mesas`
  ADD PRIMARY KEY (`cod_mesa`);

--
-- Indexes for table `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD PRIMARY KEY (`cod_pedido`),
  ADD KEY `fk_cod_cliente` (`cod_cliente`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`cod_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_estoque`
--
ALTER TABLE `tb_estoque`
  MODIFY `cod_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_itens_pedido`
--
ALTER TABLE `tb_itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_mesas`
--
ALTER TABLE `tb_mesas`
  MODIFY `cod_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `cod_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_itens_pedido`
--
ALTER TABLE `tb_itens_pedido`
  ADD CONSTRAINT `fk_cod_pedido` FOREIGN KEY (`cod_pedido`) REFERENCES `tb_pedidos` (`cod_pedido`),
  ADD CONSTRAINT `fk_cod_produto` FOREIGN KEY (`cod_produto`) REFERENCES `tb_estoque` (`cod_produto`);

--
-- Limitadores para a tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `tb_clientes` (`cod_cliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
