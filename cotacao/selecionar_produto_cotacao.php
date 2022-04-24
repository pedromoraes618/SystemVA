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
if((isset($_POST['adicionar']))){
    $hoje = date('Y-m-d'); 
    $codProduto = utf8_decode($_POST["codigoProduto"]);
    $codCotacao = utf8_decode($_POST["codigoCotacao"]);
    $nomeProduto= utf8_decode($_POST["campoNomeProduto"]);
    $qtdProduto = utf8_decode($_POST["campoQtdProduto"]);
    $precoCompra = utf8_decode($_POST["campoPrecoCotado"]);
    $precoVenda = $_POST["campoVenda"];
    $margem = utf8_decode($_POST["campoMargem"]);
    $unidade = utf8_decode($_POST["campoUnidade"]);
    $statusProduto = utf8_decode($_POST['campoStatusProduto']);
    $prazo = utf8_decode($_POST['campoPrazo']);
    
}
//variaveis 
if(isset($_POST['adicionar'])){
    if($precoVenda==""){
        ?>
<script>
alertify.alert("Valor de venda do produto não foi preenchido");
</script>
<?php
    }else{

   
    $inserir = "INSERT INTO produto_cotacao ";
    $inserir .= "(cotacaoID, descricao , quantidade, preco_compra, margem , preco_venda,unidade,status, prazo )";
    $inserir .= " VALUES ";
    $inserir .= "('$codCotacao','$nomeProduto','$qtdProduto','$precoCompra', '$margem' ,'$precoVenda','$unidade','$statusProduto','$prazo') ";
    $operacao_inserir = mysqli_query($conecta, $inserir);
  
    if(!$operacao_inserir){
        die("Falaha no banco de dados || pesquisar produto cotacao");
          }else{
            ?>
<script>
alertify.success("Produto incluido com sucesso!");
</script>
<?php
          }
        }

  }
  


$consulta = "SELECT * FROM produtos ";
if (isset($_GET["codigo"])){
   $codProduto=$_GET["codigo"];
$consulta .= " WHERE produtoID= {$codProduto} ";
}else{
   $consulta .= " WHERE produtoID = 1 ";
}

//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
   die("Falha na consulta ao banco de dados");
}else{
   $dados_detalhe = mysqli_fetch_assoc($detalhe);
  
}

if(isset($_GET)){
$cotacaoID = $_GET['cotacaoCod'];
$descrisaoGet = $_GET['nomProduto'];
$precoCompraGet = $_GET['precoCompra'];
$precoVendaGet = $_GET['precoVenda'];
$unidadeGet = $_GET['unidade'];



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
                    </p>Cotação</p>
                </div>


                <tr>

                    <form action="" method="post">
                        <td align=left> <input type="submit" id="adicionar" name="adicionar" class="btn btn-success"
                                value="salvar">
                        </td>

                        <td align=left> <button type="button" name="btnfechar" class="btn btn-secondary"
                                onclick="fechar();">Voltar</button>





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
                                    echo $descrisaoGet;
                                }?>">
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
                    <td align=left><b>Prazo:</b></td>
                    <td align=left><input type="text" size=10 name="campoPrazo" id="campoPrazo"
                            onblur="calculavalormargem()" autocomplete="off"
                            value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($prazo);}?>">
                    </td>
                </tr>
            </table>

            <table style="float:left;">
                <tr>
                    <div>
                        <td align=left><b>Und:</b></td>
                        <td align=left><input type="text" size=10 name="campoUnidade" id="campoUnidade"
                                autocomplete="off" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($unidade);}
                                elseif(!isset($_POST['adicionar'])){
                                    echo $unidadeGet;
                                }?>">
                        </td>
                        <td align=left><b>Qtd:</b></td>
                        <td align=left><input type="text" size=10 name="campoQtdProduto" id="campoQtdProduto"
                                onblur="calculavalormargem()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($qtdProduto);}?>">
                        </td>
                        <td align=left><b>P. cotado:</b></td>
                        <td align=left><input type="text" size=10 name="campoPrecoCotado" id="campoPrecoCotado"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php echo $precoCompraGet; ?>">
                        </td>
                        <td align=left><b>Margem:</b></td>
                        <td align=left><input type="text" size=10 name="campoMargem" id="campoMargem"
                                onblur="calculavalorPrecoVenda()" autocomplete="off"
                                value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($margem);}?>">
                        </td>
                        <td align=left><b>P. venda:</b></td>
                        <td align=left><input type="text" size=10 name="campoVenda" id="campoPrecoVenda"
                                onblur="calculavalormargem()" autocomplete="off" value="<?php if(isset($_POST['adicionar'])){ echo utf8_encode($precoVenda);}
                                elseif(!isset($_POST['adicionar'])){
                                    echo $precoVendaGet;
                                }?>">
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