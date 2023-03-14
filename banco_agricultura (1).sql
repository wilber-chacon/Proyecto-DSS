-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para banco_agricultura
DROP DATABASE IF EXISTS `banco_agricultura`;
CREATE DATABASE IF NOT EXISTS `banco_agricultura` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `banco_agricultura`;

-- Volcando estructura para tabla banco_agricultura.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `codigo_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(200) NOT NULL,
  `DUI_cliente` varchar(10) NOT NULL,
  `correo_cliente` varchar(100) DEFAULT NULL,
  `telefono_cliente` varchar(9) DEFAULT NULL,
  `domicilio_cliente` text NOT NULL,
  `fechaNacimiento_cliente` date NOT NULL,
  `sueldoCliente` double(6,2) NOT NULL,
  `codigo_sesion` int NOT NULL,
  PRIMARY KEY (`codigo_cliente`),
  KEY `sesionfk_3` (`codigo_sesion`),
  CONSTRAINT `sesionfk_3` FOREIGN KEY (`codigo_sesion`) REFERENCES `sesiones` (`codigo_sesion`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.cliente: ~4 rows (aproximadamente)
DELETE FROM `cliente`;
INSERT INTO `cliente` (`codigo_cliente`, `nombre_cliente`, `DUI_cliente`, `correo_cliente`, `telefono_cliente`, `domicilio_cliente`, `fechaNacimiento_cliente`, `sueldoCliente`, `codigo_sesion`) VALUES
	(11, 'Davis Merlos', '06523406-5', 'davis15merlos@gmail.com', '7956-9665', 'San Salvador', '2002-07-25', 600.00, 10),
	(12, 'Roberto Vásquez', '06231336-2', 'desarrollo@acaces.com.sv', '7953-5632', 'San Marcos', '1992-09-09', 600.00, 11),
	(13, 'Elena Landaverde', '06532565-6', 'marialandaverde1993@gmail.com', '7956-6262', 'Apopa', '1993-12-26', 966.00, 12),
	(14, 'Mario Hernandez', '27482542-9', 'mario.hernandez@gmail.com', '7245-3422', 'Soyapango', '1996-03-15', 545.75, 13);

-- Volcando estructura para tabla banco_agricultura.cuentabancaria
CREATE TABLE IF NOT EXISTS `cuentabancaria` (
  `numCuenta` varchar(12) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `tipoCuenta` varchar(200) NOT NULL,
  `saldoCuenta` double(6,2) NOT NULL,
  `lugarCreacion` varchar(100) NOT NULL,
  `codigo_cliente` int NOT NULL,
  PRIMARY KEY (`numCuenta`),
  KEY `clientefk_2` (`codigo_cliente`),
  CONSTRAINT `clientefk_2` FOREIGN KEY (`codigo_cliente`) REFERENCES `cliente` (`codigo_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.cuentabancaria: ~0 rows (aproximadamente)
DELETE FROM `cuentabancaria`;

