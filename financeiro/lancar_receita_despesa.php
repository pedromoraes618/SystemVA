

<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include ("../_incluir/funcoes.php");
include("../lib/alertify.php");


//variaveis texto obrigatorio e sucesso!

//incluir os insert no banco de dedados e condições
include("../classes/lancamento_financeiro/variaveis_lancar_receita.php");

  
?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form action="" method="post">
            <div id="titulo">
                </p>Lançamento de Receita / Despesa</p>
            </div>



            <table width=100%>

                <tr>
                    <td><b>Código:</b></td>
                    <td align=left><input readonly type="text" size="10" id="cammpoLancamentoID"
                            name="cammpoLancamentoID" value=""> </td>
                </tr>

                <tr>
                    <td align=left><b>Data lançamento:</b></td>
                    <td align=left><input type="text" size=20 name="campoDataLancamento" id="campoDataLancamento"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php
                    
                            
                            if(isset($_POST['enviar'])){ 
                                echo utf8_encode($dataLancamento);
                                }?>" td>

                        <b>Data Vencimento:</b>
                        <input type="text" size=20 id="campoDataPagar" name="campoDataPagar"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($dataapagar);}?>">

                    <td><b>Data Pagamento:</b></td>
                    <td><input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento"
                            OnKeyUp="mascaraData(this);" maxlength="10"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($dataPagamento);}?>"><b>Lançamento:</b>

                        <select style="width: 170px;" id="campoLancamento" name="campoLancamento">
                            <?php 
                           while($linha_receita_despesa = mysqli_fetch_assoc($lista_receita_despesa)){
                        ?>
                            <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>">
                                <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                            </option>

                            <?php

                         }
                         
                         ?>

                        </select>




                </tr>

                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left><select id="campoCliente" name="campoCliente"><?php 
                           while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                        ?>
                            <option value="<?php 

                                echo utf8_encode($linha_clientes["clienteID"]);?>">

                                <?php 
                                
                          
                                echo utf8_encode($linha_clientes["razaosocial"]);?>
                            </option>

                            <?php

                         }
                         
                         ?>

                        </select>
                    </td>



                    <td><b>Forma do pagamento:</b></td>
                    <td><select style="width: 205px;" id="campoFormaPagamento" name="campoFormaPagamento">
                            <?php 
                           while($linha_formapagamento = mysqli_fetch_assoc($lista_formapagamemto)){
                        ?>
                            <option value="<?php 
                            echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                <?php echo utf8_encode($linha_formapagamento["nome"]);
                                
                                
                                ?>
                            </option>

                            <?php

                         }
                         
                         ?>

                        </select>
                        <b style="margin-left:14px;">Status:</b>
                        <select style="margin-left:47px; width:170px" id="campoStatusLancamento"
                            name="campoStatusLancamento">
                            <?php 
                           while($linha_statusLamento = mysqli_fetch_assoc($lista_statusLancamento )){
                        ?>

                            <option value="<?php echo utf8_encode($linha_statusLamento["nome"]);?>">
                                <?php echo utf8_encode($linha_statusLamento["nome"]);?>
                            </option>

                            <?php

                         }
                         
                         ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td align=left><b>Descrição:</b></td>
                    <td align=left><input type="text" size=57 name="campoDescricao" id="campoDescricao"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($descricao );}?>">
                    <td align=left><b>N° Documento:</b></td>
                    <td align=left><input type="text" size=20 name="campoDocumento" id="campoDocumento"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($documento);}?>">
                    </td>
                    </td>

                </tr>

                <tr>
                    <td align=left><b>Grupo:</b></td>
                    <td align=left> <b style="margin-left:0px;">
                            <select style="margin-left:0px; width:300px" id="CampoGrupoLancamento"
                                name="CampoGrupoLancamento">
                                <?php 
                           while($linha_grupoLancamento= mysqli_fetch_assoc($lista_grupoLancamento )){
                        ?>

                                <option value="<?php echo utf8_encode($linha_grupoLancamento["grupo_lancamentoID"]);?>">
                                    <?php echo utf8_encode($linha_grupoLancamento["nome"]);?>
                                </option>

                                <?php

                         }
                         
                         ?>

                            </select>

                    </td>

                </tr>
                </tr>

                <td align=left><b>Valor:</b></td>
                <td align=left><input type="text" size=20 name="campoValor" id="campoValor"
                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($valor);}?>">
                    </tr>

                    <tr>
                        <td align=left><b>Observação:<b></td>
                        <td><textarea rows=4 cols=60 name="observacao"
                                id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>


                        </td>




                        </talbe>
                        <table width=100%>
                            <tr>
                                <div style="margin-left:150px;" id="botoes">
                                    <input type="submit" name=enviar value="Cadastrar"
                                        class="btn btn-info btn-sm"></input>

                                    <a href="consulta_financeiro.php">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="fechar()">Voltar</button>
                                    </a>


                                </div>
                            </tr>

        </form>


        
     <?php
     //msg campos obrigatorios
        include("../classes/lancamento_financeiro/if_msg.php");
     ?>
   


    </main>
</body>

<?php include '../_incluir/funcaojavascript.jar'; ?>
<script>
/*
function fechar() {
    window.close();
}
*/
</script>


<script>
function abrepopupcliente() {

    var janela = "../buscar_cliente/consulta_cliente.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function fechar() {
    window.close();
}
</script>


</html>

<?php 
mysqli_close($conecta);

?>