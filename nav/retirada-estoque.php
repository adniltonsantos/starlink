<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>
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




<legend>Retirada no Estoque</legend>
        <!-- Formulario do envio de codbarra para a retirada-estoque -->
        <form method="POST" name="enviar" id="enviar" action="?pg=retirada-estoque&registra">

        <div class="form-group">
        <div class="form-inline">
            <div class="form-group">

                <input type="number" class="form-control centro-table" name="qtd" style="width:80px;" value="1" >

                <div class="input-group">

                    <?php if (isset($_GET['SemLeitor'])){?>
                    
                        <span class="input-group-addon"><a href="?pg=retirada-estoque"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span></a></span>
                        <select name="id_item" required class="form-control" style="width:675px;" autofocus>
                        
                        <?php 
                            //Pegando todos Produto na loja
                            $produto = $pdo->query("SELECT * FROM itens WHERE qtd > 0");
                            $produto->execute();
                            while($linha = $produto->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $linha['id_item'];?>"><?php echo $linha['nome_item'];?></option>
                        <?php } ?>
                        </select>

                    <?php } else { ?>
                        <span class="input-group-addon"><a href="?pg=retirada-estoque&SemLeitor"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></span>
                        <input type="text" required class="form-control" style="width:675px;" name="codbarra" autofocus placeholder="Passe o Leitor de Código de Barras">
                    <?php } ?>
                </div>
        
             </div>
        </div>
        </div>
        <div class="form-group">
        <select name="id_tecnico" class="form-control" autofocus>
            
            <?php 
                //Pegando todos Produto na loja
                $tecnicos = $pdo->query("SELECT * FROM tecnicos WHERE status_tecnico='ativo' ORDER BY nome ASC ");
                $tecnicos->execute();
                while($linha = $tecnicos->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $linha['id_tecnico'];?>"><?php echo $linha['nome'];?></option>
            <?php } ?>
            </select>
        </div>

        <button  class="btn btn-primary">Salvar</button>

 
</form>
<!-- END do Formulario do envio de codbarra para a venda -->


<!-- Registro de Venda / Dados vindo do Formulario de cima -->


<?php 

if (isset($_GET['registra'])){
  
    // Verifica se há itens com o codbarra 
    if($codbarra = $_POST['codbarra']){
            
            $item = $pdo->query("SELECT * FROM itens WHERE codbarra_item='$codbarra' AND qtd > 0");
            $item->execute();
            $linha = $item->fetch(PDO::FETCH_ASSOC);
            $registros = $item->rowCount();
        
        if ($registros == 0){
    
            echo '<script language="javascript">';
            echo 'alert("Produto não encontrado")';
            echo '</script>'; 
            echo "<script>location.href='home.php?pg=retirada-estoque';</script>";
    
        }else {
        $id_item = $linha['id_item'];
        }
    }

    // INSERI OS DADOS NO BANCO DE DADOS
    $id_item =  $id_item ? $id_item : $_POST['id_item'];    
    $qtd = $_POST['qtd'];
    $id_tecnico = $_POST['id_tecnico'];
    $data_retirada = date('Y-m-d H:i:s');

    try {
    $produto = $pdo->prepare("INSERT INTO retiradas (id_tecnico,id_item,quantidade,data_retirada) values ('$id_tecnico','$id_item','$qtd','$data_retirada')");    
    $produto->execute();    
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
    
    try {
    // UPDATE ITEM
    $item = $pdo->query("SELECT * FROM itens WHERE id_item='$id_item'");
    $item->execute();
    $linha = $item->fetch(PDO::FETCH_ASSOC);
    $qtd_atual = $linha['qtd'];
    $qtd_atual -= $qtd;

    $update_item = $pdo->prepare("UPDATE itens SET qtd=$qtd_atual  WHERE id_item = $id_item");
    $update_item->execute();
    echo '<script language="javascript">';
    echo 'alert("Item Retirado com Sucesso")';
    echo '</script>'; 
    echo "<script>location.href='home.php?pg=retirada-estoque';</script>";
    // echo "<script>location.href='home.php?pg=retirada-estoque&sucesso';</script>";
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}
?>

<br />
<label for="">Últimas retiradas</label>
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
$retiradasql = $pdo->prepare("SELECT retiradas.id_retirada, itens.nome_item, tecnicos.nome,  retiradas.data_retirada , retiradas.quantidade  FROM retiradas INNER JOIN itens ON retiradas.id_item=itens.id_item INNER JOIN tecnicos ON retiradas.id_tecnico=tecnicos.id_tecnico ORDER BY retiradas.id_retirada DESC LIMIT 7");
$retiradasql->execute();
while($linha = $retiradasql->fetch(PDO::FETCH_ASSOC)){

?>

<tr>
<td><?php echo $linha['nome_item']?></span></td>
<td><?php echo $linha['quantidade']?></span></td>
<td><?php echo $linha['nome']?></span></td>
<td><?php $data = str_replace("/", "-", $linha['data_retirada']);
         echo date('d-m-Y h:m', strtotime($data))
    
    ?> </span></td>
</tr>


<?php } ?>

</table>





</div><!-- Fecha Id Janela-->
</section>

<script>
$(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
});
</script>