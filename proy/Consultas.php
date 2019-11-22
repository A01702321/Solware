<?php
	require_once "util.php";
	
	if(isset($_GET['q'])){
		if($_SERVER["REQUEST_METHOD"] == "GET" ){
			$id = $_GET['q']; 

			if ($id == "clientes") {
				$result = getClients();
				if (mysqli_num_rows($result) > 0 ) {
					# code...
					echo "<h3 class='table-title'>Lista de Clientes</h3>";
					echo "<table class='consult-table'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Nombre</th>";
					echo "<th>Menu Inscrito</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = mysqli_fetch_assoc($result)) {
						
						echo "<tr>";
						echo "<td>" . $row["IDCliente"] . "</td>";
						echo "<td>" . $row["Nombre"] . "</td>";
						echo "<td>" . $row["Menu"] . "</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					
				}
			}

			if ($id == "ingredientes") {
				$result = getIngredientes();
				if (mysqli_num_rows($result) > 0 ) {
					# code...
					echo "<h3 class='table-title'>Lista de Ingredientes</h3>";
					echo "<table class='consult-table'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Nombre</th>";
					echo "<th>Grupo Alimenticio</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = mysqli_fetch_assoc($result)) {
						
						echo "<tr>";
						echo "<td>" . $row["IDIngrediente"] . "</td>";
						echo "<td>" . $row["NombreIngrediente"] . "</td>";
						echo "<td>" . $row["GrupoAlimenticio"] . "</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					
				}
			}

			if ($id == "preparados") {
				$result = getPreparados();
				if (mysqli_num_rows($result) > 0 ) {
					# code...
					echo "<h3 class='table-title'>Lista de Preparados</h3>";
					echo "<table class='consult-table'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Nombre</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = mysqli_fetch_assoc($result)) {
						
						echo "<tr>";
						echo "<td>" . $row["IDPreparado"] . "</td>";
						echo "<td>" . $row["NombrePreparado"] . "</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					
				}
			}

			if ($id == "recetas") {
				$result = getRecetas();
				if (mysqli_num_rows($result) > 0 ) {
					# code...
					echo "<h3 class='table-title'>Lista de Recetas</h3>";
					echo "<table class='consult-table'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Nombre</th>";
					echo "<th>Descripcion</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = mysqli_fetch_assoc($result)) {
						
						echo "<tr>";
						echo "<td>" . $row["IDReceta"] . "</td>";
						echo "<td>" . $row["NombreReceta"] . "</td>";
						echo "<td>" . $row["Descripcion"] . "</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					
				}
			}

			
		}


	}

?>