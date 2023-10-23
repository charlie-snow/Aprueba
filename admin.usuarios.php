<?php
require_once("clases/clase.usuario.php");
require_once("clases/clase.generaLista.php");
require_once("clases/clase.estadisticas.php");
$usuario = new usuario;
?>

<table class="lista">
	
	<?php
	$generador = new generaLista;
	$usuarios = $generador->listaUsuarios();
	?>
		<tr class="cabecera">
			<td align="center">id</td>
			<td align="center">nombre</td>
			<td align="center">password</td>
			<td align="center">nivel</td>
			<td align="center">fecha ingreso</td>
			<td align="center">visitas</td>
			<td align="center">bien</td>
			<td align="center">mal</td>
			<td align="center">%</td>
			<td align="center">BORRAR</td>
		</tr>
		<?php
		/*$cuantos = 100;
		for ($i=count($resultados)-1; $i>(count($resultados)-$cuantos); $i--) {*/
		for ($j=0; $j<=count($usuarios)-1; $j++) {
			
			$usuario->id = $usuarios[$j][0];
			$usuario->nombre = $usuarios[$j][1];
			$usuario->nivel = $usuarios[$j][3];
			$usuario->fecha_ingreso = $usuarios[$j][5];
			$usuario->visitas = $usuarios[$j][6];
						
			$claseestadisticas = new estadisticas;
			$claseestadisticas->procesar($usuario->id);
			
			$multiplicador_tabla = 2;
			$altura_barra = 15*$multiplicador_tabla;
			$total = 100 * $multiplicador_tabla;
			$acierto = $claseestadisticas->acierto;
			$error = $claseestadisticas->error;
		?>
		<tr>
			<td align="center"><?php	echo $usuario->id	?></td>
			<td align="center"><?php	echo $usuario->nombre	?></td>
			<td align="center"><?php	echo $usuario->nivel	?></td>
			<td align="center"><?php	echo $usuario->uid_facebook	?></td>
			<td align="center"><?php	echo $usuario->fecha_ingreso ?></td>
			<td align="center"><?php	echo $usuario->visitas ?></td>
			<td align="center"><?php	echo $claseestadisticas->bien ?></td>
			<td align="center"><?php	echo $claseestadisticas->mal ?></td>
			<td align="center">
			
			<?php include ("ranking.barra.php"); ?>
			
			</td>
			<td align="right"><a href="usuario.elimina_usuario.php?id_usuario=<?php	echo $usuario->id	?>">eliminar</a></td>
		</tr>
		<?php } ?>
</table>
