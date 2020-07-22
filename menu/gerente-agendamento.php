
<?php require_once "config.php"; $pdo = conectar(); require_once "function.php"; ?>
<?php if($setor == 'adm/agendamento'){ ?>
   <nav id="menu">
        <ul>
         <li><a href='#'>Clientes</a>
                <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-correcao">Correção</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-pesquisa">Pesquisar</a></li>
                 </ul> 
            </li>
            <li><a href='?pg=clientes-agendar'>Agendar</a></li>
          
            <li><a href='#'>Agendados</a>
            <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-by-agendamento&data=<?php echo $data = date('Y-m-d')?>">Por Marcio</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-by-tecnicos-today">Hoje</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-by-tecnicos-all&between&data=<?php echo date('Y-m-d')?>&data2=<?php echo date('Y-m-d')?>">Geral</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-by-tecnicos-by&between&data=<?php echo date('Y-m-d')?>&data2=<?php echo date('Y-m-d')?>">Por Técnico</a></li>
                 </ul> 
            </li>

            <li><a href='#'>Problemas</a>
                <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-cto">CTO</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-cancelou">CANCELOU</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-indis">INDISPONIBILIDADE</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-rede">REDE</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-rc">RETORNO DE CLIENTE</a></li>
                 </ul> 
            </li>
            <li><a href='?pg=producao-terceiros'>Produção Terceiros</a></li>
            <li><a href='#'>Importar</a>            
                <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href="?pg=import-xls">CSV</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=import-validar">Inconsistências</a></li> 
                </ul> 
            </li>
            <li><a href='?pg=clientes-transferencias'>Transferencia</a></li>
            <li><a href=''>Concluidos</a>
            <ul class="dropdown-sub"> 
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-concluido-today">Hoje</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-concluido-all">Geral</a></li>
                    <li class="dropdown-sub-menu"><a href="?pg=clientes-concluido-tecnico">Por Técnico</a></li>
                 </ul> 
            </li>
         </ul>

         
   </nav>
<?php } ?>

