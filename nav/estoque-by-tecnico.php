<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<script>
function Redireciona(obj)
{
var src = "?pg=estoque-by-tecnico&selecionado&data=<?php echo date('Y-m-d')?>&id_tecnico="+obj.value;
location.href = src;
}
</script>


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

<?php if (isset($_GET['sucesso'])){ ?>
<!-- Parte da mensagem que os dados foram salvos -->
<div class="alert alert-success">
<a href="?pg=inseri-estoque" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>


<legend>Estoque por técnico</legend>
        <!-- Formulario do envio de codbarra para a inseri-estoque -->
<form method="POST" name="enviar" id="enviar" action="?pg=estoque-by-tecnico&submit">
<div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Técnico </label>
        <select name="id_tecnico" required class="form-control"  onchange="Redireciona(this)">
        <option value="">Selecione o Técnico</option>
        <?php 
            //Pegando todos Produto na loja
            $produto = $pdo->query("SELECT * FROM tecnicos WHERE status_tecnico = 'ativo'");
            $produto->execute();
            while($linha = $produto->fetch(PDO::FETCH_ASSOC)){
            ?>
            
            <option value="<?php echo $linha['id_tecnico'];?>" <?php echo selected( $_GET['id_tecnico'], $linha['id_tecnico'] ); ?> ><?php echo $linha['nome']; ?></option>
   <?php } ?>
        </select>

    </div>

    <div class="form-group col-md-3">
      <label for="">Data Inicial</label>
      <input type="date" class="form-control" name="data" value="<?php echo date('Y-m-d'); ?>">
    </div>


    <div class="form-group col-md-3">
      <label for="">Data Final</label>
      <input type="date" class="form-control" name="data" value="<?php echo date('Y-m-d'); ?>">
    </div>


<br /> 
<button type="submit" style="margin-top:5px" class="btn btn-primary">Pesquisar</button>

</div> 

</form>
<!-- END do Formulario do envio de codbarra para a venda -->


<!-- Dados vindo do Formulario de cima -->

<?php
if (isset($_GET['submit'])){
 
 $id_tecnico = $_POST['id_tecnico'];
 $data = $_POST['data'];

?>

<br />
<label for="">Retiradas</label>
<table class="table table-hover">

<thead>
<tr>
<th>Nome do Item</th>
<th>Quantidade</th>
<th>Nome do Técnico</th>
<th>Data</th>
</tr>
</thead>
<?php 
$retiradasql = $pdo->prepare("SELECT retiradas.id_retirada, itens.nome_item, tecnicos.nome, retiradas.data_retirada , retiradas.quantidade  FROM retiradas INNER JOIN itens ON retiradas.id_item=itens.id_item INNER JOIN tecnicos ON retiradas.id_tecnico=tecnicos.id_tecnico  LIKE retiradas.data_retirada='%2020-06-28%' WHERE tecnicos.id_tecnico='$id_tecnico' ORDER BY retiradas.id_retirada DESC LIMIT 7");
$retiradasql->execute();
while($linha = $retiradasql->fetch(PDO::FETCH_ASSOC)){

?>

<tr>
<td><?php echo $linha['nome_item']?></td>
<td><?php echo $linha['quantidade']?></td>
<td><?php echo $linha['nome']?></td>
<td><?php echo $linha['data_retirada']?></td>
</tr>


<?php } // fim do while

} ?>
</table>



<?php if (isset($_GET['selecionado'])){ ?>
        <br />
        <label for="">Retiradas</label>
        <table class="table table-hover">

        <thead>
        <tr>
        <th>Nome do Item</th>
        <th>Quantidade</th>
        <th>Nome do Técnico</th>
        <th>Data</th>
        </tr>
        </thead>
        <?php 
        $id_tecnico = $_GET['id_tecnico'];
        echo $data = $_GET['data'];
        $retiradasql = $pdo->prepare("SELECT *, DATE_FORMAT(data_retirada,'%Y-%m-%d') AS data_formatada from retiradas WHERE data_retirada='$data");
        $retiradasql->execute();
        while($linha = $retiradasql->fetch(PDO::FETCH_ASSOC)){

        ?>

        <tr>
        <td><?php echo $linha['data_formatada']?></td>
        <td><?php echo $linha['quantidade']?></td>
        <td><?php echo $linha['nome']?></td>
        <td><?php echo $linha['data_retirada']?></td>
        </tr>
       

<?php } }?>
</table>

</div><!-- Fecha Id Janela-->
</section>
