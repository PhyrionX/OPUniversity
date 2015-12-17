-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2015 at 10:45 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `OPUniversity`
--

-- --------------------------------------------------------

--
-- Table structure for table `apuntes`
--

CREATE TABLE IF NOT EXISTS `apuntes` (
`id_apunte` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `fecha_subida` varchar(45) NOT NULL,
  `archivo` varchar(400) NOT NULL,
  `b_borrado` tinyint(4) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_universidad` int(11) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
`id_carrera` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
`id_comentarios` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` varchar(45) NOT NULL,
  `b_borrado` tinyint(4) NOT NULL DEFAULT '0',
  `id_usuario` int(11) DEFAULT NULL,
  `id_apuntes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `correos_validados`
--

CREATE TABLE IF NOT EXISTS `correos_validados` (
`id_correos_validados` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_correos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `info_usuario`
--

CREATE TABLE IF NOT EXISTS `info_usuario` (
`id_usuario` int(11) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `poblacion` varchar(100) NOT NULL,
  `src_img` varchar(400) NOT NULL DEFAULT 'default',
  `fecha_nacimiento` varchar(45) NOT NULL,
  `fecha_creacion` varchar(45) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `id_universidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `relacion_amigos`
--

CREATE TABLE IF NOT EXISTS `relacion_amigos` (
  `id_usuario1` int(11) NOT NULL,
  `id_usuario2` int(11) NOT NULL,
  `fecha_amistad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relacion_amigos`
--

INSERT INTO `relacion_amigos` (`id_usuario1`, `id_usuario2`, `fecha_amistad`) VALUES
(1, 2, '20/9/2012');

-- --------------------------------------------------------

--
-- Table structure for table `universidades`
--

CREATE TABLE IF NOT EXISTS `universidades` (
`id_universidad` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `fecha_fundacion` varchar(255) NOT NULL,
  `src_img` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
`id_usuario` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `b_validado` tinyint(4) NOT NULL DEFAULT '0',
  `b_borrado` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`id_usuario`, `email`, `pass`, `nombre`, `b_validado`, `b_borrado`) VALUES
(1, 'rgcmb@hotmail.com', '1234', 'Ruben', 0, 0),
(2, 'uroz@hi.com', '1234', 'Daniel', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apuntes`
--
ALTER TABLE `apuntes`
 ADD PRIMARY KEY (`id_apunte`), ADD KEY `fk_usuario_idx` (`id_usuario`), ADD KEY `fk_carrera_idx` (`id_carrera`), ADD KEY `fk_universidad_idx` (`id_universidad`);

--
-- Indexes for table `carreras`
--
ALTER TABLE `carreras`
 ADD PRIMARY KEY (`id_carrera`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
 ADD PRIMARY KEY (`id_comentarios`), ADD KEY `fk_usuario_comentario_idx` (`id_usuario`), ADD KEY `fk_comentarios_1_idx` (`id_apuntes`);

--
-- Indexes for table `correos_validados`
--
ALTER TABLE `correos_validados`
 ADD PRIMARY KEY (`id_correos_validados`,`email`), ADD KEY `fk_correos_validados_1_idx` (`id_correos`);

--
-- Indexes for table `info_usuario`
--
ALTER TABLE `info_usuario`
 ADD PRIMARY KEY (`id_usuario`), ADD KEY `fk_universidad_idx` (`id_universidad`), ADD KEY `fk_carrera_idx` (`id_carrera`);

--
-- Indexes for table `relacion_amigos`
--
ALTER TABLE `relacion_amigos`
 ADD PRIMARY KEY (`id_usuario1`,`id_usuario2`), ADD KEY `fk_relacion_amigos_2_idx` (`id_usuario2`);

--
-- Indexes for table `universidades`
--
ALTER TABLE `universidades`
 ADD PRIMARY KEY (`id_universidad`);

--
-- Indexes for table `Usuarios`
--
ALTER TABLE `Usuarios`
 ADD PRIMARY KEY (`id_usuario`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apuntes`
--
ALTER TABLE `apuntes`
MODIFY `id_apunte` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carreras`
--
ALTER TABLE `carreras`
MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
MODIFY `id_comentarios` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `correos_validados`
--
ALTER TABLE `correos_validados`
MODIFY `id_correos_validados` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `info_usuario`
--
ALTER TABLE `info_usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `universidades`
--
ALTER TABLE `universidades`
MODIFY `id_universidad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Usuarios`
--
ALTER TABLE `Usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `apuntes`
--
ALTER TABLE `apuntes`
ADD CONSTRAINT `fk_carrera2` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_universidad2` FOREIGN KEY (`id_universidad`) REFERENCES `universidades` (`id_universidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_usuario2` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
ADD CONSTRAINT `fk_comentarios_1` FOREIGN KEY (`id_apuntes`) REFERENCES `apuntes` (`id_apunte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_usuario_comentario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `correos_validados`
--
ALTER TABLE `correos_validados`
ADD CONSTRAINT `fk_correos_validados_1` FOREIGN KEY (`id_correos`) REFERENCES `universidades` (`id_universidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `info_usuario`
--
ALTER TABLE `info_usuario`
ADD CONSTRAINT `fk_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_universidad` FOREIGN KEY (`id_universidad`) REFERENCES `universidades` (`id_universidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `relacion_amigos`
--
ALTER TABLE `relacion_amigos`
ADD CONSTRAINT `fk_relacion_amigos_1` FOREIGN KEY (`id_usuario1`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_relacion_amigos_2` FOREIGN KEY (`id_usuario2`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
