-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2019 a las 12:15:02
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
-- Base de datos: `encuestasf`
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
('daw201', 'Abc123'),
('daw222', 'daw222');

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
(3, 'daw222', 'DWES'),
(44, 'daw222', 'DIW'),
(47, 'daw222', 'DWEC'),
(48, 'daw201', 'DWES'),
(49, 'daw201', 'DIW'),
(50, 'daw201', 'DWEC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnomodulorespuesta`
--

CREATE TABLE `alumnomodulorespuesta` (
  `id` int(11) NOT NULL,
  `IdAlumno` varchar(10) NOT NULL,
  `IdModulo` varchar(10) NOT NULL,
  `IdRespuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnomodulorespuesta`
--

INSERT INTO `alumnomodulorespuesta` (`id`, `IdAlumno`, `IdModulo`, `IdRespuesta`) VALUES
(30, 'daw201', 'DWES', 33),
(31, 'daw201', 'DWES', 34),
(32, 'daw201', 'DWES', 35),
(33, 'daw201', 'DWES', 36),
(34, 'daw201', 'DWES', 37),
(35, 'daw201', 'DIW', 38),
(36, 'daw201', 'DIW', 39),
(37, 'daw201', 'DIW', 40),
(38, 'daw201', 'DIW', 41),
(39, 'daw201', 'DIW', 42),
(40, 'daw201', 'DWEC', 43),
(41, 'daw201', 'DWEC', 44),
(42, 'daw201', 'DWEC', 45),
(43, 'daw201', 'DWEC', 46),
(44, 'daw201', 'DWEC', 47),
(45, 'daw222', 'DWES', 48),
(46, 'daw222', 'DWES', 49),
(47, 'daw222', 'DWES', 50),
(48, 'daw222', 'DWES', 51),
(49, 'daw222', 'DWES', 52),
(50, 'daw222', 'DIW', 53),
(51, 'daw222', 'DIW', 54),
(52, 'daw222', 'DIW', 55),
(53, 'daw222', 'DIW', 56),
(54, 'daw222', 'DIW', 57),
(55, 'daw222', 'DWEC', 58),
(56, 'daw222', 'DWEC', 59),
(57, 'daw222', 'DWEC', 60),
(58, 'daw222', 'DWEC', 61),
(59, 'daw222', 'DWEC', 62);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` varchar(10) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `curso` int(11) NOT NULL,
  `grupo` varchar(20) NOT NULL,
  `tutor` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `descripcion`, `curso`, `grupo`, `tutor`) VALUES
('DAW2', 'Desarrollo de aplicaciones web', 2, 'GS DAW', 'diego');

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
('DIW', 'Diseño de interfaces web'),
('DWEC', 'Desarrollo web en entorno cliente'),
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
(1, 'DWES', 'DAW2'),
(2, 'DWEC', 'DAW2'),
(3, 'DIW', 'DAW2');

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
(1, 2, '¿Te ha resultado interesante el curso?'),
(2, 1, '¿El profesor te ha motivado?'),
(4, 3, '¿Ha sido bueno el ambiente en clase?'),
(5, 4, 'Lo que se ha hecho bien'),
(6, 5, 'Lo que se puede mejorar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`usuario`, `pass`, `nombre`, `rol`) VALUES
('Ana', 'Ana123', 'AnaBelen', 1),
('diego', 'diego', 'Diego Cordoba', 2),
('fernando', 'Abc123', 'Fernando Aranzabe', 2),
('luisfer', 'luisfer', 'Luis Fernando', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesormodulo`
--

CREATE TABLE `profesormodulo` (
  `id` int(11) NOT NULL,
  `IdProfesor` varchar(15) NOT NULL,
  `IdModulo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesormodulo`
--

INSERT INTO `profesormodulo` (`id`, `IdProfesor`, `IdModulo`) VALUES
(1, 'fernando', 'DWES'),
(2, 'diego', 'DIW'),
(3, 'luisfer', 'DWEC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL,
  `IdPregunta` int(11) NOT NULL,
  `valor` varchar(20) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `IdPregunta`, `valor`, `fecha`) VALUES
(33, 2, '5', '2019-06-01'),
(34, 1, '5', '2019-06-01'),
(35, 4, '5', '2019-06-01'),
(36, 5, 'cyl', '2019-06-01'),
(37, 6, 'fifflyfñ', '2019-06-01'),
(38, 2, '5', '2019-06-01'),
(39, 1, '5', '2019-06-01'),
(40, 4, '5', '2019-06-01'),
(41, 5, 'werty', '2019-06-01'),
(42, 6, 'nbguio', '2019-06-01'),
(43, 2, '5', '2019-06-01'),
(44, 1, '5', '2019-06-01'),
(45, 4, '5', '2019-06-01'),
(46, 5, '`jvtudud', '2019-06-01'),
(47, 6, 'yfhfioñphxa', '2019-06-01'),
(48, 2, '5', '2019-06-01'),
(49, 1, '5', '2019-06-01'),
(50, 4, '5', '2019-06-01'),
(51, 5, 'seaferhbe', '2019-06-01'),
(52, 6, 'fasgebeaba', '2019-06-01'),
(53, 2, '5', '2019-06-01'),
(54, 1, '5', '2019-06-01'),
(55, 4, '5', '2019-06-01'),
(56, 5, 'afgebh6yj', '2019-06-01'),
(57, 6, 'jjhgggrrrrrr', '2019-06-01'),
(58, 2, '1', '2019-06-01'),
(59, 1, '1', '2019-06-01'),
(60, 4, '1', '2019-06-01'),
(61, 5, 'wwwwq', '2019-06-01'),
(62, 6, 'eeeeeee', '2019-06-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(1, 'Director'),
(2, 'Profesor');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno` (`alumno`),
  ADD KEY `IdModulo` (`IdModulo`);

--
-- Indices de la tabla `alumnomodulorespuesta`
--
ALTER TABLE `alumnomodulorespuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IdAlumno` (`IdAlumno`),
  ADD KEY `IdModulo` (`IdModulo`),
  ADD KEY `IdRespuesta` (`IdRespuesta`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor` (`tutor`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulocurso`
--
ALTER TABLE `modulocurso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IdModulo` (`IdModulo`),
  ADD KEY `IdCurso` (`IdCurso`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `IdProfesor` (`IdProfesor`),
  ADD KEY `IdModulo` (`IdModulo`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IdPregunta` (`IdPregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnomodulo`
--
ALTER TABLE `alumnomodulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `alumnomodulorespuesta`
--
ALTER TABLE `alumnomodulorespuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `modulocurso`
--
ALTER TABLE `modulocurso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `profesormodulo`
--
ALTER TABLE `profesormodulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnomodulo`
--
ALTER TABLE `alumnomodulo`
  ADD CONSTRAINT `alumnomodulo_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnomodulo_ibfk_2` FOREIGN KEY (`IdModulo`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumnomodulorespuesta`
--
ALTER TABLE `alumnomodulorespuesta`
  ADD CONSTRAINT `alumnomodulorespuesta_ibfk_1` FOREIGN KEY (`IdAlumno`) REFERENCES `alumno` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnomodulorespuesta_ibfk_2` FOREIGN KEY (`IdModulo`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnomodulorespuesta_ibfk_3` FOREIGN KEY (`IdRespuesta`) REFERENCES `respuesta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`tutor`) REFERENCES `profesor` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modulocurso`
--
ALTER TABLE `modulocurso`
  ADD CONSTRAINT `modulocurso_ibfk_1` FOREIGN KEY (`IdModulo`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modulocurso_ibfk_2` FOREIGN KEY (`IdCurso`) REFERENCES `curso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesormodulo`
--
ALTER TABLE `profesormodulo`
  ADD CONSTRAINT `profesormodulo_ibfk_1` FOREIGN KEY (`IdProfesor`) REFERENCES `profesor` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesormodulo_ibfk_2` FOREIGN KEY (`IdModulo`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`IdPregunta`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
