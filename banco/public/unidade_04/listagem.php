<?php require_once("../../conexao/conexao.php"); ?>
<?php

include("../../conexao/sessao.php");


$produtos = "SELECT produtoID, nomeproduto, tempoentrega, precounitario, imagempequena FROM produtos";
if(isset($_GET["produto"])){
    $nome_produto = $_GET["produto"];
    $produtos .= " WHERE nomeproduto LIKE '%{$nome_produto}%' ";
}

$resultado = mysqli_query($conecta, $produtos);
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
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/produtos.css" rel="stylesheet">
    <link href="_css/produto_pesquisa.css" rel="stylesheet">
    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include_once("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>

    <main>
        <div id="janela_pesquisa">
            <form action="listagem.php" method="get">
                <input type="text" name="produto" placeholder="pesquisa">
                <input type="image" name="pesquisa" src="../_assets/botao_search.png">
            </form>

        </div>

        <div id="listagem_produtos">
            <?php
           
            while($linha = mysqli_fetch_assoc($resultado)){
            ?>


            <ul>
                <a href="detalhe.php?codigo=<?php echo $linha["produtoID"]?>">
                    <li class="imagem"><img src="<?php echo $linha["imagempequena"]?>"></li>
                    <li>   <h3><?php echo $linha["nomeproduto"]?></h3> </li>
                    <li>Tempo entrega:<?php echo $linha["tempoentrega"]?></li>
                    <li>Preço unitario: <?php echo  real_format($linha["precounitario"])?></li>
                </a>
                <li><input class="btnconprar" type="submit" value="Comprar" id="compra" name="comprar"> </li>
            </ul>


            <?php
             }
        ?>
        </div>
    </main>

    <?php include_once("../_incluir/rodape.php"); ?>
</body>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>