-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Out-2020 às 16:57
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetoteste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `renda` decimal(10,2) DEFAULT NULL,
  `credito` decimal(10,2) DEFAULT NULL,
  `fk_idpessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idcliente`, `renda`, `credito`, `fk_idpessoa`) VALUES
(1, '3000.00', '2000.00', 21),
(2, '1500.00', '500.00', 32),
(3, '2300.00', '400.00', 31),
(4, '1700.00', '600.00', 34),
(5, '2000.00', '900.00', 15),
(6, '1000.00', '200.00', 36),
(7, '1040.00', '100.00', 17),
(8, '2600.00', '400.00', 38),
(9, '1800.00', '700.00', 39),
(10, '2500.00', '300.00', 40),
(17, '2000.00', '0.00', 90);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idpedidos` int(11) NOT NULL,
  `data_pedido` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status_pedido` tinytext DEFAULT NULL,
  `fk_idcliente` int(11) NOT NULL,
  `fk_idvendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idpedidos`, `data_pedido`, `valor`, `status_pedido`, `fk_idcliente`, `fk_idvendedor`) VALUES
(7, '2020-04-17', '3.00', 'A', 2, 3),
(8, '2020-05-10', '4.00', 'I', 1, 3),
(9, '2020-06-15', '1.00', 'A', 4, 2),
(10, '2020-07-07', '2.00', 'I', 2, 3),
(11, '2020-08-27', '7.00', 'A', 2, 1),
(32, '2020-10-26', '200.00', 'CO', 17, NULL),
(33, '2020-10-27', '50.00', 'CO', 17, NULL),
(34, '2020-10-27', '60.00', 'CO', 17, NULL),
(35, '2020-10-27', '150.00', 'CO', 17, NULL),
(36, '2020-10-27', '200.00', 'CO', 17, NULL),
(37, '0000-00-00', '0.00', 'EE', 17, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

CREATE TABLE `pedidos_produtos` (
  `fk_pedidos_idpedidos` int(11) NOT NULL,
  `fk_produtos_idprodutos` int(11) NOT NULL,
  `qtde` int(11) DEFAULT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`fk_pedidos_idpedidos`, `fk_produtos_idprodutos`, `qtde`, `valor`) VALUES
(2, 4, 5, '50'),
(2, 2, 3, '100'),
(2, 1, 1, '10'),
(1, 4, 5, '50'),
(1, 5, 2, '1000'),
(22, 6, 1, '40'),
(23, 6, 5, '200'),
(32, 6, 5, '200'),
(33, 1, 5, '50'),
(34, 2, 2, '60'),
(35, 2, 5, '150'),
(36, 3, 10, '200');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `idpessoas` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `cpf` int(11) DEFAULT NULL,
  `status_pessoas` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`idpessoas`, `nome`, `cpf`, `status_pessoas`) VALUES
