<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<section>

<div id="janela">
<?php 

              
              
$agendadosql = $pdo->prepare("SELECT *, c.nome as nomeCliente from instalacoes as i 
INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente
INNER JOIN bairros as b on b.id_bairro=c.fk_id_bairro
WHERE status_agendamento='agendado' AND tipo='cond' AND
fk_id_tecnico='25'
ORDER BY i.data_agendamento ASC ");
$agendadosql->execute();
$total = $agendadosql->rowCount();

?>


<legend>Agendamento por Marcelo <span style="float:right">Total ( <?php echo $total ?> )</span>
</legend>


<!-- Formulario de Pesquisa em Jquery-->

<form method="post" action="exemplo.html" class="pesquise" >     


<div class="form-group col-md-12">
     <label for="">Procure por qualquer dado do campo</label>
     <input type="text" id="pesquisar" name="pesquisar" class="form-control" placeholder="Pesquise" />
</div>
</form>


</form>
<!-- Fecha Formulario-->


        <br />
        <table class="table table-hover" id="teste">

        <thead>
        <tr>
        <th>O.S</th>
        <th>COD</th>
        <th>Nome do Cliente</th>
        <th>Bairro</th>
        <th>Data do Agendamento</th>
        <th colspan="4">Funções</th>
        </tr>
        </thead>
       
       <?php 



        while($linha = $agendadosql->fetch(PDO::FETCH_ASSOC)){

        ?>

        <tr>
        <td><?php echo $linha['id_instalacao']?></td>
        <td><?php echo $linha['cod_cliente']?></td>
        <td><?php echo $linha['nomeCliente']?></td>
        <td><?php echo $linha['nome']?></td>
        <td><?php echo $dataBRagendamento = dataBR($linha['data_agendamento']);?></td>
        <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal2<?php echo $linha['id_instalacao']?>" class="glyphicon glyphicon glyphicon-time" title="Reagendar" data-toggle="tooltip"></a></td>
        <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal3<?php echo $linha['id_instalacao']?>"  title="Comentário" data-toggle="tooltip">
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
  <div class="modal fade" id="myModal2<?php echo $linha['id_instalacao']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nomeCliente']?></h4>
      </div>

      <form method="POST" id="reagendar<?php echo $linha['id_instalacao'];?>" action="?pg=cliente-by-agendamento&reagendar">
      <input type="hidden" name="os" value="<?php echo $linha['id_instalacao']?>">
      <input type="hidden" name="data" value="<?php echo $_GET['data']?>">

         
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
<div class="modal fade" id="myModal3<?php echo $linha['id_instalacao']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
     </div>
     <div style="padding:20px">

      <form method="POST" id="comentario<?php echo $linha['id_cliente'];?>" action="?pg=cliente-by-agendamento&comentario">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente = $linha['id_cliente']?>">
          <input type="hidden" name="data2" value="<?php echo $_GET['data']?>">
          
          
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



<?php }?>
</table>



</div><!-- Fecha Id Janela-->
</section>

<script LANGUAGE="Javascript">  

function enviar0(){
document.getElementById("myForm").submit();
}

</script>  


<?php if (isset($_GET['reagendar'])){

$os = $_POST['os'];
$data_agendamento = $_POST['data_agendamento'];
$id_usuario = $_COOKIE['idusuario'];
$data = $_POST['data'];

$sql = $pdo->prepare("UPDATE instalacoes SET data_agendamento='$data_agendamento', fk_id_usuario='$id_usuario' WHERE id_instalacao='$os'");
$sql->execute();

echo "<script>location.href='?pg=cliente-by-agendamento&data=".$data."'</script>"; 
} ?>


<?php 
if (isset($_GET['comentario'])){

    $comentario = $_POST['comentario'];
    $data = date('Y-m-d H:i:s');
    $idusuario = $_COOKIE['idusuario'];
    $id_cliente = $_POST['id_cliente'];

    $data2 = $_POST['data2'];
   
    $comentsql = $pdo->prepare("INSERT INTO comentarios (comentario,data_comentario,fk_id_usuario,fk_id_cliente)
    values ('$comentario','$data','$idusuario','$id_cliente')");
    $comentsql->execute();

    echo "<script>location.href='?pg=cliente-by-agendamento&data=".$data2."'</script>"; 
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

