<?php

session_start();
include("util.php");

$pwd = $_POST["Contraseña"];
$user = $_POST["User"];

if($pwd == getQuery($user)){
    $_SESSION["User"] = $user;
	header("location:../menu.php");
} else {
	echo "<script> 
            alert('El usuario o contraseña son incorrectos'); 
            window.location.href='index.php'; 
          </script>";
}

function getQuery($user) {
    $bd = connectDB();
    //$sql = "SELECT Contraseña FROM Usuarios WHERE NombreUsuario='$user'";
    $reg = mysqli_query( $bd , "SELECT Contraseña FROM Usuarios WHERE NombreUsuario='$user'");
    $row = mysqli_fetch_assoc($reg);

    return $row["Contraseña"];
}

?>
