<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");


include_once("../_incluir/funcoes.php");

if(isset($_POST['btnsalvar'])){

     //inlcuir as varias do input
    include("../_incluir/variaveis_input.php");
    
    //query para alterar o cliente no banco de dados
    $alterar = "UPDATE clientes set razaosocial = '{$razao_social}', endereco = '{$endereco}', cidade = '{$cidade}',  estadoID = '{$estados}', ";
    $alterar .= " telefone = '{$telefone}', email = '{$email}' ,informacao_bancaria = '{$informacao_bancaria}', conta_agencia = '{$conta_agencia}', pix = '{$pix}', ";
    $alterar .= " clienteftID = '{$clientefortrans}', observacao = '{$observacao}', cpfcnpj = '{$cpfcnpj}',inscricao_estadual = '{$inscricao_estadual}', nome_fantasia = '{$nome_fantasia}', bairro = '{$bairro}'  WHERE clienteID = {$clienteID} ";



      $operacao_alterar = mysqli_query($conecta, $alterar);
      if(!$operacao_alterar) {
          die("Erro na alteracao lina 20");   
      } else {  ?>
<p id="confirmacao">Dados alterados
<p>
    <?php
          //header("location:listagem.php"); 
           
      }
    
    }

  ?>

    <?php
  if(isset($_POST['btnremover'])){
  
     //inlcuir as varias do input
    include("../_incluir/variaveis_input.php");

    //query para remover o cliente no banco de dados
    $remover = "DELETE FROM clientes WHERE clienteID = {$clienteID}";

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


$consulta = "SELECT * FROM clientes ";
if (isset($_GET["codigo"])){
    $clienteID=$_GET["codigo"];
$consulta .= " WHERE clienteID = {$clienteID} ";
}else{
    $consulta .= " WHERE clienteID = 1 ";
  
}
//consulta ao banco de dados
$detalhe = mysqli_query($conecta, $consulta);
if(!$detalhe){
    die("Falha na consulta ao banco de dados");
}else{
    $dados_detalhe = mysqli_fetch_assoc($detalhe);
    $clienteID=  utf8_encode($dados_detalhe['clienteID']);
    $razao_social =  utf8_encode($dados_detalhe["razaosocial"]);
    $nome_fantasia = utf8_encode($dados_detalhe["nome_fantasia"]);
    $cpfcnpj = utf8_encode($dados_detalhe["cpfcnpj"]);
    $inscricao_estadual = $dados_detalhe["inscricao_estadual"];
    $cidade = utf8_encode($dados_detalhe["cidade"]);
    $estados = utf8_encode($dados_detalhe["estadoID"]);
    $bairro = utf8_encode($dados_detalhe["bairro"]);
    $clienteftID = $dados_detalhe["clienteftID"];
    $email = utf8_encode($dados_detalhe["email"]);
    $endereco = utf8_encode($dados_detalhe["endereco"]);
    $telefone = utf8_encode($dados_detalhe["telefone"]);
    $informacao_bancaria = utf8_encode($dados_detalhe["informacao_bancaria"]);
    $pix = $dados_detalhe["pix"];
    $observacao = utf8_encode($dados_detalhe["observacao"]);
    $conta_agencia = utf8_encode($dados_detalhe["conta_agencia"]);
}

//consulta estados

$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
    die("Falaha no banco de dados  Linha 89");
}

