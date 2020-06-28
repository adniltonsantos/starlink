<?php 

function real($var){

	$real = number_format($var, 2,',','.');
	return $real;
}

function dolar($var){

$valor = str_replace("." , "" , $var ); // Primeiro tira os pontos
$valor = str_replace("," , "." , $valor); // Depois tira a vírgula

return (float) $valor;

}

function selected( $value, $selected ){
    return $value==$selected ? ' selected="selected"' : '';
}

?>