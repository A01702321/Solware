<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$tiempo = $_POST['tiempo'];
$menu= $_POST['menu'];



obtenerPlatillosRestricciones($menu, $tiempo);





?>
