<?php
$basedatos = 'aprueba';
$servidor = 'localhost';
$usuario = 'aprueba';
$clave = 'aprueba';

$separador = ';';

$tematica = $_GET['tematica'];

	$link = mysql_connect($servidor, $usuario, $clave) or die("Can not connect." . mysql_error());
	mysql_select_db($basedatos, $link) or die("Can not connect.");

	$select = "SELECT * FROM preguntas WHERE tematica=".$tematica;

	$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );

	$fields = mysql_num_fields ( $export );

	for ( $i = 0; $i < $fields; $i++ )
	{
		$header .= mysql_field_name( $export , $i ) . $separador;
	}

	while( $row = mysql_fetch_row( $export ) )
	{
		$line = '';
		foreach( $row as $value )
		{                                            
			if ( ( !isset( $value ) ) || ( $value == "" ) )
			{
				$value = $separador;
			}
			else
			{
				$value = str_replace( '"' , '""' , $value );
				$value = '"' . $value . '"' . $separador;
			}
			$line .= $value;
		}
		$data .= trim( $line ) . "\n";
	}
	$data = str_replace( "\r" , "" , $data );

	if ( $data == "" )
	{
		$data = "\n(0) Records Found!\n";                        
	}

	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=preguntas.".$tematica.".csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$data";

	
?>
