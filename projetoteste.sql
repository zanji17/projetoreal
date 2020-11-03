-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Nov-2020 às 16:18
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
(17, '2000.00', '0.00', 90),
(18, '1200.00', '0.00', 92),
(19, '1999.00', '0.00', 93);

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
(32, '2020-10-28', '200.00', 'OK', 17, 11),
(33, '2020-10-29', '50.00', 'OK', 17, 11),
(34, '2020-10-31', '60.00', 'OK', 17, 11),
(35, '2020-10-27', '150.00', 'CO', 17, NULL),
(36, '2020-10-27', '200.00', 'CO', 17, NULL),
(37, '2020-10-29', '60.00', 'CO', 17, NULL),
(38, '2020-10-29', '30.00', 'CO', 17, NULL),
(39, '2020-10-29', '10.00', 'CO', 17, NULL),
(40, '2020-10-29', '1065.00', 'CO', 17, NULL),
(46, '0000-00-00', '0.00', 'EE', 17, NULL);

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
(36, 3, 10, '200'),
(37, 3, 3, '60'),
(38, 2, 1, '30'),
(39, 4, 1, '10'),
(40, 1, 1, '5'),
(40, 2, 1, '30'),
(40, 3, 1, '20'),
(40, 4, 1, '10'),
(40, 5, 1, '1000'),
(46, 1, 5, '50');

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
(84, 'Gerente', 2, 'A'),
(85, 'Vendedor1', 3, 'A'),
(90, 'Cliente1', 1, 'A'),
(92, 'felipe', 111111112, 'A'),
(93, 'lucas', 111111111, 'A'),
(94, 'Crabs', 11188899, 'A');

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
(1, 'colher', 94, '10.00', 'A'),
(2, 'sopa', 991, '30.00', 'A'),
(3, 'toddy', 486, '20.00', 'A'),
(4, 'pão integral', 6, '10.00', 'A'),
(5, 'celular', 191, '1000.00', 'A'),
(6, 'mussarela', 278, '40.00', 'A'),
(11, 'soda', 10, '0.00', 'I');

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
(2, 'teste1', 'dGVzdGUx', 'gerente', 84),
(3, 'teste2', 'dGVzdGUy', 'vendedor', 85),
(7, 'teste', 'dGVzdGU=', 'cliente', 90),
(9, 'felipe', 'ZmVsaXBl', 'cliente', 92),
(10, 'lucas', 'bHVjYXM=', 'cliente', 93),
(11, 'crabs', 'Y3JhYnM=', 'gerente', 94);

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
(11, '10000.00', 84),
(12, '7000.00', 85),
(17, '10000.00', 94);

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
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `idpessoas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idprodutos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `idvendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
