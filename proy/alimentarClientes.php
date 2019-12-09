<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$menu = $_POST['menu'];
$tiempo = $_POST['tiempo'];
$id = $_POST['id'];
$fecha = $_POST['fecha'];




$table = getClientesTiempoMenu($menu,$tiempo);
$newtable = getRestriccionesTable($table);
$ingredients = getIngredientesPlatillo($id);
$finalTable = alimentar($newtable, $ingredients);
$added = alimentarClientesTabla($finalTable, $fecha, $menu, $tiempo, $id);



if($added){

	echo(json_encode($finalTable));
}

else{

	echo(1);
	
}











?>
