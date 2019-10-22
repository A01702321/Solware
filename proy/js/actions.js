var her = 0;
var slideIndex = 1;
showSlides(slideIndex);
document.getElementById("defaultOpen").click();

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

/*js para el menu, mover imagenes, etc*/
// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
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