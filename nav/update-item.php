<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";  ?>

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
}

if (limite == "") { 
alert('Preencha o campo Limite'); 
enviar.limite.focus(); 
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
    $id_item = $_POST['id_item'];
    $nome = $_POST['nome']; 
    $codbarra_item = $_POST['codbarra']; 
    $minimo = $_POST['minimo']; 
    $status_item = $_POST['status_item']; 

 //Cadastra Cliente

$update = $pdo->prepare("UPDATE itens SET nome_item='$nome',codbarra_item='$codbarra_item',minimo='$minimo',status_item='$status_item' WHERE id_item='$id_item'");
$update->execute();

echo "<script>location.href='?pg=update-item&sucesso&id_item=$id_item'</script>"; 

}
?>

<!-- Parte da mensagem que os dados foram salvos -->
<?php if(isset($_GET['sucesso'])){?>
<div class="alert alert-success">
<a href="?pg=update-item&id_item=<?php echo $_GET['id_item']?>" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>

<?php 
$id_item = $_GET['id_item'];
$select = $pdo->prepare("SELECT * FROM itens WHERE id_item='$id_item'");
$select->execute();
$linha = $select->fetch(PDO::FETCH_ASSOC);

?>
<legend>Preencha as informações do Cliente</legend>

<form method="POST" name="enviar" action="?pg=update-item&submit">

<div class="form-group">
<label for="">Nome do Item</label>
<input type="text" required name="nome" class="form-control" placeholder="Nome do Item" value="<?php echo $linha['nome_item'];?>">
</div>

<div class="form-group">
<label for="">Cod Barra</label>
<input type="text" name="codbarra" class="form-control" placeholder="Digite o código de Barra" value="<?php echo $linha['codbarra_item'];?>">
</div>

<div class="form-group">
<label for="">Estoque Minimo</label>
<input type="number" required name="minimo" class="form-control" placeholder="Digite o Minimo" value="<?php echo $linha['minimo'];?>">
</div>

<div class="form-group">
<select name="status_item" class="form-control">
<option value="ativo" <?php echo selected( 'ativo', $linha['status_item'] ); ?>>Ativo</option>
<option value="inativo"<?php echo selected( 'inativo', $linha['status_item'] ); ?>>Inativo</option>
</select>
</div>

<input type="hidden" name="id_item" value="<?php echo $id_item;?>">
<button onclick="return validar();" class="btn btn-primary">Salvar Dados</button>

</form>

</div><!-- Fecha Id Janela-->
</section>
