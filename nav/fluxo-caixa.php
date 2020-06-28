<?php require_once "config.php"; $pdo = conectar(); require_once "function.php"; ?>

<script>
function Redireciona(obj)
{
var src = "?pg=fluxo-caixa&mes=<?php echo $numeromes = $_GET['mes'];?>&ano="+obj.value;
location.href = src;
}
</script>
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


<section>
<div id="janela">

<?php 

$sql_r = $pdo->prepare("SELECT *, SUM(valor_pagvenda) as totalp FROM pagvenda");
$sql_r->execute();
$sql_r_dados = $sql_r->fetch(PDO::FETCH_ASSOC);

$rr = $sql_r_dados['totalp'];

$cliente = $pdo->prepare("SELECT *,SUM(valor) as pagamento FROM pagamentodespesa");
$cliente->execute();
$dcliente = $cliente->fetch(PDO::FETCH_ASSOC);

$dd = $dcliente['pagamento'];

$receita = $rr - $dd;
?>
<legend>Fluxo de Caixa - <?php  $data = date('Y-m-d'); echo $data = implode("/",array_reverse(explode("-",$data))); ?><span style="float:right; font-size:14px; font-weight:bold; margin-top:2px;">(D) - Saldo em Caixa : R$ <?php echo $valor = number_format($receita, 2,',','.');?> </span></legend>


<div id="conteudo">
<div id="bloco_meses">
<div id="bloco_ano">
<select class='form-control' name="ano" id="ano" onchange="Redireciona(this)">
<?php 

$ano_sql = $pdo->prepare("SELECT DATE_FORMAT(data_pagvenda,'%Y') as ANO FROM pagvenda GROUP BY ANO");
$ano_sql->execute();
while($ano_dados = $ano_sql->fetch(PDO::FETCH_ASSOC)){
?>

<option value="<?php echo $ano_dados['ANO']; ?>" <?php echo selected( $_GET['ano'], $ano_dados['ANO'] ); ?> ><?php echo $ano_dados['ANO']; ?></option>

<?php }?>
</select>
</div>

<?php 
$ano = $_GET['ano'];
$balacante = $pdo->prepare("SELECT *, DATE_FORMAT(data_pagvenda,'%m') as mes  FROM pagvenda GROUP BY mes");
$balacante->execute();
?>
<div class="mes">
<?php while($dados = $balacante->fetch(PDO::FETCH_ASSOC)){ 
$mesnumerico = $dados['mes'];
$mes = $dados['mes'];
switch($mes)
{
case "01":$mes="Janeiro";break;
case "02":$mes="Fevereiro";break;
case "03":$mes="Março";break;
case "04":$mes="Abril";break;
case "05":$mes="Maio";break;
case "06":$mes="Junho";break;
case "07":$mes="Julho";break;
case "08":$mes="Agosto";break;
case "09":$mes="Setembro";break;
case "10":$mes="Outubro";break;
case "11":$mes="Novembro";break;
case "12":$mes="Dezembro";break;


}
?>


<a href="?pg=fluxo-caixa&mes=<?php echo $mesnumerico; ?>&ano=<?php echo $ano = $_GET['ano'] ?>"><button type="button" class="btn btn-primary"><?php echo $mes; ?> </a></button>

<?php } ?>

</div>
</div>
</center>


<?php 
$mes = $_GET['mes'];
switch($mes)
{
case "01":$mes="Janeiro";break;
case "02":$mes="Fevereiro";break;
case "03":$mes="Março";break;
case "04":$mes="Abril";break;
case "05":$mes="Maio";break;
case "06":$mes="Junho";break;
case "07":$mes="Julho";break;
case "08":$mes="Agosto";break;
case "09":$mes="Setembro";break;
case "10":$mes="Outubro";break;
case "11":$mes="Novembro";break;
case "12":$mes="Dezembro";break;


} 
?>
<div class="bloco-fluxo">
<div class="panel panel-primary receita">
                        <div class="panel-heading">
                           Receita de <?php echo $mes ?>/<?php echo $_GET['ano'];?> 
                        </div>
                        <div class="panel-body">

<?php 
$mesnumerico = $_GET['mes'];
$dia = $pdo->prepare("SELECT *, DATE_FORMAT(data_pagvenda,'%d') as dia, SUM(valor_pagvenda) as totaldia  FROM pagvenda WHERE DATE_FORMAT(data_pagvenda,'%Y') = '$ano' AND  DATE_FORMAT(data_pagvenda,'%m') = '$mesnumerico'  GROUP BY dia");
$dia->execute();
$linhadia = $dia->rowCount();

$sql_mes = $pdo->prepare("SELECT *, SUM(valor_pagvenda) as totalmes FROM pagvenda WHERE DATE_FORMAT(data_pagvenda,'%Y') = '$ano' AND  DATE_FORMAT(data_pagvenda,'%m') = '$mesnumerico'");
$sql_mes->execute();
$totalmes = $sql_mes->fetch(PDO::FETCH_ASSOC);
$totalmes = $totalmes['totalmes'];

