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
            else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*+[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/",$_POST["nombreMenu"])) {
                echo '<script language="javascript">';
                echo 'alert("Solo se permiten letras y espacios \nNo se puede iniciar con espacio")';
                echo '</script>';|
            }else{
                $namep = preg_replace('/\s+/', ' ',$_POST["nombreMenu"]);
                if(!existe("Menus","NombreMenu", $namep, true)){
                    crearMenu($namep);        
                    header("location:registroExitoso.php");
                }else {
                include_once("header.html");
                echo("Existe ya un menú con ese nombre");
                include_once("AgregaMenu.html");
            } 
            }
        }

    include_once("footer.html");

    }

    else{
        header("location:../proy/index.php");
    }
?>