<?php require_once "config.php"; $pdo = conectar(); ?>

<script language="javascript" type="text/javascript">

 function validar() {

var nome = enviar.nome.value;
var codbarra = enviar.codbarra.value;

if (nome == "") { 
alert('Preencha o campo Nome do Item'); 
enviar.nome.focus(); 
return false; 
}

if (codbarra == "") { 
alert('Preencha o campo Codigo de Barra'); 
enviar.codbarra.focus(); 
return false; 

}else{

        enviar.submit();  
    } 

 }

 </script> 

<section>

<div id="janela">

<?php 
if(isset($_GET['submit'])){

$nome = $_POST['nome']; 
$codbarra = $_POST['codbarra']; 
$minimo = $_POST['minimo']; 
$qtd = 0;

 //Verifica se Já tem o mesmo código de Barra

$v = $pdo->query("SELECT * FROM itens WHERE codbarra_item='$codbarra'");
$v->execute();
$linha = $v->rowCount();


if ($linha >= 1 ){ 

 echo "<script>location.href='?pg=inseri-item&existe'</script>"; 



} else {


 // Insere os dados no banco 
 
 $sql = $pdo->prepare("INSERT INTO itens (nome_item,codbarra_item, qtd,minimo) VALUES ('$nome','$codbarra','$qtd','$minimo')");  
 $sql->execute();
 // Se os dados forem inseridos com sucesso 
 
 echo "<script>location.href='?pg=inseri-item&sucesso'</script>"; 
}

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


<legend>Preencha as informações do Item</legend>

<form method="POST" name="enviar" action="?pg=inseri-item&submit">

<div class="form-group">
<label for="">Nome do Item</label>
<input type="text" name="nome" class="form-control" placeholder="Digite o Nome do Item">
</div>

<div class="form-group">
<label for="">Cod Barra</label>
<input type="text" name="codbarra" class="form-control" placeholder="Digite o Código de Barra">
</div>

<div class="form-group">
<label for="">Estoque Minimo</label>
<input type="text" name="minimo" class="form-control" placeholder="Digite o Estoque Minimo">
</div>


<button onclick="return validar();" class="btn btn-primary">Salvar Dados</button>

</form>

</div><!-- Fecha Id Janela-->
</section>
