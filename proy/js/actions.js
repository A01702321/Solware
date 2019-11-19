$('.tabs').tabs();
$('select').formSelect();

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

/*js para consultar*/

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
        $('#dynamic_field2').append('<tr id="rowC'+o+'"><td><div class="input-field col s7"><input type="text" name="cat'+o+'" id="cat'+o+'" class="validate" data-error="wrong" required><label for="validate-ingrediente">Categoria</label><span class="helper-text" data-error="Por favor introduce un nombre de categoría." data-success=""></span></div><div vertical-align: middle id=""><br><button type="button" name="remove" id="'+o+'" class="btn-small btn-danger btn_removeC red">X</button></div></td></tr>');  
    });

    $(document).on('click', '.btn_removeC', function(){  
        var button_id = $(this).attr("id");   
        $('#rowC'+button_id+'').remove();  
        o--;
    }); 

    $(document).on('click', '#submit', function(){ 
        /*for (x = 1; x<=i; x++){
        if($('#nombreprep').val() == "" || $('#ing' + x).val() == "" ){
            alert("Por favor verifica los datos e intenta nuevamente");
            return false;
        }
        }*/
         /* stop form from submitting normally */
        event.preventDefault();

         /* get the action attribute from the <form action=""> element */
        preparadoNom()
        url = "preparadoNom.php";
      
        /* Send the data using post with element id name and name2*/
        var posting = $.post( url, { name: $('#nombreprep').val()} );
        
        /* Alerts the results */
        posting.done(function( data ) {
        
        });
    });

    $(document).on('click', '#submit', function(){ 
      	for (x = 1; x<=i; x++){
        	if($('#nombreprep').val() == "" || $('#ing' + x).val() == "" ){
            
            	return false;
        	}
      	}
      
       /* stop form from submitting normally */
       event.preventDefault();

       /* get the action attribute from the <form action=""> element */
      
      	url = "preparadoIng.php";
      	for (x = 1; x<=i; x++){

        	var posting = $.post( url, { name: $('#nombreprep').val(), ingredient: $('#ing' + x).val()} );
        
      	};
      	/* Send the data using post with element id name and name2*/
      
      
      	/* Alerts the results */
      	posting.done(function( data ) {
      		alert('Preparado agregado exitosamente');
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
				alert('Por favor ingresa un nombre de ingrediente');
	    	}
	    	if (data== 2){
				alert('Por favor ingresa un grupo alimenticio');
	    	}
	    	
	    	if (data== 4){
				alert('Asegurate de no tener categorías vacías');
	    	}
	    	if(data == 5){
	    		alert('Función llamada correctamente');
	    	}
	    });
    });



});

