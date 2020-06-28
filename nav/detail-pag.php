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

<?php
 if (isset($_GET['pagamento'])) {

date_default_timezone_set('America/Sao_Paulo');

$idDespesa = $_GET['id'];

$consulta = $pdo->prepare("SELECT * FROM despesas WHERE idDespesa='$idDespesa'");
$consulta->execute();
$dado = $consulta->fetch(PDO::FETCH_ASSOC);

$idDespesaN = $dado['idDespesaN'];


$valorPagoDespesa = $_POST['valorPagoDespesa'];
$valorPagoDespesa = str_replace("." , "" , $valorPagoDespesa ); // Primeiro tira os pontos
$valorPagoDespesa = str_replace("," , "." , $valorPagoDespesa); // Depois tira a vírgula


$dataPagamentoDespesa = $_POST['dataPagamentoDespesa'];
$a = date('H:i:s');
$d = $dataPagamentoDespesa." ".$a;

$insert = $pdo->prepare("INSERT INTO pagamentodespesa (idDespesaN,idDespesaP,valor,datapagamento) values ('$idDespesaN ','$idDespesa','$valorPagoDespesa','$d')");
$insert->execute(); 
 // Se os dados forem inseridos com sucesso  
 
 $consulta1 = $pdo->prepare("SELECT *, SUM(valorDespesa) as valorDespesa FROM despesas WHERE idDespesa='$idDespesa'");
 $consulta1->execute();
 $query3 = $consulta1->fetch(PDO::FETCH_ASSOC);
 $a = $query3['valorDespesa'];
 $consulta2 = $pdo->prepare("SELECT *, SUM(valor) as totalvalor FROM pagamentodespesa WHERE idDespesaP='$idDespesa'");
 $consulta2->execute();
 $query4 = $consulta2->fetch(PDO::FETCH_ASSOC);
 $b = $query4['totalvalor'];



 if ( $a == $b ){
 
$insert2 = $pdo->prepare("UPDATE despesas SET status='Pago' WHERE idDespesa='$idDespesa'");
$insert2->execute();
}

 echo "<script>alert('Despesa Paga com Sucesso'); location.href='?pg=despesas-futuras'</script>"; 

}
?>

  <section>

<div id="janela">
<?php 

$id = $_GET['id'];

$consulta = $pdo->prepare("SELECT *, SUM(valor) as totalvalor FROM pagamentodespesa WHERE idDespesaP='$id'");
$consulta->execute();
$query2 = $consulta->fetch(PDO::FETCH_ASSOC);


$consulta2 = $pdo->prepare("SELECT desp.*,tipo.* FROM despesas as desp , tipodespesa as tipo WHERE desp.idDespesaN=tipo.idtipodespesa AND desp.idDespesa='$id'");
$consulta2->execute();
$query = $consulta2->fetch(PDO::FETCH_ASSOC);

?>
<legend>Efetuar Pagamento - <?php echo $query['nometipodespesa'];?> #<?php echo $id; ?><span style="float:right; margin-top:-5px;"><a href="?pg=despesas-futuras"><button class="btn btn-danger">Voltar</button></a></span></legend>
<div id="conteudo">


<table class="table table-hover">


<tr>
<td>Data da Divida </td>
<td><?php echo $data = implode("/",array_reverse(explode("-",$query['dataDespesa']))); ?></td>
</tr>

<tbody>
<tr>
<td><span style="color:blue">Valor Total</span></td>
<td><span style="color:blue">R$ <?php echo $valor = number_format($query['valorDespesa'], 2,',','.');?></span></td>
</tr>

<tr>
<td><span style="color:green">Valor Pago</span></td>
<td><span style="color:green">R$ <?php echo $valor = number_format($query2['totalvalor'], 2,',','.');?></span></td>
</tr>

</tbody>
<?php 


$a =  $query2['totalvalor'];
$b =  $query['valorDespesa'];

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
<form method="POST" name="enviar" action="?pg=detail-pag&pagamento&id=<?php echo $id = $_GET['id'];;?>">
<div class="form-group">
<label>Valor Pago:</label>
<input type="text" class="form-control" name="valorPagoDespesa" style="width:80px;" length=15 onkeypress="return(FormataReais(this,'.',',',event))">
</div>

<div class="form-group">
<label>Data do Pagamento:</label>
<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<input type="date" class="form-control" name="dataPagamentoDespesa" style="width:150px" value="<?php echo date('Y-m-d'); ?>">
</div>

<button onclick="return validar();" class="btn btn-primary">Salvar Dados</button>



</form>


                            </p>
                        </div>

                    </div>
                </div>



</div><!-- Fecha Id conteudo-->
</div><!-- Fecha Id Janela-->
</section>
