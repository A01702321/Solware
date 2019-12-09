<?php
require_once("util.php");
if(isset($_GET['pattern'])){
  $pattern=strtolower($_GET['pattern']);
}
else{
  $pattern = "";
}
$indice1 = $_GET['indice'];
$nombre = "preparado".$indice1;
$words=array();
$result=obtenerPrep($pattern);
$datos=array();
$mensaje = '<table class="striped" id="tablaPreparados">
            <thead>
                <tr>
                    <th>IDPreparado</th>
                    <th>Nombre</th>
                    <th>Ingredientes</th>
                    <td style="text-align: right;"><a onclick="showDeleteBtns()" id ="erase" class="btn-floating btn-medium waves-effect waves-light grey"><i class="material-icons">delete_outline</i></a></td>

                </tr>
            </thead>
            <tbody>';

$size=0;

$bd = connectDB();

for($i=0; $i<count($result); $i++){
        $id=$result[$i][0];
        $preparado=$result[$i][1];

          $sql = "SELECT NombreIngrediente FROM IngredientePreparado as IP, Ingredientes as I WHERE IP.IDPreparado = '$id' AND IP.IDIngrediente = I.IDIngrediente";  
          $ingredientes = $bd->query($sql);
          $ings=array();

         if(($ingredientes->num_rows) > 0){
          while($row = mysqli_fetch_array($ingredientes,MYSQLI_BOTH)){
            array_push($ings,array($row["NombreIngrediente"]));
          } 

          $numrows = $ingredientes->num_rows;
          for($j=$numrows;$j<10;$j++){
            $ings[$j][0] = "";
          }

          //<td>".$ings[0][0] .'<br>'. $ings[1][0] .'<br>'. $ings[2][0].'<br>'. $ings[3][0].'<br>'. $ings[4][0].'<br>'. $ings[5][0].'<br>'. $ings[6][0].'<br>'. $ings[7][0].'<br>'. $ings[8][0].'<br>'. $ings[9][0]."</td>

      $size++;
      $mensaje.="<tr>
                  <td>".$id."</td> 
                  <td>".$preparado."</td> 
                  <td>".$ings[0][0] .'<br>'. $ings[1][0] .'<br>'. $ings[2][0].'<br>'. $ings[3][0].'<br>'. $ings[4][0].'<br>'. $ings[5][0].'<br>'. $ings[6][0].'<br>'. $ings[7][0].'<br>'. $ings[8][0].'<br>'. $ings[9][0]."</td>
                  <td style='text-align: right;     padding: 0px 0px; '><a onclick='showDeleteModalPreparado(".$id.", &quot;".$preparado."&quot;)' href='#removeModalPreparado' id='".$id."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>
                 </tr>";

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