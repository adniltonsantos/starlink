<?php 

if(isset($_GET['pg'])){

switch($_GET['pg']){
		
		//Clientes
		case'clientes-correcao';
		include "nav/clientes-correcao.php";
		break;

		//Fluxo de Caixa
		case'fluxo-caixa';
		include "nav/fluxo-caixa.php";
		break;

		//Estoque - Cadastrar
		case'inseri-estoque';
		include "nav/inseri-estoque.php";
		break;

		//Estoque - Cadastrar
		case'retirada-estoque';
		include "nav/retirada-estoque.php";
		break;

		//Estoque - Consulte
		case'estoque-by-tecnico';
		include "nav/estoque-by-tecnico.php";
		break;

		//Estoque - Consulte
		case'consulte-estoque';
		include "nav/consulte-estoque.php";
		break;
		

		//Item - Cadastrar
		case'inseri-item';
		include "nav/inseri-item.php";
		break;

		//Item - Update
		case'update-item';
		include "nav/update-item.php";
		break;
    //Item - Consultar
		case'consulte-item';
		include "nav/consulte-item.php";
		break;
		
		//Loja > Cadastrar Produto
		case'inseri-produto';
		include "nav/inseri-produto.php";
		break;
		
		//Fornecedora > Inseri Fornecedora
		case'inseri-fornecedora';
		include "nav/inseri-fornecedora.php";
		break;

		//Fornecedora > Update Fornecedora
		case'update-fornecedora';
		include "nav/update-fornecedora.php";
		break;

		//Fornecedora > Inseri Fornecedora
		case'relatorio-fornecedora';
		include "nav/relatorio-fornecedora.php";
		break;

		//Pedido > Inseri Pedido
		case'inseri-pedido';
		include "nav/inseri-pedido.php";
		break;

		//Tecnico > Inseri Tecnico
		case'inseri-tecnico';
		include "nav/inseri-tecnico.php";
		break;

		//tecnico > Update
		case'update-tecnico';
		include "nav/update-tecnico.php";
		break;

		//tecnico > Relatorio Ativo
		case'relatorio-tecnico-ativos';
		include "nav/relatorio-tecnico-ativos.php";
		break;

		//tecnico > Relatorio Inativo
		case'relatorio-tecnico-inativos';
		include "nav/relatorio-tecnico-inativos.php";
		break;

	    //tecnico > Detalhes
		case'detail-tecnico';
		include "nav/detail-tecnico.php";
		break;

		//Despesa > Inseri Tipo Despesa
		case'inseri-despesa';
		include "nav/inseri-despesa.php";
		break;
		
		case'despesas-futuras';
		include "nav/despesas-futuras.php";
		break;

		case'detail-pag';
		include "nav/detail-pag.php";
		break;

		case'detail-compras';
		include "nav/detail-compras.php";
		break;

		case'inseri-tipo-despesa';
		include "nav/inseri-tipo-despesa.php";
		break;

		//Perfil
		case'perfil';
		include "nav/perfil.php";
		break;

		//Import XLS
		case'import-xls';
		include "nav/import-xls.php";
		break;

		//Import XLS
		case'import-validar';
		include "nav/import-validar.php";
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