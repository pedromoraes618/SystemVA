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
include ("../_incluir/funcoes.php");


//variaveis texto obrigatorio e sucesso!
$campo_obrigatorio_RazacaoS ="Número do pedido não informado";
$msgcadastrado = "Pedido de compra lançado com sucesso!";



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
echo ".";

//variaveis 
if(isset($_POST["enviar"])){
    $hoje = date('Y-m-d'); 
    $pedidoID = utf8_decode($_POST["cammpoPedidoID"]);
    $numeroPedidoCompra = utf8_decode($_POST["campoNpdCompra"]);
    $numeroOrcamento = utf8_decode($_POST["campoOrcamento"]);
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
    
   

  if(isset($_POST['enviar'])){

  if($statusCompra=="Selecione"){
          
                ?>
<script>
alertify.alert("Favor selecione o status da compra");
</script>
<?php 
            }elseif($cliente == ("1")){
                
         
                ?>
<script>
alertify.alert("Favor informar o cliente");
</script>

<?php 

        }elseif($formaPagamento == ("1")){

            ?>
<script>
alertify.alert("Favor informar a forma de pagamento");
</script>

<?php 

        
        }else{ 
                        ?>
<script>
alertify.success("Pedido de compra lançado com sucesso");
</script>
<?php
                
                ?>
<?php

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

       
    

//inserindo as informações no banco de dados
  $inserir = "INSERT INTO pedido_compra ";
  $inserir .= "( data_movimento,numero_pedido_compra,numero_orcamento,numero_nf,data_pagamento,forma_pagamento,clienteID,produto,status_da_compra,status_do_pedido,data_compra,data_chegada,entrega_prevista,entrega_realizada,valor_venda,valor_compra,unidade_medida,quantidade,margem,desconto,observacao)";
  $inserir .= " VALUES ";
  $inserir .= "( '$hoje','$numeroPedidoCompra','$numeroOrcamento','$numeroNfe','$dataPagamento','$formaPagamento','$cliente','$produto','$statusCompra','$statusPedido','$dataCompra','$dataChegada','$entregaPrevista','$entregaRealizada','$precoVenda','$precoCompra','$unidade','$quantidade','$margem','$desconto','$observacao')";
  

  //limpando os campos apos ser feito o insert no banco de dados
  $numeroPedidoCompra = "";
  $numeroOrcamento = "";
  $numeroNfe = "";

  $produto = "";
  $precoVenda = "";
  $precoCompra = "";
  $unidade = "";
  $quantidade = "";
  $margem = "";
  $desconto = "";
  $observacao = "";
  $entregaPrevista = "";
  $dataPagamento = "";
  $dataCompra = "";
  $entregaRealizada = "";
  $dataChegada = "";
  
  //verificando se está havendo conexão com o banco de dados
  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
    print_r($_POST);
      die("Erro no banco de dados Linha 61 inserir_no_banco_de_dados");
   
  }

}
}
}//if selecione status da compra
}





  
?>