<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$link = mysqli_connect('localhost', 'root', '', 'clase');
$name = $_POST['name'];
$categoria = $_POST['cat'];

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution


$sql = "
SELECT IDIngrediente FROM Pertenece Where IDCategoria = (SELECT IDCategoria FROM Categoria Where Nombre = '$categoria');
";
$Result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($Result)) {
	$sql = "INSERT INTO Restriccion_Ingrediente (IDRestriccion, IDIngrediente) VALUES ((SELECT p.IDRestriccion FROM Restricciones p WHERE p.Nombre = '$name'), ( '$row[0]' ))";
	if(mysqli_query($link, $sql)){
    echo "Categoria inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}}


	
// Close connection
mysqli_close($link);
?>