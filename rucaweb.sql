-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2025 a las 06:03:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rucaweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_comida_rapida`
--

CREATE TABLE `menu_comida_rapida` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `subcategoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu_comida_rapida`
--

INSERT INTO `menu_comida_rapida` (`id`, `nombre`, `descripcion`, `precio`, `categoria`, `subcategoria`) VALUES
(1, 'Salchipapas', NULL, 4000.00, 'Papas', 'Papas'),
(2, 'Papas fritas', NULL, 3500.00, 'Papas', 'Papas'),
(3, 'Papas bravas', NULL, 4000.00, 'Papas', 'Papas'),
(4, 'Papas rústicas', NULL, 4000.00, 'Papas', 'Papas'),
(5, 'Pichanga 2 personas', NULL, 11000.00, 'Tablas', 'Tablas'),
(6, 'Pichanga 4 personas', NULL, 16000.00, 'Tablas', 'Tablas'),
(7, 'Pichanga 6 personas', NULL, 23000.00, 'Tablas', 'Tablas'),
(8, 'Chorrillana 2 pers.', NULL, 12000.00, 'Tablas', 'Tablas'),
(9, 'Chorrillana 4 pers.', NULL, 18000.00, 'Tablas', 'Tablas'),
(10, 'Chorrillana 6 pers.', NULL, 25000.00, 'Tablas', 'Tablas'),
(11, 'Mixta 2 pers.', NULL, 13000.00, 'Tabla Mixta', 'Tabla Mixta'),
(12, 'Mixta 4 pers.', NULL, 18000.00, 'Tabla Mixta', 'Tabla Mixta'),
(13, 'Mixta 6 pers.', NULL, 25000.00, 'Tabla Mixta', 'Tabla Mixta'),
(14, 'Champi Pollo 2 pers.', NULL, 11000.00, 'Champi Pollo', 'Champi Pollo'),
(15, 'Champi Pollo 4 pers.', NULL, 16000.00, 'Champi Pollo', 'Champi Pollo'),
(16, 'Champi Pollo 6 pers.', NULL, 22000.00, 'Champi Pollo', 'Champi Pollo'),
(17, 'Champi Carne 2 pers.', NULL, 12000.00, 'Champi Carne', 'Champi Carne'),
(18, 'Champi Carne 4 pers.', NULL, 17000.00, 'Champi Carne', 'Champi Carne'),
(19, 'Champi Carne 6 pers.', NULL, 23000.00, 'Champi Carne', 'Champi Carne'),
(20, 'Churrasco', NULL, 5000.00, 'Sandwichs', 'Sandwichs'),
(21, 'A lo pobre', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(22, 'Barros luco', NULL, 4800.00, 'Sandwichs', 'Sandwichs'),
(23, 'Chacarero', NULL, 5500.00, 'Sandwichs', 'Sandwichs'),
(24, 'Rucaso', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(25, 'Diputado', NULL, 4800.00, 'Sandwichs', 'Sandwichs'),
(26, 'Brasileño', NULL, 5000.00, 'Sandwichs', 'Sandwichs'),
(27, 'Lucaso queso huevo', NULL, 6500.00, 'Sandwichs', 'Sandwichs'),
(28, 'Lucaso huevo', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(29, 'Lucaso queso', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(30, 'La ruca de los monos', NULL, 7000.00, 'Sandwichs', 'Sandwichs'),
(31, 'Ave completa', NULL, 5000.00, 'Sandwichs', 'Sandwichs'),
(32, 'Ave luco', NULL, 5500.00, 'Sandwichs', 'Sandwichs'),
(33, 'Americano', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(34, 'Mechada completa', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(35, 'Mechada luco', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(36, 'Hamburguesa casera', NULL, 5500.00, 'Sandwichs', 'Sandwichs'),
(37, 'Hamburguesa criolla', NULL, 7500.00, 'Sandwichs', 'Sandwichs'),
(38, 'Hamburguesa luco', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(39, 'Gordita', NULL, 5000.00, 'Sandwichs', 'Sandwichs'),
(40, 'Tortuga', NULL, 4800.00, 'Sandwichs', 'Sandwichs'),
(41, 'Rucana', NULL, 6000.00, 'Sandwichs', 'Sandwichs'),
(42, 'Sandwich de pescado', NULL, 7000.00, 'Sandwichs', 'Sandwichs'),
(43, 'Vegetariano', NULL, 4800.00, 'Sandwichs', 'Sandwichs'),
(44, 'Hamburguesa vegana', NULL, 6000.00, 'Sandwichs', 'Sandwichs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_desayuno`
--

CREATE TABLE `menu_desayuno` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `subcategoria` varchar(50) DEFAULT NULL,
  `opciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu_desayuno`
--