//consultar cliente/forncedor/transportador
$selectcft = "SELECT clienteftID, nome from forclietrans";
$lista_cft = mysqli_query($conecta, $selectcft);
if(!$lista_cft){
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
                </p>Ficha Cadastral do Ciente</p>
            </div>


            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="txtcodcliente" name="txtcodcliente"
                            value="<?php echo $clienteID;?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Razao Social:</b></td>
                    <td align=left><input type="text" size=60 name="txtrazaosocial" value="<?php echo $razao_social ?>">
                    </td>
                    <td><b>Nome Fantasia:</b></td>
                    <td><input type="text" size=60 id="txtnomefantasia" name="txtnomefantasia"
                            value="<?php echo $nome_fantasia ?>">
                    </td>
                </tr>

                <tr>
                    <td align=left><b>CPF/CNPJ:</b></td>
                    <td align=left><input type="text" size=60 name="cpfcnpj"
                            value="<?php echo formatCnpjCpf($cpfcnpj)?>"> </td>
                    <td><b>Inscrisão estadual:</b></td>
                    <td><input type="text" size=60 id="inscricao_estadual" name="inscricao_estadual"
                            value="<?php echo $inscricao_estadual ?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Cidade:</b></td>
                    <td align=left><input type="text" size=30 name="cidade" value="<?php echo $cidade ?>">
                        <!-- uf -->
                        <b>UF:</b>
                        <select id="estados" name="estados">
                            <?php 
                           $meuestado =  $estados;
                           while($linha=mysqli_fetch_assoc($lista_estados)){
                           $estado_principal  = $linha["estadoID"];
                           if($meuestado==$estado_principal){

                         
                        ?>
                            <option value="<?php echo $linha["estadoID"];?>" selected>
                                <?php echo utf8_encode($linha["nome"]);?>
                            </option>

                            <?php
                         }else{
                         ?>
                            <option value="<?php echo $linha["estadoID"];?>">
                                <?php echo utf8_encode($linha["nome"]);?>
                            </option>
                            <?php

                         }}
                         
                         ?>

                        </select>

                    </td>

                    <td align=left><b>Bairro:</b></td>
                    <td align=left><input type="text" size=30 name="bairro" value="<?php echo $bairro;?>"><b>C/F/T</b>

                        <select style="width: 175px;" id="fornecedor_cliente" name="fornecedor_cliente">

                            <?php 
                           $cft_selecionado =  $clienteftID;
                           while($linha_cft = mysqli_fetch_assoc($lista_cft)){
                           $ctf_principal  = $linha_cft["clienteftID"];
                           if($cft_selecionado==$ctf_principal){
                               
                        ?>
                            <option value="<?php echo $linha_cft["clienteftID"];?>" selected>
                                <?php echo utf8_encode($linha_cft["nome"]);?>
                            </option>

                            <?php
                         }else{
                         ?>
                            <option value="<?php echo $linha_cft["clienteftID"];?>">
                                <?php echo utf8_encode($linha_cft["nome"]);?>
                            </option>
                            <?php
                         }}
                         ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td align=left><b>Email:</b></td>
                    <td align=left><input type="email" size=60 id="email" name="email" value="<?php echo $email;?>">
                    </td>
                    <td><b>Enderço:</b></td>
                    <td><input type="text" size=60 id="endereco" name="endereco" value="<?php echo $endereco;?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Telefone:</b></td>
                    <td align=left><input type="text" size=60 id="telefone" name="telefone"
                            value="<?php echo $telefone?>"> </td>
                    <td align=left><b>Informação bancaria:</b></td>
                    <td align=left><input type="text" size=60 id="informacao_bancaria" name="informacao_bancaria"
                            value="<?php echo $informacao_bancaria?>">
                    </td>
                </tr>

                <tr>
                    <td><b>Conta agência:</b></td>
                    <td><input  type="text" size=30 id="conta_agencia" name="conta_agencia"
                            value="<?php echo $conta_agencia?>">
                    </td>
                    <td><b>Pix:</b></td>
                    <td><input type="text" size=60 id="pix" name="pix" value="<?php echo $pix?>"> </td>

                </tr>

                <tr>
                    <td align=left><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao"><?php echo $observacao ?></textarea>
                    </td>
                </tr>


                <table width=100%>
                    <tr>
                        <div id="botoes">

                            <input type="submit" name="btnsalvar" value="Salvar" class="btn btn-info btn-sm"></input>

                            <a href="consulta_cliente.php">
                                <button type="button" class="btn btn-secondary">Voltar</button>

                            </a>

                            <input id="remover" type="submit" name="btnremover" value="Remover"
                                class="btn btn-danger" onClick="return confirm('Confirma Remoção do CLienter? Verifique se o cliente tem movimentação');" ></input>



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