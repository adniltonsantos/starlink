<?php require_once "config.php"; $pdo = conectar(); ?>


<section>

<div id="janela">

<?php 
if(isset($_GET['submit'])){
        
        $fileName = $_FILES["file"]["tmp_name"];
        
        if ($_FILES["file"]["size"] > 0) {
            
            $file = fopen($fileName, "r");
            
            while (($csv = fgetcsv($file, 10000, ",")) !== FALSE) 
                {
                   $values[] = "('".$csv[1]."', '".$data = implode('-', array_reverse(explode('/', $csv[2])))."', '".$csv[3]."',
                   '".$csv[4]."','".$csv[5]."', '".$csv[6]."', '".$csv[7]."')"; 
                 }
        
        unset($values[0]);

      
            $sql = "INSERT INTO prevclientes (cod_cliente, data_cadastro, nome, endereco, referencia, bairro, celular) VALUES "
                 . implode(',',$values); 
         
         $sql = $pdo->prepare($sql);
         $sql->execute();
        
         echo "<script>location.href='?pg=import-validar'</script>"; 

    }
   
};
?>

<?php 
    $sql = $pdo->prepare("SELECT * FROM prevclientes");
    $sql->execute();
    $registros = $sql->rowCount();
    if($registros > 0){
?>
    <!-- Parte da mensagem que existe os dados -->

<div class="alert alert-danger">
<strong>!</strong> Já existe um arquivo sendo processado ! Se deseja cancelar <a href="?pg=import-xls&cancelar">Clique Aqui</a>.
</div>

<?php } else { ?>

<legend>Importação da Planilha via Integrator</legend>

<form method="POST" name="enviar" enctype="multipart/form-data" action="?pg=import-xls&submit">

<div class="form-group">
<label for="">Escolha o arquivo</label>
<input type="file" name="file" class="form-control" placeholder="Digite o Estoque Minimo">
</div>


<button class="btn btn-primary">Importar Dados</button>

</form>

<?php } ?>

<!-- Cancelamento do Prevclientes -->
<?php 
if (isset($_GET['cancelar'])){
   

    $truncate = $pdo->prepare("TRUNCATE TABLE prevclientes");
    $truncate->execute();
    echo '<script language="javascript">';
    echo 'alert("Arquivo Cancelado com Sucesso")';
    echo '</script>'; 

    echo "<script>location.href='?pg=import-xls'</script>";
}
?>

</div><!-- Fecha Id Janela-->
</section>
