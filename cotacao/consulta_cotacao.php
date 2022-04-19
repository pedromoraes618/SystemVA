<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");

//consultar cotacao
$select = " SELECT cotacao.numero_orcamento, clientes.razaosocial as cliente,situacao_proposta.descricao as situacao, cotacao.validade,cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID " ;
if(isset($_GET["produto"])){
    $nOrcamento = $_GET["cotacao"];
    $produtos .= " WHERE otacao.numero_orcamento LIKE '%{$nOrcamento}%' ";
}

$resultado = mysqli_query($conecta, $select);
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


            <a
                onclick="window.open('cadastro_cotacao.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1600px, HEIGHT=900');">
                <input type="submit" name="cadastrar_cotacao" value="Adicionar">
            </a>


            <form action="consulta_cotacao.php" method="get">

                <input type="text" name="campoPesquisa" placeholder="Pesquisa / N°orçamento / Cliente">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />


            </form>


        </div>

        <form action="consulta_produto.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>N°Orç</p>
                        </td>

                        <td>
                            <p>Cliente</p>
                        </td>
                        <td>
                            <p>Status proposta</p>
                        </td>
                        <td>
                            <p>Preço cotato</p>
                        </td>
                        <td>
                            <p>Validade</p>
                        </td>


                        <td>
                            <p>Data a responder</p>
                        </td>
                        <td>
                            <p>Data envio</p>
                        </td>
                        <td>
                            <p>Fechamento</p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                    </tr>


                    <?php   if(isset($_GET["campoPesquisa"])){
           while($linha = mysqli_fetch_assoc($resultado)){
                
                
            $nOrcamento = $linha["numero_orcamento"];
            $cliente = $linha["cliente"];
            $situacao = $linha["situacao"];
            $validade = $linha["validade"];
            $dataResponder = $linha["data_responder"];
            $DataEnvio = $linha["data_envio"];
            $DataFechamento = $linha["data_fechamento"];
            
            
          
         

         
           ?>

                    <tr id="linha_pesquisa">

                        <td style="width: 70px;">
                            <font size="3"><?php echo $nOrcamento;?></font>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="2"><?php echo utf8_encode($cliente);?> </font>
                            </p>
                        </td>
                        <td style="width: 150px;">
                            <font size="2"><?php echo utf8_encode($situacao);?></font>
                        </td>
                        <td style="width: 150px;">
                            <font size="2"></font>
                        </td>

                        <td style="width: 100px;">
                            <font size="2"><?php echo utf8_encode($validade);?> </font>
                        </td>

                        <td style="width: 130px;">
                            <font size="2"> <?php if($dataResponder=="0000-00-00") {
                               echo ("");

                                  }elseif($dataResponder=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataResponder); } ?></font>
                        </td>

                        <td style="width: 90px;">
                            <font size="2"><?php if($DataEnvio=="0000-00-00") {
                               echo ("");

                                  }elseif($DataEnvio=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($DataEnvio); } ?> </font>
                        </td>

                        <td style="width: 130px;">
                            <font size="2"> <?php if($DataFechamento=="0000-00-00") {
                               echo ("");

                                  }elseif($DataFechamento=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($DataFechamento); } ?></font>
                        </td>
                     

                        <td id="botaoEditar">


                            <a
                                onclick="window.open('editar_cotacao.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                                <button type="button" name="editar">Editar</button>
                            </a>

                        </td>


                    </tr>



                    <?php
           }}
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