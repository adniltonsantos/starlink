<?php require_once "config.php"; $pdo = conectar(); require_once("function.php"); ?>

<section>
<div id="janela">


<?php 


$consulta = $pdo->query("SELECT * FROM clientes");
$consulta->execute();

?>
<legend>Consulte o Cliente</legend>
<div id="conteudo">

<!-- Formulario de Pesquisa em Jquery-->
 <form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control" autofocus  placeholder="Digite o Código de Barra ou o Nome do Produto" />
 </form>
<!-- Fecha Formulario-->


<table class="table table-hover">

<thead>
<tr>
<th>COD</span></th>
<th>Nome</th>
<th>Editar</th>
</tr>
</thead>
<?php 

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

?>

<tr>
<td><?php echo $linha['cod_cliente']?></span></td>
<td><?php echo $linha['nome']?></span></td>
<td class="centro-table"><a href="?pg=update-item&id_item=<?php echo $linha['id_item'];?>"><img src="icon/edit.png"></a></td>
</tr>




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


