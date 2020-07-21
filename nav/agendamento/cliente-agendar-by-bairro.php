<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>


<script>
function Redireciona(obj)
{
var src = "?pg=cliente-agendar-bairro&selecionado&bairro="+obj.value;
location.href = src;
}
</script>

<section>
<div id="janela">
<div id="conteudo">

<table class="table table-hover">
        <label for="">Grade de Agendamentos</label>
        <thead>
        <tr>
        <th>Setores</th>
        <th><?php $dataHoje = date('Y-m-d');?>Hoje</th>
        <th><?php $dataHoje1 = date('Y-m-d',strtotime("+1 days"));?>Amanhã</th>
        <th><?php echo $dataHoje2 = date('d/m',strtotime("+2 days"));?></th>
        <th><?php echo $dataHoje3 = date('d/m',strtotime("+3 days"));?></th>
        <th><?php echo $dataHoje4 = date('d/m',strtotime("+4 days"));?></th>
        <th><?php echo $dataHoje5 = date('d/m',strtotime("+5 days"));?></th>
        <th><?php echo $dataHoje6 = date('d/m',strtotime("+6 days"));?></th>
        <th><?php echo $dataHoje7 = date('d/m',strtotime("+7 days"));?></th>
        </tr>
        </thead>
       

<tr>
  <td><span style="color:white;background:#836FFF	; padding:8px 15px">Setor 0<?php echo $setor='1'?></span></td>
  
  <?php 
  $dataHoje = date('Y-m-d');
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>

  <?php 
  $dataHoje = date('Y-m-d', strtotime("+1 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+2 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+3 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+4 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
    <?php 
  $dataHoje = date('Y-m-d', strtotime("+5 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+6 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+7 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
</tr>

<tr>
  <td><span style="color:white;background:#4682B4	; padding:8px 15px">Setor 0<?php echo $setor='2'?></span></td>
  
  <?php 
  $dataHoje = date('Y-m-d');
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>

  <?php 
  $dataHoje = date('Y-m-d', strtotime("+1 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+2 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+3 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+4 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
    <?php 
  $dataHoje = date('Y-m-d', strtotime("+5 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+6 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+7 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
</tr>

<tr>
  <td><span style="color:white;background:#BC8F8F	; padding:8px 15px">Setor 0<?php echo $setor='3'?></span></td>
  
  <?php 
  $dataHoje = date('Y-m-d');
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>

  <?php 
  $dataHoje = date('Y-m-d', strtotime("+1 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+2 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+3 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+4 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
    <?php 
  $dataHoje = date('Y-m-d', strtotime("+5 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+6 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+7 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
</tr>


</table>

<!-- Formulario de Pesquisa em Jquery-->
<form method="post" action="exemplo.html" class="pesquise" >     

<label for="">Selecione o Bairro</label>
<select name="id_bairro" required class="form-control" style="width:375px;" onchange="Redireciona(this)">
<option value="">Selecione o Bairro</option>
                        <?php 
                            //Pegando todos Produto na loja
                            $produto = $pdo->query("SELECT * FROM bairros ORDER BY nome ASC");
                            $produto->execute();
                            while($linha = $produto->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $linha['id_bairro'];?>" <?php echo selected( $_GET['bairro'], $linha['id_bairro'] ); ?> ><?php echo $linha['nome'];?></option>
                        <?php } ?>
                        </select>

</form>
<?php 

$tipo = 'res';
$id_bairro = $_GET['bairro'];
$consulta = $pdo->prepare("SELECT *, c.nome as nomeCliente , b.nome as nomeBairro from clientes as c 
INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
INNER JOIN setores as s ON s.id_setor=b.fk_id_setor
WHERE c.tipo='$tipo' AND c.status_cliente='aguardando-agendamento'
AND b.id_bairro='$id_bairro'
ORDER BY c.data_cadastro ASC");
$consulta->execute();
$linha = $consulta->fetch(PDO::FETCH_ASSOC)
?>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    <?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?>
    <?php 
      $setor = $linha['fk_id_setor'];
      if($setor == 1){ ?>
          <span style="color:white;background:#836FFF	; padding:5px 10px; float:right; margin-top:-5px;border-radius:80px;">Setor 01</span>
        <?php } ?>
 
    <?php 
      $setor = $linha['fk_id_setor'];
      if($setor == 2){ ?>
          <span style="color:white;background:#4682B4	; padding:5px 10px; float:right; margin-top:-5px;border-radius:80px;">Setor 02</span>
        <?php } ?>
   
    <?php 
      $setor = $linha['fk_id_setor'];
      if($setor == 3){ ?>
          <span style="color:white;background:#BC8F8F	; padding:5px 10px; float:right; margin-top:-5px;border-radius:80px;">Setor 03</span>
        <?php } ?>
    </div>
  
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
      
      <button type="button" class="btn btn-info btn-sm" aria-hidden="true" data-toggle="modal" data-target="#myModal2<?php echo $linha['id_cliente']?>"><div>Comentário 
      <?php 
      $id_cliente = $linha['id_cliente'];
      $comentariosql = $pdo->prepare("SELECT * from comentarios WHERE fk_id_cliente='$id_cliente'");
      $comentariosql->execute(); 
      if($comentariosql->rowCount() > 0){ ?> 
      <span class="glyphicon glyphicon-eye-open" style="margin:0px 0 0 5px"></span>
      <?php } ?>
      </button>
      
      <a href="?pg=cliente-agendar-bairro&whats&id_cliente=<?php echo $linha['id_cliente'];?>&bairro=<?php echo $_GET['bairro'];?>"><button type="button" class="btn btn-success btn-sm">Whats APP</button></a>
   
      <a href="?pg=cliente-agendar-bairro&sem-contato&id_cliente=<?php echo $linha['id_cliente'];?>&bairro=<?php echo $_GET['bairro'];?>" onclick="if (! confirm('Deseja marcar o cliente como Sem Contato ? ')) { return false; }"><button type="button" class="btn btn-danger btn-sm">Sem Contato</button></a>
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

      <form method="POST" id="agendar<?php echo $linha['id_cliente'];?>" action="?pg=cliente-agendar-bairro&update">
          <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente']?>">
          <input type="hidden" name="id_bairro" value="<?php echo $id_bairro = $_GET['bairro']?>">
         
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


<!-- Modal -->
<div class="modal fade" id="myModal2<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">
<?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
     </div>
     <div style="padding:20px">

      <form method="POST" id="comentario<?php echo $linha['id_cliente'];?>" action="?pg=cliente-agendar-bairro&comentario">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente = $linha['id_cliente']?>">
          <input type="hidden" name="tipo" value="<?php echo $tipo = $linha['tipo']?>">
          <input type="hidden" name="id_bairro" value="<?php echo $id_bairro = $_GET['bairro']?>">
         
          
          
          <label for="">Comentário</label>
          <textarea name="comentario" required cols="30" rows="2" class="form-control"></textarea> 
            <br />
            <button onclick="document.getElementById('comentario<?php echo $linha['id_cliente'];?>').submit()"; class="btn btn-primary">Comentar</button></div>    
          </form>

          <ul class="list-group"style="margin:10px">
          <?php 
            $comentariosql = $pdo->prepare("SELECT * from comentarios as c INNER JOIN 
            usuarios as u ON u.idusuario = c.fk_id_usuario
            WHERE c.fk_id_cliente='$id_cliente' ORDER BY c.data_comentario DESC");
            $comentariosql->execute();
             while($linha = $comentariosql->fetch(PDO::FETCH_ASSOC)){
            
          ?>
            
              <li class="list-group-item" style="margin-bottom:20px; ">
              <div style="padding:10px"><?php echo $linha['comentario']?></div>
              <div class="badge"> 
                <?php $data = str_replace("/", "-", $linha['data_comentario']);
                echo date('d/m/Y H:i:s', strtotime($data))?>
              </div>
             
              <div class="badge" style="background:#6495ED">escrito por : <?php echo $linha['usuario'];?></div></li>
  
                 
      <?php } ?>
      </ul>
       </div>

    </div>
  </div>
</div>



<?php 
if (isset($_GET['update'])){
   
    $id_bairro = $_POST['id_bairro'];
    $data = $_POST['data'];
    $fk_id_cliente = $_POST['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];


    $insertsql = $pdo->prepare("INSERT INTO instalacoes (fk_id_usuario,fk_id_tecnico,fk_id_cliente,data_agendamento,status_agendamento,tipo) values
    ('$idusuario','0','$fk_id_cliente','$data','agendado','res') ");
    $insertsql->execute();
    
    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='agendado' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();

    echo "<script>location.href='?pg=cliente-agendar-bairro&selecionado&bairro=".$id_bairro."'</script>"; 
 
}
?>

<?php 
if (isset($_GET['comentario'])){
    $id_bairro = $_POST['id_bairro'];
    $comentario = $_POST['comentario'];
    $data = date('Y-m-d H:i:s');
    $idusuario = $_COOKIE['idusuario'];
    $id_cliente = $_POST['id_cliente'];
   
    $comentsql = $pdo->prepare("INSERT INTO comentarios (comentario,data_comentario,fk_id_usuario,fk_id_cliente)
    values ('$comentario','$data','$idusuario','$id_cliente')");
    $comentsql->execute();

    echo "<script>location.href='?pg=cliente-agendar-bairro&selecionado&bairro=".$id_bairro."'</script>"; 
}
?>

<?php 
if (isset($_GET['sem-contato'])){
    $id_bairro = $_GET['bairro'];

    $fk_id_cliente = $_GET['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];

    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='sem-contato' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();
   
    echo "<script>location.href='?pg=cliente-agendar-bairro&selecionado&bairro=".$id_bairro."'</script>"; 

}
?>
<?php 
if (isset($_GET['whats'])){
    $id_bairro = $_GET['bairro'];

    $fk_id_cliente = $_GET['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];

    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='whats' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();
   
    echo "<script>location.href='?pg=cliente-agendar-bairro&selecionado&bairro=".$id_bairro."'</script>"; 

}
?>

</div>
</div><!-- Fecha Id Janela-->
</section>

