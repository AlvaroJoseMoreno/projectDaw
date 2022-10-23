-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2020 a las 02:35:27
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pibd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `IdAlbum` int(4) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Descripcion` varchar(4000) NOT NULL,
  `Usuario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`IdAlbum`, `Titulo`, `Descripcion`, `Usuario`) VALUES
(1, 'Playas', 'En este álbum hay fotos de las playas más turisticas del levante español', 2),
(2, 'Dolomitas Italianos', 'En este álbum tenemos fotos de algunas de las cumbres más bonitas de los dolomitas, una cordillera situada al norte de Italia que hace frontera con Austria y Suiza', 1),
(3, 'Lugares de Rusia', 'En este álbum se encuentran localizaciones de Rusia desde los montes urales a la plaza roja de moscú', 3),
(4, 'Lugares abandonados', 'En este álbum tenemos algunos lugares abandonados de diferentes partes del mundo', 3),
(5, 'Montañas del Mundo', 'En este álbum se muestran imágenes de algunos de los picos mas emblemáticos del mundo.', 1),
(9, 'Consolas', 'Un repaso a varias de las consolas más increibles e importantes de la historia.', 6),
(10, 'Nuevo album', 'Album de prueba, para comprobar que toda esta vaina va bien.', 6),
(11, 'Album de prueba', 'Un nuevo album de prueba, para realizar unas brutales comprobaciones.', 6),
(13, 'Álbum Myriam.', 'Lugares bonitos para visitar en Alicante.', 8),
(17, 'Directos con Ibai', 'Aca guardo directos relindos con Ibai', 18),
(18, 'La pulga', 'Fotos con el mejor M10 GOAT', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `idEstilo` int(4) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(30) NOT NULL,
  `Fichero` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`idEstilo`, `Nombre`, `Descripcion`, `Fichero`) VALUES
