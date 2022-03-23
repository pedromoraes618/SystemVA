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
    $produtos .= " WHERE nomeproduto LIKE '%{$nome_produto}%' or nome_categoria LIKE '%{$nome_produto}%'  ";
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
    <link href="../_css/pesquisa_tela.css" rel="stylesheet">

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>

    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>
        <div id="janela_pesquisa">
            <a href="cadastro_produto.php">
                <input type="submit" name="cadastrar_produto" value="Adicionar">
            </a>
            <form action="consulta_produto.php" method="get">

                <input type="text" name="produto" placeholder="Pesquisa / Produto / Código">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />


            </form>


        </div>

        <form action="consulta_produto.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Código</p>
                        </td>

                        <td>
                            <p>Descrição</p>
                        </td>
                        <td>
                            <p>Preço venda</p>
                        </td>
                        <td>
                            <p>Preço compra</p>
                        </td>
                        <td>
                            <p>Estoque</p>
                        </td>


                        <td>
                            <p>Categoria</p>
                        </td>
                        <td>
                            <p>Ativo</p>
                        </td>
                        <td>
                            <p>UND</p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                    </tr>

                    <?php

if(isset($_GET["produto"])){

      while($linha = mysqli_fetch_assoc($resultado)){
    ?>

                    <tr id="linha_pesquisa">

                        <td style="width: 70px;">
                            <font size="3"><?php echo utf8_encode($linha["produtoID"])?> </font>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($linha["nomeproduto"])?> </font>
                            </p>
                        </td>
                        <td style="width: 150px;">
                            <font size="2"><?php echo real_format($linha["precovenda"])?></font>
                        </td>
                        <td style="width: 150px;">
                            <font size="2"><?php echo real_format($linha["precocompra"])?> </font>
                        </td>

                        <td style="width: 100px;">
                            <font size="2"><?php echo utf8_encode($linha["estoque"])?> </font>
                        </td>

                        <td style="width: 130px;">
                            <font size="2"> <?php echo utf8_encode($linha["nome_categoria"])?></font>
                        </td>

                        <td style="width: 90px;">
                            <font size="2"><?php echo utf8_encode($linha["nome_ativo"])?> </font>
                        </td>
                        <td>
                            <font size="2"><?php echo utf8_encode($linha["unidade_medida"])?> </font>
                        </td>

                        <td id="botaoEditar">
                            <a href="editar_produto.php?codigo=<?php echo $linha["produtoID"]?>">
                                <button type="button" name="editar">Editar</button>
                            </a>

                        </td>


                    </tr>



                    <?php
             }
            }
            ?>
                </tbody>
            </table>

        </form>

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