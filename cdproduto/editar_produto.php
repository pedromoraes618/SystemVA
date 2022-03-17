<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

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
$campo_obrigatorio_RazacaoS ="Razao Social deve ser informada";
$msgcadastrado = "Cliente cadastrado com sucesso";


$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
    die("Falaha no banco de dados  Linha 49 cadastro_cliente");
}


$consulta = "SELECT * FROM produtos ";
if (isset($_GET["codigo"])){
    $produtoID=$_GET["codigo"];
$consulta .= " WHERE produtoID = {$produtoID} ";
}else{
    $consulta .= " WHERE produtoID = 1 ";
  
}
//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
    die("Falha na consulta ao banco de dados");
}else{
 
    $dados_detalhe = mysqli_fetch_assoc($detalhe);
    $BprodutoID=  utf8_encode($dados_detalhe['produtoID']);
    $Bnome_produdo =  utf8_encode($dados_detalhe["nomeproduto"]);
    $Bpreco_venda = utf8_encode($dados_detalhe["precovenda"]);
    $Bpreco_compra = utf8_encode($dados_detalhe["precocompra"]);
    $Bestoque = utf8_encode($dados_detalhe["estoque"]);
    $Bunidade_medida = $dados_detalhe["unidade_medida"];
    $Bcategoria = utf8_encode($dados_detalhe["nome_categoria"]);
    $Bativo = utf8_encode($dados_detalhe["nome_ativo"]);
    $Bobservacao = utf8_encode($dados_detalhe["observacao"]);

}

//consulta categoria

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
                </p>Dados do Produto</p>
            </div>


            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="cammpoProdutoID" name="cammpoProdutoID"
                            value="<?php echo $BprodutoID;?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Descrição:</b></td>
                    <td align=left><input type="text" size=60 name="campoNomeProduto"
                            value="<?php echo $Bnome_produdo ?>">
                    </td>
                    <td><b>Unidade de Medida:</b></td>
                    <td><input type="text" size=30 id="campoUnidadedeMedida" name="campoUnidadedeMedida"
                            value="<?php echo $Bunidade_medida ?>">
                    </td>
                </tr>

                <tr>
                    <td align=left><b>Preço Venda:</b></td>
                    <td align=left><input type="text" size=60 name="campoPrecoVenda" id="campoPrecoVenda"
                            value="<?php echo $Bpreco_venda ?>"> </td>
                    <td><b>Preço Compra:</b></td>
                    <td><input type="text" size=60 id="campoPrecoCompra" name="campoPrecoCompra"
                            value="<?php echo $Bpreco_compra ?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Estoque:</b></td>
                    <td align=left><input type="text" size=30 name="campoEstoque" id="campoEstoque"
                            value="<?php echo $Bestoque ?>">

                        <!-- ativo -->
                        
                        <b>Ativo:</b>

                    
                        <select  id="campoAtivo" name="campoAtivo">
                            <?php 
                           $meuativo = $Bativo;
                           while($linha_ativo = mysqli_fetch_assoc($lista_ativo)){
                           $ativo_principal  = utf8_encode($linha_ativo["nome_ativo"]);
                           if($meuativo==$ativo_principal){

                        ?>
                            <option value="<?php echo utf8_encode($linha_ativo["nome_ativo"]);?>" selected>
                                <?php echo utf8_encode($linha_ativo["nome_ativo"]);?>
                            </option>

                            <?php
                         }else{
                         ?>
                            <option  value="<?php echo utf8_encode($linha_ativo["nome_ativo"]);?>">
                                <?php echo utf8_encode($linha_ativo["nome_ativo"]);?>
                            </option>
                            <?php

                         }}
                         
                         ?>

                        </select>

                    </td>
                     



                    <td align=left><b>Categoria:</b></td>

                    <td>
                        <select id="campoCategoria" name="campoCategoria">
                            <?php 
                           $meucategoria =  $Bcategoria ;
                           while($linha_categoria = mysqli_fetch_assoc($lista_categoria)){
                           $categoria_principal  =  utf8_encode($linha_categoria["nome_categoria"]);
                           if($meucategoria==$categoria_principal){
                               
                        ?>
                            <option value="<?php echo utf8_encode($linha_categoria["nome_categoria"]);?>" selected>
                                <?php echo utf8_encode($linha_categoria["nome_categoria"]);?>
                            </option>

                        

                            <?php
                         }else{
                         ?>
                            <option value="<?php echo utf8_encode($linha_categoria["nome_categoria"]);?>">
                                <?php echo utf8_encode($linha_categoria["nome_categoria"]);?>
                            </option>
                            <?php
                         }}
                         ?>

                        </select>

                    </td>

                </tr>



                <tr>
                    <td align=left><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="campoObservacao"
                            id="observacao"><?php echo $Bobservacao  ?></textarea>
                    </td>
                </tr>


                <table width=100%>
                    <tr>
                        <div id="botoes">

                            <input type="submit" name="btnsalvar" value="Salvar" class="btn btn-info btn-sm"></input>

                            <a href="consulta_produto.php">
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