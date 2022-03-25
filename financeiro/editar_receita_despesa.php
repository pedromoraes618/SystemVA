


<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");



include ("../_incluir/funcoes.php");

//variaveis texto obrigatorio e sucesso!
$msgcadastrado = "Lançamento realizado com sucesso";



//consultar forma de pagamento
$select = "SELECT formapagamentoID, nome, statuspagamento from forma_pagamento";
$lista_formapagamemto = mysqli_query($conecta,$select);
if(!$lista_formapagamemto){
    die("Falaha no banco de dados || select formapagma");
}


//consultar cliente
$select = "SELECT clienteID, razaosocial from clientes";
$lista_clientes = mysqli_query($conecta,$select);
if(!$lista_clientes){
    die("Falaha no banco de dados || select clientes");
}

//consultar lancamento
$select = "SELECT receita_despesaID, nome from receita_despesa";
$lista_receita_despesa = mysqli_query($conecta,$select);
if(!$lista_receita_despesa){
    die("Falaha no banco de dados ||   falha de conexão de red || select clientes");
}


//consultar status do pedido
$select = "SELECT status_lancamentoID, nome from status_lancamento";
$lista_statusLancamento = mysqli_query($conecta,$select);
if(!$lista_statusLancamento){
    die("Falaha no banco de dados
    || falha de conexão de red
    select status Lancamento");
}


//consultar grupo Lançamento
$select = "SELECT grupo_lancamentoID, nome from grupo_lancamento";
$lista_grupoLancamento = mysqli_query($conecta,$select);
if(!$lista_grupoLancamento){
    die("Falaha no banco de dados
    || falha de conexão de red
    select status Lancamento");
}

//consultar status da compra
$select = "SELECT statuscompraID, nome from status_compra";
$lista_statuscompra = mysqli_query($conecta,$select);
if(!$lista_statuscompra){
    die("Falaha no banco de dados || select statuscompra");
}

//iniciar a tela com o campo preenchido


//variaveis 
if(isset($_POST["btnsalvar"])){

    $lancamentoID = utf8_decode($_POST["cammpoLancamentoID"]);
    $dataLancamento = utf8_decode($_POST["campoDataLancamento"]);
    $dataapagar = utf8_decode($_POST["campoDataPagar"]);
    $dataPagamento = utf8_decode($_POST["campoDataPagamento"]);
    $lancamento = utf8_decode($_POST["campoLancamento"]);
    $cliente = utf8_decode($_POST["campoCliente"]);
    $formaPagamento = utf8_decode($_POST["campoFormaPagamento"]);
    $statusLancamento = utf8_decode($_POST["campoStatusLancamento"]);
    $descricao = utf8_decode($_POST["campoDescricao"]);
    $documento = utf8_decode($_POST["campoDocumento"]);
    $grupoLancamento = utf8_decode($_POST["CampoGrupoLancamento"]);
    $valor = utf8_decode($_POST["campoValor"]); 
    $observacao = utf8_decode($_POST["observacao"]);

//formatar a data para o banco de dados(Y-m-d)

//condição obrigatorio 
    if(!$lancamento == ""){

        if($dataLancamento==""){
          
        }else{
            $div1 = explode("/",$_POST['campoDataLancamento']);
            $dataLancamento = $div1[2]."-".$div1[1]."-".$div1[0];  
           
        }
        if($dataapagar==""){
           
        }else{
            $div2 = explode("/",$_POST['campoDataPagar']);
        $dataapagar = $div2[2]."-".$div2[1]."-".$div2[0];
        }


        if($dataPagamento==""){
        
        }else{
            
        $div3 = explode("/",$_POST['campoDataPagamento']);
        $dataPagamento = $div3[2]."-".$div3[1]."-".$div3[0];
        }


    //alterando as informações no banco de dados
  
    //query para alterar o pedido de compra no banco de dados
    $alterar = "UPDATE lancamento_financeiro set data_movimento = '{$dataLancamento}', data_a_pagar = '{$dataPagamento}', receita_despesa = '{$lancamento}',  status = '{$statusLancamento}', ";
    $alterar .= " forma_pagamentoID = '{$formaPagamento}', clienteID = '{$cliente}', descricao = '{$descricao}', documento = '{$documento}', grupoID = '{$grupoLancamento}', valor = '{$valor}',  observacao  = '{$observacao}' WHERE lancamentoFinanceiroID = {$lancamentoID} ";

      $operacao_alterar = mysqli_query($conecta, $alterar);
      if(!$operacao_alterar) {
          die("Erro na alteracao linha29");   
      } else {  ?>

<p id="confirmacao">Dados alterados</p>
<?php
          //header("location:listagem.php"); 
           
      }

}
}



//botão remover
?>


<?php

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
        <form action="" method="post">
            <div id="titulo">
                </p>Edição de Receita / Despesa</p>
            </div>



            <table width=100%>

                <tr>
                    <td><b>Código:</b></td>
                    <td align=left><input readonly type="text" size="10" id="cammpoLancamentoID"
                            name="cammpoLancamentoID" value="<?php echo $BpedidoID?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Data lançamento:</b></td>
                    <td align=left><input type="text" size=20 name="campoDataLancamento" id="campoDataLancamento"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php
                    
            
                    if($BdataMovimento=="1970-01-01"){
                        print_r("");
                    }elseif($BdataMovimento=="0000-00-00"){
                        print_r ("");
                    }else{
                        echo formatardataB($BdataMovimento);}?>">


                        <b>Data Vencimento:</b>
                        <input type="text" size=20 id="campoDataPagar" name="campoDataPagar"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php 
                    if($BdataaPagar=="1970-01-01"){
                        print_r("");
                    }elseif($BdataaPagar=="0000-00-00"){
                        print_r ("");
                    }else{
                        echo formatardataB($BdataaPagar);}?>">

                    <td><b>Data Pagamento:</b></td>
                    <td><input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento"
                            OnKeyUp="mascaraData(this);" maxlength="10" value="<?php  if($BdataPagamento=="1970-01-01"){
                        print_r("");
                    }elseif($BdataPagamento=="0000-00-00"){
                        print_r ("");
                    }else{
                        echo formatardataB($BdataPagamento);}?>"><b>Lançamento:</b>

                        <select style="width: 170px;" id="campoLancamento" name="campoLancamento">
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




                </tr>

                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left><select id="campoCliente" name="campoCliente">


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



                    <td><b>Forma do pagamento:</b></td>
                    <td><select style="width: 205px;" id="campoFormaPagamento" name="campoFormaPagamento">
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

                        </select>
                        <b style="margin-left:14px;">Status:</b>
                        <select style="margin-left:47px; width:170px" id="campoStatusLancamento"
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

                <tr>
                    <td align=left><b>Descrição:</b></td>
                    <td align=left><input type="text" size=57 name="campoDescricao" id="campoDescricao"
                            value="<?php echo $Bdescrisao?>">

                    <td align=left><b>N° Documento:</b></td>
                    <td align=left><input type="text" size=20 name="campoDocumento" id="campoDocumento"
                            value="<?php echo $Bdocumento?>">
                    </td>
                    </td>

                </tr>

                <tr>
                    <td align=left><b>Grupo:</b></td>
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
                                <option value="<?php echo utf8_encode($linha_grupoLancamento["grupo_lancamentoID"]);?>">
                                    <?php echo utf8_encode($linha_grupoLancamento["nome"]);?>
                                </option>
                                <?php

                                        }
                                }
                                ?>

                            </select>

                    </td>

                </tr>
                </tr>

                <td align=left><b>Valor:</b></td>
                <td align=left><input type="text" size=20 name="campoValor" id="campoValor"
                        value="<?php echo $Bvalor?>">
                    </tr>

                    <tr>
                        <td align=left><b>Observação:<b></td>
                        <td><textarea rows=4 cols=60 name="observacao"
                                id="observacao"><?php echo $Bobservacao ?></textarea>

                        </td>




                        </talbe>
                        <table width=100%>
                            <tr>
                                <div style="margin-left:150px;" id="botoes">
                                    <input type="submit" name=btnsalvar value="Salvar"
                                        class="btn btn-info btn-sm"></input>

                                    <a href="consulta_financeiro.php">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="fechar()">Voltar</button>
                                    </a>

                                    <input id="remover" type="submit" name="btnremover" value="Remover"
                                        class="btn btn-danger"
                                        onClick="return confirm('Confirma Remoção do Pedido de Compra? Verifique se o cliente tem movimentação');"></input>

                                </div>
                            </tr>

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
