<?
	require_once("util.php");
	

	$nombre = $_POST['nombre'];
	$ings = $_POST['ings'];
	if (crearPreparadoCompleto($nombre, $ings)) {
		# code...
		echo (1);
	}
?>