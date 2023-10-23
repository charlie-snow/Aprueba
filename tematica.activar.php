<?php
session_start();
$volver = $_SESSION['volver'];;

require_once ("clases/clase.tematica.php");
$tematica = new tematica;

$tematica->activar($_GET["id_tematica"], $_GET["activa"]);
header ("Location: ".$volver);
?>
