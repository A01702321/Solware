<?php
	require_once "util.php";


	if(isset($_GET['q']) && isset($_GET["p"])){
		if($_SERVER["REQUEST_METHOD"] == "GET" ){
			$menu = $_GET['q'];
			$tiempo = $_GET['p'];
			obtenerPlatillos($menu, $tiempo);
		}
	}
?>