<?php

require_once("clases/clase.pregunta.php");
$pregunta = new pregunta;

require_once("clases/clase.generaLista.php");
$generador = new generaLista;
$preguntas = $generador->listaPreguntas(9999);
$tematicas = $generador->listaTematicas();

?>

<form action="tematica.asigna_tematica.php" method="post" name="meter" id="meter">

<table width=100% border="0" cellspacing="4" cellpadding="5" class="contenido" bgcolor="black">
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
		Nueva tematica: 
        <select name="tematica" id="tematica">
		
		<?php for ($i=0; $i<=count($tematicas)-1; $i++) { ?>
			<option value="<?php	echo $tematicas[$i][0]	?>"><?php	echo $tematicas[$i][1]	?></option>
		<?php } ?>

		</select>
		<input name="submit" type="submit" value="asignar">

	</td>
</tr>
</table>

</form>

<table width="100%" border="0" cellspacing="10" cellpadding="0">
	
	<?php
	
	?>
	<tr>
		<td align="center">id</td>
		<td align="center">tematica</td>
		<td align="center">pregunta</td>
		<td align="center">correcta</td>
		<td align="center">explicacion</td>
		<td align="center">BORRAR</td>
	</tr>
	<?php
	/*$cuantos = 100;
	for ($i=count($resultados)-1; $i>(count($resultados)-$cuantos); $i--) {*/
	for ($i=0; $i<=count($preguntas)-1; $i++) {
		
		$pregunta->id = $preguntas[$i][0];
		$pregunta->tematica = $preguntas[$i][1];
		$pregunta->pregunta = $preguntas[$i][2];
		$pregunta->correcta = $preguntas[$i][3];
		$pregunta->explicacion = $preguntas[$i][4];
	?>
	<tr>
		<td align="center"><?php	echo $pregunta->id	?></td>
		<td align="center"><?php	echo $pregunta->tematica	?></td>
		<td align="left">
		<a href="index.php?contenido=test.test&tematica=1&opciones=3&id_pregunta=<?php	echo $pregunta->id	?>"><?php	echo $pregunta->pregunta	?></a>
		</td>
		<td align="center"><?php	echo $pregunta->correcta	?></td>
		<td align="center"><?php	echo $pregunta->explicacion	?></td>
		<td align="right"><a href="pregunta.elimina_pregunta.php?id_pregunta=<?php	echo $pregunta->id	?>">eliminar</a></td>
	</tr>
	<?php } ?>
</table>
