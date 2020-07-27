<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<section>


<div id="janela">
<legend>Procure por referencia</legend>

<form method="POST" id="ref" action="?pg=clientes-referencia&search">

    <div class="row">

    <div class="col-lg-12">
        <div class="input-group">
        <input type="text" name="cod_cliente" class="form-control" placeholder="Código do Cliente">
        <span class="input-group-btn">
        <button onclick="document.getElementById('ref').submit()"; class="btn btn-primary">OK</button>  
          </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</form>



        <br />
        <table class="table table-hover">

        <thead>
        <tr>
        <th>COD</th>
        <th>Nome do Cliente</th>
        <th>Ref</th>
        <th>status</th>
        <th colspan="4">Funções</th>
        </tr>
        </thead>
       
       <?php 



        $referencia = $_POST['referencia'];

        $clientes = $pdo->prepare("SELECT * from clientes WHERE referencia LIKE '$referencia'");
        $clientes->execute();
        while($linha = $clientes->fetch(PDO::FETCH_ASSOC)){

        ?>

        <tr>
        <td><?php echo $linha['cod_cliente']?></td>
        <td><?php echo $linha['nome']?></td>
        <td><?php echo $linha['referencia']?></td>
        <td><?php echo $linha['status_cliente']?></td>
        <td><?php echo $dataBR = dataBR($linha['data_agendamento']);?></td>
  </tr>


<?php }?>
</table>



</div><!-- Fecha Id Janela-->
</section>





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