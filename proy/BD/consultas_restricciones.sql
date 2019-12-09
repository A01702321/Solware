---------------.............................................TABLA RESTRICCION CON TIPORESTRICCION EN VARCHAR----------------------------------------------------------------
CREATE TABLE `Restriccion` (
  `IDCliente` int(11) NOT NULL,
  `IDIngrediente` int(11) NOT NULL,
    TipoRestriccion varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Restriccion`
  ADD KEY `IDCliente` (`IDCliente`),
  ADD KEY `IDIngrediente` (`IDIngrediente`);

  ALTER TABLE `Restriccion`
  ADD CONSTRAINT `Restriccion_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `Clientes` (`IDCliente`),
  ADD CONSTRAINT `Restriccion_ibfk_2` FOREIGN KEY (`IDIngrediente`) REFERENCES `Ingredientes` (`IDIngrediente`);





-----------------------------------------------------------------------INGREDIENTE EN PLATILLO------------------------------------------------------------------------------------------
SELECT I.NombreIngrediente FROM Ingredientes as I, Platillos as P, PlatilloIngrediente as PI WHERE PI.IDPlatillo = 1 AND  PI.IDIngrediente = I.IDIngrediente group by I.NombreIngrediente

-------------------------------------------------------------CLIENTE CON EL INGREDIENTE RESTRINGIDO Y EL TIPO DE RESTRICCION EN LA RECETE EN UN PLATILLO------------------------------------------------------------


----PROD
SELECT RES.IDCliente, RES.IDIngrediente, RES.TipoRestriccion 
FROM (SELECT I.IDIngrediente FROM Ingredientes as I, Platillos as P, PlatilloIngrediente as PI 
	WHERE PI.IDPlatillo = 1 AND  PI.IDIngrediente = I.IDIngrediente ) as T, Restriccion as RES 
		WHERE T.IDIngrediente = RES.IDIngrediente


----------------------------------------------------------------------NOMBRES EN VEZ DE IDS-----------------------------------------------------------------------------------------


---PROD
SELECT C.Nombre, I.NombreIngrediente, RES.TipoRestriccion 
	FROM(SELECT RES.IDCliente, RES.IDIngrediente, RES.TipoRestriccion FROM (SELECT I.IDIngrediente FROM Ingredientes as I, Platillos as P, PlatilloIngrediente as PI 
		WHERE PI.IDPlatillo = 1 AND  PI.IDIngrediente = I.IDIngrediente ) as T, Restriccion as RES 
			WHERE T.IDIngrediente = RES.IDIngrediente) as W, Clientes as C, Ingredientes as I, Restriccion as RES WHERE C.IDCliente = W.IDCliente AND I.IDIngrediente = W.IDIngrediente 
					AND RES.TipoRestriccion = W.TipoRestriccion  GROUP By C.Nombre



------------------------------------------------------------------INGREDIENTE EN QUE PREPARADO EN PLATILLO---------------------------------------------------------------------


-----PROD
SELECT IP.IDIngrediente, IP.IDPreparado FROM IngredientePreparado as IP 
WHERE IP.IDPreparado = (SELECT Pr.IDPreparado FROM Preparados as Pr, Platillos as Pl, PlatilloPreparado as PP WHERE Pl.IDPlatillo = 1 AND PP.IDPreparado = Pr.IDPreparado) 



-------------------------------------------------CLIENTE CON EL INGREDIENTE RESTRINGIDO EN QUE PREPARADO Y EL TIPO DE RESTRICCION------------------------------------------------


----PROD
SELECT RES.IDCliente, RES.IDIngrediente, T.IDPreparado, RES.TipoRestriccion 
FROM (SELECT IP.IDIngrediente, IP.IDPreparado FROM IngredientePreparado as IP 
	WHERE IP.IDPreparado = (SELECT Pr.IDPreparado FROM Preparados as Pr, Platillos as Pl, PlatilloPreparado as PP 
		WHERE Pl.IDPlatillo = 1 AND PP.IDPreparado = Pr.IDPreparado) ) as T, Restriccion as RES WHERE T.IDIngrediente = RES.IDIngrediente;


---------------------------------------------------CON NOMBRES EN VEZ DE IDS(TODAVIA NO JALA BIEN)-------------------------------------------------------------------------


---PROD
SELECT C.Nombre, I.NombreIngrediente, Pre.NombrePreparado, RES.TipoRestriccion FROM (SELECT RES.IDCliente, RES.IDIngrediente, T.IDPreparado, RES.TipoRestriccion 
FROM (SELECT IP.IDIngrediente, IP.IDPreparado FROM IngredientePreparado as IP 
	WHERE IP.IDPreparado = (SELECT Pr.IDPreparado FROM Preparados as Pr, Platillos as Pl, PlatilloPreparado as PP 
		WHERE Pl.IDPlatillo = 1 AND PP.IDPreparado = Pr.IDPreparado) ) as T, Restriccion as RES WHERE T.IDIngrediente = RES.IDIngrediente) 
			as E, Clientes as C, Ingredientes as I, Preparados as Pre, Restriccion as RES WHERE C.IDCliente = E.IDCliente AND I.IDIngrediente = E.IDIngrediente 
				AND Pre.IDPreparado = E.IDPreparado AND RES.TipoRestriccion = E.TipoRestriccion group by C.Nombre


-----------------------------------------------------------------INGREDEINTES EN QUE RECETA EN UN PLATILLO-----------------------------------------------------------------------

---PROD
SELECT IR.IDIngrediente, IR.IDReceta FROM IngredienteReceta as IR WHERE IR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
	WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) 

