 <?php require_once "config.php"; $pdo = conectar(); require_once "function.php"; ?> 
 <script LANGUAGE="Javascript">
function FormataReais(fld, milSep, decSep, e) {
 var sep = 0;
 var key = '';
 var i = j = 0;
 var len = len2 = 0;
 var strCheck = '0123456789';
 var aux = aux2 = '';
 var whichCode = (window.Event) ? e.which : e.keyCode;
 if (whichCode == 13) return true;
 key = String.fromCharCode(whichCode);  // Valor para o código da Chave
 if (strCheck.indexOf(key) == -1) return false;  // Chave inválida
 len = fld.value.length;
 for(i = 0; i < len; i++)
 if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
 aux = '';
 for(; i < len; i++)
 if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
 aux += key;
 len = aux.length;
 if (len == 0) fld.value = '';
 if (len == 1) fld.value = '0'+ decSep + '0' + aux;
 if (len == 2) fld.value = '0'+ decSep + aux;
 if (len > 2) {
 aux2 = '';
 for (j = 0, i = len - 3; i >= 0; i--) {
 if (j == 3) {
 aux2 += milSep;
 j = 0;
 }
 aux2 += aux.charAt(i);
 j++;
 }
 fld.value = '';
 len2 = aux2.length;
 for (i = len2 - 1; i >= 0; i--)
 fld.value += aux2.charAt(i);
 fld.value += decSep + aux.substr(len - 2, len);
 }
 return false;
 }
 //Fim da Função FormataReais -->

</script>


<section>
<div id="janela">

<!-- Formulario do envio de codbarra para a venda -->
<form method="POST" name="enviar" id="enviar" action="?pg=venda&registra">

<div class="form-inline">
<div class="form-group">

<input type="number" class="form-control centro-table" name="qtd" style="width:60px;" value="1" >

<div class="input-group">

<?php if (isset($_GET['SemLeitor'])){?>
<span class="input-group-addon"><a href="?pg=venda"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span></a></span>
<select name="codbarra" class="form-control" style="width:653px;" autofocus>
  
  <?php 
  //Pegando todos Produto na loja
  $produto = $pdo->query("SELECT it.*, pro.* FROM item as it , produto as pro WHERE it.id_item=pro.produto_id_item AND pro.qtd > 0 ORDER BY it.nome_item ASC");
  $produto->execute();
  while($linha = $produto->fetch(PDO::FETCH_ASSOC)){
  ?>
  <option value="<?php echo $linha['codbarra_item'];?>"><?php echo $linha['nome_item'];?></option>
  <?php } ?>
</select>

<?php } else { ?>
<span class="input-group-addon"><a href="?pg=venda&SemLeitor"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></span>
<input type="text" class="form-control" style="width:653px;" name="codbarra" autofocus placeholder="Passe o Leitor de Código de Barras">
<?php } ?>

</div>

<button onclick="return validar();" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>

</div>
</div>

</form>
<!-- END do Formulario do envio de codbarra para a venda -->

<!-- Registro de Venda / Dados vindo do Formulario de cima -->
<?php 

if (isset($_GET['registra'])){

//Pega dados do formulario
$qtd = $_POST['qtd'];
$codbarra = $_POST['codbarra'];

//Pega as informações do produto

$produto = $pdo->query("SELECT it.*, pro.* FROM item as it, produto as pro WHERE it.codbarra_item='$codbarra' AND it.id_item=pro.produto_id_item ");
$produto->execute();
$linha = $produto->fetch(PDO::FETCH_ASSOC);

$produto_id_item = $linha['produto_id_item'];
$nome_item = $linha['nome_item'];
$valor = $linha['valor'];
$valordecusto = $linha['valordecusto'];

//Verifica se tem o produto na loja , Se tiver continua se nao retorna
if($linha['qtd'] == 0 ){ echo "<script>alert('Produto em Falta na loja'); location.href='?pg=venda'</script>"; return;}

//Verifica se a quantidade na loja é maior que a solicitada
$loja_qtd = $linha['qtd'];
$loja_qtd = $loja_qtd - $qtd; 

// Se tiver a quantidade na loja, insira os dados no Banco
$i = 1;
if ($loja_qtd >= 0){

$sql = "INSERT INTO vendaprovisoria (produto_id_item,nome_item,valor,valordecusto) values";

while ($i <= $qtd) {
$sql .= "('$produto_id_item','$nome_item','$valor','$valordecusto'),";
$i++;
}

// Tira o último caractere (vírgula extra)
$sql = substr($sql, 0, -1);
//inseri os dados
$insert = $pdo->prepare($sql);
$insert->execute();


//atualiza a quantidade no estoque da loja
$update = $pdo->prepare("UPDATE produto SET qtd='$loja_qtd' WHERE produto_id_item='$produto_id_item'");
$update->execute();

} else {
//Quantidade solicitada e maior do que o estoque na loja
  echo "<script>alert('Quantidade Solicitada é maior do que a quantidade que tem na loja'); location.href='?pg=venda'</script>";

}

}
?>

