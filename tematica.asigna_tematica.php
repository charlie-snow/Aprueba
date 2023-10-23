<?php
session_start();
$volver = $_SESSION['volver'];

require_once("clases/clase.pregunta.php");
$clasepregunta = new pregunta;

$clasepregunta->asignarTematica ($_POST["tematica"]);

header ("Location: index.php?contenido=pregunta.preguntas");
?>
