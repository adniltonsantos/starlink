<?php require_once "config.php"; $pdo = conectar(); require_once "function.php"; ?>
<script>
function Redireciona(obj)
{
var src = "?pg=clientes-pesquisa&search&selecionado&cod=<?php 
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
<a href="?pg=clientes-pesquisa" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Transferência criada com sucesso.
</div>
<?php } ?>


<legend>Procure por referencia</legend>
    
<form method="POST" name="search" action="?pg=clientes-pesquisa-ref&search">

    <div class="row">

    <div class="col-lg-6">
        <div class="input-group">
        <input type="text" name="ref" class="form-control" placeholder="Digite a Referencia">
        <span class="input-group-btn">
        <button onclick="document.getElementById('search').submit()"; class="btn btn-primary">OK</button>  
          </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</form>


<table class="table table-hover">

<thead>
<tr>
<th>Cod</th>
<th>Nome</th>
<th>Referencia</th>
<th>Data do Cadastro</th>

<th>Satus</th>
</tr>
</thead>

 
<?php 

if(isset($_GET['search'])){ 

  $referencia = $_POST['ref'];
 

  $sql = $pdo->prepare("SELECT * FROM clientes WHERE referencia LIKE '%$referencia%'");  
  $sql->execute();

while($linha = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
<tr>
<td><?php echo $linha['cod_cliente']?></span></td>
<td><?php echo $linha['nome']?></span></td>
<td><?php echo $bairro = $linha['referencia']?></span></td>
<td><?php echo $dataBR = dataBR($linha['data_cadastro']);?></span></td>
<td><?php echo $status = $linha['status_cliente']?></span></td></tr>


<?php } } ?>





</div><!-- Fecha Id Janela-->
</section>