-- Volcando estructura para tabla banco_agricultura.dependiente
CREATE TABLE IF NOT EXISTS `dependiente` (
  `codigo_dependiente` int NOT NULL AUTO_INCREMENT,
  `nombre_dependiente` varchar(200) NOT NULL,
  `DUI_dependiente` varchar(10) NOT NULL,
  `correo_dependiente` varchar(100) DEFAULT NULL,
  `telefono_dependiente` varchar(9) DEFAULT NULL,
  `direccionNegocio` text NOT NULL,
  `tipoNegocio` varchar(200) NOT NULL,
  `codigo_sesion` int NOT NULL,
  PRIMARY KEY (`codigo_dependiente`),
  KEY `sesionfk_2` (`codigo_sesion`),
  CONSTRAINT `sesionfk_2` FOREIGN KEY (`codigo_sesion`) REFERENCES `sesiones` (`codigo_sesion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.dependiente: ~0 rows (aproximadamente)
DELETE FROM `dependiente`;

-- Volcando estructura para tabla banco_agricultura.empleados
CREATE TABLE IF NOT EXISTS `empleados` (
  `codigo_empleado` int NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(200) NOT NULL,
  `DUI_empleado` varchar(10) NOT NULL,
  `correo_empleado` varchar(100) DEFAULT NULL,
  `telefono_empleado` varchar(9) DEFAULT NULL,
  `Estado_empleado` varchar(50) NOT NULL,
  `domicilio_empleado` text NOT NULL,
  `acciones` text NOT NULL,
  `fechaNacimiento_empleado` date NOT NULL,
  `codigo_rol` int NOT NULL,
  `codigo_sesion` int NOT NULL,
  `codigo_sucursal` int NOT NULL,
  PRIMARY KEY (`codigo_empleado`),
  KEY `rolfk_1` (`codigo_rol`),
  KEY `sucursalfk_1` (`codigo_sucursal`),
  KEY `sesionfk_1` (`codigo_sesion`),
  CONSTRAINT `rolfk_1` FOREIGN KEY (`codigo_rol`) REFERENCES `roles` (`codigo_rol`),
  CONSTRAINT `sesionfk_1` FOREIGN KEY (`codigo_sesion`) REFERENCES `sesiones` (`codigo_sesion`),
  CONSTRAINT `sucursalfk_1` FOREIGN KEY (`codigo_sucursal`) REFERENCES `sucursal` (`codigo_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.empleados: ~3 rows (aproximadamente)
DELETE FROM `empleados`;
INSERT INTO `empleados` (`codigo_empleado`, `nombre_empleado`, `DUI_empleado`, `correo_empleado`, `telefono_empleado`, `Estado_empleado`, `domicilio_empleado`, `acciones`, `fechaNacimiento_empleado`, `codigo_rol`, `codigo_sesion`, `codigo_sucursal`) VALUES
	(1, 'Wilber Francisco Chacón Erroa', '12345678-9', 'wilber.franciscochacon@gmail.com', '6543-4352', 'Activo', 'Soyapango', 'All', '2002-03-21', 5, 14, 3),
	(2, 'Juan Guillermo Juárez', '05451244-5', 'juan@gmail.com', '9562-5653', 'Activo', 'Soyapango', 'All', '2023-03-13', 7, 15, 4),
	(3, 'Pedro', '06532665-5', 'pedro@gmail.com', '7895-5653', 'Activo', 'San Salvador', 'All', '2000-09-03', 1, 16, 1);

-- Volcando estructura para tabla banco_agricultura.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `numTransaccion` varchar(12) NOT NULL,
  `tipoTransaccion` varchar(200) NOT NULL,
  `fechaTransaccion` date NOT NULL,
  `montoTransaccion` double(6,2) NOT NULL,
  `lugarTransaccion` varchar(200) NOT NULL,
  `numCuenta` varchar(12) NOT NULL,
  PRIMARY KEY (`numTransaccion`),
  KEY `cuentafk_2` (`numCuenta`),
  CONSTRAINT `cuentafk_2` FOREIGN KEY (`numCuenta`) REFERENCES `cuentabancaria` (`numCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.movimientos: ~0 rows (aproximadamente)
DELETE FROM `movimientos`;

-- Volcando estructura para tabla banco_agricultura.prestamos
CREATE TABLE IF NOT EXISTS `prestamos` (
  `numPrestamo` int NOT NULL AUTO_INCREMENT,
  `estado_prestamo` varchar(50) NOT NULL,
  `fechaApertura` date NOT NULL,
  `monto_prestamo` double(6,2) NOT NULL,
  `porcentajeInteres` int NOT NULL,
  `cuotaMensual` double(6,2) NOT NULL,
  `cantYearAPagar` int NOT NULL,
  `codigo_cliente` int NOT NULL,
  PRIMARY KEY (`numPrestamo`),
  KEY `clientefk_1` (`codigo_cliente`),
  CONSTRAINT `clientefk_1` FOREIGN KEY (`codigo_cliente`) REFERENCES `cliente` (`codigo_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.prestamos: ~1 rows (aproximadamente)
DELETE FROM `prestamos`;
INSERT INTO `prestamos` (`numPrestamo`, `estado_prestamo`, `fechaApertura`, `monto_prestamo`, `porcentajeInteres`, `cuotaMensual`, `cantYearAPagar`, `codigo_cliente`) VALUES
	(1, 'Aprobado', '2023-03-10', 2000.00, 3, 58.16, 3, 11);

-- Volcando estructura para tabla banco_agricultura.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `codigo_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.roles: ~8 rows (aproximadamente)
DELETE FROM `roles`;
INSERT INTO `roles` (`codigo_rol`, `nombre_rol`) VALUES
	(1, 'Cajero'),
	(2, 'Limpieza'),
	(3, 'Recepcionista'),
	(4, 'Mesa'),
	(5, 'Gerente de sucursal'),
	(6, 'Gerente general del banco'),
	(7, 'Cliente'),
	(8, 'Dependiente del banco');

-- Volcando estructura para tabla banco_agricultura.sesiones
CREATE TABLE IF NOT EXISTS `sesiones` (
  `codigo_sesion` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `pass` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cod_verificacion` varchar(10) DEFAULT NULL,
  `date_verficacion` datetime DEFAULT NULL,
  PRIMARY KEY (`codigo_sesion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.sesiones: ~7 rows (aproximadamente)
DELETE FROM `sesiones`;
INSERT INTO `sesiones` (`codigo_sesion`, `usuario`, `pass`, `cod_verificacion`, `date_verficacion`) VALUES
	(10, 'dmerlos', 'e10adc3949ba59abbe56e057f20f883e', '244013', '2023-03-10 11:13:39'),
	(11, 'rvasquez', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL),
	(12, 'elandaverde', 'e10adc3949ba59abbe56e057f20f883e', '102396', '2023-03-10 11:42:23'),
	(13, 'mario.hernandez@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, NULL),
	(14, 'wilber.franciscochacon@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, NULL),
	(15, 'juan@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, NULL),
	(16, 'pedro@gmail.com', 'Ãä÷Ù¹¨Oîû|¿AaÛo', NULL, NULL);

-- Volcando estructura para tabla banco_agricultura.sucursal
CREATE TABLE IF NOT EXISTS `sucursal` (
  `codigo_sucursal` int NOT NULL AUTO_INCREMENT,
  `nombre_sucursal` varchar(100) NOT NULL,
  `direccion_sucursal` text NOT NULL,
  PRIMARY KEY (`codigo_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.sucursal: ~6 rows (aproximadamente)
DELETE FROM `sucursal`;
INSERT INTO `sucursal` (`codigo_sucursal`, `nombre_sucursal`, `direccion_sucursal`) VALUES
	(1, 'Agencia plaza futura', 'Edif. Torre Futura y Plaza Futura, Col. Escalón, SS.'),
	(2, 'Agencia masferrer', 'Final Paseo General Escalón No. 5148, S. S.'),
	(3, 'Agencia galerias', 'Centro Com. Galerías Escalón, 1er. Nivel Local 117 y 118-A.'),
	(4, 'Agencia bambu', 'Boulevard El Hipódromo y Avenida Las Magnolias, San Salvador'),
	(5, 'Agencia roosevelt san salvador', '43 Avenida Norte y Alameda Franklin Delano Roosevelt No. 2222, San Salvador'),
	(6, 'Agencia altavista', 'Ctro. Comercial Unicentro Altavista, Local 6B a 8B, Ilopango');

-- Volcando estructura para tabla banco_agricultura.transferencias
CREATE TABLE IF NOT EXISTS `transferencias` (
  `numTransferencia` varchar(12) NOT NULL,
  `fechaTransferencia` date NOT NULL,
  `montoTransferencia` double(6,2) NOT NULL,
  `cuentaDestino` varchar(12) NOT NULL,
  `conceptoTransferencia` text NOT NULL,
  `numCuenta` varchar(12) NOT NULL,
  PRIMARY KEY (`numTransferencia`),
  KEY `cuentafk_1` (`numCuenta`),
  CONSTRAINT `cuentafk_1` FOREIGN KEY (`numCuenta`) REFERENCES `cuentabancaria` (`numCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla banco_agricultura.transferencias: ~0 rows (aproximadamente)
DELETE FROM `transferencias`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
