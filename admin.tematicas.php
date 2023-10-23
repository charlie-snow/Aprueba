<?php
$_SESSION['volver'] = "index.php?contenido=admin.tematicas";

require_once("clases/clase.generaLista.php");
$generador = new generaLista;
$tematicas = $generador->listaTematicas();
?>

<table width="100%" class="lista">

<?php
for ($i=0; $i<=count($tematicas)-1; $i++) {

	$tematica->id = $tematicas[$i][0];
	$tematica->tematica = $tematicas[$i][1];
    $tematica->activa = $tematicas[$i][2];
	$tematica->npreguntas = $tematicas[$i][3];
	
	$texto = "temática activa";
	if ($tematica->activa == 0) { $texto = "temática no activa"; } else { $texto = "temática activa"; } 
?>
		<tr class="cabecera">
			<td>Tematica: <?php echo $tematica->tematica." - ".$tematica->npreguntas; ?></td>
			<td><?php echo $texto; ?></td>
			<td>
			<a href="tematica.activar.php?id_tematica=<?php echo $tematica->id; ?>&activa=<?php echo $tematica->activa; ?>">activar</a>
			</td>
			<td>
			<a href="tematica.vaciar_tematica.php?id_tematica=<?php echo $tematicas[$i][0]; ?>">vaciar!</a>
			</td>	
			<td>
			<a href="tematica.eliminar.php?id_tematica=<?php echo $tematica->id; ?>">eliminar</a>
			</td>	
		</tr>
	<?php } ?>
</table>

<?php include ("tematica.form.php"); ?>
