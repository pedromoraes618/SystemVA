<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");

//consultar situacao ativo
$selectativo = "SELECT ativoID, nome_ativo from ativo";
$lista_ativo = mysqli_query($conecta, $selectativo);
if(!$lista_ativo){
die("Falaha no banco de dados  Linha 31 inserir_transportadora");
}

//consultar categoria
$selectcategoria = "SELECT categoriaID, nome_categoria from categoria_produto";
$lista_categoria = mysqli_query($conecta, $selectcategoria);
if(!$lista_categoria){
die("Falaha no banco de dados  Linha 31 inserir_transportadora");
}

//consultar clientes

$produtos = "SELECT * FROM produtos";
if(isset($_GET["produto"])){
    $nome_produto = $_GET["produto"];
    $produtos .= " WHERE nomeproduto LIKE '%{$nome_produto}%' or produtoID LIKE '%{$nome_produto}%'  ";
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

    <!-- estilo -->
    <link href="../_css/estilo.css" rel="stylesheet">
    <link href="../_css/tela_pesquisa.css" rel="stylesheet">

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>



    <main>
        <div id="janela_pesquisa_Cliente">


            <input type="submit" name="cadastrar_produto" value="Adicionar" onclick="return abrepopupcliente();">

            <form action="consulta_produto.php" method="get">

                <input type="text" name="produto" placeholder="pesquisa">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />


            </form>


        </div>

        <div id="menu">
            <ul>
                <p>Descrição</p>
                <li>Preço venda</li>
                <li>Preço compra</li>
                <li>Estoque</li>
                <li>Categoria</li>
                <li>Ativo</li>
                <li>UND</li>

            </ul>

        </div>

        <div id="listagem_cliente">
            <?php

if(isset($_GET["produto"])){
           
           while($linha = mysqli_fetch_assoc($resultado)){
           ?>


            <ul>

                <p> <?php echo utf8_encode($linha["nomeproduto"])?> </p>
                <li> <?php echo real_format($linha["precovenda"])?></li>
                <li> <?php echo real_format($linha["precocompra"])?></li>
                <li><?php echo utf8_encode($linha["estoque"])?></li>
                <li> <?php echo utf8_encode($linha["nome_categoria"])?> </li>
                <li><?php echo utf8_encode($linha["nome_ativo"])?> </li>
                <li> <?php echo utf8_encode($linha["unidade_medida"])?> </li>


                <a href="editar_produto.php?codigo=<?php echo $linha["produtoID"]?>">
                    <input type="submit" value="Editar" name="editar"> </input>
                </a>

            </ul>


            <?php
             }
            }
            ?>
        </div>


    </main>


</body>

<script>
//abrir uma nova tela de cadastro
function abrepopupcliente() {

    var janela = "cadastro_produto.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>