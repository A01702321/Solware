<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$tiempos = $_POST['tiempos'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$idsM= $_POST['idsM'];
$idsI = $_POST['idsI'];
$idsP= $_POST['idsP'];
$idsR = $_POST['idsR'];

if(crearRecetaCompleta($name, $idsM, $tiempos, $idsI, $idsP, $idsR, $desc)){
	echo(1);
}



?>