-----------------------------------------CLIENTE CON INGREDIENTE RESTRINGIDO EN QUE RECETA Y TIPO DE RESTRICCION-------------------------------------------------------------------

---PROD
SELECT RES.IDCliente, RES.IDIngrediente, T.IDReceta, RES.TipoRestriccion FROM
(SELECT IR.IDIngrediente, IR.IDReceta FROM IngredienteReceta as IR WHERE IR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
	WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) ) as T, Restriccion as RES WHERE T.IDIngrediente = RES.IDIngrediente

----------------------------------------------------------------------NOMBRES EN VEZ DE IDs-----------------------------------------------------------------------------

----PROD
SELECT C.Nombre, I.NombreIngrediente, R.NombreReceta, RES.TipoRestriccion FROM(SELECT RES.IDCliente, RES.IDIngrediente, T.IDReceta, RES.TipoRestriccion FROM
(SELECT IR.IDIngrediente, IR.IDReceta FROM IngredienteReceta as IR WHERE IR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
	WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) ) as T, Restriccion as RES 
		WHERE T.IDIngrediente = RES.IDIngrediente) as E, Clientes as C, Ingredientes as I, Recetas as R, Restriccion as RES 
			WHERE C.IDCliente = E.IDCliente AND I.IDIngrediente = E.IDIngrediente AND R.IDReceta = E.IDReceta AND RES.TipoRestriccion = E.TipoRestriccion GROUP BY C.Nombre







---------------------------------------------------------------TABLA CON TODOS LOS INGREDIENTES DE UN PLATILLO----------------------------------------------------------------

-----PROD
SELECT I.IDIngrediente FROM Ingredientes as I, Platillos as P, PlatilloIngrediente as PI WHERE PI.IDPlatillo = 1 AND  PI.IDIngrediente = I.IDIngrediente 
UNION
SELECT IP.IDIngrediente FROM IngredientePreparado as IP WHERE IP.IDPreparado = (SELECT Pr.IDPreparado FROM Preparados as Pr, Platillos as Pl, PlatilloPreparado as PP 
	WHERE Pl.IDPlatillo = 1 AND PP.IDPreparado = Pr.IDPreparado) 
UNION
SELECT IR.IDIngrediente FROM IngredienteReceta as IR WHERE IR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
	WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) 
UNION
SELECT IP.IDIngrediente FROM IngredientePreparado as IP WHERE IP.IDPreparado = (SELECT PRR.IDPreparado FROM PreparadoReceta as PRR 
	WHERE PRR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) )



----------------------------------------------------------------------INGREDEINTE EN QUE PREPARADO EN QUE RECETA DE UN PLATILLO-----------------------------------------------------------------

