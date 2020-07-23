<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>


<script>
function Redireciona(obj)
{
var src = "?pg=clientes-agendar&selecionado&tipo="+obj.value;
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
  $tipo = $_GET['tipo'];
  $dataHoje = date('Y-m-d');
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>

  <?php 
  $dataHoje = date('Y-m-d', strtotime("+1 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+2 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+3 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+4 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
    <?php 
  $dataHoje = date('Y-m-d', strtotime("+5 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+6 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+7 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
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
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>

  <?php 
  $dataHoje = date('Y-m-d', strtotime("+1 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+2 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+3 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+4 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
    <?php 
  $dataHoje = date('Y-m-d', strtotime("+5 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+6 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+7 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
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
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>

  <?php 
  $dataHoje = date('Y-m-d', strtotime("+1 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+2 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+3 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+4 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
    <?php 
  $dataHoje = date('Y-m-d', strtotime("+5 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+6 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
  <?php 
  $dataHoje = date('Y-m-d', strtotime("+7 days"));
  $hoje1 = $pdo->prepare("SELECT * FROM instalacoes as i  
  INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente 
  INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro
  WHERE i.status_agendamento='agendado' AND c.tipo='$tipo' AND i.data_agendamento='$dataHoje' AND b.fk_id_setor='$setor'");
  $hoje1->execute();
  echo "<td>".$hoje1->rowCount()."</td>";
  ?>
</tr>

</table>

<!-- Formulario de Pesquisa em Jquery-->
<form method="post" action="exemplo.html" class="pesquise" >     


<div class="form-group col-md-9">
     <label for="">Pesquise</label>
     <input type="text" id="pesquisar" name="pesquisar" class="form-control" placeholder="Digite por qualquer parte do campo" />
</div>


   <div class="form-group col-md-3">
     <label for="">Tipo de Instalação</label>
     <select name="tipo" class="form-control" onchange="Redireciona(this)">
       <option value="sel" <?php echo selected( $_GET['tipo'], "sel" ); ?> >Selecione o tipo</option>
       <option value="cond" <?php echo selected( $_GET['tipo'], "cond" ); ?> >Condominio</option>
       <option value="res" <?php echo selected( $_GET['tipo'], "res" ); ?> >Residencia</option>
     </select>
   </div>

</form>

<table class="table table-hover">

    <thead>
    <tr>
    <th>Cod</th>
    <th>Nome</th>
    <th>Bairro</th>
    <th>Referência</th>
    <th>Data de Cadastro</th>
    <th colspan="2">Funções</th>
    </tr>
    </thead>

     
    <?php 

    $tipo = $_GET['tipo'];
    $consulta = $pdo->prepare("SELECT *, c.nome as nomeCliente , b.nome as nomeBairro from clientes as c INNER JOIN bairros as b ON c.fk_id_bairro=b.id_bairro WHERE c.tipo='$tipo' AND c.status_cliente='aguardando-agendamento' ORDER BY c.data_cadastro ASC");
    $consulta->execute();
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){ ?>
    <tr>
    <td><?php echo $linha['cod_cliente']?></span></td>
    <td><?php echo $linha['nomeCliente']?></span></td>
    <td><?php echo $bairro = $linha['nomeBairro']?></span></td>
    <td><?php echo $bairro = $linha['referencia']?></span></td>
    <td><?php echo $dataBR = dataBR($linha['data_cadastro']);?></span></td>
    <td class="centro-table"><a href="?pg=clientes-agendar&id_cliente=<?php echo $linha['id_cliente'];?>"><div aria-hidden="true" data-toggle="modal" data-target="#myModal<?php echo $linha['id_cliente']?>" class="glyphicon glyphicon-time"></div></td>
    <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal5<?php echo $linha['id_cliente']?>"  title="Comentário" data-toggle="tooltip">
        <?php 
          $id_cliente = $linha['id_cliente'];
          $comentariosql = $pdo->prepare("SELECT * from comentarios WHERE fk_id_cliente='$id_cliente'");
          $comentariosql->execute(); 
          if($comentariosql->rowCount() > 0){ ?> 
        <span class="glyphicon glyphicon-comment" style="color:red"></span>
        <?php } else { ?>

        <span class="glyphicon glyphicon-comment"></span>
        <?php } ?>
        </a>
    </td>
    </tr>


<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nomeCliente']?></h4>
      </div>


      <form method="POST"  id="agendar<?php echo $linha['id_cliente'];?>" action="?pg=clientes-agendar&update">
          <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente']?>">
          <input type="hidden" name="tipo" value="<?php echo $linha['tipo']?>">
         
          <div style="padding:20px">
          

          <ul class="list-group">
          <li class="list-group-item disabled">Dados do Integrator</li>
          <li class="list-group-item">Bairro : <?php echo $linha['nomeBairro']?> </li>
          <li class="list-group-item">Endereço: <?php echo $linha['endereco']?></li>
          <li class="list-group-item">Referência: <?php echo $linha['referencia']?></li>
          <li class="list-group-item">DD: <?php echo $linha['dd']?> - <?php echo $linha['fone']?></li>
          <li class="list-group-item">Fax: <?php echo $linha['fax']?></li>
          <li class="list-group-item">Celular: <?php echo $linha['celular']?></li>
          </ul>

          <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Técnico</label>
                <select name="tecnico" required class="form-control" style="width:200px;" autofocus>
                <option value="">Selecione o Técnico</option>
                <option value="0">SEM TECNICO</option>
                <?php 
                $tecnicosql = $pdo->prepare("SELECT * FROM tecnicos WHERE status_tecnico='ativo' ORDER BY nome ASC");
                $tecnicosql->execute();
                while($linha2 = $tecnicosql->fetch(PDO::FETCH_ASSOC)){
                ?>
                
              
                <option value="<?php echo $linha2['id_tecnico'] ?>"><?php echo $linha2['nome'] ?></option>
                <?php } ?>
                </select>  
            </div>

            <div class="form-group col-md-6">
              <label for="">Data de Instalação</label>
              <input  required name="data" type="date" class="form-control">
            </div>
        </div>
        
        <button onclick="document.getElementById('agendar<?php echo $linha['id_cliente'];?>').submit()"; class="btn btn-primary">Agendar</button></div>    
        
       
        </div>    
          </form>


    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal5<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">
<?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
     </div>
     <div style="padding:20px">

      <form method="POST" id="comentario<?php echo $linha['id_cliente'];?>" action="?pg=clientes-agendar&comentario">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente = $linha['id_cliente']?>">
          <input type="hidden" name="tipo" value="<?php echo $linha['tipo']?>">
          
          
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

<?php }  ?>

</table>
  

<!-- Atualizando o cliente com o bairro correto -->
<?php 
if (isset($_GET['update'])){

    $data = $_POST['data'];
    $fk_id_tecnico = $_POST['tecnico'];
    $fk_id_cliente = $_POST['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];
    $tipo = $_POST['tipo'];

    $insertsql = $pdo->prepare("INSERT INTO instalacoes (fk_id_usuario,fk_id_tecnico,fk_id_cliente,data_agendamento,status_agendamento) values
    ('$idusuario','$fk_id_tecnico','$fk_id_cliente','$data','agendado') ");
    $insertsql->execute();
    
    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='agendado' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();

  echo "<script>location.href='?pg=clientes-agendar&selecionado&tipo=$tipo'</script>";  
}
?>


<?php 
if (isset($_GET['comentario'])){
    $tipo = $_POST['tipo'];

    $comentario = $_POST['comentario'];
    $data = date('Y-m-d H:i:s');
    $idusuario = $_COOKIE['idusuario'];
    $id_cliente = $_POST['id_cliente'];
   
    $comentsql = $pdo->prepare("INSERT INTO comentarios (comentario,data_comentario,fk_id_usuario,fk_id_cliente)
    values ('$comentario','$data','$idusuario','$id_cliente')");
    $comentsql->execute();

    echo "<script>location.href='?pg=clientes-agendar&selecionado&tipo=$tipo'</script>";  
}
?>

 <!-- Paginação em Jquery-->

    
 <script>
    $(function(){
      
      $('table > tbody > tr:odd').addClass('odd');
      
      $('table > tbody > tr').hover(function(){
        $(this).toggleClass('hover');
      });
      
      $('#marcar-todos').click(function(){
        $('table > tbody > tr > td > :checkbox')
          .attr('checked', $(this).is(':checked'))
          .trigger('change');
      });
      
      $('table > tbody > tr > td > :checkbox').bind('click change', function(){
        var tr = $(this).parent().parent();
        if($(this).is(':checked')) $(tr).addClass('selected');
        else $(tr).removeClass('selected');
      });
      
      $('form').submit(function(e){ e.preventDefault(); });
      
      $('#pesquisar').keydown(function(){
        var encontrou = false;
        var termo = $(this).val().toLowerCase();
        $('table > tbody > tr').each(function(){
          $(this).find('td').each(function(){
            if($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
          });
          if(!encontrou) $(this).hide();
          else $(this).show();
          encontrou = false;
        });
      });
      
      $("table") 
        .tablesorter({
          dateFormat: 'uk',
          headers: {
            0: {
              sorter: false
            },
            5: {
              sorter: false
            }
          }
        }) 
        .tablesorterPager({container: $("#pager")})
        .bind('sortEnd', function(){
          $('table > tbody > tr').removeClass('odd');
          $('table > tbody > tr:odd').addClass('odd');
        });
      
    });
    </script>

</div>
</div><!-- Fecha Id Janela-->
</section>





<!-- Fecha Paginação-->