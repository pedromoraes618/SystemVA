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
if(isset($_POST['btnremover'])){
 
    //inlcuir as varias do input
    $codProduto = utf8_decode($_POST["codigoProduto"]);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda = $_POST["campoVenda"];
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $prazo_entrega = utf8_decode($_POST['campoPrazo']);


   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM produto_cotacao WHERE produto_cotacao = {$codProduto} ";

     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro linha 44");   
     } else {
        ?>
<script>
alertify.error("Produto removido com sucesso!");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }



if(isset($_POST['btnsalvar'])){

    //inlcuir as varias do input
    $codProduto = utf8_decode($_POST["codigoProduto"]);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda = $_POST["campoVenda"];
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $statusProduto = utf8_decode($_POST['campoStatusProduto']);
    $prazo_entrega = utf8_decode($_POST['campoPrazo']);
   
   //query para alterar o produto da cotacao no banco de dados
   $alterar = "UPDATE produto_cotacao set descricao = '{$nomeProduto}', quantidade = '{$qtdProduto}', preco_compra = '{$precoCompra}',  preco_venda = '{$precoVenda}' ,  margem = '{$margem}' ,  unidade = '{$unidade}', status = '{$statusProduto}', prazo = '{$prazo_entrega}' WHERE produto_cotacao = {$codProduto}  ";

     $operacao_alterar = mysqli_query($conecta, $alterar);
     if(!$operacao_alterar) {
         die("Erro na alteracao - banco de dados");   
     } else {  
        ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }



//consultar o produto da cotacao
$consulta = "SELECT * FROM produto_cotacao ";
if (isset($_GET["codigo"])){
   $codProduto=$_GET["codigo"];
$consulta .= " WHERE produto_cotacao= {$codProduto} ";
}else{
   $consulta .= " WHERE produto_cotacao = 1 ";
}

//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
   $produto =  utf8_encode($dados_detalhe['descricao']);
   $cotacaoID = utf8_encode($dados_detalhe['cotacaoID']);
   $quantidade =  utf8_encode($dados_detalhe['quantidade']);
   $precoCompra =  utf8_encode($dados_detalhe['preco_compra']);
   $precoVenda =  utf8_encode($dados_detalhe['preco_venda']);
   $margem =  utf8_encode($dados_detalhe['margem']);
   $unidade =  utf8_encode($dados_detalhe['unidade']);
   $status =  utf8_encode($dados_detalhe['status']);
   $prazo =  utf8_encode($dados_detalhe['prazo']);
   
  
}

//consultar o status do produto
$select = "SELECT * FROM status_produto_cotacao ";
$lista_status_produto_cotacao = mysqli_query($conecta,$select);
if(!$lista_status_produto_cotacao){
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
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
</head>

<body>


    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>




        <div style="margin:0 auto; width:1500px; ">

            <table style="float: right; margin-right:200px;">
                <div id="titulo">
                    </p>Editar Produto</p>
                </div>


                <tr>

                    <form action="" method="post">
                        <td align=left> <input type="submit" id="salvar" name="btnsalvar" class="btn btn-success"
                                value="salvar">
                        </td>
                        <td> <input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Confirmar Remoção do produto da cotação <?php echo $cotacaoID;?>');"></input>
                        </td>

                        <td align=left> <button type="button" name="btnfechar" class="btn btn-secondary"
                                onclick="fechar();">Voltar</button>
                        </td>





                </tr>

            </table>

            </td>

            </tr>

            </table>


            <table style="float:left; width:900px; margin-top:5px;">

                <tr>
                    <td>Código:
                        <input style="margin-left:0px;" readonly type="text" size="10" name="codigoProduto"
                            value="<?php echo $codProduto; ?>">
                    </td>

                    <td align=left><input readonly type="hidden" size="10" name="codigoCotacao"
                            value="<?php echo $cotacaoID; ?>"> </td>
                </tr>
            </table>

            <table style="float:left; ">
                <tr>
                    <td><b>Produto:</b></td>
                    <td align=left><input style="margin-left:0px;" type="text" size=60 name="campoNomeProduto" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($nomeProduto);} elseif(!isset($_POST['adicionar'])){
                                    echo $produto;
                                }?>">
                    </td>
                    <td><b>Status</b></td>
                    <td align=left> <b>Status:</b></td>
                    <td align=left><select style="width: 170px; margin-right:10px;" id="campoStatusProduto"
                            name="campoStatusProduto">

                            <?php  
                        $meu_status = $status;
                        while($linha_status_produto  = mysqli_fetch_assoc($lista_status_produto_cotacao)){
                            $status_principal = utf8_encode($linha_status_produto["status_produtoID"]);
                            if($meu_status==$status_principal){
                            ?> <option value="<?php echo utf8_encode($linha_status_produto["status_produtoID"]);?>"
                                selected>
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

 


?>

                        </select>

                    </td>
                    <td align=left><b>Prazo:</b></td>
                    <td align=left><input type="text" size=10 name="campoPrazo" id="campoPrazo"
                            value="<?php echo utf8_encode($prazo);?>">
                    </td>
                </tr>
            </table>

            <table style="float:left;">
                <tr>
                    <div>
                        <td align=left><b>Und:</b></td>
                        <td align=left><input type="text" size=10 name="campoUnidade" id="campoUnidade"
                                autocomplete="off" value="<?php echo $unidade; ?>">
                        </td>
                        <td align=left><b>Qtd:</b></td>
                        <td align=left><input type="text" size=10 name="campoQtdProduto" id="campoQtdProduto"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $quantidade?>">
                        </td>
                        <td align=left><b>P. cotado:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoCotado" id="campoPrecoCotado"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $precoCompra; ?>">
                        </td>
                        <td align=left><b>Margem:</b></td>
                        <td align=left><input type="text" size=10 name="campoMargem" id="campoMargem"
                                onblur="calculavalorPrecoVenda()" autocomplete="off" value="<?php echo $margem?>">
                        </td>
                        <td align=left><b>P. venda:</b></td>
                        <td align=left><input type="text" size=10 name="campoVenda" id="campoPrecoVenda"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $precoVenda;
                                ?>">
                        </td>


                    </div>
                </tr>


            </table>
        </div>



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