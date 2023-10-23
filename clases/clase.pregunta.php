<?php

class pregunta {

var $id;
var $codigo;
var $tematica;
var $texto_pregunta;
var $correcta;
var $texto_correcta;
var $explicacion;
var $opciones;

var $preguntas;

var $duda;


function pregunta() {

	require_once ("clase.conexion.php");
	$this->conexion = new conexionMYSQL;
	$this->conexion->conectar();
}

function setPreguntas ($preguntas) { //??
	
	$this->preguntas = $preguntas;	
	
}

function insertar (){

	$sql = "SELECT MAX(id) FROM preguntas";
	$resultados = $this->conexion->matrizResultados($sql);
	$max_id=$resultados[0][0];
	$max_id++;
	
	$sql = "INSERT INTO preguntas (id, codigo, tematica, pregunta, correcta, explicacion";
	
	for ($i=1; $i<count($this->opciones); $i++) {
		$sql .= ", opcion".$i;
	}
	
	$sql = $sql.") VALUES (".$max_id.", '".$this->codigo."', '".$this->tematica."', '".$this->texto_pregunta."', '".$this->correcta."', '".$this->explicacion."'";
	
	for ($i=1; $i<count($this->opciones); $i++) {
		$sql .= ", '".$this->opciones[$i]."'";
	}
	$sql .= ")";

	$this->conexion->ejecutar($sql);
	
}

function insertarPreguntas (){ // this->preguntas tendrá este formato: [1..][0]: num correcta [1..][1]:pregunta [1..][2..]: opciones
	for ($i=0; $i<count($this->preguntas); $i++) {
		//$this->pregunta = str_replace("<br/>"," ",$this->preguntas[$i]['pregunta']);
		$this->texto_pregunta = $this->preguntas[$i]['pregunta'];
		$this->codigo = $this->preguntas[$i]['codigo'];
		$this->tematica = $this->preguntas[$i]['tematica'];
		$this->explicacion = $this->preguntas[$i]['explicacion'];
		$opciones[] = Array();
		if (!$this->existe()) {
			// $correcta = 99;
			// if ($this->preguntas[$i][correcta] != null) { $correcta = $this->preguntas[$i][correcta]; }
			$this->correcta = $this->preguntas[$i]['correcta'];
			for ($j=1; $j<count($this->preguntas[$i]); $j++) {
				if (isset($this->preguntas[$i]['opcion'.$j]) && $this->preguntas[$i]['opcion'.$j] != '') {
				array_push($opciones, $this->preguntas[$i]['opcion'.$j]);
				}
			}
			// echo "<PRE>opciones..";print_r($opciones);echo "</PRE>";
			$this->insertar($opciones);
		}
		unset($opciones);
	}
	
}

function eliminar($id){

	// borrar las respuestas que se hayan hecho a esa pregunta
	$sql = "DELETE FROM respuestas WHERE pregunta = '".$id."'";
	$this->conexion->ejecutar($sql);

	// borrar la pregunta
	$sql = "DELETE FROM preguntas WHERE id = '".$id."'";
	$this->conexion->ejecutar($sql);
}

function modificar($id){

	$sql = "UPDATE preguntas SET pregunta='".$this->texto_pregunta."'";
	for ($i=1; $i<=count($this->opciones); $i++) {
		$sql .= ", opcion".$i."='".$this->opciones[$i][1]."'";
	}
	$sql .= " WHERE id=".$id;
	$this->conexion->ejecutar($sql);
}

function recuperar($id, $usuario, $nopciones, $ordenado){
	
	$this->conexion->conectar();
	$sql = "SELECT * FROM preguntas WHERE id='".$id."'";
	$resultados = $this->conexion->matrizResultados($sql);
	$this->id = $resultados[0][0];
	$this->codigo = $resultados[0][1];
	$this->tematica = $resultados[0][2];
	$this->texto_pregunta = $this->limpiar($resultados[0][3]);
	$this->correcta=($resultados[0][4]);
	$this->explicacion = $resultados[0][5];

	$this->texto_correcta = $resultados[0][5+$this->correcta];
	// echo "<PRE>resultados.."; print_r($resultados); echo "</PRE>";

	// RECUPERAMOS LA DUDA SI EXISTIERE
	$this->recuperarDuda($usuario);

	// RECUPERAMOS LAS OPCIONES DE LA PREGUNTA
	$i = 6;
	$opciones = array();
	$nopcion = 1;
	while ($resultados[0][$i] != null) {
		$texto = $this->limpiar($resultados[0][$i]);
		array_push($opciones, array($nopcion, $texto));
		$nopcion++;
		$i++;
	}
	array_reverse($opciones);
	// echo "<PRE>opciones.."; print_r($opciones); echo "</PRE>";

	if (!$ordenado) {								// opciones desordenadas
		shuffle($opciones);
	}

	$this->opciones = $opciones;
	$this->conexion->desconectar();
}

function recuperar_sin_opciones($id){
	
	$sql = "SELECT * FROM preguntas WHERE id='".$id."'";
	$resultados = $this->conexion->matrizResultados($sql);
	$this->id = $resultados[0][0];
	$this->codigo = $resultados[0][1];
	$this->tematica = $resultados[0][2];
	$this->texto_pregunta = $this->limpiar($resultados[0][3]);
	$id_correcta=($resultados[0][4]-1);
}

function ultimaID(){
	$sql = "SELECT MAX(id) from preguntas";
	$resultados = $this->conexion->matrizResultados($sql);
	return $resultados[0][0];
}

function existe(){
	$existe = 0;
	$sql = "SELECT id from preguntas WHERE codigo = '".$this->codigo."'";
	// echo $sql;
	$resultados = $this->conexion->matrizResultados($sql);
	if (count($resultados) > 0) {
		$existe = 1;
	} else {
		$existe = 0;
	}
	return $existe;
}

function sigTest() {
	$sql = "SELECT MAX(test) from respuestas";
	$resultados = $this->conexion->matrizResultados($sql);
	return $resultados[0][0]+1;
}

function asignarTematica ($tematica){
	$sql = "UPDATE `preguntas` SET `tematica` = '".$tematica."' WHERE `tematica` = '9999'";
	
	$this->conexion->ejecutar($sql);
}

function dudar ($usuario, $pregunta, $estado, $texto){

	$sql = "SELECT texto FROM dudas WHERE usuario=".$usuario." AND pregunta=".$pregunta;
	$resultados = $this->conexion->matrizResultados($sql);
	if (!empty($resultados) || mysql_num_rows($resultados)!=0) {
		$sql = "DELETE FROM dudas WHERE usuario=".$usuario." AND pregunta=".$pregunta;
		$this->conexion->ejecutar($sql);
	}

	$sql = "INSERT INTO dudas (usuario, pregunta, estado, texto) ";
	$sql .= "VALUES (".$usuario.", ".$pregunta.", ".$estado.", '".$texto."')";
		
	// echo "<br>Dudar: ".$sql;
	$_SESSION['error'] .= "Dudar: ".$sql;

	$this->conexion->ejecutar($sql);
}

function recuperarDuda ($id_usuario) {

	$sql = "SELECT texto FROM dudas WHERE usuario=".$id_usuario." AND pregunta=".$this->id;
	$resultados = $this->conexion->matrizResultados($sql);

	// echo $sql;

	if (!empty($resultados) || mysql_num_rows($resultados)!=0) {
		$this->duda = $resultados[0][0];
	} else {
		$this->duda = '0';
	}
	
	// return $this->duda;
}

function eliminarDuda($pregunta, $usuario){

	$sql = "DELETE FROM dudas WHERE pregunta = '".$pregunta."' AND usuario = ".$usuario." LIMIT 1";
	$this->conexion->ejecutar($sql);
}

function vaciarTematica($tematica){

	$sql = "SELECT * FROM preguntas";
	$sql .= " WHERE tematica = ".$tematica;
	$sql .= " ORDER BY id";
	$preguntas = $this->conexion->matrizResultados($sql);
	
	for ($j=0; $j<=count($preguntas)-1; $j++) {
		$id = $preguntas[$j][0];
		// borrar las respuestas que se hayan hecho a esa pregunta
		$sql = "DELETE FROM respuestas WHERE pregunta = '".$id."'";
		$this->conexion->ejecutar($sql);
		//echo $sql;
		// borrar la pregunta
		$sql = "DELETE FROM preguntas WHERE id = '".$id."'";
		$this->conexion->ejecutar($sql);
		//echo $sql;
	}	
}

function limpiar($texto){

	$texto = str_replace("<br/>"," ",$texto);
	$texto = str_replace("<br />"," ",$texto);
	return $texto;
}

}

?>
