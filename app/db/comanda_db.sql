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
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `user_type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `date_end` date DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--
INSERT INTO
  `users` (`user_name`, `password`, `user_type`, `date_end`)
VALUES
  ('franco', 'Hsu23sDsjseWs', 'SOCIO', NULL),
  ('pedro', 'dasdqsdw2sd23', 'MOZO', NULL),
  ('jorge', 'sda2s2f332f2', 'BARTENDER', NULL);

--
-- Estructura de tabla para la tabla `products`
--
DROP TABLE IF EXISTS `products`;

CREATE TABLE
  `products` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `price` decimal(10, 2) DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--
INSERT INTO
  `products` (`name`, `type`, `price`)
VALUES
  ('Coca', 'BEBIDA', 100),
  ('Papas', 'COMIDA', 200);

--
-- Estructura de tabla para la tabla `orders`
--
DROP TABLE IF EXISTS `orders`;

CREATE TABLE
  `orders` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `order_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
    `order_list` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `order_price` decimal(10, 2) DEFAULT NULL,
    `order_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--
INSERT INTO
  `orders` (`order_code`, `order_list`, `order_price`, `order_status`)
VALUES
  ('ab100', "[{'coca':'2', 'bife':'1'}]", 300, 'EN PREPARACION'),
   ('ab200', "[{'seven-up':'2', 'bife':'3'}]", 400, 'EN PREPARACION');

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `users`
--
-- ALTER TABLE `users` ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `users`
--
-- ALTER TABLE `users` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
-- AUTO_INCREMENT = 4;
-- COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;