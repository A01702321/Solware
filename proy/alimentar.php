<?php
session_start();

    require_once "util.php";
    echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>";

    if(isset($_SESSION["User"])){

    	include("header.html");
    	include("Alimentar.html");

        if(isset($_POST["fecha"]) && isset($_POST["nombreMenu"]) && isset($_POST["nombreTiempo"]) && isset($_POST["nombrePlatillo"])){
             if (empty($_POST["fecha"])  || empty($_POST["nombreMenu"]) || empty($_POST["nombreTiempo"]) || empty($_POST["nombrePlatillo"])) {
                    echo "<script>M.toast({html: 'Se requiere llenar el campo.', classes: 'red rounded'});</script>";
                    echo "pen";
             }else{
                    echo "<script>M.toast({html: 'Preparado creado Existosamente', classes: 'green rounded'});</script>";
                    echo "de";
             }
        }
    	include("footer.html");
    	
    }

    else{
        header("location:../proy/index.php");
    }
?>