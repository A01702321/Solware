<?php
	session_start();

	require_once "util.php";

	if(isset($_SESSION["User"])){
		include("header.html");
		include("RegistroExitoso.html");
		include("footer.html");
	}

	else{
		header("location:../index.php");
	}
?>