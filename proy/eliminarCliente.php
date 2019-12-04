<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$id = $_POST['id'];


$rest = eliminarCliente($id);	
echo $rest;


?>