<?php
	require_once "util.php";
	include("AgregaIngrediente.html");

	function insert_menus(){
		

		$preparado =$_POST['preparado'];
		$ingrediente =$_POST['ingrediente'];


		if (strlen($preparado) > 0  && strlen($ingrediente) > 0) {
			# code...
			if (insertPreparado($preparado)) {
					# code...
					echo "Datos insertados a la tabla correctamente";
				}else{
					echo "Error: Datos no insertados";
				}
			if (insertIngPrep($preparado, $ingrediente)) {
					# code...
					echo "Datos insertados a la tabla correctamente";
				}else{
					echo "Error: Datos no insertados";
				}
		}else{
			echo "No debe haber datos vacios";
		}
	}

	if (isset($_POST['insertar'])) {
		# code...
		insert_menus();
	}

?>

