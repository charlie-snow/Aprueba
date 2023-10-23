<?php

function csv_to_array($filename, $delimiter=';') {
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else {
				// if ($row[0] == null) { $row[0] = 99; }
                $data[] = array_combine($header, $row); }
        }
        fclose($handle);
    }
    return $data;
}

require_once("clases/clase.pregunta.php");
$clasepregunta = new pregunta;

$nombre_archivo = $_POST["archivo"];
$preguntas = csv_to_array ($nombre_archivo, ';');

// echo "<PRE>preguntas..";
// print_r($preguntas);
// echo "</PRE>";

$clasepregunta->tematica = $_POST["tematica"];
$clasepregunta->setPreguntas($preguntas);
$clasepregunta->insertarPreguntas();
?>

Se ha intentado meter las preguntas <br>
<a href="index.php?contenido=test.tests" name="siguiente" id="siguiente">siguiente</a>
