<?php

require_once("clases/clase.test.php");
require_once("clases/clase.pregunta.php");

if (isset($_GET['id_pregunta'])) { 											// test de 1 pregunta

	$test = new test;
	$test->npregunta = 1;
	$test->npreguntas = 1;

	$pregunta = new pregunta;
	$pregunta->recuperar($_GET['id_pregunta'], $_SESSION['usuario_id'], $_SESSION['opciones'], true);
	$test->id = $pregunta->sigTest();
	$test->pregunta = $pregunta;

	$_SESSION['test'] = serialize($test);
	if (isset($test->id) && $test->id != 0) { $_SESSION['test_id'] = $test->id; }

	header ("Location: index.php?contenido=test.pregunta");
} else {																		// test de n preguntas
	// si se le envían parámetros. sobreescriben la variable test
	if (isset($_GET['npregunta']) && isset($_GET['npreguntas']) && isset($_GET['tematicas'])) {
		$test = new test;
		$test->npregunta = $_GET['npregunta'];
		$test->npreguntas = $_GET['npreguntas'];
		$test->tematicas = $_GET['tematicas'];
		$test->texto_tematicas = $_GET['texto_tematicas'];
		$_SESSION['test'] = serialize($test); 
	}

	// $test = unserialize ($_SESSION['test']);

	if ($test->preguntaAleatoria($_SESSION['opciones'], $_SESSION['usuario_id'])) { 			// si aún hay preguntas
		// $_SESSION['pregunta'] = serialize($test->pregunta);
		$_SESSION['test'] = serialize($test);
		if (isset($test->id) && $test->id != 0) { $_SESSION['test_id'] = $test->id; }
		// echo "<PRE>pregunta..";print_r($test);echo "</PRE>";
		header ("Location: index.php?contenido=test.pregunta");
	} else {													// si ya se respondieron todas
		header ("Location: index.php?contenido=test.veredicto&texto_tematicas=".$test->texto_tematicas);
	}
}

?>