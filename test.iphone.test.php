<?php
require_once("clases/clase.pregunta.php");
$clasepregunta = new pregunta;
if (isset($_GET["id_pregunta"])) {
	$resultados = $clasepregunta->recuperar($_GET["id_pregunta"], $_GET["opciones"]);
} else {
	$resultados = $clasepregunta->unaPregunta($_GET["tematica"], $_GET["opciones"]);
}
$pregunta_id=$resultados[0][0];
$pregunta_texto=$resultados[0][2];
$opcion_correcta=$resultados[0][3];
?>

<table width="100%" border="0" cellspacing="4" cellpadding="5" class="contenido" bgcolor="black">

<tr>
	<td align="justify" valign="top" class="texto" bgcolor="#cdfcab">
	Pregunta: 
	<?php
	echo $pregunta_texto;
	?>
	</td>
</tr>
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
        <form action="index.php?contenido=test.resultado" method="post" name="respuesta" id="respuesta">
		
		<input type="hidden" name="pregunta" value="<?php echo $pregunta_id; ?>">
		<input type="hidden" name="correcta" value="<?php echo $opcion_correcta; ?>">
		<input type="hidden" name="tematica" value="<?php echo $_GET["tematica"]; ?>">
		<input type="hidden" name="opciones" value="<?php echo $_GET["opciones"]; ?>">
		<input type="hidden" id="opcion" name="opcion" value="1">
		
		
		
		<?php for ($i=1; $i<count($resultados)-1; $i++) { ?>
			<input type="button" name="<?php echo $resultados[$i][0]; ?>" id="<?php echo $resultados[$i][0]; ?>" value="<?php echo $i; ?>" OnClick="seleccionar(this.id);">
			<?php echo $resultados[$i][1]; ?> <br />	
		<?php } ?>
		
		<input type="hidden" name="mensaje" value="<?php echo $pregunta_texto.': '.$resultados[count($resultados)-1][0]; ?>">
		
        
        </form>
	</td>
</tr>
</table>

<script type="text/javascript">

function seleccionar(seleccion){
	document.getElementById('opcion').value = document.getElementById(seleccion).id;
	document.forms["respuesta"].submit();
}

</script>
