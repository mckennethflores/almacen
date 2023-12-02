-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 01:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almacendb`
--

-- --------------------------------------------------------

--
-- Table structure for table `auxiliar`
--

CREATE TABLE `auxiliar` (
  `id` int(11) NOT NULL,
  `valor` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `orden` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auxiliar`
--

INSERT INTO `auxiliar` (`id`, `valor`, `tipo`, `orden`) VALUES
(1, 'Prospecto', 'etapaventas', '1'),
(2, 'Calificación', 'etapaventas', '2'),
(3, 'Necesita Análisis', 'etapaventas', '3'),
(4, 'Cerrado', 'etapaventas', '4'),
(5, 'Perdido', 'etapaventas', '5'),
(6, 'Trimestral', 'frecuenciapago', '2'),
(7, 'Mensual', 'frecuenciapago', '1'),
(8, 'Semestral', 'frecuenciapago', '3'),
(9, 'Anual', 'frecuenciapago', '4'),
(10, 'SI', 'endoso', '1'),
(11, 'NO', 'endoso', '2');

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idcat` int(11) NOT NULL,
  `nom_cat` varchar(60) NOT NULL,
  `des_cat` varchar(255) DEFAULT NULL,
  `con_cat` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idcat`, `nom_cat`, `des_cat`, `con_cat`) VALUES
