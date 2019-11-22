<?php 

	function connectDB() {
	    
	    //variable para configurar la conexión a la base de datos dependiendo del ambiente:
	    //DEV: Ambiente de desarrollo
	    //PROD: Ambiente de producción
	    //TEST: Ambiente de pruebas
	    $environment = "PROD";
	    
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


	function crearMenu($nombreMenu) {
	    $db = connectDB();

	    $sql = "SELECT * FROM Menus Where nombreMenu = '$nombreMenu'";

		$result = mysqli_query($db, $sql);

		if (mysqli_num_rows($result) == 0) { 
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
		    
            header("location:registroExitoso.php");
	    }
	    else{
            echo '<script language="javascript">';
            echo 'alert("Ese menú ya existe. Porfavor ingresa un menú nuevo.")';
            echo '</script>';
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
		$sql = "SELECT * FROM Ingredientes Where NombreIngrediente = '$name'";

		$result = mysqli_query($link, $sql);

		if (mysqli_num_rows($result) == 0) { 
		   $sql = "INSERT INTO Ingredientes (NombreIngrediente, GrupoAlimenticio) VALUES (?, ?)";
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
		$sql = "SELECT * FROM Categorias Where NombreCategoria = '$category'";

		$result = mysqli_query($link, $sql);

		if (mysqli_num_rows($result) == 0) { 
		   $sql = "INSERT INTO Categorias (NombreCategoria) VALUES (?)";
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
	function crearPreparado($name) {

		$link = connectDB();
 
		// Attempt insert query execution
		$sql = "SELECT * FROM Preparados Where Nombre = '$name'";

		$result = mysqli_query($link, $sql);

		if (mysqli_num_rows($result) == 0) { 
		   $sql = "INSERT INTO Preparados (Nombre) VALUES (?)";
		   // Preparing the statement 
		    if (!($statement = $link->prepare($sql))) {
		        die("No se pudo preparar la consulta para la bd: (" . $link->errno . ") " . $link->error);
		    }
		    // Binding statement params 
		    if (!$statement->bind_param("s", $name)) {
		        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error); 
		    }
		    
		    // Executing the statement
		    if (!$statement->execute()) {
		        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
		    } 
		   
		}

		closeDB($link);
	}
	function agregarIngPreparado($name, $ingredient) {

		$link = connectDB();
 
		// Attempt insert query execution
		
		
	   $sql = "

		INSERT INTO Conforman (IDPreparado, IDIngrediente) VALUES ((SELECT p.IDPreparado FROM Preparados p WHERE p.Nombre = ?), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.Nombre = ? ) )";

	   // Preparing the statement 
	    if (!($statement = $link->prepare($sql))) {
	        die("No se pudo preparar la consulta para la bd: (" . $link->errno . ") " . $link->error);
	    }
	    // Binding statement params 
	    if (!$statement->bind_param("ss", $name, $ingredient)) {
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

	function agregarCategoriaIng($name, $category) {
		$worked = false;
		$link = connectDB();
 
		// Attempt insert query execution
		
		
	   $sql = "

		INSERT INTO IngredienteCategoria (IDCategoria, IDIngrediente) VALUES ((SELECT p.IDCategoria FROM Categorias p WHERE p.NombreCategoria = ?), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.NombreIngrediente = ? ) )";

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
	    	
	    	$worked = true;
	    }
	   
		

		closeDB($link);
		if ($worked){
		
		return 6;
		}	
		else{
		return 0;
		
		}
	}
	
	function crearPreparadoIngrediente($name, $ingredients){


		crearPreparado($name);
		for ($i =0; $i<sizeof($ingredients); $i++){
			$ingredient = $ingredients[$i];
			
			agregarIngPreparado($name, $ingredient);
		}
	}


	function crearIngCategoria($name, $categories, $group){


		crearIngrediente($name, $group);
		for ($i =0; $i<sizeof($categories); $i++){
			$category = $categories[$i];
			crearCategoria($category);
			return agregarCategoriaIng($name, $category);
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
	function validateNullFormPrep($name, $ingredients){
		
		
		if($name === ''){
			return 1;
		}
		
		for($i=0; $i<sizeof($ingredients); $i++){
			if($ingredies[$i]=== ''){
				return 2;
			}
		}
		$link = connectDB();
 
		// Attempt insert query execution
		$sql = "SELECT * FROM Ingredientes Where Nombre = '$name'";

		$result = mysqli_query($link, $sql);
		closeDB($link);
		if (mysqli_num_rows($result) == 0) { 
			return 4;
		}


		
		return 5;
		
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
            <input name="tiempomenu[]" id="tiempomenu[]" type="checkbox" value="'.$tiempo.'"/>
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
        echo"$<option value=".$id.">$menu</option>";

    }
    closeDB($db);  
}
function obtenerGrupos(){
    $db = connectDB();
    $query="SELECT * FROM GruposAlimenticios";
    $registros = $db->query($query);
    if (!$registros) {
        return false;
    }
    $datos=array();
    while($row = mysqli_fetch_array($registros,MYSQLI_BOTH)){
      array_push($datos, array($row["IDGrupoAl"],$row["NombreGrupoAl"]));
    }
    for($i=0; $i<count($datos); $i++)

    {
        $id=$datos[$i][0];
        $grupo=$datos[$i][1];
        echo"$<option value=".$id.">$grupo</option>";

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

function crearCliente($first_name, $nombremenu){

	$db = connectDB();

	$query='INSERT INTO Clientes(Nombre,Menu) VALUES (?,?)';

	$registros = $db->query($query);

	if(!$registros){
		echo $registros;
	}else return true;

	if (!($statement = $db->prepare($query))) {
	        die("No se pudo preparar la consulta para la bd: (" . $db->errno . ") " . $db->error);

	    }
	    if (!$statement->bind_param("ss", $first_name, $nombremenu)) {
	        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error);

	    }
	    
	    if (!$statement->execute()) {
	        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
	    } 

	    closeDB($db);
	   
}

function agregarRestriccionACliente($IDCliente, $IDIngrediente){
	$db = connectDB();

	$query='INSERT INTO Restriccion(IDCliente,IDIngrediente) VALUES (?,?)';

	$registros = $db->query($query);

	if (!($statement = $db->prepare($query))) {
	        die("No se pudo preparar la consulta para la bd: (" . $db->errno . ") " . $db->error);

	    }
	    if (!$statement->bind_param("ss", $IDCliente, $IDIngrediente)) {
	        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error);

	    }
	    
	    if (!$statement->execute()) {
	        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
	    } 

	    closeDB($db);
}

function agregarPlanACliente($IDCliente, $NombreTiempo){
	$db = connectDB();


	$query='INSERT INTO Plan(IDCliente,NombreTiempo) VALUES (?,?)';

	$registros = $db->query($query);

	if (!($statement = $db->prepare($query))) {
	        die("No se pudo preparar la consulta para la bd: (" . $db->errno . ") " . $db->error);

	    }
	    if (!$statement->bind_param("ss", $IDCliente, $NombreTiempo)) {
	        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error);

	    }
	    
	    if (!$statement->execute()) {
	        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
	    } 

	    closeDB($db);
}

function existe($tabla,$nombreLlavePrimaria,$valorLlavePrimaria, $esString = false)
{
    $db = connectDB();
    
    if($esString)
        $query = "SELECT EXISTS(SELECT $nombreLlavePrimaria FROM $tabla WHERE $nombreLlavePrimaria='$valorLlavePrimaria')";
    else
        $query = "SELECT EXISTS(SELECT $nombreLlavePrimaria FROM $tabla WHERE $nombreLlavePrimaria=$valorLlavePrimaria)";
    
    $registros = $db->query($query);
    
    $fila = mysqli_fetch_row($registros);

    mysqli_free_result($registros);
    closeDB($db);

    return $fila[0];
}

function ultimoCliente(){
	$db = connectDB();
    $query="SELECT IDCliente FROM Clientes GROUP BY IDCliente DESC LIMIT 1";
    $registros = $db->query($query);
    $id=0;
    
    if(($registros->num_rows) > 0){
        while($row = mysqli_fetch_array($registros,MYSQLI_BOTH)){
          $id = $row["IDCliente"];
        } 
    }
    closeDB($db);
    mysqli_free_result($registros);
    return $id;
}

?>