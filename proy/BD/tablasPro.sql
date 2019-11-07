--Entidades
CREATE TABLE Menus
(
	NombreMenu varchar(10),
	PRIMARY KEY(NombreMenu)
)

CREATE TABLE Planes
(
	NombrePlan varchar(10),
	PRIMARY KEY(NombrePlan)
)

CREATE TABLE Tiempos
(
	NombreTiempo varchar(8) not null,
	PRIMARY KEY(NombreTiempo)
)

CREATE TABLE Clientes
(
	IDCliente int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	Plan varchar(10) not null,
	NombreMenu varchar(10) not null,
	PRIMARY KEY(IDCliente),
	FOREIGN KEY(Plan) references Planes(NombrePlan),
	FOREIGN KEY(NombreMenu) references Menus(NombreMenu)
)

CREATE TABLE GruposAlimenticios
(
	Nombre varchar(20) not null,
	PRIMARY KEY(Nombre)
)

CREATE TABLE Categorias
(
	IDCategoria int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	PRIMARY KEY(IDCategoria)
)

CREATE TABLE Ingredientes
(
	IDIngrediente int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	GrupoAlimenticio varchar(20) not null,
	PRIMARY KEY(IDIngrediente),
	FOREIGN KEY(GruposAlimenticios) references GruposAlimenticios(Nombre)
)

CREATE TABLE Preparados
(
	IDPreparado int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	PRIMARY KEY(IDPreparado)
)

CREATE TABLE Recetas
(
	IDReceta int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	Descripcion varchar(30),
	PRIMARY KEY(IDReceta)
)



CREATE TABLE Platillos
(
	IDPlatillo int not null AUTO_INCREMENT,
	NombreMenu varchar(10) not null,
	Tiempo varchar(10) not null,
	Fecha datetime not null,
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
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado),
)

CREATE TABLE PlatilloReceta --Platillo - Receta
(
	IDPlatillo int not null,
	IDReceta int not null,
	--PRIMARY KEY (IDPlatillo, IDReceta),
	FOREIGN KEY(IDPlatillo) references Platillos(IDPlatillo),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta)
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
	FOREIGN KEY(IDPlatillo) references Platillos(IDPlatillo)
)

CREATE TABLE MenuReceta --Menu - Receta
(
	NombreMenu int(10) not null,
	IDReceta int not null,
	PRIMARY KEY (NombreMenu,IDReceta),
	FOREIGN KEY(NombreMenu) references Menus(NombreMenu),
	FOREIGN KEY(IDReceta) references Recetas(IDReceta)
)

CREATE TABLE PlanTiempo --Menu - Receta
(
	NombrePlan varchar(10) not null,
	NombreTiempo varchar(8) not null,
	--PRIMARY KEY (NombreMenu,IDReceta),
	FOREIGN KEY(NombrePlan) references Planes(NombrePlan),
	FOREIGN KEY(NombreTiempo) references Tiempos(NombreTiempo)
)
