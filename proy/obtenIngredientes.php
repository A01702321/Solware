<?php
require_once("util.php");
$pattern=strtolower($_GET['pattern']);
$indice1 = $_GET['indice'];
$nombre = "ingrediente".$indice1;
$words=array();
$result=obtenerIngredient();
$datos=array();
$mensaje = '<table id="tablaIngredientes">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Ingrediente</th>
                </tr>
            </thead>
            <tbody>';

$size=0;

for($i=0; $i<count($result); $i++){
        $id=$result[$i][0];
        $menu=$result[$i][1];

   $pos=stripos(strtolower($menu),$pattern);
   if(!($pos===false))
   {
     $size++;
      $mensaje.="<tr>
                <td><p>
                        <label>
                        <input name='$nombre' type='radio' value='$id' />
                        <span></span>
                        </label>
                    </p></td> 
                <td>".$menu.'</td>
                </tr>';
   }
}
$mensaje.='</tbody> </table>';
 
if($size>0){
    echo $mensaje;

}else{
  echo "No se encontro ningun resultado";
}
?>

