<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$name = $_POST['name'];
$group = $_POST['grupo'];
$categories = $_POST['categorias'];


$res = validateNullForm($name,$categories,$group);
if($res == 5) {
	
	$rest = crearIngCategoria($name, $categories, $group);
	
	echo $rest;
} else {
	echo $res;
	
}

?>
