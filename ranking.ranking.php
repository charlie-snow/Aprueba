<?php
require_once("clases/clase.usuario.php");
require_once("clases/clase.generaLista.php");
require_once("clases/clase.estadisticas.php");
$usuario = new usuario;
$estadisticas = new estadisticas;

$ranking = $estadisticas->ranking();
?>


<table align="center" class="lista">

<tr class="cabecera">
	<td align="center">usuario</td>
	<td align="center">%</td>
	<td align="center">bien</td>
	<td align="center">mal</td>
</tr>
<?php
/*$cuantos = 100;
for ($i=count($resultados)-1; $i>(count($resultados)-$cuantos); $i--) {*/
for ($i=0; $i<=count($ranking)-1; $i++) {
	
	$id = $ranking[$i][0];
	$nombre = $ranking[$i][1];
	$bien = $ranking[$i]['bien'];
	$mal = $ranking[$i]['mal'];
	$acierto = $ranking[$i]['acierto'];
	$error = $ranking[$i]['error'];
	
	if ($acierto > 0 && $error > 0) {
			
		$multiplicador_tabla = 2;
		$acierto = $acierto;
		$error = $error;
?>
<tr>
	<td align="left">
<a href="http://www.facebook.com/profile.php?id=<?php echo $ranking[$i][3] ?>">
<img src="img/aprender-estudiar.png">
<?php	echo $nombre	?></a></td>
	<td align="center">
	
	<?php include ("ranking.barra.php"); ?>
	
	</td>
	<td align="center"><?php	echo $bien ?></td>
	<td align="center"><?php	echo $mal ?></td>
</tr>
<?php } } ?>
</table>
