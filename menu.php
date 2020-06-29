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
            <!-- <li><a href='?pg=venda'>Venda</a></li>
        <li><a href='?pg=fluxo-caixa&mes=<?php echo date('m'); ?>&ano=<?php echo $ano = date('Y'); ?>'>Fluxo de Caixa </a></li> -->

            <li><a href='#'>Item</a>
                      <ul class="dropdown-sub"> 
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-item">Cadastrar</a></li> 
                          <li class="dropdown-sub-menu"><a href="?pg=consulte-item">Consultar</a></li> 
                     </ul> </li>

           <!-- <li><a href='#'>Produto </a>
                      <ul class="dropdown-sub"> 
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-produto">Inseri Produto</a></li> 
                  
                     </ul> </li> -->
                          
          <li><a href='#'>Fornecedora</a>
                      <ul class="dropdown-sub"> 
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-fornecedora">Cadastrar</a></li>
                          <li class="dropdown-sub-menu"><a href="?pg=relatorio-fornecedora">Consultar</a></li> 
                     </ul> </li>    


          <!-- <li><a href='#'>Pedido</a>
                      <ul class="dropdown-sub"> 
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-pedido">Gerar</a></li>
                          <li class="dropdown-sub-menu"><a href="?pg=relatorio-fornecedora">Consultar</a></li> 
                     </ul> </li>     -->

          <!-- <li><a href='#'>Despesa</a>
                      <ul class="dropdown-sub">
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-despesa">Inseri Despesa</a></li> 
                          <li class="dropdown-sub-menu"><a href="?pg=despesas-futuras">Pagamento</a></li>
                          <li class="dropdown-sub-menu"><a href="?pg=inseri-tipo-despesa">Tipo de Despesa</a></li>  
                  
                     </ul> </li>                  -->
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
         </ul>
   </nav>
<?php } ?>


<?php if($setor == 'adm/agendamento'){ ?>
   <nav id="menu">
        <ul>
          <li><a href='#'>Técnico</a>
            <ul class="dropdown-sub"> 
                <li class="dropdown-sub-menu"><a href="?pg=inseri-tecnico">Cadastrar</a></li>
                <li class="dropdown-sub-menu"><a href="?pg=relatorio-tecnico-ativos">Ativos</a></li> 
                <!-- <li class="dropdown-sub-menu"><a href="?pg=relatorio-tecnico-inativos">Inativos</a></li>    -->
            </ul> 
         </li>
         </ul>
   </nav>
<?php } ?>




<div class="version">Versão do Sistema 3.0</div>
</aside>
