<?php
require_once("../conexao/conexao.php");
include("../../conexao/sessao.php");

include ("../../_incluir/funcoes.php");

//variaveis texto obrigatorio e sucesso!
$msgcadastrado = "Lançamento realizado com sucesso";



//consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}


//consultar cliente
$select = "SELECT clienteID, razaosocial from clientes";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}

//consultar lancamento
$select = "SELECT receita_despesaID, nome from receita_despesa";
$lista_receita_despesa = mysqli_query($conecta,$select);
if(!$lista_receita_despesa){
    die("Falaha no banco de dados ||   falha de conexão de red || select clientes");
}


//consultar status do pedido
$select = "SELECT status_lancamentoID, nome from status_lancamento";
$lista_statusLancamento = mysqli_query($conecta,$select);
if(!$lista_statusLancamento){
    die("Falaha no banco de dados
    || falha de conexão de red
    select status Lancamento");
}


//consultar grupo Lançamento
$select = "SELECT grupo_lancamentoID, nome from grupo_lancamento";
$lista_grupoLancamento = mysqli_query($conecta,$select);
if(!$lista_grupoLancamento){
    die("Falaha no banco de dados
    || falha de conexão de red
    select status Lancamento");
}

//consultar status da compra
$select = "SELECT statuscompraID, nome from status_compra";
$lista_statuscompra = mysqli_query($conecta,$select);
if(!$lista_statuscompra){
    die("Falaha no banco de dados || select statuscompra");
}

//iniciar a tela com o campo preenchido


//variaveis 
if(isset($_POST["btnsalvar"])){

    $lancamentoID = utf8_decode($_POST["cammpoLancamentoID"]);
    $dataLancamento = utf8_decode($_POST["campoDataLancamento"]);
    $dataapagar = utf8_decode($_POST["campoDataPagar"]);
    $dataPagamento = utf8_decode($_POST["campoDataPagamento"]);
    $lancamento = utf8_decode($_POST["campoLancamento"]);
    $cliente = utf8_decode($_POST["campoCliente"]);
    $formaPagamento = utf8_decode($_POST["campoFormaPagamento"]);
    $statusLancamento = utf8_decode($_POST["campoStatusLancamento"]);
    $descricao = utf8_decode($_POST["campoDescricao"]);
    $documento = utf8_decode($_POST["campoDocumento"]);
    $grupoLancamento = utf8_decode($_POST["CampoGrupoLancamento"]);
    $valor = utf8_decode($_POST["campoValor"]); 
    $observacao = utf8_decode($_POST["observacao"]);

//formatar a data para o banco de dados(Y-m-d)

//condição obrigatorio 
    if(!$lancamento == ""){

        if($dataLancamento==""){
          
        }else{
            $div1 = explode("/",$_POST['campoDataLancamento']);
            $dataLancamento = $div1[2]."-".$div1[1]."-".$div1[0];  
           
        }
        if($dataapagar==""){
           
        }else{
            $div2 = explode("/",$_POST['campoDataPagar']);
        $dataapagar = $div2[2]."-".$div2[1]."-".$div2[0];
        }


        if($dataPagamento==""){
        
        }else{
            
        $div3 = explode("/",$_POST['campoDataPagamento']);
        $dataPagamento = $div3[2]."-".$div3[1]."-".$div3[0];
        }


    //alterando as informações no banco de dados
  
    //query para alterar o pedido de compra no banco de dados
    $alterar = "UPDATE lancamento_financeiro set data_movimento = '{$dataLancamento}', data_a_pagar = '{$dataPagamento}', receita_despesa = '{$lancamento}',  status = '{$statusLancamento}', ";
    $alterar .= " forma_pagamentoID = '{$formaPagamento}', clienteID = '{$cliente}', descricao = '{$descricao}', documento = '{$documento}', grupoID = '{$grupoLancamento}', valor = '{$valor}',  observacao  = '{$observacao}' WHERE lancamentoFinanceiroID = {$lancamentoID} ";

      $operacao_alterar = mysqli_query($conecta, $alterar);
      if(!$operacao_alterar) {
          die("Erro na alteracao linha29");   
      } else {  ?>

<p id="confirmacao">Dados alterados</p>
<?php
          //header("location:listagem.php"); 
           
      }

}
}



//botão remover
?>


<?php

    $consulta = "SELECT * FROM lancamento_financeiro ";
if (isset($_GET["codigo"])){
    $lancamentoID=$_GET["codigo"];
$consulta .= " WHERE lancamentoFinanceiroID = {$lancamentoID} ";
}else{
    $consulta .= " WHERE lancamentoFinanceiroID = 1 ";
  
}
//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
    die("Falha na consulta ao banco de dados");
}else{
 
    $dados_detalhe = mysqli_fetch_assoc($detalhe);
    $BpedidoID =  utf8_encode($dados_detalhe['lancamentoFinanceiroID']);
    $BdataMovimento =  utf8_encode($dados_detalhe["data_movimento"]);
    $BdataaPagar = utf8_encode($dados_detalhe["data_a_pagar"]);
    $BdataPagamento = utf8_encode($dados_detalhe["data_do_pagamento"]);
    $BreceitaDespesa = utf8_encode($dados_detalhe["receita_despesa"]);
    $Bstatus = utf8_encode($dados_detalhe["status"]);
    $BformaPagamentoID = utf8_encode($dados_detalhe["forma_pagamentoID"]);
    $BclienteID = utf8_encode($dados_detalhe["clienteID"]);
    $Bdescrisao = utf8_encode($dados_detalhe["descricao"]);
    $Bdocumento = utf8_encode($dados_detalhe["documento"]);
    $BgrupoID = $dados_detalhe["grupoID"];
    $Bvalor = utf8_encode($dados_detalhe["valor"]);
    $Bobservacao = utf8_encode($dados_detalhe["observacao"]);
    

}


  ?>
