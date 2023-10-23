<?php

require_once("clases/clase.pregunta.php");
$pregunta = new pregunta;
?>

<table width="100%" class="lista">
	
	<?php
	require_once("clases/clase.generaLista.php");
	$generador = new generaLista;
	$dudas = $generador->listaDudas($_SESSION['usuario_id']);
	?>
	<tr class="cabecera">
		<?php if ($_SESSION['usuario_nivel'] == 1) { // admin ?><td align="center">cod</td><?php } ?>
		<td align="center">pregunta</td>
		<td align="center">duda</td>
		<td align="center">BORRAR</td>
	</tr>
	<?php
	/*$cuantos = 100;
	for ($i=count($resultados)-1; $i>(count($resultados)-$cuantos); $i--) {*/
	for ($i=0; $i<=count($dudas)-1; $i++) {
		
		$pregunta->id = $dudas[$i][0];
		$pregunta->codigo = $dudas[$i][1];
		$pregunta->tematica = $dudas[$i][2];
		$pregunta->pregunta = $dudas[$i][3];
		$pregunta->correcta = $dudas[$i][4];
	?>
	<tr>
		<?php if ($_SESSION['usuario_nivel'] == 1) { // admin ?><td align="center"><?php	echo $pregunta->codigo	?></td><?php } ?>
		<td align="left">
		<a href="index.php?contenido=test.test&tematicas=<?php	echo $pregunta->tematica	?>&pregunta=1&preguntas=1&id_pregunta=<?php	echo $pregunta->id	?>"><?php	echo $pregunta->pregunta	?></a>
		</td>
		<td align="center"><?php	echo $dudas[$i][6]	?> - 
		<a href="#"  onclick=window.open('test.dudar.php?id_pregunta=<?php	echo $pregunta->id	?>&editar=1','ventana',width=640,height=480);return false>editar</a>
		</td>
		<td align="right"><a href="duda.elimina_duda.php?id_pregunta=<?php	echo $pregunta->id	?>">eliminar</a></td>
	</tr>
	<?php } ?>
</table>
