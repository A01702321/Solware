<?php
	include("header.html");
	require_once "util.php";
	include("AgregaIngPrep.html");
	include("footer.html");
	

	function AgIngredienteNom($name, $grupo,$categoria){
		$link = connectDB();
		alert("im here");
		ingredienteNom($name, $grupo, $categoria);
	};





?>

