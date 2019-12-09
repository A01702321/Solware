<?php
require_once("util.php");
$pattern=strtolower($_GET['pattern']);
$indice1 = $_GET['indice'];
$nombre = "ingrediente".$indice1;
$words=array();
$result=obtenerIngredientes();
$datos=array();
$mensaje = '<table id="tablaIngredientes">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Grupo Alimenticio</th>
                  <th style="text-align: right;"><a onclick="showDeleteBtns()" id ="erase" class="right btn-floating btn-medium waves-effect waves-light grey"><i class="material-icons">delete_outline</i></a></th>
                </tr>
            </thead>
            <tbody>';

$size=0;


for($i=0; $i<count($result); $i++){
$bd = connectDB();
        $id=$result[$i][0];
        $ingrediente=$result[$i][1];
        $grupoAl=$result[$i][2];
          $sql = "SELECT NombreGrupoAl FROM GruposAlimenticios Where IDGrupoAl = '$grupoAl'";
          $grupos =  mysqli_fetch_assoc(mysqli_query($bd, $sql));
closeDB($bd);

           $grupo = getGrupos($grupoAl);
           $categorias = json_encode(getCategorias($id));


   $pos=stripos(strtolower($ingrediente),$pattern);
   if(!($pos===false))
   {
      $size++;
      $mensaje.="<tr>
                  <td>".$id."</td>
                  <td>".$ingrediente."</td>
                  <td>".$grupos["NombreGrupoAl"]."</td>
                  <td style='text-align: right;     padding: 0px 0px; width:10%; '><a onclick='showModifyModal(&quot;".$ingrediente."&quot;,".$id.",".$grupoAl.", &quot;".$grupo."&quot;, ".$categorias."  )' href='#modifyModal' id='".$id."' style='display: block;' class='right  waves-effect waves-grey btn-flat grey-text '><i class='material-icons'>create</i></a>
                    <a onclick='showDeleteModal(".$id.", &quot;".$ingrediente."&quot; )' href='#removeModal' id='".$id."' style='display: none;' class='right  waves-effect waves-red btn-flat red-text modal-trigger'><i class='material-icons'>remove_circle</i></a></td>
                </tr>";

      //$seleccionados=$id;
      //echo $id;
   }
}


$mensaje.='</tbody> </table>';
 
if($size>0){
    echo $mensaje;

}else{
  echo "No se encontro ningun resultado";
}







?>