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

<!-- Formulario de Pesquisa em Jquery-->
<form method="post" action="exemplo.html" class="pesquise" >     


<div class="form-group col-md-9">
     <label for="">Procure por qualquer dado do campo</label>
     <input type="text" id="pesquisar" name="pesquisar" class="form-control" placeholder="Digite o Código de Barra ou o Nome do Produto" />
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
    <th>Data de Cadastro</th>
    <th>Agendar</th>
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
    <td><?php echo $bairro = $linha['data_cadastro']?></span></td>
    <td class="centro-table"><a href="?pg=clientes-agendar&id_cliente=<?php echo $linha['id_cliente'];?>"><div aria-hidden="true" data-toggle="modal" data-target="#myModal<?php echo $linha['id_cliente']?>" class="glyphicon glyphicon-time"></div></td>
  
    </tr>


<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nomeCliente']?></h4>
      </div>

      <form method="POST" name="enviar" action="?pg=clientes-agendar&update">
          <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente']?>">
          <input type="hidden" name="tipo" value="<?php echo $linha['tipo']?>">
         
          <div style="padding:20px">
          
          <ul class="list-group">
          <li class="list-group-item disabled">Dados do Integrator</li>
          <li class="list-group-item">Bairro : <?php echo $linha['nomeBairro']?> </li>
          <li class="list-group-item">Endereço: <?php echo $linha['endereco']?></li>
          <li class="list-group-item">Referência: <?php echo $linha['referencia']?></li>
          </ul>
            
          <label for="">Agendar para o Técnico</label>
            <select name="tecnico" required class="form-control" style="width:200px;" autofocus>
            <option value="">Selecione o Técnico</option>
            <?php 
            $tecnicosql = $pdo->prepare("SELECT * FROM tecnicos WHERE status_tecnico='ativo'");
            $tecnicosql->execute();
            while($linha = $tecnicosql->fetch(PDO::FETCH_ASSOC)){
            ?>
            
          
            <option value="<?php echo $linha['id_tecnico'] ?>"><?php echo $linha['nome'] ?></option>
            <?php } ?>
            </select>
           <br />
          <label for="">Data de Instalação</label>
          <input style="width:200px" required name="data" type="date" class="form-control">
          
            <br />
            <button onclick="return validar();" class="btn btn-primary">Agendar</button>  
          </div>    
          </form>
       
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

</div>
</div><!-- Fecha Id Janela-->
</section>

