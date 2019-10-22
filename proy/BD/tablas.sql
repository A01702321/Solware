
CREATE TABLE Clientes
(
	IDCliente numeric not null,
	Nombre varchar(20) not null,
	Tiempos varchar(10) not null,
	NombreMenu varchar(10) not null,
	PRIMARY KEY(IDCliente)
);

CREATE TABLE Ingredientes
(
	IDIngrediente numeric not null,
	Nombre varchar(20) not null,
	GrupoAlimenticio varchar(20) not null,
	PRIMARY KEY(IDIngrediente)
);

CREATE TABLE Preparados
(
	IDPreparado numeric not null,
	Nombre varchar(20) not null,
	PRIMARY KEY(IDPreparado)
);

CREATE TABLE Receta
(
	IDReceta numeric not null,
	Nombre varchar(20) not null,
	Descripcion varchar(30),
	Tiempo varchar(10) not null,
	PRIMARY KEY(IDReceta)
);

CREATE TABLE Categoria
(
	IDCategoria numeric not null,
	Nombre varchar(20) not null,
	PRIMARY KEY(IDCategoria)
);

CREATE TABLE Platillo
(
	IDPlatillo numeric not null,
	NombreMenu varchar(10) not null,
	Tiempo varchar(10) not null,
	Fecha datetime not null,
	PRIMARY KEY(IDPlatillo)
);

CREATE TABLE Menus
(
	NombreMenu varchar(10),
	PRIMARY KEY(NombreMenu)
);


CREATE TABLE Restriccion
(
	IDCliente numeric not null,
	IDIngrediente numeric not null,
	PRIMARY KEY (IDCliente, IDIngrediente),
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
);

CREATE TABLE Pertenece
(
	IDCategoria numeric not null,
	IDIngrediente numeric not null,
	PRIMARY KEY(IDCategoria, IDIngrediente),
	FOREIGN KEY(IDCategoria) references Categoria(IDCategoria),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
);

CREATE TABLE Conforman
(
	IDPreparado numeric not null,
	IDIngrediente numeric not null,
	PRIMARY KEY(IDPreparado, IDIngrediente),
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
);

CREATE TABLE Hacen
(
	IDReceta numeric not null,
	IDIngrediente numeric not null,
	PRIMARY KEY(IDReceta,IDIngrediente),
	FOREIGN KEY(IDReceta) references Receta(IDReceta),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
);

CREATE TABLE HacenPR
(
	IDReceta numeric not null,
	IDPreparado numeric not null,
	PRIMARY KEY(IDReceta,IDPreparado),
	FOREIGN KEY(IDReceta) references Receta(IDReceta),
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado)
);

CREATE TABLE Compone
(
	IDPlatillo numeric not null,
	IDReceta numeric not null,
	PartePuzzle varchar(20),
	PRIMARY KEY (IDPlatillo, IDReceta),
	FOREIGN KEY(IDPlatillo) references Platillo(IDPlatillo),
	FOREIGN KEY(IDReceta) references Receta(IDReceta)
);

CREATE TABLE Agendan
(
	IDCliente numeric not null,
	IDPlatillo numeric not null,
	Fecha datetime not null,
	Tiempo varchar(10) not null,
	PRIMARY KEY (IDCliente,IDPlatillo),
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(IDPlatillo) references Platillo(IDPlatillo)
);

CREATE TABLE Contiene
(
	NombreMenu varchar(10) not null,
	IDReceta numeric not null,
	PRIMARY KEY (NombreMenu,IDReceta),
	FOREIGN KEY(NombreMenu) references Menus(NombreMenu),
	FOREIGN KEY(IDReceta) references Receta(IDReceta)
);


