<section>
<div id="janela">
<div id="conteudo">

<?php require_once "config.php"; 

$usuarioC = $_COOKIE["usuario"];
$senhaC = $_COOKIE["senha"];


$sql = $pdo->query("SELECT * FROM usuario WHERE usuario='$usuarioC'");
$sql->execute();
$query = $sql->fetch(PDO::FETCH_ASSOC);

$idusuario = $query['idusuario'];
$usuario = $query['usuario'];
$senha = $query['senha'];
$foto = $query['foto'];

// Altera Formulario 

if (isset($_GET['submit'])){

// Recupera os dados dos campos
 $usuario = $_POST['usuario'];
 $senha = $_POST['senha'];
 $foto = $_FILES["foto"];
// Se a foto estiver sido selecionada
if (!empty($foto["name"])) {    

if (count($error) == 0) {

// Pega extensão da imagem 
preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);   
// Gera um nome único para a imagem 
$nome_imagem = md5(uniqid(time())) . "." . $ext[1];   
// Caminho de onde ficará a imagem
 $caminho_imagem = "img/" . $nome_imagem;  
  // Faz o upload da imagem para seu respectivo caminho 
  move_uploaded_file($foto["tmp_name"], $caminho_imagem);   
 
  // Insere os dados no banco 
  $sql = $pdo->prepare("UPDATE usuario SET usuario='$usuario', senha='$senha', foto='$nome_imagem' WHERE idusuario='$idusuario'");
  $sql->execute();
  echo "<script>location.href='index.php?alterado'</script>";   
  // Se os dados forem inseridos com sucesso 
 } 
  // Se houver mensagens de erro, exibe-as 
  if (count($error) != 0) { foreach ($error as $erro) { echo $erro . "<br />"; } } 

} else  { $sql = $pdo->prepare("UPDATE usuario SET usuario='$usuario', senha='$senha' WHERE idusuario='$idusuario'");
$sql->execute();  
			echo "<script>location.href='index.php?alterado'</script>";
		}  
}

?>

<?php if (isset($_GET['alterado'])){?>
<div class="alert alert-success"><strong>Sucesso ! </strong> Suas informações foram alteradas no nosso Banco de Dados.</div>

<?php } ?>


<?php if (isset($_GET['nada'])){?>
<div class="alert alert-danger"><strong>Ops ! </strong> Nada foi alterado.</div>

<?php } ?>
<div class="alert alert-info alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" 
      aria-hidden="true">
      &times;
   </button>
  <strong> Informação !</strong> Alterando, será redirecionado para a pagina de autenticação.
</div>

<legend>Altere as Informações do Perfil</legend>	

<div class="form-group">
<form method="post" enctype="multipart/form-data" name="cadastro" action="?pg=perfil&submit">

<div class="form-group">
<input type="text" class="form-control" placeholder="Nome do Usuário" name="usuario" value="<?php echo $usuario;?>">
</div>

<div class="form-group">
<input type="password" class="form-control" placeholder="Digite a Senha" name="senha" value="<?php echo $senha;?>">
</div>

<div class="form-group">
<input type="file" name="foto" value="<?php echo $foto;?>">
</div>

<input type="submit" class="btn btn-primary" value="Altera Dados" >

</form>	

</div>

</div>	
</div>
</section>