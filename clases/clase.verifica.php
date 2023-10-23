<?php

class verifica {

var $id;

function verifica() {

	require_once ("clase.conexion.php");
	$this->conexion = new conexionMYSQL;
	$this->conexion->conectar();
}

function limpiar($texto){

	$texto = str_replace("<br/>"," ",$texto);
	$texto = str_replace("<br />"," ",$texto);
	return $texto;
}

function valido($cadena, $validos){

	$vale = true;
	for ($i=0; $i < strlen($cadena); $i++) {
		if (strchr($validos, $cadena[$i]) == false) {
			$vale = false;
		}
	}
	return $vale;
}

function validoTexto($cadena){

	$validos = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_?.,;:@ '; //ªºáéíóúÁÉÍÓÚñÑ¿; ()/';
	$especiales = chr(225).chr(233).chr(237).chr(243).chr(250).chr(241).chr(209); // áéíóúñÑ
	$validos = $validos.$especiales;
	// echo $validos.$cadena;
	return $this->valido($cadena, $validos);
}

}

?>