<?php 
//Verifica se tem alguma venda sendo realizada, se tiver mostra todo o codigo 

$verifica_venda = $pdo->query("SELECT * FROM vendaprovisoria");
$conta_verifica_venda = $verifica_venda->rowCount();

if ($conta_verifica_venda > 0){

?>

<div class="wellv">
<table class="venda" cellspacing="0" width="628px">

<thead>
<tr>
<th  class="centro-table" width="50px">Item</th>
<th width="300px">Descrição</th>
<th  class="centro-table" width="50px">Qtd</th>
<th  class="centro-table" width="50px">Unidade</th>
<th width="50px" class="centro-table">Total</th>
<th width="50px" class="centro-table"><span class="glyphicon glyphicon-cog" aria-hidden="true"></th>
</tr>
</thead>

<tbody>

<?php 

$vendaprovisoria = $pdo->query("SELECT *, COUNT(produto_id_item) as total_qtd , SUM(valor) as total_valor FROM vendaprovisoria GROUP BY produto_id_item");
$vendaprovisoria->execute();
$i=1;
while($itens = $vendaprovisoria->fetch(PDO::FETCH_ASSOC)){
?>
<tr>
<td class="centro-table"><?php echo $i; ?></td>
<td><?php echo $itens['nome_item'];?></td>
<td class="centro-table"><?php echo $total_itens[$i] = $itens['total_qtd'];?></td>
<td class="centro-table"><?php echo real($itens['valor']);?></td>
<td class="centro-table"><?php echo real($total_valor[$i] = $itens['total_valor']);?></td>
<td class="centro-table"><a href="?pg=venda&acao=cancela&produto_id_item=<?php echo $itens['produto_id_item']?>" OnClick="return confirm('Confirma o Cancelamento ?')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
</tr>
<?php $i++; } ?>

<?php 
// Função Cancela o Produo
if (isset($_GET['acao']) == 'cancela'){
// Pega id do item 
 $produto_id_item = $_GET['produto_id_item'];

// Pega a quantidade do item da venda profissoria
$vendaprovisoria = $pdo->query("SELECT * , COUNT(produto_id_item) as total_qtd  FROM vendaprovisoria WHERE produto_id_item='$produto_id_item' GROUP BY produto_id_item");
$vendaprovisoria->execute();
$linha_qtd = $vendaprovisoria->fetch(PDO::FETCH_ASSOC);
$total_qtd = $linha_qtd['total_qtd'];
 
// Retorna os item para estoque 
  $update = $pdo->prepare("UPDATE produto SET qtd=(qtd+'$total_qtd') WHERE produto_id_item='$produto_id_item'");
  $update->execute();

// Delete o item da venda provisoria
  $del = $pdo->prepare("DELETE FROM vendaprovisoria WHERE produto_id_item='$produto_id_item'");
  $del->execute();

echo "<script>location.href='?pg=venda'</script>";

}

?>
</tbody>

</table>

</div><!-- END Well-->

<div class="grupo-venda">

<div class="panel panel-info">
  <div class="panel-heading centro-table">Registro de Venda</div>
  
  <div class="panel-body centro-table">
    <p style="font-size:16px;">
    <?php 
    $r=1;

    $registro = $pdo->query("SELECT registro_venda FROM vendas ORDER BY registro_venda DESC");
    $registro->execute();
    $linha_registro = $registro->fetch(PDO::FETCH_ASSOC);
    $reg = $linha_registro['registro_venda'];
    echo $reg = $r + $reg;
    ?></p>
  </div>

</div>

<div class="panel panel-danger">
  <div class="panel-heading centro-table">Total da Venda</div>
  
  <div class="panel-body centro-table">
    <p style="font-size:18px;">R$ <?php echo real(@$total_valor = array_sum($total_valor))?></p>
  </div>

</div>

<div class="acao">

<!-- Modal de Pagamento e funcoes para concluir o pagamento -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#venda" accesskey="z"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></button>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="venda" aria-hidden="true">
  <div class="modal-dialog modal-sm">
 <div class="modal-content">
   
   <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pagamento</h4>
     </div> 

     <div class="modal-body">
     <script type="text/javascript">
function id( el ){
        return document.getElementById( el );
}
function total( valor, total )
{
        return total-valor;
}
window.onload = function()
{
        id('valor').onkeyup = function()
        {
                id('total').value = total( this.value , id('totalconta').value );
        }      
        id('totalconta').onkeyup = function()
        {
                id('total').value = total( id('valor').value , this.value );
        }
}
</script>
     <div class="input-group input-group-lg">
     <label>Dinheiro</label>
     <input type="text" class="form-control" placeholder="Dinheiro" name="valor" id="valor" autocomplete="off" length=15 onkeypress="return(FormataReais(this,',','.',event))" />
     </div>
     
     <div class="input-group input-group-lg">
      <label>Total da Conta</label>
     <input type="text" class="form-control" disabled="disabled" value="R$ <?php echo real(@$total_valor = array_sum($total_valor))?>" style="width:150px;" length=15 onkeypress="return(FormataReais(this,'.',',',event))">
     <input type="hidden"  name="totalconta" id="totalconta" value="<?php echo $total_valor ?>">
     </div>
      
      <div class="input-group input-group-lg">
       <label>Troco</label>
      <input type="text" class="form-control" name="total" id="total" readonly="readonly"/>
      </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="location.href='?pg=venda&pago'">Confirmar</button>
      </div>

    </div>
  </div>
</div>

<?php 

if (isset($_GET['pago'])){

//Pega o Registro de Venda 
$reg;

//Pega todos os dados da venda provisoria 
$vendaprovisoria = $pdo->query("SELECT *, COUNT(*) as total  FROM vendaprovisoria GROUP BY produto_id_item");
$vendaprovisoria->execute();

$sql = "INSERT INTO vendas (produto_id_item_venda,nome_item_venda,valor_venda,valordecusto_venda,qtd_venda,registro_venda) values ";

//Loop dos dados da venda provisoria
while($linha = $vendaprovisoria->fetch(PDO::FETCH_ASSOC)){

$produto_id_item= $linha['produto_id_item'];
$nome_item = $linha['nome_item'];
$valor= $linha['valor'];
$qtd= $linha['total'];
$valordecusto = $linha ['valordecusto'];

$sql .= "('$produto_id_item','$nome_item','$valor','$valordecusto','$qtd','$reg'),";
}

// Tira o último caractere (vírgula extra)
$sql = substr($sql, 0, -1);

//Inseri os dados na tabela de Vendas
$insert_vendas = $pdo->prepare($sql);
$insert_vendas->execute();


//Inseri os dados na pagvenda
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i:s');
$totalconta = $total_valor;

$insert_pagvenda = $pdo->prepare("INSERT INTO pagvenda (registro_venda,valor_pagvenda,data_pagvenda) values ('$reg','$totalconta','$data')");
$insert_pagvenda->execute();

//Deleta todos os dados da venda provisoria 

$del = $pdo->prepare("DELETE FROM vendaprovisoria WHERE 1");
$del->execute();

echo "<script>location.href='?pg=venda'</script>";
} ?>

<!-- END Modal de Pagamento e funcoes para concluir o pagamento -->

<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalmarca" accesskey="z"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></button>

<div class="modal fade bs-example-modal-sm" id="modalmarca" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
 <div class="modal-content">
   
   <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Marcar</h4>
     </div> 

     <div class="modal-body">
     
     <div class="input-group input-group-lg">
     <label>Cliente</label>
  <script language="javascript" type="text/javascript">

 function enviaCliente() {

        cliente.submit();  
    } 

 </script> 
   
     <form id="cliente" method="POST" action="?pg=venda&marcar">   
     <select name="idcliente" class="form-control">
     <?php 
     $cliente = $pdo->query("SELECT * FROM clientes WHERE cliente_status='ativo' ORDER BY nome ASC");
     $cliente->execute();
     while ($linhaCliente = $cliente->fetch(PDO::FETCH_ASSOC)){
     ?> 
      <option value="<?php echo $linhaCliente['idcliente'];?>"><?php echo $linhaCliente['nome'];?></option>
     <?php } ?>
     </select>
     </form>
     </div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="return enviaCliente();">Confirmar</button>
      </div>

    </div>
  </div>
</div>
<?php 

if (isset($_GET['marcar'])){

//Pega o id cliente vindo do formulario
$idcliente = $_POST['idcliente'];

//Pega o Registro de Venda 
$reg;

//Verifica se o cliente tem o limite
$limitecliente = $pdo->prepare("SELECT * FROM clientes WHERE idcliente='$idcliente'");
$limitecliente->execute();
$linhacliente = $limitecliente->fetch(PDO::FETCH_ASSOC);

$veado = $pdo->prepare("SELECT *,SUM(valor_venda) as total_veado FROM veado WHERE id_cliente_veado='$idcliente' AND status=''");
$veado->execute();
$linhaveado = $veado->fetch(PDO::FETCH_ASSOC);

$limite = $linhacliente['limite'];

$veado = $linhaveado['total_veado'];
$total_valorb = $total_valor + $veado;


if($limite > $total_valorb){

//Pega todos os dados da venda provisoria 

$vendaprovisoria = $pdo->query("SELECT *, COUNT(*) as total  FROM vendaprovisoria GROUP BY produto_id_item");
$vendaprovisoria->execute();

$sql = "INSERT INTO vendas (produto_id_item_venda,nome_item_venda,valor_venda,valordecusto_venda,qtd_venda,registro_venda) values ";

//Loop dos dados da venda provisoria
while($linha = $vendaprovisoria->fetch(PDO::FETCH_ASSOC)){

$produto_id_item= $linha['produto_id_item'];
$nome_item = $linha['nome_item'];
$valor= $linha['valor'];
$qtd= $linha['total'];
$valordecusto = $linha ['valordecusto'];

$sql .= "('$produto_id_item','$nome_item','$valor','$valordecusto','$qtd','$reg'),";
}

// Tira o último caractere (vírgula extra)
$sql = substr($sql, 0, -1);

//Inseri os dados na tabela de Vendas
$insert_vendas = $pdo->prepare($sql);
$insert_vendas->execute();

//Dados
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i:s');
$totalconta = $total_valor;

//Inseri os dados na tabela veado
$insert_veado = $pdo->prepare("INSERT INTO veado (id_cliente_veado,registro_venda,valor_venda,data_venda) values ('$idcliente','$reg','$totalconta','$data')");
$insert_veado->execute();

//Deleta todos os dados da venda provisoria 

$del = $pdo->prepare("DELETE FROM vendaprovisoria WHERE 1");
$del->execute();

echo "<script>location.href='?pg=venda'</script>";

}else{echo "<script>alert('Limite Ultrapassado !');location.href='?pg=venda'</script>";
}

}

?>


<button class="btn btn-danger"  onClick="confirma_cancelamento();" accesskey="c"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>

<script LANGUAGE="Javascript">  
function confirma_cancelamento(){  
  
msg = "Tem certeza que deseja cancelar tudo ?";  
if(confirm(msg)){  
location.href="?pg=venda&cancelaAll";  
}

}
</script>  

<?php 
//Função cancela tudo
if (isset($_GET['cancelaAll'])){

// Pegando valores da tabela venda provisoria
  $vendaprovisoria = $pdo->query("SELECT *, COUNT(produto_id_item) as total_itens FROM vendaprovisoria GROUP BY produto_id_item");
  $vendaprovisoria->execute();

while($linha = $vendaprovisoria->fetch(PDO::FETCH_ASSOC)){
  $qtd = $linha['total_itens'];
  $id_item = $linha['produto_id_item'];

  $update = $pdo->prepare("UPDATE produto SET qtd=(qtd+'$qtd') WHERE produto_id_item='$id_item' ");
  $update->execute();

  $del = $pdo->prepare("DELETE FROM vendaprovisoria WHERE 1");
  $del->execute();

  echo "<script>location.href='?pg=venda'</script>";
}
  

}?>

</div>
<?php } ?>
</div>


