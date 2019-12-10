<?php
    
    session_start();

    require_once "util.php";
    // echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>";

    if(isset($_SESSION["User"])){
    	include("header.html");
    	include_once("AgregaPreparado.html");
    	/*  if(isset($_POST["nombreprep"])){
             if (empty($_POST["nombreprep"]) || empty($_POST["ing1"])) {
                echo "<script>M.toast({html: 'No puede haber campos vacios', classes: 'red rounded'});</script>";
            }  
            else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*+[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/",$_POST["nombreprep"])) {
               
                 echo "<script>M.toast({html: 'Solo se permiten letras y espacios', classes: 'red rounded'});</script>";
                 echo "<script>M.toast({html: 'No se puede iniciar ni terminar con espacio', classes: 'red rounded'});</script>";
            }else{
            	$namep = preg_replace('/\s+/', ' ',$_POST["nombreprep"]);
            	if(!existe("Preparados","NombrePreparado", $namep, true)){
            		$temp = 0;
            		 foreach ($_POST as $ings) {
	    	             	$ing = preg_replace('/\s+/', ' ',$ings);
	    	             	if($ing != $namep && $ing != ""){
	    	             		 if(!existe("Ingredientes","NombreIngrediente", $ing, true)){
	    	             		 	$temp = 1;
	    	             		 	$not = $ing;
	    	             		 	// echo("<br>No Existe el Ingrediente: <strong>". $not ."</strong> en la base de datos");
                                     echo "<script>M.toast({html: 'No Existe en la base de datos el Ingrediente : <strong>". $not ."</strong>', classes: 'red rounded'});</script>";
	    	             		 }
	    	             	}
	    	         }
	    	         if($temp == 0){
	    	        	crearPreparado($namep);
	    	        	
	    	             foreach ($_POST as $ings) {
	    	             	# code...
	    	             	$ing = preg_replace('/\s+/', ' ',$ings);
	    	             	if($ing != $namep && $ing != ""){
	    	             		 agregarIngPreparado($namep, $ing);
	    	             	}
	    	             }

	    	        	//echo "hola ". $_POST["valorIngredientes"];
                          echo "<script>M.toast({html: 'Preparado creado Existosamente', classes: 'green rounded'});</script>";
	    	         //   header("location:registroExitoso.php");
	    	        }else{
	    	        	include_once("header.html");
		               
		                include_once("AgregaPreparado.html");
	    	        }
    	        }else {
              //  include_once("header.html");
               // echo("Existe ya el Preparado: <strong>". $namep ."</strong> en la base de Datos");
               
                echo "<script>M.toast({html: 'Ya Existe en la base de Datos el Preparado :  <strong>". $namep ." </strong>', classes: 'red rounded'});</script>";
                //include_once("AgregaPreparado.html");
            } 
            }
        }*/
        
        include_once("footer.html");
    }

    else{
        header("location:../index.php");
    }
?>