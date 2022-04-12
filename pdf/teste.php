<?php
//referenciar o dompdf com namespace
include "../conexao/conexao.php";

use Dompdf\Dompdf;

require_once("dompdf/autoload.inc.php");

$dompdf = new Dompdf();

$dompdf -> load_html('
<h1>
gerar pdf
</h1>
');

//renderizar com o html
$dompdf->render();

//exibibir a página
$dompdf ->stream("relatorio_teste.php",array("Attachment"=>false));//para realizar o download somente alterar para true
?>
