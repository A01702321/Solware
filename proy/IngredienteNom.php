<?php
  require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$link = connectDB();
$name = $_POST['name'];
$grupo = $_POST['grupo'];
$categoria = $_POST['categoria'];

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "
SELECT * FROM Ingredientes Where Nombre = '$name'";
$Result = mysqli_query($link, $sql);

if (mysqli_num_rows($Result) == 0) { 
   $sql = "INSERT INTO Ingredientes (Nombre, GrupoAlimenticio) VALUES ('$name', '$grupo')";
   $x = mysqli_query($link, $sql);
}

$sql = "
SELECT * FROM Categoria Where Nombre = '$categoria'";
$Result = mysqli_query($link, $sql);

if (mysqli_num_rows($Result) == 0) { 
   $sql = "INSERT INTO Categoria (Nombre) VALUES ('$categoria')";
   $x = mysqli_query($link, $sql);
}

$sql = "

INSERT INTO Pertenece (IDCategoria, IDIngrediente) VALUES ((SELECT p.IDCategoria FROM Categoria p WHERE p.Nombre = '$categoria'), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.Nombre = '$name' ) )";


if(mysqli_query($link, $sql)){
    echo "Categoria inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
	
// Close connection
closeDB($link);
?>