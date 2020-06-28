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


<?php 

$idcliente = $_GET['idcliente'];

$consulta = $pdo->prepare("SELECT *, SUM(valor_pagveado) as totalvalor FROM pagveado WHERE id_cliente_pagveado='$idcliente' AND status_pagveado !='ok'");
$consulta->execute();
$query2 = $consulta->fetch(PDO::FETCH_ASSOC);


$consulta2 = $pdo->prepare("SELECT cli.*,vea.*, SUM(valor_venda) as total FROM clientes as cli , veado as vea WHERE cli.idcliente='$idcliente' AND vea.id_cliente_veado=cli.idcliente AND vea.status=''");
$consulta2->execute();
$query = $consulta2->fetch(PDO::FETCH_ASSOC);

?>
<legend><?php echo $query['nome'];?> - <?php echo $idcliente; ?><span style="float:right; margin-top:-5px;"><a href="?pg=relatorio-ativos"><button class="btn btn-danger">Voltar</button></a></span></legend>
<div id="conteudo">

<?php 
$idcliente = $_GET['idcliente'];
$sql = $pdo->query("SELECT *, date_format(data_venda,'%d/%m/%Y') as data FROM veado WHERE id_cliente_veado='$idcliente' AND status='' ");
$sql->execute();
while($vendas = $sql->fetch(PDO::FETCH_ASSOC)){
?>

<p>Registro de Venda Número - <?php echo $rg = $vendas['registro_venda']; ?> - Data <?php echo $vendas['data']; ?>
</p>


<table class="venda" cellspacing="0" width="628px">

<thead>
<tr>
<th  class="centro-table" width="50px">Item</th>
<th width="300px">Descrição</th>
<th  class="centro-table" width="50px">Qtd</th>
<th  class="centro-table" width="50px">Unidade</th>
<th width="50px" class="centro-table">Total</th>
</tr>
</thead>

<tbody>

<?php 

// $vendaprovisoria = $pdo->query("SELECT *, COUNT(produto_id_item) as total_qtd , SUM(valor) as total_valor FROM vendas WHERE registro_venda = '$rg' GROUP BY produto_id_item");
$vendaprovisoria = $pdo->query("SELECT *, COUNT(produto_id_item_venda) as total_qtd , SUM(valor_venda) as total_valor FROM vendas WHERE registro_venda = '$rg' GROUP BY produto_id_item_venda");
$vendaprovisoria->execute();
$i=1;
while($itens = $vendaprovisoria->fetch(PDO::FETCH_ASSOC)){
?>
<tr>
<td class="centro-table"><?php echo $i; ?></td>
<td><?php echo $itens['nome_item_venda'];?></td>
<td class="centro-table"><?php echo $total_itens[$i] = $itens['total_qtd'];?></td>
<td class="centro-table"><?php echo real($itens['valor_venda']);?></td>
<td class="centro-table"><?php echo real($total_valor[$i] = $itens['total_valor']);?></td>
</tr>
<?php $i++; } ?>

</tbody>

</table>
<br />
<?php } ?>


</div><!-- Fecha Id conteudo-->
</div><!-- Fecha Id Janela-->
</section>
