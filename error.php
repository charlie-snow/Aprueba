<?php

$volver = "index.php";
if (isset($_SESSION['volver'])) {
	$volver = $_SESSION['volver'];
	$_SESSION['volver'] = "";
}

$error = "error indefinido";
if (isset($_SESSION['mensaje_error'])) {
	$error = $_SESSION['mensaje_error'];
	$_SESSION['mensaje_error'] = "";
}

echo $error;
?>
<table width="200" align="center" class="menu">
<tr>
	<td align="center">
	<a href='<?php echo $volver ?>'>Volver</a>
	</td>
</tr>
</table>
