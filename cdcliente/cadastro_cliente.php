<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");

//variaveis
$campo_obrigatorio_RazacaoS ="Razao Social deve ser informada";
$msgcadastrado = "Cliente cadastrado com sucesso";



//consultar estados 
$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
    die("Falaha no banco de dados  Linha 19 cadastro_cliente");
}

//consultar cliente/forncedor/transportador
$selectcft = "SELECT clienteftID, nome from forclietrans";
$lista_cft = mysqli_query($conecta, $selectcft);
if(!$lista_cft){
die("Falaha no banco de dados  Linha 26clienteftid");
}

//variaveis 
if(isset($_POST["txtrazaosocial"])){
  $razao_social = utf8_decode($_POST["txtrazaosocial"]);
  $nome_fantasia = utf8_decode($_POST["txtnomefantasia"]);
  $cpfcnpj = utf8_decode($_POST["cpfcnpj"]);
  $inscricao_estadual = utf8_decode($_POST["inscricao_estadual"]);
  $cidade = utf8_decode($_POST["cidade"]);
  $estados = utf8_decode($_POST["estados"]);
  $bairro = utf8_decode($_POST["bairro"]);
  $clienteft = utf8_decode($_POST["cft"]);
  $email = utf8_decode($_POST["email"]);
  $endereco = utf8_decode($_POST["endereco"]);
  $telefone = $_POST["telefone"];
  $informacao_bancaria = utf8_decode($_POST["informacao_bancaria"]);
  $pix = $_POST["pix"];
  $observacao = utf8_decode($_POST["observacao"]);
  $conta_agencia = utf8_decode($_POST["conta_agencia"]);
  


  if(isset($_POST['enviar']))
  {
    //campo obrigatorio 
          if($razao_social == ""){
              ?>
<p id="obrigatorio"><?php echo $campo_obrigatorio_RazacaoS;?> </p>
<?php 
          }else{
    ?>

<p id="confirmacao"><?php echo $msgcadastrado; ?> </p>
<?php

//inserindo as informações no banco de dados
  $inserir = "INSERT INTO clientes ";
  $inserir .= "(razaosocial,endereco,cidade,estadoID,telefone,email,informacao_bancaria,conta_agencia,pix,observacao,cpfcnpj,inscricao_estadual,clienteftID,nome_fantasia,bairro)";
  $inserir .= " VALUES ";
  $inserir .= "('$razao_social','$endereco','$cidade',' $estados',' $telefone','$email','$informacao_bancaria','$conta_agencia','$pix','$observacao','$cpfcnpj','$inscricao_estadual','$clienteft','$nome_fantasia','$bairro')";


  $razao_social = "";
  $nome_fantasia = "";
  $cpfcnpj = "";
  $inscricao_estadual = "";
  $cidade = "";
  $bairro = "";
  $email = "";
  $endereco = "";
  $telefone = "";
  $informacao_bancaria = "";
  $pix ="";
  $observacao = "";
  $conta_agencia ="";

  $operacao_inserir = mysqli_query($conecta, $inserir);
  if(!$operacao_inserir){
      die("Erro no banco de dados Linha 63 inserir_no_banco_de_dados");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <main>
        <form action="cadastro_cliente.php" method="post">
            <div id="titulo">
                </p>Ficha Cadastral do Ciente</p>
            </div>


            <table width=100%>

                <tr>
                    <td>Codigo:</td>
                    <td align=left><input readonly type="text" id="txtcodigo" name="txtcodcliente" value=""> </td>
                </tr>

                <tr>
                    <td align=left><b>Razao Social:</b></td>
                    <td align=left><input type="text" size=60 name="txtrazaosocial"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($razao_social);}?>">
                    </td>
                    <td><b>Nome Fantasia:</b></td>
                    <td><input type="text" size=60 id="txtnomefantasia" name="txtnomefantasia"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($nome_fantasia);}?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>CPF/CNPJ:</b></td>
                    <td align=left><input type="text" size=60 name="cpfcnpj"
                            value="<?php if(isset($_POST['enviar'])){ echo $cpfcnpj ;}?>"> </td>
                    <td><b>Inscrisão estadual:</b></td>
                    <td><input type="text" size=60 id="inscricao_estadual" name="inscricao_estadual"
                            value="<?php if(isset($_POST['enviar'])){ echo $inscricao_estadual;}?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Cidade:</b></td>
                    <td align=left><input type="text" size=30 name="cidade"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($cidade);}?>"><b>UF:</b>
                        <?php include_once("../_incluir/uf_estados.php"); ?>
                    </td>

                    <td align=left><b>Bairro:</b></td>
                    <td align=left><input type="text" size=30 name="bairro" id="bairro"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($bairro);}?>">
                        <b>C/F/T:</b>
                        <select name="cft" id="cft">
                            <?php while($linha_cft = mysqli_fetch_assoc($lista_cft)){
?>
                            <option value="<?php echo $linha_cft["clienteftID"];?>">
                                <?php  echo utf8_encode($linha_cft["nome"]);?>


                            </option>

                            <?php
 }
?>

                        </select>

                    </td>
                </tr>

                <tr>
                    <td align=left><b>Email:</b></td>
                    <td align=left><input type="email" size=60 id="email" name="email"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($email);}?>"> </td>
                    <td><b>Enderço:</b></td>
                    <td><input type="text" size=60 id="endereco" name="endereco"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($endereco);}?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Telefone:</b></td>
                    <td align=left><input type="text" size=60 id="telefone" name="telefone"
                            value="<?php if(isset($_POST['enviar'])){ echo $telefone;}?>"> </td>
                    <td align=left><b>Informação bancaria:</b></td>
                    <td align=left><input type="text" size=60 id="informacao_bancaria" name="informacao_bancaria"
                            value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($informacao_bancaria);}?>">
                    </td>
                </tr>

                <tr>
                    <td><b>Conta agência:</b></td>
                    <td><input type="text" size=60 id="conta_agencia" name="conta_agencia"
                            value="<?php if(isset($_POST['enviar'])){ echo $conta_agencia;}?>"> </td>
                    <td><b>Pix:</b></td>
                    <td><input type="text" size=60 id="pix" name="pix"
                            value="<?php if(isset($_POST['enviar'])){ echo $pix;}?>"> </td>

                </tr>

                <tr>
                    <td><b>Observação:</b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao" value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?>
"></textarea> </td>
                </tr>



                </talbe>
                <table width=100%>
                    <tr>
                        <div id="botoes">
                            <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>
                            <input type="submit" onClick="return fechar();" name="btnfechar" class="btn btn-secondary"
                                value="Voltar"> </input>
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