<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

//variaveis
include("../classes/produtos/cadastro_produto.php");

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

        <div style="margin:0 auto; width:1500px; ">



            <table style="float: right; margin-right:100px;">
                <form action="" method="post">
                    <div id="titulo">
                        </p>Dadods do produto</p>
                    </div>


            </table>


            <div style="width: 900px;">

                <table style="float:left; ">

                    <tr>
                        <td style="width: 120px;" align="left">Código:</td>
                        <td align=left><input readonly type="text" size="10" id="cammpoProdutoID" name="cammpoProdutoID"
                                value=""> </td>

                    </tr>
                </table>
                <!--finalizar hidden -->
                <table style="float:left;">

                    <tr>
                        <td style="width: 120px;" align=left><b>Descrição:</b></td>
                        <td align=left><input type="text" size=80 name="campoNomeProduto"
                                value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($nome_produto);}?>">
                        </td>

                    </tr>
                </table>
                <table style="float: left;">

                    <tr>
                        <td style="width: 120px;"> <b>Preço Compra:</b></td>
                        <td style="width:100px;"><input type="text" size=10 id="campoPrecoCompra"
                                name="campoPrecoCompra"
                                value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($preco_compra);}?>"></td>
                        <td><b>Preço Venda:</b></td>
                        <td style="width: 50px;"><input type="text" size=10 name="campoPrecoVenda" id="campoPrecoVenda"
                                value="<?php if(isset($_POST['enviar']))
                    { echo utf8_encode($preco_venda);}?>"></td>


                        <td> <b>Ativo:</b></td>
                        <td> <select id="campoAtivo" name="campoAtivo">
                                <?php 


                                while($linha_ativo  = mysqli_fetch_assoc($lista_ativo)){
                                    $ativoPrincipal = utf8_encode($linha_ativo["ativoID"]);
                                if(!isset($ativo)){
                                
                                ?>
                                <option value="<?php echo utf8_encode($linha_ativo["ativoID"]);?>">
                                    <?php echo utf8_encode($linha_ativo["nome_ativo"]);?>
                                </option>
                                <?php
   
                                        }else{

                                            if($ativo==$ativoPrincipal){
                                            ?> <option value="<?php echo utf8_encode($linha_ativo["ativoID"]);?>"
                                    selected>
                                    <?php echo utf8_encode($linha_ativo["nome_ativo"]);?>
                                </option>

                                <?php
                                            }else{
                                    
                                ?>
                                <option value="<?php echo utf8_encode($linha_ativo["ativoID"]);?>">
                                    <?php echo utf8_encode($linha_ativo["nome_ativo"]);?>
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


                <table style="float: left;">
                    <tr>
                        <td style="width: 120px;" align=left><b>Estoque:</b></td>
                        <td align=left><input type="text" size=10 name="campoEstoque" id="campoEstoque"
                                value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($estoque);}?>"></td>

                        <td align=left> <b>Und Medida:</b></td>
                        <td align=left> <input style="margin-left: 5px;" type="text" size="10" id="campoUnidadedeMedida"
                                name="campoUnidadedeMedida"
                                value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($unidade_medida);}?>"></td>


                        <td align=left><b>Categoria:</b></td>
                        <td>
                            <select style="width: 200px;" id="campoCategoria" name="campoCategoria">
                                <?php 

                                    while($linha_categoria  = mysqli_fetch_assoc($lista_categoria)){
                                        $categoriaPrincipal = utf8_encode($linha_categoria["categoriaID"]);
                                    if(!isset($categoria)){
                                    
                                    ?>
                                <option value="<?php echo utf8_encode($linha_categoria["categoriaID"]);?>">
                                    <?php echo utf8_encode($linha_categoria["nome_categoria"]);?>
                                </option>
                                <?php
   
                                    }else{

                                        if($categoria==$categoriaPrincipal){
                                        ?> <option value="<?php echo utf8_encode($linha_categoria["categoriaID"]);?>"
                                    selected>
                                    <?php echo utf8_encode($linha_categoria["nome_categoria"]);?>
                                </option>

                                <?php
                                            }else{
                                    
                                ?>
                                <option value="<?php echo utf8_encode($linha_categoria["categoriaID"]);?>">
                                    <?php echo utf8_encode($linha_categoria["nome_categoria"]);?>
                                </option>
                                <?php

                                    }

                                    }

                                    
                                    }
                   
     ?>

                            </select>

                        </td>


                    </tr>
                    <table style="float: left;">
                        <tr>
                            <td style="width: 120px;" align="left"><b>Observação:<b></td>
                            <td align="left"><textarea rows=4 cols=60 name="campoObservacao" id="observacao"
                                    value=""><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>
                            </td>
                        </tr>
                    </table>

                    <table style="float: left;" >
                        <tr>
                            <div id="botoes" style=" border:1px solid">
                                <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"
                                    onClick="return confirm('Confirma o cadastro do produto?');"></input></td>


                                <button type="button" name="btnfechar" onclick="fechar();"
                                    class="btn btn-secondary">Voltar</button>

                            </div>
                        </tr>
                    </table>



            </div>
        </div>
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