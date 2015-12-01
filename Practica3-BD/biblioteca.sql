-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2015 a las 20:06:16
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `idAutores` varchar(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nacionalidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`idAutores`, `nombre`, `apellidos`, `nacionalidad`) VALUES
('AG-', 'Abbi', 'Glines', 'Estadounidense'),
('AMF', 'Amaya', 'Felices', 'Española'),
('ARG', 'Arthur', 'Golden', 'Estadounidense'),
('BS-', 'Abraham', 'Stoker', 'Irlandesa'),
('DSF', 'Diane', 'Setterfield', 'Inglesa'),
('DZS', 'David', 'Zurdo Saiz', 'Española'),
('JA-', 'Javier', 'Arribas', 'Española'),
('LGG', 'Laura', 'Gallego Garcia', 'Española'),
('LGL', 'Lucia', 'Gonzalez Lavado', 'Española'),
('MGP', 'Marcia', 'Grad Power', 'Estadounidense'),
('SMM', 'Stephenie', 'Meyer', 'Estadounidense'),
('STK', 'Stephen', 'King', 'Estadounidense');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategorias` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategorias`) VALUES
('Novela'),
('Poesia'),
('Teatro'),
('Teatro-poetico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `idEditorial` int(3) NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `pais` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`idEditorial`, `nombre`, `pais`) VALUES
(1, 'Maeva', 'España'),
(2, 'Kiwi Ediciones', 'España'),
(3, 'Obelisco Ediciones', 'España'),
(4, 'Circulo de Lectores', 'España'),
(5, 'Roca Editorial', 'España'),
(6, 'Edimat Libros', 'España'),
(7, 'DeBolsillo', 'España'),
(8, 'Alberto Santos Editorial', 'España'),
(9, 'Serie Joven', 'España'),
(10, 'Swing', 'España');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `idGeneros` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`idGeneros`) VALUES
('Ciencia-Ficcion'),
('Clasicos'),
('Crimen'),
('Fantasia'),
('Filosofia'),
('Historia'),
('Misterio'),
('New adult'),
('Policiaca'),
('Young-Adult');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `isbn` bigint(13) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `idEditorial` int(3) NOT NULL,
  `idAutores` varchar(3) NOT NULL,
  `paginas` int(4) NOT NULL,
  `idGeneros` varchar(30) NOT NULL,
  `idCategorias` varchar(15) NOT NULL,
  `anioEdicion` year(4) NOT NULL,
  `precio` double NOT NULL,
  `prestado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`isbn`, `titulo`, `idEditorial`, `idAutores`, `paginas`, `idGeneros`, `idCategorias`, `anioEdicion`, `precio`, `prestado`) VALUES
(12345, 'Un libro de prueba', 7, 'SMM', 169, 'Misterio', 'Teatro', 1990, 9.85, 1),
(8422682150, 'Memorias de una Geisha', 4, 'ARG', 573, 'Historia', 'Novela', 2006, 19.9, 0),
(8493509710, 'El ultimo secreto de Da Vinci', 10, 'DZS', 351, 'Historia', 'Novela', 2006, 8.95, 0),
(8496544826, 'Los circulos de Dante', 5, 'JA-', 348, 'Misterio', 'Novela', 2006, 20, 0),
(9788415238393, 'Cronicas de las sombras 1', 8, 'LGL', 304, 'Fantasia', 'Novela', 2012, 16.9, 0),
(9788467222319, 'El cuento numero 13', 4, 'DSF', 412, 'Crimen', 'Novela', 2011, 9.95, 0),
(9788467240412, 'La segunda vida de Bree Tanner', 4, 'SMM', 175, 'Fantasia', 'Novela', 2010, 14.96, 0),
(9788477206231, 'La princesa que creia en los cuentos de hadas', 3, 'MGP', 221, 'Filosofia', 'Novela', 1998, 10.5, 0),
(9788492826353, 'Pacto de piel', 9, 'AMF', 126, 'Fantasia', 'Novela', 2012, 13.5, 0),
(9788494236334, 'Respira', 2, 'AG-', 295, 'Young-Adult', 'Novela', 2014, 17.9, 0),
(9788497645515, 'Dracula', 6, 'BS-', 393, 'Clasicos', 'Novela', 2008, 9.95, 0),
(9788497931021, 'El misterio de Salems Lot', 7, 'STK', 526, 'Misterio', 'Novela', 2013, 9.95, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`idAutores`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategorias`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`idEditorial`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`idGeneros`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `idEditorial` (`idEditorial`),
  ADD KEY `idAutores` (`idAutores`),
  ADD KEY `idGeneros` (`idGeneros`(1)),
  ADD KEY `idCategorias` (`idCategorias`(1));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`idEditorial`) REFERENCES `editorial` (`idEditorial`) ON UPDATE CASCADE,
  ADD CONSTRAINT `libros_ibfk_4` FOREIGN KEY (`idAutores`) REFERENCES `autores` (`idAutores`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
