<?php
require_once("util.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */



if(isset($_POST["nomMenu"])){
             if (empty($_POST["nomMenu"])) {
             	$rest = 3;
            }  
            else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*+[a-zA-ZáéíóúÁÉÍÓÚñÑ]*$/",$_POST["nomMenu"])) {
                $rest = 4;
            }else{
                $namep = preg_replace('/\s+/', ' ',$_POST["nomMenu"]);
                if(!existe("Menus","NombreMenu", $namep, true)){
					$id = $_POST['id'];
					$rest = modificaMenu($id,$namep);
                }else {
                	$rest = 5;
            } 
            }
        }

	echo $rest;

?>
