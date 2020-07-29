<?php require_once "config.php"; $pdo = conectar(); require_once "function.php"; ?>
<script>
function Redireciona(obj)
{
var src = "?pg=clientes-pesquisa&search&selecionado&cod=<?php 
    if(isset($_POST['cod_cliente'])){
        echo $_POST['cod_cliente'];
        }else{
            echo $_GET['cod'];
        }; ?>&ponto="+obj.value;
location.href = src;
}
</script>

<section>

<div id="janela">

<!-- Parte da mensagem que os dados foram salvos -->
<?php if(isset($_GET['sucesso'])){?>
<div class="alert alert-success">
<a href="?pg=clientes-pesquisa" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Transferência criada com sucesso.
</div>
<?php } ?>


<legend>Procure pelo código</legend>
    
<form method="POST" name="search" action="?pg=clientes-pesquisa&search">

    <div class="row">

    <div class="col-lg-6">
        <div class="input-group">
        <input type="text" name="cod_cliente" class="form-control" placeholder="Código do Cliente">
        <span class="input-group-btn">
        <button onclick="document.getElementById('search').submit()"; class="btn btn-primary">OK</button>  
          </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</form>

<?php if(isset($_GET['search'])){ 

    $cod_cliente = $_POST['cod_cliente'];
    $cod_cliente2 = $_GET['cod'];

    $sql = $pdo->prepare("SELECT * FROM clientes WHERE cod_cliente='$cod_cliente' OR cod_cliente='$cod_cliente2'");  
    $sql->execute();
    if($sql->rowCount() > 0){  ?>  


    <div class="col-lg-6">
            <div class="input-group">
            <span class="input-group-btn">
                <form method="POST" action="?pg=clientes-pesquisa&search">
                <select class="form-control" name="ponto"  id="ponto" onchange="Redireciona(this)">
                <option value="">Selecione o Ponto </option>
                <?php 

                    $cliente = $pdo->query("SELECT * FROM clientes WHERE cod_cliente='$cod_cliente' OR cod_cliente='$cod_cliente2'");
                    $cliente->execute();
                    while($clienteDado = $cliente->fetch(PDO::FETCH_ASSOC)){
                    $i += 1;
                 ?>
                        
                    <option value="<?php echo $clienteDado['id_cliente'] ?>"<?php echo selected( $_GET['ponto'], $clienteDado['id_cliente'] ); ?>><?php echo $clienteDado['nome']; echo "(".$i.")"?> </option>
                <?php }  ?>
                </select>
                </form>
            </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->

   
<?php }else { ?>
    <div class="col-lg-12">
        <div class="input-group">
            <span style="color:red">cliente não encontrado</span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
<?php } } ?>
</div><!-- /.row -->

