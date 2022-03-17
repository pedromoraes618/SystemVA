<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");



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
 /*
    $dados_detalhe = mysqli_fetch_assoc($detalhe);
    $BpedidoID=  utf8_encode($dados_detalhe['produtoID']);
    $Bnome_produdo =  utf8_encode($dados_detalhe["nomeproduto"]);
    $Bpreco_venda = utf8_encode($dados_detalhe["precovenda"]);
    $Bpreco_compra = utf8_encode($dados_detalhe["precocompra"]);
    $Bestoque = utf8_encode($dados_detalhe["estoque"]);
    $Bunidade_medida = $dados_detalhe["unidade_medida"];
    $Bcategoria = utf8_encode($dados_detalhe["nome_categoria"]);
    $Bativo = utf8_encode($dados_detalhe["nome_ativo"]);
    $Bobservacao = utf8_encode($dados_detalhe["observacao"]);
    */

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
    <form action="cadastro_pdcompra.php" method="post">
            <div id="titulo">
                </p>Editar Pedido de Compra</p>
            </div>



            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="cammpoPedidoID" name="cammpoPedidoID"
                            value=""> </td>
                </tr>

                <tr>
                    <td align=left><b>Nº Pedido:</b></td>
                    <td align=left><input type="text" size=20 name="campoNpdCompra"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($numeroPedidoCompra);}?>"
                            td><b>Nº Orçamento:</b>
                        <input type="text" size=20 id="campoOrcamento" name="campoOrcamento" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($numeroOrcamento);}?>">

                    <td><b>Nº NFE:</b></td>
                    <td><input type="text" size=20 id="campoNnfe" name="campoNnfe"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($numeroNfe);}?>"><b>Data
                            Pagamento:</b>
                        <input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento"
                            value="<?php if(isset($_POST['enviar'])){ 
                                echo ($dataPagamento);}?>"

                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">


                </tr>

                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left><input type="text" size=57 name="campoCliente"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($cliente);}?>"><i
                            id="botaoPesquisar" class="fa-solid fa-magnifying-glass-plus"
                            onclick="abrepopupcliente();"></i></td>


                    <td><b>Forma do pagamento:</b></td>
                    <td><select id="campoFormaPagamento" name="campoFormaPagamento">
                            <?php 
                           while($linha_formapagamento = mysqli_fetch_assoc($lista_formapagamemto)){
                        ?>
                            <option value="<?php echo utf8_encode($linha_formapagamento["nome"]);?>">
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>

                            <?php

                         }
                         
                         ?>

                        </select>

                    </td>
                </tr>

                <tr>
                    <td align=left><b>Produto:</b></td>
                    <td align=left><input type="text" size=57 name="campoProduto" id="campoProduto"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($produto);}?>"><i
                            id="botaoPesquisar" class="fa-solid fa-magnifying-glass-plus"></i> </td>

                    <td>
                        <b>Status da compra:</b>
                    </td>
                    <td>

                        <select id="campoStatusCompra" name="campoStatusCompra">
                            <option value="Selecione">Selecione</option>
                            <option value="realizada">Realizada</option>
                            <option value="naoRealizada">Não realizada</option>
                            <option value="realizadaParcialmente">Realizada Parcialmente</option>
                        </select>

                        <b>Data Compra:</b>
                        <input type="text" size=20 id="campoDataCompra" name="campoDataCompra"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($dataCompra);}?>"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                    </td>


                </tr>

                <tr>
                    <td align=left><b>Unidade:</b></td>
                    <td align=left><input type="text" size=18 name="CampoUnidade" id="CampoUnidade"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($unidade);}?>"><b>Quantidade:</b>
                        <input type="text" size=19 name="CampoQuantidade" id="CampoQuantidade"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($quantidade);}?>">
                    </td>


                    <td align=left><b>Data chegada:</b></td>
                    <td align=left><input type="text" size=20 name="CampoDataChegada" id="CampoDataChegada"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($dataChegada);}?>"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off"><b>Entrega Prevista:</b>

                        <input type="text" size=20 id="CampoEntregaPrevista" name="CampoEntregaPrevista"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($entregaPrevista);}?>"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">
                    </td>


                </tr>


                <tr>
                    <td align=left><b>Preço Venda:</b></td>
                    <td align=left><input type="text" size=18 name="campoPrecoVenda" id="campoPrecoVenda"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($precoVenda);}?>"><b>Preço
                            Compra:</b>
                        <input type="text" size=16 id="campoPrecoCompra" name="campoPrecoCompra" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($precoCompra);}?>">
                    </td>


                    <td><b>Status do pedido:</b></td>
                    <td>

                        <select id="campoStatusPedido" name="campoStatusPedido">
                            <option value="Não definido">Não definido</option>
                            <option value="Entrega antes do prazo">Entrega antes do prazo</option>
                            <option value="Entrega no prazo">Entrega no prazo</option>
                            <option value="Entrega fora do prazo">Entrega fora do prazo</option>
                        </select>

                        <b>Entrega Realizada:</b>
                        <input type="text" size=20 id="CampoEntregaRealizada" name="CampoEntregaRealizada" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($entregaRealizada);}?>"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                    </td>

                </tr>

                <tr>

                    <td align=left><b>Margem:</b></td>
                    <td align=left><input type="text" size=18 name="campoMargem" id="campoMargem"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($margem);}?>"><b>Desconto:</b>
                        <input type="text" size=16 id="campoDesconto" name="campoDesconto" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($desconto);}?>">
                    </td>

                </tr>


                <tr>
                    <td align=left><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>


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