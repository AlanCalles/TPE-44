# TPE-44
Trabajo Practico Especial - Grupo 44

Tema: Productos, distribuidora y comerciante.

Descripcion: Pagina dedicada a sistema de distrubuidora mayorista.

Diagrama:

![diagrama](https://github.com/user-attachments/assets/69ac5b98-810a-4743-beff-5ff4f1c1dc27)
[Up-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2024 a las 22:58:58
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
-- Base de datos: `db_sistemadistribucion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comerciente`
--

CREATE TABLE `comerciente` (
  `id_comerciante` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comerciente`
--

INSERT INTO `comerciente` (`id_comerciante`, `nombre`) VALUES
(2, 'alan'),
(1, 'nahuel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidora`
--

CREATE TABLE `distribuidora` (
  `id_producto` int(11) NOT NULL,
  `id_comerciante` int(11) NOT NULL,
  `nombre_producto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distribuidora`
--

INSERT INTO `distribuidora` (`id_producto`, `id_comerciante`, `nombre_producto`) VALUES
(2, 1, 'turron'),
(3, 2, 'alfajor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comerciente`
--
ALTER TABLE `comerciente`
  ADD PRIMARY KEY (`id_comerciante`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `distribuidora`
--
ALTER TABLE `distribuidora`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_comerciante` (`id_comerciante`),
  ADD KEY `nombre_producto` (`nombre_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comerciente`
--
ALTER TABLE `comerciente`
  MODIFY `id_comerciante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `distribuidora`
--
ALTER TABLE `distribuidora`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `distribuidora`
--
ALTER TABLE `distribuidora`
  ADD CONSTRAINT `distribuidora_ibfk_1` FOREIGN KEY (`id_comerciante`) REFERENCES `comerciente` (`id_comerciante`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
loading db_sistemadistribucion.sql…]()
