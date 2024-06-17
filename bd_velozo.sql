-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 07:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_velozo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `descripcion`, `activo`) VALUES
(1, 'Instantaneo', 1),
(2, 'Capsula', 1),
(3, 'Infusion', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `usuario_id`, `nombre`, `apellido`, `email`, `mensaje`, `activo`) VALUES
(10, 5, 'admin', 'admin', 'admin', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia tenetur quod, dicta neque, delectus excepturi, ratione distinctio voluptatibus beatae minima tempore necessitatibus quas accusamus natus.', 0),
(11, 5, 'admin', 'admin', 'admin', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia tenetur quod, dicta neque, delectus excepturi, ratione distinctio voluptatibus beatae minima tempore necessitatibus quas accusamus natus.', 1),
(12, NULL, 'Agustin', 'Velozo', 'agusvelo04@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia tenetur quod, dicta neque, delectus excepturi, ratione distinctio voluptatibus beatae minima tempore necessitatibus quas accusamus natus.', 0),
(13, NULL, 'Mateo', 'Sosa', 'matthew@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia tenetur quod, dicta neque, delectus excepturi, ratione distinctio voluptatibus beatae minima tempore necessitatibus quas accusamus natus.', 0),
(14, NULL, 'Agustin', 'Velozo', 'agusvelo04@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia tenetur quod, dicta neque, delectus excepturi, ratione distinctio voluptatibus beatae minima tempore necessitatibus quas accusamus natus.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `factura_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total_producto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detalle_factura`
--

INSERT INTO `detalle_factura` (`factura_id`, `producto_id`, `cantidad`, `total_producto`) VALUES
(1, 1, 1, 20),
(1, 3, 2, 40),
(2, 4, 1, 20),
(2, 5, 3, 60),
(3, 2, 1, 20),
(3, 1, 1, 20),
(4, 4, 2, 40),
(5, 1, 1, 20),
(5, 5, 3, 60),
(6, 1, 3, 60),
(6, 3, 1, 20),
(7, 1, 1, 19.99),
(7, 3, 1, 14.5),
(7, 5, 1, 29.99),
(8, 4, 1, 14.5),
(8, 2, 1, 19.99),
(9, 3, 4, 58),
(10, 1, 1, 19.99),
(10, 2, 1, 19.99),
(10, 4, 1, 14.5),
(11, 4, 2, 29),
(12, 2, 2, 39.98),
(12, 4, 4, 58),
(12, 5, 3, 89.97);

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `total_venta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`id_factura`, `usuario_id`, `fecha_venta`, `total_venta`) VALUES
(1, 5, '2023-07-25', 60),
(2, 5, '2023-08-16', 80),
(3, 5, '2023-09-06', 40),
(4, 5, '2023-10-24', 40),
(5, 3, '2023-12-09', 80),
(6, 3, '2024-01-31', 79.97),
(7, 5, '2024-02-16', 64.48),
(8, 3, '2024-03-03', 34.49),
(9, 5, '2024-04-17', 58),
(10, 5, '2024-05-02', 54.48),
(11, 6, '2024-06-16', 29),
(12, 5, '2024-06-17', 187.95);

-- --------------------------------------------------------

--
-- Table structure for table `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perfiles`
--

INSERT INTO `perfiles` (`id`, `descripcion`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float NOT NULL,
  `precio_venta` float NOT NULL,
  `stock` int(128) NOT NULL,
  `stock_minimo` int(128) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `imagen`, `categoria_id`, `precio`, `precio_venta`, `stock`, `stock_minimo`, `activo`) VALUES
(1, 'Classic Roast', '1717030718_8dc2f401626051475ac9.png', 1, 14.99, 19.99, 2, 20, 1),
(2, 'Crimson Roast', '1717030768_cc1b7205783ff34bf6f7.png', 1, 14.99, 19.99, 13, 20, 1),
(3, 'Dawn Delight', '1717030810_060740d41d4ce8e5c093.png', 2, 9.99, 14.5, 15, 20, 1),
(4, 'Decaf Dream', '1717030836_1fc732e568476d0de707.png', 3, 9.99, 14.5, 7, 20, 1),
(5, 'Midnight Magic', '1717030864_282c76ebdc332f308e48.png', 3, 19.99, 29.99, 10, 20, 1),
(6, 'otro ', '1717027231_fbb1768ffe119e175ec5.png', 2, 20, 10, 0, 0, 0),
(7, 'prueba', '1717027537_575439dc098aeeda442a.png', 1, 0, 0, 0, 0, 0),
(8, 'sdfgsdf', '1717022603_22415e0a13005d283cd9.png', 1, 1, 2, 2, 2, 0),
(9, 'otro producto mas', '', 3, 20, 10, 0, 0, 0),
(10, 'PRODUCTOOO', '', 2, 20, 10, 0, 0, 1),
(11, 'Nombre prueba producto', '1717684042_5d098180ce393ff035a1.png', 2, 15.99, 19.99, 15, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `perfil_id` int(11) NOT NULL DEFAULT 2,
  `baja` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `usuario`, `pass`, `perfil_id`, `baja`) VALUES
(2, 'Mateo', 'Sosa', 'matthew@gmail.com', 'Nubes', '$2y$10$lDUJp76.aqdeFb9VJty1meJBydO5j5MqOCfQthhJgQIJwBVtSFIAG', 2, 0),
(3, 'Agustin', 'Velozo', 'agusvelozo04@gmail.com', 'Agustin', '$2y$10$sni91gtfnEy.h1CoRVcfaOJIN8ubf11MrZgkbAZ7jylP/S6mpVw9a', 2, 0),
(4, 'Micaela', 'Wolkowyski', 'mikuw2015@gmail.com', 'Mica', '$2y$10$8.d/Y9HBbV//i3KeL4yIwebrqibMEfYFbaIGXYVBjATgC6SXsl0rK', 2, 1),
(5, 'admin', 'admin', 'admin', 'admin', '$2y$10$ovBN3hbhzAfWqAYS1Dcgueb9ilic34AVKqlZw3g9yLRtY45.sr2ve', 1, 0),
(6, 'Erica', 'Velozo', 'ericavelozo6@gmail.com', 'Erica', '$2y$10$A1cmHlBNdlR6duYCLKKqV.vHwRKB.udKrlxAKONjlTw23ywoNl9ma', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD KEY `factura_id` (`factura_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`);

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
