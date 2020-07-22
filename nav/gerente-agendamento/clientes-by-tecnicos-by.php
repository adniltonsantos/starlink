<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<script>
function Redireciona(obj)
{
var src = "?pg=clientes-by-tecnicos-by&between&data=<?php echo $_GET['data'];?>&data2=<?php echo $_GET['data2'];?>&id_tecnico="+obj.value;
location.href = src;
}
</script>

<section>



<div id="janela">



<legend>Controle de Agendamento por Técnico</legend>

<!-- Formulario de Pesquisa em Jquery-->
<form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control" autofocus  placeholder="Pesquise" />
 </form>
<!-- Fecha Formulario-->


        <!-- Formulario do envio de codbarra para a inseri-estoque -->
<form method="POST" name="myForm" id="myForm" action="?pg=clientes-by-tecnicos-by&filtro">
<div class="form-row">
            
            <div class="form-group col-md-3">
              <label for="">Técnico</label>
              <select name="id_tecnico" required class="form-control"  onchange="Redireciona(this)">
              <option value="">Selecione o Técnico</option>
              <?php 
              $tecnicosql = $pdo->prepare("SELECT * FROM tecnicos WHERE status_tecnico='ativo'");
              $tecnicosql->execute();
              while($linha = $tecnicosql->fetch(PDO::FETCH_ASSOC)){
              ?>
              
              <option value="<?php echo $linha['id_tecnico'] ?>" <?php echo selected( $_GET['id_tecnico'], $linha['id_tecnico'] ); ?> ><?php echo $linha['nome']; ?></option>

              <?php } ?>
              </select>
          
           </div>

    <div class="form-group col-md-3">
      <label for="">Data Inicial</label>
      <input type="date" class="form-control" name="data" value="<?php if($_GET['data']){echo $_GET['data'];}else{echo date('Y-m-d');}; ?>">
    </div>


    <div class="form-group col-md-3">
      <label for="">Data Final</label>
      <input type="date" class="form-control" name="data2" value="<?php if($_GET['data2']){echo $_GET['data2'];}else{echo date('Y-m-d');}; ?>">
    </div>


<br /> 
<button type="submit" style="margin-top:5px" onclick="document.getElementById('myForm').submit()"; class="btn btn-primary">Pesquisar</button>

</div> 

</form>
<!-- END do Formulario do envio de codbarra para a venda -->