<?php 
if(isset($_GET['selecionado'])){

    $id_cliente = $_GET['ponto']; 
   
    $sql = $pdo->prepare("SELECT *, c.nome as nomeCliente FROM clientes as c
    INNER JOIN bairros as b ON b.id_bairro = c.fk_id_bairro
    WHERE id_cliente='$id_cliente'");  
    $sql->execute();
    $linha = $sql->fetch(PDO::FETCH_ASSOC); 

?>

<br />


  <!-- List group -->
  <ul class="list-group">
    <li class="list-group-item"><strong>COD : </strong><?php echo $cod = $linha['cod_cliente']?></li>
    <li class="list-group-item"><strong>TIPO DE INSTALACAO : </strong><?php $tipo = $linha['tipo']; if($tipo == 'res'){ echo "Residência";}else{ echo "Condominio";}?></li>
    <li class="list-group-item"><strong>NOME : </strong><?php echo $bairro = $linha['nomeCliente']?></li>
    <li class="list-group-item"><strong>BAIRRO : </strong><?php echo $bairro = $linha['nome']?> | <strong>END : </strong><?php echo $bairro = $linha['endereco']?></li>
    <li class="list-group-item"><strong>REFERENCIA : </strong><?php echo $referencia = $linha['referencia']?></li>
    <li class="list-group-item"><strong>CELULAR  : </strong><?php echo $celular = $linha['celular']?><strong> | DD  : </strong><?php echo $bairro = $linha['dd']?> - <?php echo $bairro = $linha['fone']?> | <strong>Fax</strong> - <?php echo $bairro = $linha['fax']?> - </li>
    <li class="list-group-item"><strong>VENDEDOR : </strong><?php echo $vendedor = $linha['vendedor']?></li>
    <li class="list-group-item"><strong>Status Atual : </strong>
    <span style="color:red">
    
    
    <?php 
      $status = $linha['status_cliente'];

      if($status == 'agendado'){
        $inst = $pdo->prepare("SELECT * FROM instalacoes as i 
        INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
        WHERE i.fk_id_cliente='$id_cliente' AND i.status_agendamento='agendado'");
        $inst->execute();
        $linhainsta = $inst->fetch(PDO::FETCH_ASSOC); 
        echo "Cliente já agendado para ser instalado em ".dataBR($linhainsta['data_agendamento']);
        echo " pelo técnico ";
       echo $linhainsta['nome'];
   
      }

      if($status == 'aguardando-agendamento'){
        echo "Aguardando a equipe de agendamento entrar em contato com o cliente e agendar uma data";
      }

      if($status == 'aguardando-tipo'){
        echo "Cliente Aguardando Correção do tipo , se é residência ou condomínio pela kananda para depois entrar em contato com o cliente e agendar uma data";
      }
      
      if($status == 'ativo'){
          $inst = $pdo->prepare("SELECT * FROM instalacoes as i 
          INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
          WHERE i.fk_id_cliente='$id_cliente' AND i.status_agendamento='finalizado'");
          $inst->execute();
          $linhainst = $inst->fetch(PDO::FETCH_ASSOC); 
          if($inst->rowCount()){
            echo "Cliente ativado em ".dataBR($linhainst['data_fechamento']);
            echo " pelo técnico ";
            echo $linhainst['nome'];
          }    
        }

        if($status == 'Cancelado'){
          echo "Cliente Cancelado antes da criação do sistema";
        }
  
        if($status == 'CTO'){
          echo "Cliente com problema de CTO , situação encontra-se com Carlinhos e equipe de infraestrutura de fibra para verificar a possibilidade";
        }

        if($status == 'desativando'){
          echo "Cliente cancelou mas está com a vendedora ".$vendedor." para processo de reversão";
        }

        if($status == 'Inativo'){
          echo "Plano Inativo , antes da criação do sistema";
        }

        if($status == 'INDIS'){
          echo "Indisponivel na região";
        }

        if($status == 'INFRA'){
          $inst = $pdo->prepare("SELECT * FROM instalacoes as i 
          INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
          WHERE i.fk_id_cliente='$id_cliente' AND i.status_agendamento='INFRA'");
          $inst->execute();
          $linhainst = $inst->fetch(PDO::FETCH_ASSOC); 
          if($inst->rowCount()){
            echo "Cliente ativado em ".dataBR($linhainst['data_fechamento']);
            echo " pelo técnico ";
            echo $linhainst['nome'];
          }    
        }
      

      if($status == 'Serviço Habilitado'){
        echo "Serviço Habilitado, cliente ativo antes da criação do sistema";
      }


 

      if($status == 'cancelou'){
        $inst = $pdo->prepare("SELECT * FROM instalacoes as i 
        INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
        WHERE i.fk_id_cliente='$id_cliente' AND i.status_agendamento='cancelou'");
        $inst->execute();
        $linhainst = $inst->fetch(PDO::FETCH_ASSOC); 
        if($inst->rowCount()){
          echo "Cliente cancelou ".dataBR($linhainst['data_fechamento']);
          echo " o.s foi gerada para o técnico ";
          echo $linhainst['nome'];
        }else{
          echo "Cliente desistiu antes mesmo de ser instalado";
        }      
      }
      
    ?>

   
  
    </span>
    </li>
   


  

  </ul>
</div>




<?php }  ?>





</div><!-- Fecha Id Janela-->
</section>
<!-- Atualizando o cliente com o bairro correto -->
