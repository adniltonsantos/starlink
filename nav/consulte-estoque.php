<?php require_once "config.php"; $pdo = conectar(); ?>

<section>
<div id="janela">

<?php 

$consulta = $pdo->query("SELECT * FROM itens WHERE status_item='ativo' ORDER BY nome_item ASC  ");
$consulta->execute();

?>
<legend>Consulte o Estoque</legend>
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
<th>COD</th>
<th>Minimo</th>
<th>Total</th>
</tr>
</thead>
<?php 

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

?>

<?php echo $linha['minimo'] < $linha['qtd'] ? '<tr>' : '<tr style="color:red">'?>
<td><?php echo $linha['nome_item']?></span></td>
<td><?php echo $linha['codbarra_item']?></span></td>
<td><?php echo $linha['minimo']?></span></td>
<td><?php echo $linha['qtd']?></span></td>
</tr>


<?php } ?>

</table>

 
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
