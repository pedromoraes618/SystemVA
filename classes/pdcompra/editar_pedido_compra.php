<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />


<?php

if(isset($_POST['btnsalvar'])){

    //inlcuir as varias do input

    $pedidoID =  utf8_decode($_POST["cammpoPedidoID"]);
    $numeroPedidoCompra =  utf8_decode($_POST["campoNpdCompra"]);
    $numeroOrcamento =  utf8_decode($_POST["campoOrcamento"]);
    $numeroNfe = utf8_decode($_POST["campoNnfe"]);
    $formaPagamento = utf8_decode($_POST["campoFormaPagamento"]);
    $cliente = utf8_decode($_POST["campoCliente"]);
    $produto = utf8_decode($_POST["campoProduto"]);
    $statusCompra = utf8_decode($_POST["campoStatusCompra"]);
    $statusPedido = utf8_decode($_POST["campoStatusPedido"]);
    $precoVenda = utf8_decode($_POST["campoPrecoVenda"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCompra"]);
    $unidade = utf8_decode($_POST["CampoUnidade"]);
    $quantidade = utf8_decode($_POST["CampoQuantidade"]);
    $margem = utf8_decode($_POST["campoMargem"]);
    $desconto = utf8_decode($_POST["campoDesconto"]);
    $observacao = utf8_decode($_POST["observacao"]);

    $entregaPrevista = utf8_decode($_POST["CampoEntregaPrevista"]);
    $dataPagamento = utf8_decode($_POST["campoDataPagamento"]);
    $dataCompra = utf8_decode($_POST["campoDataCompra"]);
    $entregaRealizada = utf8_decode($_POST["CampoEntregaRealizada"]);
    $dataChegada = utf8_decode($_POST["CampoDataChegada"]);

//condição obrigatorio 
if(!$numeroPedidoCompra == ""){

   if($entregaPrevista==""){
     
   }else{
       $div1 = explode("/",$_POST['CampoEntregaPrevista']);
       $entregaPrevista = $div1[2]."-".$div1[1]."-".$div1[0];  
      
   }
   if($dataPagamento==""){
      
   }else{
       $div2 = explode("/",$_POST['campoDataPagamento']);
   $dataPagamento = $div2[2]."-".$div2[1]."-".$div2[0];
   }


   if($dataCompra==""){
   
   }else{
       
   $div3 = explode("/",$_POST['campoDataCompra']);
   $dataCompra = $div3[2]."-".$div3[1]."-".$div3[0];
   }

   
   if($entregaRealizada==""){
      
   }else{
       
       $div4 = explode("/",$_POST['CampoEntregaRealizada']);
       $entregaRealizada = $div4[2]."-".$div4[1]."-".$div4[0];
   }

   if($dataChegada==""){
      
   }else{
       
       $div5 = explode("/",$_POST['CampoDataChegada']);
       $dataChegada = $div5[2]."-".$div5[1]."-".$div5[0];
   }

  

   
   //query para alterar o cliente no banco de dados
   $alterar = "UPDATE pedido_compra set numero_pedido_compra = '{$numeroPedidoCompra}', numero_orcamento = '{$numeroOrcamento}', numero_nf = '{$numeroNfe}',  forma_pagamento = '{$formaPagamento}', ";
   $alterar .= " clienteID = '{$cliente}', produto = '{$produto}', status_da_compra = '{$statusCompra}', status_do_pedido = '{$statusPedido}', valor_venda = '{$precoVenda}', valor_compra = '{$precoCompra}' , ";
   $alterar .= " unidade_medida = '{$unidade}', quantidade = '{$quantidade}', margem = '{$margem}', desconto = '{$desconto}', observacao = '{$observacao}', entrega_prevista = '{$entregaPrevista}', data_pagamento = '{$dataPagamento}', data_compra = '{$dataCompra}', entrega_realizada = '{$entregaRealizada}', data_chegada= '{$dataChegada}'  WHERE pedidoID = {$pedidoID} ";

     $operacao_alterar = mysqli_query($conecta, $alterar);
     if(!$operacao_alterar) {
         die("Erro na alteracao linha29");   
     } else {echo ',';
        ?>
        
        <script >
        alertify.success('Dados alterados');
        </script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }

}

include("../classes/pdcompra/remover_pedido_compra.php");

//variaveis
$campo_obrigatorio_RazacaoS ="Número do pedido não informado";
$msgcadastrado = "Pedido de compra lançado com sucesso!";



//consultar categoria do produto
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
   die("Falaha no banco de dados || select formapagma");
   
}

//consultar status do pedido
$select = "SELECT statuspedidoID, nome from status_pedido";
$lista_statuspedido = mysqli_query($conecta,$select);
if(!$lista_statuspedido){
   die("Falaha no banco de dados || select statuspedido");
}

//consultar status da compra
$select = "SELECT statuscompraID, nome from status_compra";
$lista_statuscompra = mysqli_query($conecta,$select);
if(!$lista_statuscompra){
   die("Falaha no banco de dados || select statuscompra");
}

//consultar cliente
$select = "SELECT clienteID, razaosocial from clientes";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
   die("Falaha no banco de dados || select clientes");
}


//pegar o id do pedido de compra
$consulta = "SELECT * FROM pedido_compra ";
if (isset($_GET["codigo"])){
   $pedidoID=$_GET["codigo"];
   $consulta .= " WHERE pedidoID = {$pedidoID} ";

}else{
   $consulta .= " WHERE pedidoID = 1 ";
}
//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
   $BpedidoID=  utf8_encode($dados_detalhe['pedidoID']);
   $BnumeroOrcamento   =  utf8_encode($dados_detalhe["numero_orcamento"]);
   $BnumeroPedidoCompra = utf8_encode($dados_detalhe["numero_pedido_compra"]);
   $BnumeroNfe = utf8_encode($dados_detalhe["numero_nf"]);
   $BformaPagamento = utf8_encode($dados_detalhe["forma_pagamento"]);
   $Bcliente = utf8_encode($dados_detalhe["clienteID"]);
   $Bproduto =  utf8_encode($dados_detalhe["produto"]);
   $BstatusCompra = utf8_encode($dados_detalhe["status_da_compra"]);
   $BstatusPedido = utf8_encode($dados_detalhe["status_do_pedido"]);
   $BprecoVenda = utf8_encode($dados_detalhe["valor_venda"]);
   $BprecoCompra = utf8_encode($dados_detalhe["valor_compra"]);
   $Bunidade = utf8_encode($dados_detalhe["unidade_medida"]);
   $Bquantidade = utf8_encode($dados_detalhe["quantidade"]);
   $Bmargem = utf8_encode($dados_detalhe["margem"]);
   $Bdesconto = utf8_encode($dados_detalhe["desconto"]);
   $Bobservacao = utf8_encode($dados_detalhe["observacao"]);
   $BentregaPrevista = utf8_encode($dados_detalhe["entrega_prevista"]);
   $BdataPagamento = utf8_encode($dados_detalhe["data_pagamento"]);
   $BdataCompra = utf8_encode($dados_detalhe["data_compra"]);
   $BentregaRealizada = utf8_encode($dados_detalhe["entrega_realizada"]);
   $BdataChegada = utf8_encode($dados_detalhe["data_chegada"]);
   
   
}

?>