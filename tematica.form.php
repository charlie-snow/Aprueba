<?php
require_once("clases/clase.tematica.php");
$tematica = new tematica;
?>


<form action="tematica.insertar.php" method="post" name="tematica" id="tematica">
 
<table width="500" align="center" class="menu">
<tr>
	<td >
	Nombre: <input name="nombre" id="nombre" />
	</td>
	<td align="center" onclick="enviar('tematica')">
	<a href="#">añadir temática</a>
	</td>
</tr>
</table>

</form>

<script language="JavaScript" type="text/JavaScript">
function enviar(form) {
	document.forms[form].submit();
}
</script>