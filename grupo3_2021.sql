-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2021 a las 12:00:41
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupo3_2021`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `idAlbumes` int(11) NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lanzamiento` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`idAlbumes`, `titulo`, `lanzamiento`) VALUES
(1, 'The Weight of Oceans', 2012),
(2, 'Maggot Brain', 1971),
(3, 'The Great Southern Trendkill', 1996),
(4, 'Libre ©', 2003),
(5, 'Jar of Flies', 1994),
(6, 'Above (Deluxe Edition)', 2013),
(7, 'The Midnight Organ Fight', 2008),
(8, 'Writer\'s Block', 2004);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

CREATE TABLE `artistas` (
  `idArtistas` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `nacionalidad` varchar(64) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`idArtistas`, `nombre`, `nacionalidad`) VALUES
(1, 'In Mourning', 'Suecia'),
(2, 'Funkadelic', 'Estados Unidos'),
(3, 'Pantera', 'Estados Unidos'),
(4, 'Berri Txarrak', 'España'),
(5, 'Alice in Chains', 'Estados Unidos'),
(6, 'Mad Season', 'Estados Unidos'),
(7, 'Frightened Rabbit', 'Reino Unido'),
(8, 'Evergreen Terrace', 'Estados Unidos'),
(11, 'Tim McIlrath', 'Estados Unidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas_albumes`
--

CREATE TABLE `artistas_albumes` (
  `idArtistas` int(11) NOT NULL,
  `idAlbumes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `artistas_albumes`
--

INSERT INTO `artistas_albumes` (`idArtistas`, `idAlbumes`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `idCanciones` int(11) NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `duracion` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `genero` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `cover` tinyint(1) NOT NULL,
  `artistaOriginal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`idCanciones`, `titulo`, `duracion`, `genero`, `cover`, `artistaOriginal`) VALUES
(1, 'Colossus', '9:33', 'Death Metal Melódico Progresivo', 0, 0),
(2, 'Maggot Brain', '10:18', 'Funk Rock', 0, 0),
(3, 'Floods', '7:03', 'Groove Metal', 0, 0),
(4, 'Gezur bat mila aldiz', '4:36', 'Hardcore Melódico', 0, 0),
(5, 'Nutshell', '4:16', 'Grunge', 0, 0),
(6, 'Slip Away', '5:39', 'Rock Alternativo', 0, 0),
(7, 'My Backwards Walk', '3:29', 'Indie Rock', 0, 0),
(8, 'Maniac', '3:13', 'Hardcore Melódico', 1, 0),
(9, 'Denak ez du balio', '4:13', 'Hardcore Melódico', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones_albumes`
--

CREATE TABLE `canciones_albumes` (
  `idAlbumes` int(11) NOT NULL,
  `idCanciones` int(11) NOT NULL,
  `pista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `canciones_albumes`
--

INSERT INTO `canciones_albumes` (`idAlbumes`, `idCanciones`, `pista`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 9),
(4, 4, 11),
(5, 5, 2),
(6, 6, 14),
(7, 7, 9),
(8, 8, 1),
(4, 9, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones_usuarios`
--

CREATE TABLE `canciones_usuarios` (
  `idUsuario` int(11) NOT NULL,
  `idCanciones` int(11) NOT NULL,
  `favorito` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `canciones_usuarios`
--

INSERT INTO `canciones_usuarios` (`idUsuario`, `idCanciones`, `favorito`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `user` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(45) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `user`, `password`) VALUES
(1, 'JuaniDeSaturno', 'f7540352c4e57f9208c415fc1f436202');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`idAlbumes`);

--
-- Indices de la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD PRIMARY KEY (`idArtistas`);

--
-- Indices de la tabla `artistas_albumes`
--
ALTER TABLE `artistas_albumes`
  ADD KEY `FK_ArtistasAlbumes` (`idArtistas`),
  ADD KEY `FK_AlbumesArtistas` (`idAlbumes`);

--
-- Indices de la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD PRIMARY KEY (`idCanciones`),
  ADD KEY `artistaOriginal` (`artistaOriginal`);

--
-- Indices de la tabla `canciones_albumes`
--
ALTER TABLE `canciones_albumes`
  ADD KEY `FK_AlbumesCanciones` (`idAlbumes`) USING BTREE,
  ADD KEY `FK_CancionesAlbumes` (`idCanciones`) USING BTREE;

--
-- Indices de la tabla `canciones_usuarios`
--
ALTER TABLE `canciones_usuarios`
  ADD KEY `FK_UsuariosCanciones` (`idUsuario`) USING BTREE,
  ADD KEY `FK_CancionesUsuarios` (`idCanciones`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `idAlbumes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `artistas`
--
ALTER TABLE `artistas`
  MODIFY `idArtistas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `idCanciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `artistas_albumes`
--
ALTER TABLE `artistas_albumes`
  ADD CONSTRAINT `FK_AlbumesArtistas` FOREIGN KEY (`idAlbumes`) REFERENCES `albumes` (`idAlbumes`),
  ADD CONSTRAINT `FK_ArtistasAlbumes` FOREIGN KEY (`idArtistas`) REFERENCES `artistas` (`idArtistas`);

--
-- Filtros para la tabla `canciones_albumes`
--
ALTER TABLE `canciones_albumes`
  ADD CONSTRAINT `FK_Albumes` FOREIGN KEY (`idAlbumes`) REFERENCES `albumes` (`idAlbumes`),
  ADD CONSTRAINT `FK_CancionesFK` FOREIGN KEY (`idCanciones`) REFERENCES `canciones` (`idCanciones`);

--
-- Filtros para la tabla `canciones_usuarios`
--
ALTER TABLE `canciones_usuarios`
  ADD CONSTRAINT `FK_Canciones` FOREIGN KEY (`idCanciones`) REFERENCES `canciones` (`idCanciones`),
  ADD CONSTRAINT `FK_Usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
