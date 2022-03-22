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
if(isset($_POST["enviar"])){
    $hoje = date('Y-m-d'); 
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
  if(isset($_POST['enviar']))
{

      if($lancamento=="Selecione"){
        ?>

<p id="obrigatorio"><?php echo "Favor selecione o tipo do lançamento";?> </p>
<?php 
      }else{
        if($dataLancamento==""){
            ?>


<p id="obrigatorio"><?php echo "Favor informe a data do lançamento";?> </p>
<?php 
        }else{
            
            ?>
<p id="confirmacao"><?php echo $msgcadastrado; ?> </p>
<?php
            
             ?>
<?php

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


//inserindo as informações no banco de dados

  $inserir = "INSERT INTO lancamento_financeiro ";
  $inserir .= "( data_movimento,data_a_pagar,data_do_pagamento,receita_despesa,status,forma_pagamentoID,clienteID,descricao,documento,grupoID,valor,observacao )";
  $inserir .= " VALUES ";
  $inserir .= "( '$dataLancamento','$dataapagar','$dataPagamento','$lancamento','$statusLancamento','$formaPagamento','$cliente','$descricao','$documento','$grupoLancamento','$valor','$observacao' )";

  //limpando os campos apos inserir no banco de dados
  
  $dataLancamento = "";
  $dataapagar = "";
  $dataPagamento = "";
  $lancamento  = "";
  $descricao= "";
  $documento = "";
  $valor = "";
  $observacao = "";

  //verificando se está havendo conexão com o banco de dados
  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
    print_r($_POST);
      die("Erro no banco de dados inserir_no_banco_de_dados");
   
  }

}
}
}
}
}




  
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
        <form action="lancar_receita_despesa.php" method="post">
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