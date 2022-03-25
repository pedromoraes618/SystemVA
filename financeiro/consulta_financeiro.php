<?php require_once("../conexao/conexao.php"); ?>
<?php

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



        $select = "SELECT  clientes.razaosocial, grupo_lancamento.nome AS nomeGrupo, forma_pagamento.nome, lancamento_financeiro.data_movimento, lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID, lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento, lancamento_financeiro.receita_despesa from  clientes inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join grupo_lancamento on lancamento_financeiro.grupoID = grupo_lancamento.grupo_lancamentoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID " ;
        $pesquisa = $_GET["CampoPesquisa"];
        $select  .= " WHERE data_movimento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.razaosocial LIKE '%{$pesquisa}%' ";
       
      

//consultar cliente
$lista_pesquisa = mysqli_query($conecta,$select);
if(!$lista_pesquisa){
    die("Falaha no banco de dados || select clientes");
}
}

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

$selectValorSoma = $select = "SELECT  clientes.razaosocial, grupo_lancamento.nome AS nomeGrupo, forma_pagamento.nome, lancamento_financeiro.data_movimento, sum(valor) as soma, lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID, lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento, lancamento_financeiro.receita_despesa from  clientes inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join grupo_lancamento on lancamento_financeiro.grupoID = grupo_lancamento.grupo_lancamentoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID " ;
$pesquisa = $_GET["CampoPesquisa"];

$selectValorSoma  .= " where data_movimento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.razaosocial LIKE '%{$pesquisa}%' "   ;

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

            <form style="width:1500px; " action="" method="get">

                <td>

                    <input style="width: 100px; " type="text" id="CampoPesquisaData" name="CampoPesquisaData"
                        placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if( !isset($_GET["CampoPesquisa"])){ echo formatardataB(date('Y-m-01')); }
                              if (isset($_GET["CampoPesquisaData"])){
                                 echo $pesquisaData;
                                    }?>" placeholder="pesquisa / Cliente / N° documento">

                    <input style="width: 100px;" type="text" name="CampoPesquisaDataf" placeholder="Data final"
                        onkeyup="mascaraData(this);" value="<?php if(!isset($_GET["CampoPesquisa"])){ echo date('d/m/Y');
                        } if (isset($_GET["CampoPesquisaDataf"])){ echo $pesquisaDataf;} ?>"
                        placeholder="pesquisa / Cliente / N° documento">

                    <input style="margin-left:250px;" type="text" name="CampoPesquisa"
                        placeholder="pesquisa / Cliente / N° documento">

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
                            <p>Valor</p>
                        </td>
                        <td>
                            <p>Status</p>
                        </td>
                        <td>
                            <p>Grupo</p>
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

                    while($linha_pesquisa = mysqli_fetch_assoc($lista_pesquisa)){
                    $dataMovimentoL = $linha_pesquisa["data_movimento"];
                    $dataVencimentoL = $linha_pesquisa["data_a_pagar"];
                    $clienteL = $linha_pesquisa['razaosocial'];
                    $statusL = $linha_pesquisa["status"];
                    $grupoLancamentoL = $linha_pesquisa["nomeGrupo"];
                    $valorL = $linha_pesquisa["valor"];
                    $documentoL = $linha_pesquisa["documento"];
                    $receite_despesa = $linha_pesquisa["receita_despesa"];
                    $lancamentoID = $linha_pesquisa["lancamentoFinanceiroID"];
                   
                    ?>

                    <tr id="linha_pesquisa">

                        <td style="width: 150px;">
                            <p>
                                <font size="2"> <?php if($dataMovimentoL=="0000-00-00") {
                               echo ("");

                                  }elseif($dataMovimentoL=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataMovimentoL); } ?></font>
                            </p>
                        </td>


                        <td style="width: 150px;">
                            <font size="2"> <?php if($dataVencimentoL=="0000-00-00") {
                               echo ("");

                                  }elseif($dataVencimentoL=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataVencimentoL); } ?></font>
                        </td>


                        <td style="width:350px;">
                            <font size="2"><?php echo utf8_encode($clienteL)?></font>
                        </td>

                        <td>
                            <font size="2"> <?php echo real_format($valorL)?></font>
                        </td>

                        <td>
                            <font size="2"> <?php echo utf8_encode($statusL)?></font>
                        </td>

                        <td style="width:170px;">
                            <font size="2"> <?php echo utf8_encode($grupoLancamentoL)?></font>
                        </td>


                        <td style="width:150px;">
                            <font size="2"> <?php echo utf8_encode($documentoL)?> </font>
                        </td>

                        <td>
                            <font size="2"> <?php echo utf8_encode($receite_despesa )?> </font>
                        </td>



                        <td id="botaoEditar">
                            <a href="editar_receita_despesa.php?codigo=<?php echo  $lancamentoID?>">

                                <button type="button" name="Editar">Editar</button>
                            </a>
                        </td>
                    </tr>




                    <?php
                    }

                    while($linha_Soma_Valor = mysqli_fetch_assoc($lista_Soma_Valor)){
                
                        ?>

                    <tr id="cabecalho_pesquisa_consulta">

                        <td>
                            <p>Valor</p>
                        </td>

                        <td>
                            <p></p>
                        </td>
                        <td>
                            <p></p>
                        </td>
                        <td style="width: 140px;">
                            <p><?php echo real_format($linha_Soma_Valor['soma']) ?></p>
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


<?php include '../_incluir/funcaojavascript.jar'; ?>

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