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

<script language="javascript" type="text/javascript">

 function validar() {


var codbarra = enviar.codbarra.value;

if (codbarra == "") { 
alert('Preencha o campo Código Barra'); 
enviar.codbarra.focus(); 
return false; 
}else{

        enviar.submit();  
    } 

 }

 </script> 

<section>
<div id="janela">
<legend>Relátorio dos Clientes Inativos</legend>


<!-- Formulario de Pesquisa em Jquery-->
 <form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control" autofocus  placeholder="Digite o Nome do Cliente" />
 </form>
<!-- Fecha Formulario-->

<table class="table table-striped table-hover">

<thead>
<tr>
<th>Nome do Cliente</span></th>
<th>Telefone</th>
<th class="centro-table">End</th>
<th class="centro-table">Cidade</th>
<th class="centro-table">Bairro</th>
<th class="centro-table">CEP</th>
<th class="centro-table">Conta</th>
<th class="centro-table">Editar</th>
</tr>
</thead>
<?php 

$consulta = $pdo->query("SELECT * FROM clientes WHERE cliente_status='inativo' ORDER BY nome ASC ");
$consulta->execute();

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){

?>

<tr>
<td><?php echo $linha['nome']?></td>
<td><?php echo $linha['telefone']?></td>
<td><?php echo $linha['end']?></td>
<td><?php echo $linha['cidade']?></td>
<td><?php echo $linha['bairro']?></td>
<td><?php echo $linha['CEP']?></td>
<td class="centro-table"><a href="?pg=detail-cliente&idcliente=<?php echo $linha['idcliente'];?>"><span class="glyphicon glyphicon-new-window"></span></a></td>
<td class="centro-table"><a href="?pg=update-cliente&idcliente=<?php echo $linha['idcliente'];?>"><img src="icon/edit.png"></a></td>

</tr>



<?php } ?>

</table>
 


    </div>
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