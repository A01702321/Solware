<?php


require_once("util.php");


$name = $_POST['name'];
$ingredients = $_POST['ingredients'];



$res = validateNullFormPrep($name,$ingredients);
if($res == 5) {
	echo("Validated");
	crearPreparadoIngrediete($name, $ingredients);
} else {
	echo $res;
	
}
	

?>