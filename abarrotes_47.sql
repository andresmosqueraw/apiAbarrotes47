-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2023 a las 22:41:35
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `abarrotes_47`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `eve_id` int(11) NOT NULL,
  `eve_ubicacion` varchar(255) NOT NULL,
  `eve_fecha_sist` date NOT NULL,
  `eve_hora_sist` time NOT NULL,
  `eve_fecha_evento` date NOT NULL,
  `eve_hora_evento` time NOT NULL,
  `eve_observaciones` varchar(255) NOT NULL,
  `tipo_evento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`eve_id`, `eve_ubicacion`, `eve_fecha_sist`, `eve_hora_sist`, `eve_fecha_evento`, `eve_hora_evento`, `eve_observaciones`, `tipo_evento_id`) VALUES
(1, '44', '2023-03-10', '13:29:17', '2023-03-08', '02:29:17', 'no hay', 1),
(46, '446766767', '2023-03-19', '06:23:39', '2023-03-17', '15:19:17', 'Ingreso normaL', 1),
(48, '44678989867', '2023-03-24', '12:28:58', '2023-03-21', '09:00:17', 'Ingreso normaL', 5),
(50, '989867', '2023-03-31', '07:51:10', '2023-03-21', '12:00:17', 'Ingreso normaL', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_mensajeria`
--