(0, 'Normal', 'Estilo normal', 'index.css'),
(1, 'nocheindex', 'Estilo Noche', 'nocheindex.css'),
(2, 'accesible', 'Estilo Accesible', 'accesible.css'),
(3, 'alto contraste', 'alto contraste', 'altocontraste.css'),
(4, 'Letra grande', 'Letra grande', 'bigfontindex.css'),
(5, 'impresion', 'impresion', 'impresion.css');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `IdFoto` int(4) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Descripcion` varchar(4000) NOT NULL,
  `Fecha` varchar(50) DEFAULT NULL,
  `Pais` int(4) DEFAULT NULL,
  `Album` int(4) NOT NULL,
  `Fichero` varchar(50) NOT NULL,
  `Alternativo` varchar(100) NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`IdFoto`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `Alternativo`, `FRegistro`) VALUES
(1, 'Playa de Levante', 'La playa del Levante situada en la localidad alicantina de benidorm es una las mayores atracciones turisticas de todo el pais', '2019-07-16', 1, 1, 'levante.jpg', 'Playa situada en Benidorm', '2020-11-27 23:51:06'),
(2, 'Tre Cime di lavaredo', 'Las tres cimas di Lavaredo en los dolomitas italianos son un atractivo turísto para realizar realizar deportes de nieve en invierno y deportes como ciclismo o senderismo en las estaciones de primavera', '2020-05-21', 2, 2, 'trecimalavaredo.jpg', 'Cumbre italiana de las tres cimas de di lavaredo', '2020-11-27 23:53:52'),
(3, 'Monte grappa', 'El monte grappa. Esta cima italiana fue testigo de grandes acontecimientos históricos sucedidos tanto en la primera como en la segunda guerra mundial', '2020-05-22', 2, 2, 'montegrappa.jpg', 'Monte grappa, cima situada en los dolomitas italianos', '2020-11-27 23:54:13'),
(4, 'Plaza Roja', 'La plaza roja situada en el Kremlin de Moscú, es uno de los lugares turísticos más atractivos de visitar para un turista.', '2019-06-20', 10, 3, 'plazaroja.jpg', 'Plaza roja en moscú', '2020-11-27 23:54:19'),
(5, 'Montes Urales', 'En esta imagen podemos observar la cordillera de los montes urales, frontera natural entra la Rusia europea y la Rusia asiática', '2019-06-21', 10, 3, 'montesurales.jpg', 'Cordillera de los montes urales en rusia', '2020-11-27 23:54:24'),
(6, 'Cabo de Palos', 'El cabo de Palos es un cabo de España en aguas del mar Mediterráneo, y una población que se encuentra en el municipio de Cartagena, en la Región de Murcia.', '2018-08-10', 1, 1, 'cabopalos.jpg', 'En esta foto esta el faro de cabo de palos', '2020-12-03 15:33:47'),
(7, 'Pico del Aconcagua', 'El Aconcagua es una montaña ubicada en el departamento Las Heras, en la provincia de Mendoza, en el oeste de la República Argentina. Integra la Cordillera Principal, la cual es un componente de la cordillera de los Andes.', '2019-05-12', 7, 5, 'aconcagua.jpg', 'El pico del aconcagua, situado en los andes argentinos.', '2020-12-03 20:59:59'),
(8, 'Monte Everest', 'El monte Everest es la montaña más alta de la superficie del planeta Tierra , con una altitud de 8848 metros sobre el nivel del mar.', '2019-05-26', 13, 5, 'everest.jpg', 'El monte everest, la cima del mundo.', '2020-12-03 21:16:05'),
(9, 'Faro de Santa Pola', 'El faro del Cabo de Santa Pola está situado en el cabo de Santa Pola, Alicante, desde donde domina tanto la bahía de Alicante como la huerta de Elche y la isla de Tabarca.​', '2017-07-25', 1, 1, 'farosantapola.jpg', 'Faro de Santa Pola', '2020-12-03 22:43:24'),
(10, 'Consola Ps2', 'La ps2, con 160 millones de consolas vendidas, es la consola mas vendida de la historia.', '2020-12-17', 1, 9, 'ps2.jpg', 'La consola ps2, la mas vendida de su generacion', '2020-12-10 08:50:07'),
(11, 'Terraza en Alicante.', 'En esta foto se observa una bonita terraza de un bar de copas al lado del puerto de Alicante, puedes ir allí a tomar una copita y disfrutar de las vistas. \r\nA disfrutarrrr\r\nBesisss', '2020-12-10', 1, 13, 'puerto.jpg', 'Que vaya bien.', '2020-12-15 00:37:57'),
(33, 'Con el Goat v2', 'crack jejejeje', '2020-12-02', 7, 18, 'messiconKun.jpg', 'Kunsitotomamateconelgoat', '2020-12-16 00:13:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `idPais` int(4) NOT NULL,
  `NomPais` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`idPais`, `NomPais`) VALUES
(1, 'España'),
(2, 'Italia'),
(3, 'China'),
(4, 'Estados Unidos'),
(5, 'Alemania'),
(6, 'Inglaterra'),
(7, 'Argentina'),
(8, 'Portugal'),
(9, 'Francia'),
(10, 'Rusia'),
(11, 'Luxemburgo'),
(12, 'Perú'),
(13, 'Nepal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdSolicitud` int(4) NOT NULL,
  `Album` int(4) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Descripcion` varchar(4000) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Direccion` varchar(500) NOT NULL,
  `Color` varchar(200) NOT NULL,
  `Copias` int(5) NOT NULL,
  `Resolucion` int(5) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Coste` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`IdSolicitud`, `Album`, `Nombre`, `Titulo`, `Descripcion`, `Email`, `Direccion`, `Color`, `Copias`, `Resolucion`, `Fecha`, `IColor`, `FRegistro`, `Coste`) VALUES
(1, 5, 'Montañas del Mundo', 'Terraza en el puerto de Alicante', 'Terraza alicante', 'pepe..p@ua.es', 'Calle Azorín, 23, 3, 32, Basio, Santomera, Murcia', '#000000', 3, 450, '2021-01-08', 1, '2020-12-11 09:05:15', 6.33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(4) NOT NULL,
  `NomUsuario` varchar(15) NOT NULL,
  `Clave` varchar(15) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Sexo` smallint(127) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` varchar(127) NOT NULL,
  `Pais` int(127) NOT NULL,
  `Foto` varchar(127) NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Estilo` int(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`, `Estilo`) VALUES
(1, 'Minecraftiano69', 'Skey2000', 'minecraftiano@gmail.com', 0, '2000-11-06', 'Santomera', 1, 'Minecraftiano69.png', '2020-12-15 00:40:28', 1),
(2, 'Antonio64', '123456', 'antonio64@gmail.com', 0, '1998-04-02', 'Moscu', 10, 'Antonio64.png', '2020-12-15 00:40:08', 2),
(3, 'MariaJuana', 'mariajuana', 'mariajuanasa43@gmail.com', 1, '2002-01-23', 'Sevilla', 1, 'MariaJuana.png', '2020-12-15 00:40:00', 2),
(4, 'Diego10', 'maradona76', 'Diego10@gmail.es', 0, '1980-02-17', 'Buenos Aires', 7, 'Diego10.jpg', '2020-12-15 00:39:53', 3),
(6, 'JoseFran12', 'JoseFrancisco12', 'josemanuel@gmail.com', 0, '2002-02-12', 'Villena', 1, 'JoseFran12.png', '2020-12-15 00:39:45', 0),
(8, 'MyriCano20', 'Piscis20', 'mcanogp15@gmail.com', 1, '2000-03-13', 'Alicante ', 1, 'MyriCano20.png', '2020-12-15 00:39:35', 0),
(18, 'ElKunAguero', 'Kunsito10', 'jman.alcaraz@gmail.com', 0, '2000-12-20', 'Rosario', 7, 'kunsito.jpg', '2020-12-15 22:52:32', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`IdAlbum`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`idEstilo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `Album` (`Album`),
  ADD KEY `Pais` (`Pais`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdSolicitud`),
  ADD KEY `Album` (`Album`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `NomUsuario` (`NomUsuario`),
  ADD KEY `Pais` (`Pais`),
  ADD KEY `Estilo` (`Estilo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `IdAlbum` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `idEstilo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `IdFoto` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `idPais` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `albumes_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`Pais`) REFERENCES `paises` (`idPais`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fotos_ibfk_2` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Estilo`) REFERENCES `estilos` (`idEstilo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Pais`) REFERENCES `paises` (`idPais`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
