<?php 

require_once("clases/clase.test.php");
require_once("clases/clase.pregunta.php");

include ("scripts/form_select.js");

$test = unserialize($_SESSION['test']);

$nopciones = count($test->pregunta->opciones);

// echo "<PRE>test..";print_r($test);echo "</PRE>";

?>

<table width="900" align_="center" class="pregunta">
<tr>
	<td align="center" valign="top" width='100%' class="azulin">
		<?php echo $test->texto_tematicas; ?> - Pregunta 
		<?php echo $test->npregunta; ?> de <?php echo $test->npreguntas; ?>
	</td>
</tr>
<tr>
	<td align="justify" valign="top" width='100%'>
		<?php
		$texto = $test->npregunta.'.- '.$test->pregunta->texto_pregunta;
		$texto = str_replace("<br/>"," ",$texto);
		$texto = str_replace("<br />"," ",$texto);
		echo $texto;
		?>
		<?php if ($_SESSION['usuario_nivel'] == 1) { // si es administrador 
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$test->pregunta->codigo; }  ?>
	</td>
</tr>
        <form action="index.php?contenido=test.responder_pregunta&inicio=0" method="post" name="responder" id="responder">
				
		<input type="hidden" name="respuesta" value="">
		
		<?php for ($i=0; $i<$nopciones; $i++) { 
			$letra = "a";
			switch ($i) {
				case 0:
					$letra = "a";
					break;
				case 1:
					$letra = "b";
					break;
				case 2:
					$letra = "c";
					break;
				case 3:
					$letra = "d";
					break;
				case 4:
					$letra = "e";
					break;
				case 5:
					$letra = "f";
					break;
				case 6:
					$letra = "g";
					break;
				case 7:
					$letra = "h";
					break;
				case 8:
					$letra = "i";
					break;
				case 9:
					$letra = "j";
					break;
			}
			?>
	<tr>
		<td id="celda<?php echo $i; ?>" class="deleseccionado" onmouseover="document.body.style.cursor = 'pointer'; seleccionar(this, <?php echo $nopciones; ?>)" onmouseout="deseleccionar(<?php echo $nopciones; ?>)" onclick="optar('responder', <?php echo $test->pregunta->opciones[$i][0]; ?>)">
		<?php echo $letra; ?>) 
		<?php echo $test->pregunta->opciones[$i][1]; ?> <br />	
		</td>
	</tr>
		<?php } ?>

	<tr>
		<td id="celdax" class="deleseccionado" onmouseover="document.body.style.cursor = 'pointer'; seleccionar(this, <?php echo $nopciones; ?>)" onmouseout="deseleccionar(<?php echo $nopciones; ?>)" onclick="optar('responder', 99)">
		En blanco<br />	
		</td>
	</tr>

	<tr>
		<td width="100%" align="center" valign="top" class="azulin">
		<?php if ($test->pregunta->duda == '0') { // si aún no hay duda ?>
			<a href="index.php?contenido=duda.dudar&ventaanaeditar=0&id_pregunta=<?php echo $test->pregunta->id; ?>&texto=">tengo dudas en esta pregunta</a>
		<?php } else { ?>
			Tengo esta duda en esta pregunta:<?php echo $test->pregunta->duda ?>
		<?php } ?>
		</td>
	</tr>

	<?php if ($_SESSION['usuario_nivel'] == 1) { // si es administrador ?>
	<tr>
		<td width="100%" align="center" valign="top" class="azulin">
			<a href="index.php?contenido=pregunta.form&id_pregunta=<?php echo $test->pregunta->id; ?>">editar</a>
		</td>
	</tr>
	<?php }  ?>
	
        </form>
</table>

<script language="JavaScript" type="text/JavaScript"> deseleccionar(<?php echo $nopciones; ?>); </script>