</div><!-- Fecha Id Janela-->
</section>

<script>
    $(function(){
      
      $('table.venda > tbody > tr:odd').addClass('odd');
      
      $('table.venda  > tbody > tr').hover(function(){
        $(this).toggleClass('hover');
      });
      
      $('#marcar-todos').click(function(){
        $('table > tbody > tr > td > :checkbox')
          .attr('checked', $(this).is(':checked'))
          .trigger('change');
      });
      
      $('table.venda  > tbody > tr > td > :checkbox').bind('click change', function(){
        var tr = $(this).parent().parent();
        if($(this).is(':checked')) $(tr).addClass('selected');
        else $(tr).removeClass('selected');
      });
      
      $('form.efeito').submit(function(e){ e.preventDefault(); });
      
      $('#pesquisar').keydown(function(){
        var encontrou = false;
        var termo = $(this).val().toLowerCase();
        $('table > tbody > tr').each(function(){
          $(this).find('td').each(function(){
            if($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
          });
          if(!encontrou) $(this).hide();
          else $(this).show();
          encontrou = false;
        });
      });
      
      $("table.venda") 
        .tablesorter({
          dateFormat: 'uk',
          headers: {
            0: {
              sorter: false
            },
            5: {
              sorter: false
            }
          }
        }) 
        .tablesorterPager({container: $("#pager")})
        .bind('sortEnd', function(){
          $('table.venda > tbody > tr').removeClass('odd');
          $('table.venda > tbody > tr:odd').addClass('odd');
        });
      
    });
    </script>