<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include ("../_incluir/funcoes.php");


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
      } else {  ?>

<p id="confirmacao">Dados alterados</p>
<?php
          //header("location:listagem.php"); 
           
      }
    
    }

}

  ?>

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
      } else {  
        

    ?>
<p id="obrigatorio">Pedido de compra removido</p>


<?php
          //header("location:listagem.php"); 
           
      }
      
    } 
    
    }

  ?>




<?php

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


<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

</head>

<body>

    <main>
        <form action="" method="post">
            <div id="titulo">
                </p>Editar Pedido de Compra</p>
            </div>



            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="cammpoPedidoID" name="cammpoPedidoID"
                            value="<?php echo $BpedidoID ?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Nº Pedido:</b></td>
                    <td align=left><input type="text" size=20 name="campoNpdCompra"
                            value="<?php echo $BnumeroPedidoCompra ?>" td>

                        <b>Nº Orçamento:</b>
                        <input type="text" size=20 id="campoOrcamento" name="campoOrcamento"
                            value="<?php echo $BnumeroOrcamento?>">


                    <td><b>Nº NFE:</b></td>
                    <td><input type="text" size=20 id="campoNnfe" name="campoNnfe"
                            value="<?php echo $BnumeroNfe?>"><b>Data
                            Pagamento:</b>
                        <input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento" value="<?php
                            if($BdataPagamento=="1970-01-01"){
                                print_r("");
                            }elseif($BdataPagamento=="0000-00-00"){
                                print_r ("");
                            }else{
                                echo formatardataB($BdataPagamento);}?>" OnKeyUp="mascaraData(this);" maxlength="10"
                            autocomplete="off">

                </tr>

                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left><select id="campoCliente" name="campoCliente">
                            <?php 

                             $meuCliente =  $Bcliente ;
                           while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                               $formaClientePrincipal = utf8_encode($linha_clientes["clienteID"]);

                               if($meuCliente==$formaClientePrincipal){
                                   ?> <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>" selected>
                                <?php echo utf8_encode($linha_clientes["razaosocial"]);?>
                            </option>

                            <?php
                                   }else{
                                       ?>
                            <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                <?php echo utf8_encode($linha_clientes["razaosocial"]);?>
                            </option>
                            <?php

                                   }
                                   

                         }
                         
                         ?>


                        </select>
                    </td>


                    <td><b>Forma do pagamento:</b></td>
                    <td><select id="campoFormaPagamento" name="campoFormaPagamento">
                            <?php 

                             $meuFomraPagmaneto =  $BformaPagamento ;
                           while($linha_formapagamento = mysqli_fetch_assoc($lista_formapagamemto)){
                               $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["nome"]);

                               if($meuFomraPagmaneto==$formaPagamentoPrincipal){
                                   ?>

                            <option value="<?php echo utf8_encode($linha_formapagamento["nome"]);?>" selected>
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>

                            <?php
                                   }else{
                                       ?>
                            <option value="<?php echo utf8_encode($linha_formapagamento["nome"]);?>">
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>
                            <?php

                                   }
                                   

                         }
                         
                         ?>

                        </select>

                    </td>
                </tr>

                <tr>
                    <td align=left><b>Produto:</b></td>
                    <td align=left><input type="text" size=57 name="campoProduto" id="campoProduto"
                            value="<?php echo $Bproduto?>"><i id="botaoPesquisar"
                            class="fa-solid fa-magnifying-glass-plus"></i> </td>

                    <td>
                        <b>Status da compra:</b>
                    </td>
                    <td>

                        <select id="campoStatusCompra" name="campoStatusCompra">
                            <?php 

                                $meuStatusCompra = $BstatusCompra;
                                while($linha_statusCompra = mysqli_fetch_assoc($lista_statuscompra )){
                                $statusCompraPrincipal = utf8_encode($linha_statusCompra["nome"]);

                                if($meuStatusCompra == $statusCompraPrincipal){

                        ?>
                            <option value="<?php echo utf8_encode($linha_statusCompra["nome"]);?>" selected>
                                <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                            </option>

                            <?php

                         }else{
                             ?>
                            <option value="<?php echo utf8_encode($linha_statusCompra["nome"]);?>">
                                <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                            </option>
                            <?php
                         }
                        }
                         
                         ?>

                        </select>

                        <b>Data Compra:</b>
                        <input type="text" size=20 id="campoDataCompra" name="campoDataCompra" value="<?php 
                        
                        
                        if($BdataCompra=="1970-01-01"){
                            print_r("");
                        }elseif($BdataCompra=="0000-00-00"){
                            print_r ("");
                        }else{
                            echo formatardataB($BdataCompra);}?>" OnKeyUp="mascaraData(this);" maxlength="10"
                            autocomplete="off">

                    </td>


                </tr>

                <tr>
                    <td align=left><b>Unidade:</b></td>
                    <td align=left><input type="text" size=18 name="CampoUnidade" id="CampoUnidade"
                            value="<?php echo $Bunidade ?>"><b>Quantidade:</b>
                        <input type="text" size=19 name="CampoQuantidade" id="CampoQuantidade"
                            value="<?php echo $Bquantidade?>">
                    </td>


                    <td align=left><b>Data chegada:</b></td>
                    <td align=left><input type="text" size=20 name="CampoDataChegada" id="CampoDataChegada" value="<?php
                    
                    if($BdataChegada=="1970-01-01"){
                                print_r ("");
                            }elseif($BdataChegada=="0000-00-00"){
                                print_r ("");
                            }else{
                                echo formatardataB($BdataChegada);}
                                ?>" OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off"><b>Entrega
                            Prevista:</b>

                        <input type="text" size=20 id="CampoEntregaPrevista" name="CampoEntregaPrevista" value="<?php 
                             if($BentregaPrevista=="1970-01-01"){
                                print_r("");
                            }elseif($BentregaPrevista=="0000-00-00"){
                                print_r ("");
                            }else{
                                echo formatardataB($BentregaPrevista); }?>" OnKeyUp="mascaraData(this);" maxlength="10"
                            autocomplete="off">
                    </td>


                </tr>


                <tr>
                    <td align=left><b>Preço Venda:</b></td>
                    <td align=left><input type="text" size=18 name="campoPrecoVenda" id="campoPrecoVenda"
                            value="<?php echo $BprecoVenda?>"><b>Preço
                            Compra:</b>
                        <input type="text" size=16 id="campoPrecoCompra" name="campoPrecoCompra"
                            value="<?php echo $BprecoCompra ?>">
                    </td>


                    <td><b>Status do pedido:</b></td>
                    <td>
                        <select id="campoStatusPedido" name="campoStatusPedido">
                            <?php 
                            $meuStatusPedido = $BstatusPedido;
                           while($linha_statusPedido= mysqli_fetch_assoc($lista_statuspedido)){
                               $statusPrinciapl = utf8_encode($linha_statusPedido["nome"]);

                               if($meuStatusPedido== $statusPrinciapl){

                        ?>
                            <option value="<?php echo utf8_encode($linha_statusPedido["nome"]);?>" selected>
                                <?php echo utf8_encode($linha_statusPedido["nome"]);?>
                            </option>

                            <?php
                               }else{
                                   ?>
                            <option value="<?php echo utf8_encode($linha_statusPedido["nome"]);?>" selected>
                                <?php echo utf8_encode($linha_statusPedido["nome"]);?>
                            </option>
                            <?php
                         }
                        }
                         ?>

                        </select>

                        <b>Entrega Realizada:</b>
                        <input type="text" size=20 id="CampoEntregaRealizada" name="CampoEntregaRealizada" value="<?php
                             if($BentregaRealizada=="1970-01-01"){
                                print_r("");
                            }elseif($BentregaRealizada=="0000-00-00"){
                                print_r ("");
                            }else{
                                echo  formatardataB($BentregaRealizada);}?>" OnKeyUp="mascaraData(this);"
                            maxlength="10" autocomplete="off">

                    </td>

                </tr>

                <tr>

                    <td align=left><b>Margem:</b></td>
                    <td align=left><input type="text" size=18 name="campoMargem" id="campoMargem"
                            value="<?php echo $Bmargem?>"><b>Desconto:</b>
                        <input type="text" size=16 id="campoDesconto" name="campoDesconto"
                            value="<?php echo $Bdesconto?>">
                    </td>

                </tr>


                <tr>
                    <td align=left><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao"><?php echo $Bobservacao?></textarea>


                    </td>
                </tr>





                <table width=100%>
                    <tr>
                        <div id="botoes">

                            <input type="submit" name="btnsalvar" value="Salvar" class="btn btn-info btn-sm"></input>

                            <a href="consulta_pdcompra.php">
                                <button type="button" class="btn btn-secondary">Voltar</button>
                            </a>

                            <input id="remover" type="submit" name="btnremover" value="Remover"
                                class="btn btn-danger"></input>



                        </div>
                    </tr>

                    </talbe>



        </form>

        </talbe>




    </main>
</body>


</html>
<?php 
include '../_incluir/funcaojavascript.jar'; 
?>

<?php 
mysqli_close($conecta);
?>