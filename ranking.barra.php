<?php
$altura_barra = 15*$multiplicador_tabla;
$total = 100 * $multiplicador_tabla;
$acierto_barra = $acierto * $multiplicador_tabla;
$error_barra = $error * $multiplicador_tabla;
?>

<table class="porcentaje" width="<?php echo $total; ?>">
<tr>
	<td width="<?php echo $acierto_barra; ?>" height="<?php echo $altura_barra; ?>" align="center" class="acierto" title="<?php echo $acierto; ?>%"></td>
	<td width="<?php echo $error_barra; ?>" align="center" class="error" title="<?php echo $error; ?>%"></td>
</tr>
</table>