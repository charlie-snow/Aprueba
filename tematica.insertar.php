<?php
	session_start();
	$volver = $_SESSION['volver'];;

	require_once ("clases/clase.tematica.php");
	$tematica = new tematica;

	$tematica->nombre = $_POST['nombre'];

	// echo  $tematica->nombre;
	$resultado = $tematica->insertar();
	// echo $resultado;
	if ($resultado != "") {
		$volver = "index.php?contenido=error";
		$_SESSION['mensaje_error'] = $resultado;
	}
	// echo $volver;
	header ("Location: ".$volver);
?>
