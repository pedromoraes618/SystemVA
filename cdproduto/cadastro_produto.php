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
        <form action="" method="post">
            <div id="titulo">
                </p>Dadods do produto</p>
            </div>



            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="cammpoProdutoID" name="cammpoProdutoID"
                            value=""> </td>
                </tr>

                <tr>
                    <td align=left><b>Descrição:</b></td>
                    <td align=left><input  type="text" size=60 name="campoNomeProduto"
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
                            ?> <option value="<?php echo utf8_encode($linha_ativo["ativoID"]);?>" selected>
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

                <tr>
                    <td align=left><b>Estoque:</b></td>
                    <td align=left><input type="text" size=10 name="campoEstoque" id="campoEstoque" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($estoque);}?>
">
                        <b>Und Medida:</b>
                        <input style="margin-left: 5px;" type="text" size="10" id="campoUnidadedeMedida"
                            name="campoUnidadedeMedida"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($unidade_medida);}?>">




                    </td>






                </tr>

                <tr>
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
    ?> <option value="<?php echo utf8_encode($linha_categoria["categoriaID"]);?>" selected>
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

                <tr>
                    <td><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="campoObservacao" id="observacao" value="
"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>
                    </td>
                </tr>


                </talbe>
                <table width=100%>
                    <tr>
                        <div id="botoes">
                            <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"  onClick="return confirm('Confirma o cadastro do produto?');"></input>
                            
                            <a href="consulta_produto.php">
                                <button type="button"  name="btnfechar"  onclick="fechar();" class="btn btn-secondary">Voltar</button>
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