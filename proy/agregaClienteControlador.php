<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$name = $_POST['name'];
$menu= $_POST['menu'];
$ids = $_POST['ids'];
$tiempos = $_POST['tiempomenu'];

if(crearClienteCompleto($name, $menu, $ids, $tiempos)){
	echo(1);
}




?>
