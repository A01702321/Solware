<?php
	require_once "util.php";

	$result = getClients();
	//$result2 = getClientsByMenu("Elite");
	//$result3 = getClientsByTime("0COM0");
	if(isset($_GET['consult'])){
		if (mysqli_num_rows($result) > 0 ) {
			# code...
			echo "<h1>Lista de clientes</h1>";
			while ($row = mysqli_fetch_assoc($result)) {
				
				echo "<tr>";
				echo "<td>" . $row["IDCliente"] . "</td>";
				echo "<td>" . $row["Nombre"] . "</td>";
				echo "<td>" . $row["Tiempos"] . "</td>";
				echo "<td>" . $row["NombreMenu"] . "</td>";
				echo "</tr><br>";
			}
			
		}
	}

?>