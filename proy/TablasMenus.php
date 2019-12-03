<?php

function tablaMenusMod(){
		$result = getMenus();
				if (mysqli_num_rows($result) > 0 ) {
					echo "<div class='row'>";
	    				echo "<div class='col s4 offset-s4'>";
		        			echo "<div class='row'>";
							echo "<h5 class='table-title'>Menus</h5>";
							echo "<table class='centered highlight dashboard-table'>";
								echo "<thead>";
								echo "<tr>";
									echo "<th>ID</th>";
									echo "<th>Menu</th>";
									echo "<th>Editar</th>";
									echo "<th>Eliminar</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
									while ($row = mysqli_fetch_assoc($result)) {

										echo "<tr>";
											echo "<td>" . $row["IDMenu"] . "</td>";
											echo "<td contenteditable = 'false'>" . $row["NombreMenu"] . "</td>";
											//echo "<th><button type='button' name='edit' id='edit' class='right btn-small btn-danger btn_remove green lighten-1'><i href='#mod' class='material-icons'>edit</i></button></th>";
											echo "<td style='text-align: right; padding: 0px 0px; '><a onclick='showModifyModalMenu(".$row["IDMenu"].", &quot;".$row["NombreMenu"]."&quot; )' href='#editModal' id='".$row["IDMenu"]."' style='display: block;' class='right  waves-effect waves-green lighten-1 btn-flat green-text modal-trigger'><i class='material-icons'>edit</i></a></td>";
											echo "<td style='text-align: right; padding: 0px 0px; '><a onclick='showDeleteModalMenu(".$row["IDMenu"].", &quot;".$row["NombreMenu"]."&quot; )' href='#removeModal' id='".$row["IDMenu"]."' style='display: block;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>";
										echo "</tr>";
									}
								echo "</tbody>";
							echo "</table>";
							echo "</div>";
	    				echo "</div>";
        			echo "</div>";
					
				}
	}

	function tablaMenus(){
		$db = connectDB();
		$result = getMenus();
				if (mysqli_num_rows($result) > 0 ) {
					echo "<div class='row'>";
	    				echo "<div class='col s3'>";
		        			echo "<div class='row'>";
							echo "<h5 class='table-title'>Menus</h5>";
							echo "<table class='centered highlight dashboard-table'>";
								echo "<thead>";
								echo "<tr>";
									echo "<th>Menu</th>";
									echo "<th>No. de Clientes</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
									while ($row = mysqli_fetch_assoc($result)) {
										
										$nomMenu = $row["NombreMenu"];
										$clientes = mysqli_query( $db , "SELECT COUNT(IDCliente) FROM Clientes as C, Menus as M WHERE C.Menu = M.IDMenu AND M.NombreMenu = NombreMenu");
										$num = mysqli_fetch_assoc($clientes);

										echo "<tr>";
											echo "<td>" . $row["NombreMenu"] . "</td>";
										    echo "<td>" . $num["COUNT(IDCliente)"]  . "</td>";
										echo "</tr>";
									}
								echo "</tbody>";
								echo "<tfoot>";
								echo "<tr>";
									echo "<th>Clientes Totales: </th>";
									$tot = mysqli_query($db,"SELECT COUNT(IDCliente) FROM Clientes");
									$cli = mysqli_fetch_assoc($tot);
									echo "<th>" . $cli["COUNT(IDCliente)"] . "</th>";
								echo "</tr>";
								echo "</tfoot>";
							echo "</table>";
							echo "</div>";
							botonMenus();
	    				echo "</div>";
        			echo "</div>";
					
				}
	}

?>