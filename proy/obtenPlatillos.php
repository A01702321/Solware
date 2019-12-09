<?php
require_once("util.php");
$pattern=strtolower($_GET['pattern']);
$indice1 = $_GET['indice'];
$nombre = "platillo".$indice1;
$words=array();
$result=obtenerPlatillo();
$datos=array();
$mensaje = '<table class="striped" id="tablaPlatillos">
            <thead>
                <tr>
                    <th>IDPlatillo</th>
                    <th>Nombre</th>
                    <th>Menu</th>
                    <th>Tiempo</th>
                    <th>Notas</th>
                    <td style="text-align: right;"><a onclick="showDeleteBtns()" id ="erase" class="btn-floating btn-medium waves-effect waves-light grey"><i class="material-icons">delete_outline</i></a></td>

                </tr>
            </thead>
            <tbody>';

$size=0;

$bd = connectDB();

for($i=0; $i<count($result); $i++){
        $id=$result[$i][0];
        $platillo=$result[$i][1];
        $menu=$result[$i][2];
        $tiempo=$result[$i][3];
        $notas=$result[$i][4];
          $sql = "SELECT NombreMenu FROM Menus Where IDMenu = '$menu'";
          $menus = mysqli_query($bd, $sql);
          $menu = mysqli_fetch_assoc($menus);

   $pos=stripos(strtolower($platillo),$pattern);
   if(!($pos===false))
   {
      $size++;
      $mensaje.="<tr>
                  <td>".$id."</td> 
                  <td>".$platillo."</td> 
                  <td>".$menu["NombreMenu"]."</td>
                  <td>".$tiempo."</td>
                  <td>".$notas."</td>
                  <td style='text-align: right;     padding: 0px 0px; '><a onclick='showDeleteModalPlatillo(".$id.", &quot;".$platillo."&quot; )' href='#removeModalPlatillo' id='".$id."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>
                 </tr>";
    }

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