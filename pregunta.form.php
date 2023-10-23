<?php if ($_SESSION['usuario_nivel'] == 1) { // si es administrador ?>

<?php
require_once("clases/clase.pregunta.php");
$pregunta = new pregunta;
$pregunta->recuperar($_GET["id_pregunta"], $_SESSION['usuario'], $_SESSION['opciones'], true);	
?>


<form action="pregunta.modificar.php" method="post" name="pregunta" id="pregunta">
 
<input type="hidden" name="id_pregunta" value="<?php echo $pregunta->id ?>" id="id_pregunta">
<input type="hidden" name="nopciones" value="<?php echo count($pregunta->opciones) ?>" id="nopciones">

<table width="90%" align="center">

<tr>
	<td colspan="2" class="td_azul_oscuro">Pregunta cod.<?php echo $pregunta->codigo; ?> - id.<?php echo $pregunta->id ?></td>
</tr>
<tr>
	<td class="td_azulin">
	<textarea rows="3" cols="150" wrap="physical" name="texto_pregunta" id="texto_pregunta"><?php echo $pregunta->texto_pregunta; ?></textarea>
	</td>
	<td align="center" id="pregunta" class="td_deseleccionado" onmouseover="seleccionar(this)" onmouseout="deseleccionar(this)" onclick="optar('pregunta')">
	modificar
	</td>
</tr>

<?php for ($i=0; $i<=count($pregunta->opciones)-1; $i++) { 
			$letra = "a";
			switch ($i+1) {
				case 1:
					$letra = "a";
					break;
				case 2:
					$letra = "b";
					break;
				case 3:
					$letra = "c";
					break;
				case 4:
					$letra = "d";
					break;
				case 5:
					$letra = "e";
					break;
				case 6:
					$letra = "f";
					break;
			} ?>		

<tr>
	<td class="td_azulin">
	<?php echo $letra; ?>)
	<textarea name="opciones[]" rows="3" cols="150"><?php echo $pregunta->opciones[$i][1]; ?></textarea>
	</td>
	<td>
	</td>
</tr>

<?php } ?>

</table>

</form>

<?php } ?>

<script language="JavaScript" type="text/JavaScript">
function deseleccionar(celda) {
	celda.className="td_deseleccionado";
}
function seleccionar(celda) {
	celda.className="td_seleccionado";
}
function optar(form) {
	document.forms[form].submit();
}
</script>