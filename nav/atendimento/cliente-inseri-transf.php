<?php require_once "config.php"; $pdo = conectar(); require_once "function.php"; ?>
<script>
function Redireciona(obj)
{
var src = "?pg=cliente-inseri-transf&search&selecionado&cod=<?php 
    if(isset($_POST['cod_cliente'])){
        echo $_POST['cod_cliente'];
        }else{
            echo $_GET['cod'];
        }; ?>&ponto="+obj.value;
location.href = src;
}
</script>

<section>

<div id="janela">

<!-- Parte da mensagem que os dados foram salvos -->
<?php if(isset($_GET['sucesso'])){?>
<div class="alert alert-success">
<a href="?pg=cliente-inseri-transf" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Transferência criada com sucesso.
</div>
<?php } ?>


<legend>Cadastrar Transferencia</legend>
    
<form method="POST" name="search" action="?pg=cliente-inseri-transf&search">

    <div class="row">

    <div class="col-lg-6">
        <div class="input-group">
        <input type="text" name="cod_cliente" class="form-control" placeholder="Código do Cliente">
        <span class="input-group-btn">
        <button onclick="document.getElementById('search').submit()"; class="btn btn-primary">OK</button>  
          </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</form>

<?php if(isset($_GET['search'])){ 

    $cod_cliente = $_POST['cod_cliente'];
    $cod_cliente2 = $_GET['cod'];

    $sql = $pdo->prepare("SELECT * FROM clientes WHERE cod_cliente='$cod_cliente' OR cod_cliente='$cod_cliente2'");  
    $sql->execute();
    if($sql->rowCount() > 0){  ?>  


    <div class="col-lg-6">
            <div class="input-group">
            <span class="input-group-btn">
                <form method="POST" action="?pg=cliente-inseri-transf&search">
                <select class="form-control" name="ponto"  id="ponto" onchange="Redireciona(this)">
                <option value="">Selecione o Ponto </option>
                <?php 

                    $cliente = $pdo->query("SELECT * FROM clientes WHERE cod_cliente='$cod_cliente' OR cod_cliente='$cod_cliente2'");
                    $cliente->execute();
                    while($clienteDado = $cliente->fetch(PDO::FETCH_ASSOC)){
                    $i += 1;
                 ?>
                        
                    <option value="<?php echo $clienteDado['id_cliente'] ?>"<?php echo selected( $_GET['ponto'], $clienteDado['id_cliente'] ); ?>><?php echo $clienteDado['nome']; echo "(".$i.")"?> </option>
                <?php }  ?>
                </select>
                </form>
            </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->

   
<?php }else { ?>
    <div class="col-lg-12">
        <div class="input-group">
            <span style="color:red">cliente não encontrado</span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
<?php } } ?>
</div><!-- /.row -->

<?php 
if(isset($_GET['selecionado'])){

    $id_cliente = $_GET['ponto']; 
   
    $sql = $pdo->prepare("SELECT *, c.nome as nomeCliente FROM clientes as c
    INNER JOIN bairros as b ON b.id_bairro = c.fk_id_bairro
    WHERE id_cliente='$id_cliente'");  
    $sql->execute();
    $linha = $sql->fetch(PDO::FETCH_ASSOC); 

?>

<br />

<form method="POST" name="enviar" action="?pg=cliente-inseri-transf&submit">
    <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente'];?>">
    <input type="hidden"  name="addressOld" required class="form-control"  value="<?php echo $linha['nome'];?> - <?php echo $linha['endereco'];?>">

    <div class="form-group">
    <input type="text" disabled name="cod_cliente" required class="form-control"  value="<?php echo $linha['cod_cliente'];?>">
    </div>

    <div class="form-group">
    <input type="text" disabled name="nome" required class="form-control"  value="<?php echo $linha['nomeCliente'];?>">
    </div>

    <div class="form-group">
    <input type="text" disabled name="addressOld" required class="form-control"  value="<?php echo $linha['nome'];?> - <?php echo $linha['endereco'];?>"> 
    </div>
  

    <div class="form-group">
    <select  id="bairro" name="bairro" class="form-control" required>
    <label for="">Novo Bairro</label>
    <option value="">Selecione o Bairro</option>
                    <?php 
                        //Pegando todos Produto na loja
                        $bairros = $pdo->query("SELECT * FROM bairros ORDER BY nome ASC");
                        $bairros->execute();
                        while($linha2 = $bairros->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        
                        <option value="<?php echo $linha2['id_bairro'];?>"><?php echo $linha2['nome']; ?></option>
                      <?php } ?>
    </select>
    </div>

  
    <div class="form-group">
    <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="endereco" class="form-control" placeholder="Digite o Endereço">
    </div>

    <div class="form-group">
    <select  id="tipoTransferencia" name="tipoTransferencia" class="form-control" required>
    <label for="">Tipo de Transferência</label>
    <option value="">Selecione o Tipo</option>
     <option value="transfres">Residencia</option>
     <option value="transfcond">Condominio</option>
        
    </select>
    </div>


    <button class="btn btn-primary">Salvar Dados</button>

    </form>

<?php }  ?>
<?php 
if(isset($_GET['submit'])){ 
// Old Adress
    $id_cliente = $_POST['id_cliente'];
    $addressOld = $_POST['addressOld'];
// New Adress
    $id_bairro = $_POST['bairro'];
    $endereco = $_POST['endereco'];
// Usuario
    $idusuario = $_COOKIE['idusuario'];
// Date Hoje
    $data_transferencia = date('Y-m-d');
    $data_limite = date('Y-m-d',strtotime("+4 days"));
//  Get type Name adress
    $bairroSql = $pdo->prepare("SELECT * from bairros WHERE id_bairro='$id_bairro'");
    $bairroSql->execute();

    $linha = $bairroSql->fetch(PDO::FETCH_ASSOC);
    $bairro = $linha['nome'];
// Concatena Address Novo 
    $addressNew = "$bairro - $endereco";
// Tipo de Transferencia
    $tipoTransferencia = $_POST['tipoTransferencia'];
    // INSERT transfer 
    $trans = $pdo->prepare("INSERT INTO transferencias (fk_id_cliente,fk_id_usuario, data_transferencia, addressOld, addressNew) 
    values ('$id_cliente','$idusuario','$data_transferencia','$addressOld','$addressNew')");
    $trans->execute();

    // Update no pont
    $cliente = $pdo->prepare("UPDATE clientes SET fk_id_bairro='$id_bairro',endereco='$endereco' WHERE id_cliente='$id_cliente'");
    $cliente->execute();

    // insert instalacoes

    $instalacao = $pdo->prepare("INSERT INTO instalacoes (fk_id_usuario,fk_id_tecnico,fk_id_cliente,data_agendamento,status_agendamento,tipo_instalacao) 
    values ('$idusuario','25','$id_cliente','$data_limite','agendar','$tipoTransferencia')");
    $instalacao->execute();


    echo "<script>location.href='?pg=cliente-inseri-transf&sucesso'</script>"; 

}?>
</div><!-- Fecha Id Janela-->
</section>
