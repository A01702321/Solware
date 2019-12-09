<?php
require_once("util.php");
$pattern=strtolower($_GET['pattern']);
$indice1 = $_GET['indice'];
$nombre = "receta".$indice1;
$words=array();
$result=obtenerReceta();
$datos=array();
$mensaje = '<table id="tablaRecetas">
            <thead>
                <tr>
                    <th>Receta</th>
                    <th>Agregar</th>
                </tr>
            </thead>
            <tbody>';

$size=0;

for($i=0; $i<count($result); $i++){
        $id=$result[$i][0];
        $receta=$result[$i][1];

   $pos=stripos(strtolower($receta),$pattern);
   if(!($pos===false))
   {
      $size++;
      $mensaje.="<tr>
                  <td>".$receta.'</td>
                  <td>
                  <a onclick="agregarRestriccionP(\''. $receta . '\')" class="btn-floating btn-small waves-effect waves-light"><i class="material-icons">add</i></a>
                  </td> 
                </tr>';

      $seleccionados=$id;
      echo $id;
   }
}
$mensaje.='</tbody> </table>';
 
if($size>0){
    echo $mensaje;

}else{
  echo "No se encontro ningun resultado";
}







?>