(1, 'rodrigo selan', 2147483647, 'A'),
(2, 'Mano Okada', 2147483647, 'A'),
(3, 'Crabs sauro', 2147483647, 'A'),
(4, 'Fafa de belem', 2147483647, 'A'),
(5, 'Jhony do putzz', 2147483647, 'A'),
(6, 'pedro', 2147483647, 'A'),
(7, 'henrique', 2147483647, 'A'),
(8, 'felipe', 2147483647, 'I'),
(9, 'joão', 2147483647, 'A'),
(10, 'lucas', 2147483647, 'A'),
(11, 'rodrigo selan', 2147483647, 'A'),
(12, 'Mano Okada', 2147483647, 'A'),
(13, 'Crabs sauro', 2147483647, 'A'),
(14, 'Fafa de belem', 2147483647, 'A'),
(15, 'Jhony do putzz', 2147483647, 'A'),
(16, 'pedro', 2147483647, 'A'),
(17, 'henrique', 2147483647, 'A'),
(18, 'felipe', 2147483647, 'I'),
(19, 'joão', 2147483647, 'A'),
(20, 'lucas', 2147483647, 'A'),
(21, 'rodrigo selan', 1999999999, 'A'),
(22, 'Mano Okada', 2147483647, 'A'),
(23, 'Crabs sauro', 2147483647, 'A'),
(24, 'Fafa de belem', 2147483647, 'A'),
(25, 'Jhony do putzz', 1234567891, 'A'),
(26, 'pedro', 1111111111, 'A'),
(27, 'henrique', 1111111111, 'A'),
(28, 'felipe', 2111111111, 'I'),
(29, 'joão', 1111111112, 'A'),
(30, 'lucas', 1111111111, 'A'),
(31, 'rodrigo selan', 1999999999, 'A'),
(32, 'Mano Okada', 2147483647, 'A'),
(33, 'Crabs sauro', 2147483647, 'A'),
(34, 'Fafa de belem', 2147483647, 'A'),
(35, 'Jhony do putzz', 1234567891, 'A'),
(36, 'pedro', 111111111, 'A'),
(37, 'henrique', 111111111, 'A'),
(38, 'felipe', 111111111, 'I'),
(39, 'joão', 111111112, 'A'),
(40, 'lucas', 111111111, 'A'),
(41, 'rodrigo selan', 1999999999, 'A'),
(42, 'Mano Okada', 2147483647, 'A'),
(43, 'Crabs sauro', 2147483647, 'A'),
(44, 'Fafa de belem', 2147483647, 'A'),
(45, 'Jhony do putzz', 1234567891, 'A'),
(46, 'pedro', 111111111, 'A'),
(47, 'henrique', 111111111, 'A'),
(48, 'felipe', 111111111, 'I'),
(49, 'joão', 111111112, 'A'),
(50, 'lucas', 111111111, 'A'),
(51, 'rodrigo selan', 1999999999, 'A'),
(52, 'Mano Okada', 789880889, 'A'),
(53, 'Crabs sauro', 987886780, 'A'),
(54, 'Fafa de belem', 789456123, 'A'),
(55, 'Jhony do putzz', 1234567891, 'A'),
(56, 'pedro', 111111111, 'A'),
(57, 'henrique', 111111111, 'A'),
(58, 'felipe', 111111111, 'I'),
(59, 'joão', 111111112, 'A'),
(60, 'lucas', 111111111, 'A'),
(61, 'rodrigo selan', 1999999999, 'A'),
(62, 'Mano Okada', 789880889, 'A'),
(63, 'Crabs sauro', 987886780, 'A'),
(64, 'Fafa de belem', 789456123, 'A'),
(65, 'Jhony do putzz', 1234567891, 'A'),
(66, 'pedro', 111111111, 'A'),
(67, 'henrique', 111111111, 'A'),
(68, 'felipe', 111111111, 'I'),
(69, 'joão', 111111112, 'A'),
(70, 'lucas', 111111111, 'A'),
(71, 'rodrigo selan', 1999999999, 'A'),
(72, 'Mano Okada', 789880889, 'A'),
(73, 'Crabs sauro', 987886780, 'A'),
(74, 'Fafa de belem', 789456123, 'A'),
(75, 'Jhony do putzz', 1234567891, 'A'),
(76, 'pedro', 111111111, 'A'),
(77, 'henrique', 111111111, 'A'),
(78, 'felipe', 111111111, 'I'),
(79, 'joão', 111111112, 'A'),
(80, 'lucas', 111111111, 'A'),
(84, 'zanji', 2, 'A'),
(85, 'seiji', 3, 'A'),
(90, 'Gustavo', 1, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idprodutos` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `estoque` int(11) NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `status_produto` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idprodutos`, `descricao`, `estoque`, `valor`, `status_produto`) VALUES
(1, 'colher', 95, '10.00', 'A'),
(2, 'sopa', 993, '30.00', 'A'),
(3, 'toddy', 490, '20.00', 'A'),
(4, 'pão integral', 8, '10.00', 'A'),
(5, 'celular', 192, '1000.00', 'A'),
(6, 'mussarela', 278, '40.00', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `fk_idpessoas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `login`, `senha`, `tipo`, `fk_idpessoas`) VALUES
(2, 'teste1', 'teste1', 'gerente', 84),
(3, 'teste2', 'teste2', 'vendedor', 85),
(7, 'teste', 'teste', 'cliente', 90);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--

CREATE TABLE `vendedores` (
  `idvendedor` int(11) NOT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `fk_idpessoas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendedores`
--

INSERT INTO `vendedores` (`idvendedor`, `salario`, `fk_idpessoas`) VALUES
(1, '2400.00', 1),
(2, '1534.00', 3),
(3, '524241.00', 5),
(4, '74733.00', 4),
(5, '1233.00', 8),
(6, '754.00', 2),
(7, '1899.00', 6),
(8, '543732.00', 7),
(9, '21332.00', 9),
(10, '500.00', 10),
(11, '10000.00', 84),
(12, '7000.00', 85);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `fk_idpessoa` (`fk_idpessoa`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedidos`),
  ADD KEY `fk_idcliente` (`fk_idcliente`),
  ADD KEY `fk_idvendedor` (`fk_idvendedor`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`idpessoas`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idprodutos`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD KEY `fk_idpessoas` (`fk_idpessoas`);

--
-- Índices para tabela `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`idvendedor`),
  ADD KEY `fk_idpessoas` (`fk_idpessoas`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `idpessoas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idprodutos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `idvendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`fk_idpessoa`) REFERENCES `pessoas` (`idpessoas`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`fk_idcliente`) REFERENCES `clientes` (`idcliente`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`fk_idvendedor`) REFERENCES `vendedores` (`idvendedor`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`fk_idpessoas`) REFERENCES `pessoas` (`idpessoas`);

--
-- Limitadores para a tabela `vendedores`
--
ALTER TABLE `vendedores`
  ADD CONSTRAINT `vendedores_ibfk_1` FOREIGN KEY (`fk_idpessoas`) REFERENCES `pessoas` (`idpessoas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
