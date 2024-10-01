-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 01/10/2024 às 17:02
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
-- Banco de dados: `db_senactec`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `image` char(255) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `banners`
--

INSERT INTO `banners` (`id`, `image`, `status`) VALUES
(1, '/supermarket-senactec/img/banners/banner1.jpg', 'ATIVO');

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
  `description` char(200) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(1, 'Massas', 'Produtos de massas frescas e secas', 'ATIVO'),
(2, 'Produtos Lácteos', 'Produtos lácteos frescos e processados', 'ATIVO'),
(3, 'Carnes e Aves', 'Carnes frescas e processadas, aves e ovos', 'ATIVO'),
(4, 'Frutas e Legumes', 'Frutas e legumes frescos e congelados', 'ATIVO'),
(5, 'Bebidas', 'Bebidas alcoólicas e não alcoólicas', 'ATIVO'),
(6, 'Pães e Bolos', 'Pães frescos e congelados, bolos e tortas', 'ATIVO'),
(7, 'Produtos de Limpeza', 'Produtos de limpeza para casa e escritório', 'ATIVO'),
(8, 'Higiene Pessoal', 'Produtos de higiene pessoal e beleza', 'ATIVO'),
(9, 'Produtos de Pet', 'Produtos para animais de estimação', 'ATIVO'),
(10, 'Outros', 'Produtos variados que não se enquadram em outras categorias', 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`) VALUES
(1, 'João Silva', 'joao.silva@email.com', 'Gostaria de elogiar o atendimento do seu supermercado. A equipe é muito prestativa e os produtos são de alta qualidade.'),
(2, 'Maria Oliveira', 'maria.oliveira@email.com', 'Tive um problema com um produto que comprei no seu supermercado e a equipe resolveu rapidamente. Muito obrigada!'),
(3, 'Pedro Alves', 'pedro.alves@email.com', 'Gostaria de sugerir que vocês incluam mais opções de produtos orgânicos em sua loja. Seria muito útil para mim e para muitos outros clientes.'),
(4, 'Ana Souza', 'ana.souza@email.com', 'Eu sou cliente do seu supermercado há anos e sempre fui muito satisfeita com a qualidade dos produtos e o atendimento. Parabéns!'),
(5, 'Carlos Lima', 'carlos.lima@email.com', 'Tive um problema com a entrega de um pedido e a equipe resolveu rapidamente. Muito obrigado!'),
(6, 'Beatriz Martins', 'beatriz.martins@email.com', 'Gostaria de sugerir que vocês criem um programa de fidelidade para os clientes. Seria muito útil para mim e para muitos outros clientes.'),
(7, 'Luiz Fernandes', 'luiz.fernandes@email.com', 'Eu sou cliente do seu supermercado há anos e sempre fui muito satisfeito com a qualidade dos produtos e o atendimento. Parabéns!'),
(8, 'Rafaela Santos', 'rafaela.santos@email.com', 'Tive um problema com um produto que comprei no seu supermercado e a equipe resolveu rapidamente. Muito obrigada!'),
(9, 'Gabriel Costa', 'gabriel.costa@email.com', 'Gostaria de elogiar o atendimento do seu supermercado. A equipe é muito prestativa e os produtos são de alta qualidade.'),
(10, 'Juliana Pereira', 'juliana.pereira@email.com', 'Eu sou cliente do seu supermercado há anos e sempre fui muito satisfeita com a qualidade dos produtos e o atendimento. Parabéns!');

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
(1, 'Macarrão Espaguete', 'Macarrão espaguete fresco, 500g', 5.99, 100, 'macarrao_espaguete.jpg', 1, 'Ativo'),
(2, 'Leite Integral', 'Leite integral fresco, 1L', 3.99, 50, 'leite_integral.jpg', 2, 'Ativo'),
(3, 'Frango Grelhado', 'Frango grelhado fresco, 1kg', 12.99, 20, 'frango_grelhado.jpg', 3, 'Ativo'),
(4, 'Maçã Gala', 'Maçã gala fresca, 1kg', 6.99, 30, 'maca_gala.jpg', 4, 'Ativo'),
(5, 'Coca-Cola', 'Bebida refrigerante, 2L', 4.99, 50, 'coca_cola.jpg', 5, 'Ativo'),
(6, 'Pão Francês', 'Pão francês fresco, 500g', 2.99, 20, 'pao_frances.jpg', 6, 'Ativo'),
(7, 'Detergente Líquido', 'Detergente líquido para roupa, 1L', 8.99, 10, 'detergente_liquido.jpg', 7, 'Ativo'),
(8, 'Shampoo', 'Shampoo para cabelo, 500ml', 9.99, 15, 'shampoo.jpg', 8, 'Ativo'),
(9, 'Ração para Cachorro', 'Ração para cachorro, 5kg', 29.99, 5, 'racao_cachorro.jpg', 9, 'Ativo'),
(10, 'Bolo de Chocolate', 'Bolo de chocolate fresco, 1kg', 19.99, 10, 'bolo_chocolate.jpg', 6, 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` char(30) NOT NULL,
  `access_level` enum('0','1','2','3') NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` char(10) NOT NULL DEFAULT 'ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `access_level`, `email`, `cpf`, `phone`, `address`, `status`) VALUES
(1, 'admin-master', '1234', '3', 'barbosajesse419@gmail.com', '11111111111', '33123456789', 'Vila São João, 123, MG', 'ATIVO');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

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
-- Índices de tabela `contacts`
--
ALTER TABLE `contacts`
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
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
