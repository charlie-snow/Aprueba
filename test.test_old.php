<?php

if (isset($_GET['pregunta'])){ $_SESSION['pregunta'] = $_GET['pregunta']; }
if (isset($_GET['preguntas'])){ $_SESSION['preguntas'] = $_GET['preguntas']; }
if (isset($_GET['tematicas'])){ $_SESSION['tematicas'] = $_GET['tematicas']; }

require_once("clases/clase.pregunta.php");
$clasepregunta = new pregunta;
$resultados = Array();

if ($_SESSION['pregunta'] > $_SESSION['preguntas']) { // si ya se respondieron todas
	require_once("test.inserta_respuesta.php");
	$_SESSION['pregunta'] = 1;
	include "test.veredicto.php";
} else { // si aún quedan preguntas
	if (isset($_GET["id_pregunta"])) { // si es una pregunta concreta
		$resultados = $clasepregunta->recuperar($_GET["id_pregunta"], $_SESSION['opciones']);
	} else { // si es un test de preguntas
		$resultados = $clasepregunta->unaPregunta($_SESSION['tematicas'], $_SESSION['opciones']);
		if ($_SESSION['pregunta'] == 1) { // si es la primera
			$_SESSION['test_id'] = $clasepregunta->sigTest();
		} else {
			require_once("test.inserta_respuesta.php");	// inserta respuesta del usuario en la bd
		}
	}
echo "<PRE>clasepregunta..";
print_r($clasepregunta);
echo "</PRE>";
	$id_pregunta=$resultados[0][0];
	$codigo=$resultados[0][1];
	$tematica=$resultados[0][2];
	$_SESSION['pregunta_texto'] = $resultados[0][3];
	$opcion_correcta=$resultados[0][4];
	$explicacion=$resultados[0][5];

	require_once ("test.pregunta.php");

	include "test.dudar.php";

	$_SESSION['pregunta'] = $_SESSION['pregunta'] + 1;
}
?>
