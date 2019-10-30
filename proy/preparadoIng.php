<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$link = mysqli_connect('localhost', 'root', '', 'clase');
$name = $_POST['name'];
$ing = $_POST['ingredient'];
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "
INSERT INTO Conforman (IDPreparado, IDIngrediente) VALUES ((SELECT p.IDPreparado FROM Preparados p WHERE p.Nombre = '$name'), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.Nombre = '$ing' ) )";


if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
	
// Close connection
mysqli_close($link);
?>