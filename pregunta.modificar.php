<?php
require_once ("clases/clase.pregunta.php");
$pregunta = new pregunta;

$pregunta->texto_pregunta = trim($_POST['texto_pregunta']);

for($i=1;$i<count($_POST["opciones"])+1;$i++) {
	$pregunta->opciones[$i][0] = $i;
	$pregunta->opciones[$i][1] = trim($_POST['opciones'][$i-1]);
}

echo  "test: <PRE>";
echo print_r($pregunta);
echo "</PRE>";

// $pregunta->modificar ($_POST['id_pregunta']);
// header ("Location: index.php?contenido=pregunta.form&id_pregunta=".$_POST['id_pregunta']);
?>
