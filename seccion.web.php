<table width="100%" cellspacing="5" align="center">
<tr>
	<td width="100%" height="20" align="left"><?php include "seccion.cabecera.php"?></td>
</tr>
<tr valign="top">
<td width="100%">

	<?php include "seccion.contenido.php" ?>

</td>
</tr>
<tr>
	<td<?php if ($_SESSION['usuario_nivel'] != 1) { // si no es administrador ?> 
 class="invisible"<?php } ?>>
	<?php include ("seccion.pie.php"); ?>
	</td>
</tr>
<tr valign="top">
	<td<?php if ($_SESSION['usuario_nivel'] != 1) { // si no es administrador ?> 
 class="invisible"<?php } ?>>
<!-- -->
.: debug :.
	<?php include ("seccion.debug.php"); ?>

<!-- -->
	</td>
</tr>
</table>
