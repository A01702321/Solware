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
        else if (!preg_match("/^[a-zA-Z]+[a-zA-Z ]*+[a-zA-Z]*$/",$_POST["nombreprep"])) {
            echo '<script language="javascript">';
            echo 'alert("Solo se permiten letras y espacios \nNo se puede iniciar con espacio")';
            echo '</script>';
        }else{
        	$namep = preg_replace('/\s+/', ' ',$_POST["nombreprep"]);
        	crearPreparado($namep);
        	/*if(isset($_POST["valorIngredientes"])){
                    for($i = 0; $i <= $_POST["valorIngredientes"];$i++){
                        $tipo = "ingrediente".$i;

                        if($_POST[$tipo] != NULL){
                            echo($_POST[$tipo]);
                            echo($namep);
                            agregarIngPreparado($namep,$_POST[$tipo]);
                        }
                    }
                }*/

        	/*for($i = 0; $i <= $_POST["ing".($i+1)];++$i){
        		echo '<script language="javascript">';
             	echo 'alert("Se requiere llenar el campo")';
             	echo '</script>';
        		$ing = preg_replace('/\s+/', ' ',$_POST["ing".($i+1)]);
        		echo("size: " . sizeof($_POST["ing".($i+1)]));
        		echo("ing: " . $ing);
                agregarIngPreparado($namep, $ing);
               
             }
          */
             foreach ($_POST as $ings) {
             	# code...
             	$ing = preg_replace('/\s+/', ' ',$ings);
             	if($ing != $namep && $ing != ""){
             		 agregarIngPreparado($namep, $ing);
             	}
             }

        	//echo "hola ". $_POST["valorIngredientes"];
            header("location:registroExitoso.php");
        }
    }
    
    include_once("footer.html");
?>