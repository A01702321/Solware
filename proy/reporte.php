<?php
	session_start();

    require_once "util.php";

    if(isset($_SESSION["User"])){

        include_once("header.html");
        include_once("Reporte.html");
        include_once("footer.html");
    } else {
        header("location:../index.php");
    }


?>