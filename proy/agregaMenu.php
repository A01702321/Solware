<?php  
    session_start();

    require_once "util.php";

    if(isset($_SESSION["User"])){
	include_once("header.html");
    include_once("AgregaMenu.html");
    
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
        }
    }
    include_once("footer.html");

    }

    else{
        header("location:../proy/index.php");
    }
?>