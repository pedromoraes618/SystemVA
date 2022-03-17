<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");

//consultar cliente/forncedor/transportador
$selectcft = "SELECT clienteftID, nome from forclietrans";
$lista_cft = mysqli_query($conecta, $selectcft);
if(!$lista_cft){
die("Falaha no banco de dados  Linha 31 inserir_transportadora");
}

//consultar clientes
$clientes = "SELECT * FROM clientes";
if(isset($_GET["cliente"])){
    $nome_cliente = $_GET["cliente"];
    $clientes .= " WHERE razaosocial LIKE '%{$nome_cliente}%' or cpfcnpj LIKE '%{$nome_cliente}%'  ";
}

$resultado = mysqli_query($conecta, $clientes);
if(!$resultado){
    die("Falha na consulta ao banco de dados");
    
}

?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/estilo.css" rel="stylesheet">
    <link href="../_css/tela_pesquisa.css" rel="stylesheet">

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>



    <main>
        <div id="janela_pesquisa_Cliente">


            <input type="submit" name="cadastar_cliente" value="Adicionar" onclick="return abrepopupcliente();">

            <form action="consulta_cliente.php" method="get">

                <input type="text" name="cliente" placeholder="pesquisa">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />


            </form>


        </div>

        <div id="menu">
            <ul>
                <p>Razão social</p>
                <li>Cpf/Cnpj</li>
                <li>Cidade</li>
                <li>Bairro</li>
                <li>Fornecedor/CLiente</li>

            </ul>

        </div>

        <div id="listagem_cliente">
            <?php
           if(isset($_GET["cliente"])){
           while($linha = mysqli_fetch_assoc($resultado)){
           ?>



            <ul>

                <p> <?php echo utf8_encode($linha["razaosocial"])?> </p>
                <li> <?php echo formatCnpjCpf($linha["cpfcnpj"])?></li>
                <li><?php echo utf8_encode($linha["cidade"])?></li>
                <li><?php echo utf8_encode($linha["bairro"])?></li>
                <li> <?php if ($linha["clienteftID"] == 1){
                    echo  "CLIENTES";
                    }
                    if ($linha["clienteftID"] == 2){
                        echo  "FORNECEDOR";
                        }

                        if ($linha["clienteftID"] == 3){
                            echo "TRANSPORTADOR";
                            }?></li>


                <a href="editar_cliente.php?codigo=<?php echo $linha["clienteID"]?>">
                    <input type="submit" value="Editar" name="editar"> </input>
                </a>

            </ul>


            <?php
             }
            }
            ?>
        </div>


    </main>


</body>

<script>
//abrir uma nova tela de cadastro
function abrepopupcliente() {

    var janela = "cadastro_cliente.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>