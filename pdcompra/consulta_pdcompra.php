<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");


include ("../_incluir/funcoes.php");





//consultar pedido de compra
if(isset($_GET["pedidoCompra"])){
    
        $select = "SELECT clientes.razaosocial, pedido_compra.produto, pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_compra,  pedido_compra.valor_venda from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID " ;
        if(isset($_GET["pedidoCompra"])){
        $nPedidoCompra = $_GET["pedidoCompra"];
        $select  .= " WHERE clientes.razaosocial LIKE '%{$nPedidoCompra}%' or pedido_compra.entrega_prevista LIKE '%{$nPedidoCompra}%' or pedido_compra.numero_pedido_compra LIKE '%{$nPedidoCompra}%' ";
       
        }
    
       

//consultar cliente

$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}
}

/*
$resultado = mysqli_query($conecta, $pedido);
if(!$resultado){
    die("Falha na consulta ao banco de dados");
    
}
*/


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
                <input type="text" name="pedidoCompra" placeholder="pesquisa / Cliente / Entrega prevista / N° Pedido">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />

            </form>


        </div>

        <form action="consulta_pdcompra.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">

                        <td>
                            <p>N° Pedido</p>
                        </td>

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
    /* 
    while($linha = mysqli_fetch_assoc($resultado)){
    

    ?>
                    */

                    while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                    $pedidoIDL = $linha_clientes["pedidoID"];
                    $nPedidoCompraL = $linha_clientes["numero_pedido_compra"];
                    $clienteSeleiconado = $linha_clientes['razaosocial'];
                    $entregaPrevista = $linha_clientes["entrega_prevista"];
                    $entregaRealizada = $linha_clientes["entrega_realizada"];
                    $data_chegada = $linha_clientes["data_chegada"];
                    $produtoL = $linha_clientes["produto"];
                    $valorCompraL = $linha_clientes["valor_compra"];
                    $valorVendaL = $linha_clientes["valor_venda"];
                    ?>

                    <tr id="linha_pesquisa">
             

                    <td style="width:90px;">
                            <p>
                                <font size="3"><?php echo $nPedidoCompraL;?></font>
                            </p>
                        </td>


                        <td style="width:280px;">
                            <p>
                                <font size="3"><?php echo $clienteSeleiconado;?> </font>
                            </p>
                        </td>

                        <td style="width:280px;">
                            <font size="2"><?php echo utf8_encode($produtoL)?></font>
                        </td>
                        <td style="width:100px;">
                            <font size="2"> <?php if($data_chegada=="0000-00-00") {
                               echo ("");

                                  }elseif($data_chegada=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($data_chegada); } ?></font>
                        </td>

                        <td style="width:110px;">
                            <font size="2"> <?php echo real_format($valorCompraL)?></font>
                        </td>

                        <td style="width:110px;">
                            <font size="2"> <?php echo real_format($valorVendaL)?> </font>
                        </td>

                        <td style="width:110px;">
                            <font size="2"> <?php  
                            if($entregaPrevista=="0000-00-00"){
                                echo ("");
                            }elseif($entregaPrevista=="1970-01-01"){
                                echo ("");
                            } else{
                                echo formatardataB($entregaPrevista);
                            }?> </font>

                        </td>

                        <td style="width:130px;">
                            <font size="2">
                                <?php if(($entregaRealizada=="0000-00-00")){
                                 echo ("");
                                   }elseif($entregaRealizada=="1970-01-01"){
                                    echo ("");
                                   }else{
                                      echo formatardataB($entregaRealizada);
                                     } ?>
                            </font>
                        </td>


                        <td id="botaoEditar">
                            <a href="editar_pdcompra.php?codigo=<?php echo $pedidoIDL?>">

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