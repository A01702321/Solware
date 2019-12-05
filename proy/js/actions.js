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


function showModifyModal(name, id, grupo, categorias) {

  var elems = document.getElementsByClassName('catego');
  let len = elems.length
  
  for (i=0;i<len;i++){
    
    elems[0].outerHTML = "";
  }
  
  document.getElementById('nombreIng').setAttribute('value',name);
  M.updateTextFields();

  

  document.getElementById('opt'+id).setAttribute('selected',true);
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

  
}






//función de llamado al controlador de borrado de ingredientes
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

function remInp(){
  if (her == 0) {
    her = 0;
  }else
    her--;

  let idH = "addB"+her;
  //alert(idH);
  let element = document.getElementById(idH);
    element.parentNode.removeChild(element);

    
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
    }); 
      
    var o=1;
    
    $('#addCat').click(function(){  
        o++;  
        $('#dynamic_field2').append('<tr class="catego" style="border:none;" id="rowC'+o+'"><td><div class="input-field col s10" ><input type="text" name="cat'+o+'" id="cat'+o+'" class="validate" data-error="wrong" ><label for="validate-ingrediente">Categoria</label><span class="helper-text" data-error="Por favor introduce un nombre de categoría." data-success=""></span></div><div class="col s2"><br><a id="'+o+'" class="right btn-floating btn-medium btn-danger btn_removeC waves-effect waves-light red"><i class="material-icons center">remove</i></a></div></td></tr>');  
    });

    var j=1;
    
    $('#anadirRestricciones').click(function(){  
        j++;  
       //$('#restricciones').append('<tr id="rowC'+j+'"><td><div class="input-field col s5"><input type="text" name="rest'+j+'" id="rest'+j+'" onkeyup="obtenIngrediente('+j+')" class="validate" required><label for="validate-ingrediente">Ingrediente</label></div><div vertical-align: middle id=""><br><button type="button" name="remove" id="'+j+'" class="btn-small btn-danger btn_removeC red">X</button></div></td></tr> <br> <div id="resultado'+j+'"></div>');  
       $('#restricciones').append('<tr id="rowC'+j+'"><td><div class="input-field col s8 offset-s1"><input type="text" name="rest'+j+'" id="rest'+j+'" onkeyup="obtenIngrediente('+j+')" class="validate"><label for="validate-ingrediente">Ingrediente</label> <br> <div id="resultado'+j+'"></div> </div> <div vertical-align: middle id=""><br><button type="button" name="remove" id="'+j+'" class="btn-small btn-danger btn_removeC red">X</button></div> </td></tr>');  
    });

    $(document).on('click', '.btn_removeC', function(){  
        var button_id = $(this).attr("id");   
        $('#rowC'+button_id+'').remove();  
        o--;
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
        };
        
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
	      	/*
		      for (x = 1; x<=o; x++){
		        if($('#nombreIng').val() == "" || $('#grupo').val() == "" || $('#cat' + x).val() == "" ){
		            alert("Por favor verifica los datos e intenta nuevamente");
		            return false;
		        }
		      }
		     */
	      
	    /* stop form from submitting normally */
	    event.preventDefault();
	      
	    if (DEBUG) console.info('llamada asíncrona a IngredienteNom');

	    /* get the action attribute from the <form action=""> element */
	    url = "IngredienteNom.php";
	    let categories = [];

	    for (x = 1; x<=o; x++){
	      
	        categories.push($('#cat' + x).val());
	    };
	    

	    var posting = $.post( url, { name: $('#nombreIng').val(), grupo: $('#grupo').val(), categorias: categories} );
	    /* Send the data using post with element id name and name2*/
	      
	    /* Alerts the results */
	    posting.done(function( data ) {
	    	
	    	if (data== 1){
        M.toast({html: 'Por favor introduce un nombre de ingrediente correcto', classes: 'red rounded'});
				
	    	}
	    	else if (data== 2){
        M.toast({html: 'Por favor selecciona un grupo alimenticio válido', classes: 'red rounded'});
					    	}
	    	
	    	else if (data== 4){
        M.toast({html: 'Por favor verifica que todos los campos estén correctos', classes: 'red rounded'});
        

				
	    	}
	    	else if(data == 6){
          
          M.toast({html: 'Ingrediente creado exitosamente', classes: 'green rounded'});
          var form = document.getElementById("agregar_ingrediente");
          form.reset();
        }
        else{
          M.toast({html: 'Error insertando a la base de datos por favor verifica los datos', classes: 'red rounded'});
        }
	    });
    });

    




});

