<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");


include ("../_incluir/funcoes.php");




 
//consultar pedido de compra
if(isset($_GET["pedidoCompra"])){
$pedido = "SELECT * FROM pedido_compra";
        if(isset($_GET["pedidoCompra"])){
            $pedido_Compra= $_GET["pedidoCompra"];
            $pedido .= " WHERE produto LIKE '%{$pedido_Compra}%' or entrega_prevista LIKE '%{$pedido_Compra}%' or cliente LIKE '%{$pedido_Compra}%' ";
}



$resultado = mysqli_query($conecta, $pedido);
if(!$resultado){
    die("Falha na consulta ao banco de dados");
    
}
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
            <a href="cadastro_pdcompra.php">

                <input type="submit" name="cadastrar_pdcompra" value="Adicionar">
            </a>
            <form action="consulta_pdcompra.php" method="get">
                <input type="text" name="pedidoCompra" placeholder="pesquisa">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />

            </form>


        </div>

        <form action="consulta_pdcompra.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Cliente</p>
                        </td>
                        <td>
                            <p>Produto</p>
                        </td>
                        <td>
                            <p>Data Chegada</p>
                        </td>
                        <td>
                            <p>Valor Compra</p>
                        </td>


                        <td>
                            <p>Valor Venda</p>
                        </td>
                        <td>
                            <p>Entrega Prevista</p>
                        </td>
                        <td>
                            <p>Entrega Realizada</p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                    </tr>

                    <?php

if(isset($_GET["pedidoCompra"])){
    while($linha = mysqli_fetch_assoc($resultado)){
     $entregaPrevista = $linha["entrega_prevista"];
     $entregaRealizada = $linha["entrega_realizada"];
     $data_chegada = $linha["data_chegada"];
   

    ?>


                    <tr id="linha_pesquisa">

                        <td>
                            <p>
                                <font size="3"><?php echo utf8_encode($linha["cliente"])?>
                                </font>
                            </p>
                        </td>

                        <td>
                            <font size="2"><?php echo utf8_encode($linha["produto"])?></font>
                        </td>
                        <td>
                            <font size="2"> <?php if($data_chegada=="0000-00-00"){
                               echo ("NÃO DEFINIDO");

                                  }else{echo formatardataB($data_chegada);
                        } ?></font>
                        </td>

                        <td>
                            <font size="2"> <?php echo real_format($linha["valor_compra"])?></font>
                        </td>

                        <td>
                            <font size="2"> <?php echo real_format($linha["valor_venda"])?> </font>
                        </td>

                        <td>
                            <font size="2"> <?php if($entregaPrevista=="0000-00-00"){
                    echo ("NÃO DEFINIDO");
                }else{
                    echo formatardataB($entregaPrevista);
                } ?> </font>
                        </td>
                        <td>
                            <font size="2">
                                <?php if($entregaRealizada=="0000-00-00"){
                    echo ("NÃO DEFINIDO");
                }else{
                    echo formatardataB($entregaRealizada);
                } ?>
                            </font>
                        </td>


                        <td id="botaoEditar">
                            <a href="editar_pdcompra.php?codigo=<?php echo $linha["pedidoID"]?>">

                                <button type="button" name="Editar">Editar</button>
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

    var janela = "cadastro_pdcompra.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>