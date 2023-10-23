<?php
require_once("clases/clase.test.php");
require_once("clases/clase.pregunta.php");
require_once ("clases/clase.conexion.php");

$test = unserialize($_SESSION['test']);

$bien = 3;	// por defecto, sin contestar

if ($_POST["respuesta"] == 99) {
	$bien = 3;
} else {
	if ($_POST["respuesta"] == $test->pregunta->correcta) {
		$bien =  1;
	}
	else {
		$bien = 0;
	}
}

$test->test();
$test->insertaRespuesta($_SESSION['usuario_id'], $_SESSION['test_id'], $test->pregunta->id, $_POST["respuesta"], $bien);
$test->npregunta = $test->npregunta + 1;

// $_SESSION['test'] = serialize($test); 

// echo ("Location: index.php?contenido=test.test&tematicas=".$test->tematicas."&npreguntas=".$test->npreguntas."&npregunta=".$test->npregunta);
header ("Location: index.php?contenido=test.test&tematicas=".$test->tematicas."&npreguntas=".$test->npreguntas."&npregunta=".$test->npregunta."&texto_tematicas=".$test->texto_tematicas);
?>
