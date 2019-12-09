$('.tabs').tabs();

$('select').formSelect();
$('.modal').modal();

var her = 0;

function logout(){
  if(confirm("¿Quieres cerrar sesión?")){
    window.location = "index.html";
  } 
}

function login(form){
  let usr = document.getElementById("user").value;
  let pswrd = document.getElementById("pswrd").value;
  
  if (usr == "user" && pswrd == "1234") {
    form.action = "menu.html";
  }else
    alert("Usuario o contraseña incorrectos");
}

function addInp(){
  let nInput = document.createElement("input");
  let f = document.getElementById("addForm");
  nInput.id = "addB"+her;
  nInput.type = "text";
  her++;
  //alert(nInput.id);

  f.appendChild(document.createElement('br'));
  f.appendChild(nInput);
}
//Funcion para toggle de delete buttons
function showDeleteBtns() {
  
  
  var list = document.getElementsByClassName("right  waves-effect waves-red btn-flat red-text");

  for (let x of list) {
    

    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }   
}
//funcion para llenado de modal con parametros individuales y linkeo de funcion elimIng
function showDeleteModal(x, ing) {

  document.getElementById('ingAEliminar').setAttribute('value',x);
  document.getElementById('ingAEliminar').innerText = "Ingrediente a eliminar: " + ing;
  document.getElementById('confirmarEliminarIng').setAttribute('onclick','elimIng('+x+')');
}

function showModifyModal(name, id, idg, grupo, categorias) {
  var instance =M.Modal.getInstance(document.getElementById('modifyModal'));
  instance.open();
  document.getElementById("afterScr").style.display = "none";
  document.getElementById("beforeScr").style.display = "none";
  document.getElementById("grupoHelper").style.display = 'none';
  document.getElementById("nombreIng").className = "";
  var elems = document.getElementsByClassName('catego');
  document.getElementsByClassName("select-dropdown dropdown-trigger")[0].setAttribute('style',"border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #9e9e9e");
  let len = elems.length;
  
  for (i=0;i<len;i++){
    
    elems[0].outerHTML = "";
  }
  
  document.getElementById('nombreIng').setAttribute('value',name);
  M.updateTextFields();
  document.getElementById('opt'+idg).setAttribute('selected',true);
  
  o=0;
  if(categorias.length>0){
    
    for (x=0; x<categorias.length;x++){
      
      document.getElementById('afterthis').insertAdjacentHTML("afterend", '<tr class="catego" style="border:none;" id="rowC'+o+'"><td><div class="input-field col s10" ><input type="text" name="cat'+o+'" id="cat'+o+'"><label for="validate-ingrediente">Categoria</label></div><div class="col s2"><br><a id="'+o+'" class="right btn-floating btn-medium btn-danger btn_removeC waves-effect waves-light red"><i class="material-icons center">remove</i></a></div></td></tr>');
      document.getElementById('cat' + x).setAttribute('value',categorias[x]);
      document.getElementById('cat' + x).focus();
      o+=1;
    }
  }
  M.updateTextFields();
  document.getElementById('modifyIngButt').setAttribute('onclick','modifyIng('+id+')');
  
  var scr = document.getElementById("scrollable");
  
  if (scr.scrollHeight > 400){
    document.getElementById("afterScr").style.display = "block";
  }
  
}

function showDeleteModalMenu(x, menu) {

document.getElementById('MenuAEliminar').setAttribute('value',x);
document.getElementById('MenuAEliminar').innerText = "Menu a eliminar: " + menu;
document.getElementById('confirmarEliminarMenu').setAttribute('onclick','elimMenu('+x+')');
}

function showModifyModalMenu(x, menu) {

document.getElementById('MenuAModificar').setAttribute('value',x);
document.getElementById('MenuAModificar').innerText = "Menu a modificar: " + menu;
document.getElementById('menuModInput').setAttribute('value',menu);
var variable = document.getElementById('menuModInput');
document.getElementById('confirmarModificarMenu').setAttribute('onclick','modMenu('+x+')');
//document.getElementById('cancelarModificarMenu').setAttribute('onclick',document.getElementById('menuModInput').setAttribute('value',menu));
}

