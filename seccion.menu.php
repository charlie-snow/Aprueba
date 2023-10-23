<td align="center">	
<a href="index.php?contenido=test.tests">Hacer tests</a>
</td>
<td align="center">	
<a href="index.php?contenido=duda.dudas">dudas</a>
</td>
<!-- <td align="center">	
<a href="index.php?contenido=ranking.ranking">ranking</a>
</td> -->


<?php if ($_SESSION['usuario_nivel'] == 1) { // si es administrador ?>

<td align="center">	
<a href="index.php?contenido=admin.preguntas">preguntas</a>
</td>
<td align="center">	
<a href="index.php?contenido=admin.usuarios">usuarios</a>
</td>
<td align="center">	
<a href="index.php?contenido=admin.importar_preguntas&prueba=0">IN</a>
</td>
<td align="center">	
<a href="index.php?contenido=admin.tematicas">TEM</a>
</td>	

<?php } ?>



<!--<?php if ($_SESSION['aparato'] == "iphone") { // si es un iphone ?>
		<td align="center" onclick="window.location.href='index.php?contenido=test.tests'">tests</td>
		<td align="center"> | </td>
		<td align="center" onclick="window.location.href='index.php?contenido=duda.dudas'">dudas</td>
		<td align="center">
	<?php } else { // si es navegador normal ?>
		<td> 
		<a href="index.php?contenido=test.tests">tests</a> |
		<a href="index.php?contenido=duda.dudas">dudas</a>
		
		<?php if ($_SESSION['usuario_nivel'] == 1) { // si es administrador ?>
			| <a href="index.php?contenido=pregunta.preguntas">preguntas</a>
			| <a href="index.php?contenido=admin.usuarios">usuarios</a>
		<?php } ?>

		</td>	
	<?php } ?>-->