CREATE TABLE `evento_mensajeria` (
  `even_men_id` int(11) NOT NULL,
  `even_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_visitante`
--

CREATE TABLE `evento_visitante` (
  `eve_vis_id` int(11) NOT NULL,
  `eve_id` int(11) NOT NULL,
  `vis_id` int(11) NOT NULL,
  `ev_fecha_salida` date DEFAULT NULL,
  `ev_hora_salida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `evento_visitante`
--

INSERT INTO `evento_visitante` (`eve_vis_id`, `eve_id`, `vis_id`, `ev_fecha_salida`, `ev_hora_salida`) VALUES
(1, 1, 1, '2023-03-10', '16:24:45'),
(2, 46, 2, '2023-03-19', '18:35:15'),
(4, 48, 4, '0000-00-00', '00:00:00'),
(6, 50, 6, '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeria_entrega`
--

CREATE TABLE `mensajeria_entrega` (
  `men_id` int(11) NOT NULL,
  `men_nombre_recibe` varchar(255) NOT NULL,
  `men_firma` varchar(255) NOT NULL,
  `tipo_iden` int(11) NOT NULL,
  `men_documento_recibe` int(11) NOT NULL,
  `vis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_descripcion`) VALUES
(1, 'ADMIN'),
(2, 'GUARDAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_evento`
--

CREATE TABLE `tipo_evento` (
  `tipo_evento_id` int(11) NOT NULL,
  `tipo_evento_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_evento`
--

INSERT INTO `tipo_evento` (`tipo_evento_id`, `tipo_evento_descripcion`) VALUES
(1, 'INGRESO VISITANTE'),
(2, 'INGRESO VEHÍCULO'),
(3, 'SALIDA VISITANTE'),
(4, 'SALIDA VEHÍCULO'),
(5, 'MENSAJERIA'),
(6, 'ENTREGA MENSAJERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_identificacion`
--

CREATE TABLE `tipo_identificacion` (
  `tipo_iden` int(11) NOT NULL,
  `tipo_iden_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_identificacion`
--

INSERT INTO `tipo_identificacion` (`tipo_iden`, `tipo_iden_descripcion`) VALUES
(1, 'TARJETA DE IDENTIDAD'),
(2, 'CEDULA DE CIUDADANIA'),
(3, 'TARJETA EXTRANJERIA'),
(4, 'CEDULA DE EXTRANJERIA'),
(5, 'NIT'),
(6, 'PASAPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_visitante`
--

CREATE TABLE `tipo_visitante` (
  `tipo_vis_id` int(11) NOT NULL,
  `tipo_vis_descr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_visitante`
--

INSERT INTO `tipo_visitante` (`tipo_vis_id`, `tipo_vis_descr`) VALUES
(1, 'PARTICULAR'),
(2, 'MENSAJERIA'),
(3, 'EMPRESA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_usuario` varchar(100) NOT NULL,
  `usu_contra` varchar(150) NOT NULL,
  `usu_mail` varchar(100) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `usu_dateUpdate` varchar(20) NOT NULL,
  `usu_identifier` varchar(255) NOT NULL,
  `usu_key` varchar(255) NOT NULL,
  `usu_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_usuario`, `usu_contra`, `usu_mail`, `rol_id`, `usu_dateUpdate`, `usu_identifier`, `usu_key`, `usu_status`) VALUES
(2, 'kel2md', '81dc9bdb52d04dc20036dbd8313ed055', 'kel2md@gmail.com', 2, '2023-03-19 04:57', 'asd1asdaserwtopasdeejX0/zEevzXJuiZWvTHx0', 'ERT1ERTaserwtopERTWRHliH5Jm8iYlmevBXBeK0', 1),
(5, 'juanito', 'd9b1d7db4cd6e70935368a1efb10e377', 'juanito@gmail.com', 2, '2023-04-01 02:42', 'asd1asdaserwtopasdjiYEKLr0ioa63bBiWqGCu.', 'ERT1ERTaserwtopERTDF1MHBWdS.guAs0afie3B.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `veh_id` int(11) NOT NULL,
  `veh_tipo` varchar(255) NOT NULL,
  `veh_placa` varchar(15) NOT NULL,
  `veh_parqueo` varchar(50) NOT NULL,
  `veh_foto` varchar(255) NOT NULL,
  `vis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`veh_id`, `veh_tipo`, `veh_placa`, `veh_parqueo`, `veh_foto`, `vis_id`) VALUES
(1, 'sedan', 'xx768', '78', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitante`
--

CREATE TABLE `visitante` (
  `vis_id` int(11) NOT NULL,
  `vis_nombres` varchar(255) NOT NULL,
  `vis_apellidos` varchar(255) NOT NULL,
  `tipo_iden` int(11) NOT NULL,
  `vis_identificacion` int(11) NOT NULL,
  `vis_vis_empresa_representa` varchar(255) NOT NULL,
  `vis_piso` int(2) NOT NULL,
  `vis_oficina_aparta` varchar(100) NOT NULL,
  `vis_torre` varchar(50) NOT NULL,
  `vis_motivo_visita` varchar(255) NOT NULL,
  `vis_cant_personas` int(4) NOT NULL,
  `vis_autoriza` varchar(100) NOT NULL,
  `tipo_vis_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `vis_foto` varchar(255) NOT NULL,
  `vis_lugar_custodia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `visitante`
--

INSERT INTO `visitante` (`vis_id`, `vis_nombres`, `vis_apellidos`, `tipo_iden`, `vis_identificacion`, `vis_vis_empresa_representa`, `vis_piso`, `vis_oficina_aparta`, `vis_torre`, `vis_motivo_visita`, `vis_cant_personas`, `vis_autoriza`, `tipo_vis_id`, `usu_id`, `vis_foto`, `vis_lugar_custodia`) VALUES
(1, 'LARRY ANDRES', 'MARTINEZ', 2, 12092887, 'NO', 0, '204', '11', 'VISITA A SU MAMA', 0, 'CAMILO CORREDOR', 1, 2, '', ''),
(2, 'JUAN ANDRES', 'CORDERO', 2, 12748347, 'NO', 3, '303', '10', 'VISITA AMISTADES', 3, 'CAMILO CORREDOR', 1, 2, '', ''),
(4, 'LAURA MARIA', 'CACERES SEPULVEDA', 2, 12230200, 'SI', 3, '311', '3', 'DEJAR PAQUETE', 1, 'CAMILO CORREDOR', 2, 5, '', 'CASILLERO 311'),
(6, 'Carmen Dolores', 'LINARES SEPULVEDA', 2, 137830200, 'SI', 3, '311', '3', 'DEJAR PAQUETE', 1, 'CAMILO CORREDOR', 2, 2, '', 'CASILLERO 311');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`eve_id`);

--
-- Indices de la tabla `evento_mensajeria`
--
ALTER TABLE `evento_mensajeria`
  ADD PRIMARY KEY (`even_men_id`);

--
-- Indices de la tabla `evento_visitante`
--
ALTER TABLE `evento_visitante`
  ADD PRIMARY KEY (`eve_vis_id`);

--
-- Indices de la tabla `mensajeria_entrega`
--
ALTER TABLE `mensajeria_entrega`
  ADD PRIMARY KEY (`men_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  ADD PRIMARY KEY (`tipo_evento_id`);

--
-- Indices de la tabla `tipo_identificacion`
--
ALTER TABLE `tipo_identificacion`
  ADD PRIMARY KEY (`tipo_iden`);

--
-- Indices de la tabla `tipo_visitante`
--
ALTER TABLE `tipo_visitante`
  ADD PRIMARY KEY (`tipo_vis_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`veh_id`);

--
-- Indices de la tabla `visitante`
--
ALTER TABLE `visitante`
  ADD PRIMARY KEY (`vis_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `eve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `evento_mensajeria`
--
ALTER TABLE `evento_mensajeria`
  MODIFY `even_men_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evento_visitante`
--
ALTER TABLE `evento_visitante`
  MODIFY `eve_vis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mensajeria_entrega`
--
ALTER TABLE `mensajeria_entrega`
  MODIFY `men_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  MODIFY `tipo_evento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_identificacion`
--
ALTER TABLE `tipo_identificacion`
  MODIFY `tipo_iden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_visitante`
--
ALTER TABLE `tipo_visitante`
  MODIFY `tipo_vis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `veh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `visitante`
--
ALTER TABLE `visitante`
  MODIFY `vis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
