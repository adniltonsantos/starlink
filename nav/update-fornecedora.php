<?php require_once "config.php"; $pdo = conectar(); require_once "function.php"; ?>


<section>
<div id="janela">

<?php 
if(isset($_GET['submit'])){
$id_fornecedora = $_POST['id_fornecedora']; 
$nome = $_POST['nome']; 
$cnpj = $_POST['cnpj']; 
$contato = $_POST['contato']; 
$telefone = $_POST['telefone']; 
$sites = $_POST['sites']; 

 //Atualiza Fornecedora

$update = $pdo->prepare("UPDATE fornecedoras SET nome='$nome',cnpj='$cnpj',contato='$contato',telefone='$telefone',sites='$sites' WHERE id_fornecedora='$id_fornecedora'");
$update->execute();

echo "<script>location.href='?pg=update-fornecedora&sucesso&id_fornecedora=$id_fornecedora'</script>"; 

}
?>

<!-- Parte da mensagem que os dados foram salvos -->
<?php if(isset($_GET['sucesso'])){?>
<div class="alert alert-success">
<a href="?pg=update-fornecedora&id_fornecedora=<?php echo $_GET['id_fornecedora']?>" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>

<?php 
$id_fornecedora = $_GET['id_fornecedora'];
$select = $pdo->prepare("SELECT * FROM fornecedoras WHERE id_fornecedora='$id_fornecedora'");
$select->execute();
$linha = $select->fetch(PDO::FETCH_ASSOC);

?>
<legend>Preencha as informações do fornecedora</legend>

<form method="POST" name="enviar" action="?pg=update-fornecedora&submit">

<div class="form-group">
<input type="text" onkeyup="this.value = this.value.toUpperCase()" required name="nome" class="form-control" placeholder="Nome do fornecedora" value="<?php echo $linha['nome'];?>">
</div>

<div class="form-group">
<input type="text" onkeyup="this.value = this.value.toUpperCase()" name="cnpj" class="form-control" placeholder="Digite o CNPJ" value="<?php echo $linha['cnpj'];?>">
</div>

<div class="form-group">
<input type="text" onkeyup="this.value = this.value.toUpperCase()" name="contato" class="form-control" placeholder="Digite o Contato" value="<?php echo $linha['contato'];?>">
</div>


<div class="form-group">
<input type="text" onkeyup="this.value = this.value.toUpperCase()" name="telefone" class="form-control" placeholder="Digite o Telefone" value="<?php echo $linha['telefone'];?>">
</div>


<div class="form-group">
<input type="text" onkeyup="this.value = this.value.toUpperCase()" name="sites" class="form-control" placeholder="Digite o Site" value="<?php echo $linha['sites'];?>">
</div>

<div class="form-group">

<input type="hidden" name="id_fornecedora" value="<?php echo $id_fornecedora;?>">
<button onclick="return validar();" class="btn btn-primary">Atualizar Dados</button>

</form>

</div><!-- Fecha Id Janela-->
</section>
