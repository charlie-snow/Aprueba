<?php
session_start();
// Establecer el tipo de contenido
header('Content-type: image/png');

$alto = 110;
$ancho = 700;

$fuente = 'estilos/arial.ttf';
$base_comienzo = 25;
$fuente_size = 20;
$fuente_interlineado = 30;
$fuente_caracteres_por_linea = 55;

// Crear la imagen
$im = imagecreatetruecolor($ancho, $alto);

// Crear algunos colores
$blanco = imagecolorallocate($im, 255, 255, 255);
$gris = imagecolorallocate($im, 128, 128, 128);
$negro = imagecolorallocate($im, 0, 0, 0);
$azulin = imagecolorallocate($im, 152, 203, 253);
imagefilledrectangle($im, 0, 0, $ancho, $alto, $azulin);

// El texto a dibujar
$texto = $_SESSION['pregunta'].'.- '.$_SESSION['pregunta_texto'];
$texto = str_replace("<br/>"," ",$texto);
$texto = str_replace("<br />"," ",$texto);
// $texto = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non nunc lectus. Curabitur hendrerit bibendum enim dignissim tempus. Suspendisse non ipsum auctor metus consectetur eleifend. Fusce cursus ullamcorper sem nec ultricies. Aliquam erat volutpat. Vivamus massa justo, pharetra et sodales quis, rhoncus in ligula. Integer dolor velit, ultrices in iaculis nec, viverra ut nunc.';

$lineas = explode('|', wordwrap($texto, $fuente_caracteres_por_linea, '|')); // dividir en lineas

// $font_color =  0x000000

// Añadir algo de sombra al texto
// imagettftext($im, 20, 0, 11, 21, $gris, $fuente, $texto);

// Añadir el texto

// Loop through the lines and place them on the image
foreach ($lineas as $linea)
{
    imagettftext($im, $fuente_size, 0, 10, $base_comienzo, $blanco, $fuente, $linea);

    $base_comienzo += $fuente_interlineado;
}
// imagettftext($im, 20, 0, 10, 20, $blanco, $fuente, $texto);

// Usar imagepng() resultará en un texto más claro comparado con imagejpeg()
imagepng($im);
imagedestroy($im);
?>
