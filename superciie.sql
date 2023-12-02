-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2023 a las 03:12:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `superciie`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `area` varchar(40) NOT NULL,
  `idArea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`area`, `idArea`) VALUES
('Enseñanza', 1),
('Soberanía Científica', 2),
('Informatica', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `dniAlumno` varchar(10) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`dniAlumno`, `idCurso`, `estado`) VALUES
('0', 1, 'Aprobado'),
('46087782', 1, 'Aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursantearea`
--

CREATE TABLE `cursantearea` (
  `dni` varchar(10) NOT NULL,
  `idArea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursantearea`
--

INSERT INTO `cursantearea` (`dni`, `idArea`) VALUES
('0', 1),
('0', 2),
('46087782', 2),
('234314143', 2),
('46087620', 1),
('46087620', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursantenivel`
--

CREATE TABLE `cursantenivel` (
  `dni` varchar(10) NOT NULL,
  `idNivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursantenivel`
--

INSERT INTO `cursantenivel` (`dni`, `idNivel`) VALUES
('0', 1),
('0', 2),
('46087782', 1),
('46087782', 2),
('234314143', 1),
('46087620', 1),
('46087620', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursoalumnos`
--

CREATE TABLE `cursoalumnos` (
  `dniAlumno` varchar(10) NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursoalumnos`
--

INSERT INTO `cursoalumnos` (`dniAlumno`, `idCurso`) VALUES
('0', 1),
('46087782', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursoareas`
--

CREATE TABLE `cursoareas` (
  `idArea` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursoareas`
--

INSERT INTO `cursoareas` (`idArea`, `idCurso`) VALUES
(2, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursocertificado`
--

CREATE TABLE `cursocertificado` (
  `id` int(11) NOT NULL,
  `dniAlumno` varchar(10) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `fechaEmision` datetime NOT NULL,
  `fechaRetiro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursocertificado`
--

INSERT INTO `cursocertificado` (`id`, `dniAlumno`, `idCurso`, `fechaEmision`, `fechaRetiro`) VALUES
(160, '0', 1, '2023-11-02 16:04:42', '2023-11-02 16:04:46'),
(161, '0', 1, '2023-11-02 16:05:09', NULL),
(162, '0', 1, '2023-11-02 16:24:11', NULL),
(163, '0', 1, '2023-11-02 16:24:12', NULL),
(164, '0', 1, '2023-11-02 16:24:13', NULL),
(165, '0', 1, '2023-11-02 16:24:14', NULL),
(166, '0', 1, '2023-11-02 16:24:14', NULL),
(167, '0', 1, '2023-11-02 16:24:15', NULL),
(168, '0', 1, '2023-11-02 16:24:15', NULL),
(169, '0', 1, '2023-11-02 16:24:15', NULL),
(170, '0', 1, '2023-11-02 16:24:16', '2023-11-02 16:24:19'),
(171, '0', 1, '2023-11-02 16:24:21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursocronograma`
--

CREATE TABLE `cursocronograma` (
  `dia` varchar(10) NOT NULL,
  `horario` varchar(5) NOT NULL,
  `presencialidad` varchar(10) NOT NULL,
  `idCronograma` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursocronograma`
--

INSERT INTO `cursocronograma` (`dia`, `horario`, `presencialidad`, `idCronograma`, `idcurso`, `fecha`) VALUES
('Lunes', '02:01', 'Presencial', 6, 3, '2023-11-17'),
('Lunes', '21:45', 'Presencial', 7, 1, '2023-11-23'),
('Lunes', '21:45', 'Presencial', 8, 1, '2023-11-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursoestados`
--

CREATE TABLE `cursoestados` (
  `estado` varchar(20) NOT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursoestados`
--

INSERT INTO `cursoestados` (`estado`, `idEstado`) VALUES
('Disponible', 1),
('Fuera de servicio', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursoniveles`
--

CREATE TABLE `cursoniveles` (
  `idNivel` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursoniveles`
--

INSERT INTO `cursoniveles` (`idNivel`, `idCurso`) VALUES
(1, 1),
(1, 1),
(3, 2),
(4, 3),
(2, 4),
(1, 5),
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursopresentismo`
--

CREATE TABLE `cursopresentismo` (
  `fecha` datetime NOT NULL,
  `dniAlumno` varchar(10) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursopresentismo`
--

INSERT INTO `cursopresentismo` (`fecha`, `dniAlumno`, `idCurso`, `estado`) VALUES
('2023-11-02 00:00:00', '0', 1, 'Presente'),
('2023-11-02 00:00:00', '46087782', 1, 'Presente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `curso` varchar(70) NOT NULL,
  `destinatarios` varchar(300) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `dniprofesor` varchar(10) NOT NULL,
  `idestado` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFinal` date DEFAULT NULL,
  `resolucion` varchar(10) NOT NULL,
  `dictamen` varchar(20) NOT NULL,
  `nroProyecto` varchar(10) NOT NULL,
  `puntaje` float NOT NULL,
  `cargaHoraria` varchar(30) NOT NULL,
  `vacantes` int(11) NOT NULL,
  `imagenCurso` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`curso`, `destinatarios`, `descripcion`, `idCurso`, `dniprofesor`, `idestado`, `fechaInicio`, `fechaFinal`, `resolucion`, `dictamen`, `nroProyecto`, `puntaje`, `cargaHoraria`, `vacantes`, `imagenCurso`) VALUES
('Desarrollo web full stack 2', 'El curso de Desarrollo Web Full Stack está dirigido a quienes buscan dominar la creación de aplicaciones web integrales. Aprenderás desde HTML, CSS y JavaScript hasta tecnologías avanzadas como React, Node.js y bases de datos, brindando habilidades completas para desarrollar soluciones dinámicas', '123123', 1, '49248542', 2, '2023-09-15', '2023-11-10', '123', '123129', '122/11', 50, '200hs', 50, 'imagenCurso/desarrollowebfullstack.jpg'),
('Historia argentina', 'El Curso de Historia Argentina ofrece un recorrido apasionante desde la conquista hasta la actualidad. Dirigido a estudiantes, profesionales y el público en general, explora eventos clave, líderes y transformaciones que han moldeado la identidad y el desarrollo de Argentina', 'Savio', 2, '4593532643', 2, '2023-11-16', '2023-11-17', '144', '144', '15321a', 100, '150 horas', 100, 'imagenCurso/historia.jpg'),
('Taller de actuación profesional', 'El Taller de Actuación Profesional es perfecto para actores en formación o con experiencia, artistas escénicos y entusiastas del teatro que buscan desarrollar habilidades profesionales en actuación. Ideal para aquellos que desean perfeccionar técnicas, explorar nuevas metodologías y profundizar en l', 'Pilar', 3, '4256433754', 1, '2023-11-16', '2023-11-17', '1', '1', '1', 1, '250 Horas', 499, 'imagenCurso/actuacion.jpg'),
('Desarrollo de aplicaciones web dinamicas', 'está dirigido a estudiantes de informática, desarrolladores y profesionales interesados en dominar tecnologías modernas para crear aplicaciones web interactivas y ágiles. Aborda desde los conceptos básicos hasta estrategias avanzadas de diseño y programación, incluyendo frameworks y herramientas par', 'Savio', 4, '2318941241', 1, '2023-11-30', '2023-12-30', 'si', 'si', 'r121r1532', 2225, '240 horas', 30, 'imagenCurso/dinamicas.jpg'),
('Curso de Baile artístico y urbano', 'Este curso de Baile Artístico y Urbano está diseñado para bailarines de todos los niveles, desde principiantes hasta intermedios, y entusiastas de la danza que buscan explorar estilos urbanos y artísticos. Ideal para aquellos con pasión por la expresión corporal y el arte del movimiento', 'Del viso', 5, '363673', 1, '2023-11-30', '2024-02-17', 'sfdgsd', 'si', '1253252dsg', 2444, '450 Horas', 75, 'imagenCurso/baile.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursosedes`
--

CREATE TABLE `cursosedes` (
  `idSede` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursosedes`
--

INSERT INTO `cursosedes` (`idSede`, `idCurso`) VALUES
(1, 4),
(1, 2),
(1, 1),
(1, 3),
(1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `nivel` varchar(40) NOT NULL,
  `idNivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`nivel`, `idNivel`) VALUES
('Inicial', 1),
('Primario', 2),
('Secundario', 3),
('Terciario', 4),
('Avanzado', 5),
('uno', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE `novedades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `novedad` text NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passwordreset`
--

CREATE TABLE `passwordreset` (
  `resetID` varchar(30) NOT NULL,
  `pin` int(11) NOT NULL,
  `expirationTime` datetime NOT NULL,
  `dniUsuario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `passwordreset`
--

INSERT INTO `passwordreset` (`resetID`, `pin`, `expirationTime`, `dniUsuario`) VALUES
('65400634140b0', 264444, '2023-10-30 19:58:28', '46087782'),
('654006963b1e0', 797477, '2023-10-30 20:00:06', '46087782'),
('65400697ee7a6', 487889, '2023-10-30 20:00:07', '46087782'),
('65400698b9326', 443165, '2023-10-30 20:00:08', '46087782'),
('6540069978950', 821356, '2023-10-30 20:00:09', '46087782'),
('6540078730e5b', 599712, '2023-10-30 20:04:07', '46087782'),
('65402e1612ed6', 495493, '2023-10-30 22:48:38', '46087782'),
('65402e2157e1d', 125780, '2023-10-30 22:48:49', '46087782'),
('65402e22369b2', 936982, '2023-10-30 22:48:50', '46087782'),
('65402e4532e8f', 302227, '2023-10-30 22:49:25', '46087782'),
('65402f6b73ac9', 894962, '2023-10-30 22:54:19', '46087782'),
('65402ffb59f01', 422081, '2023-10-30 22:56:43', '46087782'),
('6540300168d2a', 693293, '2023-10-30 22:56:49', '46087782'),
('6540305e1ba96', 350494, '2023-10-30 22:58:22', '46087782'),
('65403075a740e', 177985, '2023-10-30 22:58:45', '46087782'),
('6540307685b29', 738312, '2023-10-30 22:58:46', '46087782'),
('65403077b2f6a', 654103, '2023-10-30 22:58:47', '46087782'),
('654030781bcec', 342429, '2023-10-30 22:58:48', '46087782'),
('654030786524e', 448679, '2023-10-30 22:58:48', '46087782'),
('65403078b1a31', 715032, '2023-10-30 22:58:48', '46087782'),
('65403078f1fba', 844632, '2023-10-30 22:58:48', '46087782'),
('654030793b01c', 865364, '2023-10-30 22:58:49', '46087782'),
('6540307969474', 710223, '2023-10-30 22:58:49', '46087782'),
('6540307980161', 653440, '2023-10-30 22:58:49', '46087782'),
('65403079c8c85', 835988, '2023-10-30 22:58:49', '46087782'),
('6540307a09eed', 667072, '2023-10-30 22:58:50', '46087782'),
('6540307a32e05', 805939, '2023-10-30 22:58:50', '46087782'),
('6540307ab29cd', 256410, '2023-10-30 22:58:50', '46087782'),
('654030866365d', 830787, '2023-10-30 22:59:02', '46087782'),
('654030e26605e', 789452, '2023-10-30 23:00:34', '46087782'),
('65403287431bf', 926123, '2023-10-30 23:07:35', '46087782'),
('654032cb85739', 786692, '2023-10-30 23:08:43', '46087782'),
('654032d3dfbef', 126615, '2023-10-30 23:08:51', '46087782'),
('654033522b98b', 357743, '2023-10-30 23:10:58', '46087782'),
('6540335838801', 321880, '2023-10-30 23:11:04', '46087782'),
('6540335cba972', 951423, '2023-10-30 23:11:08', '46087782'),
('654033722ed1b', 299489, '2023-10-30 23:11:30', '46087782'),
('6540341b98992', 884208, '2023-10-30 23:14:19', '46087782'),
('6540350bdf487', 295169, '2023-10-30 23:18:19', '46087782'),
('65403532164aa', 846994, '2023-10-30 23:18:58', '46087782'),
('65403550e17f5', 529883, '2023-10-30 23:19:28', '46087782'),
('654036214b1fb', 646124, '2023-10-30 23:22:57', '46087782'),
('6540363cb54c6', 878374, '2023-10-30 23:23:24', '46087782'),
('65403674e9b9a', 608667, '2023-10-30 23:24:20', '46087782'),
('6540398b0b63c', 366400, '2023-10-30 23:37:31', '46087782'),
('654039ec5bc22', 781878, '2023-10-30 23:39:08', '46087782'),
('65403a3a74485', 265939, '2023-10-30 23:40:26', '46087782'),
('65403a77d46d6', 467697, '2023-10-30 23:41:27', '46087782'),
('65403ac258ed5', 130760, '2023-10-30 23:42:42', '46087782'),
('65403add17dfa', 739278, '2023-10-30 23:43:09', '46087782'),
('65403aebc8f54', 617615, '2023-10-30 23:43:23', '46087782'),
('65403b04c66c0', 284651, '2023-10-30 23:43:48', '46087782'),
('65403b2672f67', 697933, '2023-10-30 23:44:22', '46087782'),
('65403b436ea52', 794476, '2023-10-30 23:44:51', '46087782'),
('65403b6312eaa', 653546, '2023-10-30 23:45:23', '46087782'),
('65403bc00b95a', 592492, '2023-10-30 23:46:56', '46087782'),
('65403bfb719f4', 612306, '2023-10-30 23:47:55', '46087782'),
('65403c7c491bd', 695697, '2023-10-30 23:50:04', '46087782'),
('65403eb98247a', 420821, '2023-10-30 23:59:37', '46087782'),
('65416f82190ce', 782797, '2023-10-31 21:40:02', '46087782'),
('65416f842cb22', 995745, '2023-10-31 21:40:04', '46087782'),
('654172ef11366', 123759, '2023-10-31 21:54:39', '46087620'),
('6541912056f79', 511883, '2023-11-01 00:03:28', '46087782');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `sede` varchar(50) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `altura` varchar(20) DEFAULT NULL,
  `localidad` varchar(40) NOT NULL,
  `idSede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`sede`, `direccion`, `altura`, `localidad`, `idSede`) VALUES
('EP NRO 1', 'PELLEGRINI', '351', 'Belén de Escobar', 1),
('CENTRO DE VETERANOS', 'INDEPENDENCIA ', '406', 'Belén de Escobar', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposcuenta`
--

CREATE TABLE `tiposcuenta` (
  `idTipoCuenta` int(11) NOT NULL,
  `tipoCuenta` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiposcuenta`
--

INSERT INTO `tiposcuenta` (`idTipoCuenta`, `tipoCuenta`) VALUES
(1, 'Cursante'),
(2, 'ETR'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `idTipoCuenta` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellido`, `password`, `telefono`, `correo`, `estado`, `idTipoCuenta`, `imagen`) VALUES
('0', 'usuario', 'normal', '000', '112233', 'pepe@pepe.com', 1, 1, NULL),
('1', 'admin', 'Admin232323', 'admin', '1122334455', 'admin@admin.com', 1, 3, ''),
('2318941241', 'Ruben', 'Fiorini', '24142151', '1124152352', 'rubenfiorini@gmail.com', 1, 2, NULL),
('234314143', 'Nicolas', 'Godoy Hassan', 'qweqwe123!Q', '123123123', 'soy un correo', 1, 1, NULL),
('363673', 'Valeria', 'Herrera', '461356436', '11253464457', 'valeriaherra@gmail.com', 1, 2, 'img\\sour-moha-GslZrjMmLVY-unsplash.jpg'),
('4256433754', 'Leonardo', 'DiCaprio', '4124125', '115235322664', 'leo@gmail.com', 1, 2, 'img/leo.jpg'),
('4593532643', 'Alejandro', 'García', '4324235662', '112523592689', 'alejandrogarcia1@gmail.com', 1, 2, 'img\\fabio-lucas-g5tvZdOK0EM-unsplash.jpg'),
('46087620', 'Eliana', 'Medina', 'Marshmello@10', '1134643722', 'elianamedinayt@gmail.com', 1, 1, NULL),
('46087782', 'Nicolas', 'Godoy Hassan', 'milanesa', '1123576358', 'ngodoyhassan@gmail.com', 1, 1, NULL),
('49248542', 'Angela', 'Hahn', '2134124', '1211241', 'hahn@gmail.com', 1, 2, 'img/profehahn.jpg'),
('666', 'etr', 'etr', '666', '112233', 'ieie@pepe.com', 1, 2, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`idArea`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD KEY `dniAlumno` (`dniAlumno`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `cursantearea`
--
ALTER TABLE `cursantearea`
  ADD KEY `dni` (`dni`),
  ADD KEY `idArea` (`idArea`);

--
-- Indices de la tabla `cursantenivel`
--
ALTER TABLE `cursantenivel`
  ADD KEY `dni` (`dni`),
  ADD KEY `idNivel` (`idNivel`);

--
-- Indices de la tabla `cursoalumnos`
--
ALTER TABLE `cursoalumnos`
  ADD KEY `dniAlumno` (`dniAlumno`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `cursoareas`
--
ALTER TABLE `cursoareas`
  ADD KEY `idArea` (`idArea`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `cursocertificado`
--
ALTER TABLE `cursocertificado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dniAlumno` (`dniAlumno`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `cursocronograma`
--
ALTER TABLE `cursocronograma`
  ADD PRIMARY KEY (`idCronograma`),
  ADD KEY `idcurso` (`idcurso`);

--
-- Indices de la tabla `cursoestados`
--
ALTER TABLE `cursoestados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `cursoniveles`
--
ALTER TABLE `cursoniveles`
  ADD KEY `idNivel` (`idNivel`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `cursopresentismo`
--
ALTER TABLE `cursopresentismo`
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCurso`),
  ADD KEY `dniprofesor` (`dniprofesor`),
  ADD KEY `idestado` (`idestado`);

--
-- Indices de la tabla `cursosedes`
--
ALTER TABLE `cursosedes`
  ADD KEY `idSede` (`idSede`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`idNivel`);

--
-- Indices de la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`resetID`),
  ADD KEY `dniUsuario` (`dniUsuario`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`idSede`);

--
-- Indices de la tabla `tiposcuenta`
--
ALTER TABLE `tiposcuenta`
  ADD PRIMARY KEY (`idTipoCuenta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `idTipoCuenta` (`idTipoCuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cursocertificado`
--
ALTER TABLE `cursocertificado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT de la tabla `cursocronograma`
--
ALTER TABLE `cursocronograma`
  MODIFY `idCronograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cursoestados`
--
ALTER TABLE `cursoestados`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `idNivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `idSede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tiposcuenta`
--
ALTER TABLE `tiposcuenta`
  MODIFY `idTipoCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`dniAlumno`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`);

--
-- Filtros para la tabla `cursantearea`
--
ALTER TABLE `cursantearea`
  ADD CONSTRAINT `cursantearea_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `cursantearea_ibfk_2` FOREIGN KEY (`idArea`) REFERENCES `areas` (`idArea`);

--
-- Filtros para la tabla `cursantenivel`
--
ALTER TABLE `cursantenivel`
  ADD CONSTRAINT `cursantenivel_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `cursantenivel_ibfk_2` FOREIGN KEY (`idNivel`) REFERENCES `niveles` (`idNivel`);

--
-- Filtros para la tabla `cursoalumnos`
--
ALTER TABLE `cursoalumnos`
  ADD CONSTRAINT `cursoalumnos_ibfk_1` FOREIGN KEY (`dniAlumno`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `cursoalumnos_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`);

--
-- Filtros para la tabla `cursoareas`
--
ALTER TABLE `cursoareas`
  ADD CONSTRAINT `cursoareas_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `areas` (`idArea`),
  ADD CONSTRAINT `cursoareas_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`);

--
-- Filtros para la tabla `cursocertificado`
--
ALTER TABLE `cursocertificado`
  ADD CONSTRAINT `cursocertificado_ibfk_1` FOREIGN KEY (`dniAlumno`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `cursocertificado_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`);

--
-- Filtros para la tabla `cursocronograma`
--
ALTER TABLE `cursocronograma`
  ADD CONSTRAINT `cursocronograma_ibfk_1` FOREIGN KEY (`idcurso`) REFERENCES `cursos` (`idCurso`);

--
-- Filtros para la tabla `cursoniveles`
--
ALTER TABLE `cursoniveles`
  ADD CONSTRAINT `cursoniveles_ibfk_1` FOREIGN KEY (`idNivel`) REFERENCES `niveles` (`idNivel`),
  ADD CONSTRAINT `cursoniveles_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`);

--
-- Filtros para la tabla `cursopresentismo`
--
ALTER TABLE `cursopresentismo`
  ADD CONSTRAINT `cursopresentismo_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`dniprofesor`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`idestado`) REFERENCES `cursoestados` (`idEstado`);

--
-- Filtros para la tabla `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD CONSTRAINT `passwordreset_ibfk_1` FOREIGN KEY (`dniUsuario`) REFERENCES `usuarios` (`dni`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idTipoCuenta`) REFERENCES `tiposcuenta` (`idTipoCuenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
