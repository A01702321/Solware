-- Entidades

CREATE TABLE Menus
(
	IDMenu int not null AUTO_INCREMENT,
	NombreMenu varchar(10),
	PRIMARY KEY(IDMenu)
)

CREATE TABLE Tiempos
(
	NombreTiempo varchar(10) not null,
	PRIMARY KEY(NombreTiempo)
)

CREATE TABLE Clientes
(
	IDCliente int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	Menu int not null,
	PRIMARY KEY(IDCliente),
	FOREIGN KEY(Menu) references Menus(IDMenu)
)

CREATE TABLE GruposAlimenticios
(
	IDGrupoAl int not null AUTO_INCREMENT,
	NombreGrupoAl varchar(20) not null,
	PRIMARY KEY(IDGrupoAl)
)

CREATE TABLE Categorias
(
	IDCategoria int not null AUTO_INCREMENT,
	NombreCategoria varchar(20) not null,
	PRIMARY KEY(IDCategoria)
)

CREATE TABLE Ingredientes
(
	IDIngrediente int not null AUTO_INCREMENT,
	NombreIngrediente varchar(20) not null,
	GrupoAlimenticio int not null,
	PRIMARY KEY(IDIngrediente),
	FOREIGN KEY(GrupoAlimenticio) references GruposAlimenticios(IDGrupoAl)
)

CREATE TABLE Preparados
(
	IDPreparado int not null AUTO_INCREMENT,
	NombrePreparado varchar(20) not null,
	PRIMARY KEY(IDPreparado)
)

CREATE TABLE Recetas
(
	IDReceta int not null AUTO_INCREMENT,
	NombreReceta varchar(20) not null,
	Descripcion varchar(30),
	PRIMARY KEY(IDReceta)
)

CREATE TABLE Platillos
(
	IDPlatillo int not null AUTO_INCREMENT,
	Menu int not null,
	Tiempo varchar(10) not null,
	Fecha datetime not null,
	Notas varchar(600) not null,
	PRIMARY KEY(IDPlatillo),
	FOREIGN KEY (Menu) references Menus(IDMenu)
)


-- Relaciones

CREATE TABLE Restriccion
(
	IDCliente int not null,
	IDIngrediente int not null,
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
)

CREATE TABLE IngredienteCategoria
(
	IDIngrediente int not null,
	IDCategoria int not null,
	FOREIGN KEY(IDCategoria) references Categorias(IDCategoria),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
)

CREATE TABLE IngredientePreparado
(
	IDPreparado int not null,
	IDIngrediente int not null,
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
)

CREATE TABLE IngredienteReceta
(
	IDReceta int not null,
	IDIngrediente int not null,
	FOREIGN KEY(IDReceta) references Recetas(IDReceta),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
)

CREATE TABLE PreparadoReceta
(
	IDReceta int not null,
	IDPreparado int not null,
	FOREIGN KEY(IDReceta) references Recetas(IDReceta),
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado)
)

CREATE TABLE PlatilloReceta
(
	IDPlatillo int not null,
	IDReceta int not null,
	FOREIGN KEY(IDPlatillo) references Platillos(IDPlatillo),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta)
)

CREATE TABLE RecetaReceta
(
	IDReceta int not null,
	IDRecetaAlt int not null,
	FOREIGN KEY(IDReceta) references Recetas(IDReceta),
	FOREIGN KEY(IDRecetaAlt) references Recetas(IDReceta)
)

CREATE TABLE RecetaTiempo
(
	NombreTiempo varchar(10) not null,
	IDReceta int not null,
	FOREIGN KEY(NombreTiempo) references Tiempos(NombreTiempo),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta)
)

CREATE TABLE ClientePlatillo-----------------------------
(
	IDCliente int not null,
	IDPlatillo int not null,
	Fecha datetime not null,
	Tiempo varchar(10) not null,
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(IDPlatillo) references Platillos(IDPlatillo),
	FOREIGN KEY(Tiempo) references Tiempos(NombreTiempo)
)

CREATE TABLE MenuReceta
(
	IDMenu int not null,
	IDReceta int not null,
	FOREIGN KEY(IDMenu) references Menus(IDMenu),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta)
)

CREATE TABLE Plan
(
	IDCliente int not null,
	NombreTiempo varchar(10) not null,
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(NombreTiempo) references Tiempos(NombreTiempo)
)

CREATE TABLE Usuarios
(
	id_Usuario int not null AUTO_INCREMENT,
	usuario varchar(20) not null,
	password varchar(20) not null,
	PRIMARY KEY(id_Usuario)
)



