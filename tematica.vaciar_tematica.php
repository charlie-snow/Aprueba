<?php
session_start();
$volver = $_SESSION['volver'];

require_once ("clases/clase.pregunta.php");
$pregunta = new pregunta;


$pregunta->vaciarTematica($_GET["id_tematica"]);
header ("Location: ".$volver);
?>
