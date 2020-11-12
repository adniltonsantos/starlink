<?php require_once "config.php"; $pdo = conectar(); ?>

<section>

<div id="janela">

<?php 
if(isset($_GET['submit'])){

$nome = $_POST['nome']; 
$cnpj = $_POST['cnpj']; 
$contato = $_POST['contato']; 
$telefone = $_POST['telefone']; 
$sites = $_POST['sites']; 


// Insere os dados no banco 
 
 $sql = $pdo->prepare("INSERT INTO fornecedoras (nome,cnpj,contato,telefone,sites) VALUES ('$nome','$cnpj','$contato','$telefone','$sites')");  
 $sql->execute();
 // Se os dados forem inseridos com sucesso 
 
 echo "<script>location.href='?pg=inseri-fornecedora&sucesso'</script>"; 


}
?>

<!-- Parte da mensagem que os dados foram salvos -->
<?php if(isset($_GET['sucesso'])){?>
<div class="alert alert-success">
<a href="?pg=inseri-fornecedora" class="close" data-dismiss="alert">&times;</a>
<strong>Sucesso!</strong> Suas informações foram salvas no Banco de Dados.
</div>
<?php } ?>

<legend>Preencha as informações da Fornecedora</legend>

    <form method="POST" name="enviar" action="?pg=inseri-fornecedora&submit">

    <div class="form-group">
    <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="nome" required class="form-control" placeholder="Digite o Nome do Fornecedora">
    </div>

    <div class="form-group">
    <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="cnpj"  class="form-control" placeholder="Digite o CNPJ">
    </div>

    <div class="form-group">
    <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="contato" class="form-control" placeholder="Digite o Contato">
    </div>

    <div class="form-group">
    <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="telefone" class="form-control" placeholder="Digite o Telefone">
    </div>

    <div class="form-group">
    <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="sites" class="form-control" placeholder="Digite o Site">
    </div>

    <button class="btn btn-primary">Salvar Dados</button>

    </form>

</div><!-- Fecha Id Janela-->
</section>