function showDeleteModalCliente(x, cliente) {

document.getElementById('ClienteAEliminar').setAttribute('value',x);
document.getElementById('ClienteAEliminar').innerText = "Cliente a eliminar: " + cliente;
document.getElementById('confirmarEliminarCliente').setAttribute('onclick','elimCliente('+x+')');
}


function elimIng(x){
  url = "eliminarIng.php";
  var posting = $.post( url, { id: x});
  posting.done(function( data ) {
        
        if (data== 1){
        M.toast({html: 'Ingrediente eliminado exitosamente', classes: 'green rounded'});
        document.getElementById('showIngredientes').click();
        }
        if (data== 2){
        M.toast({html: 'No se pudo eliminar ingrediente por favor intenta de nuevo mas tarde', classes: 'grey rounded'});
        
                }
  });

}


function elimCliente(x){
  url = "eliminarCliente.php";
  var posting = $.post( url, { id: x});
  posting.done(function( data ) {
        
        if (data== 1){
        M.toast({html: 'Cliente eliminado exitosamente', classes: 'green rounded'});
        document.getElementById('showClientes').click();
        }
        if (data== 2){
        M.toast({html: 'No se pudo eliminar cliente por favor intenta de nuevo mas tarde', classes: 'red rounded'});
        document.getElementById('showClientes').click();
                }
  });

}

function elimMenu(x){
  url = "eliminarMenu.php";
  var posting = $.post( url, { id: x});
  posting.done(function( data ) {
        
        if (data== 1){
        M.toast({html: 'Menu eliminado exitosamente', classes: 'green rounded'});
        document.location = 'menu.php';
        }
        if (data== 2){
        M.toast({html: 'No se pudo eliminar menu por favor intenta de nuevo mas tarde', classes: 'red rounded'});
                }
        if (data== 3){
        M.toast({html: 'No se pudo eliminar Menú. Asegurate de no tener clientes con ese menú.', classes: 'orange rounded'});                }
  });

}


/* AC*/

function agregarRestriccion(ingrediente, id)
{

  var resultados = document.getElementById("resultados");

  resultados.innerHTML += "<tr class='idTablaAux' id='ing" + id + "'><td style='width:80%'>" + ingrediente.toString() + "</td>" + '<td><a onclick="eliminarIngrediente(\'' +  id + '\')" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a></td></tr>';


  var resultadosHidden = document.getElementById("resultadosHidden");
  resultadosHidden.innerHTML += "<input type='hidden' value='" + ingrediente.toString() + "' name='restricciones[]' id='" + ingrediente.toString() + "'/>";

}
function agregarRestriccionR(receta, id)
{
  var resultados = document.getElementById("resultadosR");
  resultados.innerHTML += "<tr class='idTablaAuxR' id='rec" + id + "'><td style='width:80%'>" + receta.toString() + "</td>" + '<td><a onclick="eliminarReceta(\'' +  id + '\')" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a></td></tr>';

  var resultadosHidden = document.getElementById("resultadosHiddenR");
  resultadosHidden.innerHTML += "<input type='hidden' value='" + receta.toString() + "' name='restriccionesR[]' id='" + receta.toString() + "'/>";

}
function agregarRestriccionP(preparado, id)
{
  var resultados = document.getElementById("resultadosP");
  resultados.innerHTML += "<tr class='idTablaAuxP' id='prep" + id + "'><td style='width:80%'>" + preparado.toString() + "</td>" + '<td><a onclick="eliminarPreparado(\'' +  id + '\')" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a></td></tr>';

  var resultadosHidden = document.getElementById("resultadosHiddenP");
  resultadosHidden.innerHTML += "<input type='hidden' value='" + preparado.toString() + "' name='restriccionesP[]' id='" + preparado.toString() + "'/>";

}

function eliminarIngrediente(id)
{
  var ingredienteDOM = document.getElementById("ing"+ id);
  ingredienteDOM.parentNode.removeChild(ingredienteDOM); 


  /*var ingredienteTabla = document.getElementById(ingrediente.toString());
  ingredienteTabla.parentNode.removeChild(ingredienteTabla);*/

  //var ingredienteTabla = document.getElementById("ing"+ id);
  //ingredienteTabla.parentNode.removeChild(ingredienteTabla);

}
function eliminarReceta(id)
{
  var recetaDOM = document.getElementById("rec"+id );
  recetaDOM.parentNode.removeChild(recetaDOM); 

  //var recetaTabla = document.getElementById("rec"+id );
  //recetaTabla.parentNode.removeChild(recetaTabla);

}

