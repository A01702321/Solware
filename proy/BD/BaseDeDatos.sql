-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 18, 2019 at 07:06 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clase`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categorias`
--

CREATE TABLE `Categorias` (
  `IDCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ClientePlatillo`
--

CREATE TABLE `ClientePlatillo` (
  `IDCliente` int(11) NOT NULL,
  `IDPlatillo` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Tiempo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Clientes`
--

CREATE TABLE `Clientes` (
  `IDCliente` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Clientes`
--

/*INSERT INTO `Clientes` (`IDCliente`, `Nombre`, `Menu`) VALUES

(2, 'lalo', 2),
(3, 'fwf', 2),
(4, 'vewgew', 5),
(5, 'Ricardo', 2),
(6, 'ric', 5),
(7, 'dwq', 5),
(8, 'tpma', 2),
(9, 'bdf', 1),
(10, 'popo', 2),
(11, 'vbnm', 1),
(12, 'okp', 2),
(13, 'pipi', 1),
(14, 'pip', 1),
(15, 'pi', 1),
(16, 'p', 1),
(17, ' cvdsvds', 2),
(18, ' cvdsvd', 2),
(19, ' cvdsv', 2),
(20, ' cvds', 2),
(21, ' cvd', 2),
(22, ' cv', 2),
(23, 'Juanis', 1),
(24, 'Chayo', 1); */

-- --------------------------------------------------------

--
-- Table structure for table `GruposAlimenticios`
--

CREATE TABLE `GruposAlimenticios` (
  `IDGrupoAl` int(11) NOT NULL,
  `NombreGrupoAl` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GruposAlimenticios`
--

INSERT INTO `GruposAlimenticios` (`IDGrupoAl`, `NombreGrupoAl`) VALUES
/*(1, 'Lacteos'),
(2, 'Legrumbres');*/

-- --------------------------------------------------------

--
-- Table structure for table `IngredienteCategoria`
--

CREATE TABLE `IngredienteCategoria` (
  `IDIngrediente` int(11) NOT NULL,
  `IDCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `IngredientePreparado`
--

CREATE TABLE `IngredientePreparado` (
  `IDPreparado` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `IngredienteReceta`
--

CREATE TABLE `IngredienteReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ingredientes`
--

CREATE TABLE `Ingredientes` (
  `IDIngrediente` int(11) NOT NULL,
  `NombreIngrediente` varchar(20) NOT NULL,
  `GrupoAlimenticio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ingredientes`
--

/*INSERT INTO `Ingredientes` (`IDIngrediente`, `NombreIngrediente`, `GrupoAlimenticio`) VALUES
(1, 'Queso Oaxaca', 1),
(2, 'Frijoles refritos', 2),
(3, 'Queso Manchego', 1);*/

-- --------------------------------------------------------

--
-- Table structure for table `MenuReceta`
--

CREATE TABLE `MenuReceta` (
  `IDMenu` int(11) NOT NULL,
  `IDReceta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Menus`
--

CREATE TABLE `Menus` (
  `IDMenu` int(11) NOT NULL,
  `NombreMenu` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Menus`
--

/*INSERT INTO `Menus` (`IDMenu`, `NombreMenu`) VALUES
(1, 'Elite'),
(2, 'Basicon'),
(5, 'Keto'),
(6, 'Snax');*/

-- --------------------------------------------------------

--
-- Table structure for table `Plan`
--

CREATE TABLE `Plan` (
  `IDCliente` int(11) NOT NULL,
  `NombreTiempo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Plan`
--

/*INSERT INTO `Plan` (`IDCliente`, `NombreTiempo`) VALUES
(12, 'Comida'),
(12, 'Desayuno'),
(13, 'Comida'),
(14, 'Comida'),
(15, 'Comida'),
(16, 'Comida'),
(17, 'Comida'),
(18, 'Comida'),
(19, 'Comida'),
(20, 'Comida'),
(21, 'Comida'),
(22, 'Comida'),
(23, 'Comida'),
(23, 'Desayuno'),
(24, 'Comida');*/

-- --------------------------------------------------------

--
-- Table structure for table `PlatilloReceta`
--

CREATE TABLE `PlatilloReceta` (
  `IDPlatillo` int(11) NOT NULL,
  `IDReceta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Platillos`
--

CREATE TABLE `Platillos` (
  `IDPlatillo` int(11) NOT NULL,
  `Menu` int(11) NOT NULL,
  `Tiempo` varchar(10) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Notas` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PreparadoReceta`
--

CREATE TABLE `PreparadoReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDPreparado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Preparados`
--

CREATE TABLE `Preparados` (
  `IDPreparado` int(11) NOT NULL,
  `NombrePreparado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `RecetaReceta`
--

CREATE TABLE `RecetaReceta` (
  `IDReceta` int(11) NOT NULL,
  `IDRecetaAlt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Recetas`
--

CREATE TABLE `Recetas` (
  `IDReceta` int(11) NOT NULL,
  `NombreReceta` varchar(20) NOT NULL,
  `Descripcion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `RecetaTiempo`
--

CREATE TABLE `RecetaTiempo` (
  `NombreTiempo` varchar(10) NOT NULL,
  `IDReceta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Restriccion`
--

CREATE TABLE `Restriccion` (
  `IDCliente` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Restriccion`
--

INSERT INTO `Restriccion` (`IDCliente`, `IDIngrediente`) VALUES
/*(22, 2),
(23, 2),
(23, 1),
(23, 3),
(24, 1),
(24, 2);*/

-- --------------------------------------------------------

--
-- Table structure for table `Tiempos`
--

CREATE TABLE `Tiempos` (
  `NombreTiempo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tiempos`
--

INSERT INTO `Tiempos` (`NombreTiempo`) VALUES
/*('Comida'),
('Desayuno');*/

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`IDCategoria`);

--
-- Indexes for table `ClientePlatillo`
--
ALTER TABLE `ClientePlatillo`
  ADD KEY `IDCliente` (`IDCliente`),
  ADD KEY `IDPlatillo` (`IDPlatillo`),
  ADD KEY `Tiempo` (`Tiempo`);

--
-- Indexes for table `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`IDCliente`),
  ADD KEY `Menu` (`Menu`);

--
-- Indexes for table `GruposAlimenticios`
--
ALTER TABLE `GruposAlimenticios`
  ADD PRIMARY KEY (`IDGrupoAl`);

--
-- Indexes for table `IngredienteCategoria`
--
ALTER TABLE `IngredienteCategoria`
  ADD KEY `IDCategoria` (`IDCategoria`),
  ADD KEY `IDIngrediente` (`IDIngrediente`);

--
-- Indexes for table `IngredientePreparado`
--
ALTER TABLE `IngredientePreparado`
  ADD KEY `IDPreparado` (`IDPreparado`),
  ADD KEY `IDIngrediente` (`IDIngrediente`);

--
-- Indexes for table `IngredienteReceta`
--
ALTER TABLE `IngredienteReceta`
  ADD KEY `IDReceta` (`IDReceta`),
  ADD KEY `IDIngrediente` (`IDIngrediente`);

--
-- Indexes for table `Ingredientes`
--
ALTER TABLE `Ingredientes`
  ADD PRIMARY KEY (`IDIngrediente`),
  ADD KEY `GrupoAlimenticio` (`GrupoAlimenticio`);

--
-- Indexes for table `MenuReceta`
--
ALTER TABLE `MenuReceta`
  ADD KEY `IDMenu` (`IDMenu`),
  ADD KEY `IDReceta` (`IDReceta`);

--
-- Indexes for table `Menus`
--
ALTER TABLE `Menus`
  ADD PRIMARY KEY (`IDMenu`);

--
-- Indexes for table `Plan`
--
ALTER TABLE `Plan`
  ADD KEY `IDCliente` (`IDCliente`),
  ADD KEY `NombreTiempo` (`NombreTiempo`);

--
-- Indexes for table `PlatilloReceta`
--
ALTER TABLE `PlatilloReceta`
  ADD KEY `IDPlatillo` (`IDPlatillo`),
  ADD KEY `IDReceta` (`IDReceta`);

--
-- Indexes for table `Platillos`
--
ALTER TABLE `Platillos`
  ADD PRIMARY KEY (`IDPlatillo`),
  ADD KEY `Menu` (`Menu`);

--
-- Indexes for table `PreparadoReceta`
--
ALTER TABLE `PreparadoReceta`
  ADD KEY `IDReceta` (`IDReceta`),
  ADD KEY `IDPreparado` (`IDPreparado`);

--
-- Indexes for table `Preparados`
--
ALTER TABLE `Preparados`
  ADD PRIMARY KEY (`IDPreparado`);

--
-- Indexes for table `RecetaReceta`
--
ALTER TABLE `RecetaReceta`
  ADD KEY `IDReceta` (`IDReceta`),
  ADD KEY `IDRecetaAlt` (`IDRecetaAlt`);

--
-- Indexes for table `Recetas`
--
ALTER TABLE `Recetas`
  ADD PRIMARY KEY (`IDReceta`);

--
-- Indexes for table `RecetaTiempo`
--
ALTER TABLE `RecetaTiempo`
  ADD KEY `NombreTiempo` (`NombreTiempo`),
  ADD KEY `IDReceta` (`IDReceta`);

--
-- Indexes for table `Restriccion`
--
ALTER TABLE `Restriccion`
  ADD KEY `IDCliente` (`IDCliente`),
  ADD KEY `IDIngrediente` (`IDIngrediente`);

--
-- Indexes for table `Tiempos`
--
ALTER TABLE `Tiempos`
  ADD PRIMARY KEY (`NombreTiempo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categorias`
--
ALTER TABLE `Categorias`
  MODIFY `IDCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Clientes`
--
ALTER TABLE `Clientes`
  MODIFY `IDCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `GruposAlimenticios`
--
ALTER TABLE `GruposAlimenticios`
  MODIFY `IDGrupoAl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Ingredientes`
--
ALTER TABLE `Ingredientes`
  MODIFY `IDIngrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Menus`
--
ALTER TABLE `Menus`
  MODIFY `IDMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Platillos`
--
ALTER TABLE `Platillos`
  MODIFY `IDPlatillo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Preparados`
--
ALTER TABLE `Preparados`
  MODIFY `IDPreparado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Recetas`
--
ALTER TABLE `Recetas`
  MODIFY `IDReceta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ClientePlatillo`
--
ALTER TABLE `ClientePlatillo`
  ADD CONSTRAINT `ClientePlatillo_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  ADD CONSTRAINT `ClientePlatillo_ibfk_2` FOREIGN KEY (`IDPlatillo`) REFERENCES `Platillos` (`IDPlatillo`),
  ADD CONSTRAINT `ClientePlatillo_ibfk_3` FOREIGN KEY (`Tiempo`) REFERENCES `Tiempos` (`NombreTiempo`);

--
-- Constraints for table `Clientes`
--
ALTER TABLE `Clientes`
  ADD CONSTRAINT `Clientes_ibfk_1` FOREIGN KEY (`Menu`) REFERENCES `Menus` (`IDMenu`);

--
-- Constraints for table `IngredienteCategoria`
--
ALTER TABLE `IngredienteCategoria`
  ADD CONSTRAINT `IngredienteCategoria_ibfk_1` FOREIGN KEY (`IDCategoria`) REFERENCES `Categorias` (`IDCategoria`),
  ADD CONSTRAINT `IngredienteCategoria_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`);

--
-- Constraints for table `IngredientePreparado`
--
ALTER TABLE `IngredientePreparado`
  ADD CONSTRAINT `IngredientePreparado_ibfk_1` FOREIGN KEY (`IDPreparado`) REFERENCES `Preparados` (`IDPreparado`),
  ADD CONSTRAINT `IngredientePreparado_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`);

--
-- Constraints for table `IngredienteReceta`
--
ALTER TABLE `IngredienteReceta`
  ADD CONSTRAINT `IngredienteReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  ADD CONSTRAINT `IngredienteReceta_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`);

--
-- Constraints for table `Ingredientes`
--
ALTER TABLE `Ingredientes`
  ADD CONSTRAINT `Ingredientes_ibfk_1` FOREIGN KEY (`GrupoAlimenticio`) REFERENCES `GruposAlimenticios` (`IDGrupoAl`);

--
-- Constraints for table `MenuReceta`
--
ALTER TABLE `MenuReceta`
  ADD CONSTRAINT `MenuReceta_ibfk_1` FOREIGN KEY (`IDMenu`) REFERENCES `Menus` (`IDMenu`),
  ADD CONSTRAINT `MenuReceta_ibfk_2` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`);

--
-- Constraints for table `Plan`
--
ALTER TABLE `Plan`
  ADD CONSTRAINT `Plan_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  ADD CONSTRAINT `Plan_ibfk_2` FOREIGN KEY (`NombreTiempo`) REFERENCES `Tiempos` (`NombreTiempo`);

--
-- Constraints for table `PlatilloReceta`
--
ALTER TABLE `PlatilloReceta`
  ADD CONSTRAINT `PlatilloReceta_ibfk_1` FOREIGN KEY (`IDPlatillo`) REFERENCES `Platillos` (`IDPlatillo`),
  ADD CONSTRAINT `PlatilloReceta_ibfk_2` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`);

--
-- Constraints for table `Platillos`
--
ALTER TABLE `Platillos`
  ADD CONSTRAINT `Platillos_ibfk_1` FOREIGN KEY (`Menu`) REFERENCES `Menus` (`IDMenu`);

--
-- Constraints for table `PreparadoReceta`
--
ALTER TABLE `PreparadoReceta`
  ADD CONSTRAINT `PreparadoReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  ADD CONSTRAINT `PreparadoReceta_ibfk_2` FOREIGN KEY (`IDPreparado`) REFERENCES `Preparados` (`IDPreparado`);

--
-- Constraints for table `RecetaReceta`
--
ALTER TABLE `RecetaReceta`
  ADD CONSTRAINT `RecetaReceta_ibfk_1` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`),
  ADD CONSTRAINT `RecetaReceta_ibfk_2` FOREIGN KEY (`IDRecetaAlt`) REFERENCES `Recetas` (`IDReceta`);

--
-- Constraints for table `RecetaTiempo`
--
ALTER TABLE `RecetaTiempo`
  ADD CONSTRAINT `RecetaTiempo_ibfk_1` FOREIGN KEY (`NombreTiempo`) REFERENCES `Tiempos` (`NombreTiempo`),
  ADD CONSTRAINT `RecetaTiempo_ibfk_2` FOREIGN KEY (`IDReceta`) REFERENCES `Recetas` (`IDReceta`);

--
-- Constraints for table `Restriccion`
--
ALTER TABLE `Restriccion`
  ADD CONSTRAINT `Restriccion_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  ADD CONSTRAINT `Restriccion_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
