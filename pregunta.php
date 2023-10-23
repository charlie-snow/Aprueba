<?php

$pregunta = new pregunta;
$pregunta->recuperar($_GET['id_pregunta'], $_SESSION['opciones'], true);

$id_pregunta = $pregunta->id;
$codigo = $pregunta->codigo;
$texto_pregunta = $pregunta->texto_pregunta;
$correcta = $pregunta->correcta;
$explicacion = $pregunta->explicacion;
$n_opciones = count($pregunta->opciones);
$texto_correcta = $pregunta->texto_correcta;
?> 

<table width="700" align_="center">
<tr>
	<td align="justify" valign="top" width='100%' class="azulin">
		<?php 
		$texto = $id_pregunta.'.- '.$texto_pregunta;
		$texto = str_replace("<br/>"," ",$texto);
		$texto = str_replace("<br />"," ",$texto);
		echo $texto;
		?>
	</td>
</tr>
		<?php for ($op=1; $op<=$n_opciones; $op++) { 
			$letra = "a";
			switch ($op) {
				case 1:
					$letra = "a";
					break;
				case 2:
					$letra = "b";
					break;
				case 3:
					$letra = "c";
					break;
				case 4:
					$letra = "d";
					break;
				case 5:
					$letra = "e";
					break;
				case 6:
					$letra = "f";
					break;
				case 7:
					$letra = "g";
					break;
				case 8:
					$letra = "h";
					break;
				case 9:
					$letra = "i";
					break;
				case 10:
					$letra = "j";
					break;
			}
			?>
			<tr>
		<td >
			<?php echo $letra.") ".$pregunta->opciones[($op-1)][1]; ?> <br />	
		</td>
			</tr>
		<?php } ?>

	<?php if ($_SESSION['usuario_nivel'] == 1) { // si es administrador ?>
	<tr>
		<td width="100%" align="center" valign="top" class="azulin">
			<a href="index.php?contenido=pregunta.form&id_pregunta=<?php echo $id_pregunta ?>">editar</a>
		</td>
	</tr>
	<?php }  ?>
	<tr>
		<td width="100%" align="center" valign="top" class="azulin">
			Correcta: <?php echo $texto_correcta; ?>
		</td>
	</tr>
</table>

<?php 
$duda = $pregunta->recuperarDuda($_SESSION['usuario_id']);
$volver = "pregunta&id_pregunta=".$_GET['id_pregunta'];
include "test.dudar.php";
?>