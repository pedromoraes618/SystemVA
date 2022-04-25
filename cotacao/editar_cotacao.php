<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");

echo ",";
//deckara as varuaveus
if((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_POST['pesquisar']))){
    $hoje = date('Y-m-d'); 
    $codCotacao = utf8_decode($_POST["codigoCotacao"]);
    $compradorID = utf8_decode($_POST["campoComprador"]);   
    $freteID = utf8_decode($_POST["campoFrete"]);   
    $statusProposta = utf8_decode($_POST["campoStatusProposta"]);  
    $nomeProduto = utf8_decode($_POST["campoNomeProduto"]);
    $numeroSolicitacao = utf8_decode($_POST["campoNsolitacao"]);
    $numeroOrcamento = utf8_decode($_POST["campoNorcamento"]);
    $formaPagamento = utf8_decode($_POST["campoFormaPagamento"]); 
    $dataRecebida = utf8_decode($_POST["campoDataRecebida"]);
    $validade = utf8_decode($_POST["campoValidade"]);
    $dataEnvio = utf8_decode($_POST["campoDataEnvio"]);
    $dataResponder = utf8_decode($_POST["campoDataResponder"]);
    $dataFechamento= utf8_decode($_POST["campoDaFechamento"]);
    $diasNegociacao = utf8_decode($_POST["campoDiasNegociacao"]);
    $statusProposta = utf8_decode($_POST["campoStatusProposta"]);
    $prazoEntrega = utf8_decode($_POST["campoPrazoEntrega"]);
    $clienteID = utf8_decode($_POST["campoCliente"]);
    $statusProduto = utf8_decode($_POST['campoStatusProduto']);
    $comprador = utf8_decode($_POST["campoComprador"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda= utf8_decode($_POST["campoPrecoVenda"]);
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $desconto = utf8_decode($_POST["campoDesconto"]);
    $valorTotal = utf8_decode($_POST["campoValorTotalHidden"]);
    $valorTotalComDesconto = utf8_decode($_POST["campoValorTotal"]);

    
   

    
}


//




//inserir o produto com a condição
if(isset($_POST['adicionar']))
{
        if($nomeProduto==""){
            ?>
<script>
alertify.alert("Favor informe a descrição do produto");
</script>
<?php 
        
        }elseif($precoVenda==""){
            ?>
<script>
alertify.alert("Preço de venda do produto não foi informado");
</script>
<?php 
        }elseif($precoCompra==""){
            ?>
<script>
alertify.alert("Preço cotado não foi informado");
</script>
<?php 
        }elseif($qtdProduto==""){
            ?>
<script>
alertify.alert("Quantidade do produto não foi informado");
</script>
<?php 
        }elseif($unidade==""){
            ?>
<script>
alertify.alert("Unidade do produto não foi informado");
</script>
<?php 
        }else{

//inserir o produto
$inserir = "INSERT INTO produto_cotacao ";
  $inserir .= "(cotacaoID, descricao,quantidade,preco_compra,preco_venda,margem,unidade,status )";
  $inserir .= " VALUES ";
  $inserir .= "('$codCotacao','$nomeProduto','$qtdProduto','$precoCompra', '$precoVenda', '$margem','$unidade','$statusProduto' )";
  $operacao_inserir = mysqli_query($conecta, $inserir);

    $nomeProduto = "";
    $qtdProduto = "";
    $precoCompra = "";
    $precoVenda = "";
    $margem = "";
    $unidade = "";

  if(!$operacao_inserir){
      die("Falaha no banco de dados || pesquisar produto cotacao");
        }

    }
}







//condicao podera salvar a cotação com a condição variavel salvar está com o valor 1

if(isset($_POST['salvar'])){

if($clienteID != "1"){
if($dataRecebida==""){

}else{
$div1 = explode("/",$_POST['campoDataRecebida']);
$dataRecebida = $div1[2]."-".$div1[1]."-".$div1[0];

}
if($dataEnvio ==""){

}else{
$div2 = explode("/",$_POST['campoDataEnvio']);
$dataEnvio = $div2[2]."-".$div2[1]."-".$div2[0];
}


if($dataResponder ==""){

}else{

$div3 = explode("/",$_POST['campoDataResponder']);
$dataResponder = $div3[2]."-".$div3[1]."-".$div3[0];
}


if($dataFechamento==""){

}else{

$div4 = explode("/",$_POST['campoDaFechamento']);
$dataFechamento = $div4[2]."-".$div4[1]."-".$div4[0];
}


$alterar = "UPDATE cotacao set clienteID = '{$clienteID}', compradorID = '{$comprador}',freteID = '{$freteID}', status_proposta = '{$statusProposta}', forma_pagamentoID = '{$formaPagamento}',data_recebida = '{$dataRecebida}',data_envio='{$dataEnvio}',data_responder='{$dataResponder}',data_fechamento = '{$dataFechamento}',dias_negociacao='{$diasNegociacao}',prazo_entrega ='{$prazoEntrega}',numero_solicitacao='{$numeroSolicitacao}',numero_orcamento='{$numeroOrcamento}',validade='{$validade}',valorTotalComDesconto='{$valorTotalComDesconto }',valorTotal='{$valorTotal}',desconto='{$desconto}' where cod_cotacao = '{$codCotacao}' ";
$operacao_inserir = mysqli_query($conecta, $alterar);

if(!$operacao_inserir){
die("Erro no banco de dados inserir cotacao");
}
?>

<script>
alertify.success("Dados alterados com sucesso");
</script>

<?php
        }else{      ?>

<script>
alertify.alert("É necessario informar o cliente");
</script>

<?php }
            
      }

//consultar dados da cotacao
$consulta = "SELECT * from cotacao ";
if(isset($_GET["codigo"])){
    $cotacaoID =  $_GET["codigo"];
    $codCotacao =  $_GET["cotacaoCod"];
$consulta .= " WHERE cotacaoID = {$cotacaoID}";  
}
$dados_cotacao= mysqli_query($conecta, $consulta);
if(!$dados_cotacao){
die("Falaha no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($dados_cotacao);
    $clienteIDB = $linha['clienteID'];
    $dataLancamentoB = $linha['data_lancamento'];
    $statusPropostaB = $linha['status_proposta'];
    $formaPagamentoIDB = $linha['forma_pagamentoID'];
    $dataRecebidaB = $linha['data_recebida'];
    $dataEnvioB = $linha['data_envio'];
    $dataResponderB = $linha['data_responder'];
    $dataFechamentoB= $linha['data_fechamento'];
    $diasNegociacaoB = $linha['dias_negociacao'];
    $prazoEntregaB = $linha['prazo_entrega'];
    $numeroSolicitacaoB = $linha['numero_solicitacao'];
    $numeroOrcamentoB = $linha['numero_orcamento'];
    $codCotacaoB = $linha['cod_cotacao'];
    $validadeB = $linha['validade'];
    $freteB = $linha['freteID'];
    $compradorB = $linha['compradorID'];
    $descontoB = $linha['desconto'];
    $valorCotacaoB = $linha['valorTotal'];
    $valorComDescontoB = $linha['valorTotalComDesconto'];
    

}

//consultar os produto da cotação, codição de clicar no botao adicionar
if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa'])) or (isset($_GET['cotacaoCod']))) {

    $selectProdutoCotacao =  " SELECT * from produto_cotacao where cotacaoID = '$codCotacao'";
    $lista_Produto_cotacao= mysqli_query($conecta, $selectProdutoCotacao);
    if(!$lista_Produto_cotacao){
    die("Falaha no banco de dados || pesquisar produto cotacao");
    }
    }
    

//consultar cliente
$select = "SELECT clienteID, razaosocial from clientes";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}

//consultar o comprador
$select = "SELECT * from comprador";
$lista_comprador = mysqli_query($conecta,$select);
if(!$lista_comprador){
    die("Falaha no banco de dados || select comprador");
}

//consultar o frete
$select = "SELECT * from frete";
$lista_frete= mysqli_query($conecta,$select);
if(!$lista_frete){
    die("Falaha no banco de dados || select frete");
}

//consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}

$select = "SELECT * FROM situacao_proposta ";
$lista_situacao_proposta = mysqli_query($conecta,$select);
if(!$lista_situacao_proposta){
    die("Falaha no banco de dados");
}

//consultar o status do produto
$select = "SELECT * FROM status_produto_cotacao ";
$lista_status_produto_cotacao = mysqli_query($conecta,$select);
if(!$lista_status_produto_cotacao){
    die("Falaha no banco de dados");
}


if(isset($_POST['pesquisar'])) {
    $selectProdutos = "SELECT * from produtos WHERE nomeproduto LIKE '%{$nomeProduto}%' ";
    $lista_Produtos= mysqli_query($conecta, $selectProdutos);
    if(!$lista_Produtos){
    die("Falaha no banco de dados || pesquisar produto cotacao".$selectProdutos);
}
}

//soma dos produos
if((isset($_POST['adicionar'])) or (isset($_POST['fecharPesquisa']))or (isset($_POST['salvar'])) or (isset($_POST['pesquisar'])) or (!isset($_POST['inicar']))) {
    $selectProdutoCotacaoTotal =  " SELECT sum(preco_venda*quantidade) as soma from produto_cotacao where cotacaoID = '$codCotacao'";
    $lista_Produto_cotacao_total= mysqli_query($conecta, $selectProdutoCotacaoTotal);
    if(!$lista_Produto_cotacao_total){
    die("Falaha no banco de dados || pesquisar produto cotacao");
    }else{$linha_soma = mysqli_fetch_assoc($lista_Produto_cotacao_total);
        $somaTotal = $linha_soma['soma'];
    
    }
}


?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
</head>

<body>


    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>




        <div style="margin:0 auto; width:1500px; ">


            <table style="float: right; margin-right:100px;">
                <div id="titulo">
                    </p>Dados Cotação</p>
                </div>

                <tr>

                    <form action="" method="post">

                        <td align=left> <input type="submit" id="salvar" onclick="calculavalordesconto()" name="salvar"
                                class="btn btn-success" value="Salvar">
                        </td>
                        <td align=left> <button type="button" name="btnfechar" onclick="fechar();"
                                class="btn btn-secondary">Voltar</button>
                        </td>



                </tr>

            </table>


            <table style="float:left;">



                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" name="codigoCotacao" value="<?php echo $codCotacaoB;
        
         ?>"> </td>




                </tr>
                <!--finalizar hidden -->
                <tr>

                    <td align=left> <b>Nº solicitação:</b></td>
                    <td align=left> <input type="text" name="campoNsolitacao" size="10" value="<?php  echo $numeroSolicitacaoB;
    ?>"> </td>

                    <td align=left> <b>Nº orçamento:</b></td>
                    <td align=left> <input type="text" name="campoNorcamento" size="10" autocomplete="of"
                            value="<?php echo $numeroOrcamentoB?>"> </td>

                    <td align=left> <b>Forma do pagamento:</b></td>
                    <td align=left><select style="width: 170px; margin-right:10px;" id="campoFormaPagamento"
                            name="campoFormaPagamento">
                            <?php 

                            $meuFormaPagamento = $formaPagamentoIDB;
            while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
    

                if($meuFormaPagamento==$formaPagamentoPrincipal){
                ?> <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>" selected>
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>

                            <?php
                         }else{
                
               ?>
                            <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>
                            <?php

}

}

             


         ?>

                        </select>
                    </td>
                    <td align=left><b>Data envio:</b></td>
                    <td align=left><input type="text" name="campoDataEnvio" OnKeyUp="mascaraData(this);" size="10"
                            value="<?php   if($dataEnvioB=="1970-01-01"){
                                print_r("");
                            }elseif($dataEnvioB=="0000-00-00"){
                                print_r ("");
                            }
                            elseif($dataEnvioB==""){
                                print_r ("");
                            }else{
                                echo formatardataB($dataEnvioB);}?>" autocomplete="off"></td>

                    <td> <b>Validade:<b>
                    <td><input type="text" name="campoValidade" size="10" value="<?php 
                        echo $validadeB;
   
