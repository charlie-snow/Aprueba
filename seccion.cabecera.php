<table width="100%" cellspacing="2" align="center" class="menu">
<tr>
	<td align="center">
	<a href="index.php?contenido=seccion.portada">
	<IMG src="img/logo.png" width="25" height="25" hspace="4" vspace="4" align="left" border="0"><br>
	APRUEBA - <?php echo $_SESSION['usuario_nombre']; ?></a>
	</td>

	<?php include "seccion.menu.php" ?>

	<td align="center">
	<a href="index.php?contenido=usuario.usuario">Tests realizados</a>
	</td>

	<td align="center">
	<a href="logout.php">logout</a>
	</td>
</tr>
</table>
