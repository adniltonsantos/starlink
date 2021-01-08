
<?php 

$sqlTransf = $pdo->prepare("SELECT * FROM instalacoes where tipo_instalacao='transfcond' AND status_agendamento='agendar'");
$sqlTransf->execute();

$sqlReagendar = $pdo->prepare("SELECT * FROM instalacoes where
status_agendamento='REAGENDAR'");
$sqlReagendar->execute();


?>

<?php if($setor == 'agendamento2'){ ?>
   <nav id="menu">
        <ul>
            <li><a href='?pg=cliente-pesquisa'>Cliente Pesquisa</a></li>  
            <li><a href='?pg=clientes-agendar2'>Agendar</a></li>  
            <li><a href='?pg=cliente-agendar-bairro2'>Por Bairro</a></li>
            <li><a href='#'>Agendados</a>
            <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-by-tecnicos-by2&between&data=<?php echo date('Y-m-d')?>&data2=<?php echo date('Y-m-d')?>">Por Técnico</a></li>
                 </ul> 
            </li>
            <li><a href='?pg=cliente-reagendar2'>Reagendar <span class="badge badge-primary" style="float:right; margin-right:10px; background-color:red"><?php echo $totaltransf = $sqlReagendar->rowCount(); ?></span></a></li>          
            <li><a href='?pg=cliente-transferencia2'>Transferencia <span class="badge badge-primary" style="float:right; margin-right:10px; background-color:red"><?php echo $totaltransf = $sqlTransf->rowCount(); ?></span></a></li>          
            <li><a href='?pg=cliente-sem-contato2'>Sem Contato</a></li>    
            <li><a href='?pg=cliente-whats2'>Aguardando Whats App</a></li>  
            <li><a href='?pg=cliente-by-agendamento2'>Agendados</a></li>                          
         </ul>
   </nav>
<?php } ?>