(1, 'Hilos y fibras', 'Hilos y fibras', 1),
(2, 'Telas', 'Telas', 1),
(3, 'Prendas de vestir', 'Prendas de vestir', 1),
(4, 'Tejidos técnicos', 'Tejidos técnicos', 1),
(5, 'a', 'a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `idgru` int(11) NOT NULL,
  `nom_gru` varchar(150) NOT NULL,
  `niv_gru` int(11) NOT NULL,
  `est_gru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`idgru`, `nom_gru`, `niv_gru`, `est_gru`) VALUES
(1, 'Administrador', 1, 1),
(2, 'Vendedor', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `insumo`
--

CREATE TABLE `insumo` (
  `idinsumo` bigint(20) NOT NULL,
  `nombreinsumo` varchar(100) NOT NULL,
  `categoriaid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `insumo`
--

INSERT INTO `insumo` (`idinsumo`, `nombreinsumo`, `categoriaid`) VALUES
(1, 'Tela de Algodón', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventariofisico`
--

CREATE TABLE `inventariofisico` (
  `idinventario` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `inventariofisico`
--

INSERT INTO `inventariofisico` (`idinventario`, `productoid`, `fecha`, `cantidad`, `estado`) VALUES
(1, 1, '2023-11-27 14:41:53', 10, 1),
(2, 2, '2023-01-01 00:00:00', 10, 1),
(5, 4, '2023-11-27 16:33:18', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kardex`
--

CREATE TABLE `kardex` (
  `idkardex` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `tipomovimientoid` bigint(20) NOT NULL,
  `ingreso` int(11) NOT NULL,
  `salida` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `kardex`
--

INSERT INTO `kardex` (`idkardex`, `productoid`, `fecha`, `tipomovimientoid`, `ingreso`, `salida`, `saldo`) VALUES
(1, 1, '2023-11-27 21:37:17', 2, 0, 8, 92),
(2, 1, '2023-11-27 21:37:47', 1, 10, 0, 102),
(3, 2, '2023-11-27 21:38:14', 1, 6, 0, 106),
(4, 2, '2023-11-27 21:38:39', 2, 0, 3, 103),
(5, 30, '2023-11-28 17:32:11', 2, 0, 5, 595),
(6, 31, '2023-11-28 17:32:46', 2, 0, 1, 9),
(7, 32, '2023-11-28 17:33:05', 2, 0, 1, 99);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `idmed` int(11) NOT NULL,
  `nom_med` varchar(100) NOT NULL,
  `des_med` varchar(150) NOT NULL,
  `tipo_med` varchar(100) NOT NULL,
  `con_med` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`idmed`, `nom_med`, `des_med`, `tipo_med`, `con_med`) VALUES
(3, '1698533625.png', 'Imagen 3', 'image/png', 1),
(4, '1698534088.png', 'Captura de Pantalla 2021-08-21 a la(s) 01.09 2.png', 'image/png', 1),
(5, '1698534156.jpeg', 'jdkinnovatec-peru.jpeg', 'image/jpeg', 1),
(6, '1698534680.png', 'devicon_php.png', 'image/png', 1),
(7, '1698534709.png', 'image 2.png', 'image/png', 1),
(8, '1698624356.png', 'image 1.png', 'image/png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movimiento`
--

CREATE TABLE `movimiento` (
  `idmov` int(11) NOT NULL,
  `productoid` int(11) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `tipomovimientoid` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `movimiento`
--

INSERT INTO `movimiento` (`idmov`, `productoid`, `usuarioid`, `tipomovimientoid`, `cantidad`, `precio`, `fecha`) VALUES
(1, 1, 1, 2, 8, '100.00', '2023-11-27 00:00:00'),
(2, 1, 1, 1, 10, '100.00', '2023-11-27 00:00:00'),
(3, 2, 1, 1, 6, '100.00', '2023-11-27 00:00:00'),
(4, 2, 1, 2, 3, '100.00', '2023-11-27 00:00:00'),
(5, 30, 1, 2, 5, '80.00', '2018-01-01 00:00:00'),
(6, 31, 1, 2, 1, '40.00', '2018-01-01 00:00:00'),
(7, 32, 1, 2, 1, '7.00', '2018-01-01 00:00:00');

--
-- Triggers `movimiento`
--
DELIMITER $$
CREATE TRIGGER `trig_actualizarStock` BEFORE INSERT ON `movimiento` FOR EACH ROW BEGIN

	DECLARE nuevo_stock_pro INT;
    DECLARE salida_stock INT;
 
   IF NEW.tipomovimientoid = '1' THEN

   SET nuevo_stock_pro = (SELECT stock_pro FROM producto WHERE idpro = NEW.productoid) + NEW.cantidad;

   UPDATE producto SET stock_pro = stock_pro + NEW.cantidad WHERE producto.idpro = NEW.productoid;
    
      INSERT INTO kardex (productoid,tipomovimientoid,ingreso,salida,saldo) VALUES	(
NEW.productoid,1,NEW.cantidad,0,nuevo_stock_pro);

   ELSE
   SET salida_stock = (SELECT stock_pro FROM producto WHERE idpro = NEW.productoid) - NEW.cantidad;
      UPDATE producto SET stock_pro = stock_pro - NEW.cantidad WHERE producto.idpro = NEW.productoid;
     
      INSERT INTO kardex (productoid,tipomovimientoid,ingreso,salida,saldo) VALUES (NEW.productoid,2,0,NEW.cantidad,salida_stock);
      
   END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `icono` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`, `url`, `id`, `icono`) VALUES
(1, 'Escritorio', 'escritorio.php', 'mEscritorio', 'fa-home'),
(2, 'Categoria', 'categoria.php', 'mCategoria', 'fa-users'),
(3, 'Media', 'media.php', 'mMedia', 'fa-shield'),
(4, 'Productos', 'producto_nombre.php', 'mProductoNombre', 'fa-users'),
(5, 'Reportes', 'reporte_general.php', 'mReportes', 'fa-bar-chart'),
(6, 'Reportes Movimiento Inventario', 'reporte_kardex.php', 'mReportes', 'fa-bar-chart'),
(7, 'Reportes Ganancia', 'reporte_ganancias.php', 'mReportes', 'fa-bar-chart'),
(8, 'Machine Learning', 'ml_ingreso_rapido_producto.php', 'mMachineLearning', 'fa-industry'),
(9, 'ML Prediccion Insumos', 'ml_predicciones_insumos.php', 'mPrediccionesInsumos', 'fa-industry'),
(10, 'Mi perfil', 'perfil.php', 'mPerfil', 'fa-user'),
(11, 'Usuario', 'usuario.php', 'mUsuario', 'fa-user');

-- --------------------------------------------------------

--
-- Table structure for table `permiso_vendedor`
--

CREATE TABLE `permiso_vendedor` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `icono` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `permiso_vendedor`
--

INSERT INTO `permiso_vendedor` (`idpermiso`, `nombre`, `url`, `id`, `icono`) VALUES
(1, 'Escritorio', 'escritorio.php', 'mEscritorio', 'fa-home'),
(2, 'Categoria', 'categoria.php', 'mCategoria', 'fa-users'),
(3, 'Media', 'media.php', 'mMedia', 'fa-shield'),
(4, 'Productos', 'producto_nombre.php', 'mProductoNombre', 'fa-users'),
(5, 'Reportes', 'reporte_general.php', 'mReportes', 'fa-bar-chart'),
(6, 'Reportes Movimiento Inventario', 'reporte_kardex.php', 'mReportes', 'fa-bar-chart'),
(7, 'Reportes Ganancia', 'reporte_ganancias.php', 'mReportes', 'fa-bar-chart'),
(8, 'Machine Learning', 'ml_ingreso_rapido_producto.php', 'mMachineLearning', 'fa-industry'),
(9, 'ML Prediccion Insumos', 'ml_predicciones_insumos.php', 'mPrediccionesInsumos', 'fa-industry');

-- --------------------------------------------------------

--
-- Table structure for table `permiso_vendedor_old`
--

CREATE TABLE `permiso_vendedor_old` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `icono` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `permiso_vendedor_old`
--

INSERT INTO `permiso_vendedor_old` (`idpermiso`, `nombre`, `url`, `id`, `icono`) VALUES
(1, 'Escritorio', 'escritorio.php', 'mEscritorio', 'fa-home'),
(3, 'Empresa', 'empresa.php', 'mEmpresa', 'fa-users'),
(4, 'Clientes', 'clientes.php', 'mClientes', 'fa-shield'),
(5, 'Reuniones', 'reuniones.php', 'mReuniones', 'fa-users'),
(6, 'Reportes', 'reportes.php', 'mReportes', 'fa-bar-chart'),
(7, 'Mi perfil', 'perfil.php', 'mPerfil', 'fa-user'),
(8, 'Cartera', 'cartera.php', 'mCartera', 'fa-shield');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `idpro` int(11) NOT NULL,
  `categoriaid` int(11) NOT NULL,
  `mediaid` int(11) NOT NULL,
  `nom_pro` varchar(150) NOT NULL,
  `stock_pro` decimal(11,2) NOT NULL,
  `pre_com_pro` decimal(11,2) NOT NULL,
  `pre_ven_pro` decimal(11,2) NOT NULL,
  `fec_pro` datetime NOT NULL,
  `codigobarras` varchar(25) NOT NULL,
  `est_pro` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idpro`, `categoriaid`, `mediaid`, `nom_pro`, `stock_pro`, `pre_com_pro`, `pre_ven_pro`, `fec_pro`, `codigobarras`, `est_pro`) VALUES
(1, 1, 3, 'Producto 1', '102.00', '2.00', '4.00', '2023-11-06 17:22:22', '2000012345678', 1),
(2, 1, 4, 'Producto 2', '103.00', '2.00', '4.00', '2023-11-06 17:22:54', '2300012345678', 1),
(3, 1, 3, 'Producto 3', '100.00', '2.00', '4.00', '2023-11-06 17:23:10', '2500012345678', 1),
(4, 2, 3, 'Producto 4', '100.00', '2.00', '4.00', '2023-11-06 17:23:40', '2600012345678', 1),
(5, 2, 3, 'Producto 5', '100.00', '2.00', '4.00', '2023-11-06 17:23:55', '2900012345678', 1),
(6, 2, 3, 'Producto 6', '100.00', '2.00', '4.00', '2023-11-06 17:24:11', '3000012345678', 1),
(7, 3, 3, 'Producto 7', '100.00', '2.00', '4.00', '2023-11-06 17:24:26', '3100012345678', 1),
(8, 3, 3, 'Producto 8', '100.00', '2.00', '4.00', '2023-11-06 17:24:52', '3300012345678', 1),
(9, 3, 3, 'Producto 9', '100.00', '2.00', '4.00', '2023-11-06 17:25:19', '3700012345678', 1),
(10, 4, 3, 'Producto 10', '100.00', '2.00', '4.00', '2023-11-06 17:25:39', '4000012345678', 1),
(14, 1, 3, 'Producto 11', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '', 1),
(16, 1, 3, 'Producto 15 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '', 1),
(17, 2, 3, 'Producto 7 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '1', 127),
(18, 2, 3, 'Producto 18 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '2700012345678', 1),
(19, 3, 3, 'Producto 10 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '2700012345678', 1),
(20, 3, 3, 'Producto 20 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '{param}', 1),
(21, 3, 3, 'Producto 21 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '3200012345678', 1),
(22, 3, 3, 'Producto 22 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '3200012345678', 1),
(23, 3, 3, 'Producto 23 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '3200012345678', 1),
(24, 3, 3, 'Producto 24 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '3400012345678', 1),
(25, 4, 3, 'Producto 11 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '4100012345678', 1),
(26, 3, 4, 'producto 1', '100.00', '20.00', '30.00', '2023-11-06 00:00:00', '', 1),
(27, 4, 3, 'Producto 26 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '4200012345678', 1),
(28, 4, 3, 'Producto 28 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '4300012345678', 1),
(29, 4, 3, 'Producto 29 por ML.', '100.00', '10.00', '15.00', '2023-11-18 00:00:00', '4300012345678', 1),
(30, 1, 3, 'Rollos de tela', '595.00', '1.20', '2.00', '2018-11-06 00:00:00', '', 1),
(31, 3, 3, 'bolsillos de camisa', '9.00', '40.00', '60.00', '2018-11-06 00:00:00', '', 1),
(32, 4, 6, 'Marcas de ropa', '99.00', '50.00', '70.00', '2018-11-06 00:00:00', '', 1),
(33, 3, 3, 'Producto 32 por ML.', '28.00', '10.00', '15.00', '2023-11-28 00:00:00', '3200012345678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productoterminado`
--

CREATE TABLE `productoterminado` (
  `idproductoterminado` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `categoriaid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rela_productosinsumo`
--

CREATE TABLE `rela_productosinsumo` (
  `idrelacion` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `insumoid` bigint(20) NOT NULL,
  `cantidad` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nom_rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id_rol`, `nom_rol`) VALUES
(1, 'Administrador'),
(2, 'Ejecutivo de ventas');

-- --------------------------------------------------------

--
-- Table structure for table `tipomovimiento`
--

CREATE TABLE `tipomovimiento` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `tipomovimiento`
--

INSERT INTO `tipomovimiento` (`id`, `nombre`) VALUES
(1, 'Entrada'),
(2, 'Salida');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `grupoid` int(11) NOT NULL,
  `nom_usu` varchar(180) NOT NULL,
  `pas_usu` varchar(100) NOT NULL,
  `ima_usu` varchar(120) DEFAULT NULL,
  `est_usu` tinyint(4) NOT NULL,
  `ult_usu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usu`, `grupoid`, `nom_usu`, `pas_usu`, `ima_usu`, `est_usu`, `ult_usu`) VALUES
(1, 1, 'sys', '518b67e652531c5fe7e25d6b2c3b4ef6224e7d90da2091967dd47eb082b26a19', 'no.jpg', 1, '2023-10-20 13:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_copy`
--

CREATE TABLE `usuario_copy` (
  `id` int(11) NOT NULL,
  `nom_us` varchar(45) NOT NULL,
  `usu_us` varchar(45) NOT NULL,
  `cla_us` varchar(60) NOT NULL,
  `rol_id_us` varchar(11) NOT NULL,
  `imagen_us` varchar(100) DEFAULT NULL,
  `con_us` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuario_copy`
--

INSERT INTO `usuario_copy` (`id`, `nom_us`, `usu_us`, `cla_us`, `rol_id_us`, `imagen_us`, `con_us`) VALUES
(-1, 'mack', 'sys', 'sys', '1', 'perfil_default.jpg', 1),
(70, 'juan2', 'juan', '123456', '1', 'perfil_default.jpg', 1),
(71, 'vendedor', 'vendedor', '123456', '2', 'perfil_default.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idpermiso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(1, -1, 1),
(2, -1, 2),
(3, -1, 3),
(4, -1, 4),
(5, -1, 5),
(6, -1, 6),
(7, -1, 7),
(8, -1, 8),
(9, -1, 9),
(10, -1, 10),
(11, -1, 11),
(32, 70, 1),
(33, 70, 2),
(34, 70, 3),
(35, 70, 4),
(36, 70, 5),
(37, 70, 6),
(38, 70, 7),
(39, 70, 8),
(40, 70, 9),
(41, 70, 10),
(42, 70, 11),
(52, 71, 1),
(53, 71, 2),
(54, 71, 3),
(55, 71, 4),
(56, 71, 5),
(57, 71, 6),
(58, 71, 7),
(59, 71, 8),
(60, 71, 9),
(61, 71, 10),
(62, 71, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auxiliar`
--
ALTER TABLE `auxiliar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcat`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nom_cat`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idgru`);

--
-- Indexes for table `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`idinsumo`),
  ADD KEY `categoriaid` (`categoriaid`);

--
-- Indexes for table `inventariofisico`
--
ALTER TABLE `inventariofisico`
  ADD PRIMARY KEY (`idinventario`),
  ADD KEY `productoid` (`productoid`);

--
-- Indexes for table `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`idkardex`),
  ADD KEY `tipomovimientoid` (`tipomovimientoid`),
  ADD KEY `productoid` (`productoid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`idmed`);

--
-- Indexes for table `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`idmov`),
  ADD KEY `fk_salida_usuario_idx` (`usuarioid`),
  ADD KEY `fk_salida_producto_idx` (`productoid`),
  ADD KEY `tipomovimientoid` (`tipomovimientoid`);

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indexes for table `permiso_vendedor`
--
ALTER TABLE `permiso_vendedor`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indexes for table `permiso_vendedor_old`
--
ALTER TABLE `permiso_vendedor_old`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idpro`),
  ADD KEY `fk_producto_categoria_idx` (`categoriaid`),
  ADD KEY `fk_producto_media_idx` (`mediaid`);

--
-- Indexes for table `productoterminado`
--
ALTER TABLE `productoterminado`
  ADD PRIMARY KEY (`idproductoterminado`),
  ADD KEY `idproducto` (`idproducto`),
  ADD KEY `categoriaid` (`categoriaid`);

--
-- Indexes for table `rela_productosinsumo`
--
ALTER TABLE `rela_productosinsumo`
  ADD PRIMARY KEY (`idrelacion`),
  ADD KEY `productoid` (`productoid`),
  ADD KEY `insumoid` (`insumoid`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`) USING BTREE;

--
-- Indexes for table `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`),
  ADD UNIQUE KEY `nom_usu_UNIQUE` (`nom_usu`),
  ADD KEY `fk_usuario_grupo_idx` (`grupoid`);

--
-- Indexes for table `usuario_copy`
--
ALTER TABLE `usuario_copy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom_us_UNIQUE` (`nom_us`),
  ADD KEY `fk_usuario_role_idx` (`rol_id_us`);

--
-- Indexes for table `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_idx` (`idpermiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`idusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auxiliar`
--
ALTER TABLE `auxiliar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idgru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `insumo`
--
ALTER TABLE `insumo`
  MODIFY `idinsumo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventariofisico`
--
ALTER TABLE `inventariofisico`
  MODIFY `idinventario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kardex`
--
ALTER TABLE `kardex`
  MODIFY `idkardex` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `idmed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `idmov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permiso_vendedor`
--
ALTER TABLE `permiso_vendedor`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permiso_vendedor_old`
--
ALTER TABLE `permiso_vendedor_old`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `idpro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `productoterminado`
--
ALTER TABLE `productoterminado`
  MODIFY `idproductoterminado` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rela_productosinsumo`
--
ALTER TABLE `rela_productosinsumo`
  MODIFY `idrelacion` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario_copy`
--
ALTER TABLE `usuario_copy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `fk_salida_producto` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idpro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salida_usuario` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`id_usu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`tipomovimientoid`) REFERENCES `tipomovimiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_media` FOREIGN KEY (`mediaid`) REFERENCES `media` (`idmed`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_grupo` FOREIGN KEY (`grupoid`) REFERENCES `grupo` (`idgru`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