function eliminarPreparado(id)
{
  var preparadoDOM = document.getElementById("prep"+ id);
  preparadoDOM.parentNode.removeChild(preparadoDOM); 

  //var preparadoTabla = document.getElementById("prep"+ id);
  //preparadoTabla.parentNode.removeChild(preparadoTabla);


}

/*AC*/



function ObtenerIDtablaAux(){
  var tablaAux = document.getElementsByClassName("idTablaAux");
  var ids = [];
  var t = false;
  let len = tablaAux.length;

  for (x=0; x<len; x++){
    t = true;
    ids.push(+(tablaAux[x].id.substring(3)));
  }
  
  if(t)return ids;
  else return [""];
  alert(ids);
}
function ObtenerIDtablaAuxP(){
  var tablaAux = document.getElementsByClassName("idTablaAuxP");
  var ids = [];
  var t = false;
  let len = tablaAux.length;

  for (x=0; x<len; x++){
    t = true;
    ids.push(+(tablaAux[x].id.substring(4)));
  }
  
  if(t)return ids;
  else return [""];
  alert(ids);
}
function ObtenerIDtablaAuxR(){
  var tablaAux = document.getElementsByClassName("idTablaAuxR");
  var ids = [];
  var t = false;
  let len = tablaAux.length;

  for (x=0; x<len; x++){
    t = true;
    ids.push(+(tablaAux[x].id.substring(3)));
  }
  
  if(t)return ids;
  else return [""];
  alert(ids);
}

function agregarClienteConRestricciones() {
  url = "agregaClienteControlador.php";
  var tablaIDs = ObtenerIDtablaAux();
  var firstname = $("#first_name").val();
  var tiempos = [""];
  if(document.getElementById("tiempomenu0").checked){
    tiempos.push(document.getElementById("tiempomenu0").value);
  } 

  if(document.getElementById("tiempomenu1").checked){
    tiempos.push(document.getElementById("tiempomenu1").value);
  } 

  if(document.getElementById("tiempomenu2").checked){
    tiempos.push(document.getElementById("tiempomenu2").value);
  } 
  var nombreM = $("#nombremenu").val();

  var posting = $.post(url, {menu : nombreM, name: firstname, tiempomenu: tiempos, ids: tablaIDs});


  posting.done(function (data){
    
  });


}

function agregarPlatillo() {
  url = "agregaPlatilloControlador.php";
  var tablaIDsIng = ObtenerIDtablaAux();
  var tablaIDsPrep = ObtenerIDtablaAuxP();
  var tablaIDsRec = ObtenerIDtablaAuxR();
  var name = $("#platillo_name").val();
  var tiempoP = $("#tiempo").val();
  var nombreM = $("#menu").val();
  var descripcion = $("#menu").val();
 

  var posting = $.post(url, {menu : nombreM, name: firstname, tiempo: tiempoP, idsI: tablaIDsIng, idsP: tablaIDsPrep,idsR: tablaIDsRec});


  posting.done(function (data){
     if(data === 1){
        M.toast({html: 'Platillo creado exitosamente', classes: 'green rounded'});
    }
  });


}




