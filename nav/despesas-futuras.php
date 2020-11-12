<?php require_once "config.php"; $pdo = conectar(); require_once "function.php"; ?>

<script LANGUAGE="Javascript">
function FormataReais(fld, milSep, decSep, e) {
 var sep = 0;
 var key = '';
 var i = j = 0;
 var len = len2 = 0;
 var strCheck = '0123456789';
 var aux = aux2 = '';
 var whichCode = (window.Event) ? e.which : e.keyCode;
 if (whichCode == 13) return true;
 key = String.fromCharCode(whichCode);  // Valor para o código da Chave
 if (strCheck.indexOf(key) == -1) return false;  // Chave inválida
 len = fld.value.length;
 for(i = 0; i < len; i++)
 if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
 aux = '';
 for(; i < len; i++)
 if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
 aux += key;
 len = aux.length;
 if (len == 0) fld.value = '';
 if (len == 1) fld.value = '0'+ decSep + '0' + aux;
 if (len == 2) fld.value = '0'+ decSep + aux;
 if (len > 2) {
 aux2 = '';
 for (j = 0, i = len - 3; i >= 0; i--) {
 if (j == 3) {
 aux2 += milSep;
 j = 0;
 }
 aux2 += aux.charAt(i);
 j++;
 }
 fld.value = '';
 len2 = aux2.length;
 for (i = len2 - 1; i >= 0; i--)
 fld.value += aux2.charAt(i);
 fld.value += decSep + aux.substr(len - 2, len);
 }
 return false;
 }
 //Fim da Função FormataReais -->
</script>

<section>

<div id="janela">
<?php if(isset($_GET['excluir'])){
$id = $_GET['id'];
$del = $pdo->prepare("DELETE desp.*,pag.* FROM despesas as desp, pagamentodespesa as pag WHERE desp.iddespesa='$id' AND pag.idDespesaP='$id'");
$del->execute();
?>

<div class="alert alert-success">
<a href="?pg=despesas-futuras" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>

<legend>Despesas Não Pagas <span style="font-size:16px; margin-left:250px; padding:5px;">Hoje é <?php  $data = date('Y-m-d'); echo $data = implode("/",array_reverse(explode("-",$data))); ?> </span></legend>

<div id="conteudo">
<div class="well pesquise">
<!-- Formulario de Pesquisa em Jquery-->
 <form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control"  placeholder="Pesquise" />
 </form>
<!-- Fecha Formulario-->


<?php

$consulta = $pdo->prepare("SELECT desp.*, tipo.* FROM despesas as desp, tipodespesa as tipo WHERE desp.idDespesaN = tipo.idtipodespesa AND desp.status='Devedor'");
$consulta->execute();
$linha = $consulta ->rowCount();

if($linha > 0){

?>

<table class="table table-hover">

<thead>
<tr>
<th class="centro-table">Ref #</th>
<th class="centro-table">Nome</th>
<th class="centro-table">Data da Despesa</th>
<th class="centro-table">Valor Restante</th>
<th class="centro-table">Efetuar Pagamento</th>
</tr>
</thead>

<tbody>

<?php 

while($dados = $consulta->fetch(PDO::FETCH_ASSOC)){ 

$id = $dados['idDespesa'];
$consulta2 = $pdo->prepare("SELECT *, SUM(valor) as totalvalor FROM pagamentodespesa WHERE idDespesaP='$id'");
$consulta2->execute();
$query3 = $consulta2->fetch(PDO::FETCH_ASSOC);



 $a =  $query3['totalvalor'];
 $b =  $dados['valorDespesa'];

$r = $b - $a ;
?>
<tr>
<td class="centro-table"><?php echo $dados['idDespesa']?></td>
<td class="centro-table"><?php echo $dados['nometipodespesa']?></td>
<td class="centro-table"><?php echo $data = implode("/",array_reverse(explode("-",$dados['dataDespesa']))); ?></td>
<td class="centro-table">R$ <?php echo $valor = number_format($r, 2,',','.');?></td>
<td class="centro-table"><a href="?pg=detail-pag&id=<?php echo $dados['idDespesa'];?>"><button type="button" class="btn btn-success size-btn"accesskey="z"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></button></a></td>
</tr>



<?php } ?>

</tbody>


</table>

<?php } else { ?> 
<!-- Parte da mensagem que os dados foram salvos -->
<div class="alert alert-danger">
<strong>Atenção!</strong> Nenhuma despesa para ser paga no momento.
</div>

<?php } ?>
</div>

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
</div><!-- Fecha Id Conteudo-->
</div><!-- Fecha Id Janela-->
</section>
