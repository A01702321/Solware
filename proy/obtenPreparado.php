<?php
require_once("util.php");
$pattern=strtolower($_GET['pattern']);
$indice1 = $_GET['indice'];
$nombre = "preparado".$indice1;
$words=array();
$result=obtenerPreparado();
$datos=array();
$mensaje = '<table id="tablaPreparados" vertical-align="top" style="width:100%; overflow-y:scroll; display:block; position:relative;height: 200px;" >
            <thead>
                <tr>
                    <th>Preparado</th>
                    <th>Agregar</th>
                </tr>
            </thead>
            <tbody>';

$size=0;

for($i=0; $i<count($result); $i++){
        $id=$result[$i][0];
        $preparado=$result[$i][1];

   $pos=stripos(strtolower($preparado),$pattern);
   if(!($pos===false))
   {
      $size++;
      $mensaje.="<tr>
                  <td>".$preparado."</td>
                  <td>
                  <a onclick='agregarRestriccionP(&quot;". $preparado . "&quot; , ".$id.")' class='btn-floating btn-small waves-effect waves-light'><i class='material-icons'>add</i></a>
                  </td> 
                </tr>";

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