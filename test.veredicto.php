<?php
require_once("clases/clase.veredicto.php");

if (isset($_GET['test_id'])) { 											// veredicto de un test concreto
	$test_id = $_GET['test_id'];
} else {
	$test_id = $_SESSION['test_id'];
}

$veredicto = new veredicto($test_id);

$_SESSION['preguntas'] = 10; // por defecto
$texto_tematicas = $_GET['texto_tematicas'];

$multiplicador_tabla = 3;
$altura_barra = 15*$multiplicador_tabla;
$acierto = $veredicto->aciertox100;
$error = $veredicto->errorx100;
$enblanco = $veredicto->enblancox100;
?>

<table width="80%" border="0" cellspacing="10" cellpadding="0" align="center">
	<tr>
		<td align="center" colspan="4" class="azulin">
		<?php echo $texto_tematicas ?> - Resultados del test de <?php echo $veredicto->total ?> preguntas: 
		<?php echo ($veredicto->aciertox100/10).' sobre 10'; ?>
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="B8DDC4" colspan="4">Resultados con penalización: 
			<?php echo $veredicto->resultado3menos1; ?>
		</td>
	</tr>
	<tr>
		<td align="center" class="td_azulin">Aciertos</td>
		<td align="center" class="td_azulin">Errores</td>
		<td align="center" class="td_azulin">En blanco</td>
		<td align="center" class="td_azulin"><?php echo $veredicto->aciertox100; ?>% / <?php echo $veredicto->errorx100; ?>% / <?php echo $veredicto->enblancox100; ?>%</td>
	</tr>
	<tr>
		<td align="center" class="td_azulin"><?php echo $veredicto->aciertos ?></td>
		<td align="center" class="td_azulin"><?php echo $veredicto->errores ?></td>
		<td align="center" class="td_azulin"><?php echo $veredicto->enblanco ?></td>
		<td align="center" class="td_azulin">
		
		<table width="<?php echo $total; ?>" border="0" cellspacing="0" cellpadding="1">
			<tr>
				<td align="center" width="<?php echo $acierto; ?>" bgcolor="PaleGreen" height="<?php echo $altura_barra; ?>"></td>
				<td align="center" width="<?php echo $error; ?>" bgcolor="Tomato"></td>
				<td align="center" width="<?php echo $enblanco; ?>" bgcolor="LightSkyBlue"></td>
			</tr>
		</table>
		
		</td>
	</tr>
</table>

<?php
$veredicto->recuperaResultados($_SESSION['test_id'], $_SESSION['usuario_id']);
require_once("test.veredicto.informe.php");
?>
