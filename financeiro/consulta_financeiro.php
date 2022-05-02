<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");


include ("../_incluir/funcoes.php");

//consultar lancamento
$select = "SELECT receita_despesaID, nome from receita_despesa";
$lista_receita_despesa = mysqli_query($conecta,$select);
if(!$lista_receita_despesa){
    die("Falaha no banco de dados || falha de conexão");
}


//consultar pedido de compra

if(isset($_GET["CampoPesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"] && ["CampoPesquisaDoc"]) {

    $pesquisaData = $_GET["CampoPesquisaData"];
    $pesquisaDataf = $_GET["CampoPesquisaDataf"];
    $lancamento = $_GET['campoLancamento'];
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
        $pesquisaDoc = $_GET["CampoPesquisaDoc"];
        if(($lancamento=="Receita") or ($lancamento=="Despesa")){
            $select  .= " WHERE data_movimento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.razaosocial LIKE '%{$pesquisa}%' and lancamento_financeiro.documento LIKE '%{$pesquisaDoc}%' and  lancamento_financeiro.receita_despesa = '$lancamento' ";
        }elseif($lancamento=="Selecione"){
            $select  .= " WHERE data_movimento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.razaosocial LIKE '%{$pesquisa}%' and lancamento_financeiro.documento LIKE '%{$pesquisaDoc}%'  ";
        };
       
       
      

//consultar cliente
$lista_pesquisa = mysqli_query($conecta,$select);
if(!$lista_pesquisa){
    die("Falaha no banco de dados || select clientes");
}
}

if(isset($_GET["CampoPesquisa"]) && ["CampoPesquisaData"] && ["CampoPesquisaDataf"] && ["CampoPesquisaDoc"]) {
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
    
   

$selectValorSoma  = "SELECT  clientes.razaosocial, grupo_lancamento.nome AS nomeGrupo, forma_pagamento.nome, lancamento_financeiro.lancamentoFinanceiroID, lancamento_financeiro.data_movimento, sum(valor) as soma, lancamento_financeiro.documento,lancamento_financeiro.lancamentoFinanceiroID, lancamento_financeiro.data_a_pagar, lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento, lancamento_financeiro.receita_despesa from  clientes inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID inner join grupo_lancamento on lancamento_financeiro.grupoID = grupo_lancamento.grupo_lancamentoID inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID " ;
$pesquisa = $_GET["CampoPesquisa"];
$pesquisaDoc = $_GET["CampoPesquisaDoc"];
if(($lancamento=="Receita") or ($lancamento=="Despesa")){
$selectValorSoma  .= " where data_movimento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.razaosocial LIKE '%{$pesquisa}%' and lancamento_financeiro.documento LIKE '%{$pesquisaDoc}%' and  lancamento_financeiro.receita_despesa = '$lancamento'  "   ;
 }elseif($lancamento=="Selecione"){
    $selectValorSoma  .= " where data_movimento BETWEEN '$pesquisaData' and '$pesquisaDataf' and clientes.razaosocial LIKE '%{$pesquisa}%' and lancamento_financeiro.documento LIKE '%{$pesquisaDoc}%' "   ;

};
       
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
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>



    <main>



        <div id="janela_pesquisa">
            <ul>
                <li>
                    <b> Data lançamento</b>
                </li>

            </ul>

            <div id="BotaoLancar">

                <a
                    onclick="window.open('lancar_receita_despesa.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                    <input id="lancar" type="submit" name="lançarFinanceiro" value="Lançar Financeiro">

                </a>
            </div>


            <form style="width:1500px; " action="" method="get">

                <tr>

                    <input style="width: 100px; " type="text" id="CampoPesquisaData" name="CampoPesquisaData"
                        placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if( !isset($_GET["CampoPesquisa"])){ echo formatardataB(date('Y-m-01')); }
                              if (isset($_GET["CampoPesquisaData"])){
                                 echo $pesquisaData;
                     }?>">

                    <input style=" width: 100px;" type="text" name="CampoPesquisaDataf" placeholder="Data final"
                        onkeyup="mascaraData(this);" value="<?php if(!isset($_GET["CampoPesquisa"])){ echo date('d/m/Y');
                    } if (isset($_GET["CampoPesquisaDataf"])){ echo $pesquisaDataf;} ?>">

                    <input style="width: 100px; margin-left:50px" type="text" name="CampoPesquisaDoc"
                        placeholder="N° documento" value="<?php if(isset($_GET['CampoPesquisaDoc'])){
                                echo $pesquisaDoc;
                    }?>">

                    <td>
                        <input style="margin-left:110px;" type="text" name="CampoPesquisa"
                            placeholder="pesquisa / Empresa" value="<?php if(isset($_GET['CampoPesquisa'])){
                                echo $pesquisa;
                        }?>">
                        <input type="image" name="pesquisa"
                            src="https://img.icons8.com/ios/50/000000/search-more.png" />
                    </td>
                    <td>
                        <select style="width: 170px; float:right; margin-right:100px; " id="campoLancamento"
                            name="campoLancamento">
                            <?php 
                            
                               
                             while($linha_receita_despesa  = mysqli_fetch_assoc($lista_receita_despesa)){
                                $receita_despesa_principal = utf8_encode($linha_receita_despesa["nome"]);
                               if(!isset($lancamento)){
                               
                               ?>
                            <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>">
                                <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                            </option>
                            <?php
                               
                               }else{
   
                                if($lancamento==$receita_despesa_principal){
                                ?> <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>" selected>
                                <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                            </option>

                            <?php
                                         }else{
                                
                               ?>
                            <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>">
                                <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                            </option>
                            <?php
   
           }
           
       }
   
                             
   }
   
                         ?>


                        </select>
                    </td>


                </tr>


            </form>

        </div>

        <form action="consulta_financeiro.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">

                        <td>
                            <p>Data Lançamento</p>
                        </td>

                        <td>
                            <p>Data Vencimento</p>
                        </td>
                        <td>
                            <p>Empresa</p>
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
                            <font size="2"> <?php  echo ($receite_despesa);
                            if ($receite_despesa=="Receita"){
                          ?>
                                <i title="Receita" style="font-size: 20px; margin-left:10px"
                                    class="fa-solid fa-money-bill-trend-up"></i>
                                <?php
                              }if($receite_despesa=="Despesa"){
                           
                            ?>
                                <i title="Despesa" style="font-size: 20px; margin-left:10px"
                                    class="fa-solid fa-money-bill-transfer"></i><?php
                        }
                            ?>
                            </font>
                        </td>



                        <td id="botaoEditar">

                            <a
                                onclick="window.open('editar_receita_despesa.php?codigo=<?php echo $lancamentoID?>', 
        'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">


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

function abrepopupEditarEditarFinanceiro() {

    var janela = "editar_receita_despesa.php?codigo=<?php echo  $lancamentoID?>";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>