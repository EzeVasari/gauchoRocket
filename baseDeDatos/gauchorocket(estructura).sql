-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2019 a las 01:12:45
-- Versión del servidor: 5.5.39
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gauchorocket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `fkEmailUsuario` varchar(64) NOT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`fkEmailUsuario`, `id`) VALUES
('admin@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabina`
--

CREATE TABLE IF NOT EXISTS `cabina` (
  `codigoCabina` int(11) NOT NULL,
  `asientos` int(11) DEFAULT NULL,
  `ubicacion` varchar(10) DEFAULT NULL,
  `fkCodigoTipoDeCabina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cabina`
--

INSERT INTO `cabina` (`codigoCabina`, `asientos`, `ubicacion`, `fkCodigoTipoDeCabina`) VALUES
(1, 80, NULL, 1),
(2, 100, NULL, 2),
(3, 30, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centromedico`
--

CREATE TABLE IF NOT EXISTS `centromedico` (
  `codigo` int(11) NOT NULL,
  `turnos` int(11) DEFAULT NULL,
  `codigoLugar` int(11) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `centromedico`
--

INSERT INTO `centromedico` (`codigo`, `turnos`, `codigoLugar`, `imagen`) VALUES
(1, 200, 1, 'img/centrosMedicos/buenosaires.jpg'),
(2, 200, 2, 'img/centrosMedicos/ankara.jpg'),
(3, 200, 13, 'img/centrosMedicos/shanghai.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `fkEmailUsuario` varchar(64) NOT NULL,
  `verifMedica` tinyint(1) DEFAULT NULL,
  `nivelVuelo` int(11) DEFAULT NULL,
  `codigoCentroMedico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`fkEmailUsuario`, `verifMedica`, `nivelVuelo`, `codigoCentroMedico`) VALUES
('dos@gmail.com', 1, 1, 1),
('uno@gmail.com', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `matricula` int(11) NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `codigoTipoDeEquipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`matricula`, `modelo`, `capacidad`, `codigoTipoDeEquipo`) VALUES
(1111, 'Calandria', 100, 4),
(2222, 'Colibri', 200, 4),
(3333, 'Modelo Uno', 300, 1),
(4444, 'Guanaco', 400, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemreserva`
--

CREATE TABLE IF NOT EXISTS `itemreserva` (
  `idItemReserva` int(11) NOT NULL,
  `fkCodigoReserva` varchar(6) DEFAULT NULL,
  `fkCodigoServicio` int(11) DEFAULT NULL,
  `fkCodigoCabina` int(11) DEFAULT NULL,
  `checkin` tinyint(1) DEFAULT NULL,
  `pago` tinyint(1) DEFAULT NULL,
  `fechaLimite` datetime DEFAULT NULL,
  `fechaConfirmacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `itemreserva`
--

INSERT INTO `itemreserva` (`idItemReserva`, `fkCodigoReserva`, `fkCodigoServicio`, `fkCodigoCabina`, `checkin`, `pago`, `fechaLimite`, `fechaConfirmacion`) VALUES
(7545, 'uk2mnc', 1, 1, 0, 1, '2019-10-25 10:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `fkEmailUsuario` varchar(64) NOT NULL,
  `pass` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`fkEmailUsuario`, `pass`) VALUES
('admin@gmail.com', '7815696ecbf1c96e6894b779456d330e'),
('dos@gmail.com', '7815696ecbf1c96e6894b779456d330e'),
('uno@gmail.com', '7815696ecbf1c96e6894b779456d330e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE IF NOT EXISTS `lugar` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`codigo`, `nombre`) VALUES
(1, 'Buenos Aires'),
(2, 'Ankara'),
(3, 'Luna'),
(4, 'Marte'),
(5, 'Europa'),
(6, 'Io'),
(7, 'Encelado'),
(8, 'Titan'),
(9, 'Orbiter Hotel'),
(10, 'EEI'),
(11, 'Ganimedes'),
(12, 'Neptuno'),
(13, 'Shanghai');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacioncabinaequipo`
--

CREATE TABLE IF NOT EXISTS `relacioncabinaequipo` (
  `fkCodigoCabina` int(11) NOT NULL DEFAULT '0',
  `fkCodigoEquipo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionclienteitemreserva`
--

CREATE TABLE IF NOT EXISTS `relacionclienteitemreserva` (
  `fkIdItemReserva` int(11) NOT NULL DEFAULT '0',
  `fkEmailCliente` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `relacionclienteitemreserva`
--

INSERT INTO `relacionclienteitemreserva` (`fkIdItemReserva`, `fkEmailCliente`) VALUES
(7545, 'dos@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `codigo` varchar(6) NOT NULL,
  `codigoViaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`codigo`, `codigoViaje`) VALUES
('uk2mnc', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `codigoServicio` int(11) NOT NULL,
  `precio` double DEFAULT NULL,
  `fkcodigoTipoDeServicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`codigoServicio`, `precio`, `fkcodigoTipoDeServicio`) VALUES
(1, 500, 1),
(2, 600, 2),
(3, 800, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodecabina`
--

CREATE TABLE IF NOT EXISTS `tipodecabina` (
  `codigoTipoDeCabina` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipodecabina`
--

INSERT INTO `tipodecabina` (`codigoTipoDeCabina`, `descripcion`, `precio`) VALUES
(1, 'General', 350),
(2, 'Familiar', 550),
(3, 'Suite', 850);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeequipo`
--

CREATE TABLE IF NOT EXISTS `tipodeequipo` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipodeequipo`
--

INSERT INTO `tipodeequipo` (`codigo`, `descripcion`) VALUES
(1, 'Baja aceleracion'),
(2, 'Alta aceleracion'),
(3, 'Orbitales'),
(4, 'SubOrbitales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeservicio`
--

CREATE TABLE IF NOT EXISTS `tipodeservicio` (
  `codigoTipoDeServicio` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipodeservicio`
--

INSERT INTO `tipodeservicio` (`codigoTipoDeServicio`, `descripcion`) VALUES
(1, 'Standard'),
(2, 'Gourmet'),
(3, 'Spa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeviaje`
--

CREATE TABLE IF NOT EXISTS `tipodeviaje` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipodeviaje`
--

INSERT INTO `tipodeviaje` (`codigo`, `descripcion`) VALUES
(1, 'Orbitales'),
(2, 'SubOrbitales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnomedico`
--

CREATE TABLE IF NOT EXISTS `turnomedico` (
`codigo` int(11) NOT NULL,
  `fkEmailCliente` varchar(64) DEFAULT NULL,
  `codigoLugar` int(11) DEFAULT NULL,
  `nombreLugar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(64) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `rol` tinyint(1) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `fechaDeNacimiento` date DEFAULT NULL,
  `codigoHash` varchar(32) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`email`, `dni`, `rol`, `nombre`, `apellido`, `fechaDeNacimiento`, `codigoHash`, `active`) VALUES
('admin@gmail.com', 1, 1, 'Ala', 'Cran', '1992-08-10', NULL, 1),
('dos@gmail.com', 2345, 0, 'Cesar', 'Noso', '2000-01-01', NULL, 1),
('uno@gmail.com', 1234, 0, 'Susana', 'Oria', '2000-01-01', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE IF NOT EXISTS `viaje` (
  `codigo` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `codigoLugarOrigen` int(11) DEFAULT NULL,
  `codigoLugarDestino` int(11) DEFAULT NULL,
  `codigoTipoDeViaje` int(11) DEFAULT NULL,
  `codigoEquipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`codigo`, `imagen`, `descripcion`, `precio`, `nombre`, `fecha`, `duracion`, `codigoLugarOrigen`, `codigoLugarDestino`, `codigoTipoDeViaje`, `codigoEquipo`) VALUES
(1, 'img/Luna.jpg', 'Vuelo desde Ankara hasta la Luna en 8hs.', 4000, 'Ankara - Luna', '2019-10-21 12:00:00', 8, 2, 3, 2, 1111),
(2, 'img/Luna2.jpg', 'Vuelo desde Buenos Aires a Luna en 8hs.', 4000, 'Bs. As. - Luna', '2019-10-22 12:00:00', 8, 1, 3, 2, 2222),
(3, 'img/Marte.jpg', 'Vuelo desde Buenos Aires a Marte en 8hs.', 7000, 'Bs. As. - Marte', '2019-10-22 12:00:00', 8, 1, 4, 2, 2222),
(4, 'img/titan.jpg', 'Vuelo completo desde Buenos Aires hacia Titan en 77 hs.', 10000, 'Bs. As. - Titan', '2019-10-23 12:00:00', 72, 1, 8, 1, 4444),
(5, 'img/marte2.jpg', 'Vuelo desde Ankara hasta Marte en 8hs.', 6300, 'Ankara - Marte', '2019-10-25 12:00:00', 8, 2, 4, 2, 2222),
(6, 'img/titan2.jpg', 'Vuelo desde Ankara hasta Titan en 72hs.', 11000, 'Ankara - Titan', '2019-10-27 12:00:00', 72, 2, 8, 1, 4444);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`fkEmailUsuario`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `cabina`
--
ALTER TABLE `cabina`
 ADD PRIMARY KEY (`codigoCabina`), ADD KEY `fkCodigoTipoDeCabina` (`fkCodigoTipoDeCabina`);

--
-- Indices de la tabla `centromedico`
--
ALTER TABLE `centromedico`
 ADD PRIMARY KEY (`codigo`), ADD KEY `codigoLugar` (`codigoLugar`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`fkEmailUsuario`), ADD KEY `codigoCentroMedico` (`codigoCentroMedico`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
 ADD PRIMARY KEY (`matricula`), ADD KEY `codigoTipoDeEquipo` (`codigoTipoDeEquipo`);

--
-- Indices de la tabla `itemreserva`
--
ALTER TABLE `itemreserva`
 ADD PRIMARY KEY (`idItemReserva`), ADD KEY `fkCodigoReserva` (`fkCodigoReserva`), ADD KEY `fkCodigoServicio` (`fkCodigoServicio`), ADD KEY `fkCodigoCabina` (`fkCodigoCabina`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`fkEmailUsuario`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `relacioncabinaequipo`
--
ALTER TABLE `relacioncabinaequipo`
 ADD PRIMARY KEY (`fkCodigoCabina`,`fkCodigoEquipo`), ADD KEY `fkCodigoEquipo` (`fkCodigoEquipo`);

--
-- Indices de la tabla `relacionclienteitemreserva`
--
ALTER TABLE `relacionclienteitemreserva`
 ADD PRIMARY KEY (`fkIdItemReserva`,`fkEmailCliente`), ADD KEY `fkEmailCliente` (`fkEmailCliente`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
 ADD PRIMARY KEY (`codigo`), ADD KEY `codigoViaje` (`codigoViaje`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
 ADD PRIMARY KEY (`codigoServicio`), ADD KEY `fkcodigoTipoDeServicio` (`fkcodigoTipoDeServicio`);

--
-- Indices de la tabla `tipodecabina`
--
ALTER TABLE `tipodecabina`
 ADD PRIMARY KEY (`codigoTipoDeCabina`);

--
-- Indices de la tabla `tipodeequipo`
--
ALTER TABLE `tipodeequipo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `tipodeservicio`
--
ALTER TABLE `tipodeservicio`
 ADD PRIMARY KEY (`codigoTipoDeServicio`);

--
-- Indices de la tabla `tipodeviaje`
--
ALTER TABLE `tipodeviaje`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `turnomedico`
--
ALTER TABLE `turnomedico`
 ADD PRIMARY KEY (`codigo`), ADD KEY `fkEmailCliente` (`fkEmailCliente`), ADD KEY `codigoLugar` (`codigoLugar`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
 ADD PRIMARY KEY (`codigo`), ADD KEY `codigoLugarOrigen` (`codigoLugarOrigen`), ADD KEY `codigoLugarDestino` (`codigoLugarDestino`), ADD KEY `codigoTipoDeViaje` (`codigoTipoDeViaje`), ADD KEY `codigoEquipo` (`codigoEquipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `turnomedico`
--
ALTER TABLE `turnomedico`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`fkEmailUsuario`) REFERENCES `usuario` (`email`);

--
-- Filtros para la tabla `cabina`
--
ALTER TABLE `cabina`
ADD CONSTRAINT `cabina_ibfk_1` FOREIGN KEY (`fkCodigoTipoDeCabina`) REFERENCES `tipodecabina` (`codigoTipoDeCabina`);

--
-- Filtros para la tabla `centromedico`
--
ALTER TABLE `centromedico`
ADD CONSTRAINT `centromedico_ibfk_1` FOREIGN KEY (`codigoLugar`) REFERENCES `lugar` (`codigo`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`fkEmailUsuario`) REFERENCES `usuario` (`email`),
ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`codigoCentroMedico`) REFERENCES `centromedico` (`codigo`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`codigoTipoDeEquipo`) REFERENCES `tipodeequipo` (`codigo`);

--
-- Filtros para la tabla `itemreserva`
--
ALTER TABLE `itemreserva`
ADD CONSTRAINT `itemreserva_ibfk_1` FOREIGN KEY (`fkCodigoReserva`) REFERENCES `reserva` (`codigo`),
ADD CONSTRAINT `itemreserva_ibfk_2` FOREIGN KEY (`fkCodigoServicio`) REFERENCES `servicio` (`codigoServicio`),
ADD CONSTRAINT `itemreserva_ibfk_3` FOREIGN KEY (`fkCodigoCabina`) REFERENCES `cabina` (`codigoCabina`);

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`fkEmailUsuario`) REFERENCES `usuario` (`email`);

--
-- Filtros para la tabla `relacioncabinaequipo`
--
ALTER TABLE `relacioncabinaequipo`
ADD CONSTRAINT `relacioncabinaequipo_ibfk_1` FOREIGN KEY (`fkCodigoCabina`) REFERENCES `cabina` (`codigoCabina`),
ADD CONSTRAINT `relacioncabinaequipo_ibfk_2` FOREIGN KEY (`fkCodigoEquipo`) REFERENCES `equipo` (`matricula`);

--
-- Filtros para la tabla `relacionclienteitemreserva`
--
ALTER TABLE `relacionclienteitemreserva`
ADD CONSTRAINT `relacionclienteitemreserva_ibfk_1` FOREIGN KEY (`fkIdItemReserva`) REFERENCES `itemreserva` (`idItemReserva`),
ADD CONSTRAINT `relacionclienteitemreserva_ibfk_2` FOREIGN KEY (`fkEmailCliente`) REFERENCES `cliente` (`fkEmailUsuario`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`codigoViaje`) REFERENCES `viaje` (`codigo`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`fkcodigoTipoDeServicio`) REFERENCES `tipodeservicio` (`codigoTipoDeServicio`);

--
-- Filtros para la tabla `turnomedico`
--
ALTER TABLE `turnomedico`
ADD CONSTRAINT `turnomedico_ibfk_1` FOREIGN KEY (`fkEmailCliente`) REFERENCES `cliente` (`fkEmailUsuario`),
ADD CONSTRAINT `turnomedico_ibfk_2` FOREIGN KEY (`codigoLugar`) REFERENCES `lugar` (`codigo`);

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
ADD CONSTRAINT `viaje_ibfk_1` FOREIGN KEY (`codigoLugarOrigen`) REFERENCES `lugar` (`codigo`),
ADD CONSTRAINT `viaje_ibfk_2` FOREIGN KEY (`codigoLugarDestino`) REFERENCES `lugar` (`codigo`),
ADD CONSTRAINT `viaje_ibfk_3` FOREIGN KEY (`codigoTipoDeViaje`) REFERENCES `tipodeviaje` (`codigo`),
ADD CONSTRAINT `viaje_ibfk_4` FOREIGN KEY (`codigoEquipo`) REFERENCES `equipo` (`matricula`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
