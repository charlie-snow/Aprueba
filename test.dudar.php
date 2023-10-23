<?php
	header ('Content-Type: text/html; charset=utf-8');
	 // error_reporting(E_ALL);
	 // ini_set('display_errors', '1');
	session_start();

$duda = "";
if ($_GET['editar'] == 1) {
	include_once("clases/clase.pregunta.php");
	$pregunta = new pregunta;
	$pregunta->id = $_GET['id_pregunta'];
	$pregunta->recuperarDuda($_SESSION['usuario_id']);
	$duda = $pregunta->duda;
}

?>
<form action="index.php?contenido=duda.dudar&ventanaeditar=1" method="post" name="meter" id="meter">

<table width="300" class="lista" align="center">
<tr>
	<td align="left" valign="top">
		Tengo esta duda:<br>
		<TEXTAREA NAME="texto" COLS=85 ROWS=10><?php echo $duda ?></TEXTAREA>
		<input type="hidden" name="id_pregunta" id="id_pregunta" value="<?php echo $_GET['id_pregunta']; ?>">
	</td>
</tr>
<tr>
	<td align="right" valign="top">
          <input name="submit" type="submit" value="dudar">
	</td>
</tr>
</table>

</form>
