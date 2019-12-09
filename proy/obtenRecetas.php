<?php
require_once("util.php");
if(isset($_GET['pattern'])){
  $pattern=strtolower($_GET['pattern']);
}
else{
  $pattern = "";
}
$indice1 = $_GET['indice'];
$nombre = "receta".$indice1;
$words=array();
$result=obtenerRecetas($pattern);
$datos=array();
$mensaje = '<table class="striped" id="tablaRecetas">
            <thead>
                <tr>
                    <th>IDReceta</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <td style="text-align: right;"><a onclick="showDeleteBtns()" id ="erase" class="btn-floating btn-medium waves-effect waves-light grey"><i class="material-icons">delete_outline</i></a></td>

                </tr>
            </thead>
            <tbody>';

$size=0;

$bd = connectDB();

for($i=0; $i<count($result); $i++){
        $id=$result[$i][0];
        $receta=$result[$i][1];
        $desc=$result[$i][2];
        
      $size++;
      $mensaje.="<tr>
                  <td>".$id."</td> 
                  <td>".$receta."</td> 
                  <td>".$desc."</td>
                  <td style='text-align: right;     padding: 0px 0px; '><a onclick='showDeleteModalReceta(".$id.", &quot;".$receta."&quot; )' href='#removeModalReceta' id='".$id."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>
                 </tr>";
      //$seleccionados=$id;
      //echo $id;
   }

closeDB($bd);

$mensaje.='</tbody> </table>';
 
if($size>0){
    echo $mensaje;

}else{
  echo "No se encontro ningun resultado";
}







?>