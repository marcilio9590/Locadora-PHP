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
/*!40000 ALTER TABLE `tb_clientes` DISABLE KEYS */;
INSERT INTO `tb_clientes` (`cod_cliente`, `nome_cliente`, `telefone_cliente`, `cpf_cliente`, `endereco_cliente`) VALUES
	(1, 'Timoteo', '3433-6337', 1234567890, 'Rua 20, nobre, paulista.'),
	(2, 'Paula Santos', '81 988554226', 1910000000, 'Rua 50');
/*!40000 ALTER TABLE `tb_clientes` ENABLE KEYS */;

-- Copiando estrutura para tabela lanchonetedb.tb_estoque
CREATE TABLE IF NOT EXISTS `tb_estoque` (
  `nome_produto` varchar(100) NOT NULL,
  `preco_produto` decimal(10,2) NOT NULL,
  `data_validade` date DEFAULT NULL,
  `qtd_disponivel` int(11) NOT NULL,
  `cod_produto` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cod_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_estoque: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_estoque` DISABLE KEYS */;
INSERT INTO `tb_estoque` (`nome_produto`, `preco_produto`, `data_validade`, `qtd_disponivel`, `cod_produto`) VALUES
	('X-Tudo', 9.00, '2017-06-04', 10, 1),
	('Antartica', 3.50, '2017-06-06', 23, 2),
	('Fanta', 3.50, '2017-08-10', 20, 3);
/*!40000 ALTER TABLE `tb_estoque` ENABLE KEYS */;

-- Copiando estrutura para tabela lanchonetedb.tb_itens_pedido
CREATE TABLE IF NOT EXISTS `tb_itens_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` int(11) DEFAULT NULL,
  `cod_pedido` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cod_produto` (`cod_produto`),
  KEY `fk_cod_pedido` (`cod_pedido`),
  CONSTRAINT `fk_cod_pedido` FOREIGN KEY (`cod_pedido`) REFERENCES `tb_pedidos` (`cod_pedido`),
  CONSTRAINT `fk_cod_produto` FOREIGN KEY (`cod_produto`) REFERENCES `tb_estoque` (`cod_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;


-- Copiando estrutura para tabela lanchonetedb.tb_mesas
CREATE TABLE IF NOT EXISTS `tb_mesas` (
  `status` varchar(50) NOT NULL,
  `cod_mesa` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cod_mesa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_mesas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_mesas` DISABLE KEYS */;
INSERT INTO `tb_mesas` (`status`, `cod_mesa`) VALUES
	('Livre', 1),
	('Livre', 2),
	('Livre', 3);
/*!40000 ALTER TABLE `tb_mesas` ENABLE KEYS */;

-- Copiando estrutura para tabela lanchonetedb.tb_pedidos
CREATE TABLE IF NOT EXISTS `tb_pedidos` (
  `cod_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cliente` int(11),
  `total` decimal(10,2) unsigned NOT NULL,
  `data` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `cod_mesa` int(11) NOT NULL,
  PRIMARY KEY (`cod_pedido`),
  KEY `fk_cod_cliente` (`cod_cliente`),
  KEY `fk_cod_mesa` (`cod_mesa`),
  CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `tb_clientes` (`cod_cliente`),
  CONSTRAINT `fk_cod_mesa` FOREIGN KEY (`cod_mesa`) REFERENCES `tb_mesas` (`cod_mesa`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela lanchonetedb.tb_users: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` (`nome_user`, `cpf_user`, `login_user`, `senha_user`, `perfil_user`, `cod_user`, `qtd_alerta_nivel_estoque`) VALUES
	('admin', '01234567890', 'admin', 'admin', 1, 1, 30),
	('José da Silva', '00191000000', 'jose', 'jose', 2, 2, NULL),
	('Ellen da silva', '01234567890', 'ellen', 'ellen', 1, 4, NULL);

