<?php 

	function connectDB() {
	    
	    //variable para configurar la conexión a la base de datos dependiendo del ambiente:
	    //DEV: Ambiente de desarrollo
	    //PROD: Ambiente de producción
	    //TEST: Ambiente de pruebas
	      $environment = "DEV";
	    $servername = "mysql1008.mochahost.com";
	    $username = "dawbdorg_1702321";
	    $password = "1702321";
	    $dbname = "dawbdorg_A01702321";

	    
	    if ($environment == "DEV") {
	         $bd = mysqli_connect($servername,$username,$password,$dbname);
	    } else if($environment == "PROD") {
	         //TODO: Cambiar la configuración de acuerdo al ambiente de producción
	         $bd = mysqli_connect("localhost","root","passwdadmin","dawbdorg_A01701446");
	    }
	    

	    /*
	    if ($environment == "DEV") {
	         $bd = mysqli_connect("localhost","root","","ExamenParcial2");
	    } else if($environment == "PROD") {
	         //TODO: Cambiar la configuración de acuerdo al ambiente de producción
	         $bd = mysqli_connect("localhost","root","passwdadmin","ExamenParcial2");
	    }
	    */
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

		closeDb($db);

		return $result;
	}

	function getIngredientes(){
		$db = connectDB();

		$sql = "SELECT IDIngrediente, NombreIngrediente, GrupoAlimenticio FROM Ingredientes";

		$result = mysqli_query($db, $sql);

		closeDb($db);

		return $result;
	}

	function getRecetas(){
		$db = connectDB();

		$sql = "SELECT IDReceta, NombreReceta, Descripcion FROM Recetas";

		$result = mysqli_query($db, $sql);

		closeDb($db);

		return $result;
	}

	function getPreparados(){
		$db = connectDB();

		$sql = "SELECT IDPreparado, NombrePreparado FROM Preparados";

		$result = mysqli_query($db, $sql);

		closeDb($db);

		return $result;
	}

?>