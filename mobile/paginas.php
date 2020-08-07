<?php 

if(isset($_GET['pg'])){

switch($_GET['pg']){

		case'producao';
		include "nav/producao.php";
		break;

		//Import XLS
		case'import-consulta';
		include "nav/import-consulta.php";
		break;	

		default:
		include ("home.php");
		break;

}
}else{

		include("nav/principal.php");



}