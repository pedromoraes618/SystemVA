<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include ("../_incluir/funcoes.php");

//variaveis
$campo_obrigatorio_RazacaoS ="Número do pedido não informado";
$msgcadastrado = "Pedido de compra lançado com sucesso!";



//consultar categoria do produto
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}

//consultar Situação ativo


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
    
    //formatar a data para o banco de dados(Y-m-d)
 
  if(isset($_POST['enviar']))
  {
      if($formaPagamento=="Selecione"){
        ?>

<p id="obrigatorio"><?php echo "Favor selecione a forma de pagamento";?> </p>
<?php 
      }else{
        if($statusCompra=="Selecione"){
            ?>

<p id="obrigatorio"><?php echo "Favor selecione o status da compra";?> </p>
<?php 
        }else{
                  if($numeroPedidoCompra == ""){
                      ?>

<p id="obrigatorio"><?php echo $campo_obrigatorio_RazacaoS;?> </p>
<?php 
                  }else{
            ?>
<p id="confirmacao"><?php echo $msgcadastrado; ?> </p>
<?php
            
             ?>
<?php

     
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
  $inserir .= "( data_movimento,numero_pedido_compra,numero_orcamento,numero_nf,data_pagamento,forma_pagamento,cliente,produto,status_da_compra,status_do_pedido,data_compra,data_chegada,entrega_prevista,entrega_realizada,valor_venda,valor_compra,unidade_medida,quantidade,margem,desconto,observacao)";
  $inserir .= " VALUES ";
  $inserir .= "( '$hoje','$numeroPedidoCompra','$numeroOrcamento','$numeroNfe','$dataPagamento','$formaPagamento','$cliente','$produto','$statusCompra','$statusPedido','$dataCompra','$dataChegada','$entregaPrevista','$entregaRealizada','$precoVenda','$precoCompra','$unidade','$quantidade','$margem','$desconto','$observacao')";
  

  //limpando os campos apos ser feito o insert no banco de dados
  $numeroPedidoCompra = "";
  $numeroOrcamento = "";
  $numeroNfe = "";
  $cliente ="";
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
}//if selecione forma de pagamento
}//fechamento do post('enviar')
}//fechamado do n pedido de compra



  
?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form action="cadastro_pdcompra.php" method="post">
            <div id="titulo">
                </p>Lançamento do Pedido de Compra</p>
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


                </talbe>
                <table width=100%>
                    <tr>
                        <div id="botoes">
                            <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>

                            <a href="consulta_pdcompra.php">
                                <button type="button" class="btn btn-secondary">Voltar</button>
                            </a>

                        </div>
                    </tr>

        </form>




    </main>
</body>

<?php include '../_incluir/funcaojavascript.jar'; ?>
<script>
/*
function fechar() {
    window.close();
}
*/
</script>


<script>
function abrepopupcliente() {

    var janela = "../cdcliente/consulta_cliente.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>


</html>

<?php 
mysqli_close($conecta);
?>