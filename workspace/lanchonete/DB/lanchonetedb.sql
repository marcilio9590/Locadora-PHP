-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para lanchonetedb
CREATE DATABASE IF NOT EXISTS `lanchonetedb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lanchonetedb`;

-- Copiando estrutura para tabela lanchonetedb.tb_clientes
CREATE TABLE IF NOT EXISTS `tb_clientes` (
  `cod_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(100) NOT NULL,
  `telefone_cliente` varchar(20) NOT NULL,
  `cpf_cliente` bigint(20) NOT NULL,
  `endereco_cliente` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_clientes: ~2 rows (aproximadamente)
ALTER TABLE `tb_clientes` DISABLE KEYS;
INSERT INTO `tb_clientes` (`cod_cliente`, `nome_cliente`, `telefone_cliente`, `cpf_cliente`, `endereco_cliente`) VALUES
	(1, 'Timoteo', '3433-6337', 1234567890, 'Rua 20, nobre, paulista.'),
	(2, 'Paula Santos', '81 988554226', 1910000000, 'Rua 50');
ALTER TABLE `tb_clientes` ENABLE KEY;

-- Copiando estrutura para tabela lanchonetedb.tb_estoque
CREATE TABLE IF NOT EXISTS `tb_estoque` (
  `nome_produto` varchar(100) DEFAULT NULL,
  `preco_produto` decimal(10,2) DEFAULT NULL,
  `data_validade` date NOT NULL,
  `qtd_disponivel` int(11) DEFAULT NULL,
  `cod_produto` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cod_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_estoque: ~3 rows (aproximadamente)
ALTER TABLE `tb_estoque` DISABLE KEYS;
INSERT INTO `tb_estoque` (`nome_produto`, `preco_produto`, `data_validade`, `qtd_disponivel`, `cod_produto`) VALUES
	('X-Tudo', 9.00, '2017-05-21', 10, 1),
	('Antartica', 3.50, '2017-06-06', 23, 2),
	('Fanta', 3.50, '2017-08-10', 20, 3);
ALTER TABLE `tb_estoque` ENABLE KEYS;

-- Copiando estrutura para tabela lanchonetedb.tb_mesas
CREATE TABLE IF NOT EXISTS `tb_mesas` (
  `numero_mesa` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `cod_mesa` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cod_mesa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_mesas: ~0 rows (aproximadamente)
ALTER TABLE `tb_mesas` DISABLE KEYS;
INSERT INTO `tb_mesas` (`numero_mesa`, `status`, `cod_mesa`) VALUES
	(1, '1', 1);
 ALTER TABLE `tb_mesas` ENABLE KEYS;

-- Copiando estrutura para tabela lanchonetedb.tb_pedidos
CREATE TABLE IF NOT EXISTS `tb_pedidos` (
  `cod_pedido` int(11) NOT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  `total` decimal(10,2) unsigned DEFAULT NULL,
  `data` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`cod_pedido`),
  KEY `fk_cod_cliente` (`cod_cliente`),
  CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `tb_clientes` (`cod_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_pedidos: ~2 rows (aproximadamente)
 ALTER TABLE `tb_pedidos` DISABLE KEYS;
INSERT INTO `tb_pedidos` (`cod_pedido`, `cod_cliente`, `total`, `data`, `status`) VALUES
	(1, 1, 9.00, '2017-05-20', 3),
	(2, 2, 12.00, '2017-05-21', 3);
 ALTER TABLE `tb_pedidos` ENABLE KEYS;

-- Copiando estrutura para tabela lanchonetedb.tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `nome_user` varchar(100) DEFAULT NULL,
  `cpf_user` varchar(50) NOT NULL,
  `login_user` varchar(50) DEFAULT NULL,
  `senha_user` varchar(50) DEFAULT NULL,
  `perfil_user` int(11) DEFAULT NULL,
  `cod_user` int(11) NOT NULL AUTO_INCREMENT,
  `qtd_alerta_nivel_estoque` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_users: ~2 rows (aproximadamente)
ALTER TABLE `tb_users` DISABLE KEYS ;
INSERT INTO `tb_users` (`nome_user`, `cpf_user`, `login_user`, `senha_user`, `perfil_user`, `cod_user`, `qtd_alerta_nivel_estoque`) VALUES
	('admin', '01234567890', 'admin', 'admin', 1, 1, NULL),
	('José da Silva', '00191000000', 'jose', 'jose', 2, 2, NULL);
ALTER TABLE `tb_users` ENABLE KEYS;

-- Copiando estrutura para tabela lanchonetedb.tb_itens_pedido
CREATE TABLE IF NOT EXISTS `tb_itens_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` int(11) DEFAULT NULL,
  `cod_pedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cod_produto` (`cod_produto`),
  KEY `fk_cod_pedido` (`cod_pedido`),
  CONSTRAINT `fk_cod_pedido` FOREIGN KEY (`cod_pedido`) REFERENCES `tb_pedidos` (`cod_pedido`),
  CONSTRAINT `fk_cod_produto` FOREIGN KEY (`cod_produto`) REFERENCES `tb_estoque` (`cod_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_itens_pedido: ~3 rows (aproximadamente)
ALTER TABLE `tb_itens_pedido` DISABLE KEYS;
INSERT INTO `tb_itens_pedido` (`id`, `cod_produto`, `cod_pedido`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 2);
ALTER TABLE `tb_itens_pedido` ENABLE KEYS;
