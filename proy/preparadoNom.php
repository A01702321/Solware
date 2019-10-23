<?php
 	echo $_POST['nombre'];
    //Connection to MySQL
    $con = mysqli_connect('localhost', 'root', '');
 
    if(!$con) {
        die('Not Connected To Server');
    }
 
    //Connection to database
    if(!mysqli_select_db($con, 'clase')) {
        echo 'Database Not Selected';
    }
 	
    //Create variables
    $nombre = $_POST['nombre'];
    $sql = 'INSERT INTO Preparados (Nombre) VALUES ("hh")';
  	$result = mysqli_query($con, $sql);
    //Make sure name is valid
    
  
    //Response
    //Checking to see if name or email already exsist
    
   
 
    //Close connection
    mysqli_close($con);
 
?>