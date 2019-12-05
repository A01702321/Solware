<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$id = $_POST['id'];

//Llamado a funciones php para eliminado de ingredientes
$rest = eliminarIngrediente($id);	
echo $rest;


?>
