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

<?php if (isset($_GET['sucesso'])){ ?>
<!-- Parte da mensagem que os dados foram salvos -->
<div class="alert alert-success">
<a href="?pg=inseri-estoque" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>


<legend>Inserir no Estoque</legend>
        <!-- Formulario do envio de codbarra para a inseri-estoque -->
        <form method="POST" name="enviar" id="enviar" action="?pg=inseri-estoque&registra">

        <div class="form-group">
        <div class="form-inline">
            <div class="form-group">

                <input type="number" class="form-control centro-table" name="qtd" style="width:80px;" value="1" >

                <div class="input-group">

                    <?php if (isset($_GET['SemLeitor'])){?>
                    
                        <span class="input-group-addon"><a href="?pg=inseri-estoque"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span></a></span>
                        <select name="id_item" required class="form-control" style="width:570px;" autofocus>
                        
                        <?php 
                            //Pegando todos Produto na loja
                            $produto = $pdo->query("SELECT * FROM itens WHERE status_item = 'ativo'");
                            $produto->execute();
                            while($linha = $produto->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $linha['id_item'];?>"><?php echo $linha['nome_item'];?></option>
                        <?php } ?>
                        </select>

                    <?php } else { ?>
                        <span class="input-group-addon"><a href="?pg=inseri-estoque&SemLeitor"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></span>
                        <input type="text" required class="form-control" style="width:570px;" name="codbarra" autofocus placeholder="Passe o Leitor de Código de Barras">
                    <?php } ?>
                </div>

                <input type="text" required class="form-control" name="valor" placeholder="Preço" style="width:100px;" length=15 onkeypress="return(FormataReais(this,'.',',',event))">
        
             </div>
        </div>
        </div>
        <div class="form-group">
        <select name="id_fornecedora" class="form-control" autofocus>
            
            <?php 
                //Pegando todos Produto na loja
                $fornecedora = $pdo->query("SELECT * FROM fornecedoras");
                $fornecedora->execute();
                while($linha = $fornecedora->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $linha['id_fornecedora'];?>"><?php echo $linha['nome'];?></option>
            <?php } ?>
            </select>
        </div>

        <button  class="btn btn-primary">Salvar</button>

    </div>
</form>
<!-- END do Formulario do envio de codbarra para a venda -->


<!-- Registro de Venda / Dados vindo do Formulario de cima -->


<?php 

if (isset($_GET['registra'])){
  
    // Verifica se há itens com o codbarra 
    if($codbarra = $_POST['codbarra']){
            
            $item = $pdo->query("SELECT * FROM itens WHERE status_item='ativo' AND codbarra_item='$codbarra'");
            $item->execute();
            $linha = $item->fetch(PDO::FETCH_ASSOC);
            $registros = $item->rowCount();
        
        if ($registros == 0){
    
            echo '<script language="javascript">';
            echo 'alert("Produto não encontrado")';
            echo '</script>'; 
            echo "<script>location.href='home.php?pg=inseri-estoque';</script>";
    
        }else {
        $id_item = $linha['id_item'];
        }
    }

    // INSERI OS DADOS NO BANCO DE DADOS
    $id_item =  $id_item ? $id_item : $_POST['id_item'];    
    $qtd = $_POST['qtd'];
    $valor = dolar($valor = $_POST['valor']);
    $id_fornecedora = $_POST['id_fornecedora'];
    $data_compra = date('Y-m-d H:i:s');

    try {
    $produto = $pdo->prepare("INSERT INTO compras (id_fornecedora,id_item,quantidade, preco,data_compra) values ('$id_fornecedora','$id_item','$qtd','$valor','$data_compra')");    
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
    $qtd_atual += $qtd;

    $update_item = $pdo->prepare("UPDATE itens SET qtd=$qtd_atual  WHERE id_item = $id_item");
    $update_item->execute();

    echo "<script>location.href='home.php?pg=inseri-estoque&sucesso';</script>";
    }
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}
?>


</div><!-- Fecha Id Janela-->
</section>