function validateIngForm(name, group, categories){
        var forbidden = ';';
        var hasNumber = /\d/;
        var passed1 = true;
        passed = true;

        document.getElementById("grupoHelper").style.display = 'none';
        if(name === ''){
          M.toast({html: 'Por favor introduce un nombre de ingrediente correcto', classes: 'red rounded'});
          document.getElementById("nombreIng").className = "invalid";
          document.getElementById("nombreIng").focus();
          passed1 = false;
        }
        if(hasNumber.test(name)){
          M.toast({html: 'El nombre de ingrediente no puede incluir números', classes: 'red rounded'});
          document.getElementById("nombreIng").className = "invalid";
          document.getElementById("nombreIng").focus();
          passed1 = false;
        }
        
        if(passed1){document.getElementById("nombreIng").className = "valid";}

        if(name.includes(';')){
           M.toast({html: 'El nombre de ingrediente no puede incluir ";"', classes: 'red rounded'});
           document.getElementById("nombreIng").className = "invalid";
          document.getElementById("nombreIng").focus();
          passed = false;
        }
        else passed=true;
        if(group === '' ){
          M.toast({html: 'Por favor selecciona un grupo alimenticio válido', classes: 'red rounded'});

          document.getElementsByClassName("select-dropdown dropdown-trigger")[0].setAttribute('style',"border-bottom-width: 1.5px;border-bottom-style: solid;border-bottom-color: red");
          document.getElementById("grupoHelper").style.display = 'block';
          document.getElementById("grupoHelper").focus();
          
          passed =  false;
        }

        if(passed)document.getElementsByClassName("select-dropdown dropdown-trigger")[0].setAttribute('style',"border-bottom-width: 1.5px;border-bottom-style: solid;border-bottom-color: #4CAF50");

        
        for(i=0; i<categories.length; i++){
          try{
            var cat = categories[i];
            if(cat.includes(';')){
              M.toast({html: 'Las categorías no pueden incluir ";"', classes: 'red rounded'});
              passed =  false;
              }
            if(hasNumber.test(cat)){
                 M.toast({html: 'Las categorías no pueden incluir números', classes: 'red rounded'});
                 passed =  false;
              }
          }
          catch{

          }
                      
        }
        
        
        return passed & passed1;
}

function scrolled(){
  var scr = document.getElementById("scrollable");
  
  if(scr.scrollTop === 0){
    document.getElementById("beforeScr").style.display = "none";
    
  }
  else { 
    document.getElementById("beforeScr").style.display = "block";
  }
  if (scr.scrollTop === scr.scrollHeight - 400){
    document.getElementById("afterScr").style.display = "none";
  }
  else { 
    document.getElementById("afterScr").style.display = "block";
  }
  
  
}
function scrolledSmall(){
  var scr = document.getElementById("scrolledR");
  
  if(scr.scrollTop === 0){
    document.getElementById("beforeScr").style.display = "none";
    
  }
  else { 
    document.getElementById("beforeScr").style.display = "block";
  }
  if (scr.scrollTop === scr.scrollHeight - 200){
    document.getElementById("afterScr").style.display = "none";
  }
  else { 
    document.getElementById("afterScr").style.display = "block";
  }
  
  
}

function modifyIng(y){



      url = "modificarIng.php";
      let categories = [''];
      var p = getMax();
      for (x = 0; x<=p; x++){
          if($('#cat' + x).val() !== ""){
          
          categories.push($('#cat' + x).val());}
      };
      
      if(!validateIngForm($('#nombreIng').val(), $('#grupo').val(), categories)){
        
        console.info("form wasn't valid");
        return 0;
      }

      var posting = $.post( url, { name: $('#nombreIng').val(), grupo: $('#grupo').val(), categorias: categories, id: y} );
      /* Send the data using post with element id name and name2*/
        
      /* Alerts the results */
      posting.done(function( data ) {
        
        if (data== 11){
        M.toast({html: 'Por favor introduce un nombre de ingrediente correcto', classes: 'red rounded'});
        
        }
        else if (data== 14){
        M.toast({html: 'El nombre de ingrediente no puede incluir números', classes: 'red rounded'});
        
        }
        else if (data== 31){
        M.toast({html: 'Las categorías no pueden incluir números', classes: 'red rounded'});
        
        }
        else if (data== 30){
        M.toast({html: 'Las categorías no pueden incluir ";"', classes: 'red rounded'});
        
        }
        else if (data== 12){
        M.toast({html: 'El nombre de ingrediente no puede incluir ";"', classes: 'red rounded'});
        
        }
        else if (data== 21){
        M.toast({html: 'Por favor selecciona un grupo alimenticio válido', classes: 'red rounded'});
                }
        
        else if (data== 4){
        M.toast({html: 'Por favor verifica que todos los campos estén correctos', classes: 'red rounded'});
        

        }
        
        else if(data == 6){
          
          M.toast({html: 'Ingrediente modificado exitosamente', classes: 'green rounded'});
          var form = document.getElementById("agregar_ingrediente");
          form.reset();
          
          var instance =M.Modal.getInstance(document.getElementById('modifyModal'));
          instance.close();
          document.getElementById('showIngredientes').click();

        }
        else{
          M.toast({html: 'Error insertando a la base de datos por favor verifica los datos', classes: 'red rounded'});
        }
      });
}



