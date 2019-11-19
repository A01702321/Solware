<?php 

	function connectDB() {
	    
	    //variable para configurar la conexión a la base de datos dependiendo del ambiente:
	    //DEV: Ambiente de desarrollo
	    //PROD: Ambiente de producción
	    //TEST: Ambiente de pruebas
	    $environment = "DEV";
	    
	    if ($environment == "DEV") {
	        $servername = "localhost";
	    	$username = "root";
	    	$password = "";
	    	$dbname = "clase";
	    } else if($environment == "PROD") {
	    	$servername = "mysql1008.mochahost.com";
	    	$username = "dawbdorg_1702321";
	    	$password = "1702321";
	    	$dbname = "dawbdorg_A01702321";
	    }

	    $bd = mysqli_connect($servername,$username,$password,$dbname);
	    
	    // Check connection
		if($bd === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
	    
	    // Change character set to utf8
	    mysqli_set_charset($bd,"utf8");
	   
	    return $bd;
	}

	function closeDB($bd) {
	    
	    mysqli_close($bd);
	}


	function consultarClientes() {
		$db = connectDB();
	    $resultado = array();
	    $query = "
	    	SELECT Nombre, NombreMenu, , 
	    	FROM Clientes, 
	    ";




	    $registros = $db->query($query);
	    
	    while ($fila = mysqli_fetch_array($registros, MYSQLI_BOTH)) {
	       array_push($resultado, array($fila["ID"],$fila["Nombre"]));
	    }
	    $regresar='
	    	<table class="striped">
	    		<thead>
	    			<tr>
	    				<td><b>Nombre</b></td>
	    				<td><b>Bitacora</b></td>
	    			</tr>
	    		</thead>

	    		<tbody>';
	    
	    for($i = 0; $i < count($resultado); $i++){
	        
	        $ID=$resultado[$i][0];
	        $query1 = "
	        	SELECT Estado,Momento
	        	FROM Bitacora,Estados
	        	WHERE IDzombie='" . $ID . "' AND Estados.ID=IDestado
	        ";

	        $resultado2 = array();
	        $registros2 = $db->query($query1);

	    if($registros2){

	        while ($fila = mysqli_fetch_array($registros2, MYSQLI_BOTH)) {
	            array_push($resultado2, array($fila["Estado"],$fila["Momento"]));
	        }
	        $regresar .= "<tr><td>".$resultado[$i][1]."</td><td>";

	        for($j=0; $j < count($resultado2); $j++){
	            $regresar.= $resultado2[$j][0]."  ".$resultado2[$j][1]."<br/>";
	        }
	        $regresar.="</td></tr>";
	    } else{
	        	$regresar.="<tr><td>".$resultado[$i][1]."</td><td>";
	            $regresar.="</td></tr>";
	    }
	    }

    	$regresar.="</tbody></table>";
  
	   	closeDB($db);
	   	echo $regresar;
	}


	function preparadoIng(){
		
		$name = $_POST['name'];
		$ing = $_POST['ingredient'];
		// Check connection
		if($link === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		 
		// Attempt insert query execution
		$sql = "

		INSERT INTO Conforman (IDPreparado, IDIngrediente) VALUES ((SELECT p.IDPreparado FROM Preparados p WHERE p.Nombre = '$name'), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.Nombre = '$ing' ) )";



		if(mysqli_query($link, $sql)){
		    echo "Records inserted successfully.";
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
	}

	function preparadoNom(){
		
		$name = $_POST['name'];
		// Check connection
		if($link === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		 
		// Attempt insert query execution
		$sql = "
		INSERT INTO Preparados (Nombre) VALUES ('$name')";

		if(mysqli_query($link, $sql)){
		    echo "Records inserted successfully.";
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
	}

	function ingredienteNom($name, $grupo, $categoria){
		

		// Check connection
		if($link === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		 
		// Attempt insert query execution
		$sql = "
		SELECT * FROM Ingredientes Where Nombre = '$name'";
		$Result = mysqli_query($link, $sql);

		if (mysqli_num_rows($Result) == 0) { 
		   $sql = "INSERT INTO Ingredientes (Nombre, GrupoAlimenticio) VALUES ('$name', '$grupo')";
		   $x = mysqli_query($link, $sql);
		}

		$sql = "
		SELECT * FROM Categoria Where Nombre = '$categoria'";
		$Result = mysqli_query($link, $sql);

		if (mysqli_num_rows($Result) == 0) { 
		   $sql = "INSERT INTO Categoria (Nombre) VALUES ('$categoria')";
		   $x = mysqli_query($link, $sql);
		}

		$sql = "

		INSERT INTO Pertenece (IDCategoria, IDIngrediente) VALUES ((SELECT p.IDCategoria FROM Categoria p WHERE p.Nombre = '$categoria'), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.Nombre = '$name' ) )";


		if(mysqli_query($link, $sql)){
		    echo "Categoria inserted successfully.";
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}

	}


	function restriccionCat(){
		$name = $_POST['name'];
		$categoria = $_POST['cat'];

		// Check connection
		if($link === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		 
		// Attempt insert query execution


		$sql = "
		SELECT IDIngrediente FROM Pertenece Where IDCategoria = (SELECT IDCategoria FROM Categoria Where Nombre = '$categoria');
		";
		$Result = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($Result)) {
			$sql = "INSERT INTO Restriccion_Ingrediente (IDRestriccion, IDIngrediente) VALUES ((SELECT p.IDRestriccion FROM Restricciones p WHERE p.Nombre = '$name'), ( '$row[0]' ))";
			if(mysqli_query($link, $sql)){
		    echo "Categoria inserted successfully.";
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}}


		
	}

	function loginUser(){

		try {			
			$userData 			=	$this->input->post("user",TRUE);
			$userPassword 		=	$this->input->post("password",TRUE);
			
			$sql='SELECT * from Usuarios where usuario=? OR password=? ORDER By id_Usuario';
			$user=$this->link->query($sql,array($userData,$userPassword));			
			if($user->num_rows()>0){
				if( $user->row()->password==$userPassword && $user->row()->usuario==$userData) {				
					$data= array(
						'id_Usuario' => $user->row()->id_Usuario,						
						'nombre_Usuario' => $user->row()->nombre						
					 );
					$this->session->unset_userdata("Habeats");  /// elimino las sesiones anteriores y creo una nueva

					$this->session->set_userdata("Habeats",$data);
					return "success";
				}	
				else{
					return "Verifique su contraseña"; //error en password 
				}
			}
			else{
				return "El usuario no está registrado"; //error usuario no existe
			}
			

		} catch (Exception $e) {
			return "error3";
		}
	}

	function logout(){
		$this->session->unset_userdata("Habeats");
		return true;
	}

	function restriccionNom(){
		
		$name = $_POST['name'];
		$ing = $_POST['ingrediente'];

		// Check connection
		if($link == false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		 
		// Attempt insert query execution
		$sql = "
		SELECT * FROM Restricciones Where Nombre = '$name'";
		$Result = mysqli_query($link, $sql);

		if (mysqli_num_rows($Result) == 0) { 
		   $sql = "INSERT INTO Restricciones (Nombre) VALUES ('$name')";
		   $x = mysqli_query($link, $sql);
		}



		$sql = "

		INSERT INTO Restriccion_Ingrediente (IDRestriccion, IDIngrediente) VALUES ((SELECT p.IDRestriccion FROM Restricciones p WHERE p.Nombre = '$name'), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.Nombre = '$ing' ) )";


		if(mysqli_query($link, $sql)){
		    echo "Ingredientes inserted successfully.";
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
	}

	function getClients(){
		$db = connectDB();

		$sql = "SELECT IDCliente, Nombre, NombreMenu FROM Clientes";

		$result = mysqli_query($db, $sql);

		closeDB($db);

		return $result;
	}

	function getIngredientes(){
		$db = connectDB();

		$sql = "SELECT IDIngrediente, NombreIngrediente, GrupoAlimenticio FROM Ingredientes";

		$result = mysqli_query($db, $sql);

		closeDB($db);

		return $result;
	}

	function getRecetas(){
		$db = connectDB();

		$sql = "SELECT IDReceta, NombreReceta, Descripcion FROM Recetas";

		$result = mysqli_query($db, $sql);

		closeDB($db);

		return $result;
	}

	function getPreparados(){
		$db = connectDB();

		$sql = "SELECT IDPreparado, NombrePreparado FROM Preparados";

		$result = mysqli_query($db, $sql);

		closeDB($db);

		return $result;
	}

	function crearIngrediente($name, $group) {

		$link = connectDB();
 
		// Attempt insert query execution
		$sql = "SELECT * FROM Ingredientes Where Nombre = '$name'";

		$result = mysqli_query($link, $sql);

		if (mysqli_num_rows($result) == 0) { 
		   $sql = "INSERT INTO Ingredientes (Nombre, GrupoAlimenticio) VALUES (?, ?)";
		   // Preparing the statement 
		    if (!($statement = $link->prepare($sql))) {
		        die("No se pudo preparar la consulta para la bd: (" . $link->errno . ") " . $link->error);
		    }
		    // Binding statement params 
		    if (!$statement->bind_param("ss", $name, $group)) {
		        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error); 
		    }
		    
		    // Executing the statement
		    if (!$statement->execute()) {
		        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
		    } 
		   
		}

		closeDB($link);
	}

	function crearCategoria($category) {

		$link = connectDB();
 
		// Attempt insert query execution
		$sql = "SELECT * FROM Categoria Where Nombre = '$category'";

		$result = mysqli_query($link, $sql);

		if (mysqli_num_rows($result) == 0) { 
		   $sql = "INSERT INTO Categoria (Nombre) VALUES (?)";
		   // Preparing the statement 
		    if (!($statement = $link->prepare($sql))) {
		        die("No se pudo preparar la consulta para la bd: (" . $link->errno . ") " . $link->error);
		    }
		    // Binding statement params 
		    if (!$statement->bind_param("s", $category)) {
		        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error); 
		    }
		    
		    // Executing the statement
		    if (!$statement->execute()) {
		        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
		    } 
		   
		}

		closeDB($link);
	}
	function agregarCategoriaIng($name, $category) {

		$link = connectDB();
 
		// Attempt insert query execution
		
		
	   $sql = "

		INSERT INTO Pertenece (IDCategoria, IDIngrediente) VALUES ((SELECT p.IDCategoria FROM Categoria p WHERE p.Nombre = ?), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.Nombre = ? ) )";

	   // Preparing the statement 
	    if (!($statement = $link->prepare($sql))) {
	        die("No se pudo preparar la consulta para la bd: (" . $link->errno . ") " . $link->error);
	    }
	    // Binding statement params 
	    if (!$statement->bind_param("ss", $category, $name)) {
	        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error); 
	    }
	    
	    // Executing the statement
	    if (!$statement->execute()) {
	        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
	    } 
	    else{
	    	echo("Consulta agregada correctamente");
	    }
	   
		

		closeDB($link);
	}
	function crearIngCategoria($name, $categories, $group){


		crearIngrediente($name, $group);
		for ($i =0; $i<sizeof($categories); $i++){
			$category = $categories[$i];
			crearCategoria($category);
			agregarCategoriaIng($name, $category);
		}

	}

	function validateNullForm($name, $categories, $group){
		
		
		if($name === ''){
			return 1;
		}
		if($group === '' ){
			return 2;
		}

		if(sizeof($categories) === 0){
			return 3;
		}
		for($i=0; $i<sizeof($categories); $i++){
			if($categories[$i]=== ''){
				return 4;
			}
		}
		
		return 5;
		
	}


?>