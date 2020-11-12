<?php require_once "config.php"; $pdo = conectar(); require_once "function.php";?>

<section>



<div id="janela">




<!-- Registro de Venda / Dados vindo do Formulario de cima -->

<form method="POST" name="enviar" enctype="multipart/form-data" action="?pg=import-xls&submit">

</form>

<button class="btn btn-primary">Dados inconsistente</button>

<br />
<label for=""></label>
<table class="table table-hover">

<thead>
<tr>
<th>id</th>
<th>Cod</th>
<th>Nome</th>
<th>Integrator</th>
<th>Correto</th>
<th>id</th>
</tr>
</thead>
<?php 
$importsql = $pdo->prepare("SELECT c.* ,b.* , c.nome as nomeCliente, b.nome as nomeBairro FROM prevclientes as c INNER JOIN bairros as b ON c.bairro = b.nome WHERE c.bairro = b.nome");
$importsql->execute();
while($linha = $importsql->fetch(PDO::FETCH_ASSOC)){
   
    $bairro = $linha['id_bairro'];
    $nomeBairro = $linha['nomeBairro'];
    $update = $pdo->prepare("UPDATE prevclientes SET bairro='$bairro' where bairro='$nomeBairro'");
    $update->execute();
?>

<tr>
<td><?php echo $linha['id_prevcliente']?></span></td>
<td><?php echo $linha['cod_cliente']?></span></td>
<td><?php echo $linha['nomeCliente']?></span></td>
<td><?php echo $linha['bairro']?></span></td>
<td><?php echo $linha['nomeBairro']?></span></td>
<td><?php echo $linha['id_bairro']?></span></td>

</tr>


<?php } 



?>

</table>





</div><!-- Fecha Id Janela-->
</section>

<script>
$(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
});
</script>