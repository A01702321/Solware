<?php
require_once("util.php");
$pattern=strtolower($_GET['pattern']);
$indice1 = $_GET['indice'];
$nombre = "ingrediente".$indice1;
$words=array();
$result=obtenerIngredient();
$datos=array();
$mensaje = '<table id="tablaIngredientes" vertical-align="top" style="width:100%; overflow-y:scroll; display:block; position:relative;height: 200px;" >
            <thead>
                <tr>
                    <th>Ingrediente</th>
                    <th>Agregar</th>
                </tr>
            </thead>
            <tbody>';

$size=0;

for($i=0; $i<count($result); $i++){
        $id=$result[$i][0];
        $ingrediente=$result[$i][1];

   $pos=stripos(strtolower($ingrediente),$pattern);
   if(!($pos===false))
   {
      $size++;
      $mensaje.="<tr>
                  <td>".$ingrediente."</td>
                  <td>
                  <a onclick='agregarRestriccion(&quot;". $ingrediente . "&quot; , ".$id.")' class='btn-floating btn-small waves-effect waves-light'><i class='material-icons'>add</i></a>
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