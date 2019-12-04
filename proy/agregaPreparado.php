<?php
    
    session_start();

    require_once "util.php";

    if(isset($_SESSION["User"])){
    	include("header.html");
    	include_once("AgregaPreparado.html");
    	  if(isset($_POST["nombreprep"])){
             if (empty($_POST["nombreprep"]) || empty($_POST["ing1"])) {
                 echo '<script language="javascript">';
                 echo 'alert("Se requiere llenar el campo")';
                 echo '</script>';
            }  
            else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*+[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/",$_POST["nombreprep"])) {
                echo '<script language="javascript">';
                echo 'alert("Solo se permiten letras y espacios \nNo se puede iniciar con espacio")';
                echo '</script>';
            }else{
            	$namep = preg_replace('/\s+/', ' ',$_POST["nombreprep"]);
            	if(!existe("preparados","NombrePreparado", $namep, true)){
    	        	crearPreparado($namep);
    	        	
    	             foreach ($_POST as $ings) {
    	             	# code...
    	             	$ing = preg_replace('/\s+/', ' ',$ings);
    	             	if($ing != $namep && $ing != ""){
    	             		 agregarIngPreparado($namep, $ing);
    	             	}
    	             }

    	        	//echo "hola ". $_POST["valorIngredientes"];
    	            header("location:registroExitoso.php");
    	        }else {
                include_once("header.html");
                echo("Existe ya un preparado con los datos introducidos");
                include_once("AgregaPreparado.html");
            } 
            }
        }
        
        include_once("footer.html");
    }

    else{
        header("location:../proy/index.php");
    }
?>