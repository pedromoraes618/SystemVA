<?php 
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