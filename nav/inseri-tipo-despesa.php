<script language="javascript" type="text/javascript">

 function validar() {

var nome = enviar.nome.value;

if (nome == "") { 
alert('Preencha o campo Nome do tipo da despesa'); 
enviar.nome.focus(); 
return false; 
}else{

        enviar.submit();  
    }  



}

 </script> 

<section>
<div id="janela">
<?php 

if (isset($_GET['submit'])) {

$nome = $_POST['nome'];

$insert = $pdo->prepare("INSERT INTO tipodespesa (nometipodespesa) values ('$nome')");
$insert->execute();
?>

<!-- Parte da mensagem que os dados foram salvos -->
<div class="alert alert-success">
<a href="?pg=inseri-tipo-despesa" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>


<?php } ?>

<?php 

if(isset($_GET['update'])){

$nome = $_POST['nome']; 
$idtipodespesa = $_POST['id']; 

 // Insere os dados no banco 
 
$update = $pdo->prepare("UPDATE tipodespesa SET nometipodespesa='$nome' WHERE idtipodespesa='$idtipodespesa'");  
$update->execute();
 // Se os dados forem inseridos com sucesso 
 
 echo "<script>location.href='?pg=inseri-tipo-despesa&sucesso'</script>"; 
}

?>
<!-- Parte da mensagem que os dados foram salvos -->
<?php if(isset($_GET['sucesso'])){?>
<div class="alert alert-success">
<a href="?pg=inseri-tipo-despesa" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>


<legend>Cadastra Tipo de Despesa</legend>
<div id="conteudo">


<form  method="post" enctype="multipart/form-data" id="enviar" action="?pg=inseri-tipo-despesa&submit">
<p>

<div class="form-group">
<label for="pesquisar">Nome do tipo da Despesa</label>
<input type="text" class="form-control" name="nome" placeholder="Nome da Despesa" size="50">
</div>
<button onclick="return validar();" class="btn btn-primary">Salvar Dados</button>
</p>
</form>

<div class="well pesquise">
<div class="form-group">
<!-- Formulario de Pesquisa em Jquery-->
 <form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control" autofocus  placeholder="Consulte os Tipo de Despesa Cadastrado" />
 </form>
<!-- Fecha Formulario-->


<table class="table table-hover">

<thead>
<tr>
<th width="550px">Nome do Tipo de Despesa</th>
<th class="centro-table"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></th>

</tr>
</thead>
<?php 

$sql = $pdo->prepare("SELECT * FROM tipodespesa ORDER BY nometipodespesa");
$sql->execute();
while($linha = $sql->fetch(PDO::FETCH_ASSOC)){

?>

<tr>
<td><?php echo $linha['nometipodespesa']?></td>
<td class="centro-table"><span class="glyphicon glyphicon-new-window" aria-hidden="true" data-toggle="modal" data-target="#myModal<?php echo $linha['idtipodespesa']?>"></span></td>
</tr>




<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['idtipodespesa']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nometipodespesa']?></h4>
      </div>
      <div class="modal-body">
<!-- Parte da mensagem que os dados foram salvos -->
<div class="alert alert-danger">
<strong>Atenção!</strong> Ao alterar , todos os registro que estão em uso com nome antigo , será atualizado também.
</div>

      <form method="POST" id="enviar2" name="enviar2" action="?pg=inseri-tipo-despesa&update">

<div class="form-group">
<input type="text" name="nome" class="form-control" autofocus placeholder="Digite o novo nome do Tipo da Despesa">
<input type="hidden" name="id" value="<?php echo $linha['idtipodespesa']?>">

</div>

        <button type="submit" onClick="document.forms['enviar2'].submit();"  class="btn btn-primary">Atualizar</button>

</form>

   
      </div>

    </div>
  </div>
</div>

<?php } ?>

</table>
</div>
</div>

</div><!-- Fecha Id conteudo-->
</div><!-- Fecha Id Janela-->
</section>

<script>
    $(function(){
      
      $('table.venda > tbody > tr:odd').addClass('odd');
      
      $('table.venda  > tbody > tr').hover(function(){
        $(this).toggleClass('hover');
      });
      
      $('#marcar-todos').click(function(){
        $('table > tbody > tr > td > :checkbox')
          .attr('checked', $(this).is(':checked'))
          .trigger('change');
      });
      
      $('table.venda  > tbody > tr > td > :checkbox').bind('click change', function(){
        var tr = $(this).parent().parent();
        if($(this).is(':checked')) $(tr).addClass('selected');
        else $(tr).removeClass('selected');
      });
      
      $('form.efeito').submit(function(e){ e.preventDefault(); });
      
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
      
      $("table.venda") 
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
          $('table.venda > tbody > tr').removeClass('odd');
          $('table.venda > tbody > tr:odd').addClass('odd');
        });
      
    });
    </script>