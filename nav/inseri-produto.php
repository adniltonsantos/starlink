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

<script language="javascript" type="text/javascript">

 function validar() {


var codbarra = enviar.codbarra.value;

if (codbarra == "") { 
alert('Preencha o campo Código Barra'); 
enviar.codbarra.focus(); 
return false; 
}else{

        enviar.submit();  
    } 

 }

 </script> 

<section>
<div id="janela">
<legend>Cadastro de Produtos</legend>



<form method="POST" name="enviar" id="enviar" action="?pg=inseri-produto&parte2">

<div class="form-group">
<div class="form-inline">

<div class="input-group">

<?php if (isset($_GET['SemLeitor'])){?>
<span class="input-group-addon"><a href="?pg=inseri-produto"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span></a></span>
<select name="codbarra" class="form-control" style="width:717px;" autofocus>
  
  <?php 
  //Pegando todos Produto na loja
  $produto = $pdo->query("SELECT * FROM item ORDER BY nome_item ASC");
  $produto->execute();
  while($linha = $produto->fetch(PDO::FETCH_ASSOC)){
  ?>
  <option value="<?php echo $linha['codbarra_item'];?>"><?php echo $linha['nome_item'];?></option>
  <?php } ?>
</select>

<?php } else { ?>
<span class="input-group-addon"><a href="?pg=inseri-produto&SemLeitor"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></span>
<input type="text" class="form-control" style="width:717px;" name="codbarra" autofocus placeholder="Passe o Leitor de Código de Barras">
<?php } ?>

</div>
<button onclick="return validar();" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>

</div>
</div>

</form>
<!-- END do Formulario do envio de codbarra para a venda -->
<?php 

if (isset($_GET['submit'])){

$id_item = $_POST['id_item'];
$valor = dolar($valor = $_POST['valor']);
$valordecusto = dolar($valordecusto = $_POST['valordecusto']);
$qtd = $_POST['quantidade'];


//Verifica se já existe o Item cadastrado no produto
$verifica = $pdo->query("SELECT * FROM produto WHERE produto_id_item='$id_item'");
$verifica->execute();
$linha = $verifica->rowCount();

if ($linha == 1 ){
//Pega a Quantidade 
$query = $verifica->fetch(PDO::FETCH_ASSOC);
$qtd_produto = $query['qtd'];
$qtd = $qtd + $qtd_produto;

// Se Existir , Atualiza os valores 
$update = $pdo->prepare("UPDATE produto SET valor='$valor', valordecusto='$valordecusto',qtd='$qtd' WHERE produto_id_item='$id_item'");
$update->execute();	

echo "<script>location.href='?pg=inseri-produto&sucesso'</script>";

} else {

$insert = $pdo->prepare("INSERT INTO produto (produto_id_item,valor,valordecusto,qtd) values('$id_item','$valor','$valordecusto','$qtd')");
$insert->execute();

echo "<script>location.href='?pg=inseri-produto&sucesso'</script>";

}

}

?>  

<?php if (isset($_GET['sucesso'])){ ?>
<!-- Parte da mensagem que não existe os dados -->
<div class="alert alert-success">
<strong>Sucesso !</strong> Dados Salvos com Sucesso .

</div>
<?php } ?>

<?php

