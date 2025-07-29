-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jul-2025 às 16:43
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_pokemon`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pokemon`
--

CREATE TABLE `pokemon` (
  `id_pokemon` int(11) NOT NULL,
  `nome_pokemon` varchar(250) NOT NULL,
  `tipo_pokemon` varchar(250) NOT NULL,
  `localizacao_pokemon` varchar(250) NOT NULL,
  `data_registro_pokemon` date NOT NULL,
  `hp_pokemon` int(100) NOT NULL,
  `defesa_pokemon` int(100) NOT NULL,
  `ataque_pokemon` int(100) NOT NULL,
  `observacao_pokemon` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pokemon`
--

INSERT INTO `pokemon` (`id_pokemon`, `nome_pokemon`, `tipo_pokemon`, `localizacao_pokemon`, `data_registro_pokemon`, `hp_pokemon`, `defesa_pokemon`, `ataque_pokemon`, `observacao_pokemon`) VALUES
(2, 'Charmander', 'Fogo', 'Casa 2', '2025-07-31', 600, 100, 295, 'Calmo'),
(4, 'Bulbassauro', 'Planta', 'Casa 4', '2025-07-28', 280, 150, 400, 'Calmo'),
(6, 'Rattata', 'Pedra', 'Casa 6', '2025-07-30', 1, 15, 7000, 'Teimoso'),
(7, 'Charizard', 'Fogo', 'Casa 7', '2025-07-29', 410, 2, 10, 'Teimoso'),
(11, 'Macaco Prego', 'Planta', 'Casa 10', '2025-07-29', 120, 65, 80, 'Preguiçoso');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id_pokemon`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id_pokemon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
