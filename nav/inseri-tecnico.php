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

var nome = enviar.nome.value;
var limite = enviar.limite.value;

if (nome == "") { 
alert('Preencha o campo Nome'); 
enviar.nome.focus(); 
return false; 
}else{

        enviar.submit();  
    } 

 }

 </script> 

<section>

<div id="janela">

<?php 
if(isset($_GET['submit'])){

$nome = $_POST['nome']; 
$status = "ativo";

 //Cadastra Cliente

$insert = $pdo->prepare("INSERT INTO tecnicos (nome,status_tecnico) values ('$nome','$status')");
$insert->execute();

echo "<script>location.href='?pg=inseri-tecnico&sucesso'</script>"; 

}
?>

<!-- Parte da mensagem que os dados foram salvos -->
<?php if(isset($_GET['sucesso'])){?>
<div class="alert alert-success">
<a href="?pg=inseri-tecnico" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>


<legend>Preencha as informações do Tecnico</legend>

<form method="POST" name="enviar" action="?pg=inseri-tecnico&submit">

<div class="form-group">
<input type="text" name="nome" class="form-control" placeholder="Nome do Cliente">
</div>

<button onclick="return validar();" class="btn btn-primary">Salvar Dados</button>

</form>

</div><!-- Fecha Id Janela-->
</section>
