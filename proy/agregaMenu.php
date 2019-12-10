<?php  
    session_start();

    require_once "util.php";
    echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>";

    if(isset($_SESSION["User"])){
	include_once("header.html");
    include_once("AgregaMenu.html");

    if(isset($_POST["nombreMenu"])){
             if (empty($_POST["nombreMenu"])) {
                echo "<script>M.toast({html: 'Se requiere llenar el campo.', classes: 'red rounded'});</script>";
            }  
            else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*+[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/",$_POST["nombreMenu"])) {
                echo "<script>M.toast({html: 'Solo se permiten letras y espacios. <br> No debes empezar con espacio tampoco.', classes: 'red rounded'});</script>";
            }
            else{
                $namep = preg_replace('/\s+/', ' ',$_POST["nombreMenu"]);
                if(!existe("Menus","NombreMenu", $namep, true)){
                    crearMenu($namep);   
                    echo "<script>M.toast({html: 'Registro exitoso.', classes: 'green rounded'});</script>";
                }else {
                include_once("header.html");
                echo "<script>M.toast({html: 'Ya existe un menú con el nombre: ". $namep ."', classes: 'red rounded'});</script>";
                include_once("AgregaMenu.html");
                 } 
            }
        }

    include_once("footer.html");

    }

    else{
        header("location:../index.php");
    }
?>