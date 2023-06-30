-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/06/2023 às 08:02
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdacademico`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `idAluno` int(11) NOT NULL,
  `nomeAluno` varchar(80) NOT NULL,
  `matriculaAluno` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `caracteristica`
--

CREATE TABLE `caracteristica` (
  `idCaracteristica` int(11) NOT NULL,
  `tipoAluno` int(11) DEFAULT NULL,
  `tipoProfessor` int(11) DEFAULT NULL,
  `valorCaracteristica` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `nomeCurso` varchar(80) NOT NULL,
  `cargaHorariaCurso` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`idCurso`, `nomeCurso`, `cargaHorariaCurso`) VALUES
(1, 'Redes de Computadores', '400 horas'),
(3, 'Física Bacharel', '400 horas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `idDisciplina` int(11) NOT NULL,
  `nomeDisciplina` varchar(100) NOT NULL,
  `cargaHorariaDisciplina` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplina`
--

INSERT INTO `disciplina` (`idDisciplina`, `nomeDisciplina`, `cargaHorariaDisciplina`) VALUES
(2, 'Física I', '40 Horas'),
(3, 'Algoritmos', '50 horas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `idEndereco` int(11) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `cep` int(11) NOT NULL,
  `idAluno` int(11) DEFAULT NULL,
  `idProfessor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`idEndereco`, `rua`, `bairro`, `numero`, `cep`, `idAluno`, `idProfessor`) VALUES
(4, 'hdhjd', 'dhzdh', 145, 23446787, NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `matricula`
--

CREATE TABLE `matricula` (
  `idMatricula` int(11) NOT NULL,
  `id_Disciplina` int(11) NOT NULL,
  `id_Curso` int(11) NOT NULL,
  `id_Aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `idProfessor` int(11) NOT NULL,
  `nomeProfessor` varchar(80) NOT NULL,
  `matriculaProfessor` varchar(80) NOT NULL,
  `escolaridadeProfessor` varchar(80) NOT NULL,
  `especialidadeProfessor` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nomeProfessor`, `matriculaProfessor`, `escolaridadeProfessor`, `especialidadeProfessor`) VALUES
(2, 'João', '52258709', 'Ensino Superior Completo', 'Historia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professordisciplinacurso`
--

CREATE TABLE `professordisciplinacurso` (
  `idProfessorDisciplinaCurso` int(11) NOT NULL,
  `id_Professor` int(11) NOT NULL,
  `id_Disciplina` int(11) NOT NULL,
  `id_Curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professordisciplinacurso`
--

INSERT INTO `professordisciplinacurso` (`idProfessorDisciplinaCurso`, `id_Professor`, `id_Disciplina`, `id_Curso`) VALUES
(2, 2, 3, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idAluno`),
  ADD UNIQUE KEY `matricula_unico` (`matriculaAluno`);

--
-- Índices de tabela `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD PRIMARY KEY (`idCaracteristica`),
  ADD KEY `tipoAluno` (`tipoAluno`),
  ADD KEY `tipoProfessor` (`tipoProfessor`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idEndereco`),
  ADD KEY `idAluno` (`idAluno`),
  ADD KEY `idProfessor` (`idProfessor`);

--
-- Índices de tabela `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`idMatricula`),
  ADD KEY `fk_aluno_matricula` (`id_Aluno`),
  ADD KEY `fk_curso_matricula` (`id_Curso`),
  ADD KEY `fk_disciplina_matricula` (`id_Disciplina`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idProfessor`),
  ADD UNIQUE KEY `matricula_unico` (`matriculaProfessor`);

--
-- Índices de tabela `professordisciplinacurso`
--
ALTER TABLE `professordisciplinacurso`
  ADD PRIMARY KEY (`idProfessorDisciplinaCurso`),
  ADD KEY `id_Professor` (`id_Professor`),
  ADD KEY `id_Disciplina` (`id_Disciplina`),
  ADD KEY `id_Curso` (`id_Curso`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `caracteristica`
--
ALTER TABLE `caracteristica`
  MODIFY `idCaracteristica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `matricula`
--
ALTER TABLE `matricula`
  MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `idProfessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `professordisciplinacurso`
--
ALTER TABLE `professordisciplinacurso`
  MODIFY `idProfessorDisciplinaCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD CONSTRAINT `caracteristica_ibfk_1` FOREIGN KEY (`tipoAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `caracteristica_ibfk_2` FOREIGN KEY (`tipoProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE CASCADE,
  ADD CONSTRAINT `endereco_ibfk_2` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE CASCADE;

--
-- Restrições para tabelas `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_aluno_matricula` FOREIGN KEY (`id_Aluno`) REFERENCES `aluno` (`idAluno`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_curso_matricula` FOREIGN KEY (`id_Curso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_disciplina_matricula` FOREIGN KEY (`id_Disciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE,
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`id_Disciplina`) REFERENCES `disciplina` (`idDisciplina`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`id_Curso`) REFERENCES `curso` (`idCurso`),
  ADD CONSTRAINT `matricula_ibfk_3` FOREIGN KEY (`id_Aluno`) REFERENCES `aluno` (`idAluno`);

--
-- Restrições para tabelas `professordisciplinacurso`
--
ALTER TABLE `professordisciplinacurso`
  ADD CONSTRAINT `professordisciplinacurso_ibfk_1` FOREIGN KEY (`id_Professor`) REFERENCES `professor` (`idProfessor`) ON DELETE CASCADE,
  ADD CONSTRAINT `professordisciplinacurso_ibfk_2` FOREIGN KEY (`id_Disciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE,
  ADD CONSTRAINT `professordisciplinacurso_ibfk_3` FOREIGN KEY (`id_Curso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
