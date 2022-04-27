<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include ("../_incluir/funcoes.php");

include ("../classes/lancamento_financeiro/Veditar_receita_despesa.php");

//variaveis texto obrigatorio e sucesso!



    $consulta = "SELECT * FROM lancamento_financeiro ";
if (isset($_GET["codigo"])){
    $lancamentoID=$_GET["codigo"];
$consulta .= " WHERE lancamentoFinanceiroID = {$lancamentoID} ";
}else{
    $consulta .= " WHERE lancamentoFinanceiroID = 1 ";
  
}
//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
    die("Falha na consulta ao banco de dados");
}else{
 
    $dados_detalhe = mysqli_fetch_assoc($detalhe);
    $BpedidoID =  utf8_encode($dados_detalhe['lancamentoFinanceiroID']);
    $BdataMovimento =  utf8_encode($dados_detalhe["data_movimento"]);
    $BdataaPagar = utf8_encode($dados_detalhe["data_a_pagar"]);
    $BdataPagamento = utf8_encode($dados_detalhe["data_do_pagamento"]);
    $BreceitaDespesa = utf8_encode($dados_detalhe["receita_despesa"]);
    $Bstatus = utf8_encode($dados_detalhe["status"]);
    $BformaPagamentoID = utf8_encode($dados_detalhe["forma_pagamentoID"]);
    $BclienteID = utf8_encode($dados_detalhe["clienteID"]);
    $Bdescrisao = utf8_encode($dados_detalhe["descricao"]);
    $Bdocumento = utf8_encode($dados_detalhe["documento"]);
    $BgrupoID = $dados_detalhe["grupoID"];
    $Bvalor = utf8_encode($dados_detalhe["valor"]);
    $Bobservacao = utf8_encode($dados_detalhe["observacao"]);
    

}


  ?>


<!doctype html>

<html>



