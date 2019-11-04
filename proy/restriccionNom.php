<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$link = mysqli_connect('localhost', 'root', '', 'clase');
$name = $_POST['name'];
$ing = $_POST['ingrediente'];

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "
SELECT * FROM Restricciones Where Nombre = '$name'";
$Result = mysqli_query($link, $sql);

if (mysqli_num_rows($Result) == 0) { 
   $sql = "INSERT INTO Restricciones (Nombre) VALUES ('$name')";
   $x = mysqli_query($link, $sql);
}



$sql = "

INSERT INTO Restriccion_Ingrediente (IDRestriccion, IDIngrediente) VALUES ((SELECT p.IDRestriccion FROM Restricciones p WHERE p.Nombre = '$name'), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.Nombre = '$ing' ) )";


if(mysqli_query($link, $sql)){
    echo "Ingredientes inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
	
// Close connection
mysqli_close($link);
?>