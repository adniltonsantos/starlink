<?php 

function conectar(){

try{
$pdo=new PDO ("mysql:host=localhost;dbname=starlink;charset=utf8","adnilton","md98yp121556");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch (PDOexception $e){
	echo $e ->getMessage();
}

return $pdo;
	
}

?>