<?php

class generaLista {

function generaLista() {

	require_once ("clase.conexion.php");
	$this->conexion = new conexionMYSQL;
	$this->conexion->conectar();

}

function listaPreguntas($tematica){

	$sql = "SELECT * FROM preguntas";
	if (isset($tematica) && $tematica != 0 && $tematica != null) {
		$sql .= " WHERE tematica = ".$tematica;
	}
	$sql .= " ORDER BY id";
	$resultados = $this->conexion->matrizResultados($sql);
	return $resultados;
}

function listaDudas($usuario){

	$sql = "SELECT preguntas.id, preguntas.codigo, tematica, preguntas.pregunta, correcta, explicacion, texto FROM dudas INNER JOIN preguntas ON dudas.pregunta = preguntas.id WHERE usuario =".$usuario." ORDER BY preguntas.id";
	$resultados = $this->conexion->matrizResultados($sql);
	
	return $resultados;
}

function listaTematicas(){

	$sql = "SELECT * FROM tematicas";
	$sql .= " ORDER BY id";
	$tematicas = $this->conexion->matrizResultados($sql);
	for ($j=0; $j<=count($tematicas)-1; $j++) {
		$sql = "SELECT COUNT(id) FROM preguntas WHERE tematica = ".$tematicas[$j][0];
		$resultados = $this->conexion->matrizResultados($sql);
		$tematicas[$j][3] = $resultados[0][0];
	}		
	return $tematicas;
}

function listaUsuarios(){

	$sql = "SELECT * FROM usuarios WHERE id>=1 ORDER BY id";
	$resultados = $this->conexion->matrizResultados($sql);
	
	return $resultados;
}

}

?>
