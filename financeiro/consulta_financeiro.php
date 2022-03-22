<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");


include ("../_incluir/funcoes.php");





//consultar pedido de compra
if(isset($_GET["CampoPesquisa"])){
    
        $select = "SELECT  clientes.razaosocial, grupo_lancamento.nome,forma_pagamento.nome, lancamento_financeiro.data_movimento, lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento, lancamento_financeiro.receita_despesa from  clientes inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join grupo_lancamento on lancamento_financeiro.grupoID = grupo_lancamento.grupo_lancamentoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID " ;

        if(isset($_GET["CampoPesquisa"])){
        $pesquisa = $_GET["CampoPesquisa"];
        $select  .= " WHERE  clientes.razaosocial LIKE '%{$pesquisa}%' ";
       
        }
    
       

//consultar cliente

$lista_pesquisa = mysqli_query($conecta,$select);
if(!$lista_pesquisa){
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
            <div id="BotaoLancarFinanceiro">
                <a href="lancar_receita_despesa.php">
                    <input id="lancar" type="submit" name="lançarFinanceiro" value="Lançar Financeiro">
                </a>
            </div>

            <form action="consulta_financeiro.php" method="get">
                <input type="text" name="CampoPesquisa" placeholder="pesquisa / Cliente / Entrega prevista / N° Pedido">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />

            </form>


        </div>

        <form action="consulta_financeiro.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">

                        <td>
                            <p>Data Lancamento</p>
                        </td>

                        <td>
                            <p>Data Vencimento</p>
                        </td>
                        <td>
                            <p>Cliente</p>
                        </td>
                        <td>
                            <p>Status</p>
                        </td>
                        <td>
                            <p>Grupo</p>
                        </td>

                        <td>
                            <p>Valor</p>
                        </td>
                        <td>
                            <p>Nº documento</p>
                        </td>
                        <td>
                            <p>Tipo</p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                    </tr>

                    <?php

if(isset($_GET["CampoPesquisa"])){
    /* 
    while($linha = mysqli_fetch_assoc($resultado)){
    

    ?>
                    */

                    while($linha_pesquisa = mysqli_fetch_assoc($lista_pesquisa)){
                    $dataMovimentoL = $linha_pesquisa["data_movimento"];
                    $dataVencimentoL = $linha_pesquisa["data_a_pagar"];
                    $clienteL = $linha_pesquisa['razaosocial'];
                    $statusL = $linha_pesquisa["status"];
                    $grupoLancamentoL = $linha_pesquisa["nome"];
                    $valorL = $linha_pesquisa["valor"];
                    $documentoL = $linha_pesquisa["documento"];
                    $receite_despesa = $linha_pesquisa["receita_despesa"];
                   
                    ?>

                    <tr id="linha_pesquisa">

                    <td>
                        <p>
                            <font size="2"> <?php if($dataMovimentoL=="0000-00-00") {
                               echo ("");

                                  }elseif($dataMovimentoL=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataMovimentoL); } ?></font>
                                  </p>
                        </td>


                        <td>
                            <font size="2"> <?php if($dataVencimentoL=="0000-00-00") {
                               echo ("");

                                  }elseif($dataVencimentoL=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataVencimentoL); } ?></font>
                        </td>


                        <td>
                            <font size="2"><?php echo utf8_encode($clienteL)?></font>
                        </td>
                        <td>
                            <font size="2"> <?php echo utf8_encode($statusL)?></font>
                        </td>

                        <td>
                            <font size="2"> <?php echo utf8_encode($grupoLancamentoL)?></font>
                        </td>

                        <td>
                            <font size="2"> <?php echo real_format($valorL)?></font>
                        </td>

                        <td>
                            <font size="2"> <?php echo utf8_encode($documentoL)?> </font>
                        </td>

                        <td>
                            <font size="2"> <?php echo utf8_encode($receite_despesa )?> </font>
                        </td>



                        <td id="botaoEditar">
                            <a href="editar_pdcompra.php?codigo=<?php ?>">

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