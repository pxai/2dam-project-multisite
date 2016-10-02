-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2016 a las 08:56:02
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `multisite_rest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beat`
--

CREATE TABLE `beat` (
  `id` int(11) NOT NULL,
  `message` varchar(140) NOT NULL,
  `beat_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `idfrom` int(11) NOT NULL,
  `idto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `beat`
--

INSERT INTO `beat` (`id`, `message`, `beat_date`, `latitude`, `longitude`, `idfrom`, `idto`) VALUES
(1, 'Hola', '2016-10-01 21:42:53', 0, 0, 1, 1),
(2, 'Me acuerdo de ti', '2016-10-01 21:42:53', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chatgroup`
--

CREATE TABLE `chatgroup` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `since` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chatgroup_message`
--

CREATE TABLE `chatgroup_message` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chatgroup_user`
--

CREATE TABLE `chatgroup_user` (
  `idchatgroup` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `since` datetime NOT NULL,
  `isadmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `since` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `iduser` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `class`
--

INSERT INTO `class` (`id`, `name`, `description`, `since`, `iduser`) VALUES
(1, 'Curso de Android', 'Curso acelerado de Android', '2016-10-01 16:00:08', 1),
(2, 'Curso de Git', 'Curso acelerado de Git', '2016-10-01 16:01:05', 1),
(3, 'Curso de Grunt', 'Curso breve sobre Grunt', '2016-10-01 16:01:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `event_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `event`
--

INSERT INTO `event` (`id`, `name`, `description`, `event_date`, `latitude`, `longitude`, `iduser`) VALUES
(1, 'Bolsa de comida', 'Consigues una bolsa de comida', '2016-10-01 16:48:00', 0, 0, 1),
(2, 'Horda Zombie', 'Aparecen varios zombies ante ti', '2016-10-01 16:48:00', 0, 0, 1),
(3, 'Bolsa de comida', 'Consigues una bolsa de comida', '2016-10-01 16:48:16', 0, 0, 1),
(4, 'Horda Zombie', 'Aparecen varios zombies ante ti', '2016-10-01 16:48:16', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idea`
--

CREATE TABLE `idea` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `idea_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `idea`
--

INSERT INTO `idea` (`id`, `name`, `description`, `idea_date`, `iduser`) VALUES
(1, 'Automatic Hammer', 'Automatic hammer with simple batteries.', '2016-10-02 08:29:53', 1),
(2, 'Bathroom chair', 'Special living room chair with a hole to make poo while you watch the news', '2016-10-02 08:29:53', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id`, `name`, `description`, `status`, `last_update`) VALUES
(1, 'aaaa', 'bbbbb', 1, '2016-10-01 13:30:33'),
(2, 'cccc', 'ddddd', 3, '2016-10-01 13:30:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meetup`
--

CREATE TABLE `meetup` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `since` datetime NOT NULL,
  `meetup_date` datetime NOT NULL,
  `open` int(11) NOT NULL DEFAULT '1',
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `meetup`
--

INSERT INTO `meetup` (`id`, `name`, `description`, `since`, `meetup_date`, `open`, `iduser`) VALUES
(1, 'Caza de Pokemon', 'Quedada para pillar pokemons', '2016-10-09 00:00:00', '2016-10-25 00:00:00', 1, 1),
(2, 'Estudiar Android', 'Quedada para estudiar Android', '2016-10-10 00:00:00', '2016-10-24 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@fake.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_role`
--

CREATE TABLE `user_role` (
  `iduser` int(11) NOT NULL,
  `idrole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beat`
--
ALTER TABLE `beat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idto` (`idto`),
  ADD KEY `idfrom` (`idfrom`);

--
-- Indices de la tabla `chatgroup`
--
ALTER TABLE `chatgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chatgroup_message`
--
ALTER TABLE `chatgroup_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idgroup` (`idgroup`);

--
-- Indices de la tabla `chatgroup_user`
--
ALTER TABLE `chatgroup_user`
  ADD PRIMARY KEY (`idchatgroup`,`iduser`),
  ADD KEY `idchatgroup` (`idchatgroup`),
  ADD KEY `iduser` (`iduser`);

--
-- Indices de la tabla `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`);

--
-- Indices de la tabla `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`);

--
-- Indices de la tabla `idea`
--
ALTER TABLE `idea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`);

--
-- Indices de la tabla `meetup`
--
ALTER TABLE `meetup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`iduser`,`idrole`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idrole` (`idrole`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beat`
--
ALTER TABLE `beat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `chatgroup`
--
ALTER TABLE `chatgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `chatgroup_message`
--
ALTER TABLE `chatgroup_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `idea`
--
ALTER TABLE `idea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `meetup`
--
ALTER TABLE `meetup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
