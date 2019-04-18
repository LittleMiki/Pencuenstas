-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2019 a las 15:54:15
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
(1, 'daw201', 'DWES'),
(3, 'daw222', 'DWES');

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
(1, 'daw222', 'DIW', 1),
(2, 'daw222', 'DIW', 2),
(3, 'daw222', 'DIW', 3),
(4, 'daw222', 'DWEC', 4),
(5, 'daw222', 'DWEC', 5),
(6, 'daw222', 'DWEC', 6);

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
(4, 3, '¿Ha sido bueno el ambiente en clase?');

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
('diego', 'diego', 'Diego Cordoba'),
('fernando', 'Abc123', 'Fernando Aranzabe'),
('luisfer', 'luisfer', 'Luis Fernando');

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
  `valor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `IdPregunta`, `valor`) VALUES
(1, 2, '3'),
(2, 1, '4'),
(3, 4, '3'),
(4, 2, '3'),
(5, 1, '4'),
(6, 4, '2');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `alumnomodulorespuesta`
--
ALTER TABLE `alumnomodulorespuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `modulocurso`
--
ALTER TABLE `modulocurso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesormodulo`
--
ALTER TABLE `profesormodulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
