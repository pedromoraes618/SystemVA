<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include("../classes/produtos/editar_produto.php");
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
        <div style="margin:0 auto; width:1500px; ">

            <table style="float: right; margin-right:100px;">

                <form action="" method="post">
                    <div id="titulo">
                        </p>Dados do Produto</p>
                    </div>
            </table>

            <div style="width: 900px;">

                <table style="float:left; ">
                    <tr>
                        <td style="width: 120px;">Código:</td>
                        <td align=left><input readonly type="text" size="10" id="cammpoProdutoID" name="cammpoProdutoID"
                                value="<?php echo $BprodutoID;?>"> </td>
                    </tr>

                    <tr>
                        <td style="width: 120px;"><b>Descrição:</b></td>
                        <td align=left><input type="text" size=60 name="campoNomeProduto"
                                value="<?php echo $Bnome_produdo ?>">
                        </td>

                    </tr>
                </table>
                <table style="float: left;">

                    <tr>
                        <td style="width: 120px;"><b>Preço Compra:</b></td>
                        <td><input type="text" size=10 id="campoPrecoCompra" name="campoPrecoCompra"
                                value="<?php echo $Bpreco_compra ?>">

                        <td align=left> <b>Preço Venda:</b></td>
                        <td align=left> <input type="text" size=10 name="campoPrecoVenda" id="campoPrecoVenda"
                                value="<?php echo $Bpreco_venda ?>"></td>

                        <td align=left> <b>Ativo:</b></td>


                        <td align=left> <select id="campoAtivo" name="campoAtivo">
                                <?php 
                        $meuativo = $Bativo;
                        while($linha_ativo = mysqli_fetch_assoc($lista_ativo)){
                        $ativo_principal  = utf8_encode($linha_ativo["ativoID"]);
                        if($meuativo==$ativo_principal){

?>
                                <option value="<?php echo utf8_encode($linha_ativo["ativoID"]);?>" selected>
                                    <?php echo utf8_encode($linha_ativo["nome_ativo"]);?>
                                </option>

                                <?php
                                }else{
 ?>
                                <option value="<?php echo utf8_encode($linha_ativo["ativoID"]);?>">
                                    <?php echo utf8_encode($linha_ativo["nome_ativo"]);?>
                                </option>
                                <?php

 }}
 
 ?>

                            </select>
                        </td>

                    </tr>
                </table>
                <table style="float: left;">
                    <tr>
                        <td style="width: 120px;"><b>Estoque:</b></td>
                        <td align=left><input type="text" size=10 name="campoEstoque" id="campoEstoque"
                                value="<?php echo $Bestoque ?>">


                        <td align=left> <b>Und Medida:</b></td>
                        <td align=left> <input type="text" size=15 id="campoUnidadedeMedida" name="campoUnidadedeMedida"
                                value="<?php echo $Bunidade_medida ?>">

                        </td>

                        <td align=left><b>Categoria:</b></td>
                        <td>
                            <select style="width: 200px;" id="campoCategoria" name="campoCategoria">
                                <?php 
                        $meucategoria =  $Bcategoria ;
                        while($linha_categoria = mysqli_fetch_assoc($lista_categoria)){
                        $categoria_principal  =  utf8_encode($linha_categoria["categoriaID"]);
                        if($meucategoria==$categoria_principal){
                            
                        ?>
                                <option value="<?php echo utf8_encode($linha_categoria["categoriaID"]);?>" selected>
                                    <?php echo utf8_encode($linha_categoria["nome_categoria"]);?>
                                </option>



                                <?php
     }else{
     ?>
                                <option value="<?php echo utf8_encode($linha_categoria["categoriaID"]);?>">
                                    <?php echo utf8_encode($linha_categoria["nome_categoria"]);?>
                                </option>
                                <?php
     }}
     ?>

                            </select>

                        </td>
                    </tr>
                </table>
                <table style="float: left;">

                    <tr>
                        <td style="width: 120px;"><b>Observação:<b></td>
                        <td><textarea rows=4 cols=60 name="campoObservacao"
                                id="observacao"><?php echo $Bobservacao?></textarea>
                        </td>
                    </tr>

                </table>
                <table width=100%>
                    <tr>
                        <div id="botoes">

                            <input type="submit" name="btnsalvar" value="Salvar" class="btn btn-info btn-sm"></input>



                            <button type="button" onclick="fechar();" class="btn btn-secondary">Voltar</button>



                            <input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Deseja remover esse produto? Verifique se o produto tem movimentação');"></input>



                        </div>
                    </tr>

                </table>




                </form>

                </table>




    </main>
</body>


</html>


<script>
function fechar() {
    window.close();
}
</script>

<?php 
mysqli_close($conecta);
?>