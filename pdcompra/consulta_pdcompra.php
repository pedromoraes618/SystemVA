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
    <link href="../_css/tela_pesquisa.css" rel="stylesheet">

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>



    <main>
        <div id="janela_pesquisa_Cliente">

            <a href="cadastro_pdcompra.php">
                <input type="submit" name="cadastrar_pdcompra" value="Adicionar">
            </a>

            <form action="consulta_pdcompra.php" method="get">

                <input type="text" name="pedidoCompra" placeholder="pesquisa">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />


            </form>


        </div>

        <div id="menu">
            <ul>
                <p><b>Cliente</b></p>
                <li><b>Produto</b></li>
                <li><b>Data Chegada</b></li>
                <li><b>Valor Compra</b></li>
                <li><b>Valor Venda</b></li>
                <li><b>Entrega Prevista</b></li>
                <li><b>Entrega Realizada</b></li>

            </ul>

        </div>

        <div id="listagem_cliente">
            <?php

            
if(isset($_GET["pedidoCompra"])){
           while($linha = mysqli_fetch_assoc($resultado)){
            $entregaPrevista = $linha["entrega_prevista"];
            $entregaRealizada = $linha["entrega_realizada"];
            $data_chegada = $linha["data_chegada"];
          

           ?>


            <ul>

                <p> <?php echo utf8_encode($linha["cliente"])?> </p>
                <li> <?php echo utf8_encode($linha["produto"])?></li>
                <li> 
                <?php if($data_chegada=="0000-00-00"){
                    echo ("NÃO DEFINIDO");
                }else{
                    echo formatardataB($data_chegada);
                } ?> 
                </li>
                <li><?php echo real_format($linha["valor_compra"])?></li>
                <li> <?php echo real_format($linha["valor_venda"])?> </li>

                <li><?php if($entregaPrevista=="0000-00-00"){
                    echo ("NÃO DEFINIDO");
                }else{
                    echo formatardataB($entregaPrevista);
                } ?> </li>
                <li> 
                <?php if($entregaRealizada=="0000-00-00"){
                    echo ("NÃO DEFINIDO");
                }else{
                    echo formatardataB($entregaRealizada);
                } ?>    
                </li> 
        


                <a href="editar_pdcompra.php?codigo=<?php echo $linha["pedidoID"]?>">
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
/*
function abrepopupcliente() {

    var janela = "cadastro_pdcompra.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
*/
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>