<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
      <meta name="description" content="JKM">
    <meta name="viewport" content="width=device-width,initial-scale1">
    
    <title>Starlink - rafael</title>    
  <!-- Logo do Sistema na Aba -->
  <link rel="icon" href="img/logo.png" type="image/gif" sizes="16x16">
    <!-- Link do Java e Css do Bootsrap -->
    <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

    <link rel="stylesheet" href="css/bootstrap.css"/>
  <link rel="stylesheet" href="css/bootstrap-theme.css">
  <!-- Link do CSS personalizado -->


<style>
.container {
  height: 100vh;
  margin-top: -30px;
  display:flex;

  align-items: stretch;

}

.content {
  display: flex;
  flex-direction: column;
  align-items: center;
  

  place-content: center;
  width: 100%;
}
  form {
    margin:20px 0;
    width:340px;
    text-align:center;
    padding:20px;
    border-radius:10px;
    border: 1px solid gray;
    background-color: #EAEAEA;
  }

  h1{
    margin-bottom:18px;
    font-size:16px;
  }

</style>  
</head>


<body>

<!-- <img src="icon/logo.png" width="78px" height="86px;"/><br /> -->
<div class="container">
  <div class="content">

  <img src="./assets/logo.png" alt="GoBarber"/>

<form method="post" action="index.php?&submit">
  <h1>Autenticacao</h1>
   
    <div class="form-group">
    <input type="text" class="form-control" name="usuario"  placeholder="Digite Seu Usuário">
    </div>
 
    <div class="form-group">
    <input type="password" class="form-control form-control-lg" name="senha"  placeholder="Digite Sua Senha">
    </div>
  
    <button type="submit"  class="form-control btn btn-primary">Entrar</button>

<br />
<br />

  <?php

if (isset($_GET['alterado'])){ ?>

<div class="alert alert-success alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" 
      aria-hidden="true">
      &times;
   </button>
  <strong> Sucesso !</strong>  Informações Alterado Com Sucesso.
</div>
<?php }?>


<?php 

include "config.php";
$pdo = conectar();

if (isset($_GET['submit'])){

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$confirmacao = $pdo ->prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND senha=:senha");
$confirmacao->bindValue(':usuario',$usuario , PDO::PARAM_STR);
$confirmacao->bindValue(':senha',$senha , PDO::PARAM_STR);
$confirmacao->execute();
$linha = $confirmacao->fetch(PDO::FETCH_ASSOC);
$setor = $linha['setor'];
$idusuario = $linha['idusuario'];
$nome = $linha['nome'];
$linha = $confirmacao ->rowCount();

if ($linha == 1 ){

    setcookie ("idusuario", $idusuario);
    setcookie ("usuario", $usuario);
    setcookie ("senha", $senha);
    setcookie ("setor", $setor);
    setcookie ("nome", $nome);
    
    header('location: home.php');


}else{ ?>
  
  <div class="alert alert-danger alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" 
      aria-hidden="true">
      &times;
   </button>
  <strong> Erro !</strong> Usuário ou Senha inválida.
</div>

<?php } } ?>




</form>

</div>
</div>


</body>
</html>
