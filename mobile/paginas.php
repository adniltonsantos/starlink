<?php 

if(isset($_GET['pg'])){

switch($_GET['pg']){

		case'producao';
		include "nav/producao.php";
		break;

		default:
		include ("home.php");
		break;

}
}else{

		include("nav/principal.php");



}