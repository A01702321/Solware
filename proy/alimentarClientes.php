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


echo(json_encode($newtable));
echo(json_encode($ingredients));









?>
