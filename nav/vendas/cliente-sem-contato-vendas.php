<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<section>

<div id="janela">
<?php 
if (isset($_GET['comentario'])){

    $comentario = $_POST['comentario'];
    $data = date('Y-m-d H:i:s');
    $idusuario = $_COOKIE['idusuario'];
     $id_cliente = $_POST['id_cliente'];
   
    $comentsql = $pdo->prepare("INSERT INTO comentarios (comentario,data_comentario,fk_id_usuario,fk_id_cliente)
    values ('$comentario','$data','$idusuario','$id_cliente')");
    $comentsql->execute();

    echo "<script>location.href='?pg=cliente-sem-contato-vendas</script>";  
}
?>


<legend>Clientes sem Contato</legend>

<!-- Formulario de Pesquisa em Jquery-->
<form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control" autofocus  placeholder="Pesquise" />
 </form>
<!-- Fecha Formulario-->


        <br />
        <table class="table table-hover">

        <thead>
        <tr>
        <th>COD</th>
        <th>Nome do Cliente</th>
        <th>Data do Contrato</th>
        <th colspan="3">Funções</th>
        </tr>
        </thead>
       
       <?php 

      
      
        $agendadosql = $pdo->prepare("SELECT *, nome as nomeCliente from clientes WHERE status_cliente='sem-contato' ORDER BY data_cadastro DESC ");
      
        $agendadosql->execute();
        while($linha = $agendadosql->fetch(PDO::FETCH_ASSOC)){

        ?>

        <tr>
        <td><?php echo $linha['cod_cliente']?></td>
        <td><?php echo $linha['nome']?></td>
        <td><?php echo $data = dataBR($linha['data_cadastro']);?></td>
        <td>            
            <a href="?pg=cliente-sem-contato-vendas&retornar&id_cliente=<?php echo $linha['id_cliente']?>">
            <span class="glyphicon glyphicon-repeat" title="Retornar" data-toggle="tooltip"></span>
            </a>
        </td>
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
        <td>            
            <a href="?pg=cliente-sem-contato-vendas&desativar&id_cliente=<?php echo $linha['id_cliente']?>">
            <span class="glyphicon glyphicon-off" title="Retornar" data-toggle="tooltip"></span>
            </a>
        </td>
        <td></td>
        </tr>


<!-- Modal -->
<div class="modal fade" id="myModal5<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">
<?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
     </div>
     <div style="padding:20px">

      <form method="POST" id="comentario<?php echo $linha['id_cliente'];?>" action="?pg=cliente-sem-contato-vendas&comentario">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente = $linha['id_cliente']?>">
          
          
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

<?php 
if (isset($_GET['retornar'])){

    $id_cliente = $_GET['id_cliente'];

    $ossql = $pdo->prepare("UPDATE clientes SET status_cliente='aguardando-agendamento' where id_cliente='$id_cliente' ");
    $ossql->execute();
   

    echo "<script>location.href='?pg=cliente-sem-contato-vendas'</script>"; 
}
?>

<?php 
if (isset($_GET['desativar'])){

    $id_cliente = $_GET['id_cliente'];

    $ossql = $pdo->prepare("UPDATE clientes SET status_cliente='desativando' where id_cliente='$id_cliente' ");
    $ossql->execute();
   

    echo "<script>location.href='?pg=cliente-cancelou-vendas'</script>"; 
}
?>


<script LANGUAGE="Javascript">  

function enviar0(){
document.getElementById("myForm").submit();
}

</script>  



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