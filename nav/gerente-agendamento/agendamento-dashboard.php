<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>


<section>
<div id="janela">
<div id="conteudo">


<label for="">GERAL</label>
<hr>
<div class="container" style="margin-left:-20px">
  <div class="row">

  <div class="col-sm-3">
      <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 01</div>
   
        <!-- Table -->
        <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='1'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
          <td><strong>Total</strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento'
               AND b.fk_id_setor='1'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
         <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>

      <div class="col-sm-3">
      <div class="panel panel-danger">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 02</div>
   
  <!-- Table -->
  <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='2'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
          <td><strong>Total</strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento'
               AND b.fk_id_setor='2'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
          <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 03</div>
  <!-- Table -->
  <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='3'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
           <td><strong> Total </strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento'
               AND b.fk_id_setor='3'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
           <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>


   
  </div>
</div>




<label for="">RESIDENCIAL</label>
<hr>
<div class="container" style="margin-left:-20px">
  <div class="row">

  <div class="col-sm-3">
      <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 01</div>
   
        <!-- Table -->
        <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='1'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento' AND tipo='res'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
          <td><strong>Total</strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento' AND tipo='res'
               AND b.fk_id_setor='1'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
         <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>

      <div class="col-sm-3">
      <div class="panel panel-danger">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 02</div>
   
  <!-- Table -->
  <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='2'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento' AND tipo='res'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
          <td><strong>Total</strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento' AND tipo='res'
               AND b.fk_id_setor='2'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
          <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 03</div>
  <!-- Table -->
  <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='3'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento' AND tipo='res'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
           <td><strong> Total </strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento' AND tipo='res'
               AND b.fk_id_setor='3'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
           <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>



  </div>
</div>



<label for="">CONDOMINIOS</label>
<hr>
<div class="container" style="margin-left:-20px">
  <div class="row">

  <div class="col-sm-3">
      <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 01</div>
   
        <!-- Table -->
        <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='1'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento' AND tipo='cond'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
          <td><strong>Total</strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento' AND tipo='cond'
               AND b.fk_id_setor='1'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
         <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>

      <div class="col-sm-3">
      <div class="panel panel-danger">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 02</div>
   
  <!-- Table -->
  <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='2'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento' AND tipo='cond'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
          <td><strong>Total</strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento' AND tipo='cond'
               AND b.fk_id_setor='2'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
          <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="panel panel-success">
        <!-- Default panel contents -->
        <div class="panel-heading">Setor 03</div>
  <!-- Table -->
  <table class="table table-hover">
          <tr>
            <th>Bairro</th>
            <th>QTD</th>
          </tr>
          
          <?php 
            $setor1sql = $pdo->prepare("SELECT * FROM bairros WHERE fk_id_setor='3'");
            $setor1sql->execute();
            while($linha = $setor1sql->fetch(PDO::FETCH_ASSOC)){
           
          ?>
          <tr>
            <td><?php echo $linha['nome']; ?></td>
            <?php
               $id_bairro = $linha['id_bairro'];
               $cliente01 = $pdo->prepare("SELECT * FROM clientes WHERE fk_id_bairro='$id_bairro'
               AND status_cliente='aguardando-agendamento' AND tipo='cond'
               ");
               $cliente01->execute();
               $totalBairro = $cliente01->rowCount();
             
            ?>
            <td><?php echo $totalBairro; ?></td>
            
          </tr>
            <?php } ?>
         
          <tr>
           <td><strong> Total </strong></td>
           <?php
             
               $total01 = $pdo->prepare("SELECT * FROM clientes as c
               INNER JOIN bairros as b ON c.fk_id_bairro = b.id_bairro
               WHERE c.status_cliente='aguardando-agendamento' AND tipo='cond'
               AND b.fk_id_setor='3'
               ");
               $total01->execute();
               $total = $total01->rowCount();
             
            ?>
           <td><strong><?php echo $total; ?></strong></td>
          </tr>
        </table>
      </div>
    </div>



  </div>
</div>



</div>
</div><!-- Fecha Id Janela-->
</section>





<!-- Fecha Paginação-->