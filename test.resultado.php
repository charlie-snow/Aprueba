<?php include "test.inserta_respuesta.php"; ?>

<form action="index.php?contenido=test.test&inicio=0" method="post"  name="siguiente" id="siguiente">
<table width="100%" class="test">
<tr>
	<?php if ($bien == 1) { ?>
		<td class="acierto" width="20"></td>
		<td align="justify" valign="top" width="400" class="azulin">Correcto</td>
	<?php } else { ?>
		<td class="error" width="20"></td>
		<td align="justify" valign="top" width="400" class="azulin">Incorrecto</td>
	<?php } ?>
	<td></td>
</tr>
<tr>
	<td bgcolor="white"></td>
	<td align="justify" valign="top" class="azulin"><?php echo $_POST['pregunta'];?></td>
	<td></td>
</tr>
<tr>
	<td bgcolor="white"></td>
	<td align="justify" valign="top" class="td_deseleccionado" onmouseover="seleccionar(this)" onmouseout="deseleccionar()" class="td_deseleccionado"><?php echo $_POST['respuesta'];?></td>
	<td id="celda" align="justify" valign="top" class="td_deseleccionado" onmouseover="seleccionar(this)" onmouseout="deseleccionar()" onclick="optar()" class="td_deseleccionado">Siguiente pregunta....</td>
</tr>
<?php if ($_POST['explicacion'] != "") { ?>
<tr>
	<td align="justify" valign="top" class="azulin" colspan="3">
	
	<?php echo 'Explicacion: '.$_POST['explicacion']; ?>

	</td>
</tr>
<?php } ?>

</table>

</form>

<form action="duda.dudar.php" method="post" name="meter" id="meter">

<table width="700" class="lista" align="center">
<tr>
	<td align="left" valign="top">
		Tengo esta duda:<br>
		<TEXTAREA NAME="texto" COLS=85 ROWS=10></TEXTAREA>
		<input type="hidden" name="id_pregunta" value="<?php echo $_POST["id_pregunta"]; ?>">
	</td>
</tr>
<tr>
	<td align="right" valign="top">
          <input name="submit" type="submit" value="dudar">
	</td>
</tr>
</table>

</form>

<script language="JavaScript" type="text/JavaScript">
function deseleccionar() {
	document.getElementById('celda').className="td_deseleccionado";
}
function seleccionar(celda) {
	celda.className="td_seleccionado";
}
function optar() {
	document.forms['siguiente'].submit();
}
</script>
