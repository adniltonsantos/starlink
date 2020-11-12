<?php require_once "config.php"; $pdo = conectar(); ?>



<section>

<div id="janela">

<?php 
if(isset($_GET['submit'])){

echo $cto = $_POST['cto']; 
echo $latitude = $_POST['latitude']; 
echo $longitude = $_POST['longitude']; 
echo $olt = $_POST['olt']; 
echo $slot = $_POST['slot']; 
echo $pon = $_POST['pon']; 
echo $vlan = $_POST['vlan']; 

}
?>

<!-- Parte da mensagem que os dados foram salvos -->
<?php if(isset($_GET['sucesso'])){?>
<div class="alert alert-success">
<a href="?pg=inseri-item" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>

<!-- Parte da mensagem que existe os dados -->
<?php if(isset($_GET['existe'])){?>
<div class="alert alert-warning">
<a href="?pg=inseri-item" class="close" data-dismiss="alert">&times;</a>
<strong>OPAAAAAH !</strong> Já existe um código de Barra existente. <a href="?pg=consulte-item">Consulte</a>
</div>
<?php } ?>  


<legend>Preencha as informações da CTO</legend>
<form method="POST" name="enviar" action="?pg=inseri-cto&submit">
  
<div class="form-row">

    <div class="form-group col-md-4">
      <label for="">Nome da Cto</label>
      <input type="text" required class="form-control" name="cto" placeholder="Nome">
    </div>

    <div class="form-group col-md-4">
      <label for="">latitude</label>
      <input type="text" required class="form-control" name="latitude" placeholder="latitude">
    </div>

    <div class="form-group col-md-4">
      <label for="">longitude</label>
      <input type="text" required class="form-control" name="longitude" placeholder="longitude">
    </div>



    <div class="form-group col-md-4">
    <label for="">OLT</label>
        <select name="olt" required class="form-control">
            <option value="">Selecione a OLT</option>
            <option value="1">FIBERHOME</option>
            <option value="2">NOKIA JUQUEY</option>
            <option value="3">NOKIA BORACEIA</option>
        </select>
    </div>

    <div class="form-group col-md-4">
    <label for="">SLOT</label>
        <select name="slot" required class="form-control">
            <option value="">Selecione o Slot</option>
            <option value="1">SLOT 01</option>
            <option value="2">SLOT 02</option>
            <option value="3">SLOT 03</option>
            <option value="4">SLOT 04</option>
            <option value="5">SLOT 05</option>
            <option value="6">SLOT 06</option>
            <option value="7">SLOT 07</option>
            <option value="8">SLOT 08</option>
        </select>
    </div>

    <div class="form-group col-md-4">
    <label for="">PON</label>
        <select name="pon" required class="form-control">
            <option value="">Selecione a PON</option>
            <option value="1">PON 01</option>
            <option value="2">PON 02</option>
            <option value="3">PON 03</option>
            <option value="4">PON 04</option>
            <option value="5">PON 05</option>
            <option value="6">PON 06</option>
            <option value="7">PON 07</option>
            <option value="8">PON 08</option>
            <option value="9">PON 09</option>
            <option value="10">PON 10</option>
            <option value="11">PON 11</option>
            <option value="12">PON 12</option>
            <option value="13">PON 13</option>
            <option value="14">PON 14</option>
            <option value="15">PON 15</option>
            <option value="16">PON 16</option>
        </select>
    </div>

    <div class="form-group col-md-12">
    <label for="">VLAN</label>
    <input type="text" required name="vlan" class="form-control" placeholder="Digite a vlan">
    </div>

</div>

<button type="submit" class="btn btn-primary">Salvar Dados</button>

</form>

</div><!-- Fecha Id Janela-->
</section>
