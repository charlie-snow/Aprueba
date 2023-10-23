<?php
	require_once("clases/clase.generaLista.php");
	$generador = new generaLista;
	$tematicas = $generador->listaTematicas();
?>

<table width=100% border="0" cellspacing="4" cellpadding="5" class="contenido" bgcolor="black">
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
	FORMATO av
	</td>
</tr>
</table>

<!-- <form action="index.php?contenido=admin.importar_preguntas.convertir&prueba=<?php	echo $_GET['prueba']	?>" method="post" name="meter" id="meter">

<input type="hidden" name="dearchivo" id="dearchivo" value="1">
<input type="hidden" name="formato" id="formato" value="av">


<table width=100% border="0" cellspacing="4" cellpadding="5" class="contenido">
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
		Tematica: 
        <select name="tematica" id="tematica">
		
		<?php for ($i=0; $i<=count($tematicas)-1; $i++) { ?>
			<option value="<?php	echo $tematicas[$i][0]	?>"><?php	echo $tematicas[$i][1]	?></option>
		<?php } ?>

		</select>

		Codigo:
		<input type="text" name="codigo" id="codigo" />
	</td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#ADEEB6" class="texto">
		
		Formato av - Texto preguntas-soluciones - Archivo (en el raiz de la web):<br>
		<input type="file" name="archivo" id="archivo" />
        <input name="submit" type="submit" value="meter">
	</td>
</tr>
</table>

</form> -->

<form action="index.php?contenido=admin.importar_preguntas.convertir&prueba=<?php	echo $_GET['prueba']	?>" method="post" name="meter" id="meter">

<input type="hidden" name="dearchivo" id="dearchivo" value="0">
<input type="hidden" name="formato" id="formato" value="av">

<table class="contenido">
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
		Tematica: 
        <select name="tematica" id="tematica">
		
		<?php for ($i=0; $i<=count($tematicas)-1; $i++) { ?>
			<option value="<?php	echo $tematicas[$i][0]	?>"><?php	echo $tematicas[$i][1]	?></option>
		<?php } ?>

		</select>

		Codigo:
		<input type="text" name="codigo" id="codigo" />
	</td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#ADEEB6" class="texto">
		
		Formato av - Texto preguntas-soluciones - Texto:<br>
		<TEXTAREA NAME="texto" COLS=100 ROWS=10></TEXTAREA>
          <input name="submit" type="submit" value="meter">
	</td>
</tr>
</table>

</form>

<!-- <table width=100% border="0" cellspacing="4" cellpadding="5" class="contenido" bgcolor="black">
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
	FORMATO C
	</td>
</tr>
</table>

<form action="index.php?contenido=admin.importar_preguntas.convertir&prueba=<?php	echo $_GET['prueba']	?>" method="post" name="meter" id="meter">

<input type="hidden" name="dearchivo" id="dearchivo" value="1">
<input type="hidden" name="formato" id="formato" value="C">

<table width=100% border="0" cellspacing="4" cellpadding="5" class="contenido">
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
		Tematica: 
        <select name="tematica" id="tematica">
		
		<?php for ($i=0; $i<=count($tematicas)-1; $i++) { ?>
			<option value="<?php	echo $tematicas[$i][0]	?>"><?php	echo $tematicas[$i][1]	?></option>
		<?php } ?>

		</select>

		Codigo:
		<input type="text" name="codigo" id="codigo" />
	</td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#ADEEB6" class="texto">
		
		Formato C - Texto preguntas-soluciones - Archivo (en el raiz de la web):<br>
		<input type="file" name="archivo" id="archivo" />
        <input name="submit" type="submit" value="meter">
	</td>
</tr>
</table>

</form>

<form action="index.php?contenido=admin.importar_preguntas.convertir&prueba=<?php	echo $_GET['prueba']	?>" method="post" name="meter" id="meter">

<input type="hidden" name="dearchivo" id="dearchivo" value="0">
<input type="hidden" name="formato" id="formato" value="C">


<table class="contenido">
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
		Tematica: 
        <select name="tematica" id="tematica">
		
		<?php for ($i=0; $i<=count($tematicas)-1; $i++) { ?>
			<option value="<?php	echo $tematicas[$i][0]	?>"><?php	echo $tematicas[$i][1]	?></option>
		<?php } ?>

		</select>

		Codigo:
		<input type="text" name="codigo" id="codigo" />
	</td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#ADEEB6" class="texto">
		
		Formato C - Texto preguntas-soluciones - Texto:<br>
		<TEXTAREA NAME="texto" COLS=100 ROWS=10></TEXTAREA>
          <input name="submit" type="submit" value="meter">
	</td>
</tr>
</table>

</form> -->

<!-- NO FUNCIONA: el csv to array no hace un array con índices 'codigo..'

<form action="index.php?contenido=admin.inserta_preguntas" method="post" name="meter" id="meter">

<table width=100% border="0" cellspacing="4" cellpadding="5" class="contenido" bgcolor="black">
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
		Tematica: 
        <select name="tematica" id="tematica">
		
		<?php for ($i=0; $i<=count($tematicas)-1; $i++) { ?>
			<option value="<?php	echo $tematicas[$i][0]	?>"><?php	echo $tematicas[$i][1]	?></option>
		<?php } ?>

		</select>

	</td>
</tr>
<tr>
	<td align="center" valign="top" bgcolor="#ADEEB6" class="texto">
		Formato A - Tabla CSV - Fichero:
		<input type="file" name="archivo" id="archivo" />
        <input name="submit" type="submit" value="meter">
        
	</td>
</tr>
</table>

</form>

--!>

<br><br>
FORMATO C:
<br><br>
Preguntas      <<<<----- lo ignora
<br><br>
----x----
<br><br>
101.- Los extintores portátiles se caracterizan por:<br>
a) Su masa es igual o inferior a 15 kg.<br>
b) Su masa es igual o inferior a 20 kg.<br>
c) Su masa es igual o inferior a 25 kg.<br>
d) Su masa es igual o inferior a 30 kg.<br>
<br><br>
Respuestas/Comentarios	      <<<<----- lo ignora
<br><br>
----x----
<br><br>
101.- b) <br>
El Reglamento de Aparatos a Presión dedica su ITC-MIE-AP5 (Instrucción Técnica Complementaría) a los extintores de incendio. El Art.2° en su punto 2 nos define «Extintor portátil. Es un extintor concebido para ser llevado y utilizado a mano y que en condiciones de funcionamiento tiene una masa igual o inferior a 20 kg. La norma UNE 23110-1 en su punto 3.2 nos dice exactamente lo mismo».

<br><br>
FORMATO av:
<br><br>
Preguntas      <<<<----- lo ignora
<br><br>
----x----
<br><br>
101.- Los extintores portátiles se caracterizan por:<br>
a) Su masa es igual o inferior a 15 kg.<br>
bv) Su masa es igual o inferior a 20 kg.<br>
c) Su masa es igual o inferior a 25 kg.<br>
d) Su masa es igual o inferior a 30 kg.<br>