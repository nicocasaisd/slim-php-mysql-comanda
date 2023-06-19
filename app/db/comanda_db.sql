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
    `dateTimeString` DATETIME NOT NULL,
    `id_product` int(11) NOT NULL,
    `quantity` int(3) NOT NULL,
    `id_bill` int(11) NOT NULL,
    `id_waiter` int(11) NOT NULL,
    `id_cook` int(11) DEFAULT NULL,
    `status` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `preparationDateTimeString` DATETIME DEFAULT NULL,
    `subtotal` decimal(10, 2) DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--
INSERT INTO
  `orders` (`dateTimeString`, `id_product`, `quantity`, `id_waiter`, `id_bill`, `id_cook`, `status`, `preparationDateTimeString`, `subtotal`)
VALUES
  ('2023-06-18 11:11:11', '1','1','1','1','1','EN PREPARACION', '2023-06-18 11:11:11', 300),
  ('2023-06-18 11:11:11', '1','1','1','1','1','EN PREPARACION', '2023-06-18 11:11:11', 300);



--
-- Estructura de tabla para la tabla `bills`
--
DROP TABLE IF EXISTS `bills`;

CREATE TABLE
  `bills` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `dateTimeString` DATETIME NOT NULL,
    `id_table` int(11) NOT NULL,
    `customerName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bills`
--
INSERT INTO
  `bills` (`dateTimeString`, `id_table`, `customerName`)
VALUES
  ('2023-06-18 11:11:11', '1', 'Nicolas Casais'),
  ('2023-06-18 11:11:11', '1', 'Julieta Retori');

--
-- Estructura de tabla para la tabla `bills`
--
DROP TABLE IF EXISTS `tables`;

CREATE TABLE
  `tables` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
    `status` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `sector` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tables`
--
INSERT INTO
  `tables` (`status`, `sector`)
VALUES
  ( 'LIBRE', 'COCINA'),
  ( 'LIBRE', 'ENTRADA');

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