<?php 

	function connectDB() {
	    
	    //variable para configurar la conexión a la base de datos dependiendo del ambiente:
	    //DEV: Ambiente de desarrollo
	    //PROD: Ambiente de producción
	    //TEST: Ambiente de pruebas
	    $environment = "DEV";
	    $servername = "mysql1008.mochahost.com";
	    $username = "dawbdorg_1701446";
	    $password = "1701446";
	    $dbname = "dawbdorg_A01701446";

	    
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
	    	SELECT C.Nombre, C.NombreMenu, 
	    	FROM Clientes C, 
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

?>