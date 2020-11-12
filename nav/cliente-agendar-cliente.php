<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>


<!-- <script>
function Redireciona(obj)
{
var src = "?pg=clientes-agendar&selecionado&tipo="+obj.value;
location.href = src;
}
</script> -->

<section>
<div id="janela">
<div id="conteudo">

<?php 

$tipo = 'res';
$id_cliente = $_GET['id_cliente'];
$consulta = $pdo->prepare("SELECT *, c.nome as nomeCliente , b.nome as nomeBairro from clientes as c INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro WHERE c.tipo='$tipo' AND c.id_cliente='$id_cliente'");
$consulta->execute();
$linha = $consulta->fetch(PDO::FETCH_ASSOC)
?>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?></div>
  <!-- <div class="panel-body">
  </div> -->

  <!-- List group -->
  <ul class="list-group">
    <li class="list-group-item"><strong>BAIRRO : </strong><?php echo $bairro = $linha['nomeBairro']?></li>
    <li class="list-group-item"><strong>ENDEREÇO : </strong><?php echo $bairro = $linha['endereco']?></li>
    <li class="list-group-item"><strong>REFERENCIA : </strong><?php echo $bairro = $linha['referencia']?></li>
    <li class="list-group-item"><strong>CELULAR  : </strong><?php echo $bairro = $linha['celular']?></li>
    <li class="list-group-item">
      <button type="button" class="btn btn-primary btn-sm" aria-hidden="true" data-toggle="modal" data-target="#myModal<?php echo $linha['id_cliente']?>"><div>Agendar</button>
      <a href="?pg=cliente-agendar&ahahah"><button type="button" class="btn btn-info btn-sm">Comentario</button></a>
      <a href="?pg=cliente-agendar&whats&id_cliente=<?php echo $linha['id_cliente'];?>"><button type="button" class="btn btn-success btn-sm">Whats APP</button></a>
      <a href="?pg=cliente-agendar&sem-contato&id_cliente=<?php echo $linha['id_cliente'];?>" onclick="if (! confirm('Deseja marcar o cliente como Sem Contato ? ')) { return false; }"><button type="button" class="btn btn-danger btn-sm">Sem Contato</button></a>
      </li>

  </ul>
</div>


     
    


<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
<?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
     </div>

      <form method="POST" id="agendar<?php echo $linha['id_cliente'];?>" action="?pg=cliente-agendar&update">
          <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente']?>">
         
          <div style="padding:20px">
          
           <br />
          <label for="">Data de Instalação</label>
          <input style="width:200px" required name="data" type="date" class="form-control">
          
            <br />
            <button onclick="document.getElementById('agendar<?php echo $linha['id_cliente'];?>').submit()"; class="btn btn-primary">OK</button></div>    
          </form>
       

    </div>
  </div>
</div>

<!-- Atualizando o cliente com o bairro correto -->
<?php 
if (isset($_GET['update'])){

    $data = $_POST['data'];
    $fk_id_cliente = $_POST['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];

    $insertsql = $pdo->prepare("INSERT INTO instalacoes (fk_id_usuario,fk_id_tecnico,fk_id_cliente,data_agendamento,status_agendamento) values
    ('$idusuario',0,'$fk_id_cliente','$data','agendado') ");
    $insertsql->execute();
    
    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='agendado' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();
   
    echo "<script>location.href='?pg=cliente-agendar'</script>"; 
}
?>

<?php 
if (isset($_GET['sem-contato'])){


    $fk_id_cliente = $_GET['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];

    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='sem-contato' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();
   
    echo "<script>location.href='?pg=cliente-agendar'</script>"; 
}
?>
<?php 
if (isset($_GET['whats'])){


    $fk_id_cliente = $_GET['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];

    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='whats' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();
   
    echo "<script>location.href='?pg=cliente-agendar'</script>"; 
}
?>

</div>
</div><!-- Fecha Id Janela-->
</section>

