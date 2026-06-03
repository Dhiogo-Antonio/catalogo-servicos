-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/06/2026 às 13:40
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
(7, 6, 1, 'Design', 'Ofereço um serviço de design criativo e estratégico voltado para marcas que querem se destacar de verdade. Desenvolvemos identidades visuais modernas, materiais gráficos, layouts parahsjs redes sociais, apresentações e peças digitais com foco em estética,', 100.00, 1, 'Paraguaçu-Paulista', '2026-05-20 13:28:47'),
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
(39, 17, 5, 'Instalação de Redes', 'Configuração de redes residenciais e empresariais.', 300.00, 2, 'Curitiba - PR', '2026-05-27 10:33:19'),
(40, 6, 3, 'Desenvolvimento de Sistema Web', 'Criação de sistemas personalizados.', 2500.00, 20, 'Paraguaçu Paulista - SP', '2026-06-03 10:22:31'),
(41, 6, 3, 'API REST em PHP', 'Desenvolvimento de APIs seguras e escaláveis.', 1200.00, 7, 'Paraguaçu Paulista - SP', '2026-06-03 10:22:31'),
(42, 6, 5, 'Manutenção de Servidores', 'Configuração e manutenção de servidores Linux.', 800.00, 3, 'Paraguaçu Paulista - SP', '2026-06-03 10:22:31'),
(43, 6, 3, 'Banco de Dados MySQL', 'Modelagem e otimização de banco de dados.', 900.00, 5, 'Paraguaçu Paulista - SP', '2026-06-03 10:22:31'),
(44, 6, 3, 'Site Institucional', 'Criação de site responsivo para empresas.', 1500.00, 10, 'Paraguaçu Paulista - SP', '2026-06-03 10:22:31'),
(45, 8, 2, 'Atendimento ao Cliente', 'Suporte e atendimento profissional.', 150.00, 2, 'Sapezal - MT', '2026-06-03 10:22:31'),
(46, 8, 2, 'Suporte por WhatsApp', 'Atendimento e gestão de mensagens.', 200.00, 5, 'Sapezal - MT', '2026-06-03 10:22:31'),
(47, 8, 2, 'Operador de Chat', 'Atendimento online para empresas.', 180.00, 3, 'Sapezal - MT', '2026-06-03 10:22:31'),
(48, 8, 2, 'Auxiliar Administrativo', 'Organização e suporte administrativo.', 250.00, 7, 'Sapezal - MT', '2026-06-03 10:22:31'),
(49, 8, 2, 'Gestão de Clientes', 'Relacionamento e suporte ao cliente.', 300.00, 10, 'Sapezal - MT', '2026-06-03 10:22:31'),
(50, 9, 1, 'Criação de Logotipo', 'Logo profissional para empresas.', 300.00, 3, 'Brasília - DF', '2026-06-03 10:22:31'),
(51, 9, 1, 'Identidade Visual', 'Desenvolvimento completo da marca.', 800.00, 7, 'Brasília - DF', '2026-06-03 10:22:31'),
(52, 9, 1, 'Design para Instagram', 'Posts profissionais para redes sociais.', 200.00, 2, 'Brasília - DF', '2026-06-03 10:22:31'),
(53, 9, 1, 'Banner Publicitário', 'Criação de banners digitais.', 120.00, 1, 'Brasília - DF', '2026-06-03 10:22:31'),
(54, 9, 1, 'Cartão de Visita', 'Design moderno para impressão.', 80.00, 1, 'Brasília - DF', '2026-06-03 10:22:31'),
(55, 10, 2, 'Marketing Digital', 'Estratégias para aumentar vendas.', 600.00, 15, 'Madrid - Espanha', '2026-06-03 10:22:31'),
(56, 10, 2, 'Gestão de Redes Sociais', 'Gerenciamento de perfis empresariais.', 500.00, 30, 'Madrid - Espanha', '2026-06-03 10:22:31'),
(57, 10, 2, 'Tráfego Pago', 'Campanhas no Google e Meta Ads.', 900.00, 7, 'Madrid - Espanha', '2026-06-03 10:22:31'),
(58, 10, 2, 'SEO para Sites', 'Otimização para mecanismos de busca.', 700.00, 20, 'Madrid - Espanha', '2026-06-03 10:22:31'),
(59, 10, 2, 'Copywriting', 'Textos persuasivos para vendas.', 350.00, 5, 'Madrid - Espanha', '2026-06-03 10:22:31'),
(60, 11, 4, 'Consultoria Empresarial', 'Análise estratégica para empresas.', 1200.00, 5, 'Paris - França', '2026-06-03 10:22:31'),
(61, 11, 4, 'Planejamento Financeiro', 'Organização financeira empresarial.', 900.00, 3, 'Paris - França', '2026-06-03 10:22:31'),
(62, 11, 4, 'Consultoria de Processos', 'Otimização de processos internos.', 800.00, 4, 'Paris - França', '2026-06-03 10:22:31'),
(63, 11, 4, 'Gestão de Projetos', 'Planejamento e execução de projetos.', 1500.00, 10, 'Paris - França', '2026-06-03 10:22:31'),
(64, 11, 4, 'Mentoria Empresarial', 'Orientação para empreendedores.', 700.00, 2, 'Paris - França', '2026-06-03 10:22:31'),
(65, 12, 5, 'Formatação de Computadores', 'Instalação e configuração de sistemas.', 120.00, 1, 'Assunção - Paraguai', '2026-06-03 10:22:31'),
(66, 12, 5, 'Limpeza de Computadores', 'Limpeza física e otimização.', 80.00, 1, 'Assunção - Paraguai', '2026-06-03 10:22:31'),
(67, 12, 5, 'Instalação de Redes', 'Configuração de redes locais.', 250.00, 2, 'Assunção - Paraguai', '2026-06-03 10:22:31'),
(68, 12, 5, 'Suporte Técnico', 'Resolução de problemas de hardware.', 150.00, 2, 'Assunção - Paraguai', '2026-06-03 10:22:31'),
(69, 12, 5, 'Montagem de PCs', 'Montagem personalizada de computadores.', 300.00, 3, 'Assunção - Paraguai', '2026-06-03 10:22:31'),
(70, 13, 1, 'Logo Premium', 'Criação de logos exclusivas.', 250.00, 3, 'São Paulo - SP', '2026-06-03 10:22:31'),
(71, 13, 1, 'Identidade Visual Completa', 'Manual da marca e aplicações.', 1200.00, 10, 'São Paulo - SP', '2026-06-03 10:22:31'),
(72, 13, 1, 'Design para Embalagens', 'Criação de embalagens modernas.', 500.00, 5, 'São Paulo - SP', '2026-06-03 10:22:31'),
(73, 13, 1, 'Arte para Stories', 'Artes profissionais para Instagram.', 80.00, 1, 'São Paulo - SP', '2026-06-03 10:22:31'),
(74, 13, 1, 'Design de Apresentações', 'Slides corporativos profissionais.', 300.00, 2, 'São Paulo - SP', '2026-06-03 10:22:31'),
(75, 14, 2, 'Calendário de Conteúdo', 'Planejamento mensal de postagens.', 400.00, 30, 'Campinas - SP', '2026-06-03 10:22:31'),
(76, 14, 2, 'Gestão de Facebook', 'Administração completa da página.', 350.00, 30, 'Campinas - SP', '2026-06-03 10:22:31'),
(77, 14, 2, 'Criação de Reels', 'Produção de conteúdo para Reels.', 250.00, 5, 'Campinas - SP', '2026-06-03 10:22:31'),
(78, 14, 2, 'Estratégia Digital', 'Planejamento de crescimento online.', 600.00, 15, 'Campinas - SP', '2026-06-03 10:22:31'),
(79, 14, 2, 'Consultoria Instagram', 'Análise e otimização do perfil.', 200.00, 2, 'Campinas - SP', '2026-06-03 10:22:31'),
(80, 15, 3, 'Landing Page', 'Página de alta conversão.', 900.00, 5, 'São Paulo - SP', '2026-06-03 10:22:31'),
(81, 15, 3, 'Loja Virtual', 'E-commerce completo.', 3500.00, 30, 'São Paulo - SP', '2026-06-03 10:22:31'),
(82, 15, 3, 'Sistema de Login', 'Autenticação segura para sistemas.', 700.00, 3, 'São Paulo - SP', '2026-06-03 10:22:31'),
(83, 15, 3, 'Dashboard Administrativo', 'Painel de gerenciamento.', 1800.00, 10, 'São Paulo - SP', '2026-06-03 10:22:31'),
(84, 15, 3, 'Correção de Bugs', 'Manutenção e correção de erros.', 300.00, 2, 'São Paulo - SP', '2026-06-03 10:22:31'),
(85, 16, 4, 'Consultoria de Gestão', 'Melhoria da administração empresarial.', 1000.00, 5, 'Rio de Janeiro - RJ', '2026-06-03 10:22:31'),
(86, 16, 4, 'Plano de Negócios', 'Estruturação de novos negócios.', 1500.00, 7, 'Rio de Janeiro - RJ', '2026-06-03 10:22:31'),
(87, 16, 4, 'Consultoria Comercial', 'Estratégias de vendas.', 800.00, 3, 'Rio de Janeiro - RJ', '2026-06-03 10:22:31'),
(88, 16, 4, 'Treinamento Empresarial', 'Capacitação de equipes.', 1200.00, 2, 'Rio de Janeiro - RJ', '2026-06-03 10:22:31'),
(89, 16, 4, 'Análise de Mercado', 'Pesquisa e oportunidades de mercado.', 900.00, 4, 'Rio de Janeiro - RJ', '2026-06-03 10:22:31'),
(90, 17, 5, 'Instalação de Windows', 'Instalação e ativação do sistema.', 100.00, 1, 'Curitiba - PR', '2026-06-03 10:22:31'),
(91, 17, 5, 'Upgrade de Hardware', 'Troca e instalação de componentes.', 200.00, 2, 'Curitiba - PR', '2026-06-03 10:22:31'),
(92, 17, 5, 'Configuração de Impressoras', 'Instalação e suporte.', 80.00, 1, 'Curitiba - PR', '2026-06-03 10:22:31'),
(93, 17, 5, 'Remoção de Vírus', 'Limpeza completa do sistema.', 120.00, 1, 'Curitiba - PR', '2026-06-03 10:22:31'),
(94, 17, 5, 'Suporte Remoto', 'Atendimento técnico online.', 90.00, 1, 'Curitiba - PR', '2026-06-03 10:22:31');

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
(9, 'João Silva', 'joao.silva@gmail.com', '1234', '18999846745', 'prestador', '2026-05-20 12:47:46', NULL),
(10, 'Miguel Costa', 'miguel.costa@gmail.com', '1234', '999090967', 'prestador', '2026-05-20 12:51:57', NULL),
(11, 'Lucas Martins', 'lucas.martins@gmail.com', '1234', '18999846758', 'prestador', '2026-05-20 12:59:19', NULL),
(12, 'Pedro Souza', 'pedro.souza@gmail.com', '1234', '18999846899', 'prestador', '2026-05-20 13:04:40', NULL),
(13, 'Lucas Designer', 'lucas@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'uploads/user_13.jpg'),
(14, 'Marina Social Media', 'marina@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'uploads/user_14.jpg'),
(15, 'Carlos Dev', 'carlos@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'uploads/user_15.jpg'),
(16, 'Fernanda Consultora', 'fernanda@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'uploads/user_16.jpg'),
(17, 'Rafaela Técnico', 'rafaela@proservicos.com', '123456', NULL, 'prestador', '2026-05-27 10:30:00', 'uploads/user_17.jpg'),
(18, 'Aidan', 'aidan@gmail', '1234', '1899984674', 'cliente', '2026-05-27 17:27:15', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
