-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-03-2021 a las 21:21:28
-- Versión del servidor: 8.0.13-4
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pqElWX5WY2`
--
-- --------------------------------------------------------
-- Creamos la base de datos
-- 
CREATE SCHEMA IF NOT EXISTS `comanda_db`;

--
-- Estructura de tabla para la tabla `users`
--
DROP TABLE IF EXISTS `users`;

CREATE TABLE
  `users` (
    `id` int (11) NOT NULL,
    `user_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `user_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `date_end` date DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--
INSERT INTO
  `users` (
    `id`,
    `user_name`,
    `password`,
    `user_type`,
    `date_end`
  )
VALUES
  (1, 'franco', 'Hsu23sDsjseWs', 'SOCIO', NULL),
  (2, 'pedro', 'dasdqsdw2sd23', 'MOZO', NULL),
  (3, 'jorge', 'sda2s2f332f2', 'BARTENDER', NULL);

--
-- Estructura de tabla para la tabla `dishes`
--
DROP TABLE IF EXISTS `dishes`;

CREATE TABLE
  `dishes` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `price` decimal(10, 2) DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `dishes`
--
INSERT INTO
  `dishes` (`name`, `price`)
VALUES
  ('Coca', 100),
  ('Papas', 200);

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `users`
--
ALTER TABLE `users` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;