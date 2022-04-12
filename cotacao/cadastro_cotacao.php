<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");

//deckara as varuaveus
if((isset($_POST['adicionar'])) or (isset($_POST['salvar'])) or  (isset($_POST['cotacaofinalizada']))){
    
    $codCotacao = utf8_decode($_POST["codigoCotacao"]);
    $descricao = utf8_decode($_POST["campoNomeProduto"]);
    $usuarioID = utf8_decode($_POST["usuarioID"]);
    $clienteID = utf8_decode($_POST["clienteID"]);
    $salvar = utf8_decode($_POST["tueSalvar"]);
    $cotacaofinalizada = utf8_decode($_POST["cotacaofinalizada"]);
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
    if($cotacaofinalizada==0){

//inserir o produto
$inserir = "INSERT INTO produto_cotacao ";
  $inserir .= "(cotacaoID, descricao )";
  $inserir .= " VALUES ";
  $inserir .= "('$codCotacao','$descricao' )";
  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
      die("Erro no banco de dados Linha 63 inserir_no_banco_de_dados");
        }
     }else{
        echo "É necessario inicar a cotação";
     }
}

//consultar os produto da cotação, codição de clicar no botao adicionar
if(isset($_POST['adicionar'])){
$selectProdutoCotacao = "SELECT * from produto_cotacao where cotacaoID = '$codCotacao'";
$lista_Produto_otacao= mysqli_query($conecta, $selectProdutoCotacao);
if(!$lista_Produto_otacao){
die("Falaha no banco de dados");
}
}

//condicao podera salvar a cotação com a condição variavel salvar está com o valor 1
if(isset($_POST['salvar'])){
    if($salvar == "1"){
        $inserir = "INSERT INTO cotacao ";
        $inserir .= "(usuarioID, clienteID )";
        $inserir .= " VALUES ";
        $inserir .= "('$usuarioID','$clienteID' )";
        $operacao_inserir = mysqli_query($conecta, $inserir);
        if(!$operacao_inserir){
            die("Erro no banco de dados inserir cotacao");
        }
      
      }
}






?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/estilo.css" rel="stylesheet">
    <link href="../_css/pesquisa_tela.css" rel="stylesheet">

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>


    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>






        <form action="" method="post">
            <input type="submit" name="iniciar" value="Inicar Cotacao">
            <input type="submit" name="adicionar" value="Adicionar">
            <input type="submit" name="salvar" value="Finalizar">

            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" name="codigoCotacao" value="<?php 
                         
                                echo $id_cotacao + 1 ;
                         
                         ?>"> </td>

                    <td>cotacaofinalizada?:</td>
                    <td align=left><input readonly type="text" size="10" name="cotacaofinalizada" value="<?php 
                         
                            if(isset($_POST['salvar'])){
                                echo 1;
                            }elseif(isset($_POST['iniciar'])){
                                echo 0;
                            }
                            if(isset($_POST['adicionar'])){
                                echo $_POST['cotacaofinalizada'];
                            }

                         
                         ?>"> </td>

                    <td>salvar:</td>
                    <td align=left><input readonly type="text" size="10" name="tueSalvar" value="<?php
                            if(isset($_POST['adicionar']))
                            {
                                if($salvar == ""){
                                    echo 1;
                                }else{
                                    echo 1;
                                }
                            }
                            
                            ?>"> </td>


                    <td>clienteID:</td>
                    <td align=left><input type="text" name="clienteID" size="10" value="<?php if(isset($_POST['adicionar'])){
                        echo $clienteID;
                    }?>"> </td>
                    <td>usuarioID:</td>
                    <td align=left><input type="text" name="usuarioID" size="10" value="<?php if(isset($_POST['adicionar'])){
                        echo $usuarioID;
                    }?>"> </td>
                </tr>


                <tr>
                    <td align=left><b>produto:</b></td>
                    <td align=left><input type="text" size=60 name="campoNomeProduto" value="">
                    </td>

                </tr>
            </table>




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

                                <button type="button" name="editar">Editar</button>
                            </a>

                        </td>


                    </tr>



                    <?php
 }}
            ?>
                </tbody>
            </table>

        </form>

    </main>
</body>

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