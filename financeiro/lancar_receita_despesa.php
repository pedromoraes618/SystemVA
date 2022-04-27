<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

include ("../_incluir/funcoes.php");


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
        <div style="margin:0 auto; width:1450px;">

            <form action=""  autocomplete="off" method="post">
                <div id="titulo">
                    </p>Lançamento de Receita / Despesa</p>
                </div>


                <div style="width: 1450px;">

                    <table style="float:left; ">
                        <tr>
                            <td style="width: 140px;" align="left"><b>Código:</b></td>
                            <td align=left><input readonly type="text" size="10" id="cammpoLancamentoID"
                                    name="cammpoLancamentoID" value=""> </td>
                        </tr>
                    </table>

                    <table style="float:left;">
                        <tr>
                            <td style="width: 140px;" align=left><b>Data lançamento:</b></td>
                            <td align=left><input type="text" size=20 name="campoDataLancamento"
                                    id="campoDataLancamento" OnKeyUp="mascaraData(this);" maxlength="10"
                                    autocomplete="off" value="<?php
                    
                            
                            if(isset($_POST['enviar'])){ 
                             
                                if($dataLancamento){
                              
                                    echo  $dataLancamento;
                                }else{
                                        echo "";
                                    
                                }}
                                  
                           ?>" td>

                            <td align=left> <b>Data Vencimento:</b></td>
                            <td align=left> <input type="text" size=20 id="campoDataPagar" name="campoDataPagar"
                                    OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off" value="<?php if(isset($_POST['enviar'])){ 
                                
                                if($dataapagar){
                              
                                    echo ($dataapagar);
                                }else{
                                        echo "";
                                    
                                }}
                            ?>"></td>

                            <td align=left><b>Data Pagamento:</b></td>
                            <td align=left><input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento"
                                    OnKeyUp="mascaraData(this);" maxlength="10" value="<?php if(isset($_POST['enviar'])){ 
                                
                                if($dataPagamento){
                              
                                    echo ($dataPagamento);
                                }else{
                                        echo "";
                                    
                                }}

                               ?>"></td>
                            <td align=left> <b>Lançamento:</b></td>

                            <td align=left> <select style="width: 170px;" id="campoLancamento" name="campoLancamento">
                                    <?php 
                            
                               
                             while($linha_receita_despesa  = mysqli_fetch_assoc($lista_receita_despesa)){
                                $receita_despesa_principal = utf8_encode($linha_receita_despesa["nome"]);
                               if(!isset($lancamento)){
                               
                               ?>
                                    <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>">
                                        <?php echo utf8_encode($linha_receita_despesa["nome"]);?>
                                    </option>
                                    <?php
                               
                               }else{
   
                                if($lancamento==$receita_despesa_principal){
                                ?> <option value="<?php echo utf8_encode($linha_receita_despesa["nome"]);?>" selected>
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
   
                             
   }
   
                         ?>


                                </select></td>
                        </tr>
                    </table>

                    <table style="float:left;">
                        <tr>
                            <td style="width: 140px;"> <b>Empresa:</b></td>
                            <td align=left><select style="margin-right: 60px;" id="campoCliente" name="campoCliente"><?php 

                            while($linha_clientes = mysqli_fetch_assoc($lista_clientes)){
                            $formaClientePrincipal = utf8_encode($linha_clientes["clienteID"]);
                            if(!isset($cliente)){
                            
                            ?>
                                    <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                        <?php echo utf8_encode($linha_clientes["razaosocial"]);?>
                                    </option>
                                    <?php
                            

                            }else{
                            if($cliente ==$formaClientePrincipal){
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

                          
}


   ?>


                                </select>
                            </td>



                            <td><b>Forma do pagamento:</b></td>
                            <td><select style="width: 212px;" id="campoFormaPagamento" name="campoFormaPagamento">

                                    <?php 

                             while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                             $formaPagmaentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
                            if(!isset($formaPagamento)){
                            
                            ?>
                                    <option
                                        value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                        <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                    </option>
                                    <?php
                            

                            }else{

                             if($formaPagamento==$formaPagmaentoPrincipal){
                             ?> <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>"
                                        selected>
                                        <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                    </option>

                                    <?php
                                      }else{
                             
                            ?>
                                    <option
                                        value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                        <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                                    </option>
                                    <?php

        }
        
    }

                          
}
                         
                         ?>

                                </select></td>
                            <td align=left> <b style="margin-left:17px;">Status:</b></td>
                            <td align=left><select style="margin-left:47px; width:170px" id="campoStatusLancamento"
                                    name="campoStatusLancamento">
                                    <?php 
                            while($linha_statusLacamento  = mysqli_fetch_assoc($lista_statusLancamento)){
                                $statusPrincipal = utf8_encode($linha_statusLacamento["nome"]);
                               if(!isset($statusLancamento)){
                               
                               ?>
                                    <option value="<?php echo utf8_encode($linha_statusLacamento["nome"]);?>">
                                        <?php echo utf8_encode($linha_statusLacamento["nome"]);?>
                                    </option>
                                    <?php
                               
   
                               }else{
   
                                if($statusLancamento==$statusPrincipal){
                                ?> <option value="<?php echo utf8_encode($linha_statusLacamento["nome"]);?>" selected>
                                        <?php echo utf8_encode($linha_statusLacamento["nome"]);?>
                                    </option>

                                    <?php
                                         }else{
                                
                               ?>
                                    <option value="<?php echo utf8_encode($linha_statusLacamento["nome"]);?>">
                                        <?php echo utf8_encode($linha_statusLacamento["nome"]);?>
                                    </option>
                                    <?php
   
           }
           
       }
   
                             
   }
                         
                         ?>

                            </td>
                        </tr>
                    </table>
                    <table style="float:left;">

                        <tr>
                            <td style="width: 140px;"><b>Descrição:</b></td>
                            <td align=left><input type="text" style="margin-right: 50px;" size=57 name="campoDescricao"
                                    id="campoDescricao"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($descricao );}?>">
                            <td align=left><b>N° Documento:</b></td>
                            <td align=left><input type="text" style=" margin-left:55px" size=20 name="campoDocumento"
                                    id="campoDocumento"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($documento);}?>">
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
                           
                           while($linha_grupoLancamento  = mysqli_fetch_assoc($lista_grupoLancamento)){
                            $GrupoLancamentoPrincipal = utf8_encode($linha_grupoLancamento["grupo_lancamentoID"]);
                           if(!isset($grupoLancamento)){
                           
                           ?>
                                        <option
                                            value="<?php echo utf8_encode($linha_grupoLancamento["grupo_lancamentoID"]);?>">
                                            <?php echo utf8_encode($linha_grupoLancamento["nome"]);?>
                                        </option>
                                        <?php
                           

                           }else{

                            if($grupoLancamento==$GrupoLancamentoPrincipal){
                            ?> <option value="<?php echo utf8_encode($linha_grupoLancamento["grupo_lancamentoID"]);?>"
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
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($valor);}?>"></td>
                        </tr>
                    </table>

                    <table style="float:left;" width=100%>

                        <tr>
                            <td align=left style="width: 140px;"><b>Observação:<b></td>
                            <td><textarea rows=4 cols=60 name="observacao"
                                    id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>


                            </td>
                        </tr>

                    </table>

                    <table style="float:left;">
                        <tr>
                            <div style="margin-left:140px;" id="botoes">
                                <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>
                                <button type="button" class="btn btn-secondary" onclick="fechar()">Voltar</button>



                            </div>
                        </tr>
                    </table>
                </div>
        </div>
        </form>



        <?php

    
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