if (isset($_GET['parte2'])) {

?>

<?php 
$codbarra = $_POST['codbarra'];
$pega_item = $pdo->query("SELECT * FROM item WHERE codbarra_item ='$codbarra'");
$conta = $pega_item->rowCount();

if ($conta == 1){ 
$linha = $pega_item->fetch(PDO::FETCH_ASSOC);
$codbarra = $linha['codbarra_item'];
?>

<!-- Exibe Dados da Consulta do primeiro form-->
<div class="panel panel-primary">
<div class="panel-heading">

	 <strong>
	<?php echo $linha['nome_item'];?>
	<span style="float:right;">Código de Barra : <?php echo $linha['codbarra_item'];?></span>
	</strong>

	</div>

<!-- Painel Informativo referente a consulta do código de Barra -->


	 <div class="panel-body">


 	 <?php // Pegando os dados da tabela Produto referente o codigo da Barra da tabela ITEM 
 	 		  $produto = $pdo->query("SELECT pro.*, it.* FROM produto as pro , item as it WHERE it.codbarra_item = $codbarra AND it.id_item=pro.produto_id_item");
	 		  $produto->execute();
	 		  $linhaProduto = $produto->fetch(PDO::FETCH_ASSOC);
	 		  $conta = $produto->rowCount();

	 		  if ($conta >= 1){ 
	 	?>
	 <div class="info-produto">
	 	
 	 <div class="panel panel-info">
	 <div class="panel-heading"> Informação !</div>
	 <div class="panel-body">
	 	
	 	<p>Existe na loja <span style="color:red"><?php echo $linhaProduto['qtd'];?> item (ns)</span> , no valor de venda à
	 	<span style="color:red">R$ <?php echo real($linhaProduto['valor']);?></span>
	 	</p>

	 	<p>Valor de custo é de <span style="color:red">R$ <?php echo real($linhaProduto['valordecusto']); ?></span>
	 	</p>


	 </div>
	 </div>
</div>

<div class="info-produto">
 	 <div class="panel panel-danger">
	 <div class="panel-heading"> Atenção !</div>
	 <div class="panel-body">
	
	 	<p>Preencher o valor de venda e o valor de custo , os produtos existente na loja será alerado para o atual.</p>
	 	<p>Preencher a quantidade será adicionado</p>


	 </div>
	 </div>
	 </div>	 

<?php } else  { ?>

<div class="info-produto">
	 	
 	 <div class="panel panel-info">
	 <div class="panel-heading"> Informação !</div>
	 <div class="panel-body">
	 	
	 	<p>Nenhum Produto encontrado na Loja , cadastre ! </p>

	 </div>
	 </div>
	 </div>

<?php } ?>
<!-- Fim do Painel -->

<!-- Valida o Formulario 2 -->
<script language="javascript" type="text/javascript">

function validar2() {


var valor = enviar2.valor.value;

if (valor == "") { 
alert('Preencha o campo Valor Vendido'); 
enviar2.valor.focus(); 
return false; 
}else{

        enviar2.submit();  
    } 

 }

 </script>
 <!-- Fim da validação -->


<form method="POST" name="enviar2" id="enviar2" action="?pg=inseri-produto&submit">
<input type="hidden" name="id_item" value="<?php echo $linha['id_item'];?>">

<div class="form-group">
<label>Valor Vendido </label>
<input type="text" class="form-control"  name="valor" style="width:200px;" length=15 onkeypress="return(FormataReais(this,'.',',',event))" value="<?php echo real($linhaProduto['valor']);?>">
</div>

<div class="form-group">
<label>Valor de Custo:</label>
<input type="text" class="form-control" name="valordecusto" style="width:200px;" length=15 onkeypress="return(FormataReais(this,'.',',',event))" value="<?php echo real ($linhaProduto['valordecusto']);?>">
</div>

<div class="form-group">
<label>Quantidade: </label>
<input type="number" class="form-control"  name="quantidade" style="width:200px;" value="0">
</div>

<button onclick="return validar2();" class="btn btn-primary">Salvar Dados</button>
</form>


<?php } else {  ?>

<!-- Parte da mensagem que não existe os dados -->
<div class="alert alert-warning">
<strong>OPAAAAAH !</strong> Item com esse código de Barra : <?php echo $codbarra ?>, não encontrado no Sistema.
<a href="?pg=inseri-item">Cadastre Clique Aqui</a>
</div>
<?php } ?>

<?php } //Se Existe a Parte 2 ?>

</div><!-- Panel Body-->
</div><!-- Panel-->
</div><!-- Fecha Id Janela-->
</section>