-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2022 a las 10:29:38
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `slot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game`
--

CREATE TABLE `game` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `score` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `game`
--

INSERT INTO `game` (`id`, `date`, `score`, `user_name`) VALUES
(1343457779, '2022-09-22', 10, 'Pepe'),
(1343457780, '2022-09-25', 155, 'Pepe'),
(1343457781, '2022-09-25', 156, 'Bea'),
(1343457782, '2022-10-22', -1, 'Pepi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_`
--

CREATE TABLE `login_` (
  `name` varchar(30) NOT NULL,
  `dni_user` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `login_`
--

INSERT INTO `login_` (`name`, `dni_user`, `password`) VALUES
('Bea', '33444565J', 'entraraJugar'),
('Manolito', '43442224L', '1234'),
('Pepe', '22444555K', 'Moreno'),
('Pepi', '28442224L', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `dni` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`dni`, `name`, `last_name`, `birthday`, `email`, `phone`) VALUES
('11444555K', 'Manolo', 'Lopez', '0000-00-00', 'manue@pepe.com', '+34777656468'),
('22444555K', 'Pepe', 'Moreno', '2000-02-05', 'pepe@gmail.com', '+34-822666777'),
('28442224L', 'Pepita', 'Creo', '0000-00-00', 'pepi@pepe.com', '+34977778811'),
('33442224L', 'Manolito', 'Lapiz', '0000-00-00', 'mina@pepe.com', '+34677778811'),
('3344222L', 'Manolo', 'Lapiz', '0000-00-00', 'mino@pepe.com', '+34667778811'),
('33444565J', 'Bea', 'Rubia', '1976-02-05', 'beatka@gmail.com', '+40-606060611'),
('43442224L', 'Manolito', 'Lapiz', '0000-00-00', 'mine@pepe.com', '+34777778811');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `date_2` (`date`),
  ADD KEY `user_name` (`user_name`);

--
-- Indices de la tabla `login_`
--
ALTER TABLE `login_`
  ADD PRIMARY KEY (`name`),
  ADD KEY `dni_user` (`dni_user`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `game`
--
ALTER TABLE `game`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1343457783;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `fk_game_user` FOREIGN KEY (`user_name`) REFERENCES `login_` (`name`);

--
-- Filtros para la tabla `login_`
--
ALTER TABLE `login_`
  ADD CONSTRAINT `fk_login_user` FOREIGN KEY (`dni_user`) REFERENCES `user` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
