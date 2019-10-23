<?php
	require_once "util.php";
	include("AgregaMenu.html");

	function insert_menus(){
		

		$menu =$_POST['menu'];


		if (strlen($menu) > 0) {
			# code...
			if (insertMenu($menu)) {
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