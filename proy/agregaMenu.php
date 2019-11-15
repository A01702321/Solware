<?php
	include("header.html");
	include("AgregaMenu.html");
	include("footer.html");
?>


<?php  
	include_once("header.html");
    require_once("util.php");
    
    if(isset($_POST["nombreMenu"])){

       
        crearMenu($_POST["nombreMenu"]);
        header("location:menu.php");
                   
    }
    else{
        include_once("AgregaMenu.html");
    }
    include_once("footer.html");

?>