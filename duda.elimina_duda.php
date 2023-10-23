<?php
session_start();
require_once ("clases/clase.pregunta.php");
$pregunta = new pregunta;
$pregunta->eliminarDuda($_GET["id_pregunta"], $_SESSION['usuario_id']);
header ("Location: index.php?contenido=duda.dudas");
?>
