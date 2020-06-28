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

var dataPagamentoDespesa = enviar.dataPagamentoDespesa.value;
var valorPagoDespesa = enviar.valorPagoDespesa.value;

if (valorPagoDespesa == "") { 
alert('Preencha o campo valor pago'); 
enviar.valorPagoDespesa.focus(); 
return false; 
}


if (dataPagamentoDespesa == "") { 
alert('Preencha o campo data do pagamento'); 
enviar.dataPagamentoDespesa.focus(); 
return false; 
}else{

        enviar.submit();  
    }  



}

 </script> 


  <section>

<div id="janela">
    <?php
 if (isset($_GET['pago'])) {

date_default_timezone_set('America/Sao_Paulo');
$idcliente = $_POST['idcliente'];
$valor = dolar($valor = $_POST['valor']);
$data = $_POST['data'];
$tempo = date('H:i:s');
$datatime = $data." ".$tempo;
$divida = dolar($divida =  $_POST['divida']);
$pago = dolar($pago = $_POST['pago']);

//Pega o valor já pago + o o que esta sendo pago
$pago = $pago + $valor;

if($pago == $divida){

$insert = $pdo->prepare("INSERT INTO pagveado (id_cliente_pagveado,valor_pagveado,data_pagveado)value('$idcliente','$valor','$datatime')");
$insert->execute();

$update = $pdo->prepare("UPDATE veado SET status='pg' WHERE id_cliente_veado='$idcliente'");
$update->execute();

$update_pagveado = $pdo->prepare("UPDATE pagveado SET status_pagveado='ok' WHERE id_cliente_pagveado='$idcliente'");
$update_pagveado->execute();
     echo "<script>alert('Divida quitada com Sucesso'); location.href='?pg=relatorio-ativos'</script>"; 

 }
if($pago < $divida ){
    $insert = $pdo->prepare("INSERT INTO pagveado (id_cliente_pagveado,valor_pagveado,data_pagveado)value('$idcliente','$valor','$datatime')");
    $insert->execute();
     echo "<script>alert('Adicionado com Sucesso'); location.href='?pg=detail-cliente&idcliente=$idcliente'</script>"; 

}
if($pago > $divida ){

     echo "<script>alert('O valor pago é maior que a divida'); location.href='?pg=detail-cliente&idcliente=$idcliente'</script>"; 
}

}?>


<?php 

$idcliente = $_GET['idcliente'];

$consulta = $pdo->prepare("SELECT *, SUM(valor_pagveado) as totalvalor FROM pagveado WHERE id_cliente_pagveado='$idcliente' AND status_pagveado !='ok'");
$consulta->execute();
$query2 = $consulta->fetch(PDO::FETCH_ASSOC);


$consulta2 = $pdo->prepare("SELECT cli.*,vea.*, SUM(valor_venda) as total FROM clientes as cli , veado as vea WHERE cli.idcliente='$idcliente' AND vea.id_cliente_veado=cli.idcliente AND vea.status=''");
$consulta2->execute();
$query = $consulta2->fetch(PDO::FETCH_ASSOC);

?>
<legend>Efetuar Pagamento na conta do(a) - <?php echo $query['nome'];?> - <?php echo $idcliente; ?><span style="float:right; margin-top:-5px;"><a href="?pg=relatorio-ativos"><button class="btn btn-danger">Voltar</button></a></span></legend>
<div id="conteudo">


<table class="table table-hover">


<tr>
<td>Data da Divida </td>
<td><?php echo @$data = implode("/",array_reverse(explode("-",$query['dataDespesa']))); ?></td>
</tr>

<tbody>
<tr>
<td><span style="color:blue">Valor Total</span></td>
<td><span style="color:blue">R$ <?php echo $divida = number_format($query['total'], 2,',','.');?></span></td>
</tr>

<tr>
<td><span style="color:green">Valor Pago</span></td>
<td><span style="color:green">R$ <?php echo $pago = number_format($query2['totalvalor'], 2,',','.');?></span></td>
</tr>

</tbody>
<?php 


$a =  $query2['totalvalor'];
$b =  $query['total'];

$r = $b - $a ;

?>


<tr>
<td><span style="color:red">Restando para quitar</span></td>
<td><span style="color:red">R$ <?php echo $valor = number_format($r, 2,',','.');?></span></td>
</tr>

</table>


<div class="panel panel-primary">
                        <div class="panel-heading">
                            Adicionar Pagamento
                        </div>
                        <div class="panel-body">
                            <p>
<form method="POST" name="enviar" action="?pg=detail-cliente&pago">
<div class="form-group">
<label>Valor Pago:</label>
<input type="text" class="form-control" name="valor" style="width:80px;" length=15 onkeypress="return(FormataReais(this,'.',',',event))">
</div>

<div class="form-group">
<label>Data do Pagamento:</label>
<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<input type="date" class="form-control" name="data" style="width:150px" value="<?php echo date('Y-m-d'); ?>">
</div>

<input type="hidden" name="idcliente" value="<?php echo $query['idcliente'];?>">
<input type="hidden" name="divida" value="<?php echo $divida;?>">
<input type="hidden" name="pago" value="<?php echo $pago;?>">

<button onclick="return validar();" class="btn btn-primary">Salvar Dados</button>



</form>


                            </p>
                        </div>

                    </div>
                </div>



</div><!-- Fecha Id conteudo-->
</div><!-- Fecha Id Janela-->
</section>
