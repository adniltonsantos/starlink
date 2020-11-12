<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<section>



<div id="janela">

<!-- VERICA SE TEM prevclientes para ser processado -->
<?php 
    $sql = $pdo->prepare("SELECT * FROM prevclientes");
    $sql->execute();
    $linha = $sql->fetch(PDO::FETCH_ASSOC);
    $linha = $linha['id_prevcliente'];
    if($linha === NULL ){
?>
    <!-- Parte da mensagem que existe os dados -->

<div class="alert alert-danger">
 Nenhum arquivo para ser válidado <strong>!</strong> 
</div>

<?php } else { ?>

<?php 
$importsql = $pdo->prepare("SELECT c.* ,b.* , c.nome as nomeCliente, b.nome as nomeBairro FROM prevclientes as c INNER JOIN bairros as b ON c.bairro = b.nome WHERE c.bairro = b.nome");
$importsql->execute();
while($linha = $importsql->fetch(PDO::FETCH_ASSOC)){
   
    $bairro = $linha['id_bairro'];
    $nomeBairro = $linha['nomeBairro'];
    $update = $pdo->prepare("UPDATE prevclientes SET bairro='$bairro' where bairro='$nomeBairro'");
    $update->execute();
    
}
?>
<legend>Inconsistências
<a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal" style="float:right;"  class="badge badge-secondary">Clientes</a>
</legend>

<!-- Modal -->
<div style="overflow-y: initial !important;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Clientes Importados da Planilha via Integrator</h4>
      </div>

      <!-- Parte da mensagem que os dados foram salvos -->
      <div class="modal-body">
        
      <div class="list-group">
      
      <table class="table table-hover">
          <thead>
          <tr>
          <th>Nome</th>
          <th>Data do Cadastro</th>
          </tr>
          </thead>
          <tbody class="table">

        <?php 
            $clientes = $pdo->prepare("SELECT *,DATE_FORMAT(data_cadastro,'%d/%m/%Y') as 'data_cadastro' FROM prevclientes");
            $clientes->execute();
            while($linha = $clientes->fetch(PDO::FETCH_ASSOC)){
        ?>
     
              <tr>
                  <td><?php echo $linha['nome'];?></td>
                  <td><?php echo $linha['data_cadastro'];?></td>
              </tr>
      
            <?php } ?>
            </tbody>
         </table>
    
      </div>

      </div>

    </div>
  </div>
</div>
<?php 
    $importsql = $pdo->prepare("SELECT * from prevclientes as c WHERE c.bairro NOT IN (SELECT id_bairro FROM bairros)  ");
    $importsql->execute();
    $registros = $importsql->rowCount();
    if ($registros == 0){  ?>  
    <div class="alert alert-success">
    Todos os Dados estão ok <strong>!</strong> 
    </div>

    <form method="POST" name="enviar" id="enviar" action="?pg=import-validar&migration">
        <button  class="btn btn-info">Processar Dados</button>
    </form>
    <?php } else { ?>    
<table class="table table-hover">

    <thead>
    <tr>
    <th>id</th>
    <th>Cod</th>
    <th>Nome</th>
    <th>Integrator</th>
    <th>Editar</th>
    </tr>
    </thead>

    <tr>
  
    <?php while($linha = $importsql->fetch(PDO::FETCH_ASSOC)){ ?>
    <td><?php echo $linha['id_prevcliente']?></span></td>
    <td><?php echo $linha['cod_cliente']?></span></td>
    <td><?php echo $linha['nome']?></span></td>
    <td><?php echo $bairro = $linha['bairro']?></span></td>
    <td class="centro-table"><a href="?pg=import-validar&id_prevcliente=<?php echo $linha['id_prevcliente'];?>"><img aria-hidden="true" data-toggle="modal" data-target="#myModal<?php echo $linha['id_prevcliente']?>" src="icon/edit.png"></a></td>

    </tr>





<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['id_prevcliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nome']?></h4>
      </div>

      <form method="POST" name="enviar" id="enviar" action="?pg=import-validar&update">
        <input type="hidden" name="id_prevcliente" value="<?php echo $linha['id_prevcliente']?>">
        <div style="padding:20px">
        
        <ul class="list-group">
        <li class="list-group-item disabled">Dados do Integrator</li>
        <li class="list-group-item">Bairro : <?php echo $linha['bairro']?> </li>
        <li class="list-group-item">Endereço: <?php echo $linha['endereco']?></li>
        <li class="list-group-item">Referência: <?php echo $linha['referencia']?></li>
        </ul>
          
        <label for="">Corrigir bairro para :</label>
        <select name="id_bairro" required class="form-control" style="width:375px;" autofocus>
                        
                        <?php 
                            //Pegando todos Produto na loja
                            $produto = $pdo->query("SELECT * FROM bairros ORDER BY nome ASC");
                            $produto->execute();
                            while($linha = $produto->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $linha['id_bairro'];?>"><?php echo $linha['nome'];?></option>
                        <?php } ?>
                        </select>
                                <br />
                        <button  class="btn btn-primary">Update</button>
        </form>
        </div>
      <!-- Parte da mensagem que os dados foram salvos -->
      <div class="modal-body">
        


      </div>

    </div>
  </div>
</div>

    <?php } } ?>
</table>

<!-- Atualizando o cliente com o bairro correto -->
<?php 
if (isset($_GET['update'])){

 $id_bairro = $_POST['id_bairro'];
 $id_prevcliente = $_POST['id_prevcliente'];

 $updatesql = $pdo->prepare("UPDATE prevclientes SET bairro='$id_bairro' WHERE id_prevcliente='$id_prevcliente' ");
 $updatesql->execute();

 echo "<script>location.href='?pg=import-validar'</script>"; 
}
?>


<!-- Migrando os Clientes para tabela clientes -->
<?php 
if (isset($_GET['migration'])){
   
   //Pega todos os dados da vprevclientes 

    $prevclientes = $pdo->query("SELECT * FROM prevclientes ");
    $prevclientes->execute();

    $sql = "INSERT INTO clientes (cod_cliente,data_cadastro,nome,endereco,referencia,dd,fone,fax,celular,tipo,status_cliente,fk_id_bairro,vendedor) values ";

    //Loop dos dados da venda provisoria
    while($linha = $prevclientes->fetch(PDO::FETCH_ASSOC)){

    $cod_cliente= $linha['cod_cliente'];
    $data_cadastro= $linha['data_cadastro'];
    $nome= $linha['nome'];
    $endereco= $linha['endereco'];
    $referencia= $linha['referencia'];
    $fk_id_bairro= $linha['bairro'];
    $dd= $linha['dd'];
    $fone= $linha['fone'];
    $fax= $linha['fax'];
    $celular= $linha['celular'];
    $tipo= 'NULL';
    $status_cliente= "aguardando-tipo";
    $vendedor= $linha['vendedor'];

    //update no vendedor
    if( $vendedor == 'Suporte (EliteSoft)'){
      $vendedor = 'atendimento';
    }
    if( $vendedor == 'Cleide - Boiçucanga'){
      $vendedor = 'cleide';
    }

    if( $vendedor == 'Tatiane - Boiçucanga'){
      $vendedor = 'tatiane';
    }
    
    $vendedor;

    $sql .= "('$cod_cliente','$data_cadastro','$nome','$endereco','$referencia','$dd','$fone','$fax','$celular','$tipo','$status_cliente','$fk_id_bairro','$vendedor'),";
    }

    // Tira o último caractere (vírgula extra)
    $sql = substr($sql, 0, -1);

    // Inseri os dados na tabela de Vendas
    $clientes = $pdo->prepare($sql);
    $clientes->execute();

    $truncate = $pdo->prepare("TRUNCATE TABLE prevclientes");
    $truncate->execute();
    echo '<script language="javascript">';
    echo 'alert("Arquivo Processado com Sucesso")';
    echo '</script>'; 

    echo "<script>location.href='?pg=clientes-correcao'</script>";
}
?>


<?php } ?>
</div><!-- Fecha Id Janela-->
</section>

