<?php
require_once ("clases/clase.pregunta.php");
$pregunta = new pregunta;
$pregunta->eliminar($_GET["id_pregunta"]);
header ("Location: index.php?contenido=admin.preguntas");
?>