?>"> </td>
                </tr>

            </table>


            <table style="float:left; margin-top:5px; ">
                <tr>

                    <td><b>Data recebida:</b></td>
                    <td align="left"> <input type="text" name="campoDataRecebida" OnKeyUp="mascaraData(this);" size="10"
                            autocomplete="of" onchange="" value="<?php  
                            
                            if($dataRecebidaB=="1970-01-01"){
                                print_r("");
                            }elseif($dataRecebidaB=="0000-00-00"){
                                print_r ("");
                            }
                            elseif($dataRecebidaB==""){
                                print_r ("");
                            }else{
                                echo formatardataB($dataRecebidaB);}?>" autocomplete="off">


                    </td>


                    <td> <b>Data a responder:<b>
                    <td> <input type="text" name="campoDataResponder" OnKeyUp="mascaraData(this);" size="10" onchange=""
                            value="<?php if($dataResponderB=="1970-01-01"){
                                print_r("");
                            }elseif($dataResponderB=="0000-00-00"){
                                print_r ("");
                            }
                            elseif($dataResponderB==""){
                                print_r ("");
                            }else{
                                echo formatardataB($dataResponderB);}?>" autocomplete="off"></td>

                    <td align=left><b>Data fechamento:</b></td>
                    <td align=left><input type="text" name="campoDaFechamento" OnKeyUp="mascaraData(this);" size="10"
                            value="<?php  if($dataFechamentoB=="1970-01-01"){
                                print_r("");
                            }elseif($dataFechamentoB=="0000-00-00"){
                                print_r ("");
                            }
                            elseif($dataFechamentoB==""){
                                print_r ("");
                            }else{
                                echo formatardataB($dataFechamentoB);}?>" autocomplete="off"></td>

                    <td align=left><b>Dias em negociação:</b></td>
                    <td align=left><input type="text" name="campoDiasNegociacao" autocomplete="of" size="10"
                            value="<?php  echo $diasNegociacaoB;?>"></td>

                </tr>





            </table>
            <table style="float:left; width:1400px; margin-bottom: 5px;" id="divisaoTabela">
                <td>
                    <div id="divDivisao">
                    </div>
                </td>

            </table>
            <table style="float:left;  ">

                <tr>
                    <div>


                        <td><b>Proposta:</b></td>
                        <td><select style="width:170px; margin-right:20px; " name="campoStatusProposta"
                                id="campoStatusProposta">

                                <?php  
                                $meuProposta = $statusPropostaB;
                                while($linha_status_proposta= mysqli_fetch_assoc($lista_situacao_proposta)){
                                $statusProposta_principal= utf8_encode($linha_status_proposta["statusID"]);

                                if($meuProposta==$statusProposta_principal){
                                ?> <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>"
                                    selected>
                                    <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                                </option>

                                <?php
                                }else{

?>
                                <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>">
                                    <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                                </option>
                                <?php

}

}