INSERT INTO `menu_desayuno` (`id`, `nombre`, `descripcion`, `precio`, `categoria`, `subcategoria`, `opciones`) VALUES
(2, 'Huevo tocino', NULL, 3000.00, 'Pailas', 'Pailas', NULL),
(5, 'Queso', NULL, 2300.00, 'Empanadas', 'Empanadas', NULL),
(6, 'Camarón queso', NULL, 2800.00, 'Empanadas', 'Empanadas', NULL),
(7, 'Pulpo queso', NULL, 2800.00, 'Empanadas', 'Empanadas', NULL),
(8, 'Mechada queso', NULL, 2800.00, 'Empanadas', 'Empanadas', NULL),
(9, 'Napolitana', NULL, 2500.00, 'Empanadas', 'Empanadas', NULL),
(10, 'Maracuyá', NULL, 3000.00, 'Jugos', 'Jugos', 'Agua'),
(12, 'Mango', NULL, 3000.00, 'Jugos', 'Jugos', 'Agua'),
(14, 'Frutilla', NULL, 3000.00, 'Jugos', 'Jugos', 'Agua'),
(16, 'Guayaba', NULL, 3000.00, 'Jugos', 'Jugos', 'Agua'),
(18, 'Piña', NULL, 3000.00, 'Jugos', 'Jugos', 'Agua'),
(19, 'Plátano Leche', '', 3500.00, 'Jugos', 'Jugos', 'Leche'),
(20, 'Melón tuna', NULL, 3000.00, 'Jugos', 'Jugos', 'Agua'),
(21, 'Melón calameño', NULL, 3000.00, 'Jugos', 'Jugos', 'Agua'),
(35, 'Té de hoja', NULL, 1000.00, 'Bebestibles', 'Bebestibles', NULL),
(36, 'Chocolate caliente', NULL, 2500.00, 'Bebestibles', 'Bebestibles', NULL),
(38, 'Huevo', NULL, 2000.00, 'Pailas', 'Pailas', NULL),
(40, 'Huevo queso', NULL, 3000.00, 'Pailas', 'Pailas', NULL),
(41, 'Huevo jamón', NULL, 3000.00, 'Pailas', 'Pailas', NULL),
(59, 'Completo', NULL, 2000.00, 'Sandwich', 'Sandwich', NULL),
(60, 'Ave Mayo', NULL, 3800.00, 'Sandwich', 'Sandwich', NULL),
(61, 'Churrasco', NULL, 4000.00, 'Sandwich', 'Sandwich', NULL),
(62, 'Aliado', NULL, 3200.00, 'Sandwich', 'Sandwich', NULL),
(63, 'Queso caliente', NULL, 3000.00, 'Sandwich', 'Sandwich', NULL),
(64, 'Barros luco', NULL, 4000.00, 'Sandwich', 'Sandwich', NULL),
(65, 'Barros jarpa', NULL, 3500.00, 'Sandwich', 'Sandwich', NULL),
(66, 'Diputado', NULL, 4000.00, 'Sandwich', 'Sandwich', NULL),
(67, 'Ave luco', NULL, 4000.00, 'Sandwich', 'Sandwich', NULL),
(68, 'Ave palta', NULL, 4000.00, 'Sandwich', 'Sandwich', NULL),
(69, 'Chacarero', NULL, 4800.00, 'Sandwich', 'Sandwich', NULL),
(70, 'Lata', NULL, 1600.00, 'Bebestibles', 'Bebestibles', NULL),
(71, 'Café', '', 1200.00, 'Bebestibles', 'Bebestibles', NULL),
(74, 'Café de máquina', NULL, 2000.00, 'Bebestibles', 'Bebestibles', NULL),
(75, 'Guayaba Leche', '', 3500.00, 'Jugos', 'Jugos', 'Leche'),
(76, 'Frutilla leche', '', 3500.00, 'Jugos', 'Jugos', 'Leche'),
(77, 'Mango leche', '', 3500.00, 'Jugos', 'Jugos', 'Leche'),
(78, 'Maracuya leche', '', 3500.00, 'Jugos', 'Jugos', 'Leche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sandwiches`
--

CREATE TABLE `sandwiches` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'admin', '$2y$10$wH6QwQwQwQwQwQwQwQwQwOQwQwQwQwQwQwQwQwQwQwQwQwQwQwQwQwQwQwQwQwQw'),
(2, 'kevin', '$2y$10$ewMF8IHGQi/Fv/7PW90TmuYO7B6TbPcH9XKwuYsAyETcnxItw1SYu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menu_comida_rapida`
--
ALTER TABLE `menu_comida_rapida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_desayuno`
--
ALTER TABLE `menu_desayuno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sandwiches`
--
ALTER TABLE `sandwiches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menu_comida_rapida`
--
ALTER TABLE `menu_comida_rapida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `menu_desayuno`
--
ALTER TABLE `menu_desayuno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sandwiches`
--
ALTER TABLE `sandwiches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
