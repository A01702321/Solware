<?php
	session_start();
	$_SESSION["username"] = "";
	$_SESSION["psw"] = "";
	$logErr = "";
	
	include("index.html");

	if(isset($_POST["login"	]) && !empty($_POST["username"]) &&  !empty($_POST["psw"])){

		if ($_POST["username"] == "user" && $_POST["psw"] == '1234'){
			# code...
			header("Location: menu.html");
		}
		else {
			$logErr = "Usuario o contraseña incorrecto";
			echo "Usuario o contraseña incorrecto";
		}
	}

	include("footer.html");
?>