?>
                            </select>
                        </td>



                        <td align=left><b>Frete:</b></td>
                        <td><select style="width: 250px; margin-right:30px; " name="campoFrete" id="campoFrete">

                                <?php  
                                $meuFrete = $freteB;
                                while($linha_frete = mysqli_fetch_assoc($lista_frete)){
                                $frete_principal= utf8_encode($linha_frete["freteID"]);

                                if($meuFrete==$frete_principal){
                                ?> <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>" selected>
                                    <?php echo utf8_encode($linha_frete["descricao"]);?>
                                </option>

                                <?php
                                }else{

                                ?>
                                <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>">
                                    <?php echo utf8_encode($linha_frete["descricao"]);?>
                                </option>
                                <?php

                                }

                                }
?>
                            </select>
                        </td>




                        <td align=left> <input type="hidden" name="campoPrazoEntrega" autocomplete="of" size="10"
                                value="<?php echo $prazoEntregaB;?>"></td>
                        <td>

                        </td>



                    </div>
                </tr>


            </table>




            <table style="float:left; margin-top:5px; ">
                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left> <select style="margin-right: 50px;" name="campoCliente" id="campoCliente">

                            <?php  
                            $meuCliente = $clienteIDB;
                                                while($linha_cliente = mysqli_fetch_assoc($lista_clientes)){
                            $cliente_Principal = utf8_encode($linha_cliente["clienteID"]);
                    

                            if($clienteIDB==$cliente_Principal){
                            ?> <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>" selected>
                                <?php echo utf8_encode($linha_cliente["razaosocial"]);?>
                            </option>

                            <?php
                             }else{
        
                             ?>
                            <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>">
                                <?php echo utf8_encode($linha_cliente["razaosocial"]);?>
                            </option>
                            <?php

                            }
                            }