<head>
    <meta charset="UTF-8">


    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="img/marvolt.ico">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body>

    <main>
        <div style="margin:0 auto; width:1450px;">
            <form action="" method="post">
                <div id="titulo">
                    </p>Edição de Receita / Despesa</p>
                </div>

                <div style="width: 1450px;">

                    <table style="float:left; ">

                        <tr>
                            <td style="width: 140px;" align="left"><b>Código:</b></td>
                            <td align=left><input readonly type="text" size="10" id="cammpoLancamentoID"
                                    name="cammpoLancamentoID" value="<?php echo $BpedidoID?>"> </td>
                        </tr>
                    </table>

                    <table style="float:left;">
                        <tr>
                            <td style="width: 140px;" align=left><b>Data lançamento:</b></td>
                            <td align=left><input type="text" size=20 name="campoDataLancamento"
                                    id="campoDataLancamento" OnKeyUp="mascaraData(this);" maxlength="10"
                                    autocomplete="off" value="<?php
                    if($BdataMovimento=="1970-01-01"){
                        print_r("");
                    }elseif($BdataMovimento=="0000-00-00"){
                        print_r ("");
                    }else{
                        echo formatardataB($BdataMovimento);}?>"></td>



                            <td align=left> <b>Data Vencimento:</b></td>

                            <td align=left> <input type="text" size=20 id="campoDataPagar" name="campoDataPagar"
                                    OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php 
                         if($BdataaPagar=="1970-01-01"){
                            print_r("");
                        }elseif($BdataaPagar=="0000-00-00"){
                            print_r ("");
                        }else{
                            echo formatardataB($BdataaPagar);}?>"></td>


                            <td><b>Data Pagamento:</b></td>
                            <td><input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento"
                                    maxlength="10" value="<?php
                                 if($BdataPagamento=="1970-01-01"){
                                    print_r("");
                                }elseif($BdataPagamento=="0000-00-00"){
                                    print_r ("");
                                }else{
                                    echo formatardataB($BdataPagamento);}
                                ?>" OnKeyUp="mascaraData(this);"></td>


                            <td align=left> <b>Lançamento:</b></td>


                            <td align=left> <select style="width: 170px;" id="campoLancamento" name="campoLancamento">
                                    <?php 

                               $meuReceitaDespesa = $BreceitaDespesa;
                           while($linha_receita_despesa = mysqli_fetch_assoc($lista_receita_despesa)){
                                $meuReceitaDespesaPrincipal = utf8_encode($linha_receita_despesa["nome"]);
                               if($meuReceitaDespesa==$meuReceitaDespesaPrincipal){

                               
                        ?>
                                    <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>" selected>
                                        <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                                    </option>

                                    <?php
                               }else{
                                   ?>

                                    <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>">
                                        <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                                    </option>
                                    <?php
                               }

                         }
                         
                         ?>

                                </select>
                            </td>
                        </tr>
                    </table>

                    <table style="float:left;">

                        <tr>
                            <td style="width: 140px;"> <b>Empresa:</b></td>
                            <td align=left><select style="margin-right: 60px;" id="campoCliente" name="campoCliente">


                                    <?php

                         $meuCliente =  $BclienteID;
                         while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                             $formaClientePrincipal = utf8_encode($linha_clientes["clienteID"]);

                             if($meuCliente==$formaClientePrincipal){
                                 ?> <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>" selected>
                                        <?php echo utf8_encode($linha_clientes["razaosocial"]);?>
                                    </option>

                                    <?php
                                 }else{
                                     ?>
                                    <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                        <?php echo utf8_encode($linha_clientes["razaosocial"]);?>
                                    </option>
                                    <?php

                                 }
                                 

                       }

                            ?>

                                </select>
                            </td>



                            <td align=left><b>Forma do pagamento:</b></td>
                            <td align=left><select style="width: 210px;" id="campoFormaPagamento"
                                    name="campoFormaPagamento">
                                    <?php 
                            $meuFormaPagamento = $BformaPagamentoID;
                           while($linha_formapagamento = mysqli_fetch_assoc($lista_formapagamemto)){
                               $formaPagamentoPrincipal = utf8_encode($linha_formapagamento['formapagamentoID']);
                               if($meuFormaPagamento==$formaPagamentoPrincipal){
                        ?>
                                    <option value="<?php 
                            echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>" selected>
                                        <?php echo utf8_encode($linha_formapagamento["nome"]); ?>
                                    </option>

                                    <?php 
                               }else{
                               ?>
                                    <option value="<?php 
                            echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                        <?php echo utf8_encode($linha_formapagamento["nome"]);
                                
                                ?>
                                    </option>

                                    <?php   
                            }
                         }
                         
                         ?>
                                </select></td>

                            <td align=left><b style="margin-left:17px;">Status:</b></td>
                            <td align=left> <select style="margin-left:47px; width:170px" id="campoStatusLancamento"
                                    name="campoStatusLancamento">
                                    <?php 
                            $meuStatus = $Bstatus;
                           while($linha_statusLamento = mysqli_fetch_assoc($lista_statusLancamento )){
                            $meuStatusPrincipal = utf8_encode($linha_statusLamento["nome"]);
                            if($meuStatus==$meuStatusPrincipal){
                        ?>

                                    <option value="<?php echo utf8_encode($linha_statusLamento["nome"]);?>" selected>
                                        <?php echo utf8_encode($linha_statusLamento["nome"]);?>
                                    </option>

                                    <?php
                            }else{
                                ?>
                                    <option value="<?php echo utf8_encode($linha_statusLamento["nome"]);?>">
                                        <?php echo utf8_encode($linha_statusLamento["nome"]);?>
                                    </option>

                                    <?php
                            }
                         }
                         
                         ?>

                                </select>
                            </td>
                        </tr>
                    </table>
                    <table style="float:left;">
                        <tr>
                            <td style="width: 140px;"><b>Descrição:</b></td>
                            <td align=left><input type="text" style="margin-right: 50px;" size=57 name="campoDescricao"
                                    id="campoDescricao" value="<?php echo $Bdescrisao?>">

                            <td align=left><b>N° Documento:</b></td>
                            <td align=left><input type="text" style=" margin-left:55px" size=20 name="campoDocumento"
                                    id="campoDocumento" value="<?php echo $Bdocumento?>">
                            </td>
                            </td>

                        </tr>
                    </table>
                    <table style="float:left; " width=100%>

                        <tr>
                            <td align=left style="width: 140px;"><b>Grupo:</b></td>
                            <td align=left> <b style="margin-left:0px;">
                                    <select style="margin-left:0px; width:300px" id="CampoGrupoLancamento"
                                        name="CampoGrupoLancamento">

                                        <?php
                                $meuGrupo =  $BgrupoID;
                                while($linha_grupoLancamento = mysqli_fetch_assoc($lista_grupoLancamento)){
                                    $meuGrupoPrincipal = utf8_encode($linha_grupoLancamento["grupo_lancamentoID"]);

                                    if($meuGrupo==$meuGrupoPrincipal){
                                        ?> <option
                                            value="<?php echo utf8_encode($linha_grupoLancamento["grupo_lancamentoID"]);?>"
                                            selected>
                                            <?php echo utf8_encode($linha_grupoLancamento["nome"]);?>
                                        </option>

                                        <?php
                                        }else{
                                            ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_grupoLancamento["grupo_lancamentoID"]);?>">
                                            <?php echo utf8_encode($linha_grupoLancamento["nome"]);?>
                                        </option>
                                        <?php

                                        }
                                }
                                ?>

                                    </select>

                            </td>

                        </tr>
                    </table>
                    <table style="float:left; " width=100%>
                        <tr>

                            <td align=left style="width: 140px;"><b>Valor:</b></td>
                            <td align=left><input type="text" size=20 name="campoValor" id="campoValor"
                                    value="<?php echo $Bvalor?>">
                        </tr>

                    </table>

                    <table style="float:left;" width=100%>
                        <tr>
                            <td style="width: 140px;"><b>Observação:<b></td>
                            <td><textarea rows=4 cols=60 name="observacao"
                                    id="observacao"><?php echo $Bobservacao ?></textarea>

                            </td>




                    </table>
                    <table style="float:left;">

                        <tr>
                            <div style="margin-left:140px;" id="botoes">
                                <input type="submit" name=btnsalvar value="Salvar" class="btn btn-info btn-sm"></input>




                                <button type="button" class="btn btn-secondary" onclick="fechar()">Voltar</button>


                                <input id="remover" type="submit" name="btnremover" value="Remover"
                                    class="btn btn-danger"
                                    onClick="return confirm('Deseja remover esse lançamento?');"></input>

                            </div>
                        </tr>
                    </table>
                </div>
        </div>

        </form>




    </main>
</body>

<?php include '../_incluir/funcaojavascript.jar'; ?>

<?php include '../classes/lancamento_financeiro/remover_lancamento_editar.php'; ?>


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