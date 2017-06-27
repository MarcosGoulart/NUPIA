addImagem(){
	var x = document.getElementById("myfile");
	document.getElementById("indicadores").innerHTML += " <br> <li data-target='#myCarousel' class='active'></li>";
	document.getElementById("slides").innerHTML += "<br> <div class='item active'><img src='"+x.src+"' alt=' '  style='width:100%;'></div>";
}