
CREATE TABLE Clientes
(
	IDCliente int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	Tiempos varchar(10) not null,
	NombreMenu varchar(10) not null,
	PRIMARY KEY(IDCliente)
);

CREATE TABLE Ingredientes
(
	IDIngrediente int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	GrupoAlimenticio varchar(20) not null,
	PRIMARY KEY(IDIngrediente)
);

CREATE TABLE Preparados
(
	IDPreparado int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	PRIMARY KEY(IDPreparado)
);

CREATE TABLE Receta
(
	IDReceta int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	Descripcion varchar(30),
	Tiempo varchar(10) not null,
	PRIMARY KEY(IDReceta)
);

CREATE TABLE Categoria
(
	IDCategoria int not null AUTO_INCREMENT,
	Nombre varchar(20) not null,
	PRIMARY KEY(IDCategoria)
);

CREATE TABLE Platillo
(
	IDPlatillo int not null AUTO_INCREMENT,
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
	IDCliente int not null,
	IDIngrediente int not null,
	PRIMARY KEY (IDCliente, IDIngrediente),
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
);

CREATE TABLE Pertenece
(
	IDCategoria int not null,
	IDIngrediente int not null,
	PRIMARY KEY(IDCategoria, IDIngrediente),
	FOREIGN KEY(IDCategoria) references Categoria(IDCategoria),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
);

CREATE TABLE Conforman
(
	IDPreparado int not null,
	IDIngrediente int not null,
	PRIMARY KEY(IDPreparado, IDIngrediente),
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
);

CREATE TABLE Hacen
(
	IDReceta int not null,
	IDIngrediente int not null,
	PRIMARY KEY(IDReceta,IDIngrediente),
	FOREIGN KEY(IDReceta) references Receta(IDReceta),
	FOREIGN KEY(IDIngrediente) references Ingredientes(IDIngrediente)
);

CREATE TABLE HacenPR
(
	IDReceta int not null,
	IDPreparado int not null,
	PRIMARY KEY(IDReceta,IDPreparado),
	FOREIGN KEY(IDReceta) references Receta(IDReceta),
	FOREIGN KEY(IDPreparado) references Preparados(IDPreparado)
);

CREATE TABLE Compone
(
	IDPlatillo int not null,
	IDReceta int not null,
	PartePuzzle varchar(20),
	PRIMARY KEY (IDPlatillo, IDReceta),
	FOREIGN KEY(IDPlatillo) references Platillo(IDPlatillo),
	FOREIGN KEY(IDReceta) references Receta(IDReceta)
);

CREATE TABLE Agendan
(
	IDCliente int not null,
	IDPlatillo int not null,
	Fecha datetime not null,
	Tiempo varchar(10) not null,
	PRIMARY KEY (IDCliente,IDPlatillo),
	FOREIGN KEY(IDCliente) references Clientes(IDCliente),
	FOREIGN KEY(IDPlatillo) references Platillo(IDPlatillo)
);

CREATE TABLE Contiene
(
	NombreMenu varchar(10) not null,
	IDReceta int not null,
	PRIMARY KEY (NombreMenu,IDReceta),
	FOREIGN KEY(NombreMenu) references Menus(NombreMenu),
	FOREIGN KEY(IDReceta) references Receta(IDReceta)
);



