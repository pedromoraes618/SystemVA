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
     } else {  echo ".";
        ?>
<script>
alertify.success("Dados alterados");
</script>
<?php
         //header("location:listagem.php"); 
          
     }
   
   }




 if(isset($_POST['btnremover'])){
 
    //inlcuir as varias do input
   include("../_incluir/variaveis_input.php");

   //query para remover o cliente no banco de dados
   $remover = "DELETE FROM clientes WHERE clienteID = {$clienteID}";

     $operacao_remover = mysqli_query($conecta, $remover);
     if(!$operacao_remover) {
         die("Erro linha 44");   
     } else {   echo ".";
        ?>
<script>
alertify.error("Cliente removido com sucesso");
</script>
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