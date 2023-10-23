<?php

require_once("clases/clase.estadisticas.php");
$claseestadisticas = new estadisticas;
$claseestadisticas->procesar($_SESSION['usuario_id']);

$multiplicador_tabla = 3;
$acierto = $claseestadisticas->acierto;
$error = $claseestadisticas->error;
?>

<table class="lista">

	<tr class="cabecera">
		<td colspan="2"><img src="img/aprender-estudiar.png"></td>
		<td align="center">Resultados de <?php echo $_SESSION['usuario_nombre'] ?>:</td>
	</tr>
	<tr>
		<td align="center">bien</td>
		<td align="center">mal</td>
		<td align="center"><?php echo $claseestadisticas->acierto; ?>% / <?php echo $claseestadisticas->error; ?>%</td>
	</tr>
	<tr>
		<td align="center"><?php echo $claseestadisticas->bien ?></td>
		<td align="center"><?php echo $claseestadisticas->mal ?></td>
		<td align="center">
		
		<?php include ("ranking.barra.php"); ?>
		
		</td>
	</tr>
</table>

lista de tests completados
<table class="lista">

<tr class="cabecera">
	<td>test</td>
</tr>
<?php 
$tests = $claseestadisticas->tests;
for ($i=0; $i<=count($tests)-1; $i++) {
	
?>
<tr>
	<td>
	<a href="index.php?contenido=test.veredicto&test_id=<?php echo $tests[$i]['id']; ?>">Test <?php echo $tests[$i]['id']; ?></a>
	</td>
</tr>
<?php } ?>
</table>

<!-- 
lista de preguntas
<table class="lista">

<tr class="cabecera">
	<td>pregunta</td>
	<td align="center">aciertos / errores</td>
</tr>
<?php 
$preguntas = $claseestadisticas->preguntas;
for ($i=0; $i<=count($preguntas)-1; $i++) {
	$multiplicador_tabla = 2;
	$num_total = $preguntas[$i]['bien'] + $preguntas[$i]['mal'];
	$acierto = round(($preguntas[$i]['bien'] /$num_total) * 100);
	$error = round(($preguntas[$i]['mal'] /$num_total) * 100);
?>
<tr>
	<td>
	<a href="index.php?contenido=pregunta&opciones=4&id_pregunta=<?php	echo $preguntas[$i]['id']	?>"><?php echo $preguntas[$i]['id']." - ".$preguntas[$i]['texto'] ?></a>
	</td>
	<td align="center">
	
	<?php include ("ranking.barra.php"); ?>
	
	</td>
</tr>
<?php } ?>
</table>
-->
