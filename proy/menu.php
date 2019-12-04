<?php
	session_start();

	require_once "util.php";

	if(isset($_SESSION["User"])){
	include("header.html");
	include("menu.html");

	require_once "TablasMenus.php";


	tablaMenus();


	include("footer.html");
	}

	else{
		header("location:../proy/index.php");
	}
?>