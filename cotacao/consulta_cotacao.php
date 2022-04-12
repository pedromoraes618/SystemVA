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

$produtos = " SELECT produtos.produtoID, produtos.nomeproduto, produtos.precovenda,produtos.precocompra,produtos.estoque, categoria_produto.nome_categoria as categoria_nome, ativo.nome_ativo as ativo_nome, produtos.unidade_medida from ativo  inner join  produtos on produtos.nome_ativo = ativo.ativoID INNER Join categoria_produto on produtos.nome_categoria = categoria_produto.categoriaID " ;

if(isset($_GET["produto"])){
    $nome_produto = $_GET["produto"];
    $produtos .= " WHERE produtos.nomeproduto LIKE '%{$nome_produto}%' or categoria_produto.nome_categoria LIKE '%{$nome_produto}%'  ";
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

     
        <a onclick="window.open('cadastro_cotacao.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
            <input type="submit" name="cadastrar_cotacao" value="Adicionar">
            </a>


            <form action="consulta_cotacao.php" method="get">

                <input type="text" name="cotacao" placeholder="Pesquisa / Produto / Código">
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

 
                    <tr id="linha_pesquisa">

                        <td style="width: 70px;">
                            <font size="3"></font>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="2"> </font>
                            </p>
                        </td>
                        <td style="width: 150px;">
                            <font size="2"></font>
                        </td>
                        <td style="width: 150px;">
                            <font size="2"> </font>
                        </td>

                        <td style="width: 100px;">
                            <font size="2"> </font>
                        </td>

                        <td style="width: 130px;">
                            <font size="2"> </font>
                        </td>

                        <td style="width: 90px;">
                            <font size="2"> </font>
                        </td>
                        <td>
                            <font size="2"> </font>
                        </td>

                        <td id="botaoEditar">

                 
                            <a onclick="window.open('editar_cotacao.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
                            
                                <button type="button" name="editar">Editar</button>
                            </a>

                        </td>


                    </tr>



                    <?php
           
            ?>
                </tbody>
            </table>

        </form>

    </main>
</body>

<script>
//abrir uma nova tela de cadastro
function abrepopupCadastroProduto() {

    var janela = "cadastro_produto.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupEditarProduto() {

    var janela = "editar_produto.php?codigo=<?php echo $idProduto ?>";
    window.open(janela, 'popuppageEditarProduto',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>