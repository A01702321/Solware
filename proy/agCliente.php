<?php
	require_once "util.php";
	include("AgregaCliente.html");

	function insert_clientes(){
		
		$name = $_POST['name'];
		$time = $_POST['time'];
		$menu =$_POST['menu'];


		if (strlen($name) > 0) {
			# code...
			if(isset(($_POST['time'])))
				# code...
				if(in_array('DES', $_POST['time']) && in_array('COM', $_POST['time']) && in_array('CEN', $_POST['time'])){
					if (insertClient($name, 'DESCOMCEN', $menu)) {
						# code...
						echo "Datos insertados a la tabla correctamente";
					}else{
						echo "Error: Datos no insertados";
					}
				}else if(in_array('DES', $_POST['time']) && in_array('COM', $_POST['time'])){
					if (insertClient($name, 'DESCOM0', $menu)) {
						# code...
						echo "Datos insertados a la tabla correctamente";
					}else{
						echo "Error: Datos no insertados";
					}
				}else if(in_array('COM', $_POST['time']) && in_array('CEN', $_POST['time'])){
					if (insertClient($name, '0COMCEN', $menu)) {
						# code...
						echo "Datos insertados a la tabla correctamente";
					}else{
						echo "Error: Datos no insertados";
					}
				}else if(in_array('DES', $_POST['time']) && in_array('CEN', $_POST['time'])){
					if (insertClient($name, 'DES0CEN', $menu)) {
						# code...
						echo "Datos insertados a la tabla correctamente";
					}else{
						echo "Error: Datos no insertados";
					}
				}else if(in_array('DES', $_POST['time'])){
					if (insertClient($name, 'DES00', $menu)) {
						# code...
						echo "Datos insertados a la tabla correctamente";
					}else{
						echo "Error: Datos no insertados";
					}
				}else if(in_array('COM', $_POST['time'])){
					if (insertClient($name, '0COM0', $menu)) {
						# code...
						echo "Datos insertados a la tabla correctamente";
					}else{
						echo "Error: Datos no insertados";
					}
				}else if(in_array('CEN', $_POST['time'])){
					if (insertClient($name, '00CEN', $menu)) {
						# code...
						echo "Datos insertados a la tabla correctamente";
					}else{
						echo "Error: Datos no insertados";
					}
				}
		}else{
			echo "No debe haber datos vacios";
		}
	}

	if (isset($_POST['insertar'])) {
		# code...
		insert_clientes();
	}

?>