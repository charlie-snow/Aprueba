<?php

class importador {

var $codigo;
var $tematica;
var $formato;

var $texto;

var $array_preguntas;  // paso intermedio, un array de preguntas en crudo
var $preguntas;

var $respuestas;
var $array_respuestas; // se usa para los formatos que tienen las respuestas separadas al final

var $separador_preguntas;
var $separador_respuestas;
var $separador_opciones;
var $fin_de_opcion;

var $saltodelinea = "\n";

							// Formato C
var $separador_preguntas_c = ".-";
var $separador_respuestas_c = ".-";
var $separador_opciones_c = ")";
var $fin_de_opcion_c = ".";

var $separador_opciones_cod = "((-))";
var $separador_respuestas_cod = ".-";
var $prefijo_respuestas = "";

							// Formato av
var $separador_preguntas_av = ".-";
var $separador_opciones_av = ")";
var $fin_de_opcion_av = ".";


function importador() {

	require_once ("clase.conexion.php");
	$this->conexion = new conexionMYSQL;
	$this->conexion->conectar();
}

function setPreguntas ($preguntas) { //??
	
	$this->preguntas = $preguntas;	
	
}

function extraerPreguntasTexto () {
	// Se procesa según el formato

	// echo "<PRE>texto.. ";print_r($this->texto);echo "</PRE>";

	switch ($this->formato) {
		case 'C':

			// define los separadores del formato C
				$separador = "----x----";
				$prefijo_respuestas = "";
				$this->separador_preguntas = $this->separador_preguntas_c;
				$this->separador_respuestas = $this->separador_respuestas_c;
				$this->separador_opciones = $this->separador_opciones_c;
				$this->fin_de_opcion = $this->fin_de_opcion_c;

			// - SEPARA EL TEXTO FORMATO C POR EL SEPARADOR ---x--- EN PREGUNTAS Y RESPUESTAS
			$preguntasyrespuestas = explode($separador, $this->texto);

				// 1- preguntas
					$preguntas = $preguntasyrespuestas[1];
					$this->array_preguntas = explode($this->separador_preguntas, $preguntas); // separa todas las preguntas por el separador .- en un array

				// 2- respuestas
					$this->respuestas = $preguntasyrespuestas[2];
					// quito el prefijo de los números de las repspuestas (trelles tiene R23: )
					$this->respuestas = str_replace( $this->prefijo_respuestas, "", $this->respuestas);
					$this->array_respuestas = explode($this->separador_respuestas, $this->respuestas); // separa todas las preguntas por el separador .- en un array
			break;

		case 'av': // tiene las preguntas y las respuestas en el mismo bloque de texto

			// define los separadores del formato av
			$this->separador_preguntas = $this->separador_preguntas_av;
			$this->separador_opciones = $this->separador_opciones_av;
			$this->fin_de_opcion = $this->fin_de_opcion_av;

			// - preguntas-respuestas
				$this->array_preguntas = explode($this->separador_preguntas, $this->texto); // separa todas las preguntas por el separador .- en un array
			break;

	}

	echo "<PRE>array_preguntas..";print_r($this->array_preguntas);echo "</PRE>";

	$this->formatearPreguntas();
}

function formatearPreguntas () {

	$pregunta = Array();

	for ($i=0; $i<count($this->array_preguntas)-1; $i++) {		// recorre todos los eltos de preguntas
		$n = $this->ultimo_numero($this->array_preguntas[$i]);	// el número externo de la pregunta es el último número del texto anterior a la pregunta en si (antes del .-)
		$pregunta['numero'] = $n;
		$pregunta['codigo'] = $this->codigo.".".$n;
		$pregunta['tematica'] = $this->tematica;
		$array_opciones = Array();

		// el texto que contiene la pregunta (entre un .- y otro), se trocea por ), y tenemos un array con la pregunta y después las opciones
		$array_pregunta_troceada = explode($this->separador_opciones, $this->array_preguntas[$i+1]);

		// en el primer elemento del array tenemos el texto de la pregunta, y al final el identificativo de la primera opción ('a' o 'av')
		$opcion = $this->ultima_palabra($array_pregunta_troceada[0]);
		$pregunta['pregunta'] = $this->sin_ultima_palabra($array_pregunta_troceada[0]);
		$pregunta['explicacion'] = "";	// según el formato, habrá explicación o no, aquí se inicializa
		$pregunta['correcta'] = 0;
		
		// echo "<PRE>pregunta troceada..";print_r($array_pregunta_troceada);echo "</PRE>";

		for ($j=1; $j<count($array_pregunta_troceada); $j++) {	// recorre el resto de eltos del array de preguna troceada, que son las opciones

			// en el texto de esta pregunta se cuela al final el identificativo de la siguiente opcion ('b')
			$opcion_sig = $this->ultima_palabra($array_pregunta_troceada[$j]);
			$texto_opcion = $this->antes_del_punto($array_pregunta_troceada[$j]);

			if ($this->formato == 'av') {	// si el identificativo es 'av', esa es la op verdadera
				if (substr($opcion, -1) == 'v') {
					$pregunta['correcta'] = $j;
				}
			}
			$opcion = $opcion_sig;	// se le manda el identificativo de la opcion a la siguiente iteración
			
			// $explode = explode($this->fin_de_opcion, $texto_opcion); // se le quita lo que precede al .

			// $end = '';
			// $begin = '';
			// if(count($explode) > 0){
			//     $end = array_pop($explode); // removes the last element, and returns it
			//     if(count($explode) > 0){
			//         $begin = implode('.', $explode); // glue the remaining pieces back together
			//     }
			// }
			// $quitapunto = $begin;

			$quitapunto = $texto_opcion;

			$pregunta['opcion'.$j] = $quitapunto;	// el texto de la opción ya limpio, se mete como opción n en pregunta
		}

//$_SESSION['error'] .= "<PRE>Insertando: pregunta entra en el array..";$_SESSION['error'] .= print_r($pregunta, true);$_SESSION['error'] .= "</PRE>";

		$this->preguntas[$i] = $pregunta;	// se van acumulando las preguntas formateadas en this->preguntas, con sus opciones
		$pregunta = Array();
	}

	if ($this->formato == 'C') {	// si es formato 'C', el segundo bloque incluye las respuestas y explicaciones

$_SESSION['error'] .= "<PRE>Insertando: array_respuestas crudo..";$_SESSION['error'] .= print_r($this->array_respuestas, true);$_SESSION['error'] .= "</PRE>";

		for ($i=0; $i<count($this->array_respuestas)-1; $i++) { // recorre las respuestas, recoge la correcta y la explicacion, y las inserta en la pregunta correcta de preguntas. -1 para que no busque el número en el elemento fina, que solo tiene respuesta
			$numero = $this->ultimo_numero($this->array_respuestas[$i]); // recoge el número de pregunta del elemento actual del array
			$array_respuesta_troceada = explode(' ', $this->array_respuestas[$i+1]); // el elemento siguiente lo trocea por los espacios, con lo que nos quedan separados la respuesta correcta, la explicación y el número de pregunta siguiente

//$_SESSION['error'] .= "<PRE>Insertando: array_respuesta_troceada..";$_SESSION['error'] .= print_r($array_respuesta_troceada, true);$_SESSION['error'] .= "</PRE>";

			if ($array_respuesta_troceada) { // si lo troceó, le quita los elementos que son espacios, y nos queda la correcta en el primero, y la explicación en el segundo: 
				$array_respuesta_troceada = array_merge(array_filter($array_respuesta_troceada));
				$correcta = $array_respuesta_troceada[0];
				$explicacion = $array_respuesta_troceada[1];
				// echo $explode2;
			} else {
				// $correcta = $explode[1][0];
				// echo $explode;
			}
			
			$correcta = str_replace(' ', '', $correcta);	// se le quitan los posibles espacios
			$correcta = str_replace(')', '', $correcta);	// se le quita el paréntesis si tiene
			$correcta = ord(strtoupper($correcta)) - ord('A') + 1; // se pasa de letra a número c 3
			$id = null;
			$id = $this->buscar($this->preguntas, $numero);  // busca en preguntas si tenemos una pregunta con ese número
				
//$_SESSION['error'] .= "<PRE>Insertando: id..";$_SESSION['error'] .= $id."correcta:".$correcta;$_SESSION['error'] .= "</PRE>";

			if ($id == 0 || $id != null) { // si es la primera pregunta, o ya la localizamos, insertamos la correcta y la explicación ahí
				$this->preguntas[$id]['correcta'] = $correcta;
				if (strlen($explicacion) > 7) {
					$this->preguntas[$id]['explicacion'] = $explicacion;
				} else {
					$this->preguntas[$id]['explicacion'] = "";
				}	
			}
		}
	}

// $_SESSION['error'] .= "<PRE>Insertando: preguntas procesado..";$_SESSION['error'] .= print_r($this->preguntas, true);$_SESSION['error'] .= "</PRE>";

	// Resultado: en this->preguntas están todas con correcta, explicacion, tematica, numero, codigo, pregunta y opciones
}

function insertarPreguntas (){ // this->preguntas tendrá este formato: [1..]['correcta'], [1..]['pregunta']...
$_SESSION['error'] .= "<PRE>Insertando: preguntas para insertar(si ya existe)..";$_SESSION['error'] .= print_r($this->preguntas, true);$_SESSION['error'] .= "</PRE>";

	require_once ("clase.pregunta.php");
	$pregunta = new pregunta;

	for ($i=0; $i<count($this->preguntas); $i++) {

		$pregunta->texto_pregunta = $this->preguntas[$i]['pregunta'];
		if (!empty($pregunta->texto_pregunta) && !ctype_space($pregunta->texto_pregunta)) {
			$pregunta->codigo = $this->preguntas[$i]['codigo'];
			$pregunta->tematica = $this->preguntas[$i]['tematica'];
			$pregunta->explicacion = $this->preguntas[$i]['explicacion'];
			$opciones[] = Array();
			if (!$pregunta->existe()) {
				$pregunta->correcta = $this->preguntas[$i]['correcta'];
				for ($j=1; $j<count($this->preguntas[$i]); $j++) {
					if (isset($this->preguntas[$i]['opcion'.$j]) && $this->preguntas[$i]['opcion'.$j] != '') {
					array_push($opciones, $this->preguntas[$i]['opcion'.$j]);
					}
				}
				$pregunta->opciones = $opciones;

/*$_SESSION['error'] .= "<PRE>Insertando: pregunta para insertar..";$_SESSION['error'] .= print_r($pregunta, true);$_SESSION['error'] .= "</PRE>";*/

				$pregunta->insertar();
			}
			unset($opciones);
		}
	}
	
}

function ultimo_numero ($cadena) {
	$palabras = explode(".", $cadena);
	echo "<PRE>palabras..";print_r($palabras);echo "</PRE>";
	$palabra = $palabras[count($palabras)-1];
	
	$palabra = preg_replace("[^0-9]", "", $palabra);
	$palabra = preg_replace("/\s+/", "", $palabra);
	
	return $palabra;	
}

function primera_letra ($cadena) {
	
	$cadena = preg_replace("[^a-zA-Z]", "", $cadena);
	$letra = $cadena[0];
	return $letra;	
}

function sin_ultima_letra ($cadena) {
	$cadena = substr($cadena, 0, strlen($cadena)-1);
	return $cadena;
}

function ultima_palabra ($cadena) {
	$explode = explode(' ', $cadena);
	$cadena = array_pop($explode);
	return $cadena;
}

function sin_ultima_palabra ($cadena) {
	$explode = explode(' ', $cadena);
	array_pop($explode);
	$cadena = implode(' ', $explode);
	return $cadena;
}

function antes_del_punto ($cadena) {
	$explode = explode('.', $cadena);
	array_pop($explode);
	$cadena = implode(' ', $explode);
	return $cadena;
}



function buscar ($preguntas, $n) {
	$id = null;
	$i=0;
	while ($i<count($preguntas)-1 && $preguntas[$i]['numero'] != $n) {
		$i++;
	}
	if ((int)$preguntas[$i]['numero'] == (int)$n) {
		$id = $i;
	}
	return $id;
}

function limpiar($texto){ // limpia solo brs

	$texto = str_replace("<br/>"," ",$texto);
	$texto = str_replace("<br />"," ",$texto);
	return $texto;
}

}

?>
