<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include '../_incluir/funcaojavascript.jar'; 

include ("../_incluir/funcoes.php");


if(isset($_POST['btnsalvar'])){

     //inlcuir as varias do input

 $produtoID = utf8_decode($_POST["cammpoProdutoID"]);
 $nome_produdo = utf8_decode($_POST["campoNomeProduto"]);
 $preco_venda = utf8_decode($_POST["campoPrecoVenda"]);
 $preco_compra = utf8_decode($_POST["campoPrecoCompra"]);
 $estoque = utf8_decode($_POST["campoEstoque"]);
 $unidade_medida = utf8_decode($_POST["campoUnidadedeMedida"]);
 $categoria = utf8_decode($_POST["campoCategoria"]);
 $ativo = utf8_decode($_POST["campoAtivo"]);
 $observacao = utf8_decode($_POST["campoObservacao"]);


    
    //query para alterar o cliente no banco de dados
    $alterar = "UPDATE produtos set nomeproduto = '{$nome_produdo}', precovenda = '{$preco_venda}', precocompra = '{$preco_compra}',  estoque = '{$estoque}', ";
    $alterar .= " unidade_medida = '{$unidade_medida}', categoriaID = '{$categoria}', ativoID = '{$ativo}', observacao = '{$observacao}', nome_categoria = '{$categoria}', nome_ativo = '{$ativo}' WHERE produtoID = {$produtoID} ";

      $operacao_alterar = mysqli_query($conecta, $alterar);
      if(!$operacao_alterar) {
          die("Erro na alteracao linha29");   
      } else {  ?>

<p id="confirmacao">Dados alterados</p>
<?php
          //header("location:listagem.php"); 
           
      }
    
    }

  ?>

<?php
  if(isset($_POST['btnremover'])){
  
     //inlcuir as varias do input
     include("../_incluir/variaveis_input_produto.php");

    //query para remover o produto no banco de dados
    $remover = "DELETE FROM produtos WHERE produtoID = {$produtoID}";

      $operacao_remover = mysqli_query($conecta, $remover);
    
      if(!$operacao_remover) {
          die("Erro linha 44");   
      } else {  ?>
<p id="obrigatorio">Cliente removido</p>

<?php
          //header("location:listagem.php"); 
           
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
    $Bcliente = utf8_encode($dados_detalhe["cliente"]);
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
        <form action="editar_pdcompra.php" method="post">
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
                        <input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento"
                            value="<?php echo formatardataB($BdataPagamento);?>" OnKeyUp="mascaraData(this);"
                            maxlength="10" autocomplete="off">

                </tr>

                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left><input type="text" size=57 name="campoCliente" value="<?php echo $Bcliente?>"><i
                            id="botaoPesquisar" class="fa-solid fa-magnifying-glass-plus"
                            onclick="abrepopupcliente();"></i></td>


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
                        <input type="text" size=20 id="campoDataCompra" name="campoDataCompra"
                            value="<?php echo  formatardataB($BdataCompra)?>" OnKeyUp="mascaraData(this);"
                            maxlength="10" autocomplete="off">

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
                    <td align=left><input type="text" size=20 name="CampoDataChegada" id="CampoDataChegada"
                            value="<?php echo formatardataB($BdataChegada)?>" OnKeyUp="mascaraData(this);"
                            maxlength="10" autocomplete="off"><b>Entrega Prevista:</b>

                        <input type="text" size=20 id="CampoEntregaPrevista" name="CampoEntregaPrevista"
                            value="<?php echo formatardataB($BentregaPrevista)?>" OnKeyUp="mascaraData(this);"
                            maxlength="10" autocomplete="off">
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
                        <input type="text" size=20 id="CampoEntregaRealizada" name="CampoEntregaRealizada"
                            value="<?php echo  formatardataB($BentregaRealizada)?>" OnKeyUp="mascaraData(this);"
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
mysqli_close($conecta);
?>