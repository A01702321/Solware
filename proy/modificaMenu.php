<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$id = $_POST['id'];
$nomMenu = $_POST['nomMenu'];
$rest = modificaMenu($id,$nomMenu);

	echo $rest;


?>
