<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$name = $_POST['name'];
$menu= $_POST['menu'];
$tiempo = $_POST['tiempo'];
$idsI = $_POST['idsI'];
$idsP= $_POST['idsP'];
$idsR = $_POST['idsR'];
$desc = $_POST['desc'];

if(crearPlatilloCompleto($name, $menu, $tiempo, $idsI, $idsP, $idsR, $desc)){
	echo(1);
}




?>