?> </td>


                    <td align=left><b>Comprador:</b></td>
                    <td align=left><select style="width: 200px;" name="campoComprador" id="campoComprador">

                            <?php 
                            $meuComprador = $compradorB;
                            while($linha_comprador = mysqli_fetch_assoc($lista_comprador)){
                              $comprador_Principal = utf8_encode($linha_comprador["id_comprador"]);
          
                            if($meuComprador==$comprador_Principal){
                            ?> <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>" selected>
                                <?php echo utf8_encode($linha_comprador["comprador"]);?>
                            </option>

                            <?php
                            }else{

                            ?>
                            <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>">
                                <?php echo utf8_encode($linha_comprador["comprador"]);?>
                            </option>
                            <?php

                            }

                            }



?>
                        </select>
                    </td>


                </tr>

            </table>







            <table style="float:left; width:1400px; margin-top:5px;" id="divisaoTabela">
                <td>
                    <div id="divDivisao">
                    </div>
                </td>

            </table>

            <table style="float:left; ">
                <tr>
                    <td align=left><b>Produto:</b></td>
                    <td align=left><input style="margin-right:5px;" type="text" size=60 name="campoNomeProduto"
                            value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($nomeProduto);}?>">
                    </td>
                    <td><button style="border:0px;  background-color:white;" id="buttonPesquisa" name="pesquisar"><i
                                class="fa-solid fa-magnifying-glass"></i></button></td>
                    <td>


                        <form action="" method="post">
                    <td align=left><input type="submit" onclick="calculavalordesconto()" name="adicionar"
                            class="btn btn-success" value="Adicionar">
                    </td>


                </tr>
            </table>
            <table style="float:left;   ">

                <tr>
                    <div>
                        <td align=left><b>Und:</b></td>
                        <td align=left><input type="text" size=10 name="campoUnidade" id="campoUnidade"
                                autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($unidade);}?>">
                        </td>
                        <td align=left><b>Quantidade:</b></td>
                        <td align=left><input type="text" size=10 name="campoQtdProduto" id="campoQtdProduto"
                                onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($qtdProduto);}?>">
                        </td>
                        <td align=left><b>Preço cotado:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoCotado" id="campoPrecoCotado"
                                onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoCompra);}?>">
                        </td>
                        <td align=left><b>Margem:</b></td>
                        <td align=left><input type="text" size=10 name="campoMargem" id="campoMargem"
                                onblur="calculavalorPrecoVenda()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($margem);}?>">
                        </td>
                        <td align=left><b>Preço venda:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoVenda" id="campoPrecoVenda"
                                onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoVenda);}?>">
                        </td>

                        <td align=left> <b>Status:</b></td>
                        <td align=left><select style="width: 170px; margin-right:10px;" id="campoStatusProduto"
                                name="campoStatusProduto">
                                <?php 
            while($linha_status_produto  = mysqli_fetch_assoc($lista_status_produto_cotacao)){
                $statusProdutoPrincipal= utf8_encode($linha_status_produto["status_produtoID"]);
               if(!isset($statusProduto)){
               
               ?>
                                <option value="<?php echo utf8_encode($linha_status_produto["status_produtoID"]);?>">
                                    <?php echo utf8_encode($linha_status_produto["descricao"]);?>
                                </option>
                                <?php
               
               }else{

                if($statusProduto==$statusProdutoPrincipal){
                ?> <option value="<?php echo utf8_encode($linha_status_produto["status_produtoID"]);?>" selected>
                                    <?php echo utf8_encode($linha_status_produto["descricao"]);?>
                                </option>

                                <?php
                         }else{
                
               ?>
                                <option value="<?php echo utf8_encode($linha_status_produto["status_produtoID"]);?>">
                                    <?php echo utf8_encode($linha_status_produto["descricao"]);?>
                                </option>
                                <?php

}

}

             
}

         ?>

                            </select>
                        </td>



                    </div>
                </tr>


                <table style="float:left; width:1400px; margin-top:5px;" id="divisaoTabela">
                    <td>
                        <div id="divDivisao">
                        </div>
                    </td>

                </table>

                <table style="float:left;  width:700px; margin-bottom: 20px;">
                    <tr>

                        <td align=left><input type="submit" onclick="calculavalordesconto()" name="fecharPesquisa"
                                class="btn btn-danger" value="Atualizar">
                        </td>

                        <td align=right><b>Desconto:</b></td>
                        <td align=right><input type="text" size=10 name="campoDesconto" id="campoDesconto"
                                onblur="calculavalordesconto()" autocomplete="off" value="<?php
                            if ((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or (isset($_POST['fecharPesquisa']))or (isset($_POST['pesquisar']))){
                                echo $desconto;}else{
                                    echo $descontoB;
                                }
                           

                            ?>"></td>
                        <td align=right><b>Valor Total:</b></td>
                        <td align=right><input readonly type="text" size=10 name="campoValorTotal" id="campoValorTotal"
                                autocomplete="off" value="<?php 
            
                            if ((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or (isset($_POST['fecharPesquisa']))or (isset($_POST['pesquisar']))){
                                echo $valorTotalComDesconto;
                                }else{
                                    echo $valorComDescontoB;
                                }
                         
                       ?>"></td>

                        </td>

                        <td align=right><input type="hidden" size=10 name="campoValorTotalHidden"
                                id="campoValorTotalHidden" autocomplete="off" value="<?php 
                           if((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or (!isset($_POST['iniciar']))or (isset($_POST['fecharPesquisa']))or (isset($_POST['pesquisar']))){
                                echo ($somaTotal);}
                       ?>"></td>
                    </tr>
                </table>

        </div>

        </form>




        <form action="consulta_produto.php" method="post">

            <table border="0" cellspacing="0" width="1500px;" class="tabela_pesquisa">
                <?php if((isset($_POST['adicionar']))  or (isset($_POST['fecharPesquisa'])) or (!isset($_POST['codigoCotacao'])) or (isset($_POST['salvar'])))  {?>
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p style="margin-left:10px;">Item</p>
                        </td>

                        <td>
                            <p>Descrição</p>
                        </td>
                        <td>
                            <p>Und</p>
                        </td>
                        <td>
                            <p>Qtd</p>
                        </td>
                        <td>
                            <p>P cotado</p>
                        </td>
                        <td>
                            <p>P Venda</p>
                        </td>
                        <td>
                            <p>P.C total</p>
                        </td>
                        <td>
                            <p>P.V total</p>
                        </td>
                        <td>
                            <p>Margem%</p>
                        </td>
                        <td>
                            <p>Situação</p>
                        </td>


                        <td>
                            <p></p>
                        </td>

                    </tr>

                    <?php




$linhas = 0;
while($linha = mysqli_fetch_assoc($lista_Produto_cotacao)){
    $cotacaoID = $linha['cotacaoID'];
    $descricao = $linha['descricao'];
    $quantidade = $linha['quantidade'];
    $precoCompra = $linha['preco_compra'];
    $precoVenda = $linha['preco_venda'];
    $margem = $linha['margem'];
    $unidade = $linha['unidade'];
    $status = $linha['status'];

   
?>
                    <tr id="linha_pesquisa">

                        <td style="width: 70px; ">
                            <p style="margin-left: 15px; margin-top:10px;">
                                <font size="3"><?php echo $linhas = $linhas +1;?></font>
                            </p>
                        </td>

                        <td style="width: 550px;">

                            <font size="2"><?php echo utf8_encode($descricao);?> </font>

                        </td>

                        <td style="width: 60px;">

                            <font size="2"><?php echo utf8_encode($unidade);?> </font>

                        </td>

                        <td style="width: 70px;">
                            <font size="2"><?php echo $quantidade;?> </font>
                        </td>

                        <td style="width: 100px;">
                            <font size="2"><?php echo real_format($precoCompra);?> </font>
                        </td>

                        <td style="width: 100px;">
                            <font size="2"><?php echo real_format($precoVenda);?> </font>
                        </td>


                        <td style="width: 120px;">
                            <font size="2"><?php echo real_format($quantidade*$precoCompra)?> </font>
                        </td>

                        <td style="width: 120px;">
                            <font size="2"><?php echo real_format($quantidade*$precoVenda)?> </font>
                        </td>
                        <td style="width: 80px;">
                            <font size="2"><?php echo  real_percent($margem*100);?> </font>
                        </td>
                        <td style="width: 80px; text-align:center">
                            <font size="2"><?php if($status==1){
                                ?><i class="fa-solid fa-face-meh" title="Aberto"></i><?php
                            }elseif($status==2){
                                ?><i class="fa-solid fa-handshake" title="Ganho"></i><?php
                            }elseif($status==3){
                                ?> <i class="fa-solid fa-calendar-xmark" title="Perdido"></i> <?php
                            }
                            
                            ?> </font>

                        </td>


                        <td id="botaoEditar">


                            <a
                                onclick="window.open('editar_produto_cotacao.php?codigo=<?php echo $linha['produto_cotacao'];?>', 
'editar_produto_cotacao', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=500');">

                                <button type="button" class="btn btn-warning" name="editar">Editar</button>
                            </a>

                        </td>


                    </tr>



                    <?php
}?>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <font size=2>
                                <p style="margin-left:10px;">total</p>
                            </font>
                        </td>

                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                            <font size=2><?php echo  real_format($somaTotal);?></font>
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>


                        <td>
                            <p></p>
                        </td>

                    </tr>

                    <?php


}elseif(isset($_POST['pesquisar'])){
    ?>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p style="margin-left: 10px;;">Cód</p>
                        </td>

                        <td>
                            <p>Descrição</p>
                        </td>
                        <td>
                            <p>Und</p>
                        </td>
                        <td>
                            <p>Estoque</p>
                        </td>
                        <td>
                            <p>P. compra</p>
                        </td>
                        <td>
                            <p>P. Venda</p>
                        </td>
                        <td>

                        </td>




                        <td>
                            <p></p>
                        </td>

                    </tr>
                    <?php

    while($linha = mysqli_fetch_assoc($lista_Produtos)){
        $produtoID = $linha['produtoID'];
        $descricao = $linha['nomeproduto'];
        $estoque = $linha['estoque'];
        $precoCompra = $linha['precocompra'];
        $precoVenda = $linha['precovenda'];
        $unidade = $linha['unidade_medida'];
    
    ?>
                    <tr id="linha_pesquisa">

                        <td style="width: 70px;">
                            <p style="margin-left: 15px; margin-top:10px;">
                                <font size="3"><?php echo $produtoID;?></font>
                            </p>
                        </td>

                        <td style="width: 650px;">

                            <font size="2"><?php echo $descricao;?> </font>

                        </td>

                        <td style="width: 100px;">
                            <font size="2"><?php echo $unidade;?> </font>
                        </td>

                        <td style="width: 100px; ">
                            <font size="2"><?php echo $estoque;?> </font>
                        </td>

                        <td style="width: 130px;">
                            <font size="2"><?php echo real_format($precoCompra);?> </font>
                        </td>

                        <td style="width: 130px;">
                            <font size="2"><?php echo real_format($precoVenda);?> </font>
                        </td>


                        <td id="botaoEditar">

                            <a
                                onclick="window.open('selecionar_produto_cotacao.php?codigo=<?php echo $linha['produtoID'];?>&cotacaoCod=<?php echo $_POST['codigoCotacao'];?>&unidade=<?php echo $linha['unidade_medida'];?>&nomProduto=<?php echo $linha['nomeproduto'];?>&precoCompra=<?php echo $linha['precocompra'];?>&precoVenda=<?php echo $linha['precovenda'];?>', 'popuppageSelecionarProduto',
                                                    'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=500');">

                                <button type="button" class="btn btn-warning" name="editar">Selecione</button>

                            </a>


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
function fechar() {
    window.close();
}
</script>

<script>
//abrir uma nova tela de cadastro
function abrepopupCadastroProduto() {

    var janela = "cadastro_produto.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupEditarProduto() {

    var janela = "editar_produto.php?codigo=<?php echo $idProduto ?>";
    window.open(janela, 'popuppageEditarProduto',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

<script>
function calculavalormargem() {
    var campoQuantidade = document.getElementById("campoQtdProduto").value;
    var campoPrecoCotado = document.getElementById("campoPrecoCotado").value;
    var campoPrecoVenda = document.getElementById("campoPrecoVenda").value;
    var campoMargem = document.getElementById("campoMargem");
    var calculoMargem;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCotado = parseFloat(campoPrecoCotado);

    calculoMargem = (campoPrecoCotado / campoPrecoVenda).toFixed(2);
    campoMargem.value = calculoMargem;


}
</script>
<script>
function calculavalordesconto() {
    var campoDesconto = document.getElementById("campoDesconto").value;
    var campoValorTotalH = document.getElementById("campoValorTotalHidden").value;
    var campoValorTotal = document.getElementById("campoValorTotal");
    var calculoDesconto;
    var calculoTotalCDesconto;


    campoValorTotalH = parseFloat(campoValorTotalH);
    campoDesconto = parseFloat(campoDesconto);


    calculoDesconto = ((campoValorTotalH * campoDesconto) / 100)
    calculoTotalCDesconto = (campoValorTotalH - calculoDesconto).toFixed(2);
    campoValorTotal.value = calculoTotalCDesconto;


}
</script>
<script>
function calculavalorPrecoVenda() {
    var campoPrecoCotado = document.getElementById("campoPrecoCotado").value;
    var campoMargem = document.getElementById("campoMargem").value;
    var campoPrecoVenda = document.getElementById("campoPrecoVenda");
    var calculoPrecoVenda;

    campoMargem = parseFloat(campoMargem);
    campoPrecoCotado = parseFloat(campoPrecoCotado);

    calculoPrecoVenda = (campoPrecoCotado / campoMargem).toFixed(2);
    campoPrecoVenda.value = calculoPrecoVenda;

}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>