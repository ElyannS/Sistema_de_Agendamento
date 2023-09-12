-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/08/2023 às 06:46
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `site_barber`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id` int(11) NOT NULL,
  `barbeiro_id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `data_agendamento` datetime NOT NULL,
  `nome_cliente` varchar(255) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `telefone_cliente` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `barbeiros`
--

CREATE TABLE `barbeiros` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_servico` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `status` enum('s','n','','') NOT NULL DEFAULT 's',
  `imagem_principal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `barbeiros`
--

INSERT INTO `barbeiros` (`id`, `nome`, `id_servico`, `cargo`, `status`, `imagem_principal`) VALUES
(1, 'Elyann Soares', '', 'Barbeiro Gerente', 's', 'resources/imagens/time/477d907d43e38f2b677bb4f778e88da7profissional1.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`) VALUES
(1, 'João Paulo', 'jp@gmail.com', '51 997610285'),
(2, 'Neto Abreu', 'netoabreu@gmail.com', '51 997610285');

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `nome`, `valor`, `data_cadastro`) VALUES
(1, 'nome_site', 'Minha Barbearia', '2023-08-22 03:17:53'),
(2, 'link_facebook', '', '2023-08-22 03:18:18'),
(3, 'link_instagram', '', '2023-08-22 03:18:18'),
(4, 'link_youtube', '', '2023-08-22 03:18:50'),
(5, 'telefone_contato', '', '2023-08-22 03:18:50'),
(6, 'email_contato', '', '2023-08-22 03:19:06'),
(7, 'email_contato', '', '2023-08-22 03:19:06'),
(8, 'logo_site', 'resources/imagens/097ca70f079c88a4a8d331d78859b8c1logo (200 × 100 px).png', '2023-08-22 03:19:13'),
(9, 'endereco_contato', '', '2023-08-22 03:20:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL,
  `imagem_principal` varchar(255) NOT NULL,
  `url_amigavel` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tempo_servico` enum('60','30','','') NOT NULL DEFAULT '30'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `titulo`, `descricao`, `imagem_principal`, `url_amigavel`, `data_cadastro`, `tempo_servico`) VALUES
(2, 'Corte e barba', 'Espec&iacute;fico para quem deseja fazer os dois servi&ccedil;os no mesmo dia.', 'resources/imagens/1141309783b44cd7acd3be20b435ef362019070080337001563903392.jpeg', 'corte-e-barba', '2023-06-23 13:00:00', '60'),
(3, 'Corte tradicional', 'Um corte de cabelo cl&aacute;ssico e atemporal&nbsp;que valorizam o seu estilo.', 'resources/imagens/b11ad34980794dbd7e9fb27786bc5f54social.png', 'corte-tradicional', '2023-06-23 03:00:00', '30'),
(4, 'Corte degrade', 'Corte que transita suavemente em diferentes tamanhos.', 'resources/imagens/7892e6ad8326d3c26a18bd44082dd32ddegrade.png', 'corte-degrade', '2023-06-23 03:00:00', '30'),
(5, 'Corte disfarçado', 'Utiliza t&eacute;cnicas para suaviza&ccedil;&atilde;o em diferentes tamanhos.', 'resources/imagens/1466b0c468dd555c594de5ba59f8e78bsombreado.png', 'corte-disfarcado', '2023-06-24 03:00:00', '30'),
(6, 'Barba', 'Especializado no cuidado e apar&ecirc;ncia da barba.', 'resources/imagens/79fe2c193d51e7e2c40d42b80845f09abarba.png', 'barba', '2023-06-24 03:00:00', '30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto_usuario` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `foto_usuario`, `data_cadastro`, `senha`) VALUES
(1, 'Elyann Soares', 'teste@teste.com', 'resources/imagens/usuario/fda1c65bfbccd096c40ffa1319b8996659b5ff9529796f62d9d7077c27386356.jpg', '2023-08-22 03:00:00', '$2y$10$QPGHbH2PqBt8xFYbJzCoqe4tDaAqzfGXk17QY/eeJWVhklK9NvIR.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_service_id` (`servico_id`);

--
-- Índices de tabela `barbeiros`
--
ALTER TABLE `barbeiros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_servico_id` (`cargo`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `barbeiros`
--
ALTER TABLE `barbeiros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
