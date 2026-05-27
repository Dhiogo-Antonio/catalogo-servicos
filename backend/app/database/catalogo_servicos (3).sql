-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/05/2026 às 12:37
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
-- Banco de dados: `catalogo_servicos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `icone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `icone`) VALUES
(1, 'Design', 'fa-palette'),
(2, 'Marketing', 'fa-bullhorn'),
(3, 'Desenvolvimento', 'fa-code'),
(4, 'Consultoria', 'fa-briefcase'),
(5, 'Manutenção', 'fa-screwdriver-wrench');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contratacoes`
--

CREATE TABLE `contratacoes` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `mensagem` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pendente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contratacoes`
--

INSERT INTO `contratacoes` (`id`, `cliente_id`, `servico_id`, `mensagem`, `status`, `criado_em`) VALUES
(1, 1, 9, 'yshdsjdhsjd', 'Pendente', '2026-05-22 12:09:38'),
(2, 1, 9, 'yshdsjdhsjd', 'Pendente', '2026-05-22 12:12:12'),
(3, 1, 8, 'aidjkskskcdihvdvivdnkfdvndkndkncskcnsjcnsjcnskcnsk', 'Pendente', '2026-05-22 12:41:01'),
(4, 1, 8, 'dnbcns,cnscm', 'Pendente', '2026-05-22 12:48:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nome_servico` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `prazo` int(11) NOT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `usuario_id`, `categoria_id`, `nome_servico`, `descricao`, `preco`, `prazo`, `localizacao`, `criado_em`) VALUES
(5, 6, 3, 'Manutenção de servidores', 'sdsds', 45.00, 10, 'Paraguaçu-Paulista', '2026-05-20 10:59:55'),
(6, 6, 3, 'Banco de Dados', 'Criar banco de dados', 5000.00, 2, 'Paraguaçu-Paulista', '2026-05-20 12:12:35'),
(7, 6, 1, 'Design', 'Ofereço um serviço de design criativo e estratégico voltado para marcas que querem se destacar de verdade. Desenvolvemos identidades visuais modernas, materiais gráficos, layouts para redes sociais, apresentações e peças digitais com foco em estética, cla', 100.00, 1, 'Paraguaçu-Paulista', '2026-05-20 13:28:47'),
(8, 8, 2, 'Atendente', 'Atendente dedicado e comunicativo, focado em oferecer um atendimento rápido, educado e eficiente. Experiência em suporte ao cliente, resolução de dúvidas, organização de pedidos e auxílio durante todo o processo de atendimento. Comprometido em garantir um', 20.00, 5, 'Sapezal', '2026-05-22 11:16:25'),
(9, 8, 3, 'Desenvolvimento Web', 'Desenvolvedor web especializado na criação de sites e sistemas modernos, responsivos e funcionais. Experiência com PHP, HTML, CSS, JavaScript e bancos de dados, desenvolvendo soluções organizadas, seguras e intuitivas. Focado em performance, experiência d', 1.00, 365, 'New-York', '2026-05-22 11:17:55'),
(30, 13, 1, 'Criação de Logo Profissional', 'Desenvolvimento de logos modernas para empresas e marcas.', 120.00, 3, 'São Paulo - SP', '2026-05-27 10:33:19'),
(31, 13, 1, 'Design para Redes Sociais', 'Posts profissionais para Instagram e Facebook.', 90.00, 2, 'Campinas - SP', '2026-05-27 10:33:19'),
(32, 14, 2, 'Gestão de Instagram', 'Gerenciamento completo do perfil da sua empresa.', 350.00, 30, 'Assis - SP', '2026-05-27 10:33:19'),
(33, 14, 2, 'Tráfego Pago', 'Campanhas patrocinadas no Instagram e Google.', 500.00, 7, 'Marília - SP', '2026-05-27 10:33:19'),
(34, 15, 3, 'Criação de Sites', 'Sites modernos utilizando PHP, HTML, CSS e JavaScript.', 1200.00, 15, 'São Paulo - SP', '2026-05-27 10:33:19'),
(35, 15, 3, 'Sistema Web Completo', 'Desenvolvimento de sistemas personalizados.', 3500.00, 30, 'Sorocaba - SP', '2026-05-27 10:33:19'),
(36, 16, 4, 'Consultoria Empresarial', 'Estratégias para crescimento e gestão do negócio.', 800.00, 5, 'Rio de Janeiro - RJ', '2026-05-27 10:33:19'),
(37, 16, 4, 'Consultoria Financeira', 'Planejamento financeiro para pequenas empresas.', 650.00, 4, 'Belo Horizonte - MG', '2026-05-27 10:33:19'),
(38, 17, 5, 'Manutenção de Computadores', 'Limpeza, formatação e otimização de PCs.', 150.00, 1, 'Londrina - PR', '2026-05-27 10:33:19'),
(39, 17, 5, 'Instalação de Redes', 'Configuração de redes residenciais e empresariais.', 300.00, 2, 'Curitiba - PR', '2026-05-27 10:33:19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tipo` enum('cliente','prestador','admin') DEFAULT 'cliente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`, `tipo`, `criado_em`, `foto`) VALUES
(1, 'dhiogo', 'dhiogo@gmail', '1234', '1899984674', 'cliente', '2026-05-15 14:12:45', NULL),
(2, 'Vitor', 'vitor@gmail', '1234', '1899984667', 'cliente', '2026-05-15 14:16:05', NULL),
(6, 'dhiogo', 'admin@gmail.com', '1234', '18999846748', 'prestador', '2026-05-15 14:42:00', 'uploads/user_6.jpg'),
(8, 'Gabriel Machado', 'gabriel@gmail.com', '1234', '1899984673', 'prestador', '2026-05-20 12:32:57', 'uploads/user_8.jpg'),
(9, 'Brasil', 'brasil@gmail.com', '1234', '18999846745', 'prestador', '2026-05-20 12:47:46', NULL),
(10, 'Espanha', 'espanha@gmail.com', '1234', '999090967', 'prestador', '2026-05-20 12:51:57', NULL),
(11, 'França', 'franca@gmail', '1234', '18999846758', 'prestador', '2026-05-20 12:59:19', NULL),
(12, 'Paraguai', 'paraguai@gmail', '1234', '18999846899', 'prestador', '2026-05-20 13:04:40', NULL),
(13, 'Lucas Designer', 'lucas@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'https://i.pravatar.cc/150?img=11'),
(14, 'Marina Social Media', 'marina@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'https://i.pravatar.cc/150?img=32'),
(15, 'Carlos Dev', 'carlos@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'https://i.pravatar.cc/150?img=15'),
(16, 'Fernanda Consultora', 'fernanda@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'https://i.pravatar.cc/150?img=47'),
(17, 'Rafael Técnico', 'rafael@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'https://i.pravatar.cc/150?img=20');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contratacoes`
--
ALTER TABLE `contratacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `contratacoes`
--
ALTER TABLE `contratacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
