<div class="container-xl">

<?php require_once "../config.php"; $pdo = conectar(); require_once "../function.php";?>

<section>

<div id="janela">



<form method="POST" name="myForm" id="myForm" action="?pg=producao&filtro">
<div class="form-row">

      <div class="form-group col-md-4" style="margin-top:25px">
        <legend>Produção</legend>
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
<button type="submit" style="margin-top:5px" onclick="document.getElementById('myForm').submit()"; class="btn btn-primary">Filtar</button>

</div> 

</form>




<table class="table table-hover">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Normal</th>
          <th>Cond Tubulação</th>
          <th>Total</th>
        </tr>
        </thead>

        <?php 

        $data = $_GET['data'];  
        $data2 = $_GET['data2'];
        $id_tecnico = $_COOKIE['id_tecnico'];
        $tecnicossql = $pdo->prepare("SELECT * FROM tecnicos WHERE id_tecnico='$id_tecnico'");
        $tecnicossql->execute();
      
  
        while($linha = $tecnicossql->fetch(PDO::FETCH_ASSOC)){

        ?>

        <tr>
          <td><?php echo $linha['nome']?></td>

          <td><?php 
          $id_tecnico = $linha['id_tecnico'];
          $qtdsql = $pdo->prepare("SELECT * from instalacoes 
          WHERE fk_id_tecnico='$id_tecnico' 
          AND status_agendamento='finalizado'
          AND DATE(data_fechamento) BETWEEN '$data' AND '$data2'
          ");
          $qtdsql->execute();
          $qtd = $qtdsql->rowCount();
          echo $qtd;
          ?></td>

          <td><?php 
          $id_tecnico = $linha['id_tecnico'];
          $qtd2sql = $pdo->prepare("SELECT * from instalacoes 
          WHERE fk_id_tecnico='$id_tecnico' 
          AND status_agendamento='finalizado2'
          AND DATE(data_fechamento) BETWEEN '$data' AND '$data2'
          ");
          $qtd2sql->execute();
          $qtd2 = $qtd2sql->rowCount();
          echo $qtd2;
          ?></td>

          <td><?php echo $qtd + $qtd2;?></td>

        </tr>
       

 <?php  }?>
</table>

</div><!-- Fecha Id Janela-->
</section>

<?php if (isset($_GET['filtro'])){
  
$data =  $_POST['data'];
$data2 =  $_POST['data2'];

echo "<script>location.href='?pg=producao&data=".$data."&data2=".$data2."'</script>"; 
} ?>

</div>