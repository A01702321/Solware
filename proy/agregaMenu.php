<?php
	include("header.html");
	include("AgregaMenu.html");
	include("footer.html");
?>


<?php  
	include_once("header.html");
    require_once("util.php");
    
    if(isset($_POST["nombreMenu"])){
         if (empty($_POST["nombreMenu"])) {
             echo '<script language="javascript">';
             echo 'alert("Se requiere llenar el campo")';
             echo '</script>';
        }  
        else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["nombreMenu"])) {
            echo '<script language="javascript">';
            echo 'alert("Solo se permiten letras y especios")';
            echo '</script>';
        }else{
        	
            crearMenu($_POST["nombreMenu"]);
            header("location:menu.php");
        }
    }
    else{
        include_once("AgregaMenu.html");
    }
    include_once("footer.html");

?>