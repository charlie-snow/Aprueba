<?php
include_once("clases/clase.pregunta.php");
$pregunta = new pregunta;
$id_pregunta = 0;
$texto = '';
if ($_GET["ventanaeditar"] == '1') {
	$pregunta->dudar ($_SESSION['usuario_id'], $_POST["id_pregunta"], 1, $_POST["texto"]);
	echo "<script type=\"text/javascript\" charset=\"utf-8\"> window.opener.location.reload(); window.self.close()</script>";
} else {
	$pregunta->dudar ($_SESSION['usuario_id'], $_GET["id_pregunta"], 1, $_GET["texto"]);
	header ("Location: index.php?contenido=test.pregunta");
}
?>