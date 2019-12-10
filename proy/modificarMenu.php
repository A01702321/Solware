<?php
	session_start();

	require_once "util.php";

	if(isset($_SESSION["User"])){
		include("header.html");
		include("ModificarMenu.html");

		require_once "util.php";
		require_once "TablasMenus.php";

		tablaMenusMod();


		include("footer.html");
	}

	else{
		header("location:../index.php");
	}
?>