function elimPreparado(x){
  url = "eliminarPreparado.php";
  var posting = $.post( url, { id: x});
  posting.done(function( data ) {
        
        if (data== 1){
        M.toast({html: 'Preparado eliminado exitosamente', classes: 'green rounded'});
        document.getElementById("showPreparados").click();
        }
        if (data== 2){
          M.toast({html: 'No se pudo eliminar menu por favor intenta de nuevo mas tarde', classes: 'red rounded'});
        }
  });


}


function modMenu(x, menu){
  url = "modificaMenu.php";
  var form = document.getElementById('menuModInput');

  var nomMenu = form.getAttribute('value');
  var nombre = form.value;
  var posting = $.post( url, { id: x , nomMenu: nombre});
  posting.done(function( data ) {
        
        if (data== 1){
        M.toast({html: 'Menu modificado exitosamente', classes: 'green rounded'});
        document.location = 'menu.php';
        }
        if (data== 2){
        M.toast({html: 'No se pudo modificar menu por favor intenta de nuevo mas tarde', classes: 'grey rounded'});
                }
  });

}

function remInp(){
  if (her === 0) {
    her = 0;
  }else
    her--;

  let idH = "addB"+her;
  //alert(idH);
  let element = document.getElementById(idH);
    element.parentNode.removeChild(element);

    
}
function getMax(){
  var list = document.getElementsByClassName("right btn-floating btn-medium btn-danger btn_removeC waves-effect waves-light red");
  var o = 0;
  if(list.length > 0){
    
    for (let x of list) {
      
      if(x.id > o){
        o = x.id;
        
      }
    }
  }
  return o;
}

/js para consultar/

function consultData(evt, consult) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(consult).style.display = "block";
  evt.currentTarget.className += " active";
}

