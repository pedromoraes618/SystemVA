<?php


require_once("../conexao/conexao.php");

include("../conexao/sessao.php");


include ("../_incluir/funcoes.php");



//consultar pedido de compra
if(isset($_GET["CampoPesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"]){
    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];

    if($pesquisaData==""){
          
    }else{
        $div1 = explode("/",$_GET['CampoPesquisaData']);
        $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
       
    }
    if($pesquisaDataf==""){
       
    }else{
    $div2 = explode("/",$_GET['CampoPesquisaDataf']);
    $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
    }


        $select = "SELECT clientes.razaosocial, pedido_compra.produto,pedido_compra.data_movimento,pedido_compra.margem, pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_compra,  pedido_compra.valor_venda from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID " ;
        $pesquisa = $_GET["CampoPesquisa"];
        $pesquisaNpedido = $_GET["CampoPesquisaNpedido"];
        $select  .= " WHERE data_movimento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.razaosocial LIKE '%{$pesquisa}%' and pedido_compra.numero_pedido_compra LIKE '%{$pesquisaNpedido}%'  ";
    
    
       

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
if(isset($_GET["CampoPesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"]){
    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];

    if($pesquisaData==""){
          
    }else{
        $div1 = explode("/",$_GET['CampoPesquisaData']);
        $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
       
    }
    if($pesquisaDataf==""){
       
    }else{
    $div2 = explode("/",$_GET['CampoPesquisaDataf']);
    $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
    }

$selectValorSoma = $select = "SELECT  clientes.razaosocial, sum(valor_venda) as soma, sum(valor_compra) as somaCompra, pedido_compra.produto,pedido_compra.data_movimento,pedido_compra.margem, pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_compra,  pedido_compra.valor_venda from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID "  ;
$pesquisa = $_GET["CampoPesquisa"];
$pesquisaNpedido = $_GET["CampoPesquisaNpedido"];

$selectValorSoma  .= " where data_movimento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.razaosocial LIKE '%{$pesquisa}%' and pedido_compra.numero_pedido_compra LIKE '%{$pesquisaNpedido}%'   "   ;

$lista_Soma_Valor= mysqli_query($conecta,$selectValorSoma);
if(!$lista_Soma_Valor){
    die("Falaha no banco de dados || select valor");
}else{
    //recuperar valor que está no input 
   

    }
}


//recuperar valores via get
if (isset($_GET["CampoPesquisaData"])){
    $pesquisaData=$_GET["CampoPesquisaData"];
  }
  if (isset($_GET["CampoPesquisaDataf"])){
    $pesquisaDataf=$_GET["CampoPesquisaDataf"];
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
            <div id="BotaoLancar">


                <a onclick="window.open('cadastro_pdcompra.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1600, HEIGHT=900');">
                    <input id="lancar" type="submit" name="cadastrar_pdcompra" value="Adicionar P.Compra">
                </a>
            </div>
            <form style="width:1500px;" action="" method="get">
                <input style="width: 100px; " type="text" id="CampoPesquisaData" name="CampoPesquisaData"
                    placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if( !isset($_GET["CampoPesquisa"])){ echo formatardataB(date('Y-m-01')); }
                              if (isset($_GET["CampoPesquisaData"])){
                                 echo $pesquisaData;
                                    }?>">

                <input style="width: 100px;" type="text" name="CampoPesquisaDataf" placeholder="Data final"
                    onkeyup="mascaraData(this);" value="<?php if(!isset($_GET["CampoPesquisa"])){ echo date('d/m/Y');
                        } if (isset($_GET["CampoPesquisaDataf"])){ echo $pesquisaDataf;} ?>">

                <input style="width: 100px; margin-left:50px" type="text" name="CampoPesquisaNpedido"
                    placeholder="N° pedido" value="<?php if(isset($_GET['CampoPesquisaNpedido'])){
                        echo $pesquisaNpedido;
                    } ?>">

                <input style="margin-left:110px;" type="text" name="CampoPesquisa" value="<?php if(isset($_GET['CampoPesquisa'])){
                    echo $pesquisa;
                } ?>" placeholder="pesquisa / Cliente / Entrega prevista / N° Pedido">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />

            </form>


        </div>

        <form action="consulta_pdcompra.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>D.lançamento</p>
                        </td>
                        <td>
                            <p>N° Pedido</p>
                        </td>

                        <td>
                            <p>Empresa</p>
                        </td>
                        <td>
                            <p>Produto</p>
                        </td>
                        <td>
                            <p>Valor Compra</p>
                        </td>


                        <td>
                            <p>Valor Venda</p>
                        </td>

                        <td>
                            <p>Lucro</p>
                        </td>

                        <td>
                            <p>Data Chegada</p>
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

