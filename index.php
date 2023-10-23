<?php
	header ('Content-Type: text/html; charset=utf-8');
	 error_reporting(E_ALL);
	 ini_set('display_errors', '1');
	session_start();

	require_once("clases/clase.test.php");
	require_once("clases/clase.pregunta.php");
	require_once("clases/clase.conexion.php");
	
	if(!isset($_SESSION['usuario_id'])){ 	header("location:login.form.php"); }

   	if(!isset($_SESSION['error'])){ 		$_SESSION["error"] = ""; }

   	if(!isset($_SESSION['mensaje_error'])){ 	$_SESSION["mensaje_error"] = ""; }

	if(!isset($_SESSION['test_id'])){ 		$_SESSION["test_id"] = 0; } // si la intento recuperar del objeto serializado test, no funciona, sale vacío

	if(!isset($_SESSION['volver'])){ 	$_SESSION["volver"] = ""; }

	$_SESSION['opciones'] = 10; // son las que permite la bd como está	
	$_SESSION['npreguntas'] = 50;	
?>

<html>
<head>
	<title>ApruebA</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="tati" />
	<meta name="copyright" content="101 design &copy; 2005" />
	<meta name="description" content="" />
	<meta name="keywords" content="aprueba" />

	<meta name="MSSmartTagsPreventParsing" content="TRUE" />
	<meta name="generator" content="aprueba" />
	
	<meta name="viewport" content="width=400"> 
	
	<?php include "estilos/estilos-links.php"; ?>
</head>
<body bgcolor="#DCDCDC">

<!-- alinear -->
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor=#F0FFF0>
<tr valign="top">
	<td align="center" valign="middle">
<!-- -->

	<?php include ("seccion.web.php"); ?>

<!-- -->
	</td>
</tr>
</table>

</body>
</html>
