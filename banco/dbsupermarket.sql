-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Out-2024 às 22:29
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbsupermarket`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` char(30) NOT NULL,
  `description` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Massas', 'Produtos de massas frescas e secas'),
(2, 'Produtos Lácteos', 'Produtos lácteos frescos e processados'),
(3, 'Carnes e Aves', 'Carnes frescas e processadas, aves e ovos'),
(4, 'Frutas e Legumes', 'Frutas e legumes frescos e congelados'),
(5, 'Bebidas', 'Bebidas alcoólicas e não alcoólicas'),
(6, 'Pães e Bolos', 'Pães frescos e congelados, bolos e tortas'),
(7, 'Produtos de Limpeza', 'Produtos de limpeza para casa e escritório'),
(8, 'Higiene Pessoal', 'Produtos de higiene pessoal e beleza'),
(9, 'Produtos de Pet', 'Produtos para animais de estimação'),
(10, 'Outros', 'Produtos variados que não se enquadram em outras categorias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `status`) VALUES
(1, 3, 10, 4, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `in_stock`, `image`, `category_id`, `status`) VALUES
(1, 'Macarrão Espaguete', 'Macarrão espaguete fresco, 500g', 5.00, 100, '/supermarket/img/products/macarrao_espaguete.jpg', 1, 'ATIVO'),
(2, 'Leite Integral', 'Leite integral fresco, 1L', 3.00, 50, '/supermarket/img/products/leite_integral.jpeg', 2, 'ATIVO'),
(3, 'Frango', 'Frango grelhado fresco, 1kg', 12.00, 20, '/supermarket/img/products/frango.jpg', 3, 'ATIVO'),
(4, 'Maçã Gala', 'Maçã gala fresca, 1kg', 6.00, 30, '/supermarket/img/products/maca.jpg', 4, 'ATIVO'),
(5, 'Coca-Cola', 'Bebida refrigerante, 2L', 4.00, 50, '/supermarket/img/products/coca_cola.png', 5, 'ATIVO'),
(6, 'Pão Francês', 'Pão francês fresco, 500g', 2.00, 20, '/supermarket/img/products/pao_frances.jpg', 6, 'ATIVO'),
(7, 'Detergente Líquido', 'Detergente líquido para roupa, 1L', 8.00, 10, '/supermarket/img/products/detergente.jpg', 7, 'ATIVO'),
(8, 'Shampoo', 'Shampoo para cabelo, 500ml', 9.00, 15, '/supermarket/img/products/shampoo.jpg', 8, 'ATIVO'),
(9, 'Ração para Cachorro', 'Ração para cachorro, 5kg', 29.00, 5, '/supermarket/img/products/racao_cachorro.jpg', 9, 'ATIVO'),
(10, 'Bolo de Chocolate', 'Bolo de chocolate fresco, 1kg', 19.00, 10, '/supermarket/img/products/bolo_chocolate.jpg', 6, 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` char(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `access_level` int(1) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `status` char(10) NOT NULL DEFAULT 'ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `access_level`, `cpf`, `phone`, `status`) VALUES
(3, 'admin-master', '1234', 'barbosajesse419@gmail.com', 2, '11111111111', '11111111111', 'ATIVO'),
(7, 'José', '1234', 'jose@gmail.com', 1, '11111111111', '11111111111', 'ATIVO');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_categories` (`category_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
