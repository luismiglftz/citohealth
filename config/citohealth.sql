-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2024 a las 00:49:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citohealth`
--
DROP DATABASE IF EXISTS `citohealth`;
CREATE DATABASE IF NOT EXISTS `citohealth` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `citohealth`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE `citas` (
  `CITA_COD` int(10) NOT NULL,
  `PAC_DNI` varchar(9) NOT NULL,
  `EMPLE_COD` int(3) NOT NULL,
  `CITA_FEC` date NOT NULL,
  `CITA_AFEC` varchar(200) NOT NULL,
  `CITA_TIPO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos` (
  `DEP_COD` int(10) NOT NULL,
  `DEP_NOM` varchar(20) NOT NULL,
  `DEP_JEFE` varchar(20) NOT NULL,
  `DEP_CONS` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `EMPLE_COD` int(3) NOT NULL,
  `EMPLE_DNI` varchar(9) NOT NULL,
  `EMPLE_NOM` varchar(20) NOT NULL,
  `EMPLE_APE` varchar(50) NOT NULL,
  `EMPLE_COD_POSTAL` int(4) NOT NULL,
  `EMPLE_DIR` varchar(100) NOT NULL,
  `EMPLE_TEL` int(9) NOT NULL,
  `EMPLE_NAC` date NOT NULL,
  `EMPLE_MAIL` varchar(50) NOT NULL,
  `EMPLE_SUELDO` int(10) NOT NULL,
  `EMPLE_PUE` varchar(20) NOT NULL,
  `EMPLE_PASS` varchar(30) NOT NULL,
  `EMPLE_ROL` enum('EMPLEADO','ADMIN') NOT NULL,
  `DEP_COD` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmacos`
--

