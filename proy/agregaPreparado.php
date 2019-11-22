<?php
	include("header.html");
	require_once("util.php");
	 include_once("AgregaPreparado.html");
	  if(isset($_POST["nombreprep"])){
         if (empty($_POST["nombreprep"]) || empty($_POST["ing1"])) {
             echo '<script language="javascript">';
             echo 'alert("Se requiere llenar el campo")';
             echo '</script>';
        }  
        else if (!preg_match("/^[a-zA-Z]+[ ]*+[a-zA-Z]*$/",$_POST["nombreprep"])) {
            echo '<script language="javascript">';
            echo 'alert("Solo se permiten letras y espacios \nNo se puede iniciar con espacio")';
            echo '</script>';
        }else{
        	$namep = preg_replace('/\s+/', ' ',$_POST["nombreprep"]);
        	$ing = preg_replace('/\s+/', ' ',$_POST["ing1"]);
            crearPreparadoIngrediente($namep,$ing);
            header("location:registroExitoso.php");
        }
    }
    
    include_once("footer.html");
?>