<?php

class tematica {

var $id;
var $tematica;
var $activa;

var $npreguntas;

var $error_invalido = "El nombre de la temática es inválido, inténtalo sin usar caracteres especiales";
var $error_conpreguntas = "Temática no eliminada: Para poder eliminarla tiene que estar vacía. Vacíala y vuelve a intentarlo. (de clase)";

function tematica() {

	require_once ("clase.conexion.php");
	$this->conexion = new conexionMYSQL;
	$this->conexion->conectar();

	require_once ("clase.verifica.php");
	$this->verifica = new verifica;
}

function insertar (){

	$sql = "INSERT INTO tematicas (nombre) ";
	$sql .= "VALUES ('".$this->nombre."')";
	if ($this->valido()) {
		$this->conexion->ejecutar($sql);
		// echo $sql;
		return "";
	} else {
		return $this->error_invalido;
	}
}

function eliminar($id){

	$sql = "DELETE FROM tematicas WHERE id = '".$id."'";
	if (!$this->conpreguntas($id)) {
		$this->conexion->ejecutar($sql);
		// echo $sql;
		return "";
	} else {
		return $this->conpreguntas;
	}
}

function actualizar($id){

	$sql = "UPDATE tematicas SET nombre='".$this->nombre."'";
	$sql .= " WHERE id='".$id."'";
	$this->conexion->ejecutar($sql);
}

function recuperar($id){
	
	$sql = "SELECT * FROM tematicas WHERE id='".$id."'";
	$resultados = $this->conexion->matrizResultados($sql);
	$this->id = $resultados[0][0];
	$this->tematica = $resultados[0][1];
	$this->activa = $resultados[0][2];
}

function existe(){
	$existe = 0;
	$sql = "SELECT id from tematicas WHERE uid_facebook = '".$this->uid_facebook."'";
	// echo $sql;
	$resultados = $this->conexion->matrizResultados($sql);
	if (count($resultados) > 0) {
		$existe = 1;
	} else {
		$existe = 0;
	}
	return $existe;
}

function get_datos(){
	
	$sql = "SELECT id, nombre, password, nivel, visitas FROM tematicas WHERE id='".$this->id."'";
	$resultados = $this->conexion->matrizResultados($sql);
	$this->id = $resultados[0][0];
	$this->nombre = $resultados[0][1];
	$this->password = $resultados[0][2];
	$this->nivel = $resultados[0][3];
	$this->visitas = $resultados[0][4];
}

function get_datos_nombre(){
	
	$sql = "SELECT id, nombre, password, nivel, visitas FROM tematicas WHERE nombre='".$this->nombre."'";
	$resultados = $this->conexion->matrizResultados($sql);
	$this->id = $resultados[0][0];
	$this->nombre = $resultados[0][1];
	$this->password = $resultados[0][2];
	$this->nivel = $resultados[0][3];
	$this->visitas = $resultados[0][4];
}

function nueva_visita(){
	$visitas = $this->visitas+1;
	$sql = "UPDATE tematicas SET visitas='".$visitas."'";
	$sql .= " WHERE id='".$this->id."'";
	$this->conexion->ejecutar($sql);
}

function acceso_permitido($nombre, $password){
	$acceso = 0;
	$sql = "SELECT password from tematicas WHERE nombre = '".$nombre."'";
	// echo $sql;
	$resultados = $this->conexion->matrizResultados($sql);
	if ($resultados[0][0] == $password) {
		$acceso = 1;
	} else {
		$acceso = 0;
	}
	return $acceso;
}

function activar($id, $activa){
	$activar = 0;
	if ($activa == 0) { $activar = 1; }
	$sql = "UPDATE tematicas SET activa='".$activar."'";
	$sql .= " WHERE id='".$id."'";
	$this->conexion->ejecutar($sql);
}

function conpreguntas($id){

	$conpreguntas = 0;
	$sql = "SELECT id from preguntas WHERE tematica = '".$id."'";
	// echo $sql;
	$resultados = $this->conexion->matrizResultados($sql);
	if (count($resultados) > 0) {
		$conpreguntas = 1;
	} else {
		$conpreguntas = 0;
	}
	echo "conpreguntas= ".$conpreguntas;
	return intval($conpreguntas);
}

function valido(){

	$valido = 0;
	
	$valido = $this->verifica->validoTexto($this->nombre);
	
	// echo "valido= ".$valido;
	return intval($valido);
}

}

?>
