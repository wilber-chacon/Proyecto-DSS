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

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla banco_agricultura.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `codigo_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla banco_agricultura.sesiones
CREATE TABLE IF NOT EXISTS `sesiones` (
  `codigo_sesion` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `pass` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cod_verificacion` varchar(10) DEFAULT NULL,
  `date_verficacion` datetime DEFAULT NULL,
  PRIMARY KEY (`codigo_sesion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla banco_agricultura.sucursal
CREATE TABLE IF NOT EXISTS `sucursal` (
  `codigo_sucursal` int NOT NULL AUTO_INCREMENT,
  `nombre_sucursal` varchar(100) NOT NULL,
  `direccion_sucursal` text NOT NULL,
  PRIMARY KEY (`codigo_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

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

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
