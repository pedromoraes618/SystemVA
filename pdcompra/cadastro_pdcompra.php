

<?php
require_once("../conexao/conexao.php");
include("../conexao/sessao.php");
//inportar a classe com as variaveis do banco de dados
include("../classes/pdcompra/cadastro_prcompra.php");
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
        <form action="cadastro_pdcompra.php" method="post">
            <div id="titulo">
                </p>Lançamento do Pedido de Compra</p>
            </div>



            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="cammpoPedidoID" name="cammpoPedidoID"
                            value=""> </td>
                </tr>

                <tr>
                    <td align=left><b>Nº Pedido:</b></td>
                    <td align=left><input type="text" size=14 name="campoNpdCompra"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($numeroPedidoCompra);}?>"
                            td><b>Nº Orçamento:</b>
                        <input type="text" size=20 id="campoOrcamento" name="campoOrcamento"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($numeroOrcamento);}?>">

                    <td><b>Nº NFE:</b></td>
                    <td><input type="text" size=20 id="campoNnfe" name="campoNnfe"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($numeroNfe);}?>"><b>Data
                            Pagamento*:</b>
                        <input type="text" size=20 id="campoDataPagamento" name="campoDataPagamento" value="<?php if(isset($_POST['enviar'])){ 
                                echo ($dataPagamento);}?>" OnKeyUp="mascaraData(this);" maxlength="10"
                            autocomplete="off">


                </tr>

                <tr>
                    <td align=left><b>Cliente:</b></td>
                    <td align=left><select id="campoCliente" name="campoCliente"><?php 
                                while($linha_clientes  = mysqli_fetch_assoc($lista_clientes)){
                                    $clientePrincipal = utf8_encode($linha_clientes["clienteID"]);
                                   if(!isset($cliente)){
                                   
                                   ?>
                                   <option value="<?php echo utf8_encode($linha_clientes["clienteID"]);?>">
                                       <?php echo utf8_encode($linha_clientes["razaosocial"]);?>
                                   </option>
                                   <?php
                                   
                                   }else{
       
                                    if($cliente==$clientePrincipal){
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
                    <td><select style="width: 205px;" id="campoFormaPagamento" name="campoFormaPagamento">
                            <?php 
                            while($linha_formapagamento  = mysqli_fetch_assoc($lista_formapagamemto)){
                                $formaPagamentoPrincipal = utf8_encode($linha_formapagamento["formapagamentoID"]);
                               if(!isset($formaPagamento)){
                               
                               ?>
                               <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                   <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                               </option>
                               <?php
                               
                               }else{
   
                                if($formaPagamento==$formaPagamentoPrincipal){
                                ?> <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>" selected>
                                   <?php echo utf8_encode($linha_formapagamento["nome"]);?>
                               </option>
   
                               <?php
                                         }else{
                                
                               ?>
                               <option value="<?php echo utf8_encode($linha_formapagamento["formapagamentoID"]);?>">
                                   <?php echo utf8_encode($linha_formapagamento["nome"]);?>
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
                    <td align=left><b>Produto:</b></td>
                    <td align=left><input type="text" size=57 name="campoProduto" id="campoProduto"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($produto);}?>"><i
                            id="botaoPesquisar" class="fa-solid fa-magnifying-glass-plus"></i> </td>

                    <td>
                        <b>Status da compra*:</b>
                    </td>
                    <td>
                        <select id="campoStatusCompra" name="campoStatusCompra">
                            <?php 
                                while($linha_statusCompra  = mysqli_fetch_assoc($lista_statuscompra)){
                                    $statusCompraPrincipal = utf8_encode($linha_statusCompra["nome"]);
                                   if(!isset($statusCompra)){
                                   
                                   ?>
                                   <option value="<?php echo utf8_encode($linha_statusCompra["nome"]);?>">
                                       <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                   </option>
                                   <?php
                                   
                                   }else{
       
                                    if($statusCompra==$statusCompraPrincipal){
                                    ?> <option value="<?php echo utf8_encode($linha_statusCompra["nome"]);?>" selected>
                                       <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                   </option>
       
                                   <?php
                                             }else{
                                    
                                   ?>
                                   <option value="<?php echo utf8_encode($linha_statusCompra["nome"]);?>">
                                       <?php echo utf8_encode($linha_statusCompra["nome"]);?>
                                   </option>
                                   <?php
       
               }
               
           }
       
                                 
       }
       
                         
                         ?>

                        </select>

                        <b  style="margin-left: 20px;">Data Compra:</b>
                        <input  style="margin-left: 27px;" type="text" size=20 id="campoDataCompra" name="campoDataCompra"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($dataCompra);}?>"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                    </td>


                </tr>

                <tr>
                    <td align=left><b>Unidade:</b></td>
                    <td align=left><input type="text" size=18 name="CampoUnidade" id="CampoUnidade" autocomplete="off"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($unidade);}?>"><b>Quantidade:</b>
                        <input type="text" size=19 name="CampoQuantidade" id="CampoQuantidade" autocomplete="off"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($quantidade);}?>">
                    </td>


                    <td align=left><b>Data chegada:</b></td>
                    <td align=left><input type="text" size=20 name="CampoDataChegada" id="CampoDataChegada"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($dataChegada);}?>"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off"><b>Entrega Prevista:</b>

                        <input type="text" size=20 id="CampoEntregaPrevista" name="CampoEntregaPrevista"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($entregaPrevista);}?>"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">
                    </td>


                </tr>


                <tr>
                    <td align=left> <b>Preço Compra:</b></td>
                    <td align=left> <input style="width: 190px;" type="text" size=16 id="campoPrecoCompra"
                            name="campoPrecoCompra" onblur="calculavalormargem()" autocomplete="off"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($precoCompra);}?>">

                        <b style="margin-left: -4px;">Preço Venda:</b>
                        <input type="text" size=18 name="campoPrecoVenda" id="campoPrecoVenda"
                            onblur="calculavalormargem()" autocomplete="off"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($precoVenda);}?>">
                    </td>
                    <td><b>Status do pedido*:</b></td>
                    <td>
                        <select id="campoStatusPedido" name="campoStatusPedido">
                            <?php 
                         
                         while($linha_statusPedido  = mysqli_fetch_assoc($lista_statuspedido)){
                            $receitaStatusPedidoPrincipal = utf8_encode($linha_statusPedido["nome"]);
                           if(!isset($statusPedido)){
                           
                           ?>
                           <option value="<?php echo utf8_encode($linha_statusPedido["nome"]);?>">
                               <?php echo utf8_encode($linha_statusPedido["nome"]);?>
                           </option>
                           <?php
                           
                           }else{

                            if($statusPedido==$receitaStatusPedidoPrincipal){
                            ?> <option value="<?php echo utf8_encode($linha_statusPedido["nome"]);?>" selected>
                               <?php echo utf8_encode($linha_statusPedido["nome"]);?>
                           </option>

                           <?php
                                     }else{
                            
                           ?>
                           <option value="<?php echo utf8_encode($linha_statusPedido["nome"]);?>">
                               <?php echo utf8_encode($linha_statusPedido["nome"]);?>
                           </option>
                           <?php

       }
       
   }

                         
}
                         ?>

                        </select>
                        <b  style="margin-left: 20px;" >Entrega Realizada:</b>
                        <input type="text" size=20 id="CampoEntregaRealizada" name="CampoEntregaRealizada"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($entregaRealizada);}?>"
                            OnKeyUp="mascaraData(this);" maxlength="10" autocomplete="off">

                    </td>

                </tr>

                <tr>

                    <td align=left><b>Margem:</b></td>
                    <td align=left><input type="text" size=18 name="campoMargem" id="campoMargem"
                            onblur="calculavalormargem()" autocomplete="off"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($margem);}?>"><b>Desconto:</b>
                        <input type="text" size=16 id="campoDesconto" name="campoDesconto"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($desconto);}?>">
                    </td>

                </tr>


                <tr>
                    <td align=left><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="observacao"
                            id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>


                    </td>
                </tr>


                </talbe>
                <table width=100%>
                    <tr>
                        <div id="botoes">
                            <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>

                            <a href="consulta_pdcompra.php">
                                <button type="button" class="btn btn-secondary" onclick="fechar()">Voltar</button>
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

function calculavalormargem() {
    var campoPrecoVenda = document.getElementById("campoPrecoVenda").value;
    var campoPrecoCompra = document.getElementById("campoPrecoCompra").value;
    var campoMargem = document.getElementById("campoMargem");
    var calculo;

    campoPrecoVenda = parseFloat(campoPrecoVenda);
    campoPrecoCompra = parseFloat(campoPrecoCompra);

    calculo = (((campoPrecoVenda - campoPrecoCompra) / campoPrecoVenda) * 100).toFixed(2);;
    campoMargem.value = calculo;
}
</script>






</html>

<?php 
mysqli_close($conecta);
?>
