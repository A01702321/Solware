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