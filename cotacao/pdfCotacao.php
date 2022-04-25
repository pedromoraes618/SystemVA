<?php
//referenciar o dompdf com namespace
include("../conexao/sessao.php");
require_once("../conexao/conexao.php"); 
include("../_incluir/funcoes.php");

//consultar os dados da empresa pelo id 
$consulta = "SELECT * from empresa ";
$dados_empresa= mysqli_query($conecta, $consulta);
while($row_empresa = mysqli_fetch_assoc($dados_empresa)){
    $razaoSocial = utf8_encode($row_empresa['razao_social']);
    $endereco = utf8_encode($row_empresa['endereco']);
    $cnpj = utf8_encode($row_empresa['cnpj']);
    $inscricaoEstadual = utf8_encode($row_empresa['inscricao_estadual']);
    $email = utf8_encode($row_empresa['email']);
    $telefone = utf8_encode($row_empresa['telefone']);
}


//consultar cliente pelo id
$consultaCliente = " SELECT clientes.razaosocial,clientes.endereco,clientes.telefone,clientes.cpfcnpj,clientes.cidade, clientes.email,estados.sigla AS uf from estados inner join clientes on clientes.estadoID = estados.estadoID ";
$clienteID =  $_GET["cliente"];
$consultaCliente .= " WHERE clienteID = {$clienteID}";  

$dados_cliente = mysqli_query($conecta, $consultaCliente);
while($row_cliente = mysqli_fetch_assoc($dados_cliente)){
    $razaoSocialCliente = utf8_encode($row_cliente['razaosocial']);
    $enderecoCliente = utf8_encode($row_cliente['endereco']);
    $telefoneCliente = $row_cliente['telefone'];
    $cnpjCliente = $row_cliente['cpfcnpj'];
    $ufCliente = utf8_encode($row_cliente['uf']);
    $cidadeCliente = utf8_encode($row_cliente['cidade']);
    $emailCliente = utf8_encode($row_cliente['email']);
}


//consultar cotacao pelo codigo cotação
$consulta = "SELECT cotacao.data_lancamento, cotacao.numero_orcamento, cotacao.cod_cotacao, cotacao.numero_solicitacao, cotacao.validade, cotacao.prazo_entrega,cotacao.valorTotal,cotacao.desconto, cotacao.valorTotalComDesconto, forma_pagamento.nome as formapagamento,forma_pagamento.nome,frete.descricao as frete from forma_pagamento inner join cotacao on cotacao.forma_pagamentoID = forma_pagamento.formapagamentoID inner join  frete on cotacao.freteID = frete.freteID ";
$codCotacaoB =  $_GET["codigo"];
$consulta .= " WHERE cod_cotacao = {$codCotacaoB}";  

$dados_cotacao= mysqli_query($conecta, $consulta);
while($row_cotacao = mysqli_fetch_assoc($dados_cotacao)){
    $dataLancamentoB = $row_cotacao['data_lancamento'];
    $numeroOrcamentoB = $row_cotacao['numero_orcamento'];
    $codCotacaoB = $row_cotacao['cod_cotacao'];
    $numeroSolicitacaoB = $row_cotacao['numero_solicitacao'];
    $validadeB = $row_cotacao['validade'];
    $freteB = $row_cotacao['frete'];
    $formaPagamentoIDB = $row_cotacao['formapagamento'];
    $prazoEntregaB = $row_cotacao['prazo_entrega'];
    $cliente = $row_cotacao['clienteID'];
    $valor = $row_cotacao['valorTotal'];
    $desconto = $row_cotacao['desconto'];
    $totalComDesconto = $row_cotacao['valorTotalComDesconto'];
}

$textoCotacao = "No valor estão inclusas todas as despesas que resultem no custo das aquisições, tais como impostos, taxas, transportes, materiais utilizados, seguros, encargos fiscais e todos os ônus diretos e qualquer outra despesa que incidir na execução do produto.Empresa optante pelo Simples Nacional. Todos os produtos são de origem Nacional.";

$linha = 0;
$consultaCotacao = "SELECT * from produto_cotacao ";
$prodCotacao =  $_GET["codigo"];
$consultaCotacao .= " WHERE cotacaoID = {$prodCotacao}";  
$dados_produto = mysqli_query($conecta, $consultaCotacao);

$date = date('d/m/Y');

$html= "<table width=100% id='tempresa'>";
$html .= "<tr><td > <img width=150px height=90px src='../images/logoapp.png' ></td></tr>"; 
$html .="<tr><td align=left><font size=3><b>" . $razaoSocial . "</b></font></td></tr>";

$html .="<tr><td align=left><font size=3>" . $endereco . "</font></td></tr>";
$html .="<tr><td align=left><font size=3>CNPJ:" . $cnpj . "INSCRIÇÃO ESTADUAL:".$inscricaoEstadual."</font></td></tr>";
$html .="<tr><td align=left><font size=3>E-MAIL:" . $email . " CONTATO:".$telefone."</font></td></tr>";
$html .= "</table>";
$html .= "<p>";
$html .= "<p align=center><b>ORÇAMENTO DE MATERIAS Nº ".$numeroOrcamentoB ."</b><p>";
$html .= "<p>";

