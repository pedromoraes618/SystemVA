<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css" />
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css" />
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css" />

<?php
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
            echo ".";
            ?>
<script>
alertify.alert("Favor informe a razão social do cliente");
</script>
<?php
          }else{echo ".";
            ?>
<script>
alertify.success("Cliente cadastrado com sucesso");
</script>
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