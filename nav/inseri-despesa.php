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

var dataDespesa = enviar.dataDespesa.value;
var valorDespesa = enviar.valorDespesa.value;

if (valorDespesa == "") { 
alert('Preencha o campo valor despesa'); 
enviar.valorDespesa.focus(); 
return false; 
}


if (dataDespesa == "") { 
alert('Preencha o campo data da Despesa'); 
enviar.dataDespesa.focus(); 
return false; 
}else{

        enviar.submit();  
    }  



}

 </script> 
 



<section>
<div id="janela">
<?php 

if (isset($_GET['submit'])) {

$idtipodespesa = $_POST['idtipodespesa'];

$valorDespesa = $_POST['valorDespesa'];
$a = array(".",",");
$b = array("",".");
$tratavalordespesa = str_replace($a,$b, $valorDespesa);
$dataDespesa = $_POST['dataDespesa'];
$status = "Devedor";


$insert = $pdo->prepare("INSERT INTO despesas (idDespesaN,status,valorDespesa,dataDespesa) values ('$idtipodespesa','$status','$tratavalordespesa','$dataDespesa')");
$insert->execute();
?>

<!-- Parte da mensagem que os dados foram salvos -->
<div class="alert alert-success">
<a href="?pg=inseri-despesa" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>


<?php } ?>
<legend>Prencha as Informações da Despesa</legend>
<div id="conteudo">

<form method="POST" name="enviar" action="?pg=inseri-despesa&submit">

<div class="form-group">
<label>Despesa</label>
<select name="idtipodespesa" class="form-control">


<?php 
$consulta = $pdo->prepare("SELECT * FROM tipodespesa ORDER BY nometipodespesa ASC");
$consulta->execute();
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){?>
<option value="<?php echo $linha['idtipodespesa'];?>"><?php echo $linha['nometipodespesa']?></option>
<?php }?>


</select>
</div>

<div class="form-group">
<label>Valor</label>
<input type="text" class="form-control" name="valorDespesa" placeholder="Digite o Valor" style="width:150px;" length=15 onkeypress="return(FormataReais(this,'.',',',event))"> 
</div>

<div class="form-group">
<label>Data do Vencimento:</label>
<input type="date" class="form-control" name="dataDespesa" style="width:150px">
</div>

<button onclick="return validar();" class="btn btn-primary">Salvar Dados</button>


</form>

</div><!-- Fecha Id conteudo-->
</div><!-- Fecha Id Janela-->
</section>
