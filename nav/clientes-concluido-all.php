<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>



<section>



<div id="janela">



<legend>Ordem de Serviços Finalizadas</legend>

<!-- Formulario de Pesquisa em Jquery-->

<!-- Fecha Formulario-->


        <!-- Formulario do envio de codbarra para a inseri-estoque -->
<form method="POST" name="myForm" id="myForm" action="?pg=clientes-concluido-all&filtro">
<div class="form-row">

<div class="form-group col-md-3">
<label for="">Pesquise</label>
<form method="post" action="exemplo.html" class="pesquise" >     
 <input type="text" id="pesquisar" name="pesquisar" class="form-control" autofocus  placeholder="Qualquer Parte" />
 </form>
 </div>

    <div class="form-group col-md-3">
      <label for="">Data Inicial</label>
      <input type="date" class="form-control" name="data" value="<?php if($_GET['data']){echo $_GET['data'];}else{echo date('Y-m-d');}; ?>">
    </div>


    <div class="form-group col-md-3">
      <label for="">Data Final</label>
      <input type="date" class="form-control" name="data2" value="<?php if($_GET['data2']){echo $_GET['data2'];}else{echo date('Y-m-d');}; ?>">
    </div>


<br /> 
<div class="form-group col-md-3">
<button type="submit" style="margin-top:5px" 
onclick="document.getElementById('myForm').submit()";
 class="btn btn-primary">Pesquisar</button>
 </div>

</div> 

</form>
<!-- END do Formulario do envio de codbarra para a venda -->


<!-- Filtro por Técnico entre Datas -->
<?php if (isset($_GET['between'])){ ?>
     

        <br />
        <label for="">O.S finalizadas entre datas</label>
        <table class="table table-hover">
        
        <thead>
        <tr>
        <th>O.S</th>
        <th>COD</th>
        <th>Nome do Cliente</th>
        <th>Técnico</th>
        <th>Pedido</th>
        <th>Fechamento</th>
        </tr>
        </thead>
       
        <?php 

        $data = $_GET['data'];  
        $data2 = $_GET['data2'];

        $agendadosql = $pdo->prepare("SELECT *, c.nome as nomeCliente from instalacoes as i 
        INNER JOIN clientes as c ON i.fk_id_cliente=c.id_cliente
        INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
        WHERE status_agendamento='finalizado' AND
        DATE(data_agendamento) BETWEEN '$data' AND '$data2'");
      
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
        <td><?php $data = str_replace("/", "-", $linha['data_fechamento']);
        echo date('d/m/Y', strtotime($data))?></td>
        </tr>


<?php } } ?>
</table>

</div><!-- Fecha Id Janela-->
</section>



<?php if (isset($_GET['filtro'])){
$data =  $_POST['data'];
$data2 =  $_POST['data2'];
echo "<script>location.href='?pg=clientes-concluido-all&between&data=".$data."&data2=".$data2."'</script>"; 
} ?>



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