<?php

class test {

var $id;
var $tematicas;
var $texto_tematicas;
public $npregunta;	// en que pregunta vamos
var $npreguntas; // num de preguntas

var $pregunta;

function test() {

	require_once ("clase.conexion.php");
	$this->conexion = new conexionMYSQL;
	$this->conexion->conectar();
}

function preguntaAleatoria($nopciones, $id_usuario){

	if ($this->npregunta > $this->npreguntas) { 	// si ya se acabó el test, devuelve falso
		return false; 
	} else {									// si no, recupera una pregunta de las tematicas del test

		if ($this->npregunta == 1) { // si es la primera pregunta, le asigna al test un número de id consecutivo
			$this->id = $this->sigTest();
		}
		$sql = "SELECT id FROM preguntas WHERE ";
		
		$array_tematicas = explode(',', $this->tematicas);
		for ($i=0; $i<count($array_tematicas); $i++) { $sql .= " tematica='".$array_tematicas[$i]."' OR "; }
		$sql = substr($sql, 0, strlen($sql)-4);
		$sql .= " AND correcta <> 0"; // y que tengan la solución

		$resultados = $this->conexion->matrizResultados($sql);
		$numero_aleatorio=mt_rand(0, count($resultados)-1);

		require_once ("clase.pregunta.php");
		$this->pregunta = new pregunta;
		$this->pregunta->recuperar($resultados[$numero_aleatorio][0], $id_usuario, $nopciones, false);
		return true;
	}
	
}

function sigTest() {
	$sql = "SELECT MAX(test) from respuestas";
	$resultados = $this->conexion->matrizResultados($sql);
	return $resultados[0][0]+1;
}

function insertaRespuesta($id_usuario, $id_test, $id_pregunta, $respuesta, $bien) {
	
	$sql = "INSERT INTO respuestas";
	$sql .= " (usuario, test, pregunta, opcion, bien, explicacion, fecha) ";
	$sql .= "VALUES (".$id_usuario.", ".$id_test.", ".$id_pregunta.", ".$respuesta.", ".$bien.", '', CURDATE())";

	$_SESSION['error'] .= $sql;
	
	$this->conexion->matrizResultados($sql);
}

}

?>
