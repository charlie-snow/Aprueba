<?php
$_SESSION['volver'] = "index.php?contenido=admin.preguntas";

require_once("clases/clase.pregunta.php");
$pregunta = new pregunta;

require_once("clases/clase.generaLista.php");
	$generador = new generaLista;
	$tematicas = $generador->listaTematicas();
	
	for ($i=0; $i<=count($tematicas)-1; $i++) { ?>


<table width="100%" class="lista">	
		<tr class="cabecera">
			<td align="center" colspan='7' >Tematica: <?php echo $tematicas[$i][1]; ?> | 
			<a href="admin.exportar_csv.php?tematica=<?php echo $tematicas[$i][0]; ?>">exportar a csv</a>
			......................................
			<a href="tematica.vaciar_tematica.php?id_tematica=<?php echo $tematicas[$i][0]; ?>">vaciar!</a>
			</td>	
		</tr>		
		
		<?php $preguntas = $generador->listaPreguntas($tematicas[$i][0]); ?>
		<tr>
			<td align="center">id</td>
			<td align="center">codigo</td>
			<td align="center">tematica</td>
			<td align="center">pregunta</td>
			<td align="center">correcta</td>
			<td align="center">explicacion</td>
			<td align="center">BORRAR</td>
		</tr>
		<?php
		/*$cuantos = 100;
		for ($i=count($resultados)-1; $i>(count($resultados)-$cuantos); $i--) {*/
		for ($j=0; $j<=count($preguntas)-1; $j++) {
			
			$pregunta->id = $preguntas[$j][0];
			$pregunta->codigo = $preguntas[$j][1];
			$pregunta->tematica = $preguntas[$j][2];
			$pregunta->pregunta = $preguntas[$j][3];
			$pregunta->correcta = $preguntas[$j][4];
			$pregunta->explicacion = $preguntas[$j][5];
		?>
		<tr>
			<td align="center"><?php	echo $pregunta->id	?></td>
			<td align="center"><?php	echo $pregunta->codigo	?></td>
			<td align="center"><?php	echo $pregunta->tematica	?></td>
			<td align="left">
			<a href="index.php?contenido=pregunta.form&id_pregunta=<?php	echo $pregunta->id	?>"><?php	echo $pregunta->pregunta	?></a>
			</td>
			<td align="center"><?php	echo $pregunta->correcta	?></td>
			<td align="center"><?php	echo substr($pregunta->explicacion, 0, 10)	?></td>
			<td align="right"><a href="pregunta.elimina_pregunta.php?id_pregunta=<?php	echo $pregunta->id	?>">eliminar</a></td>
		</tr>
		<?php } ?>
	<?php } ?>
</table>
