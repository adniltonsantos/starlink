<?php require_once "config.php"; $pdo = conectar(); require_once("function.php"); ?>

<section>
<div id="janela">


<?php 


$consulta = $pdo->query("SELECT * FROM itens WHERE status_item='ativo' ORDER BY nome_item ASC  ");
$consulta->execute();

?>
<legend>Consulte o Item</legend>
<div id="conteudo">

<!-- Formulario de Pesquisa em Jquery-->
 <form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control" autofocus  placeholder="Digite o Código de Barra ou o Nome do Produto" />
 </form>
<!-- Fecha Formulario-->


<table class="table table-hover">

<thead>
<tr>
<th width="550px">Nome do Item</span></th>
<th>Código de Barra</th>
<th>Útimas Compras</th>
<th>Editar</th>
</tr>
</thead>
<?php 

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

?>

<tr>
<td><?php echo $linha['nome_item']?></span></td>
<td><?php echo $linha['codbarra_item']?></span></td>
<td class="centro-table"><span class="glyphicon glyphicon-new-window" aria-hidden="true" data-toggle="modal" data-target="#myModal<?php echo $linha['id_item']?>"></span></td>
<td class="centro-table"><a href="?pg=update-item&id_item=<?php echo $linha['id_item'];?>"><img src="icon/edit.png"></a></td>
</tr>


<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['id_item']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nome_item']?></h4>
      </div>

      <!-- Parte da mensagem que os dados foram salvos -->
      <div class="modal-body">
        
          <div class="alert alert-danger">
            <strong>Últimas 07 Compras !</strong>.
          </div>
            
          <?php 
          $id_item = $linha['id_item'];
          $compras = $pdo->prepare("SELECT * , DATE_FORMAT(c.data_compra,'%d/%m/%Y') AS data_compraf FROM fornecedoras as f INNER JOIN compras as c ON f.id_fornecedora=c.id_fornecedora WHERE c.id_item=$id_item ORDER BY c.data_compra ASC LIMIT 7");
          $compras->execute();
          ?>
          <ul class="list-group">
          <?php while($linha = $compras->fetch(PDO::FETCH_ASSOC)){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo $linha['nome'] ?>
              <span class="badge badge-primary badge-pill">R$ <?php echo real($linha['preco'])?></span>
              
              <span class="badge badge-primary badge-pill"> <?php echo $linha['data_compraf']?></span>
            </li>
          <?php } ?>
          </ul>

      </div>

    </div>
  </div>
</div>

<?php } ?>

</table>

</div><!-- Fecha Id conteudo-->
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
<!-- Fecha Paginação-->

</div><!-- Fecha Id conteudo-->
</div><!-- Fecha Id Janela-->
</section>


