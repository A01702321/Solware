<?php
require_once("util.php");
$pattern=strtolower($_GET['pattern']);
$indice1 = $_GET['indice'];
$nombre = "cliente".$indice1;
$words=array();
$result=obtenerClient();
$datos=array();
$mensaje = '<table class="striped" id="tablaClientes">
            <thead>
                <tr>
                    <th>IDCliente</th>
                    <th>Nombre</th>
                    <th>Menu</th>
                    <th>Plan</th>
                    <td style="text-align: right;"><a onclick="showDeleteBtns()" id ="erase" class="btn-floating btn-medium waves-effect waves-light grey"><i class="material-icons">delete_outline</i></a></td>

                </tr>
            </thead>
            <tbody>';

$size=0;

$bd = connectDB();

for($i=0; $i<count($result); $i++){
        $id=$result[$i][0];
        $cliente=$result[$i][1];
        $nomMenu=$result[$i][2];
          $sql = "SELECT NombreMenu FROM Menus Where IDMenu = '$nomMenu'";
          $menus = mysqli_query($bd, $sql);
          $menu = mysqli_fetch_assoc($menus);

          $sql = "SELECT NombreTiempo FROM Plan WHERE IDCliente = '$id'";  
          $tiempos = $bd->query($sql);
          $tmp=array();

         if(($tiempos->num_rows) > 0){
          while($row = mysqli_fetch_array($tiempos,MYSQLI_BOTH)){
            array_push($tmp,array($row["NombreTiempo"]));
          } 

          $numrows = $tiempos->num_rows;
          if($numrows == 1){
            $tmp[1][0] = "";
            $tmp[2][0] = "";
          }
          else if($numrows == 2){
            $tmp[2][0] = "";
          }

   $pos=stripos(strtolower($cliente),$pattern);
   if(!($pos===false))
   {
      $size++;
      $mensaje.="<tr>
                  <td>".$id."</td> 
                  <td>".$cliente."</td> 
                  <td>".$menu["NombreMenu"]."</td>
                  <td>".$tmp[0][0] .'<br>'. $tmp[1][0] .'<br>'. $tmp[2][0]."</td>
                  <td style='text-align: right;     padding: 0px 0px; '><a onclick='showDeleteModalCliente(".$id.", &quot;".$cliente."&quot; )' href='#removeModalCliente' id='".$id."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>
                 </tr>";
    }

      //$seleccionados=$id;
      //echo $id;
   }
}

closeDB($bd);

$mensaje.='</tbody> </table>';
 
if($size>0){
    echo $mensaje;

}else{
  echo "No se encontro ningun resultado";
}







?>