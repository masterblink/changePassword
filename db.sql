CREATE TABLE IF NOT EXISTS `lastpass` (
  `idlastpass` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `oldpass` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lastpass`
--

INSERT INTO `lastpass` (`idlastpass`, `idusuario`, `oldpass`) VALUES
(1, 1, 'Area2613#'),
(2, 1, '2613Area#'),
(3, 1, 'Area2886#'),
(4, 1, '2886Area#'),
(5, 1, 'Hola123#'),
(6, 1, '123Hola#'),
(7, 1, 'Chao123#'),
(8, 1, '123Chao#'),
(9, 1, 'Cla1234$'),
(10, 1, '1234Cla$'),
(11, 1, '1234Cla$'),
(12, 1, 'Area1326#'),
(13, 1, '1326Area#'),
(14, 1, 'Area2316#');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario`, `password`, `correo`, `nombre`) VALUES
(1, 'angeleguiluz', 'Area2613#', 'angel.eguiluz@gmail.com', 'Angel Eguiluz');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lastpass`
--
ALTER TABLE `lastpass`
  ADD PRIMARY KEY (`idlastpass`) COMMENT 'pkold';

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`) COMMENT 'pk';
