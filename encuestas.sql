-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2019 a las 14:38:19
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `encuestas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`usuario`, `pass`) VALUES
('daw201', 'Abc123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnomodulo`
--

CREATE TABLE `alumnomodulo` (
  `id` int(11) NOT NULL,
  `alumno` varchar(30) NOT NULL,
  `IdModulo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnomodulo`
--

INSERT INTO `alumnomodulo` (`id`, `alumno`, `IdModulo`) VALUES
(1, 'daw201', 'DWES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnomoduloencuesta`
--

CREATE TABLE `alumnomoduloencuesta` (
  `id` int(11) NOT NULL,
  `IdAlumno` varchar(10) NOT NULL,
  `IdModulo` varchar(10) NOT NULL,
  `IdEncuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnomoduloencuesta`
--

INSERT INTO `alumnomoduloencuesta` (`id`, `IdAlumno`, `IdModulo`, `IdEncuesta`) VALUES
(1, 'daw201', 'DWES', 1),
(2, 'daw201', 'DWES', 2),
(3, 'daw201', 'DWES', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` varchar(10) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `curso` int(11) NOT NULL,
  `grupo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `descripcion`, `curso`, `grupo`) VALUES
('DAW2', 'Desarrollo de aplicaciones web', 2, 'GS DAW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `respuesta` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `orden`, `respuesta`) VALUES
(1, 1, '5'),
(2, 2, '5'),
(3, 3, '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestapregunta`
--

CREATE TABLE `encuestapregunta` (
  `id` int(11) NOT NULL,
  `IdEncuesta` varchar(15) NOT NULL,
  `IdPregunta` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encuestapregunta`
--

INSERT INTO `encuestapregunta` (`id`, `IdEncuesta`, `IdPregunta`) VALUES
(1, '1', '1'),
(2, '2', '2'),
(3, '3', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id` varchar(10) NOT NULL,
  `descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id`, `descripcion`) VALUES
('DWES', 'Desarrollo web en entorno servidor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulocurso`
--

CREATE TABLE `modulocurso` (
  `id` int(11) NOT NULL,
  `IdModulo` varchar(15) NOT NULL,
  `IdCurso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulocurso`
--

INSERT INTO `modulocurso` (`id`, `IdModulo`, `IdCurso`) VALUES
(1, 'DWES', 'DAW2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `pregunta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `orden`, `pregunta`) VALUES
(1, 1, '¿Como te ha resultado el curso?'),
(2, 2, '¿El profesor te ha motivado?'),
(3, 3, '¿Ha sido bueno el ambiente en clase?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`usuario`, `pass`, `nombre`) VALUES
('fernando', 'Abc123', 'Fernando Aranzabe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesormodulo`
--

CREATE TABLE `profesormodulo` (
  `id` int(11) NOT NULL,
  `IdProfesor` varchar(10) NOT NULL,
  `IdModulo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesormodulo`
--

INSERT INTO `profesormodulo` (`id`, `IdProfesor`, `IdModulo`) VALUES
(1, 'fernando', 'DWES');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `alumnomodulo`
--
ALTER TABLE `alumnomodulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumnomoduloencuesta`
--
ALTER TABLE `alumnomoduloencuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuestapregunta`
--
ALTER TABLE `encuestapregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulocurso`
--
ALTER TABLE `modulocurso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `profesormodulo`
--
ALTER TABLE `profesormodulo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnomodulo`
--
ALTER TABLE `alumnomodulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnomoduloencuesta`
--
ALTER TABLE `alumnomoduloencuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `encuestapregunta`
--
ALTER TABLE `encuestapregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modulocurso`
--
ALTER TABLE `modulocurso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesormodulo`
--
ALTER TABLE `profesormodulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
