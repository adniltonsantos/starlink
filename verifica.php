<?php

include "../config.php";

$usuario = $_COOKIE["usuario"];
$senha = $_COOKIE["senha"];

$confirmacao = mysql_query("SELECT * FROM usuarios WHERE usuario ='$usuario' AND senha = '$senha'");

$contagem = mysql_num_rows($confirmacao);
?>