-- ESTAS SON LAS TABLAS ANTES DE METERLAS EN MYSQL
/*
--Entidades
CREATE TABLE Menus
(
	IDMenu int not null AUTO_INCREMENT,
	NombreMenu varchar(10),
	PRIMARY KEY(IDMenu)
)

CREATE TABLE Tiempos
(
	NombreTiempo varchar(10) not null,
	PRIMARY KEY(NombreTiempo)
)

CREATE TABLE Clientes
(
	IDCliente int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	NombreMenu varchar(10) not null,
	PRIMARY KEY(IDCliente),
	FOREIGN KEY(NombreMenu) references Menus(NombreMenu)
)

CREATE TABLE GruposAlimenticios
(
	IDGrupoAl int not null AUTO_INCREMENT,
	NombreGrupoAl varchar(20) not null,
	PRIMARY KEY(IDGrupoAl)
)

CREATE TABLE Categorias
(
	IDCategoria int not null AUTO_INCREMENT,
	NombreCategoria varchar(20) not null,
	PRIMARY KEY(IDCategoria)
)

CREATE TABLE Ingredientes
(
	IDIngrediente int not null AUTO_INCREMENT,
	NombreIngrediente varchar(20) not null,
	GrupoAlimenticio varchar(20) not null,
	PRIMARY KEY(IDIngrediente),
	FOREIGN KEY(GrupoAlimenticio) references GruposAlimenticios(NombreGrupoAl)
)

CREATE TABLE Preparados
(
	IDPreparado int not null AUTO_INCREMENT,
	NombrePreparado varchar(20) not null,
	PRIMARY KEY(IDPreparado)
)

CREATE TABLE Recetas
(
	IDReceta int not null AUTO_INCREMENT,
	NombreReceta varchar(20) not null,
	Descripcion varchar(30),
	PRIMARY KEY(IDReceta)
)

CREATE TABLE Platillos
(
	IDPlatillo int not null AUTO_INCREMENT,
	NombreMenu varchar(10) not null,
	Tiempo varchar(10) not null,
	Fecha datetime not null,
	-- Tal vez Notas
	PRIMARY KEY(IDPlatillo),
	FOREIGN KEY (NombreMenu) references Menus(NombreMenu)
)



--Relaciones
CREATE TABLE Restriccion --Clientes - Ingredientes
(
	IDCliente int not null,
	IDIngrediente int not null,
	--PRIMARY KEY (IDCliente, IDIngrediente),
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
)

CREATE TABLE IngredienteCategoria --Ingrediente - Categoria
(
	IDIngrediente int not null,
	IDCategoria int not null,
	--PRIMARY KEY(IDCategoria, IDIngrediente),
	FOREIGN KEY(IDCategoria) references Categorias(IDCategoria),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
)

CREATE TABLE IngredientePreparado --Ingredientes - Preparados
(
	IDPreparado int not null,
	IDIngrediente int not null,
	--PRIMARY KEY(IDPreparado, IDIngrediente),
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
)

CREATE TABLE IngredienteReceta --Ingredientes - Receta
(
	IDReceta int not null,
	IDIngrediente int not null,
	--PRIMARY KEY(IDReceta,IDIngrediente),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
)

CREATE TABLE PreparadoReceta --Preparados	 - Receta
(
	IDReceta int not null,
	IDPreparado int not null,
	--PRIMARY KEY(IDReceta,IDPreparado),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta),
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado)
)

CREATE TABLE PlatilloReceta --Platillo - Receta
(
	IDPlatillo int not null,
	IDReceta int not null,
	--PRIMARY KEY (IDPlatillo, IDReceta),
	FOREIGN KEY(IDPlatillo) references Platillos(IDPlatillo),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta)
)

CREATE TABLE RecetaReceta --Relacion de receta a receta para crear platillos alternos
(
	IDReceta int not null,
	IDRecetaAlt int not null,
	FOREIGN KEY(IDReceta) references Recetas(IDReceta),
	FOREIGN KEY(IDRecetaAlt) references Recetas(IDReceta)
)

CREATE TABLE RecetaTiempo --Platillo - Receta
(
	IDTiempo int not null,
	IDReceta int not null,
	--PRIMARY KEY (IDPlatillo, IDReceta),
	FOREIGN KEY(IDTiempo) references Tiempos(IDTiempo),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta)
)

CREATE TABLE ClientePlatillo --Clientes - Platillo
(
	IDCliente int not null,
	IDPlatillo int not null,
	Fecha datetime not null,
	Tiempo varchar(10) not null,
	--PRIMARY KEY (IDCliente,IDPlatillo),
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(IDPlatillo) references Platillos(IDPlatillo),
	FOREIGN KEY(Tiempo) references Tiempos(IDTiempo)
)

-- PREGUNTAR SI DEBE EXISTIR
CREATE TABLE MenuReceta --Menu - Receta
(
	IDMenu int not null,
	IDReceta int not null,
	--PRIMARY KEY (IDMenu,IDReceta),
	FOREIGN KEY(IDMenu) references Menus(IDMenu),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta)
)

CREATE TABLE Plan --Clientes - Tiempos
(
	IDCliente int not null,
	NombreTiempo int not null,
	--PRIMARY KEY (NombreMenu,IDReceta),
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(NombreTiempo) references Tiempos(NombreTiempo)
)
*/