<!-- Filtro por Técnico entre Datas -->
<?php if (isset($_GET['between'])){ ?>
     

        <br />
        <label for="">O.S Finalizadas</label>
        <table class="table table-hover">
        
        <thead>
        <tr>
        <th>Iclass</th>
        <th>O.S</th>
        <th>COD</th>
        <th>Nome do Cliente</th>
        <th>Técnico</th>
        <th>Agendado</th>
        <th colspan="5">Funções</th>
        </tr>
        </thead>
       
        <?php 

        $id_tecnico = $_GET['id_tecnico'];
        $data = $_GET['data'];  
        $data2 = $_GET['data2'];

        $agendadosql = $pdo->prepare("SELECT *, c.nome as nomeCliente from instalacoes as i 
        INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente
        INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
        WHERE status_agendamento='agendado' AND
        i.fk_id_tecnico = $id_tecnico AND
        DATE(data_agendamento) BETWEEN '$data' AND '$data2'");
      
        $agendadosql->execute();
        while($linha = $agendadosql->fetch(PDO::FETCH_ASSOC)){

        ?>

        <tr>
        <td>
          <?php if($linha['status_iclass'] == NULL){ ?>
            
            <a href="?pg=clientes-by-tecnicos-by&iclass&os=<?php echo $linha['id_instalacao'];?>&data=<?php echo $_GET['data']; ?>&data2=<?php echo $_GET['data']; ?>&id_tecnico=<?php echo $_GET['id_tecnico']; ?>">
            <span class="glyphicon glyphicon-random" style="color:blue" title="enviado" data-toggle="tooltip"></span>
            </a>
            <?php } else { ?>
            <span class="glyphicon glyphicon-random" style="color:red" title="Nao enviado" data-toggle="tooltip"></span> 
           

          <?php } ?>
        </td>
        <td><?php echo $linha['id_instalacao']?></td>
        <td><?php echo $linha['cod_cliente']?></td>
        <td><?php echo $linha['nomeCliente']?></td>
        <td><?php echo $linha['nome']?></td>
        <td><?php echo $dataBR = dataBR($linha['data_agendamento']);?></td>
        <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal1<?php echo $linha['id_instalacao']?>" class="glyphicon glyphicon-ok-sign" title="Finalizar" data-toggle="tooltip"></a></td> 
        <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal2<?php echo $linha['id_instalacao']?>" class="glyphicon glyphicon-info-sign" title="Resolução" data-toggle="tooltip"></a></td>
        <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal3<?php echo $linha['id_instalacao']?>" class="glyphicon glyphicon-transfer" title="Transferir" data-toggle="tooltip"></a></td> 
        <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal4<?php echo $linha['id_instalacao']?>" class="glyphicon glyphicon glyphicon-time" title="Reagendar" data-toggle="tooltip"></a></td>
        <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal5<?php echo $linha['id_instalacao']?>"  title="Comentário" data-toggle="tooltip">
        <?php 
          $id_cliente = $linha['id_cliente'];
          $comentariosql = $pdo->prepare("SELECT * from comentarios WHERE fk_id_cliente='$id_cliente'");
          $comentariosql->execute(); 
          if($comentariosql->rowCount() > 0){ ?> 
        <span class="glyphicon glyphicon-comment" style="color:red"></span>
        <?php } else { ?>

        <span class="glyphicon glyphicon-comment"></span>
        <?php } ?>
        </a></td>
        </tr>
       

    <!-- Modal -->
    <div class="modal fade" id="myModal1<?php echo $linha['id_instalacao']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Finalizar - <?php echo $linha['nomeCliente']?></h4>
      </div>

      <div style="padding:20px">
          <form method="POST" id="finalizar<?php echo $linha['id_instalacao'];?>" action="?pg=clientes-by-tecnicos-by&finalizar">
            <input type="hidden" name="os" value="<?php echo $linha['id_instalacao'] ?>">
            <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente'] ?>">
            <input type="hidden" name="data" value="<?php echo $_GET['data']?>">
            <input type="hidden" name="data2" value="<?php echo $_GET['data2']?>">
            <input type="hidden" name="pg_id_tecnico" value="<?php echo $_GET['id_tecnico']?>">
            Tem certeza que deseja finalizar a o.s de nº <strong><?php echo $linha['id_instalacao']; ?></strong> ?
            <br />  <br />  
           <label for="">Data do fechamenteo</label>
           <input style="width:200px" required name="data_fechamento" type="date" class="form-control">


            <?php 
            $id_instalacao = $linha['id_instalacao'];
            $sqltipo = $pdo->prepare("SELECT tipo from instalacoes as i INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente WHERE id_instalacao = '$id_instalacao'");
            $sqltipo->execute();
            $tipo = $sqltipo->fetch(PDO::FETCH_ASSOC);
   
            if($tipo['tipo'] == 'cond'){  ?>
              <br /><br />
              <select class="form-control" name="status_agendamento" id="status_agendamento">
              <option value="finalizado">Normal</option>
              <option value="finalizado2">Condominio Tubulação</option>
              </select>

            <?php } ?>
        
          <br />
          <br />
          <button onclick="document.getElementById('finalizar<?php echo $linha['id_instalacao'];?>').submit()"; class="btn btn-primary">OK</button>  
          </form>
      </div>

    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal2<?php echo $linha['id_instalacao']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Resolução - <?php echo $linha['nomeCliente']?></h4>
      </div>
      <div style="padding:20px">
          <form method="POST" id="motivo<?php echo $linha['id_instalacao'];?>" action="?pg=clientes-by-tecnicos-by&resolucao">
            <input type="hidden" name="os" value="<?php echo $linha['id_instalacao'] ?>">
            <input type="hidden" name="data" value="<?php echo $_GET['data']?>">
            <input type="hidden" name="data2" value="<?php echo $_GET['data2']?>">
            <input type="hidden" name="pg_id_tecnico" value="<?php echo $_GET['id_tecnico']?>">
            <label for="">Motivo</label>
            <select class="form-control" name="motivo">
              <option value="CTO">CTO</option>
              <option value="CANCELOU">CANCELOU</option>
              <option value="INDIS">INDISPONIBILIDADE</option>
              <option value="REAGENDAR">REAGENDAR</option>
              <option value="REDE">REDE</option>
              <option value="RC">RETORNO DE CLIENTE</option>
            </select>
          

          <br />
          <button onclick="document.getElementById('motivo<?php echo $linha['id_instalacao'];?>').submit()"; class="btn btn-primary">OK</button>  
          </form>
        
      </div>
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal3<?php echo $linha['id_instalacao']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Transferência - <?php echo $linha['nomeCliente']?></h4>
      </div>


      <div style="padding:20px">
      
          <form method="POST" id="transferencia<?php echo $linha['id_instalacao'];?>" action="?pg=clientes-by-tecnicos-by&transferencia">
          
              <label for="inputEmail4">Técnico </label>
              <input type="hidden" name="os" value="<?php echo $linha['id_instalacao']?>">
              <input type="hidden" name="data" value="<?php echo $_GET['data']?>">
              <input type="hidden" name="data2" value="<?php echo $_GET['data2']?>">
              <input type="hidden" name="pg_id_tecnico" value="<?php echo $_GET['id_tecnico']?>">
                <select name="id_tecnico" required class="form-control">
                    <option value="">Selecione o Técnico</option>
                    <?php 
                        //Pegando todos Produto na loja
                        $produto = $pdo->query("SELECT * FROM tecnicos WHERE status_tecnico = 'ativo'");
                        $produto->execute();
                        while($linha2 = $produto->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        
                        <option value="<?php echo $linha2['id_tecnico'] ?>" <?php echo selected( $_POST['id_tecnico'], $linha2['id_tecnico'] ); ?> ><?php echo $linha2['nome']; ?></option>
                      <?php } ?>
                  </select>
                  <br />
                  
                  <button onclick="document.getElementById('transferencia<?php echo $linha['id_instalacao'];?>').submit()"; class="btn btn-primary">OK</button>  
         
              
          </form>
 
        </div>
 
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal4<?php echo $linha['id_instalacao']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nomeCliente']?></h4>
      </div>

      <form method="POST" id="reagendar<?php echo $linha['id_instalacao'];?>" action="?pg=clientes-by-tecnicos-by&reagendar">
      <input type="hidden" name="os" value="<?php echo $linha['id_instalacao']?>">
      <input type="hidden" name="data" value="<?php echo $_GET['data']?>">
      <input type="hidden" name="data2" value="<?php echo $_GET['data2']?>">
      <input type="hidden" name="pg_id_tecnico" value="<?php echo $_GET['id_tecnico']?>">
              
         
          <div style="padding:20px">
          
                    
      
          <label for="">Data de Instalação</label>
          <input style="width:200px" required name="data_agendamento" type="date" class="form-control">
          
            <br />
            <button onclick="document.getElementById('reagendar<?php echo $linha['id_instalacao'];?>').submit()"; class="btn btn-primary">Reagendar</button>  
              </div>    
          </form>
       
      <!-- Parte da mensagem que os dados foram salvos -->
      <div class="modal-body">
        


      </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal5<?php echo $linha['id_instalacao']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">
<?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
     </div>
     <div style="padding:20px">

      <form method="POST" id="comentario<?php echo $linha['id_cliente'];?>" action="?pg=clientes-by-tecnicos-by&comentario">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente = $linha['id_cliente']?>">
          <input type="hidden" name="data" value="<?php echo $_GET['data']?>">
          <input type="hidden" name="data2" value="<?php echo $_GET['data2']?>">
          <input type="hidden" name="pg_id_tecnico" value="<?php echo $_GET['id_tecnico']?>">
          
          
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
<?php } }?>
</table>

</div><!-- Fecha Id Janela-->
</section>




<?php if (isset($_GET['finalizar'])){
$data =  $_POST['data'];
$data2 =  $_POST['data2'];
$os =  $_POST['os'];
$pg_id_tecnico =  $_POST['pg_id_tecnico'];
$data_fechamento = $_POST['data_fechamento'];
$id_cliente = $_POST['id_cliente'];

$sql = $pdo->prepare("UPDATE instalacoes SET status_agendamento='finalizado' , data_fechamento='$data_fechamento' WHERE id_instalacao='$os'");
$sql->execute();

$cliente = $pdo->prepare("UPDATE clientes SET status_cliente='ativo' WHERE id_cliente='$id_cliente'");
$cliente->execute();

echo "<script>location.href='?pg=clientes-by-tecnicos-by&between&data=".$data."&data2=".$data2."&id_tecnico=".$pg_id_tecnico."'</script>"; 
} ?>

<?php if (isset($_GET['resolucao'])){
$data =  $_POST['data'];
$data2 =  $_POST['data2'];
$motivo =  $_POST['motivo'];
$pg_id_tecnico =  $_POST['pg_id_tecnico'];
$os = $_POST['os'];
$sql = $pdo->prepare("UPDATE instalacoes SET status_agendamento='$motivo' WHERE id_instalacao='$os'");
$sql->execute();
echo "<script>location.href='?pg=clientes-by-tecnicos-by&between&data=".$data."&data2=".$data2."&id_tecnico=".$pg_id_tecnico."'</script>"; 
} ?>

<?php if (isset($_GET['transferencia'])){
$data =  $_POST['data'];
$data2 =  $_POST['data2'];
$id_tecnico =  $_POST['id_tecnico'];
$pg_id_tecnico =  $_POST['pg_id_tecnico'];
$os = $_POST['os'];
$id_usuario = $_COOKIE['idusuario'];
$sql = $pdo->prepare("UPDATE instalacoes SET fk_id_tecnico='$id_tecnico', fk_id_usuario='$id_usuario' WHERE id_instalacao='$os'");
$sql->execute();
echo "<script>location.href='?pg=clientes-by-tecnicos-by&between&data=".$data."&data2=".$data2."&id_tecnico=".$pg_id_tecnico."'</script>"; 
} ?>

<?php if (isset($_GET['filtro'])){
$data =  $_POST['data'];
$data2 =  $_POST['data2'];
$id_tecnico =  $_POST['id_tecnico'];

echo "<script>location.href='?pg=clientes-by-tecnicos-by&between&data=".$data."&data2=".$data2."&id_tecnico=".$id_tecnico."'</script>"; 
} ?>

<?php if (isset($_GET['reagendar'])){
$data =  $_POST['data'];
$data2 =  $_POST['data2'];
$os = $_POST['os'];
$data_agendamento = $_POST['data_agendamento'];
$pg_id_tecnico =  $_POST['pg_id_tecnico'];
$id_usuario = $_COOKIE['idusuario'];
$sql = $pdo->prepare("UPDATE instalacoes SET data_agendamento='$data_agendamento', fk_id_usuario='$id_usuario' WHERE id_instalacao='$os'");
$sql->execute();
echo "<script>location.href='?pg=clientes-by-tecnicos-by&between&data=".$data."&data2=".$data2."&id_tecnico=".$pg_id_tecnico."'</script>";  
} ?>
 <!-- Paginação em Jquery-->

 <?php 
if (isset($_GET['comentario'])){
    $data =  $_POST['data'];
    $data2 =  $_POST['data2'];
    $pg_id_tecnico =  $_POST['pg_id_tecnico'];

    $comentario = $_POST['comentario'];
    $dataC = date('Y-m-d H:i:s');
    $idusuario = $_COOKIE['idusuario'];
    $id_cliente = $_POST['id_cliente'];
   
    $comentsql = $pdo->prepare("INSERT INTO comentarios (comentario,data_comentario,fk_id_usuario,fk_id_cliente)
    values ('$comentario','$dataC','$idusuario','$id_cliente')");
    $comentsql->execute();

    echo "<script>location.href='?pg=clientes-by-tecnicos-by&between&data=".$data."&data2=".$data2."&id_tecnico=".$pg_id_tecnico."'</script>";  
  }
?>

<?php 
if (isset($_GET['iclass'])){

    $data = $_GET['data'];
    $data2 = $_GET['data2'];
    $pg_id_tecnico = $_GET['id_tecnico'];
    $os = $_GET['os'];

    $ossql = $pdo->prepare("UPDATE instalacoes SET status_iclass='1' where id_instalacao='$os' ");
    $ossql->execute();
   

    echo "<script>location.href='?pg=clientes-by-tecnicos-by&between&data=".$data."&data2=".$data2."&id_tecnico=".$pg_id_tecnico."'</script>";  
}
?>

    
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