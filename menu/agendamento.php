
<?php $sqlTransf = $pdo->prepare("SELECT * FROM instalacoes where tipo_instalacao='transfres' AND status_agendamento='agendar'");
$sqlTransf->execute();

?>

<?php if($setor == 'agendamento'){ ?>
   <nav id="menu">
        <ul>
            <li><a href='?pg=cliente-agendar'>Agendar Geral</a></li>  
            <li><a href='?pg=cliente-agendar-setor01'>Agendar Setor 01</a></li>  
            <li><a href='?pg=cliente-agendar-setor02'>Agendar Setor 02</a></li> 
            <li><a href='?pg=cliente-agendar-setor03'>Agendar Setor 03</a></li> 
            <li><a href='?pg=cliente-agendar-bairro'>Agendar por Bairro</a></li>
            <li><a href='?pg=cliente-transferencia'>Transferencia <span class="badge badge-primary" style="float:right; margin-right:10px"><?php echo $total = $sqlTransf->rowCount(); ?></span></a></li>          
            <li><a href='?pg=cliente-sem-contato'>Sem Contato</a></li>    
            <li><a href='?pg=cliente-whats'>Aguardando Whats App</a></li>                           
         </ul>
   </nav>
<?php } ?>