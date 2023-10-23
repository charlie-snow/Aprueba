<?php
	if (!isset($_GET["contenido"])) {
		$_GET["contenido"] = "seccion.portada";
	}
	include $_GET["contenido"].".php"
?>
