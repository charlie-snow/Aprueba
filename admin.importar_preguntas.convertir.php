<?php
require_once("clases/clase.importador.php");
$importador = new importador;

require_once("clases/clase.verifica.php");
$verificador = new verifica;

$importador->codigo = $_POST["codigo"];
$importador->tematica = $_POST["tematica"];
$importador->formato = $_POST["formato"];
$importador->texto = "";
$texto = "";

$dearchivo = $_POST["dearchivo"];

// limpiar el texto, si viene de archivo o de texto pegado

if ($dearchivo == 1) {	// si viene de archivo
	$nombre_archivo = $_POST["archivo"];
	if(!file_exists($nombre_archivo) || !is_readable($nombre_archivo)) return FALSE;
	if (($file = fopen($nombre_archivo, 'r')) !== FALSE) {
		while(!feof($file)){
			$linea=fgets ($file, 100);
			$texto.= $linea." ";
		}
	}
	fclose($file);
	$importador->texto = $verificador->limpiar($texto);
} else {						// si viene del textarea
	// -- si pego mucho texto en un textarea, se cuelga el firefox, y el opera no deja
	$importador->texto = chop($_POST["texto"]);
}
			// echo "<PRE>importador..";print_r($importador);echo "</PRE>";

// ya limpio, se trata el texto
$importador->extraerPreguntasTexto();

			// $_SESSION['error'] .= "<PRE>importador..".print_r($importador)."</PRE>";

if ($_GET['prueba'] == 1) {
	echo "Esto ha sido una PRUEBA
	<br>
	<a href='index.php?contenido=admin.meter_preguntas' name='atras' id='atras'>ir a meter de verdad</a>";
} else {
	$importador->insertarPreguntas();
	echo "Se ha intentado meter las preguntas
	<br>
	<a href='index.php?contenido=pregunta.preguntas' name='siguiente' id='siguiente'>siguiente</a>";
}

?>
