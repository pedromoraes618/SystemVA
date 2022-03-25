<?php




include("../lib/alertify.php");
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
    
if($lancamento=="Selecione"){
?>
<script>
alertify.alert("Favor selecione o tipo do lançamento");
</script>
<?php
}
}
 
?>