---PROD
SET @var1 = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta);

SELECT IP.IDIngrediente, IP.IDPreparado, @var1 as IDReceta FROM IngredientePreparado as IP WHERE IP.IDPreparado = (SELECT PRR.IDReceta FROM PlatilloReceta as PRR 
	WHERE PRR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) )


------------------------------CLIENTE CON INGREDIENTES RESTRINGIDOS EN QUE PREPARADO EN QUE RECETA Y EL TIPO DE RESTRICCION---------------------------------------------------------------------

---PROD
SET @var1 = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta);
SET @var2 = (SELECT PRR.IDPreparado FROM PreparadoReceta as PRR WHERE PRR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
	WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta));

SELECT RES.IDCliente, RES.IDIngrediente, @var2 as IDPreparado, @var1 as IDReceta, RES.TipoRestriccion 
	FROM (SELECT IP.IDIngrediente, IP.IDPreparado, @var1 as IDReceta FROM IngredientePreparado as IP 
		WHERE IP.IDPreparado = (SELECT PRR.IDPreparado FROM PreparadoReceta as PRR WHERE PRR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
			WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) )) as T, Restriccion as RES WHERE T.IDIngrediente = RES.IDIngrediente


-----------------------------------------------------------------------------NOMBRES EN VEZ DE IDs------------------------------------------------------------------------------------------------

------PROD

SET @var1 = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta);
SET @var2 = (SELECT PRR.IDReceta FROM PlatilloReceta as PRR WHERE PRR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
	WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta));

SELECT C.Nombre, I.NombreIngrediente, Pre.NombrePreparado, R.NombreReceta, RES.TipoRestriccion 
FROM (SELECT RES.IDCliente, RES.IDIngrediente, @var2 as IDPreparado, @var1 as IDReceta, RES.TipoRestriccion 
	FROM (SELECT IP.IDIngrediente, IP.IDPreparado, @var1 as IDReceta FROM IngredientePreparado as IP 
		WHERE IP.IDPreparado = (SELECT PRR.IDPreparado FROM PreparadoReceta as PRR WHERE PRR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
			WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) )) as T, Restriccion as RES 
				WHERE T.IDIngrediente = RES.IDIngrediente) as W, Clientes as C, Ingredientes as I, Preparados as Pre, Recetas as R, Restriccion as RES 
					WHERE C.IDCliente = W.IDCliente AND I.IDIngrediente = W.IDIngrediente AND Pre.IDPreparado = W.IDPreparado 
						AND R.IDReceta = W.IDReceta AND RES.TipoRestriccion = W.TipoRestriccion GROUP BY C.Nombre


SET @var1 = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta);
SET @var2 = (SELECT PRR.IDReceta FROM PlatilloReceta as PRR WHERE PRR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
	WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta));

SELECT C.Nombre, I.NombreIngrediente, Pre.NombrePreparado, R.NombreReceta, RES.TipoRestriccion 
FROM (SELECT RES.IDCliente, RES.IDIngrediente, @var2 as IDPreparado, @var1 as IDReceta, RES.TipoRestriccion 
	FROM (SELECT IP.IDIngrediente, IP.IDPreparado, @var1 as IDReceta FROM IngredientePreparado as IP 
		WHERE IP.IDPreparado = (SELECT PRR.IDPreparado FROM PreparadoReceta as PRR WHERE PRR.IDReceta = (SELECT R.IDReceta FROM Recetas as R, Platillos as Pl, PlatilloReceta as PR 
			WHERE Pl.IDPlatillo = 1 AND PR.IDReceta = R.IDReceta) )) as T, Restriccion as RES 
				WHERE T.IDIngrediente = RES.IDIngrediente) as W, Clientes as C, Ingredientes as I, Preparados as Pre, Recetas as R, Restriccion as RES 
					WHERE C.IDCliente = W.IDCliente AND I.IDIngrediente = W.IDIngrediente AND Pre.IDPreparado = W.IDPreparado 
						AND R.IDReceta = W.IDReceta AND RES.TipoRestriccion = W.TipoRestriccion GROUP BY C.Nombre



