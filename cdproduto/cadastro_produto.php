<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

//variaveis
$campo_obrigatorio_RazacaoS ="Descrição deve ser informado";
$msgcadastrado = "Produto cadastrado com sucesso!";



//consultar categoria do produto
$select = "SELECT categoriaID, nome_categoria from categoria_produto";
$lista_categoria = mysqli_query($conecta,$select);
if(!$lista_categoria){
    die("Falaha no banco de dados  Linha 89");
}

//consultar Situação ativo
$selectativo = "SELECT ativoID, nome_ativo from ativo";
$lista_ativo = mysqli_query($conecta, $selectativo);
if(!$lista_ativo){
    die("Falaha no banco de dados  Linha 96 ");
}

//variaveis 
if(isset($_POST["enviar"])){
    $hoje = date('Y-m-d'); 
    $produtoID = utf8_decode($_POST["cammpoProdutoID"]);
    $nome_produto = utf8_decode($_POST["campoNomeProduto"]);
    $preco_venda = utf8_decode($_POST["campoPrecoVenda"]);
    $preco_compra = utf8_decode($_POST["campoPrecoCompra"]);
    $estoque = utf8_decode($_POST["campoEstoque"]);
    $unidade_medida = utf8_decode($_POST["campoUnidadedeMedida"]);
    $categoria = utf8_decode($_POST["campoCategoria"]);
    $ativo = utf8_decode($_POST["campoAtivo"]);
    $observacao = utf8_decode($_POST["campoObservacao"]);
   

  if(isset($_POST['enviar']))
  {
        //campo obrigatorio 
              if($nome_produto == ""){
                  ?>


<p id="obrigatorio"><?php echo $campo_obrigatorio_RazacaoS;?> </p>
<?php 
              }else{
        ?>

<p id="confirmacao"><?php echo $msgcadastrado; ?> </p>
<?php

//inserindo as informações no banco de dados
  $inserir = "INSERT INTO produtos ";
  $inserir .= "( data_cadastro,nomeproduto,precovenda,precocompra,estoque,unidade_medida,observacao,nome_categoria,nome_ativo )";
  $inserir .= " VALUES ";
  $inserir .= "( '$hoje','$nome_produto','$preco_venda',' $preco_compra',' $estoque','$unidade_medida','$observacao','$categoria','$ativo')";

    $nome_produto = "";
    $preco_venda = "";
    $preco_compra = "";
    $estoque = "";
    $unidade_medida = "";
    $categoria = "";
    $ativo = "";
    $observacao = "";

  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
      die("Erro no banco de dados Linha 63 inserir_no_banco_de_dados");
      
  }

}
}

}

//teste
//

?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form action="" method="post">
            <div id="titulo">
                </p>Ficha Cadastral do Ciente</p>
            </div>



            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="cammpoProdutoID" name="cammpoProdutoID"
                            value=""> </td>
                </tr>

                <tr>
                    <td align=left><b>Descrição:</b></td>
                    <td align=left><input type="text" size=60 name="campoNomeProduto"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($nome_produto);}?>">
                    </td>

                </tr>

                <tr>

                    <td style="width: 120px;"> <b>Preço Compra:</b></td>
                    <td><input type="text" size=10 id="campoPrecoCompra" name="campoPrecoCompra"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($preco_compra);}?>">

                        <b>Preço Venda:</b>
                        <input type="text" size=10 name="campoPrecoVenda" id="campoPrecoVenda" value="<?php if(isset($_POST['enviar']))
                    { echo utf8_encode($preco_venda);}?>">


                        <b>Ativo:</b>

                        <select id="campoAtivo" name="campoAtivo">
                            <?php 
                        while($linha_ativo = mysqli_fetch_assoc($lista_ativo)){
                        ?>
                            <option value="<?php echo utf8_encode($linha_ativo["nome_ativo"]);?>">
                                <?php echo utf8_encode($linha_ativo["nome_ativo"]);?>
                            </option>

                            <?php

 }
 
 ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td align=left><b>Estoque:</b></td>
                    <td align=left><input type="text" size=10 name="campoEstoque" id="campoEstoque" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($estoque);}?>
">
                        <b>Und Medida:</b>
                        <input style="margin-left: 5px;" type="text" size="15" id="campoUnidadedeMedida"
                            name="campoUnidadedeMedida"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($unidade_medida);}?>">




                    </td>






                </tr>

                <tr>
                    <td align=left><b>Categoria:</b></td>
                    <td>
                        <select style="width: 200px;" id="campoCategoria" name="campoCategoria">
                            <?php 

                    while($linha_categoria = mysqli_fetch_assoc($lista_categoria)){
                    
           
    ?>
                            <option value="<?php echo utf8_encode($linha_categoria["nome_categoria"]);?>">
                                <?php echo utf8_encode($linha_categoria["nome_categoria"]);?>
                            </option>

                            <?php
     }
     ?>

                        </select>

                    </td>

                </tr>

                <tr>
                    <td align=left><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="campoObservacao" id="observacao" value="
"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>
                    </td>
                </tr>


                </talbe>
                <table width=100%>
                    <tr>
                        <div id="botoes">
                            <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>
                            <a href="consulta_produto.php">
                                <button type="button" name="btnfechar" class="btn btn-secondary">Voltar</button>
                            </a>


                        </div>
                    </tr>

        </form>



    </main>
</body>


<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 
mysqli_close($conecta);
?>