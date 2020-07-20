<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<section>



<div id="janela">

<legend>Tipo de Instação do Cliente</legend>
<?php
$sql = $pdo->prepare("SELECT * from clientes WHERE tipo='NULL'");
$sql->execute();
$linha = $sql->fetch(PDO::FETCH_ASSOC);
$linha = $linha['id_cliente'];
if($linha === NULL ){
?>
<!-- Parte da mensagem que existe os dados -->

<div class="alert alert-danger">
Nenhum cliente para atualizar o tipo <strong>!</strong> 
</div>

<?php } else { ?>

<table class="table table-hover">

    <thead>
    <tr>
    <th>Cod</th>
    <th>Nome</th>
    <th>Bairro</th>
    <th>Editar</th>
    </tr>
    </thead>

    <tr>
    
    <?php 
    $consulta = $pdo->prepare("SELECT *, c.nome as nomeCliente , b.nome as nomeBairro from clientes as c INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro WHERE c.tipo='NULL'");
    $consulta->execute();
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){ ?>
    <td><?php echo $linha['cod_cliente']?></span></td>
    <td><?php echo $linha['nomeCliente']?></span></td>
    <td><?php echo $bairro = $linha['nomeBairro']?></span></td>
    <td class="centro-table"><a href="?pg=import-validar&id_cliente=<?php echo $linha['id_cliente'];?>"><img aria-hidden="true" data-toggle="modal" data-target="#myModal<?php echo $linha['id_cliente']?>" src="icon/edit.png"></a></td>

    </tr>


<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nomeCliente']?></h4>
      </div>

      <form method="POST" name="enviar" id="enviar" action="?pg=clientes-correcao&update">
        <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente']?>">
        <div style="padding:20px">
        
        <ul class="list-group">
        <li class="list-group-item disabled">Dados do Integrator</li>
        <li class="list-group-item">Bairro : <?php echo $linha['nomeBairro']?> </li>
        <li class="list-group-item">Endereço: <?php echo $linha['endereco']?></li>
        <li class="list-group-item">Referência: <?php echo $linha['referencia']?></li>
        </ul>
          
        <label for="">Corrigir tipo de instalação :</label>
        <select name="tipo" required class="form-control" style="width:375px;" autofocus>
                       
        <option value="res">RESIDENCIA</option>
        <option value="cond">CONDOMINIO</option>
                  
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

<?php }  ?>
</table>

                      

<!-- Atualizando o cliente com o bairro correto -->
<?php 
if (isset($_GET['update'])){

 $id_cliente = $_POST['id_cliente'];
 $tipo = $_POST['tipo'];
 $status_cliente = 'aguardando-agendamento';

 $updatesql = $pdo->prepare("UPDATE clientes SET tipo='$tipo', status_cliente='$status_cliente' WHERE id_cliente='$id_cliente' ");
 $updatesql->execute();

 echo "<script>location.href='?pg=clientes-correcao'</script>"; 
}
?>
<?php } ?>
</div><!-- Fecha Id Janela-->
</section>

