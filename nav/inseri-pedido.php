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
<legend>Gerando Pedido</legend>
        <!-- Formulario do envio de codbarra para a inseri-pedido -->
        <form method="POST" name="enviar" id="enviar" action="?pg=inseri-pedido&registra">

        <div class="form-inline">
        <div class="form-group">

        <input type="number" class="form-control centro-table" name="qtd" style="width:50px;" value="1" >

        <div class="input-group">

        <?php if (isset($_GET['SemLeitor'])){?>
        <span class="input-group-addon"><a href="?pg=inseri-pedido"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span></a></span>
        <select name="codbarra" class="form-control" style="width:553px;" autofocus>
        
        <?php 
        //Pegando todos Produto na loja
        $produto = $pdo->query("SELECT * FROM item");
        $produto->execute();
        while($linha = $produto->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $linha['codbarra_item'];?>"><?php echo $linha['nome_item'];?></option>
        <?php } ?>
        </select>

        <?php } else { ?>
            <span class="input-group-addon"><a href="?pg=inseri-pedido&SemLeitor"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a></span>
            <input type="text" class="form-control" style="width:553px;" name="codbarra" autofocus placeholder="Passe o Leitor de Código de Barras">
        <?php } ?>

        </div>

        <input type="text" class="form-control" name="valor" placeholder="Preço" style="width:100px;" length=15 onkeypress="return(FormataReais(this,'.',',',event))">

        <button class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>

        </div>
        </div>

</form>
<!-- END do Formulario do envio de codbarra para a venda -->


<!-- Registro de Venda / Dados vindo do Formulario de cima -->


<?php 

if (isset($_GET['registra'])){

    //Pega dados do formulario
    $qtd = $_POST['qtd'];
    $codbarra = $_POST['codbarra'];
    $valor = $_POST['valor'];

    //Pega as informações do produto

    $produto = $pdo->query("SELECT * FROM item WHERE codbarra_item='$codbarra'");
    $produto->execute();
    $linha = $produto->fetch(PDO::FETCH_ASSOC);

    $nome_item = $linha['nome_item'];


    // inserir Pedido gerandoPedido
    $i = 1;

    $sql = "INSERT INTO pedidoprovisorio (id_item,nome_item, valor) values";

    while ($i <= $qtd) {
    $sql .= "('$id_item','$nome_item','$valor'),";
    $i++;
    }

    // Tira o último caractere (vírgula extra)
    $sql = substr($sql, 0, -1);
    //inseri os dados
    $insert = $pdo->prepare($sql);
    $insert->execute();


}
?>

</div><!-- END Well-->


</div><!-- Fecha Id Janela-->
</section>