if( $linhadia > 0){


?>
                           
<table class="table table-hover">
<thead>
<tr>
<th>Dia</th>
<th  class="centro-table">Vendas</th>
<th  class="centro-table">Recebidos</th>
<th  class="centro-table">Detalhes</th>
</tr>
</thead>
<?php while($dadosdia =$dia->fetch(PDO::FETCH_ASSOC)){ 
  
  
  ?>
<tr>

<td><strong><?php echo $d = $dadosdia['dia']; ?>/<?php echo $mes = $_GET['mes'];?></strong></td>
<?php 
$dadosdia = $dadosdia['totaldia'];?>
<td  class="centro-table" ><?php echo $valor = number_format($dadosdia, 2,',','.');?></td>
<?php 

$pagveado = $pdo->prepare("SELECT *, SUM(valor_pagveado) as totalveadodia FROM pagveado WHERE  DATE_FORMAT(data_pagveado,'%Y') = '$ano' AND  DATE_FORMAT(data_pagveado,'%m') = '$mesnumerico' AND  DATE_FORMAT(data_pagveado,'%d') = '$d' ");
$pagveado->execute();
$linha = $pagveado->fetch(PDO::FETCH_ASSOC);
?>
<td class="centro-table"><?php echo $linha['totalveadodia'];?></td>
<td class="centro-table">#</td>
</tr>
<?php }?>

</table>
                        </div>

<div class="panel-footer">
Total : R$ <?php echo $valor = number_format($totalmes, 2,',','.');?>
</div>

 <?php }else{ echo "Não tem Pagamento Lançado"; } ?>                       
                    </div>
                  </div>
               

<div class="panel panel-danger despesa">
<div class="panel-heading">
                          <?php $mesnumero = $_GET['mes'];
$ano = $_GET['ano'];
$mes = $_GET['mes'];
switch($mes)
{
case "01":$mes="Janeiro";break;
case "02":$mes="Fevereiro";break;
case "03":$mes="Março";break;
case "04":$mes="Abril";break;
case "05":$mes="Maio";break;
case "06":$mes="Junho";break;
case "07":$mes="Julho";break;
case "08":$mes="Agosto";break;
case "09":$mes="Setembro";break;
case "10":$mes="Outubro";break;
case "11":$mes="Novembro";break;
case "12":$mes="Dezembro";break;


} 
?>
Despesas de <?php echo $mes ?>/<?php echo $_GET['ano'];?> 
</div>
                        <div class="panel-body">
                     
<?php 
$mesnumero = $_GET['mes'];
$sql_despesas = $pdo->prepare("SELECT pag.*,tipo.*,DATE_FORMAT(datapagamento,'%d/%m/%Y - %H:%i') AS data_formatada FROM pagamentodespesa as pag , tipodespesa as tipo WHERE pag.idDespesaN = tipo.idtipodespesa AND DATE_FORMAT(pag.datapagamento,'%m') = '$mesnumero' AND DATE_FORMAT(pag.datapagamento,'%Y') = '$ano' ORDER BY pag.datapagamento ASC");
//$sql_despesas = $pdo->prepare("SELECT pag.*, tipo.* FROM pagamentodespesa as pag , tipodespesa as tipo WHERE pag.idDespesaN = tipo.idtipodespesa");
$sql_despesas->execute();
$contalinhadespesa = $sql_despesas->rowCount();

$total_despesa = $pdo->prepare("SELECT *, COUNT(produto) as qtd FROM  pagamentodespesa  WHERE DATE_FORMAT(datapagamento,'%m') = '$mesnumero' AND DATE_FORMAT(datapagamento,'%Y') = '$ano' ");
$total_despesa->execute();
$dados_total_despesa = $total_despesa->fetch(PDO::FETCH_ASSOC);
$despesa = $dados_total_despesa['totaldespesa'];

if($contalinhadespesa > 0){ ?>

<table class="table table-hover table-fluxo">
<thead>
<tr>
<th>Nome</th>
<th>Data Pagamento</th>
<th>Valor</th>
</tr>
</thead>

<?php 
while($dados_despesas = $sql_despesas->fetch(PDO::FETCH_ASSOC)){  ?>
<tr>
<td><strong><?php echo $dados_despesas['nometipodespesa'] ?></strong></td>
<td><?php echo $dados_despesas['data_formatada']; ?></span></td>
<td><?php echo $valor = number_format($dados_despesas['valor'], 2,',','.');?></td>
</tr>
<?php }?>

</table>

                        </div>
                        
<div class="panel-footer">
 Total :  R$ <?php echo $valor = number_format($dados_total_despesa['totaldespesa'], 2,',','.');?>
</div>
                      
               
               
<?php } else{ echo "Não tem Despesa Lançada"; } ?>

                      
</div>

</div><!--Bloco-fluxo-->


 <div class="panel panel-default resumo">
                        <div class="panel-heading">
                          Resumo
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
<tr>
<td><strong>Total Receita</strong></td>
<td>R$  <?php echo $r = number_format($totalmes, 2,',','.');?></td>
</tr>

<tr>
<td><strong>Total Despesa</strong></td>
<td>R$ <?php echo $d = number_format($dados_total_despesa['totaldespesa'], 2,',','.');?></span></td>
</tr>
<?php
$r =$totalmes;
$d = $dados_total_despesa['totaldespesa'];
$l = $r - $d ;

?>

<tr>
<td><strong>Total do Mês</strong></td>
<td>R$ <?php echo $valor = number_format($l, 2,',','.');?></td>
</tr>

</table>

                        </div>
<div class="panel-footer">
                      </div>
                    </div>

</div><!-- Conteudo-->
</div><!-- Fecha Id Janela-->
</section>
