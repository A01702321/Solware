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


	function crearMenu($nombreMenu) {
	    $db = connectDB();
	    $query='INSERT INTO Menus (NombreMenu) VALUES (?)';

	    if (!($statement = $db->prepare($query))) {
	        die("No se pudo preparar la consulta para la bd: (" . $db->errno . ") " . $db->error);

	    }
	    if (!$statement->bind_param("s", $nombreMenu)) {
	        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error);

	    }
	    
	    if (!$statement->execute()) {
	        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
	    } 

	    closeDB($db);
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

	function crearIngrediente($name) {

	}

    function obtenerTiempos(){
         $db=connectDB();
    $query="SELECT * FROM Tiempos";
    $registros = $db->query($query);
    $consulta = "";
    if(!$registros)
    {
       $consulta="No se encontraron tiempos";
    }
    $datos=array();
    
    if(($registros->num_rows) > 0){
        while($row = mysqli_fetch_array($registros,MYSQLI_BOTH)){
          array_push($datos, array($row["NombreTiempo"]));
        } 
    }
    for($i=0; $i<count($datos); $i++)
    {
        $tiempo=$datos[$i][0];
        
        $consulta.='<tr> 
        <td><p>
            <label>
            <input name="tiempomenu" type="checkbox" value="'.$tiempo.'"/>
            <span></span>
            </label>
            </p></td>
        <td>'.$tiempo.'</td></tr>';
    }
    closeDB($db);
    mysqli_free_result($registros);
    echo $consulta;   
    }

function obtenerMenu(){
    $db = connectDB();
    $query="SELECT * FROM Menus";
    $registros = $db->query($query);
    if (!$registros) {
        return false;
    }
    $datos=array();
    while($row = mysqli_fetch_array($registros,MYSQLI_BOTH)){
      array_push($datos, array($row["IDMenu"],$row["NombreMenu"]));
    }
    for($i=0; $i<count($datos); $i++)

    {
        $id=$datos[$i][0];
        $menu=$datos[$i][1];
        echo"<option value='id'>$menu</option>";
    }
    closeDB($db);  
}

function obtenerIngredient(){
	  $db =connectDB();
     
    
        $query="SELECT NombreIngrediente,IDIngrediente FROM Ingredientes";
     
       $registros = $db->query($query);

       $datos=array();

       if(($registros->num_rows) > 0){
        while($row = mysqli_fetch_array($registros,MYSQLI_BOTH)){
        	array_push($datos,array($row["IDIngrediente"],$row["NombreIngrediente"]));
        } 
    }
     
        closeDb($db);
     
        return $datos;
   
}





?>