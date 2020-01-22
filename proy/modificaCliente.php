<?php
   
   session_start();
	
	$_POST['nomCliente'] = 'Max Burkle';

    require_once "util.php";

    if(isset($_SESSION["User"])){

        include_once("header.html");
        include_once("ModificaCliente.html");
        include_once("footer.html");
    } else {
        header("location:../index.php");
    }


?>