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
	    	$dbname = "clase2";
	    } else if($environment == "TEST") {

	    	$servername = "mysql1008.mochahost.com";
	    	$username = "dawbdorg_1702321";
	    	$password = "1702321";
	    	$dbname = "dawbdorg_A01702321";

	    } else if($environment == "PROD") {
	    	$servername = "mysql1008.mochahost.com";
	    	$username = "habeatsg_max";
	    	$password = "12Qw-12qw12qw";
	    	$dbname = "habeatsg_db";
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


	function alimentarClientes($IDMenu, $tiempo){
		$db = connectDB();

		$sql = "SELECT C.IDCliente, Nombre FROM Clientes as C, Plan as P WHERE C.Menu = '$IDMenu' AND P.NombreTiempo = '$tiempo'";

		$res1 = mysqli_query($db, $sql);

		$sql = "SELECT IDCliente, Nombre ";

		closeDB($db);

		return $result;
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
		    
            
	    }
	    else{
            echo '<script language="javascript">';
            echo 'alert("Ese menú ya existe. Porfavor ingresa un menú nuevo.")';
            echo '</script>';
	    } 

	    closeDB($db);
	}


	function getMenus(){
		$db = connectDB();

		$sql = "SELECT IDMenu, NombreMenu FROM Menus";

		$result = mysqli_query($db, $sql);

		closeDB($db);

		return $result;
	}

	function botonMenus(){
		echo " <a class='col offset-s3 waves-effect waves-light btn' href='modificarMenu.php'>Modificar Menus</a>";
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

		INSERT INTO IngredientePreparado (IDPreparado, IDIngrediente) VALUES ((SELECT p.IDPreparado FROM Preparados p WHERE p.NombrePreparado = '$name'), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.NombreIngrediente = '$ing' ) )";



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

		INSERT INTO Restriccion_Ingrediente (IDRestriccion, IDIngrediente) VALUES ((SELECT p.IDRestriccion FROM Restricciones p WHERE p.Nombre = '$name'), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.NombreIngrediente = '$ing' ) )";


		if(mysqli_query($link, $sql)){
		    echo "Ingredientes inserted successfully.";
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
	}

	function getClients(){
		$db = connectDB();

		$sql = "SELECT IDCliente, Nombre, 	Menu FROM Clientes";

		$result = mysqli_query($db, $sql);

		closeDB($db);

		return $result;
	}

	function getIngredientes(){
		$db = connectDB();

		$sql = "CALL getIngredientes();";
		

		$result = mysqli_query($db, $sql);

		closeDB($db);

		return $result;
	}
	function getGrupos($id){
		$db = connectDB();
		
		$sql = "SELECT NombreGrupoAl FROM GruposAlimenticios Where IDGrupoAl = '$id'";

		$result = mysqli_query($db, $sql);
		$resArray = $result->fetch_assoc();
		$name = $resArray['NombreGrupoAl'];
		closeDB($db);

		return $name;
	}
	function getCategorias($id){
		$db = connectDB();
		
		$sql = "SELECT IDCategoria FROM IngredienteCategoria Where IDIngrediente = '$id'";
		$cats = array();


		$result = mysqli_query($db, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$nombreCat = getNombreCategoria($row['IDCategoria']);
			array_push($cats, $nombreCat);

		}
		closeDB($db);
		
		return ($cats);
	}
	function modifyIngCat($id,$name,$categories,$group){

		$link = connectDB();
		$res = 0;
		$sql = "START TRANSACTION";
		mysqli_query($link, $sql);
		$res += modifyIng($id,$name,$group);
		$res += modifyCategorias($name,$id,$categories);
		$sql = "COMMIT";
		mysqli_query($link, $sql);
		closeDB($link);
		return $res;


	}

	function modifyCategorias($name,$id,$categories){
		$link = connectDB();

 		$res = 0;
 		/*
 		$sql = "START TRANSACTION";
 		if(mysqli_query($link, $sql)){
		    
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		*/



		$sql = "DELETE FROM IngredienteCategoria Where IDIngrediente = '$id'";
	
		if(mysqli_query($link, $sql)){
			$res = 1;
		}
		else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		$worked = 6;
		
		if(sizeof($categories)>0){
			
			for ($i =0; $i<sizeof($categories); $i++){
				
				$category = $categories[$i];
				if($category != ""){
					crearCategoria($category);
					$worked = agregarCategoriaIng($name, $category);
				}
			}
		}

		if(($res + $worked) === 7){
			$res = 5;
		}
		/*
		$sql = "COMMIT";
		if(mysqli_query($link, $sql)){
		    
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		*/
		
		closeDB($link);
		return $res;

	}

	function modifyIng($id, $name, $group){
		$link = connectDB();

 		$res = 0;

 		$sql = "UPDATE `Ingredientes` SET `NombreIngrediente` = ?, `GrupoAlimenticio` = ? WHERE `Ingredientes`.`IDIngrediente` = ?;";
		   // Preparing the statement 
	    if (!($statement = $link->prepare($sql))) {
	        die("No se pudo preparar la consulta para la bd: (" . $link->errno . ") " . $link->error);
	        echo(7);
	    }
	    // Binding statement params 
	    if (!$statement->bind_param("sss", $name, $group, $id)) {
	        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error); 
	        echo(7);
	    }
	    
	    // Executing the statement
	    if (!$statement->execute()) {
	        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
	        echo(7);
	    } 
		else {
			$res = 1;
		}
		

		closeDB($link);
		return $res;

	}



	function getNombreCategoria($id){
		$db = connectDB();
		
		$sql = "SELECT NombreCategoria FROM Categorias Where IDCategoria = '$id'";

		$result = mysqli_query($db, $sql);
		$resArray = $result->fetch_assoc();
		$name = $resArray['NombreCategoria'];
		closeDB($db);

		return $name;
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
		        echo(7);
		    }
		    // Binding statement params 
		    if (!$statement->bind_param("ss", $name, $group)) {
		        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error); 
		        echo(7);
		    }
		    
		    // Executing the statement
		    if (!$statement->execute()) {
		        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
		        echo(7);
		    } 
		   
		}

		closeDB($link);
	}
	function eliminarIngrediente($id) {
		
		$link = connectDB();

 		$res = 2;
		
		$sql = "DELETE FROM IngredienteCategoria Where IDIngrediente = '$id'";
		mysqli_query($link, $sql);
		$sql = "DELETE FROM Ingredientes Where IDIngrediente = '$id'";
		if(mysqli_query($link, $sql)){
			$res = 1;
		}
		closeDB($link);
		return $res;
	}

	function eliminarCliente($id) {
		
		$db = connectDB();

 		$res = 2;

		$sql = "DELETE FROM Restriccion Where IDCliente = '$id'";
		mysqli_query($db, $sql);
		$sql = "DELETE FROM Plan Where IDCliente = '$id'";
		mysqli_query($db, $sql);
		$sql = "DELETE FROM ClientePlatillo Where IDCliente = '$id'";
		mysqli_query($db, $sql);
		$sql = "DELETE FROM Clientes Where IDCliente = '$id'";
		if(mysqli_query($db, $sql)){
			$res = 1;
		}
		closeDB($db);
		return $res;
	}

	function eliminarMenu($id) {
		
		$bd = connectDB();

 		$res = 2;
 		$sql = "SELECT IDMenu, NombreMenu FROM Menus";

 		$num = mysqli_query($bd, $sql);
 		if(mysqli_num_rows($num) > 0){
			$res = 3;
		}

		$sql = "DELETE FROM Menus WHERE IDMenu = '$id'";
		if(mysqli_query($bd, $sql)){
			$res = 1;
		}
		closeDB($bd);
		return $res;
	}

	function eliminarPreparado($id) {
		
		$db = connectDB();

 		$res = 2;

		$sql = "DELETE FROM IngredientePreparado Where IDPreparado = '$id'";
		mysqli_query($db, $sql);
		$sql = "DELETE FROM Preparados Where IDPreparado = '$id'";
		if(mysqli_query($db, $sql)){
			$res = 1;
		}
		closeDB($db);
		return $res;
	}

	function modificaMenu($id , $nomMenu) {
		
		$bd = connectDB();

 		$res = 2;

		$sql = "UPDATE Menus SET NombreMenu = '$nomMenu' WHERE IDMenu = '$id'";
		if(mysqli_query($bd, $sql)){
			$res = 1;
		}
		closeDB($bd);
		return $res;
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
		        echo(7);

		    }
		    // Binding statement params 
		    if (!$statement->bind_param("s", $category)) {
		        die("Falló la vinculación de los parámetros: (" . $statement->errno . ") " . $statement->error);
		        echo(7);
 
		    }
		    
		    // Executing the statement
		    if (!$statement->execute()) {
		        die("Falló la ejecución de la consulta: (" . $statement->errno . ") " . $statement->error);
		        echo(7);

		    } 

		}

		closeDB($link);
	}
	
	function crearPreparado($name) {

		$link = connectDB();
 
		// Attempt insert query execution
		$sql = "SELECT * FROM Preparados Where NombrePreparado = '$name'";

		$result = mysqli_query($link, $sql);

		if (mysqli_num_rows($result) == 0) { 
		   $sql = "INSERT INTO Preparados (NombrePreparado) VALUES (?)";
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

		INSERT INTO IngredientePreparado (IDPreparado, IDIngrediente) VALUES ((SELECT p.IDPreparado FROM Preparados p WHERE p.NombrePreparado = ?), (SELECT z.IDIngrediente FROM Ingredientes z WHERE z.NombreIngrediente = ? ) )";

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
		$bd = connectDB();
		$bd->begin_Transaction();
		try{
			crearPreparado($name);
			for ($i =0; $i<sizeof($ingredients); $i++){
				$ingredient = $ingredients[$i];
			
			agregarIngPreparado($name, $ingredients);
			$bd->commit();
			}
		}catch(Exception $e){
			$bd->rollback();
		}
	}



	function crearIngCategoria($name, $categories, $group){


		crearIngrediente($name, $group);
		$worked = 6;
		if(sizeof($categories)>0){
			for ($i =0; $i<sizeof($categories); $i++){
				
				$category = $categories[$i];
				if($category != ""){
					crearCategoria($category);
					$worked = agregarCategoriaIng($name, $category);
				}
			}
		}
		return $worked;

	}

	function validateNullForm($name, $categories, $group){
		
		$forbidden = ';';
		if($name === ''){
			return 11;
		}
		$array = str_split($name);
		foreach ($array as $char) {
			
			 if($char === $forbidden)
			 return 11;
		}	
		if($group === '' ){
			return 22;
		}

		
		for($i=0; $i<sizeof($categories); $i++){
			if($categories[$i]=== ''){
				return 5;
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

function obtenerTiempos(){ // obtiene tiempos para llenar checks
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
        $consulta.='
        <tr> 
        	<td>
        		<p>
		            <label>
		            <input name="tiempomenu[]" id="tiempomenu[]" type="checkbox" value="'.$tiempo.'"/>
		            <span></span>
		            </label>
		            '.$tiempo.'
	            </p>
	        </td>
        </tr>';
    }
    closeDB($db);
    mysqli_free_result($registros);
    echo $consulta;   
}

function obtenTiempos(){ // obtiene tiempos para poblar un dropdown
    $db = connectDB();
    $query="SELECT * FROM Tiempos";
    $registros = $db->query($query);
    if (!$registros) {
        return false;
    }
    $datos=array();
    while($row = mysqli_fetch_array($registros,MYSQLI_BOTH)){
      array_push($datos, array($row["NombreTiempo"]));
    }
    for($i=0; $i<count($datos); $i++)

    {
        $tiempo=$datos[$i][0];
        echo"$<option value=".$id.">$tiempo</option>";

    }
    closeDB($db);  
}

function obtenerPlatillos(){ // obtiene menus para poblar un dropdown
    $db = connectDB();
    $query="SELECT NombrePlatillo FROM Platillos WHERE Menu = '$IDMenu' AND Tiempo = '$tiempo'";
    $registros = $db->query($query);
    if (!$registros) {
        return false;
    }
    $datos=array();
    while($row = mysqli_fetch_array($registros,MYSQLI_BOTH)){
      array_push($datos, array($row["NombrePlatillo"]));
    }
    for($i=0; $i<count($datos); $i++)

    {
        $platillo=$datos[$i][0];
        echo"$<option value=".$id.">$platillo</option>";

    }
    closeDB($db);  
}

function obtenerMenu(){ // obtiene menus para poblar un dropdown
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
        echo"$<option id='opt".$id."'' value=".$id.">$grupo</option>";


    }
    closeDB($db);  
}

function obtenerMenuChecks(){
         $db=connectDB();
    $query="SELECT * FROM Menus";
    $registros = $db->query($query);
    $consulta = "";
    if(!$registros)
    {
       $consulta="No se encontraron menus";
    }
    $datos=array();
    
    if(($registros->num_rows) > 0){
        while($row = mysqli_fetch_array($registros,MYSQLI_BOTH)){
          array_push($datos, array($row["IDMenu"]));
        } 
    }
    for($i=0; $i<count($datos); $i++)
    {
        $tiempo=$datos[$i][0];
        $consulta.='
        <tr> 
        	<td>
        		<p>
		            <label>
		            <input name="tiempomenu[]" id="tiempomenu[]" type="checkbox" value="'.$tiempo.'"/>
		            <span></span>
		            </label>
		            '.$tiempo.'
	            </p>
	        </td>
        </tr>';
    }
    closeDB($db);
    mysqli_free_result($registros);
    echo $consulta;   
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