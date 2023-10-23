<?php

class estadisticas {

var $bien;
var $mal;
var $total;
var $acierto;
var $error;

var $preguntas;
var $tests;

function estadisticas() {

	require_once ("clase.conexion.php");
	$this->conexion = new conexionMYSQL;
	$this->conexion->conectar();
}

function existe_pregunta($pregunta) {
		if (empty($pregunta) || empty($this->preguntas)) {
		return false;
		}
		
		foreach ($this->preguntas as $key => $value) {
			if (!empty($value['pregunta']) && $value['pregunta'] == $pregunta) {
			$exists = 1;
			} else {
			$exists = 0;
			}
			if ($exists) return $key;
		}
		
		return false;
	}

function existe_test($test) {
	if (empty($test) || empty($this->tests)) {
		return false;
	}
	
	foreach ($this->tests as $key => $value) {
		if ((!empty($value['id']) && $value['id'] == $test)) {
			$exists = 1;
		} else {
			$exists = 0;
		}
		if ($exists) return true;
	}
	
	return false;
}

function procesar($usuario){
	require_once ("clase.pregunta.php");
	$pregunta = new pregunta;

	$sql = "SELECT * FROM respuestas WHERE usuario='".$usuario."'";
	$respuestas = $this->conexion->matrizResultados($sql);
	// print_r($resultados);

	// EVALUAR PREGUNTAS
	$bien = 0;
	$mal = 0;
	$j = -1;
	for ($i=0; $i<=count($respuestas)-1; $i++) {
		if (!$this->existe_pregunta($respuestas[$i][3])) {
			$j++;
			$pregunta->recuperar_sin_opciones($respuestas[$i][3]);
			$this->preguntas[$j]['id'] = $pregunta->id;
			$this->preguntas[$j]['texto'] = $pregunta->texto_pregunta;
			$this->preguntas[$j]['bien'] = 0;
			$this->preguntas[$j]['mal'] = 0;
		}
		
		if ($respuestas[$i][5] == 1) {
			$bien++;
			$this->preguntas[$j]['bien']++;
		} else {
			$mal++;
			$this->preguntas[$j]['mal']++;
		}
	}
	$this->bien = $bien;
	$this->mal = $mal;
	$this->total = count($respuestas) ;
	if ($this->total > 0 ) {
		$this->acierto = round(($this->bien /$this->total) * 100);
		$this->error = round(($this->mal /$this->total) * 100);
	}
	
	// ordenar por las más falladas
	
	$this->preguntas = $this->orderMultiDimensionalArray($this->preguntas, 'mal', true);

	// echo "<PRE>preguntas..";print_r($this->preguntas);echo "</PRE>";

	// EVALUAR LOS TESTS
	$bien = 0;
	$mal = 0;
	$j = -1;
	for ($i=0; $i<=count($respuestas)-1; $i++) {
		if (!$this->existe_test($respuestas[$i][2])) {
			$j++;
			// $test->recuperar_sin_opciones($respuestas[$i][3]);
			$this->tests[$j]['id'] = $respuestas[$i][2];
		}
	}
}

function insertar (){
	$sql = "INSERT INTO usuarios (nombre, nivel, uid_facebook, fecha_ingreso) ";
	$sql .= "VALUES ('".$this->nombre."', '".$this->nivel."', '".$this->uid_facebook."', CURDATE( ))";
	
	$this->conexion->ejecutar($sql);
	// echo $sql;
}

function num_preguntas(){

	$sql = "SELECT * FROM preguntas";
	$resultados = $this->conexion->matrizResultados($sql);
	
	return count($resultados);
}

function ranking(){
	require_once ("clase.generaLista.php");

	$generaLista = new generaLista;
	$usuarios = $generaLista->listaUsuarios(); // usuarios[][0]: id  usuarios[][1]: nombre

	for ($i=0; $i<=count($usuarios)-1; $i++) {
		$this->procesar($usuarios[$i][0]);
		$usuarios[$i]['bien'] = $this->bien; // usuarios[][2]: bien
		$usuarios[$i]['mal'] = $this->mal; // usuarios[][3]: mal
		if ($this->bien > 0 && $this->mal > 0) {
			$usuarios[$i]['acierto'] = $this->acierto; // usuarios[][4]: acierto
			$usuarios[$i]['error'] = $this->error; // usuarios[][5]: error
		} else {
			$usuarios[$i]['acierto'] = 0; // usuarios[][4]: acierto
			$usuarios[$i]['error'] = 0; // usuarios[][5]: error
		}
		
	}
	$usuarios = $this->orderMultiDimensionalArray($usuarios, 'acierto', true);
	// echo "<PRE>usuarios..";print_r($usuarios);echo "</PRE>";
	return $usuarios;
}

// pasar a clase externa herramientas pej
function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
    $position = array();   
    $newRow = array();   
    foreach ($toOrderArray as $key => $row) {   
            $position[$key]  = $row[$field];   
            $newRow[$key] = $row;   
    }   
    if ($inverse) {   
        arsort($position);   
    }   
    else {   
        asort($position);   
    }   
    $returnArray = array();   
    foreach ($position as $key => $pos) {        
        $returnArray[] = $newRow[$key];   
    }   
    return $returnArray;   
}  

}

?>
