
<?php 

$sqlTransf = $pdo->prepare("SELECT * FROM instalacoes where tipo_instalacao='transfres' AND status_agendamento='agendar'");
$sqlTransf->execute();

$sqlReagendar = $pdo->prepare("SELECT * FROM instalacoes where
status_agendamento='REAGENDAR'");
$sqlReagendar->execute();


?>

<?php if($setor == 'agendamento'){ ?>
   <nav id="menu">
        <ul>
            <li><a href='?pg=cliente-pesquisa'>Cliente Pesquisa</a></li>  
            <li><a href='?pg=cliente-agendar'>Geral</a></li>  
   
            <li><a href='#'>Setores</a>
            <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href='?pg=cliente-agendar-setor01'>Setor 01</a></li>  
                    <li class="dropdown-sub-menu"><a href='?pg=cliente-agendar-setor02'>Setor 02</a></li> 
                    <li class="dropdown-sub-menu"><a href='?pg=cliente-agendar-setor03'>Setor 03</a></li> 
                 </ul> 
            </li>
            <li>
            <li><a href='?pg=cliente-reagendar'>Reagendar <span class="badge badge-primary" style="float:right; margin-right:10px; background-color:red"><?php echo $totaltransf = $sqlReagendar->rowCount(); ?></span></a></li>          
            <li><a href='?pg=cliente-transferencia'>Transferencia <span class="badge badge-primary" style="float:right; margin-right:10px; background-color:red"><?php echo $totaltransf = $sqlTransf->rowCount(); ?></span></a></li>          
            <li><a href='?pg=cliente-sem-contato'>Sem Contato</a></li>    
            <li><a href='?pg=cliente-whats'>Aguardando Whats App</a></li>  
            <li><a href='?pg=cliente-by-agendamento'>Agendados</a></li>                          
         </ul>
   </nav>
<?php } ?>