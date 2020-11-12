<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<section>

<div id="janela">

<legend>Clientes parados por CTO</legend>

<!-- Formulario de Pesquisa em Jquery-->
<form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control" autofocus  placeholder="Pesquise" />
 </form>
<!-- Fecha Formulario-->


        <br />
        <table class="table table-hover">

        <thead>
        <tr>
        <th>O.S</th>
        <th>COD</th>
        <th>Nome do Cliente</th>
        <th>Técnico</th>
        <th>Agendamento</th>
        <th colspan='4'>Funcoes</th>
        </tr>
        </thead>
       
       <?php 
   
      
        $agendadosql = $pdo->prepare("SELECT *, c.nome as nomeCliente from instalacoes as i 
        INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente
        INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
        WHERE status_agendamento='CTO' 
        ORDER BY i.data_agendamento ASC ");
      
        $agendadosql->execute();
        while($linha = $agendadosql->fetch(PDO::FETCH_ASSOC)){

        ?>

        <tr>
        <td><?php echo $linha['id_instalacao']?></td>
        <td><?php echo $linha['cod_cliente']?></td>
        <td><?php echo $linha['nomeCliente']?></td>
        <td><?php echo $linha['nome']?></td>
        <td><?php $data = str_replace("/", "-", $linha['data_agendamento']);
        echo date('d/m/Y', strtotime($data))?></td>
        <td class="centro-table"><a href="" aria-hidden="true" data-toggle="modal" data-target="#myModal<?php echo $linha['id_instalacao']?>" class="glyphicon glyphicon-retweet" title="Retornar" data-toggle="tooltip"></a></td> 
        </tr>

        
<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['id_instalacao']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nomeCliente']?></h4>
      </div>


      <form method="POST" id="retornar<?php echo $linha['id_instalacao'];?>" action="?pg=clientes-cto&update">
          <input type="hidden" name="id_instalacao" value="<?php echo $linha['id_instalacao']?>">
         
          <div style="padding:20px">
          

          <ul class="list-group">
          <li class="list-group-item disabled">Dados do Integrator</li>
          <li class="list-group-item">Bairro : <?php echo $linha['nomeBairro']?> </li>
          <li class="list-group-item">Endereço: <?php echo $linha['endereco']?></li>
          <li class="list-group-item">Referência: <?php echo $linha['referencia']?></li>
          <li class="list-group-item">Celular: <?php echo $linha['celular']?></li>
          <li class="list-group-item">Outro Celular: <?php echo $linha['celular2']?></li>
          <li class="list-group-item">Telefone: <?php echo $linha['telefone']?></li>
          </ul>

          <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Técnico</label>
                <select name="tecnico" required class="form-control" style="width:200px;" autofocus>
                <option value="">Selecione o Técnico</option>
                <?php 
                $tecnicosql = $pdo->prepare("SELECT * FROM tecnicos WHERE status_tecnico='ativo'");
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
        
        <button onclick="document.getElementById('retornar<?php echo $linha['id_instalacao'];?>').submit()"; class="btn btn-primary">Reagendar</button>  
             
        
       
        </div>    
          </form>


    </div>
  </div>
</div>


<?php }?>
</table>


<!-- Atualizando o cliente com o bairro correto -->
<?php 
if (isset($_GET['update'])){

    $id_instalacao = $_POST['id_instalacao'];
    $data = $_POST['data'];
    $fk_id_tecnico = $_POST['tecnico'];
    $idusuario = $_COOKIE["idusuario"];

    $insertsql = $pdo->prepare("UPDATE instalacoes SET status_agendamento='agendado', data_agendamento='$data', fk_id_tecnico='$fk_id_tecnico' WHERE id_instalacao='$id_instalacao'");
    $insertsql->execute();
    
    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='agendado' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();

  echo "<script>location.href='?pg=clientes-cto'</script>";  
}
?>


</div><!-- Fecha Id Janela-->
</section>

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