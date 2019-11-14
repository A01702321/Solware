<?php
	if (session_status() == PHP_SESSION_NONE) {
    $SESSION = session_start();
	}
	if($SESSION["Habeats"]['id_Usuario']!= null){
		redirect("menu.php");
	}
	else{
	require_once "util.php";
	include("index.html");
	}
	
?>