<?php
   
   session_start();

    require_once "util.php";

    if(isset($_SESSION["User"])){

        include_once("header.html");
        include_once("AgregaCliente.html");
        include_once("footer.html");
    } else {
        header("location:../proy/index.php");
    }

/*
        if(!existe("Clientes","Nombre", $nombre, true)){
            if(!crearCliente($nombre,$menu)){
                $id=ultimoCliente();
            echo ($_POST["valorRestricciones"]);
                for($i = 0; $i < count($_POST["tiempomenu"]); $i++)
                {
                    $tipo = $_POST["tiempomenu"][$i];
                    agregarPlanACliente($id,$tipo);
                }
                if(isset($_POST["valorRestricciones"])){
                    for($i = 1; $i <= $restricciones;$i++){
                        $tipo = $restricciones[$i];

                        
                        echo($tipo);
                        echo($id);
                        agregarRestriccionACliente($id,$tipo);
                        
                    }
                }
                header("location:registroExitoso.php");
            } else {
                include_once("header.html");
                echo("Hubo un error al registrar el cliente");
                include_once("AgregaCliente.html");
            }
        } else {
            include_once("header.html");
            echo("Existe ya un cliente con los datos introducidos");
            include_once("AgregaCliente.html");
        } 
    } else {
        include_once("header.html");
        include_once("AgregaCliente.html");
    }
    include_once("footer.html");
    }

    else{
        header("location:../proy/index.php");
    }
*/


?>