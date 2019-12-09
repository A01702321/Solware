var valor=1;
$(document).ready(function(){
  $(".tablinks").click(function(){
    var i, tabcontent, tablinks;
    var id =  $(this).attr("name");
    var xhttp = new XMLHttpRequest();

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {	
      tablinks[i].className = tablinks[i].className.replace("active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(id).style.display = "block";
    event.currentTarget.className += " active";
    /*if (id == "clientes") {
    	 xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
        document.getElementById(id).innerHTML =
        this.responseText;
      }
    	};
  	  xhttp.open("GET", "Consultar.php?q="+id, true);
  	  xhttp.send();
   	}
   	 if (id == "ingredientes") {
    	 xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
        document.getElementById(id).innerHTML =
        this.responseText;
      }
    	};
  	  xhttp.open("GET", "ConsultarIngredientes.php?q="+id, true);
  	  xhttp.send();
   	}*/

   	 xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
         document.getElementById(id).innerHTML = this.responseText;
       }
     };
  	 xhttp.open("GET", "Consultas.php?q="+id, true);
  	 xhttp.send();
  });
});

function obtenIngrediente(number) {
        let nombre ="#rest";
        let nombre1 ="#resultado";
        let numero = number;
        nombre += number;
        nombre1 += number;
        $.get("obtenIngredientes.php", {
            pattern: $(nombre).val(),
            indice: numero
        }).done(function (data) {
            $(nombre1)[0].style.visibility = "visible";
            $(nombre1).html(data);
        }); 
}

function obtenerIngredientes(number) {
        let nombre ="#rest";
        let nombre1 ="#resultado";
        let numero = number;
        nombre += number;
        nombre1 += number;
        $.get("obtenerIngredientes.php", {
            pattern: $(nombre).val(),
            indice: numero
        }).done(function (data) {
            $(nombre1)[0].style.visibility = "visible";
            $(nombre1).html(data);
        }); 
}

function obtenCliente(number) {
        let nombre ="#rest";
        let nombre1 ="#resultado";
        let numero = number;
        nombre += number;
        nombre1 += number;
        $.get("obtenClientes.php", {
            pattern: $(nombre).val(),
            indice: numero
        }).done(function (data) {
            $(nombre1)[0].style.visibility = "visible";
            $(nombre1).html(data);
        }); 
}

function obtenPreparados(number) {
        let nombre ="#rest";
        let nombre1 ="#resultado";
        let numero = number;
        nombre += number;
        nombre1 += number;
        $.get("obtenPreparados.php", {
            pattern: $(nombre).val(),
            indice: numero
        }).done(function (data) {
            $(nombre1)[0].style.visibility = "visible";
            $(nombre1).html(data);
        }); 
}

function selectValue() {

    var list = document.getElementById("list");
    var userInput = document.getElementById("rest1");
    var ajaxResponse = document.getElementById('resultado1');
    userInput.value = list.options[list.selectedIndex].text;
    ajaxResponse.style.visibility = "hidden";
    userInput.focus();
}

function cambiarValor(){
valor ++;
document.getElementById("valorRestricciones").value=valor;
}


$(document).on('click', '#subi', function(){ 
       /* stop form from submitting normally */
       event.preventDefault();
       /* get the action attribute from the <form action=""> element */
       
      url = "loginUser.php";

      var posting = $.post( url, { user: $('#user').val(), password: $('#password').val()} );
        
      /* Send the data using post with element id name and name2*/
      
      /* Alerts the results */
      posting.done(function( data ) {
      alert('Mandado');
      });
});