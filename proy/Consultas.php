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
					echo "<div><th style='text-align: right;'><a onclick='showDeleteBtns()' id ='erase' class='btn-floating btn-medium waves-effect waves-light grey'><i class='material-icons'>delete_outline</i></a></th></div>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = mysqli_fetch_assoc($result)) {
						
						echo "<tr>";
						echo "<td>" . $row["IDCliente"] . "</td>";
						echo "<td>" . $row["Nombre"] . "</td>";
						echo "<td>" . $row["Menu"] . "</td>";
						echo "<td style='text-align: right;     padding: 0px 0px; '><a onclick='showDeleteModalCliente(".$row["IDCliente"].", &quot;".$row["Nombre"]."&quot; )' href='#removeModalCliente' id='".$row["IDCliente"]."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>"
							;
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
					echo "<div><th style='text-align: right;'><a onclick='showDeleteBtns()' id ='erase' class='btn-floating btn-medium waves-effect waves-light grey'><i class='material-icons'>delete_outline</i></a></th></div>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					
					while ($row = mysqli_fetch_assoc($result)) {
						$grupo = getGrupos($row["GrupoAlimenticio"]);
						echo "<tr style='height: 47px;' id='row". $row["IDIngrediente"] ."'>";
						echo "<td>" . $row["IDIngrediente"] . "</td>";
						echo "<td>" . $row["NombreIngrediente"] . "</td>";
						echo "<td>" . $grupo . "</td>";
						echo "<td style='text-align: right;     padding: 0px 0px; '><a onclick='showDeleteModal(".$row["IDIngrediente"].", &quot;".$row["NombreIngrediente"]."&quot; )' href='#removeModal' id='".$row["IDIngrediente"]."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>"
							;
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