$(document).ready(function(){  


    
    

    var i=1;  
    $('#add').click(function(){  
        i++;  
        $('#dynamic_field').append('<tr id="row'+i+'"><td><div class="input-field col s7"><input type="text" name="ing'+i+'" id="ing'+i+'" class="validate" data-error="wrong" required><label for="validate-ingrediente">Ingrediente</label><span class="helper-text" data-error="Por favor introduce un nombre de ingrediente." data-success=""></span></div><div vertical-align: middle id=""><br><button type="button" name="remove" id="'+i+'" class="btn-small btn-danger btn_remove red">X</button></div></td></tr>');  
    });  
    
    $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
        i--;

        document.getElementById("afterScr").style.display = "none";
    }); 
      
    var o=1;
    
    $('#addCat').click(function(){  
        
        let o = +getMax();
        o += 1;

        $('#dynamic_field2').append('<tr class="catego" style="border:none;" id="rowC'+o+'"><td><div class="input-field col s10" ><input type="text" name="cat'+o+'" id="cat'+o+'" class="validate" data-error="wrong" ><label for="validate-ingrediente">Categoria</label><span class="helper-text" data-error="Por favor introduce un nombre de categoría." data-success=""></span></div><div class="col s2"><br><a id="'+o+'" class="right btn-floating btn-medium btn-danger btn_removeC waves-effect waves-light red"><i class="material-icons center">remove</i></a></div></td></tr>'); 

        document.getElementById("afterScr").style.display = "block";
        

    });

    var j=1;
    
    $('#anadirRestricciones').click(function(){  
        j++;  
       //$('#restricciones').append('<tr id="rowC'+j+'"><td><div class="input-field col s5"><input type="text" name="rest'+j+'" id="rest'+j+'" onkeyup="obtenIngrediente('+j+')" class="validate" required><label for="validate-ingrediente">Ingrediente</label></div><div vertical-align: middle id=""><br><button type="button" name="remove" id="'+j+'" class="btn-small btn-danger btn_removeC red">X</button></div></td></tr> <br> <div id="resultado'+j+'"></div>');  
       $('#restricciones').append('<tr id="rowC'+j+'"><td><div class="input-field col s10"><input type="text" name="rest'+j+'" id="rest'+j+'" onkeyup="obtenIngrediente('+j+')" class="validate"><label for="validate-ingrediente">Introduce el nombre...</label> <br> <div id="resultado'+j+'"></div> </div> <div vertical-align: middle id=""><br><button type="button" name="remove" id="'+j+'" class="btn-small btn-danger btn_removeC red">X</button></div> </td></tr>');  
    });

    $(document).on('click', '.btn_removeC', function(){  
        var button_id = $(this).attr("id");   
        var scr = document.getElementById("scrollable");
        $('#rowC'+button_id+'').remove();  
        document.getElementById("afterScr").style.display = "none";
        document.getElementById("beforeScr").style.display = "none";
        
    }); 

    

    $(document).on('click', '#submit', function(){ 
       let DEBUG = 1;
         
        event.preventDefault();
          
        if (DEBUG) console.info('llamada asíncrona a PreparadoNom');

        /* get the action attribute from the <form action=""> element */
        url = "preparadoNom.php";
        let ingredients = [];

        for (x = 1; x<=i; x++){
          
            ingredients.push($('#ing' + x).val());
        }
        
      var posting = $.post( url, { name: $('#nombreprep').val(),ingredients: ingredients} );
      /* Send the data using post with element id name and name2*/
        
      /* Alerts the results */
      posting.done(function( data ) {
        
        if (data== 1){
        alert('Por favor ingresa un nombre de preparado');
        }
        if (data== 2){
        alert('Por favor ingresa un ingrediente');
        }
        
        if (data== 4){
        alert('El ingrediente agregado no existe, por favor crea');
        }
        if(data == 5){
          alert('Función llamada correctamente');
        }
      });
    });


      

    $(document).on('click', '#submitIng', function(){ 

      let DEBUG = 1;
         
      event.preventDefault();
        
      if (DEBUG) console.info('llamada asíncrona a IngredienteNom');

      /* get the action attribute from the <form action=""> element */
      url = "IngredienteNom.php";
      let categories = [''];
      var p = getMax();
      for (x = 0; x<=p; x++){
        
          categories.push($('#cat' + x).val());
      };
      
      if(!validateIngForm($('#nombreIng').val(), $('#grupo').val(), categories)){
        
        console.info("form wasn't valid");
        return 0;
      }
      var posting = $.post( url, { name: $('#nombreIng').val(), grupo: $('#grupo').val(), categorias: categories} );
      /* Send the data using post with element id name and name2*/
        
      /* Alerts the results */
      posting.done(function( data ) {
        
        
        if (data== 11){
        M.toast({html: 'Por favor introduce un nombre de ingrediente correcto', classes: 'red rounded'});
        
        }
        if (data== 14){
        M.toast({html: 'El nombre de ingrediente no puede incluir números', classes: 'red rounded'});
        
        }
        if (data== 31){
        M.toast({html: 'Las categorías no pueden incluir números', classes: 'red rounded'});
        
        }
        if (data== 30){
        M.toast({html: 'Las categorías no pueden incluir ";"', classes: 'red rounded'});
        
        }
        if (data== 12){
        M.toast({html: 'El nombre de ingrediente no puede incluir ";"', classes: 'red rounded'});
        
        }
        else if (data== 21){
        M.toast({html: 'Por favor selecciona un grupo alimenticio válido', classes: 'red rounded'});
                }
        
        else if (data== 4){
        M.toast({html: 'Por favor verifica que todos los campos estén correctos', classes: 'red rounded'});
        

        }
        else if(data == 6){
          
          M.toast({html: 'Ingrediente creado exitosamente', classes: 'green rounded'});
          var form = document.getElementById("agregar_ingrediente");
          form.reset();
          var elems = document.getElementsByClassName('catego');
          let len = elems.length;
          document.getElementsByClassName("select-dropdown dropdown-trigger")[0].setAttribute('style',"border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #9e9e9e");
  
          for (i=0;i<len;i++){
            
            elems[0].outerHTML = "";
          }

        }
        else{
          M.toast({html: 'Error insertando a la base de datos por favor verifica los datos', classes: 'red rounded'});
        }
      });
    });

    




});




























