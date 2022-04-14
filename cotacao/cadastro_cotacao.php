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
if((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or  (isset($_POST['cotacaofinalizada']))){
    
    $codCotacao = utf8_decode($_POST["codigoCotacao"]);
    $descricao = utf8_decode($_POST["campoNomeProduto"]);
    $clienteID = utf8_decode($_POST["campoCliente"]);
    $salvar = utf8_decode($_POST["tueSalvar"]);
    $cotacaofinalizada = utf8_decode($_POST["cotacaofinalizada"]);
    $compradorID = utf8_decode($_POST["campoComprador"]);   
    $freteID = utf8_decode($_POST["campoFrete"]);  
    $formaPagamento = utf8_decode($_POST["campoFormaPagamento"]);  
    $statusProposta = utf8_decode($_POST["campoStatusProposta"]);  
    
}


//consultar ultimo id da cotacao
$selectCotacao = "SELECT MAX(CotacaoID) as maximo FROM cotacao";
$lista_cotacao= mysqli_query($conecta, $selectCotacao);
if(!$lista_cotacao){
die("Falaha no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($lista_cotacao);
    $id_cotacao = $linha['maximo'];}


//inicar a cotacao novamente    
if(isset($_POST['iniciar'])){
$selectCotacao = "SELECT MAX(CotacaoID) as maximo FROM cotacao";
$lista_cotacao= mysqli_query($conecta, $selectCotacao);
if(!$lista_cotacao){
die("Falaha no banco de dados");
}else{
    $linha = mysqli_fetch_assoc($lista_cotacao);
    $id_cotacao = $linha['maximo'];
}
}


//inserir o produto com a condição
if(isset($_POST['adicionar']))
{
    if($cotacaofinalizada==0 && $cotacaofinalizada  != ""){

//inserir o produto
$inserir = "INSERT INTO produto_cotacao ";
  $inserir .= "(cotacaoID, descricao )";
  $inserir .= " VALUES ";
  $inserir .= "('$codCotacao','$descricao' )";
  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
      die("Falaha no banco de dados || pesquisar produto cotacao");
        }
     }else{
        ?>
<script>
alertify.alert("É necessario inciar a cotação !! Favor clique em iniciar cotação");
</script>
<?php 
     }
}

//consultar os produto da cotação, codição de clicar no botao adicionar
if(isset($_POST['adicionar'])){
    if($cotacaofinalizada==0 && $cotacaofinalizada  != ""){
$selectProdutoCotacao = "SELECT * from produto_cotacao where cotacaoID = '$codCotacao'";
$lista_Produto_otacao= mysqli_query($conecta, $selectProdutoCotacao);
if(!$lista_Produto_otacao){
die("Falaha no banco de dados || pesquisar produto cotacao".$select);
}
}
}

//condicao podera salvar a cotação com a condição variavel salvar está com o valor 1
if(isset($_POST['salvar'])){
    if($salvar == 1 && $cotacaofinalizada == 0){
        $inserir = "INSERT INTO cotacao ";
        $inserir .= "( clienteID )";
        $inserir .= " VALUES ";
        $inserir .= "('$clienteID' )";
        $operacao_inserir = mysqli_query($conecta, $inserir);
        ?>

<script>
alertify.success("Cotação finalizada com sucesso");
</script>

<?php
        if(!$operacao_inserir){
            die("Erro no banco de dados inserir cotacao");
        }
      
      }else{
          ?>
<script>
alertify.alert("É necessario inciar a cotação !! Favor clique em iniciar cotação");
</script>
<?php
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




?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>


    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>




    <div style="margin:0 auto; width:1500px; ">

        <table style="float: right; margin-right:100px;">
            <div id="titulo">
                </p>Cotação</p>
            </div>


            <tr>

                <form action="" method="post">

                    <td align=left> <input style="width:120px" type="submit" name="iniciar" class="btn btn-info btn-sm"
                            value="Inicar Cotacão">
                    </td>
                    <td align=left> <input type="submit" id="" name="salvar" class="btn btn-success" value="Finalizar">
                    </td>
                    <td align=left> <button type="button" name="btnfechar" onclick="fechar();"
                            class="btn btn-secondary">Voltar</button>

                    </td>

            </tr>

        </table>

      
            <table style="float:left;">



                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" name="codigoCotacao" value="<?php 
         if(isset($_POST)){
                echo $id_cotacao + 1 ;
         }
         ?>"> </td>


                    <td align=left><input readonly type="hidden" size="10" name="cotacaofinalizada"
                            placeholder="finalizado" value="<?php 
            //1 Para não poder incluir item e 0 para incluir iten
         
            if(isset($_POST['salvar'])){
                echo 1;
            }elseif(isset($_POST['iniciar'])){
                echo 0;
            }
            if(isset($_POST['adicionar'])){
                echo $_POST['cotacaofinalizada'];
            }

         
         ?>"> </td>
                    <td align=left><input readonly type="hidden" size="10" name="tueSalvar" value="<?php
            if(isset($_POST['adicionar']))
            {
                if($salvar == ""){
                    echo 1;
                }else{
                    echo 1;
                }
            }
            
            ?>"> </td>



                </tr>
                <!--finalizar hidden -->
                <tr>

                    <td align=left> <b>Nº solicitação:</b></td>
                    <td align=left> <input type="text" name="campoNsolitacao" size="10" value="<?php if(isset($_POST['adicionar'])){
     
    }?>"> </td>

                    <td align=left> <b>Nº orçamento:</b></td>
                    <td align=left> <input type="text" name="campoNorcamento" size="10" value="<?php if(isset($_POST['adicionar'])){
     
    }?>"> </td>

                    <td align=left> <b>Forma do pagamento:</b></td>
                    <td align=left><select style="width: 150px; margin-right:10px;" id="campoFormaPagamento"
                            name="campoFormaPagamento">
                            <?php 
            while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
               if(!isset($formaPagamento)){
               
               ?>
                            <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                            </option>
                            <?php
               
               }else{

                if($formaPagamento==$formaPagamentoPrincipal){
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

             
}

         ?>

                        </select>
                    </td>
                    <td><b>Data recebida:</b></td>
                    <td align="left"> <input type="text" name="campoDataRecebida" OnKeyUp="mascaraData(this);" size="10"
                            onchange="" value="<?php if(isset($_POST['adicionar'])){

    }?>"></td>
                    <td> <b>Validade:<b>
                    <td><input type="text" name="campoDataRecebida" size="10" value="<?php if(isset($_POST['adicionar'])){
   
    }?>"> </td>
                </tr>

            </table>


            <table  style="float:left; margin-top:5px; ">
                <tr>
                    <td align=left><b>Data envio:</b></td>
                    <td align=left><input type="text" name="campoDataEnvio" OnKeyUp="mascaraData(this);" size="10"
                            value="<?php if(isset($_POST['adicionar'])){
     
    }?>"></td>


                    <td> <b>Data a responder:<b>
                    <td> <input type="text" name="campoDataRecebida" OnKeyUp="mascaraData(this);" size="10" onchange=""
                            value="<?php if(isset($_POST['adicionar'])){
            
    }?>"></td>
                    <td align=left><b>Data fechamento:</b></td>
                    <td align=left><input type="text" name="campoDaFechamento" OnKeyUp="mascaraData(this);" size="10"
                            value="<?php if(isset($_POST['adicionar'])){
      
                     }?>"></td>

                    <td align=left><b>Dias em negociação:</b></td>
                    <td align=left><input type="text" name="campoDiasNegociacao" OnKeyUp="mascaraData(this);" size="10"
                            value="<?php if(isset($_POST['adicionar'])){
      
    }?>"></td>
                   
                </tr>





            </table>
            <table style="float:left; width:1400px;" id="divisaoTabela">
                <td>
                    <div id="divDivisao">
                    </div>
                </td>

            </table>
            <table style="float:left; ">

                <tr>
                    <div>


                        <td><b>Status Proposta:</b></td>
                        <td><select style="width:170px; margin-right:20px; " name="campoStatusProposta"
                                id="campoStatusProposta">

                                <?php  while($linha_status_proposta= mysqli_fetch_assoc($lista_situacao_proposta)){
$statusProposta_principal= utf8_encode($linha_status_proposta["statusID"]);
if(!isset($statusProposta)){

?>
                                <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>">
                                    <?php echo utf8_encode($linha_status_proposta["descricao"]);?>
                                </option>
                                <?php

}else{

if($statusProposta==$statusProposta_principal){
?> <option value="<?php echo utf8_encode($linha_status_proposta["statusID"]);?>" selected>
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


}

?>
                            </select>
                        </td>
                        <td align=left><b>Frete:</b></td>
                        <td><select style="width: 250px; margin-right:30px; " name="campoFrete" id="campoFrete">

                                <?php  while($linha_frete = mysqli_fetch_assoc($lista_frete)){
$frete_principal= utf8_encode($linha_frete["freteID"]);
if(!isset($freteID)){

?>
                                <option value="<?php echo utf8_encode($linha_frete["freteID"]);?>">
                                    <?php echo utf8_encode($linha_frete["descricao"]);?>
                                </option>
                                <?php

}else{

if($freteID==$frete_principal){
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


}

?>
                            </select>
                        </td>

                        <td align=left> <b>Prazo entrega:</b> </td>
                        <td align=left> <input type="text" name="campoPrazoEntrega" OnKeyUp="mascaraData(this);"
                                size="10" value="<?php if(isset($_POST['adicionar'])){

}?>">


                        </td>
                        <td>

                        </td>



                    </div>
                </tr>


            </table>
            <table style="float:left; width:1000px; margin-top:5px;">
                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left> <select style="margin-right: 50px;" name="campoCliente" id="campoCliente">

                            <?php  while($linha_cliente = mysqli_fetch_assoc($lista_clientes)){
        $cliente_Principal = utf8_encode($linha_cliente["clienteID"]);
       if(!isset($clienteID)){
       
       ?>
                            <option value="<?php echo utf8_encode($linha_cliente["clienteID"]);?>">
                                <?php echo utf8_encode($linha_cliente["razaosocial"]);?>
                            </option>
                            <?php
       
       }else{

        if($clienteID==$cliente_Principal){
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

     
}

?> </td>


                    <td align=left><b>Comprador:</b></td>
                    <td align=left><select style="width: 200px;" name="campoComprador" id="campoComprador">

                            <?php  while($linha_comprador = mysqli_fetch_assoc($lista_comprador)){
            $comprador_Principal = utf8_encode($linha_comprador["id_comprador"]);
            if(!isset($compradorID)){
            
            ?>
                            <option value="<?php echo utf8_encode($linha_comprador["id_comprador"]);?>">
                                <?php echo utf8_encode($linha_comprador["comprador"]);?>
                            </option>
                            <?php

            }else{

            if($compradorID==$comprador_Principal){
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

}

?>
                        </select>
                    </td>


                </tr>

            </table>







            <table style="float:left; width:1400px; margin-top:5px;"  id="divisaoTabela">
                <td>
                    <div id="divDivisao">
                    </div>
                </td>

            </table>

            <table style="float:left; ">
                <tr>
                    <td align=left><b>produto:</b></td>
                    <td align=left><input type="text" size=60 name="campoNomeProduto" value="">
                    </td>
                    <td>
                        
                
                    <form action="" method="post">
                        <td align=left><input type="submit" name="adicionar" class="btn btn-success"  value="Adicionar"> </td>
                    </form>
                </tr>
            </table>
            <table style="float:left;   margin-bottom:35px;">

                <tr>
                    <div>
                        <td align=left><b>Qtd:</b></td>
                        <td align=left><input type="text" size=20 name="campoNomeProduto" value="">
                        </td>
                        <td align=left><b>Preço cotao:</b></td>
                        <td align=left><input type="text" size=20 name="campoNomeProduto" value="">
                        </td>
                        <td align=left><b>Preço venda:</b></td>
                        <td align=left><input type="text" size=20 name="campoNomeProduto" value="">
                        </td>
                        <td align=left><b>margem:</b></td>
                        <td align=left><input type="text" size=20 name="campoNomeProduto" value="">
                        </td>

                    </div>
                </tr>


            </table>
        </div>

        </form>




        <form action="consulta_produto.php" method="get">
          
            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Código</p>
                        </td>

                        <td>
                            <p>Descrição</p>
                        </td>
                        <td>
                            <p>Preço venda</p>
                        </td>
                        <td>
                            <p>Preço compra</p>
                        </td>
                        <td>
                            <p>Estoque</p>
                        </td>


                        <td>
                            <p>Categoria</p>
                        </td>
                        <td>
                            <p>Ativo</p>
                        </td>
                        <td>
                            <p>UND</p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                    </tr>

                    <?php
if(isset($_POST['adicionar'])){

if($cotacaofinalizada==0 && $cotacaofinalizada  != ""){

while($linha = mysqli_fetch_assoc($lista_Produto_otacao)){
?>
                    <tr id="linha_pesquisa">

                        <td style="width: 70px;">
                            <font size="3"><?php echo $linha['cotacaoID']?></font>
                        </td>

                        <td style="width: 500px;">
                            <p>
                                <font size="2"><?php echo $linha['descricao']?> </font>
                            </p>
                        </td>
                        <td style="width: 150px;">
                            <font size="2"></font>
                        </td>
                        <td style="width: 150px;">
                            <font size="2"> </font>
                        </td>

                        <td style="width: 100px;">
                            <font size="2"> </font>
                        </td>

                        <td style="width: 130px;">
                            <font size="2"> </font>
                        </td>

                        <td style="width: 90px;">
                            <font size="2"> </font>
                        </td>
                        <td>
                            <font size="2"> </font>
                        </td>

                        

                        <td id="botaoEditar">


                            <a
                                onclick="window.open('editar_cotacao.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                                <button type="button" class="btn btn-warning" name="editar">Editar</button>
                            </a>

                        </td>


                    </tr>



                    <?php
}
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

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>