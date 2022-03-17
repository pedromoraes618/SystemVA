<?php 
    require_once("../../conexao/conexao.php");
    
    // passo 3
    $consulta_produtos  = "SELECT nomeproduto, precounitario, tempoentrega ";
    $consulta_produtos .= " FROM produtos";
    $consulta_produtos .= " WHERE tempoentrega = 5";
    $produtos = mysqli_query($conecta, $consulta_produtos );

    if( !$produtos) {
        die("Falha na consulta ao banco de dados");
    }

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
    </head>

    <body>
        <ol>
        <?php
            while ( $registro = mysqli_fetch_assoc($produtos)) {
        ?>
                <li><?php echo $registro["nomeproduto"]  ?></li>
    
        <?php    
            }
        ?>
        </ol>

        <?php
            mysqli_free_result($produtos);
        ?>

    </body>
</html>
<?php
    mysqli_close($conecta);
?>