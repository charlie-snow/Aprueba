<?php

$volver = "test.veredicto";

for ($i=0; $i<count($veredicto->preguntaYrespuestas); $i++) {
	$id_pregunta = $veredicto->preguntaYrespuestas[$i]->id;
	$codigo = $veredicto->preguntaYrespuestas[$i]->codigo;
	$texto_pregunta = $veredicto->preguntaYrespuestas[$i]->texto_pregunta;
	$correcta = $veredicto->preguntaYrespuestas[$i]->correcta;
	$explicacion = $veredicto->preguntaYrespuestas[$i]->explicacion;
	$n_opciones = count($veredicto->preguntaYrespuestas[$i]->opciones);
	$texto_correcta = $veredicto->preguntaYrespuestas[$i]->texto_correcta;

	$duda = $veredicto->preguntaYrespuestas[$i]->duda;

	$respuesta = $veredicto->respuestas[$i]['respuesta'];
	
	$resultado = $veredicto->respuestas[$i]['resultado'];
?> 

<table width="100%" align_="center" cellspacing="7" cellpadding="10">
<tr>
	<td align="center" class="azulin" width='10%'>
		<font size="6" color="white"><?php echo $i+1; ?>.</font>
	</td>
	<td align="justify" valign="top" width='90%' class="azulin">
		<?php 
		$texto = $texto_pregunta;
		$texto = str_replace("<br/>"," ",$texto);
		$texto = str_replace("<br />"," ",$texto);
		echo $texto;
		?>
		<font color="99CCFF"><?php echo $id_pregunta; ?>.</font>
	</td>
</tr>
        <form action="XXXXX" method="post" name="respuesta" id="respuesta">
		
		<input type="hidden" name="id_pregunta" value="<?php echo $id_pregunta; ?>">
		<input type="hidden" name="correcta" value="<?php echo $correcta; ?>">
		<input type="hidden" name="explicacion" value="<?php echo $explicacion; ?>">
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		
		<input type="hidden" name="pregunta" value="<?php echo $texto_pregunta; ?>">
		<input type="hidden" name="respuesta" value="<?php echo $respuesta; ?>">
		
		<input type="hidden" name="opcion" value="">
		
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
		<td <?php 
				if ($op == $correcta) { 
					echo "bgcolor='PaleGreen'"; 
				} else { 
					if ($op == $respuesta) {
						echo "bgcolor='Tomato'"; 
					}
				} 
			?> colspan=2>
			<?php echo $letra.") ".$veredicto->preguntaYrespuestas[$i]->opciones[($op-1)][1]; ?> <br />	
		</td>
			</tr>
		<?php } ?>

	<?php if ($_SESSION['usuario_nivel'] == 1) { // si es administrador ?>
	<tr>
		<td width="100%" align="center" valign="top" class="azulin" colspan=2>
			<a href="index.php?contenido=pregunta.form&id_pregunta=<?php echo $id_pregunta ?>">editar</a>
		</td>
	</tr>
	<?php }  ?>
	<!-- <tr>
		<td width="100%" align="left" valign="top" bgcolor="B8DDC4">
			Correcta: <?php echo $texto_correcta; ?>
		</td>
	</tr> -->
</form>

<?php if (!empty($duda)) { $texto = "Editar duda"; $editar = 1; ?>

	<tr>
		<td width="100%" align="left" valign="top" colspan=2><p id="duda" value="<?php echo $duda; ?>">Duda: <?php echo $duda; ?></p></td>
	</tr>
			
<?php	} else { $texto = "Tengo una duda"; $editar = 0; } ?>
	
	<tr>
		<td width="100%" align="center" valign="top" colspan=2>
			<a href="#" onclick=window.open('test.dudar.php?id_pregunta=<?php echo $id_pregunta;if ($editar == 1) { echo "&editar=1"; }?>','ventana',width=640,height=480);return false>
			<font size="3" color="grey"><?php echo $texto; ?></font>
			</a>
		</td>
	</tr>

</table>

<?php } ?>
