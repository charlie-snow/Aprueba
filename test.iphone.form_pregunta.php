<table width="100%" border="0" cellspacing="4" cellpadding="5" class="contenido" bgcolor="black">
<tr>
	<td align="right" valign="top" class="texto_pequeno" bgcolor="#cdfcab">
	<?php
	echo "tem: ".$_GET["tematica"];
	echo " - cod: ".$codigo;
	echo " - id: ".$id_pregunta;
	?>
	</td>
</tr>
<tr>
	<td align="justify" valign="top" class="texto" bgcolor="#cdfcab" width='90%'>
	<?php
	echo $_SESSION['pregunta'].".- ";
	echo $pregunta_texto;
	?>
	</td>
</tr>
<tr>
	<td colspan=2 align="center" valign="top" bgcolor="#ADEEB6" class="texto">
        <form action="index.php?contenido=test.resultado" method="post" name="respuesta" id="respuesta">
		
		<input type="hidden" name="id_pregunta" value="<?php echo $id_pregunta; ?>">
		<input type="hidden" name="correcta" value="<?php echo $opcion_correcta; ?>">
		<input type="hidden" name="tematica" value="<?php echo $_GET["tematica"]; ?>">
		<input type="hidden" name="opciones" value="<?php echo $_GET["opciones"]; ?>">
		<input type="hidden" id="opcion" name="opcion" value="1">
		<input type="hidden" name="explicacion" value="<?php echo $explicacion; ?>">
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		
		
		
		<?php for ($i=1; $i<count($resultados)-1; $i++) { ?>
			<input type="button" name="<?php echo $resultados[$i][0]; ?>" id="<?php echo $resultados[$i][0]; ?>" value="<?php echo $i; ?>" OnClick="seleccionar(this.id);">
			<?php echo $resultados[$i][1]; ?> <br />	
		<?php } ?>
		
		<input type="hidden" name="mensaje" value="<?php echo $pregunta_texto.': '.$resultados[count($resultados)-1][0]; ?>">
		
        
        </form>
	</td>
</tr>
</table>

<script type="text/javascript">

function seleccionar(seleccion){
	document.getElementById('opcion').value = document.getElementById(seleccion).id;
	document.forms["respuesta"].submit();
}

</script>
