<?php require_once("../../../conexao/conexao.php"); ?>
<?php

include("../../../conexao/sessao.php");


$clientes = "SELECT * FROM clientes";
if(isset($_GET["cliente"])){
    $nome_cliente = $_GET["cliente"];
    $clientes .= " WHERE nomecompleto LIKE '%{$nome_cliente}%' or cpfcnpj LIKE '%{$nome_cliente}%'  ";
}

$resultado = mysqli_query($conecta, $clientes);
if(!$resultado){
    die("Falha na consulta ao banco de dados");
    
}

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso PHP Integração com MySQL</title>

    <!-- estilo -->
    <link href="../_css/estilo.css" rel="stylesheet">
    <link href="../_css/cliente.css" rel="stylesheet">
    <link href="../_css/cliente_pesquisa.css" rel="stylesheet">
    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../../_incluir/topo.php"); ?>
    <?php include_once("../../_incluir/body.php"); ?>
    <?php include_once("../../_incluir/funcoes.php"); ?>

    <main>
        <div id="janela_pesquisa_Cliente">
            <form action="consulta_cliente.php" method="get">
                <input type="text" name="cliente" placeholder="pesquisa">
                <input type="image" name="pesquisa" src="../../_assets/botao_search.png">
            </form>

        </div>

        <div id="listagem_cliente">
            <?php
           
            while($linha = mysqli_fetch_assoc($resultado)){
            ?>


            <ul>
                <a href="../detalhe.php?codigo=<?php echo $linha["clienteID"]?>">
                    <li> <h3><?php echo utf8_encode($linha["nomecompleto"])?></h3> </li>
                    <li>Cidade:<?php echo utf8_encode($linha["cidade"])?></li>
                    <li>Endereco: <?php echo utf8_encode($linha["endereco"])?></li>
                    <li>cpfcnpj: <?php echo utf8_encode($linha["cpfcnpj"])?></li>
                </a>
               
            </ul>


            <?php
             }
        ?>
        </div>
    </main>

    
</body>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>