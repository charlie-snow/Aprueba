<script language="JavaScript" type="text/JavaScript">
function deseleccionar(nopciones) {
	for (i=0; i<nopciones; i++) {
		document.getElementById('celda'+i).className="deseleccionado";
	}
	document.getElementById('celdax').className="deseleccionado";
}
function seleccionar(celda, nopciones) {
	deseleccionar(nopciones);
	celda.className="seleccionado";
}
function optar(form, valor) {
	document.forms[form].respuesta.value = valor;
	document.forms[form].submit();
}
</script>