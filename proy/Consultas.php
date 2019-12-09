<?php
	require_once "util.php";
	
	if(isset($_GET['q'])){
		if($_SERVER["REQUEST_METHOD"] == "GET" ){
			$id = $_GET['q']; 

			if ($id == "clientes") {
				echo '<script>obtenCliente(1);</script>';
				$result = getClients();
				if (mysqli_num_rows($result) > 0 ) {
					# code...

					echo "<h3 class='table-title'>Lista de Clientes</h3>";

					echo '
					<div class="row">
				      <div class="col s12">
				        <h6><b>Buscar clientes:</b></h6><br>
				        <div class="table-responsive" vertical-align="center">  
				          <table class="table " id="clientes" > 
				            <tr>
				              <td class="vert-aligned">
				                <div class="input-field">
				                  <input type="text" id="rest1" class="validate" name ="rest1" onkeyup="obtenCliente(1)">
				                  <label>Introduce el nombre...</label>
				                  <div id="resultado1"></div>
				                </div>
				                <div>
				                  <br>
				                </div>
				              </td>
				            </tr>      
				          </table>
				        </div>
				        <input type="hidden" value="" name="valorRestricciones" id="valorRestricciones"/>
				      </div>
				    </div>';
				    /*
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
					
					$bd = connectDB();
					while ($row = mysqli_fetch_assoc($result)) {
						
						$nomMenu = $row["Menu"];
						$sql = "SELECT NombreMenu FROM Menus Where IDMenu = '$nomMenu'";
						$menus = mysqli_query($bd, $sql);
						$menu = mysqli_fetch_assoc($menus);

						echo "<tr>";
						echo "<td>" . $row["IDCliente"] . "</td>";
						echo "<td>" . $row["Nombre"] . "</td>";
						echo "<td>" . $menu["NombreMenu"] . "</td>";
						echo "<td style='text-align: right;     padding: 0px 0px; '><a onclick='showDeleteModalCliente(".$row["IDCliente"].", &quot;".$row["Nombre"]."&quot; )' href='#removeModalCliente' id='".$row["IDCliente"]."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>"
							;
						echo "</tr>";
					}
					closeDB($bd);

					echo "</tbody>";
					echo "</table>";
					
					*/
				}

			}

			if ($id == "ingredientes") {
				$result = getIngredientes();

				if (mysqli_num_rows($result) > 0 ) {
					# code...
					echo "<h3 class='table-title'>Lista de Ingredientes</h3>";

					echo '
					<div class="row">
				      <div class="col s12">
				        <h6><b>Buscar Ingredientes:</b></h6><br>
				        <div class="table-responsive" vertical-align="center">  
				          <table class="table " id="ingredientes" > 
				            <tr>
				              <td class="vert-aligned">
				                <div class="input-field">
				                  <input type="text" id="rest1" class="validate" name ="rest1" onkeyup="obtenerIngredientes(1)">
				                  <label>Introduce el nombre de Ingrediente...</label>
				                  <div id="resultado1"></div>
				                </div>
				                <div>
				                  <br>
				                </div>
				              </td>
				            </tr>      
				          </table>
				        </div>
				        <input type="hidden" value="" name="valorRestricciones" id="valorRestricciones"/>
				      </div>
				    </div>';

					/*
					echo "<table class='consult-table'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Nombre</th>";
					echo "<th>Grupo Alimenticio</th>";
					echo "<div><th style='text-align: right;'><a onclick='showDeleteBtns()' id ='erase' class='right btn-floating btn-medium waves-effect waves-light grey'><i class='material-icons'>delete_outline</i></a></th></div>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					//LLenado de tabla con funciones con parametros correspondientes 
					while ($row = mysqli_fetch_assoc($result)) {
						$grupo = getGrupos($row["GrupoAlimenticio"]);
						$categorias = json_encode(getCategorias($row["IDIngrediente"]));

						echo "<tr style='height: 47px;' id='row". $row["IDIngrediente"] ."'>";
						echo "<td>" . $row["IDIngrediente"] . "</td>";
						echo "<td>" . $row["NombreIngrediente"] . "</td>";
						echo "<td>" . $grupo . "</td>";
						echo "<td style='text-align: right;     padding: 0px 0px; width:10%; '><a onclick='showModifyModal(&quot;".$row["NombreIngrediente"]."&quot;,".$row["IDIngrediente"].",".$row["GrupoAlimenticio"].", &quot;".$grupo."&quot;, ".$categorias."  )' href='#modifyModal' id='".$row["IDIngrediente"]."' style='display: block;' class='right  waves-effect waves-grey btn-flat grey-text '><i class='material-icons'>create</i></a>"
							;
						echo "<a onclick='showDeleteModal(".$row["IDIngrediente"].", &quot;".$row["NombreIngrediente"]."&quot; )' href='#removeModal' id='".$row["IDIngrediente"]."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>"
							;
											}
					echo "</tbody>";
					echo "</table>";
					*/
					
				}
			}

			if ($id == "preparados") {
				$result = getPreparados();
				if (mysqli_num_rows($result) > 0 ) {
					# code...
					echo "<h3 class='table-title'>Lista de Preparados</h3>";
					
					echo '
					<div class="row">
				      <div class="col s12">
				        <h6><b>Buscar preparados:</b></h6><br>
				        <div class="table-responsive" vertical-align="center">  
				          <table class="table " id="preparados" > 
				            <tr>
				              <td class="vert-aligned">
				                <div class="input-field">
				                  <input type="text" id="rest1" class="validate" name ="rest1" onkeyup="obtenPreparados(1)">
				                  <label>Introduce el nombre de preparados...</label>
				                  <div id="resultado1"></div>
				                </div>
				                <div>
				                  <br>
				                </div>
				              </td>
				            </tr>      
				          </table>
				        </div>
				        <input type="hidden" value="" name="valorRestricciones" id="valorRestricciones"/>
				      </div>
				    </div>';

					/*
					echo "<table class='consult-table'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Nombre</th>";
					echo "<div><th style='text-align: right;'><a onclick='showDeleteBtns()' id ='erase' class='btn-floating btn-medium waves-effect waves-light grey'><i class='material-icons'>delete_outline</i></a></th></div>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = mysqli_fetch_assoc($result)) {
						
						echo "<tr>";
						echo "<td>" . $row["IDPreparado"] . "</td>";
						echo "<td>" . $row["NombrePreparado"] . "</td>";
							echo "<td style='text-align: right;     padding: 0px 0px; '><a onclick='showDeleteModalPreparado(".$row["IDPreparado"].", &quot;".$row["NombrePreparado"]."&quot; 
						)' href='#removeModalPreparado' id='".$row["IDPreparado"]."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>"
							;
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					*/
					
				}
			}

			if ($id == "recetas") {
				$result = getRecetas();
				if (mysqli_num_rows($result) > 0 ) {
					# code...
					echo "<h3 class='table-title'>Lista de Recetas</h3>";

					echo '
					<div class="row">
				      <div class="col s12">
				        <h6><b>Buscar Recetas:</b></h6><br>
				        <div class="table-responsive" vertical-align="center">  
				          <table class="table " id="platillos" > 
				            <tr>
				              <td class="vert-aligned">
				                <div class="input-field">
				                  <input type="text" id="rest1" class="validate" name ="rest1" onkeyup="obtenRecetas(1)">
				                  <label>Introduce el nombre de receta...</label>
				                  <div id="resultado1"></div>
				                </div>
				                <div>
				                  <br>
				                </div>
				              </td>
				            </tr>      
				          </table>
				        </div>
				        <input type="hidden" value="" name="valorRestricciones" id="valorRestricciones"/>
				      </div>
				    </div>';

					/*
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
					*/
					
				}
			}

			if ($id == "platillos") {
				$result = getRecetas();
				if (mysqli_num_rows($result) > 0 ) {
					# code...
					echo "<h3 class='table-title'>Lista de Platillos</h3>";

					echo '
					<div class="row">
				      <div class="col s12">
				        <h6><b>Buscar Platillos:</b></h6><br>
				        <div class="table-responsive" vertical-align="center">  
				          <table class="table " id="platillos" > 
				            <tr>
				              <td class="vert-aligned">
				                <div class="input-field">
				                  <input type="text" id="rest1" class="validate" name ="rest1" onkeyup="obtenPlatillos(1)">
				                  <label>Introduce el nombre de platillo...</label>
				                  <div id="resultado1"></div>
				                </div>
				                <div>
				                  <br>
				                </div>
				              </td>
				            </tr>      
				          </table>
				        </div>
				        <input type="hidden" value="" name="valorRestricciones" id="valorRestricciones"/>
				      </div>
				    </div>';
					
				}
			}
				    echo '<script type="text/javascript">',
				    'obtenCliente(1);',
				    '</script>';

			
		}


	}


?>