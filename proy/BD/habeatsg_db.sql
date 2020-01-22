-- -------------------------------------------------------------
-- TablePlus 2.8.2(256)
--
-- https://tableplus.com/
--
-- Database: habeatsg_db
-- Generation Time: 2019-12-09 17:53:52.9870
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `Usuarios` (
  `IDUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUsuario` varchar(100) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  PRIMARY KEY (`IDUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `Menus` (
  `IDMenu` int(11) NOT NULL AUTO_INCREMENT,
  `NombreMenu` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `Tiempos` (
  `NombreTiempo` varchar(10) NOT NULL,
  PRIMARY KEY (`NombreTiempo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Clientes` (
  `IDCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Menu` int(11) NOT NULL,
  PRIMARY KEY (`IDCliente`),
  KEY `Menu` (`Menu`),
  CONSTRAINT `Clientes_ibfk_1` FOREIGN KEY (`Menu`) REFERENCES `Menus` (`IDMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `Categorias` (
  `IDCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCategoria` varchar(100) NOT NULL,
  PRIMARY KEY (`IDCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `GruposAlimenticios` (
  `IDGrupoAl` int(11) NOT NULL AUTO_INCREMENT,
  `NombreGrupoAl` varchar(50) NOT NULL,
  PRIMARY KEY (`IDGrupoAl`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `Ingredientes` (
  `IDIngrediente` int(11) NOT NULL AUTO_INCREMENT,
  `NombreIngrediente` varchar(100) NOT NULL,
  `GrupoAlimenticio` int(11) NOT NULL,
  PRIMARY KEY (`IDIngrediente`),
  KEY `GrupoAlimenticio` (`GrupoAlimenticio`),
  CONSTRAINT `Ingredientes_ibfk_1` FOREIGN KEY (`GrupoAlimenticio`) REFERENCES `GruposAlimenticios` (`IDGrupoAl`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `Plan` (
  `IDCliente` int(11) NOT NULL,
  `NombreTiempo` varchar(50) NOT NULL,
  KEY `IDCliente` (`IDCliente`),
  KEY `NombreTiempo` (`NombreTiempo`),
  CONSTRAINT `Plan_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  CONSTRAINT `Plan_ibfk_2` FOREIGN KEY (`NombreTiempo`) REFERENCES `Tiempos` (`NombreTiempo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Platillos` (
  `IDPlatillo` int(11) NOT NULL AUTO_INCREMENT,
  `Menu` int(11) NOT NULL,
  `Tiempo` varchar(10) NOT NULL,
  `Notas` varchar(600) DEFAULT NULL,
  `NombrePlatillo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`IDPlatillo`),
  KEY `Menu` (`Menu`),
  KEY `Tiempo` (`Tiempo`),
  CONSTRAINT `Platillos_ibfk_1` FOREIGN KEY (`Menu`) REFERENCES `Menus` (`IDMenu`),
  CONSTRAINT `Platillos_ibfk_2` FOREIGN KEY (`Tiempo`) REFERENCES `Tiempos` (`NombreTiempo`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `Alimentar` (
  `IDCliente` int(11) NOT NULL,
  `IDPlatillo` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Menu` varchar(100) NOT NULL,
  `Tiempo` varchar(15) NOT NULL,
  KEY `IDCliente` (`IDCliente`),
  KEY `IDPlatillo` (`IDPlatillo`),
  CONSTRAINT `Alimentar_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  CONSTRAINT `Alimentar_ibfk_2` FOREIGN KEY (`IDPlatillo`) REFERENCES `Platillos` (`IDPlatillo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ClientePlatillo` (
  `IDCliente` int(11) NOT NULL,
  `IDPlatillo` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Tiempo` varchar(10) NOT NULL,
  `IDMenu` int(11) DEFAULT NULL,
  KEY `IDCliente` (`IDCliente`),
  KEY `IDPlatillo` (`IDPlatillo`),
  KEY `Tiempo` (`Tiempo`),
  CONSTRAINT `ClientePlatillo_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  CONSTRAINT `ClientePlatillo_ibfk_2` FOREIGN KEY (`IDPlatillo`) REFERENCES `Platillos` (`IDPlatillo`),
  CONSTRAINT `ClientePlatillo_ibfk_3` FOREIGN KEY (`Tiempo`) REFERENCES `Tiempos` (`NombreTiempo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `IngredienteCategoria` (
  `IDIngrediente` int(11) NOT NULL,
  `IDCategoria` int(11) NOT NULL,
  KEY `IDCategoria` (`IDCategoria`),
  KEY `IDIngrediente` (`IDIngrediente`),
  CONSTRAINT `IngredienteCategoria_ibfk_1` FOREIGN KEY (`IDCategoria`) REFERENCES `Categorias` (`IDCategoria`),
  CONSTRAINT `IngredienteCategoria_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Preparados` (
  `IDPreparado` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePreparado` varchar(20) NOT NULL,
  PRIMARY KEY (`IDPreparado`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `IngredientePreparado` (
  `IDPreparado` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL,
  KEY `IDPreparado` (`IDPreparado`),
  KEY `IDIngrediente` (`IDIngrediente`),
  CONSTRAINT `IngredientePreparado_ibfk_1` FOREIGN KEY (`IDPreparado`) REFERENCES `Preparados` (`IDPreparado`),
  CONSTRAINT `IngredientePreparado_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Recetas` (
  `IDReceta` int(11) NOT NULL AUTO_INCREMENT,
  `NombreReceta` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDReceta`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `IngredienteReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL,
  KEY `IDReceta` (`IDReceta`),
  KEY `IDIngrediente` (`IDIngrediente`),
  CONSTRAINT `IngredienteReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  CONSTRAINT `IngredienteReceta_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `MenuReceta` (
  `IDMenu` int(11) NOT NULL,
  `IDReceta` int(11) NOT NULL,
  KEY `IDMenu` (`IDMenu`),
  KEY `IDReceta` (`IDReceta`),
  CONSTRAINT `MenuReceta_ibfk_1` FOREIGN KEY (`IDMenu`) REFERENCES `Menus` (`IDMenu`),
  CONSTRAINT `MenuReceta_ibfk_2` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `PlatilloIngrediente` (
  `IDPlatillo` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL,
  KEY `IDPlatillo` (`IDPlatillo`),
  KEY `IDIngrediente` (`IDIngrediente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `PlatilloPreparado` (
  `IDPlatillo` int(11) NOT NULL,
  `IDPreparado` int(11) NOT NULL,
  KEY `IDPlatillo` (`IDPlatillo`),
  KEY `IDPreparado` (`IDPreparado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `PlatilloReceta` (
  `IDPlatillo` int(11) NOT NULL,
  `IDReceta` int(11) NOT NULL,
  KEY `IDPlatillo` (`IDPlatillo`),
  KEY `IDReceta` (`IDReceta`),
  CONSTRAINT `PlatilloReceta_ibfk_1` FOREIGN KEY (`IDPlatillo`) REFERENCES `Platillos` (`IDPlatillo`),
  CONSTRAINT `PlatilloReceta_ibfk_2` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `PreparadoReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDPreparado` int(11) NOT NULL,
  KEY `IDReceta` (`IDReceta`),
  KEY `IDPreparado` (`IDPreparado`),
  CONSTRAINT `PreparadoReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  CONSTRAINT `PreparadoReceta_ibfk_2` FOREIGN KEY (`IDPreparado`) REFERENCES `Preparados` (`IDPreparado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `RecetaReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDRecetaAlt` int(11) NOT NULL,
  KEY `IDReceta` (`IDReceta`),
  KEY `IDRecetaAlt` (`IDRecetaAlt`),
  CONSTRAINT `RecetaReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  CONSTRAINT `RecetaReceta_ibfk_2` FOREIGN KEY (`IDRecetaAlt`) REFERENCES `Recetas` (`IDReceta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `RecetaTiempo` (
  `NombreTiempo` varchar(10) NOT NULL,
  `IDReceta` int(11) NOT NULL,
  KEY `NombreTiempo` (`NombreTiempo`),
  KEY `IDReceta` (`IDReceta`),
  CONSTRAINT `RecetaTiempo_ibfk_1` FOREIGN KEY (`NombreTiempo`) REFERENCES `Tiempos` (`NombreTiempo`),
  CONSTRAINT `RecetaTiempo_ibfk_2` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Restriccion` (
  `IDCliente` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL,
  KEY `IDCliente` (`IDCliente`),
  KEY `IDIngrediente` (`IDIngrediente`),
  CONSTRAINT `Restriccion_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  CONSTRAINT `Restriccion_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




INSERT INTO `GruposAlimenticios` (`IDGrupoAl`, `NombreGrupoAl`) VALUES ('15', 'Verduras'),
('16', 'Frutas'),
('17', 'Cereales sin grasa'),
('18', 'Leguminosas'),
('19', 'A. O. A. muy bajo en grasa'),
('20', 'A. O. A. bajo en grasa'),
('21', 'A. O. A. moderado en grasa'),
('22', 'A. O. A. alto en grasa'),
('23', 'Leche descremada'),
('24', 'Aceites y grasas'),
('25', 'Aceites y grasas con proteina'),
('26', 'Azucares sin grasa');


INSERT INTO `Tiempos` (`NombreTiempo`) VALUES ('Cena'),
('Comida'),
('Desayuno');

INSERT INTO `Usuarios` (`IDUsuario`, `NombreUsuario`, `Contraseña`) VALUES ('1', 'user', 'password123'),
('2', 'max', '12qw12qw'),
('3', 'lalo', 'zxcasdqwe123'),
('4', 'daniel', 'laquesea'),
('5', 'aliciavaspi', '#Habeats50!');


DELIMITER $$
 
CREATE PROCEDURE getGrupoAt(
    in  p_idGrupo int(11))
BEGIN
    
 
    
   
    SELECT NombreGrupoAl
    FROM GruposAlimenticios
    WHERE IDGrupoAl = p_idGrupo;
 
 

 
END$$

DELIMITER $$
 
CREATE PROCEDURE getIngredientes()

BEGIN
    SELECT IDIngrediente, NombreIngrediente, GrupoAlimenticio
    FROM Ingredientes;
    END$$


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;