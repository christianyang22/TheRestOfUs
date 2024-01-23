-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para therestofus
CREATE DATABASE IF NOT EXISTS `therestofus` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `therestofus`;

-- Volcando estructura para tabla therestofus.donaciones
CREATE TABLE IF NOT EXISTS `donaciones` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Monto` double NOT NULL,
  `MontoTotal` double NOT NULL DEFAULT 0,
  `Tipo` tinyint(4) NOT NULL DEFAULT 1,
  `Timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla therestofus.donaciones: ~2 rows (aproximadamente)
DELETE FROM `donaciones`;
INSERT INTO `donaciones` (`id`, `Username`, `Monto`, `MontoTotal`, `Tipo`, `Timestamp`) VALUES
	(1, 'juanito123', 2000000, 2000000, 1, '2024-01-23 19:23:09'),
	(2, 'juanito123', 500000, 2500000, 1, '2024-01-23 23:06:06');

-- Volcando estructura para tabla therestofus.tipo_usuarios
CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `ID` tinyint(4) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla therestofus.tipo_usuarios: ~2 rows (aproximadamente)
DELETE FROM `tipo_usuarios`;
INSERT INTO `tipo_usuarios` (`ID`, `Tipo`) VALUES
	(1, 'Usuario'),
	(2, 'Admin');

-- Volcando estructura para tabla therestofus.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Direccion` varchar(255) NOT NULL,
  `rol` tinyint(4) DEFAULT 1,
  `Timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_tipo_usuarios` (`rol`),
  CONSTRAINT `FK_usuarios_tipo_usuarios` FOREIGN KEY (`rol`) REFERENCES `tipo_usuarios` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla therestofus.usuarios: ~4 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`id`, `Username`, `Password`, `Nombre`, `Apellido`, `Edad`, `Direccion`, `rol`, `Timestamp`) VALUES
	(1, 'Adrilaixer51', '$2y$10$7.TCIEzlUzB5s3FLPnD3a.RxE8HgRYQyoIgZYQQWADVaue8WWGtMK', 'Adrian', 'Granado', 20, 'Adrilaixer.gta@gmail.com', 2, '2023-12-29 19:11:23'),
	(2, 'Panda', '$2y$10$7.TCIEzlUzB5s3FLPnD3a.RxE8HgRYQyoIgZYQQWADVaue8WWGtMK', 'Christian', 'Yang', 25, 'Panda.calibeno@gmail.com', 2, '2023-12-29 19:12:29'),
	(4, 'juanito123', '$2y$10$Ds7uLybW3LjHoTklYhcpAuX8z4fkTmLKueuCSEOTi4zR1qvDYJR6C', 'Juan', 'Rodriguez', 20, 'CLola 34', 1, '2024-01-08 11:19:41'),
	(5, 'Antonio543', '$2y$10$zAnLPkkm7JGNWNaUz7AREOaBanb9LKqhLVckF.qyG09dmCSwZ3UtK', 'Antonio', 'Guzman', 34, 'CLeida 45', 1, '2024-01-08 12:07:43'),
	(6, 'Jose12', '$2y$10$phKbUbhS.94TmEkwM60vd.iBhrUs3rm26dHsoYeEaNE4QTeQLIj1K', 'Jose', 'Surmaano', 21, 'C/Lola', 1, '2024-01-11 19:18:01'),
	(7, 'jok45', '$2y$10$e2.Y7rBX4G/6BSUUG9/BQuh2DEqv5r4LYe6kEERfnLK0UBzMTtVcG', 'jok', 'lolo', 14, 'c/kil', 1, '2024-01-19 01:27:24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
