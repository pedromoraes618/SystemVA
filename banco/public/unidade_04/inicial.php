<?php require_once("../../conexao/conexao.php"); 
include("../../conexao/sessao.php");

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/inicial.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/body.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?>
        
        <main>  
            
        </main>

       
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>