//dados cotacao
$html .= "<table id='tcotacao' >";
$html .="<tr><td align=left><font size=3><b>Solicitação de cotação Nº: </b>" . $numeroSolicitacaoB . "</font></td><td align=left><font size=3><b>Data: </b>" . $date . "</font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Validade do orçamento: </b>" . $validadeB . " dias úteis</font></td><td align=left><font size=3><b>Plano de pagamento: </b>" . $formaPagamentoIDB . "</font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Modalidade do Frete: </b>" . $freteB . "</font></td>";
$html .= "</table>";
$html .= "<div id='linha'></div>";
$html .= "<p>";

//dados cliente

$html .= "<div id='dadosCliente'>";
$html .= "<table id='tcliente'>";
$html .="<tr><td align=lefts><font size=3><b>Cliente: </b>" . $razaoSocialCliente . "</font></td><td align=left><font size=3><b>CPF/CNPJ: </b>" . $cnpjCliente . "</font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Endereço: </b>" . $enderecoCliente . " </font></td><td align=left><font size=3><b>Cidade: </b>" . $cidadeCliente . " - " .$ufCliente."</font></td></tr>";
$html .="<tr><td align=left><font size=3><b>Contato: </b>" . $telefoneCliente . "</font></td><td align=left><font size=3><b>E-Mail: </b>" . $emailCliente . "</font></td></tr>";
$html .= "</table>";
$html .= "</div>";

$html .= "<table id='cabecalhoTabela' width=100%>";
$html .="<tr id='linhaCabecalho'><td align=center style=width:50px;><font size=2><b>Item</b></font></td>";
$html .="<td align=left style=width:550px;><font size=2><b>Descrição</b> </font></td>";
$html .="<td align=left ><font size=2><b> Und. </b></font></td>";
$html .="<td align=left><font size=2><b> Quant.</b> </font></td>";
$html .="<td align=left><font size=2><b> P.unitario</b> </font></td>";
$html .="<td align=left><font size=2><b> V.total </b></font></td>";
$html .="<td align=left><font size=2><b> Prazo </b></font></td>";
$html .="</tr>";



while($row_produto = mysqli_fetch_assoc($dados_produto)){
$cotacaoID = $row_produto['cotacaoID'];
$descricao = $row_produto['descricao'];
$quantidade = $row_produto['quantidade'];
$precoCompra = $row_produto['preco_compra'];
$precoVenda = $row_produto['preco_venda'];
$margem = $row_produto['margem'];
$unidade = $row_produto['unidade'];
$status = $row_produto['status'];
$prazo = $row_produto['prazo'];
if($prazo == 0){
    $prazo = 30;
}else{
    $prazo = $prazo;
}
$precoTotal = $precoVenda * $quantidade;
$linha = $linha +1;

$html .="<tr>";
$html .="<td align=center style=width:50px;><font size=2>".$linha."</font></td>";
$html .="<td align=left style=width:500px;><font size=2> ".utf8_encode($descricao)." </font></td>";
$html .="<td align=left ><font size=2>".$unidade." </font></td>";
$html .="<td align=left><font size=2>".$quantidade." </font></td>";
$html .="<td align=left><font size=2>".real_format($precoVenda)." </font></td>";
$html .="<td align=left><font size=2>".real_format($precoTotal)." </font></td>";
$html .="<td align=left><font size=2>".($prazo)." dias úteis </font></td>";
$html .="</tr>";

}



$html .= "</table>";
$html .= "<div id='linhaTotal'></div>";
$html .= "<table width=100%>";
$html .="<tr>";
$html .="<td align=left style=width:200px;><font size=2><b>TOTAL DE ITENS ".$linha."</b></font></td>";
$html .="<td align=right style=width:200px;><font size=2><b>VALOR TOTAL DO PEDIDO: ".real_format($valor)."</b></font></td>";
$html .="</tr>";

$html .= "<table>";
$html .="<tr>";
$html .="<td></td>";
$html .="</tr>";
$html .= "</table>";

$html .= "</table>";
$html .= "<table>";
$html .="<tr>";
$html .="<td align=left><font size=2>".$textoCotacao."</font></td>";
$html .="</tr>";
$html .= "</table>";

$html .= "<table>";
$html .="<tr>";
$html .="<td></td>";
$html .="</tr>";
$html .= "</table>";

if($desconto!=0){
$html .= "<table width=100% ";
$html .="<tr>";
$html .="<td align=left style=width:200px;><font size=2><b> </b></font></td>";
$html .="<td align=right style=width:500px;><font size=2><b>VALOR TOTAL DO PEDIDO COM DESCONTO DE ".real_percent($desconto). "  " .  real_format($totalComDesconto). "</b></font></td>";
$html .="</tr>";
$html .= "</table>";
}
$date = date('d/m/Y');






use Dompdf\Dompdf;

require_once("../pdf/dompdf/autoload.inc.php");

$dompdf = new DOMPDF();
$dompdf->setPaper('a4', 'landscape');
$codigo_html = $html;
$dompdf -> loadHtml('<link href="../_css/cotacaoPdf.css" rel="stylesheet">'. $codigo_html );

ob_clean(); 
$dompdf->render();
//renderizar com o html


//exibibir a página
$dompdf ->stream("Cotacao ".$numeroOrcamentoB."",array("Attachment"=>false));//para realizar o download somente alterar para true

file_put_contents("cotacao.pdf", $output);
// redirecionamos o usuário para o download do arquivo
die("<script>location.href='minuta.pdf';</script>");
?>

?>