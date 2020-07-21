<?php 
include require_once "config.php"; $pdo = conectar();
// transformar em Real
function real($var){

	$real = number_format($var, 2,',','.');
	return $real;
}

// transformar em Dolar
function dolar($var){

$valor = str_replace("." , "" , $var ); // Primeiro tira os pontos
$valor = str_replace("," , "." , $valor); // Depois tira a vírgula

return (float) $valor;

}

// Mantem selecionado o valor já inserido. 
function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
}

// Data no formato d/m/YYYY

function dataBR( $data ){
	 $dataBR = str_replace("/", "-", $data);
	return date('d/m/Y', strtotime($dataBR));
}

// Soma total Agendar

?>