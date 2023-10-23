<?php
require_once("clases/clase.pregunta.php");
require_once("clases/clase.generaLista.php");
require_once("clases/clase.tematica.php");
$generador = new generaLista;
$pregunta = new pregunta;
$tematica = new tematica;

$tematica_id = $_GET['tematica_id'];

$preguntas = $generador->listaPreguntas($tematica_id);
$tematica->recuperar($tematica_id);
?>

<table width="100%" class="lista">
	<tr class="cabecera">
		<td align="center" colspan='7'> Tematica: <?php echo $tematica->tematica; ?> </td>	
	</tr>
	<tr>
		<td align="center">codigo</td>
		<td align="center">pregunta</td>
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
		<td align="center"><?php	echo $pregunta->codigo	?></td>
		<td align="left">
		<a href="index.php?contenido=pregunta.form&id_pregunta=<?php	echo $pregunta->id	?>"><?php	echo $pregunta->pregunta	?></a>
		</td>
	</tr>
	<?php } ?>
</table>
