


function write_number() {
	
	document.getElementById("answer_field").value = "1";
	
	
}

function writeMynumber(element) {
	
	var box = element.innerHTML;
	document.getElementById("answer_field").value += box;
	
}

function erase() {
	
	document.getElementById("answer_field").value = "";
	
}