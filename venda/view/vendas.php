<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="stylesheet" type="text/css" href="../lib/alertifyjs/css/alertify.css">
<link rel="stylesheet" type="text/css" href="../lib/alertifyjs/css/themes/default.css">
<link rel="stylesheet" type="text/css" href="../lib/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../lib/select2/css/select2.css">
<link rel="stylesheet" type="text/css" href="../css/menu.css">



<script src="../lib/jquery-3.2.1.min.js"></script>
<script src="../lib/alertifyjs/alertify.js"></script>

<script src="../lib/select2/js/select2.js"></script>
<script src="../js/funcoes.js"></script>
<?php 
	session_start();

		
 ?>


<!DOCTYPE html>
<html>

<head>
    <title>vendas</title>
    <?php include "../../_incluir/body.php"; ?>
    <link href="../../_css/estilo.css" rel="stylesheet">
 
</head>

<body>

    <div class="container">
        <h1>Venda de Produtos</h1>
        <div class="row">
            <div class="col-sm-12">
                <span class="btn btn-default" id="vendaProdutosBtn">Vender Produto</span>
				
				<!--  <span class="btn btn-default" id="vendasFeitasBtn">Lista de Vendas</span>  -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div id="vendaProdutos"></div>
                <div id="vendasFeitas">


                    <?php 

	
	//require_once "vendas/vendasRelatorios.php" 

	?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
$(document).ready(function() {
    $('#vendaProdutosBtn').click(function() {
        esconderSessaoVenda();
        $('#vendaProdutos').load('vendas/vendasDeProdutos.php');
        $('#vendaProdutos').show();
    });
/*
    $('#vendasFeitasBtn').click(function() {
        esconderSessaoVenda();
        $('#vendasFeitas').load('vendas/vendasRelatorios.php');
        $('#vendasFeitas').show();
    });
	*/
});

function esconderSessaoVenda() {
    $('#vendaProdutos').hide();
    $('#vendasFeitas').hide();
}
</script>

<?php 

 ?>