<?php
	session_start();

	require_once "util.php";

	if(isset($_SESSION["User"])){
		include("header.html");
		include("Consultar.html");
		include("footer.html");
	}

	else{
		header("location:../proy/index.php");
	}
?>