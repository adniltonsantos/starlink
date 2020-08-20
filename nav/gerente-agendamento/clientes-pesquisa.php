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
    <li class="list-group-item"><strong>COD : </strong><?php echo $cod = $linha['cod_cliente']?> | <strong>TIPO DE INSTALACAO : </strong><?php $tipo = $linha['tipo']; if($tipo == 'res'){ echo "Residência";}else{ echo "Condominio";}?></li>
    <li class="list-group-item"><strong>NOME : </strong><?php echo $bairro = $linha['nomeCliente']?></li>
    <li class="list-group-item"><strong>BAIRRO : </strong><?php echo $bairro = $linha['nome']?> | <strong>END : </strong><?php echo $bairro = $linha['endereco']?></li>
    <li class="list-group-item"><strong>REFERENCIA : </strong><?php echo $referencia = $linha['referencia']?></li>
    <li class="list-group-item"><strong>CELULAR  : </strong><?php echo $celular = $linha['celular']?><strong> | DD  : </strong><?php echo $bairro = $linha['dd']?> - <?php echo $bairro = $linha['fone']?> | <strong>Fax</strong> - <?php echo $bairro = $linha['fax']?> - </li>
    <li class="list-group-item"><strong>VENDEDOR : </strong><?php echo $vendedor = $linha['vendedor']?></li>
    <li class="list-group-item"><strong>DATA DO CONTRATO : </strong><?php echo dataBR($data_cadastro = $linha['data_cadastro']);?></li>
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

        if($status == 'REAGENDAR'){
          echo "Setor de agendamento irá reagendar o Assinante houve algum problema no local e assinante pediu uma reagendamento para outra data ";
        }

        if($status == 'REDE'){
          echo "Cliente que a empresa tem que fazer REDE, está com supervir de infraestrutura de rede CARLOS e sua equipe ";
        }

        if($status == 'RC'){
          echo "Estivemos no local , existe uma pendencia do cliente e o mesmo informou que entrar em contato com a empresa assim que resolver a pendência";
        }
        if($status == 'whats'){
          echo "Aguardando Retorno de Cliente via WhatsApp";
        }

        if($status == 'INFRA'){
          $inst = $pdo->prepare("SELECT * FROM instalacoes as i 
          INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
          WHERE i.fk_id_cliente='$id_cliente' AND i.status_agendamento='INFRA'");
          $inst->execute();
          $linhainst = $inst->fetch(PDO::FETCH_ASSOC); 
          if($inst->rowCount()){
            echo "Cliente foi agendado em  ".dataBR($linhainst['data_agendamento']);
            echo " pelo técnico ";
            echo $linhainst['nome'];
            echo " porém não foi concluido com problema de infraestutura do cliente";
          }    
        }
      

      if($status == 'Serviço Habilitado'){
        echo "Serviço Habilitado, cliente ativo antes da criação do sistema";
      }
      
      if($status == 'transferindo'){
        echo "Cliente está sendo transferido, aguardando agendamento";
      }

      if($status == 'sem-contato'){
        echo "Cliente Sem Contato , repassado para o setor de Vendas";
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
      
      if($status == 'RC'){
        $inst = $pdo->prepare("SELECT * FROM instalacoes as i 
        INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
        WHERE i.fk_id_cliente='$id_cliente' AND i.status_agendamento='RC'");
        $inst->execute();
        $linhainst = $inst->fetch(PDO::FETCH_ASSOC); 
        if($inst->rowCount()){
          echo "Aguardando Retorno do Cliente - ";
          echo "Cliente foi agendado em  ".dataBR($linhainst['data_agendamento']);
          echo " pelo técnico ";
          echo $linhainst['nome'];
          echo " porém não foi concluido com algum problema interno e o cliente ficou de procurar a empresa";
        }    
      }

    ?>

   
  
    </span>
    </li>
    <li class="list-group-item">
      <button type="button" class="btn btn-info btn-sm" aria-hidden="true" data-toggle="modal" data-target="#myModal2<?php echo $linha['id_cliente']?>"><div>Comentário 
      <?php 
      $id_cliente = $linha['id_cliente'];
      $comentariosql = $pdo->prepare("SELECT * from comentarios WHERE fk_id_cliente='$id_cliente'");
      $comentariosql->execute(); 
      if($comentariosql->rowCount() > 0){ ?> 
      <span class="glyphicon glyphicon-eye-open" style="margin:0px 0 0 5px"></span>
      <?php } ?>
      </button>
      </li>
   


  

  </ul>
</div>






<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $linha['nomeCliente']?></h4>
      </div>


      <form method="POST"  id="agendar<?php echo $linha['id_cliente'];?>" action="?pg=clientes-pesquisa&update">
          <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente']?>">
          <input type="hidden" name="tipo" value="<?php echo $linha['tipo']?>">
          <input type="hidden" name="cod_cliente" value="<?php echo $linha['cod_cliente']?>">
         
          <div style="padding:20px">
          

          <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Técnico</label>
                <select name="tecnico" required class="form-control" style="width:200px;" autofocus>
                <option value="">Selecione o Técnico</option>
                <option value="25">SEM TECNICO</option>
                <?php 
                $tecnicosql = $pdo->prepare("SELECT * FROM tecnicos WHERE status_tecnico='ativo' ORDER BY nome ASC");
                $tecnicosql->execute();
                while($linha2 = $tecnicosql->fetch(PDO::FETCH_ASSOC)){
                ?>
                
              
                <option value="<?php echo $linha2['id_tecnico'] ?>"><?php echo $linha2['nome'] ?></option>
                <?php } ?>
                </select>  
            </div>

            <div class="form-group col-md-6">
              <label for="">Data de Instalação</label>
              <input  required name="data" type="date" class="form-control">
            </div>
        </div>
        
        <button onclick="document.getElementById('agendar<?php echo $linha['id_cliente'];?>').submit()"; class="btn btn-primary">Agendar</button></div>    
        
       
        </div>    
          </form>


    </div>
  </div>
</div>



<!-- Modal Reagendar -->
<div class="modal fade" id="myModalR<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reagendar - <?php echo $linha['nomeCliente'];?></h4>
      </div>

<?php
      $inst = $pdo->prepare("SELECT * FROM instalacoes as i 
        INNER JOIN tecnicos as t ON i.fk_id_tecnico=t.id_tecnico
        WHERE i.fk_id_cliente='$id_cliente' AND i.status_agendamento='agendado'");
        $inst->execute();
        $linhainst = $inst->fetch(PDO::FETCH_ASSOC); 
              
?>
      <form method="POST"  id="reagendar<?php echo $linhainst['id_instalacao'];?>" action="?pg=clientes-pesquisa&reagendar">
         
         <input type="hidden" name="id_instalacao" value="<?php echo $linhainst['id_instalacao'];?>">
          <input type="hidden" name="id_cliente" value="<?php echo $linha['id_cliente']?>">
          <input type="hidden" name="cod_cliente" value="<?php echo $linha['cod_cliente']?>">
         
          <div style="padding:20px">
          

          <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Técnico</label>
                <select name="tecnico" required class="form-control" style="width:200px;" autofocus>
                <option value="">Selecione o Técnico</option>
                <option value="25">SEM TECNICO</option>
                <?php 
                $tecnicosql = $pdo->prepare("SELECT * FROM tecnicos WHERE status_tecnico='ativo' ORDER BY nome ASC");
                $tecnicosql->execute();
                while($linha2 = $tecnicosql->fetch(PDO::FETCH_ASSOC)){
                ?>
                
              
                <option value="<?php echo $linha2['id_tecnico'];?>" <?php echo selected( $linhainst['fk_id_tecnico'], $linha2['id_tecnico'] ); ?>><?php echo $linha2['nome'] ?></option>
                <?php } ?>
                </select>  
            </div>

            <div class="form-group col-md-6">
              <label for="">Data de Instalação</label>
              <input  required name="data" type="date" class="form-control" value="<?php echo $linhainst['data_agendamento'];?>">
            </div>
        </div>
        
        <button onclick="document.getElementById('reagendar<?php echo $linhainst['id_instalacao'];?>').submit()"; class="btn btn-primary">Reagendar</button></div>    
        
       
        </div>    
          </form>


    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal2<?php echo $linha['id_cliente']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">
<?php echo $linha['cod_cliente']?> - <?php echo $linha['nomeCliente']?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
     </div>
     <div style="padding:20px">

      <form method="POST" id="comentario<?php echo $linha['id_cliente'];?>" action="?pg=clientes-pesquisa&comentario">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente = $linha['id_cliente']?>">
          <input type="hidden" name="tipo" value="<?php echo $tipo = $linha['tipo']?>">
         
        

          <ul class="list-group"style="margin:10px">
          <?php 
            $comentariosql = $pdo->prepare("SELECT * from comentarios as c INNER JOIN 
            usuarios as u ON u.idusuario = c.fk_id_usuario
            WHERE c.fk_id_cliente='$id_cliente' ORDER BY c.data_comentario DESC");
            $comentariosql->execute();
             while($linha = $comentariosql->fetch(PDO::FETCH_ASSOC)){
            
          ?>
            
              <li class="list-group-item" style="margin-bottom:20px; ">
              <div style="padding:10px"><?php echo $linha['comentario']?></div>
              <div class="badge"> 
                <?php $data = str_replace("/", "-", $linha['data_comentario']);
                echo date('d/m/Y H:i:s', strtotime($data))?>
              </div>
             
              <div class="badge" style="background:#6495ED">escrito por : <?php echo $linha['usuario'];?></div></li>
  
                 
      <?php } ?>
      </ul>
       </div>

    </div>
  </div>
</div>


<?php }  ?>





</div><!-- Fecha Id Janela-->
</section>
<!-- Atualizando o cliente com o bairro correto -->
<?php 
if (isset($_GET['update'])){

    $cod_cliente = $_POST['cod_cliente'];
    $data = $_POST['data'];
    $fk_id_tecnico = $_POST['tecnico'];
    $fk_id_cliente = $_POST['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];
    $tipo = $_POST['tipo'];

    $insertsql = $pdo->prepare("INSERT INTO instalacoes (fk_id_usuario,fk_id_tecnico,fk_id_cliente,data_agendamento,status_agendamento) values
    ('$idusuario','$fk_id_tecnico','$fk_id_cliente','$data','agendado') ");
    $insertsql->execute();
    
    $updatesql = $pdo->prepare("UPDATE clientes SET status_cliente='agendado' WHERE id_cliente='$fk_id_cliente' ");
    $updatesql->execute();

  echo "<script>location.href='?pg=clientes-pesquisa&search&selecionado&cod=".$cod_cliente."&ponto=".$fk_id_cliente."'</script>";  
}
?>
<?php 
if (isset($_GET['reagendar'])){
    $id_instalacao = $_POST['id_instalacao'];
    $cod_cliente = $_POST['cod_cliente'];
    $data = $_POST['data'];
    $fk_id_tecnico = $_POST['tecnico'];
    $fk_id_cliente = $_POST['id_cliente'];
    $idusuario = $_COOKIE["idusuario"];

    $updatesql = $pdo->prepare("UPDATE instalacoes SET fk_id_tecnico='$fk_id_tecnico',data_agendamento='$data' WHERE id_instalacao='$id_instalacao' ");
    $updatesql->execute();

  echo "<script>location.href='?pg=clientes-pesquisa&search&selecionado&cod=".$cod_cliente."&ponto=".$fk_id_cliente."'</script>";  
}


?>


<?php 
if (isset($_GET['comentario'])){

    $comentario = $_POST['comentario'];
    $data = date('Y-m-d H:i:s');
    $idusuario = $_COOKIE['idusuario'];
    $id_cliente = $_POST['id_cliente'];
   
    $comentsql = $pdo->prepare("INSERT INTO comentarios (comentario,data_comentario,fk_id_usuario,fk_id_cliente)
    values ('$comentario','$data','$idusuario','$id_cliente')");
    $comentsql->execute();

    echo "<script>location.href='?pg=cliente-pesquisa'</script>"; 
}
?>