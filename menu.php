<?php include "config.php";
$pdo = conectar();

$usuario = $_COOKIE["usuario"];

$user=$pdo->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
$user->bindValue(':usuario',$usuario,PDO::PARAM_STR);
$user->execute();
$linha = $user->Fetch(PDO::FETCH_ASSOC);
// Pega Usuario e Foto
$usuario = $linha['usuario'];
$foto = $linha['foto'];
$setor = $linha['setor'];
?>
<aside id="bloco-menu">

<!-- Bloco da informações do Perfil-->
   <div id="bloco-user">
   <a href="home.php"><img id="icon-user" class="img-circle" src="img/<?php echo $foto;?>" alt="Icone do Usuário"></a>
   <div id="user"><?php echo $usuario;?></div>
   <!-- <div id="edit-perfil"><a href="?pg=perfil" class="active">Editar Perfil</a></div> -->
   <div id="edit-perfil"><a href="encerra.php" class="active">Sair </a></div>
   </div>

<!-- Menus -->

<?php if($setor == 'estoque' OR $setor == 'adm'){ ?>
   <nav id="menu">
         <ul>
         <li><a href='#'>Estoque</a>
                      <ul class="dropdown-sub"> 
                          <li class="dropdown-sub-menu"><a href="?pg=consulte-estoque">Atual</a></li>
                          <li class="dropdown-sub-menu"><a href="?pg=retirada-estoque">Retirada</a></li>
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-estoque">Inserir</a></li>
                          <li class="dropdown-sub-menu"><a href="?pg=estoque-by-tecnico">Por Técnico</a></li>
                          
                           
                     </ul> </li>  
           <li><a href='#'>Item</a>
                      <ul class="dropdown-sub"> 
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-item">Cadastrar</a></li> 
                          <li class="dropdown-sub-menu"><a href="?pg=consulte-item">Consultar</a></li> 
                     </ul> </li>
                          
          <li><a href='#'>Fornecedora</a>
                      <ul class="dropdown-sub"> 
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-fornecedora">Cadastrar</a></li>
                          <li class="dropdown-sub-menu"><a href="?pg=relatorio-fornecedora">Consultar</a></li> 
                     </ul> </li>    
            <li><a href='#'>Gerar Pedido</a>
            <ul class="dropdown-sub"> 
                <li class="dropdown-sub-menu"><a href="">Cotacao</a></li>
     </ul> </li>    

</ul>
   </nav>
<?php } ?>



<?php if($setor == 'adm'){ ?>
   <nav id="menu">
        <ul>
            <li><a href='#'>Técnico</a>
                <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href="?pg=inseri-tecnico">Cadastrar</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=relatorio-tecnico-ativos">Ativos</a></li> 
                    <!-- <li class="dropdown-sub-menu"><a href="?pg=relatorio-tecnico-inativos">Inativos</a></li>    -->
                </ul> 
            </li>
                                
            <li><a href='#'>Setor</a>
                <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href="?pg=inseri-fornecedora">Cadastrar</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=relatorio-fornecedora">Consultar</a></li> 
                </ul> 
            </li>
         </ul>
   </nav>
<?php } ?>




<?php 
include_once('menu/gerente-agendamento.php');
include_once('menu/agendamento.php');
include_once('menu/atendimento.php');

?>

<div class="version">Versão do Sistema 3.0</div>
</aside>