DROP TABLE IF EXISTS `farmacos`;
CREATE TABLE `farmacos` (
  `FARM_COD` int(10) NOT NULL,
  `FARM_NOM` varchar(50) NOT NULL,
  `FARM_DESC` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial` (
  `COD_HIS` int(10) NOT NULL,
  `PAC_DNI` varchar(9) NOT NULL,
  `HIS_FEC` date NOT NULL,
  `HIS_DESC` varchar(400) NOT NULL,
  `EMPLE_COD` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE `pacientes` (
  `PAC_DNI` varchar(9) NOT NULL,
  `PAC_NOM` varchar(20) NOT NULL,
  `PAC_APE` varchar(50) NOT NULL,
  `PAC_COD_POSTAL` int(4) NOT NULL,
  `PAC_DIRECCION` varchar(100) NOT NULL,
  `PAC_CIU` varchar(50) NOT NULL,
  `PAC_PROV` varchar(50) NOT NULL,
  `PAC_TEL` int(9) NOT NULL,
  `PAC_MAIL` varchar(50) NOT NULL,
  `PAC_FEC_NAC` date NOT NULL,
  `PAC_PASS` varchar(30) NOT NULL,
  `EMPLE_COD` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `pacientes`
--
DROP TRIGGER IF EXISTS `CS_PACIENTES`;
DELIMITER $$
CREATE TRIGGER `CS_PACIENTES` BEFORE DELETE ON `pacientes` FOR EACH ROW INSERT INTO PACIENTES_RESPALDO 
            VALUES (OLD.PAC_DNI,OLD.PAC_NOM,OLD.PAC_APE,OLD.PAC_COD_POSTAL,OLD.PAC_DIRECCION, OLD.PAC_CIU, OLD.PAC_PROV, OLD.PAC_TEL,OLD.PAC_MAIL,OLD.PAC_FEC_NAC,OLD.PAC_PASS,OLD.EMPLE_COD)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes_respaldo`
--

DROP TABLE IF EXISTS `pacientes_respaldo`;
CREATE TABLE `pacientes_respaldo` (
  `PAC_DNI` varchar(9) NOT NULL,
  `PAC_NOM` varchar(20) NOT NULL,
  `PAC_APE` varchar(50) NOT NULL,
  `PAC_COD_POSTAL` int(4) NOT NULL,
  `PAC_DIRECCION` varchar(100) NOT NULL,
  `PAC_CIU` varchar(50) NOT NULL,
  `PAC_PROV` varchar(50) NOT NULL,
  `PAC_TEL` int(9) NOT NULL,
  `PAC_MAIL` varchar(50) NOT NULL,
  `PAC_FEC_NAC` date NOT NULL,
  `PAC_PASS` varchar(30) NOT NULL,
  `EMPLE_COD` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

DROP TABLE IF EXISTS `tratamientos`;
CREATE TABLE `tratamientos` (
  `TRAT_COD` int(3) NOT NULL,
  `TRAT_FEC` date NOT NULL,
  `PAC_DNI` varchar(9) NOT NULL,
  `EMPLE_COD` int(3) NOT NULL,
  `TRAT_DESC` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos_farmacos`
--

DROP TABLE IF EXISTS `tratamientos_farmacos`;
CREATE TABLE `tratamientos_farmacos` (
  `TRAT_COD` int(3) NOT NULL,
  `FARM_COD` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CITA_COD`),
  ADD KEY `fk_med_cit` (`EMPLE_COD`),
  ADD KEY `fk_pac_cit` (`PAC_DNI`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`DEP_COD`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`EMPLE_COD`),
  ADD KEY `fk_med_dep` (`DEP_COD`);

--
-- Indices de la tabla `farmacos`
--
ALTER TABLE `farmacos`
  ADD PRIMARY KEY (`FARM_COD`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`COD_HIS`),
  ADD KEY `fk_pac_his` (`PAC_DNI`),
  ADD KEY `fk_med_his` (`EMPLE_COD`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`PAC_DNI`),
  ADD KEY `fk_med_pac` (`EMPLE_COD`);

--
-- Indices de la tabla `pacientes_respaldo`
--
ALTER TABLE `pacientes_respaldo`
  ADD PRIMARY KEY (`PAC_DNI`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`TRAT_COD`),
  ADD KEY `fk_med_trat` (`EMPLE_COD`),
  ADD KEY `fk_pac_trat` (`PAC_DNI`);

--
-- Indices de la tabla `tratamientos_farmacos`
--
ALTER TABLE `tratamientos_farmacos`
  ADD PRIMARY KEY (`TRAT_COD`,`FARM_COD`),
  ADD KEY `fk_trat_farm_farm` (`FARM_COD`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CITA_COD` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `farmacos`
--
ALTER TABLE `farmacos`
  MODIFY `FARM_COD` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `COD_HIS` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `TRAT_COD` int(3) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_med_cit` FOREIGN KEY (`EMPLE_COD`) REFERENCES `empleados` (`EMPLE_COD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pac_cit` FOREIGN KEY (`PAC_DNI`) REFERENCES `pacientes` (`PAC_DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_med_dep` FOREIGN KEY (`DEP_COD`) REFERENCES `departamentos` (`DEP_COD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_med_his` FOREIGN KEY (`EMPLE_COD`) REFERENCES `empleados` (`EMPLE_COD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pac_his` FOREIGN KEY (`PAC_DNI`) REFERENCES `pacientes` (`PAC_DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `fk_med_pac` FOREIGN KEY (`EMPLE_COD`) REFERENCES `empleados` (`EMPLE_COD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD CONSTRAINT `fk_med_trat` FOREIGN KEY (`EMPLE_COD`) REFERENCES `empleados` (`EMPLE_COD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pac_trat` FOREIGN KEY (`PAC_DNI`) REFERENCES `pacientes` (`PAC_DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tratamientos_farmacos`
--
ALTER TABLE `tratamientos_farmacos`
  ADD CONSTRAINT `fk_trat_farm_farm` FOREIGN KEY (`FARM_COD`) REFERENCES `farmacos` (`FARM_COD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_trat_farm_trat` FOREIGN KEY (`TRAT_COD`) REFERENCES `tratamientos` (`TRAT_COD`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
