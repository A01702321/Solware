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


CREATE TABLE `Alimentar` (
  `IDCliente` int(11) NOT NULL,
  `IDPlatillo` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Menu` varchar(30) NOT NULL,
  `Tiempo` varchar(15) NOT NULL,
  KEY `IDCliente` (`IDCliente`),
  KEY `IDPlatillo` (`IDPlatillo`),
  CONSTRAINT `Alimentar_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  CONSTRAINT `Alimentar_ibfk_2` FOREIGN KEY (`IDPlatillo`) REFERENCES `Platillos` (`IDPlatillo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Categorias` (
  `IDCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCategoria` varchar(20) NOT NULL,
  PRIMARY KEY (`IDCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

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

CREATE TABLE `Clientes` (
  `IDCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) NOT NULL,
  `Menu` int(11) NOT NULL,
  PRIMARY KEY (`IDCliente`),
  KEY `Menu` (`Menu`),
  CONSTRAINT `Clientes_ibfk_1` FOREIGN KEY (`Menu`) REFERENCES `Menus` (`IDMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

CREATE TABLE `GruposAlimenticios` (
  `IDGrupoAl` int(11) NOT NULL AUTO_INCREMENT,
  `NombreGrupoAl` varchar(50) NOT NULL,
  PRIMARY KEY (`IDGrupoAl`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

CREATE TABLE `IngredienteCategoria` (
  `IDIngrediente` int(11) NOT NULL,
  `IDCategoria` int(11) NOT NULL,
  KEY `IDCategoria` (`IDCategoria`),
  KEY `IDIngrediente` (`IDIngrediente`),
  CONSTRAINT `IngredienteCategoria_ibfk_1` FOREIGN KEY (`IDCategoria`) REFERENCES `Categorias` (`IDCategoria`),
  CONSTRAINT `IngredienteCategoria_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `IngredientePreparado` (
  `IDPreparado` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL,
  KEY `IDPreparado` (`IDPreparado`),
  KEY `IDIngrediente` (`IDIngrediente`),
  CONSTRAINT `IngredientePreparado_ibfk_1` FOREIGN KEY (`IDPreparado`) REFERENCES `Preparados` (`IDPreparado`),
  CONSTRAINT `IngredientePreparado_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `IngredienteReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL,
  KEY `IDReceta` (`IDReceta`),
  KEY `IDIngrediente` (`IDIngrediente`),
  CONSTRAINT `IngredienteReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  CONSTRAINT `IngredienteReceta_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Ingredientes` (
  `IDIngrediente` int(11) NOT NULL AUTO_INCREMENT,
  `NombreIngrediente` varchar(20) NOT NULL,
  `GrupoAlimenticio` int(11) NOT NULL,
  PRIMARY KEY (`IDIngrediente`),
  KEY `GrupoAlimenticio` (`GrupoAlimenticio`),
  CONSTRAINT `Ingredientes_ibfk_1` FOREIGN KEY (`GrupoAlimenticio`) REFERENCES `GruposAlimenticios` (`IDGrupoAl`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

CREATE TABLE `MenuReceta` (
  `IDMenu` int(11) NOT NULL,
  `IDReceta` int(11) NOT NULL,
  KEY `IDMenu` (`IDMenu`),
  KEY `IDReceta` (`IDReceta`),
  CONSTRAINT `MenuReceta_ibfk_1` FOREIGN KEY (`IDMenu`) REFERENCES `Menus` (`IDMenu`),
  CONSTRAINT `MenuReceta_ibfk_2` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Menus` (
  `IDMenu` int(11) NOT NULL AUTO_INCREMENT,
  `NombreMenu` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

CREATE TABLE `Plan` (
  `IDCliente` int(11) NOT NULL,
  `NombreTiempo` varchar(10) NOT NULL,
  KEY `IDCliente` (`IDCliente`),
  KEY `NombreTiempo` (`NombreTiempo`),
  CONSTRAINT `Plan_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  CONSTRAINT `Plan_ibfk_2` FOREIGN KEY (`NombreTiempo`) REFERENCES `Tiempos` (`NombreTiempo`)
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

CREATE TABLE `PreparadoReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDPreparado` int(11) NOT NULL,
  KEY `IDReceta` (`IDReceta`),
  KEY `IDPreparado` (`IDPreparado`),
  CONSTRAINT `PreparadoReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  CONSTRAINT `PreparadoReceta_ibfk_2` FOREIGN KEY (`IDPreparado`) REFERENCES `Preparados` (`IDPreparado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Preparados` (
  `IDPreparado` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePreparado` varchar(20) NOT NULL,
  PRIMARY KEY (`IDPreparado`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

CREATE TABLE `RecetaReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDRecetaAlt` int(11) NOT NULL,
  KEY `IDReceta` (`IDReceta`),
  KEY `IDRecetaAlt` (`IDRecetaAlt`),
  CONSTRAINT `RecetaReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  CONSTRAINT `RecetaReceta_ibfk_2` FOREIGN KEY (`IDRecetaAlt`) REFERENCES `Recetas` (`IDReceta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Recetas` (
  `IDReceta` int(11) NOT NULL AUTO_INCREMENT,
  `NombreReceta` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDReceta`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

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

CREATE TABLE `Tiempos` (
  `NombreTiempo` varchar(10) NOT NULL,
  PRIMARY KEY (`NombreTiempo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Usuarios` (
  `IDUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUsuario` varchar(25) NOT NULL,
  `Contraseña` varchar(50) NOT NULL,
  PRIMARY KEY (`IDUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `Alimentar` (`IDCliente`, `IDPlatillo`, `Fecha`, `Menu`, `Tiempo`) VALUES ('79', '12', '2019-12-11', '20', 'Comida'),
('103', '12', '2019-12-11', '20', 'Comida'),
('103', '12', '2019-12-26', '20', 'Comida'),
('103', '12', '2020-02-14', '20', 'Comida'),
('79', '11', '2019-12-17', '20', 'Cena'),
('79', '9', '2019-12-13', '20', 'Cena'),
('103', '9', '2019-12-13', '20', 'Cena'),
('79', '12', '2019-12-13', '20', 'Comida'),
('79', '9', '2019-12-09', '20', 'Cena'),
('103', '9', '2019-12-09', '20', 'Cena'),
('79', '12', '2019-12-09', '20', 'Comida');

INSERT INTO `Categorias` (`IDCategoria`, `NombreCategoria`) VALUES ('1', 'Rojos'),
('2', 'Amarillos'),
('3', 'Verdes'),
('4', 'Cafés'),
('5', 'Fibras'),
('6', 'pan'),
('7', ''),
('8', 'Alimentos Naranjas'),
('9', 'Lácteos'),
('10', 'Leches'),
('11', 'Panes'),
('12', 'Trigos'),
('13', 'Alimentos Negros'),
('14', 'Lentejas y derivados'),
('15', 'Leguminosas dulces'),
('16', 'Blancos'),
('17', 'Arroces'),
('18', 'Alimentos Blancos'),
('19', 'Raíces'),
('20', 'chile'),
('21', 'fodmap'),
('22', 'Semillas'),
('23', 'Nueces'),
('24', 'Machupichu'),
('25', 'Zazu'),
('26', 'Macario'),
('27', 'Wakala'),
('28', 'Holaz');

INSERT INTO `Clientes` (`IDCliente`, `Nombre`, `Menu`) VALUES ('48', 'Lalo Gonzalez', '11'),
('50', 'Daniel Zavalza', '11'),
('54', 'Patricio', '42'),
('58', 'Juanito', '14'),
('63', 'Calamardo', '11'),
('64', 'Patricio', '14'),
('69', 'Bob el Constructor', '11'),
('74', 'Paul McCartney', '11'),
('77', 'Willy Wonka', '45'),
('78', 'Mickey Mouse', '46'),
('79', 'Bob Marley', '20'),
('101', 'Gato con Botas', '44'),
('102', 'Chapulín Colorado', '42'),
('103', 'Snoop Dogg', '20'),
('104', 'Ash Ketchup', '11');

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

INSERT INTO `IngredienteCategoria` (`IDIngrediente`, `IDCategoria`) VALUES ('10', '5'),
('13', '3'),
('14', '7'),
('15', '8'),
('16', '9'),
('17', '10'),
('18', '10'),
('19', '10'),
('21', '11'),
('21', '12'),
('24', '15'),
('25', '16'),
('25', '17'),
('26', '18'),
('26', '18'),
('26', '19'),
('26', '19'),
('27', '20'),
('27', '20'),
('27', '21'),
('27', '21'),
('30', '22'),
('23', '23'),
('34', '24'),
('34', '25'),
('34', '26'),
('34', '27'),
('34', '28');

INSERT INTO `IngredientePreparado` (`IDPreparado`, `IDIngrediente`) VALUES ('2', '5'),
('2', '16'),
('6', '22'),
('6', '26'),
('6', '31'),
('1', '1'),
('6', '1'),
('40', '37'),
('40', '35'),
('40', '36'),
('41', '38'),
('41', '16'),
('42', '47'),
('42', '43'),
('45', '40'),
('45', '41'),
('45', '35'),
('45', '50'),
('46', '22'),
('46', '45'),
('48', '63'),
('48', '62');

INSERT INTO `IngredienteReceta` (`IDReceta`, `IDIngrediente`) VALUES ('1', '11'),
('1', '32'),
('1', '33'),
('10', '8'),
('11', '11'),
('11', '5'),
('11', '7'),
('13', '16'),
('13', '41'),
('13', '39'),
('13', '40'),
('14', '40'),
('14', '41'),
('14', '16'),
('14', '38'),
('14', '39'),
('15', '10'),
('15', '22'),
('15', '51'),
('15', '57'),
('16', '21'),
('16', '41'),
('16', '20'),
('16', '58'),
('16', '51'),
('17', '51'),
('17', '57'),
('17', '53'),
('17', '43'),
('18', '22'),
('18', '61'),
('18', '31'),
('18', '26'),
('18', '6'),
('19', '60'),
('19', '60'),
('19', '33'),
('20', '62'),
('20', '33'),
('20', '64'),
('20', '56'),
('20', '43'),
('21', '65'),
('21', '32'),
('21', '33'),
('21', '51'),
('21', '6'),
('22', '14'),
('22', '22'),
('22', '29'),
('23', '62'),
('24', '62');

INSERT INTO `Ingredientes` (`IDIngrediente`, `NombreIngrediente`, `GrupoAlimenticio`) VALUES ('1', 'Chile', '15'),
('2', 'fresas', '16'),
('5', 'Banana', '16'),
('6', 'aguacate', '16'),
('7', 'Panditas', '20'),
('8', 'Miel', '26'),
('9', 'Vinagre', '24'),
('10', 'Piña', '16'),
('11', 'Bolillo', '20'),
('12', 'Mango', '16'),
('13', 'Pera', '16'),
('14', 'Lechuga', '15'),
('15', 'Calabaza', '15'),
('16', 'Leche', '20'),
('17', 'Leche de almendras', '19'),
('18', 'Leche de Coco', '19'),
('19', 'Leche de Trigo', '19'),
('20', 'Mostaza', '24'),
('21', 'Pan de Trigo', '17'),
('22', 'Jitomate', '15'),
('23', 'Cacahuate', '18'),
('24', 'Piñon', '18'),
('25', 'Arroz', '18'),
('26', 'Cebolla', '15'),
('27', 'Pimiento Morrón', '15'),
('29', 'Elote', '17'),
('30', 'Chia', '19'),
('31', 'Cilantro', '15'),
('32', 'Frijol', '18'),
('33', 'Queso', '21'),
('34', 'Champiñones', '25'),
('35', 'Agua', '23'),
('36', 'Limón', '16'),
('37', 'Azúcar', '26'),
('38', 'Chocolate en polvo', '26'),
('39', 'Chispas de chocolate', '26'),
('40', 'Harina', '17'),
('41', 'Huevo', '20'),
('42', 'Yerbabuena', '15'),
('43', 'Buena Hierba', '18'),
('44', 'Aceite Vegetal', '24'),
('45', 'Aceite de Oliva', '24'),
('46', 'Aceite de Coco', '24'),
('47', 'Mantequilla', '25'),
('48', 'Margarina', '25'),
('49', 'Buds', '15'),
('50', 'Levadura', '23'),
('51', 'Jamon', '21'),
('52', 'Salchicha', '21'),
('53', 'Salchichón', '22'),
('54', 'Chorizo', '22'),
('55', 'Jamón Serrano', '22'),
('56', 'Queso Oaxaca', '19'),
('57', 'Tocino', '19'),
('58', 'Mayonesa', '24'),
('59', 'Catsup', '17'),
('60', 'Pepperoni', '22'),
('61', 'Albaca', '15'),
('62', 'Totopos', '16'),
('63', 'Polvitos ricos', '17'),
('64', 'Jalapeño', '16'),
('65', 'Tortilla de harina', '17');

INSERT INTO `MenuReceta` (`IDMenu`, `IDReceta`) VALUES ('20', '10'),
('14', '11'),
('20', '11'),
('42', '11'),
('11', '13'),
('14', '13'),
('20', '13'),
('42', '13'),
('44', '13'),
('46', '13'),
('11', '14'),
('20', '14'),
('44', '15'),
('45', '15'),
('46', '15'),
('42', '16'),
('44', '16'),
('45', '16'),
('11', '17'),
('20', '17'),
('11', '18'),
('20', '18'),
('11', '19'),
('20', '19'),
('42', '19'),
('44', '19'),
('45', '19'),
('46', '19'),
('11', '20'),
('20', '20'),
('11', '21'),
('20', '21'),
('42', '21'),
('44', '21'),
('45', '21'),
('46', '21'),
('14', '22'),
('42', '22'),
('11', '23'),
('42', '24');

INSERT INTO `Menus` (`IDMenu`, `NombreMenu`) VALUES ('11', 'Psicodélico'),
('14', 'Meatless'),
('20', 'Espacial'),
('42', 'Chanclas'),
('43', 'Extravagante'),
('44', 'Ochentero'),
('45', 'Canadiense'),
('46', 'Chistoso');

INSERT INTO `Plan` (`IDCliente`, `NombreTiempo`) VALUES ('48', 'Comida'),
('48', 'Desayuno'),
('50', 'Cena'),
('50', 'Desayuno'),
('69', 'Cena'),
('69', 'Comida'),
('74', 'Comida'),
('77', 'Cena'),
('77', 'Comida'),
('77', 'Desayuno'),
('78', 'Desayuno'),
('79', 'Cena'),
('79', 'Comida'),
('79', 'Desayuno'),
('101', 'Cena'),
('101', 'Comida'),
('102', 'Desayuno'),
('103', 'Cena'),
('103', 'Comida'),
('103', 'Desayuno'),
('104', 'Comida'),
('104', 'Desayuno');

INSERT INTO `PlatilloIngrediente` (`IDPlatillo`, `IDIngrediente`) VALUES ('10', '59'),
('4', '1'),
('5', '0'),
('6', '7'),
('7', '0'),
('8', '5'),
('9', '1'),
('10', '36'),
('10', '9'),
('11', '7'),
('11', '43'),
('12', '59'),
('13', '22'),
('13', '26'),
('13', '1'),
('13', '6'),
('14', '38'),
('14', '54'),
('15', '0'),
('16', '0'),
('17', '1'),
('17', '38');

INSERT INTO `PlatilloPreparado` (`IDPlatillo`, `IDPreparado`) VALUES ('11', '5'),
('4', '6'),
('5', '6'),
('7', '39'),
('8', '6'),
('9', '2'),
('15', '2'),
('15', '3'),
('16', '2');

INSERT INTO `PlatilloReceta` (`IDPlatillo`, `IDReceta`) VALUES ('4', '1'),
('5', '1'),
('6', '1'),
('7', '1'),
('8', '1'),
('9', '11'),
('10', '22'),
('10', '19'),
('11', '20'),
('11', '14'),
('12', '15'),
('12', '17'),
('12', '19');

INSERT INTO `Platillos` (`IDPlatillo`, `Menu`, `Tiempo`, `Notas`, `NombrePlatillo`) VALUES ('2', '14', 'Comida', 'Molletes coon chile al lado', 'Molletes con pico de gallo y chile'),
('3', '11', 'Comida', 'Molletes con chile al lado.', 'Molletes con chile y pico de gallo'),
('4', '42', 'Comida', 'Molletes con chile.', 'Molletes con pico de gallo y chile'),
('5', '14', 'Comida', 'No trae chile.', 'Molletes con pico de gallo'),
('6', '43', 'Comida', 'Molletes con unos ricos panditas de postre.', 'Mollletes con panditas'),
('7', '44', 'Cena', '', 'Molletes con guacamole'),
('8', '42', 'Comida', 'El plátano va arriba', 'Molletes con plátano'),
('9', '20', 'Cena', 'Solo para los mas locos ', 'Torta de panditas acompañada de liquado de banana y chile'),
('10', '44', 'Comida', 'Vinagre y limon van de aderezo en la ensalada. ', 'Pizza con ensalada y demas'),
('11', '20', 'Cena', 'La buena hierba va a parte para el placer del cliente.', 'Nachos con Brownies para pasarla \"bien\"'),
('12', '20', 'Comida', 'Pizza por doquier', 'Pizzapaluza'),
('13', '11', 'Cena', '', 'Test'),
('14', '20', 'Comida', 'Wacala', 'Platillo con popo'),
('15', '11', 'Desayuno', '', 'Desayuno de champs'),
('16', '11', 'Desayuno', '', 'Platillo de likuado'),
('17', '43', 'Cena', '', 'Platillo delicioso');

INSERT INTO `PreparadoReceta` (`IDReceta`, `IDPreparado`) VALUES ('1', '6'),
('14', '42'),
('15', '45'),
('17', '45'),
('17', '47'),
('18', '43'),
('19', '45'),
('19', '46'),
('20', '44'),
('21', '1'),
('23', '1'),
('24', '6');

INSERT INTO `Preparados` (`IDPreparado`, `NombrePreparado`) VALUES ('1', 'Salsa'),
('2', 'licuado banana'),
('3', 'Panqué de arándanos'),
('5', 'Panes'),
('6', 'Pico de Gallo'),
('39', 'guacamole'),
('40', 'Abuita de limón'),
('41', 'Chocomilk'),
('42', 'Mantequilla Verde'),
('43', 'Aceite de Oliva Verd'),
('44', 'Aceite de Coco y Hie'),
('45', 'Masa de Pizza'),
('46', 'Salsa de Pizza'),
('47', 'Salsa de Pizza Magic'),
('48', 'Doritos Incognita');

INSERT INTO `RecetaReceta` (`IDReceta`, `IDRecetaAlt`) VALUES ('10', '1'),
('13', '10');

INSERT INTO `Recetas` (`IDReceta`, `NombreReceta`, `Descripcion`) VALUES ('1', 'Molletes', 'Descripcion random'),
('10', 'Brownies de la abuelita', 'Brownies con miel y C10H15N.'),
('11', 'Torta de panditas dulce', 'Gran torta con platano y panditas.'),
('13', 'Chips Ahoy!', 'Deliciosas Chips Ahoy! genericas sin derechos reservados.'),
('14', 'Brownies Espaciales', 'Brownies que te dejaran queriendo más. Pero no debes comer más.'),
('15', 'Pizza Hawaiana', 'Pizza que baila hula hula'),
('16', 'Sandwich de buebo', 'Rico chanwis de buebito '),
('17', 'Pizza Espacial', 'Pizza para volar por los aires'),
('18', 'Gucamole Espacial', 'Guacamole para compartir con los cuates y no tan cuates.'),
('19', 'Pizza de Peperoni', 'La clasica pizza de peperoni con peperoni extra'),
('20', 'Nachos con queso espaciales', 'Nachos que te haran nadar por los cielos y volar por los mares.'),
('21', 'Sincronizadas', 'Tortilla, aguacate, queso, jamon, frijol y otra tortilla. Con una deliciosa salsa.'),
('22', 'Ensalada de jitomate con mas', 'Ensalada aburrida'),
('23', 'Prueba', ''),
('24', 'PruebaSegunda', '');

INSERT INTO `RecetaTiempo` (`NombreTiempo`, `IDReceta`) VALUES ('Cena', '10'),
('Cena', '11'),
('Cena', '13'),
('Desayuno', '13'),
('Cena', '14'),
('Desayuno', '14'),
('Cena', '15'),
('Comida', '15'),
('Cena', '16'),
('Comida', '16'),
('Cena', '17'),
('Comida', '17'),
('Desayuno', '17'),
('Cena', '18'),
('Comida', '18'),
('Cena', '19'),
('Cena', '20'),
('Comida', '20'),
('Cena', '21'),
('Desayuno', '21'),
('Cena', '22'),
('Comida', '22'),
('Cena', '23'),
('Comida', '23'),
('Desayuno', '23'),
('Cena', '24'),
('Comida', '24'),
('Desayuno', '24');

INSERT INTO `Restriccion` (`IDCliente`, `IDIngrediente`) VALUES ('48', '31'),
('50', '32'),
('48', '31'),
('50', '32'),
('69', '14'),
('69', '17'),
('69', '18'),
('74', '11'),
('77', '11'),
('77', '26'),
('77', '17'),
('77', '19'),
('77', '18'),
('78', '21'),
('78', '27'),
('79', '11'),
('79', '26'),
('79', '2'),
('101', '39'),
('101', '34'),
('101', '30'),
('101', '19'),
('102', '33'),
('102', '2'),
('103', '43');

INSERT INTO `Tiempos` (`NombreTiempo`) VALUES ('Cena'),
('Comida'),
('Desayuno');

INSERT INTO `Usuarios` (`IDUsuario`, `NombreUsuario`, `Contraseña`) VALUES ('1', 'user', 'password123'),
('2', 'max', '12qw12qw'),
('3', 'lalo', 'zxcasdqwe123'),
('4', 'daniel', 'laquesea'),
('5', 'aliciavaspi', '#Habeats50!');




/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;