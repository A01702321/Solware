<?php
	session_start();

    require_once "util.php";

    if(isset($_SESSION["User"])){
		include("header.html");
		include("AgregaReceta.html");

		 if(isset($_POST["nombre_receta"])){
		 	if (empty($_POST["nombre_receta"]) || empty($_POST["nombremenu"])) {
		 	}
		 }

		include("footer.html");
	}

	else{
		header("location:../proy/index.php");
	}
?>