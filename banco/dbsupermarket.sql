-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/10/2024 às 23:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
-- Estrutura para tabela `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` char(30) NOT NULL,
  `description` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `categories`
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
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `status`) VALUES
(1, 3, 10, 4, '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
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
-- Despejando dados para a tabela `products`
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
(10, 'Bolo de Chocolate', 'Bolo de chocolate fresco, 1kg', 19.00, 10, '/supermarket/img/products/bolo_chocolate.jpg', 6, 'ATIVO'),
(11, 'Macarrão Penne', 'Macarrão penne seco, 500g', 4.50, 100, '/supermarket/img/products/macarrao_penne.jpeg', 1, 'ATIVO'),
(12, 'Iogurte Natural', 'Iogurte natural, 1L', 6.00, 40, '/supermarket/img/products/iogurte_natural.jpeg', 2, 'ATIVO'),
(13, 'Bife de Alcatra', 'Bife de alcatra fresco, 1kg', 25.00, 15, '/supermarket/img/products/bife_alcatra.jpeg', 3, 'ATIVO'),
(14, 'Banana Prata', 'Banana prata fresca, 1kg', 3.50, 25, '/supermarket/img/products/banana_prata.jpeg', 4, 'ATIVO'),
(15, 'Suco de Laranja', 'Suco de laranja natural, 1L', 7.00, 50, '/supermarket/img/products/suco_laranja.jpg', 5, 'ATIVO'),
(16, 'Bolo de Cenoura', 'Bolo de cenoura fresco, 1kg', 18.00, 10, '/supermarket/img/products/bolo_cenoura.jpeg', 6, 'ATIVO'),
(17, 'Desinfetante', 'Desinfetante multiuso, 1L', 12.00, 20, '/supermarket/img/products/desinfetante.jpg', 7, 'ATIVO'),
(18, 'Condicionador', 'Condicionador para cabelo, 500ml', 10.00, 15, '/supermarket/img/products/condicionador.jpeg', 8, 'ATIVO'),
(19, 'Ração para Gato', 'Ração para gato, 5kg', 35.00, 8, '/supermarket/img/products/racao_gato.jpeg', 9, 'ATIVO'),
(20, 'Geléia de Morango', 'Geléia de morango, 300g', 5.50, 40, '/supermarket/img/products/geleia_morango.png', 10, 'ATIVO'),
(21, 'Fusilli', 'Macarrão fusilli seco, 500g', 4.00, 90, '/supermarket/img/products/fusilli.jpeg', 1, 'ATIVO'),
(22, 'Queijo Prato', 'Queijo prato fatiado, 200g', 10.00, 60, '/supermarket/img/products/queijo_prato.jpeg', 2, 'ATIVO'),
(23, 'Peito de Frango', 'Peito de frango fresco, 1kg', 15.00, 25, '/supermarket/img/products/peito_frango.jpg', 3, 'ATIVO'),
(24, 'Laranja', 'Laranja fresca, 1kg', 5.00, 50, '/supermarket/img/products/laranja.jpeg', 4, 'ATIVO'),
(25, 'Refrigerante Guaraná', 'Refrigerante guaraná, 2L', 4.00, 50, '/supermarket/img/products/refrigerante_guarana.jpeg', 5, 'ATIVO'),
(26, 'Pão de Forma', 'Pão de forma, 500g', 3.00, 30, '/supermarket/img/products/pao_forma.jpeg', 6, 'ATIVO'),
(27, 'Sabão em Pó', 'Sabão em pó, 1kg', 7.00, 20, '/supermarket/img/products/sabao_po.png', 7, 'ATIVO'),
(28, 'Creme Dental', 'Creme dental, 90g', 5.00, 50, '/supermarket/img/products/creme_dental.jpeg', 8, 'ATIVO'),
(29, 'Petisco para Cachorro', 'Petisco para cachorro, 1kg', 22.00, 15, '/supermarket/img/products/petisco_cachorro.jpg', 9, 'ATIVO'),
(30, 'Chocolate ao Leite', 'Chocolate ao leite, 100g', 4.50, 40, '/supermarket/img/products/chocolate_leite.jpg', 10, 'ATIVO'),
(31, 'Pasta de Amendoim', 'Pasta de amendoim, 500g', 12.00, 30, '/supermarket/img/products/pasta_amendoim.jpg', 1, 'ATIVO'),
(32, 'Iogurte Grego', 'Iogurte grego, 150g', 4.00, 50, '/supermarket/img/products/iogurte_grego.jpg', 2, 'ATIVO'),
(33, 'Carne Moída', 'Carne moída, 1kg', 20.00, 20, '/supermarket/img/products/carne_moida.png', 3, 'ATIVO'),
(34, 'Mamão', 'Mamão fresco, 1kg', 4.00, 30, '/supermarket/img/products/mamao.png', 4, 'ATIVO'),
(35, 'Água Mineral', 'Água mineral, 1.5L', 2.00, 100, '/supermarket/img/products/agua_mineral.jpg', 5, 'ATIVO'),
(36, 'Pão Integral', 'Pão integral, 500g', 4.00, 25, '/supermarket/img/products/pao_integral.jpg', 6, 'ATIVO'),
(37, 'Solução para Limpeza', 'Solução de limpeza, 500ml', 6.00, 40, '/supermarket/img/products/solucao_limpeza.jpg', 7, 'ATIVO'),
(38, 'Desodorante', 'Desodorante roll-on, 50ml', 15.00, 20, '/supermarket/img/products/desodorante.jpg', 8, 'ATIVO'),
(39, 'Brinquedo para Cão', 'Brinquedo para cachorro', 10.00, 10, '/supermarket/img/products/brinquedo_cao.jpg', 9, 'ATIVO'),
(40, 'Mistura para Bolo', 'Mistura para bolo de chocolate, 500g', 8.00, 30, '/supermarket/img/products/mistura_bolo.jpg', 10, 'ATIVO'),
(41, 'Salsicha Tipo Hot Dog', 'Salsicha pronta para o consumo, 500g', 10.00, 30, '/supermarket/img/products/salsicha.jpg', 3, 'ATIVO'),
(42, 'Azeite de Oliva Extra Virgem', 'Azeite de oliva extra virgem, 500ml', 25.00, 40, '/supermarket/img/products/azeite_oliva.jpg', 10, 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
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
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `access_level`, `cpf`, `phone`, `status`) VALUES
(3, 'admin-master', '1234', 'barbosajesse419@gmail.com', 2, '11111111111', '11111111111', 'ATIVO'),
(7, 'José', '1234', 'jose@gmail.com', 1, '11111111111', '11111111111', 'ATIVO');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_categories` (`category_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Restrições para tabelas `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Restrições para tabelas `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