if(isset($_GET["CampoPesquisaData"])){
 

                    while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                    $pedidoIDL = $linha_clientes["pedidoID"];
                    $dataLancamentoL = $linha_clientes["data_movimento"];
                    $nPedidoCompraL = $linha_clientes["numero_pedido_compra"];
                    $clienteSeleiconado = $linha_clientes['razaosocial'];
                    $entregaPrevista = $linha_clientes["entrega_prevista"];
                    $entregaRealizada = $linha_clientes["entrega_realizada"];
                    $data_chegada = $linha_clientes["data_chegada"];
                    $produtoL = $linha_clientes["produto"];
                    $valorCompraL = $linha_clientes["valor_compra"];
                    $valorVendaL = $linha_clientes["valor_venda"];
                    $lucroL = $linha_clientes["margem"];
                    ?>

                    <tr id="linha_pesquisa">

                        <td style="width:100px;">
                            <font size="2"> <?php if($dataLancamentoL=="0000-00-00") {
                               echo ("");

                                  }elseif($dataLancamentoL=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataLancamentoL); } ?></font>
                        </td>
                        <td style="width:90px;">
                            <p>
                                <font size="3"><?php echo $nPedidoCompraL;?></font>
                            </p>
                        </td>


                        <td style="width:280px;">
                            <p>
                                <font size="3"><?php echo utf8_encode($clienteSeleiconado);?> </font>
                            </p>
                        </td>

                        <td style="width:280px;">
                            <font size="2"><?php echo utf8_encode($produtoL)?></font>
                        </td>

                        <td style="width:110px;">
                            <font size="2"> <?php echo real_format($valorCompraL)?></font>
                        </td>

                        <td style="width:110px;">
                            <font size="2"> <?php echo real_format($valorVendaL)?> </font>
                        </td>

                        <td style="width:80px;">
                            <font size="2"> <?php echo porcent_format($lucroL)?> </font>
                        </td>

                        <td style="width:100px;">
                            <font size="2"> <?php if($data_chegada=="0000-00-00") {
                               echo ("");

                                  }elseif($data_chegada=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($data_chegada); } ?></font>
                        </td>



                        <td style="width:120px;">
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
                                      ?>
                                <i style="font-size: 20px; margin-left:10px" class="fa-solid fa-check-double"></i>
                                <?php

                                     } ?>
                            </font>
                        </td>


                        <td id="botaoEditar">




                          
                            <a onclick="window.open('editar_pdcompra.php?codigo=<?php echo $pedidoIDL?>', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                                <button type="button" name="Editar">Editar</button>
                            </a>
                        </td>

                        </td>
                    </tr>



                    <?php
                    }

              while($linha_Soma_Valor = mysqli_fetch_assoc($lista_Soma_Valor)){
                $soma = $linha_Soma_Valor['soma'];
                $somaValor =  $linha_Soma_Valor['somaCompra'];
                
                        ?>

                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                        <td style="width: 140px;">
                            <p><?php echo real_format($linha_Soma_Valor['somaCompra']) ?></p>
                        </td>


                        <td style="width: 140px;">
                            <p><?php echo real_format($linha_Soma_Valor['soma']) ?></p>
                        </td>

                        <td>
                            <p><?php 
                          
                            if($soma == 0){
                             
                            }else{
                                $calculo = real_percent(((($soma) - ($somaValor)) / ($somaValor))  * 100);
                                echo $calculo;
                            }
                        
                            
                            ?>
                            </p>
                        </td>

                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>

                        <td>
                            <p></p>
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





</html>

<script>
//abrir uma nova tela de cadastro

function abrepopupEditarPcompra() {

    var janela = "editar_pdcompra.php?codigo=<?php echo $pedidoIDL?>";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupAdicionarPcompra() {

    var janela = "cadastro_pdcompra.php";
    window.open(janela, 'popuppageCadastar',
        'width=1700,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>