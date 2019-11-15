<?php  
	include_once("header.html");
    require_once("util.php");
    
    if(isset($_POST["nombreMenu"])){
    	if($_POST["nombreMenu"] == "") {
            header("location:agregaMenu.php");
        } else {
            crearMenu($_POST["nombreMenu"]);
            header("location:registroExitoso.php");
        }          
    }
    else{
        include_once("AgregaMenu.html");
    }
    include_once("footer.html");
?>