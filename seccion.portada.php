<?php
	require_once("clases/clase.estadisticas.php");
	$estadisticas = new estadisticas;
	$num_preguntas = $estadisticas->num_preguntas();
?>

<table width="300" align="center" class="lista">

	<tr class="cabecera">
		<td colspan="2" class="td_azul_oscuro">ApruebA</td>
	</tr>
	<tr>
		<td align="center" class="td_azulin"><img src="img/logo.png"></td>
		<td align="left" class="td_azulin">
		ApruebA es un motor de test con <?php echo $num_preguntas ?> preguntas acerca de la Constitucion Espa&ntilde;ola de 1978.<br><br>
		Funcionalidades:<br>
		- Tests personalizados<br>
		- Gestion de dudas<br>
		- Estadisticas de resultados<br>		
		</td>
	</tr>
</table>

