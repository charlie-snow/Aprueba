<?php
session_start();

require_once ("clases/clase.tematica.php");
$tematica = new tematica;

$volver = $_SESSION['volver'];

// $resultado = $tematica->eliminar($_GET["id_tematica"]);
// echo $resultado;
// 	if ($resultado != '') {
// 		$volver = "index.php?contenido=error";
// 		$_SESSION['mensaje_error'] = $resultado;
// 	}

if ($tematica->conpreguntas($_GET["id_tematica"]) == 1) {
	$volver = "index.php?contenido=error";
	$_SESSION['mensaje_error'] = "Temática no eliminada: Para poder eliminarla tiene que estar vacía. Vacíala y vuelve a intentarlo.";
} else {
	$resultado = $tematica->eliminar($_GET["id_tematica"]);
	if ($resultado != "") {
		$volver = "index.php?contenido=error";
		$_SESSION['mensaje_error'] = $resultado;
	}
}
header ("Location: ".$volver);
// echo $volver;
?>