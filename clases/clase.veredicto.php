<?php

class veredicto {

var $total;

var $aciertos = 0;
var $errores = 0;
var $enblanco = 0;

var $aciertox100;
var $errorx100;
var $enblancox100;

var $resultado3menos1;

var $respuestas;

var $preguntaYrespuestas;

function veredicto($test) { // recupera las respuestas de las preguntas de dicho test. los datos básicos para hacer una estadística simple

	$this->test = $test;
	require_once ("clase.conexion.php");
	$this->conexion = new conexionMYSQL;
	$this->conexion->conectar();
	
	$sql = "SELECT * FROM respuestas WHERE test='".$test."'";
	$this->respuestas = $this->conexion->matrizResultados($sql);
	
	$_SESSION['error'] .=  "sql: ".$sql."<br>";
	$_SESSION['error'] .=  "test: <PRE>".print_r($this->respuestas, true)."</PRE>";

	$this->total = count($this->respuestas) ;
	for ($i=0; $i<$this->total; $i++) {

		switch ($this->respuestas[$i][5]) {
			case 0:
				$this->errores++;
				break;
			case 1:
				$this->aciertos++;
				break;

			case 3:
				$this->enblanco++;
				break;
		}

	}
	$this->aciertox100 = round(($this->aciertos /$this->total) * 100);
	$this->errorx100 = round(($this->errores /$this->total) * 100);
	$this->enblancox100 = round(($this->enblanco /$this->total) * 100);
	$this->resultado3menos1 = round($this->aciertos-($this->errores/3));
}

function recuperaResultados($nopciones, $usuario) { // a partir de las respuestas anteriores, recupera todos los datos de cada una de las preguntas, para mostrar el test corregido
	
	require_once("clases/clase.pregunta.php");
		
	for ($i=0; $i<$this->total; $i++) {

		switch ($this->respuestas[$i][5]) {
			case 0:
				$this->respuestas[$i]['resultado'] = "error";
				break;
			case 1:
				$this->respuestas[$i]['resultado'] = "acierto";
				break;

			case 3:
				$this->respuestas[$i]['resultado'] = "enblanco";
				break;
		}
		$this->respuestas[$i]['respuesta']=$this->respuestas[$i][4];

		$clasepregunta = new pregunta;
		$clasepregunta->recuperar($this->respuestas[$i][3], $usuario, $nopciones, true);
		// $clasepregunta->recuperarDuda($this->respuestas[$i][1]);
		
		$this->preguntaYrespuestas[$i] = $clasepregunta;
	}
	// echo "<PRE>this->respuestas..";print_r($this->respuestas);echo "</PRE>";
	// echo "<PRE>this->preguntaYrespuestas..";print_r($this->preguntaYrespuestas);echo "</PRE>";
}

/* function recuperaResultados($id_usuario, $id_test) {
	$sql = "SELECT * FROM respuestas WHERE usuario='".$id_usuario."' AND test='".$id_test."'";
	$resultados = $this->conexion->matrizResultados($sql);
	
	echo "<PRE>array_resultados..";print_r($resultados);echo "</PRE>";

} */

}

?>
