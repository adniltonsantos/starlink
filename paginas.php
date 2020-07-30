<?php 

if(isset($_GET['pg'])){

switch($_GET['pg']){

	// SETOR DE VENDAS

	case'cliente-sem-contato-vendas';
	include "nav/vendas/cliente-sem-contato-vendas.php";
	break;

	case'cliente-cancelou-vendas';
	include "nav/vendas/cliente-cancelou-vendas.php";
	break;
	// SETOR ATENDIMENTO

		
		case'cliente-inseri-transf';
		include "nav/atendimento/cliente-inseri-transf.php";
		break;

	// SETOR DE AGENDAMENTO
		case'cliente-pesquisa';
		include "nav/agendamento/cliente-pesquisa.php";
		break;

		case'cliente-agendar';
		include "nav/agendamento/cliente-agendar.php";
		break;

		case'cliente-agendar-setor01';
		include "nav/agendamento/cliente-agendar-setor01.php";
		break;

		case'cliente-agendar-setor02';
		include "nav/agendamento/cliente-agendar-setor02.php";
		break;	
		
		case'cliente-agendar-setor03';
		include "nav/agendamento/cliente-agendar-setor03.php";
		break;

		case'cliente-agendar-bairro';
		include "nav/agendamento/cliente-agendar-by-bairro.php";
		break;

		case'cliente-transferencia';
		include "nav/agendamento/cliente-transferencia.php";
		break;
	
		case'cliente-sem-contato';
		include "nav/agendamento/cliente-sem-contato.php";
		break;
		//Clientes
		case'cliente-whats';
		include "nav/agendamento/cliente-whats.php";
		break;

		case'cliente-by-agendamento';
		include "nav/agendamento/cliente-by-agendamento.php";
		break;
		







		//Producao - Terceiros
		case'producao-terceiros';
		include "nav/producao-terceiros.php";
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

	// GERENTE DE AGENDAMENTO

		case'agendamento-dashboard';
		include "nav/gerente-agendamento/agendamento-dashboard.php";
		break;

		case'clientes-correcao';
		include "nav/gerente-agendamento/clientes-correcao.php";
		break;

		case'clientes-agendar';
		include "nav/gerente-agendamento/clientes-agendar.php";
		break;

		case'clientes-by-agendamento';
		include "nav/gerente-agendamento/clientes-by-agendamento.php";
		break;

		case'clientes-by-tecnicos-today';
		include "nav/gerente-agendamento/clientes-by-tecnicos-today.php";
		break;

		case'clientes-by-tecnicos-all';
		include "nav/gerente-agendamento/clientes-by-tecnicos-all.php";
		break;

		case'clientes-by-tecnicos-by';
		include "nav/gerente-agendamento/clientes-by-tecnicos-by.php";
		break;

		case'clientes-rede';
		include "nav/gerente-agendamento/clientes-rede.php";
		break;

		case'clientes-rc';
		include "nav/gerente-agendamento/clientes-rc.php";
		break;

		case'clientes-indis';
		include "nav/gerente-agendamento/clientes-indis.php";
		break;

		case'clientes-infra';
		include "nav/gerente-agendamento/clientes-infra.php";
		break;


		case'clientes-cto';
		include "nav/gerente-agendamento/clientes-cto.php";
		break;

		case'clientes-reagendar';
		include "nav/gerente-agendamento/clientes-reagendar.php";
		break;

		case'clientes-cancelou';
		include "nav/gerente-agendamento/clientes-cancelou.php";
		break;

		case'clientes-transferencias';
		include "nav/gerente-agendamento/clientes-transferencias.php";
		break;
		//Clientes - Concluido
		case'clientes-concluido-today';
		include "nav/gerente-agendamento/clientes-concluido-today.php";
		break;

		//Clientes - Concluido
		case'clientes-concluido-all';
		include "nav/gerente-agendamento/clientes-concluido-all.php";
		break;

		//Clientes - Concluido
		case'clientes-concluido-tecnico';
		include "nav/gerente-agendamento/clientes-concluido-tecnico.php";
		break;

		case'clientes-pesquisa-geral';
		include "nav/clientes-pesquisa-geral.php";
		break;


		case'clientes-pesquisa-ref';
		include "nav/gerente-agendamento/clientes-pesquisa-ref.php";
		break;

		case'clientes-referencia';
		include "nav/gerente-agendamento/clientes-referencia.php";
		break;
		
		
		//Import XLS
		case'import-xls';
		include "nav/gerente-agendamento/import-xls.php";
		break;

		//Import XLS
		case'import-validar';
		include "nav/gerente-agendamento/import-validar.php";
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