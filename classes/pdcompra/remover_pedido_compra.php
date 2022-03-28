


    <?php

  if(isset($_POST['btnremover'])){
      

  
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


    //query para remover o cliente no banco de dados
    if( !$pedidoID=="" ){

 

    $remover = "DELETE FROM pedido_compra WHERE pedidoID = {$pedidoID}";

      $operacao_remover = mysqli_query($conecta, $remover);
      if(!$operacao_remover) {
          die("Erro linha 44");   
      } else {echo ',';
        ?>
        
        <script >
        alertify.error('Pedido de compra removido com sucesso');
        </script>



<?php


          //header("location:listagem.php"); 
           
      }
      
    } 
    
    }

  ?>