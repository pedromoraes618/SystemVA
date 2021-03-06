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

if(isset($_POST["editar"])){

    
}

$resultado = mysqli_query($conecta, $clientes);
if(!$resultado){
    die("Falha na consulta ao banco de dados");
    
}else{
    $dados_detalhe = mysqli_fetch_assoc($resultado);
    $Bcliente =  utf8_encode($dados_detalhe['razaosocial']);

}

?>
<!doctype html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- estilo -->
    <link href="../_css/estilo.css" rel="stylesheet">
    <link href="../_css/pesquisa_tela.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e8ff50f1be.js" crossorigin="anonymous"></script>
   
    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    

    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>
        <div id="janela_pesquisa">
           
            <form action="consulta_cliente.php" method="get">
                <input type="text" name="cliente" placeholder="pesquisa">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />
            </form>


        </div>

        <form action="../pdcompra/cadastro_pdcompra.php" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">
                        <td>
                            <p>Razão social</p>
                        </td>
                        <td>
                            <p>Cpf/Cnpj</p>
                        </td>
                        <td>
                            <p>Cidade</p>
                        </td>
                        <td>
                            <p>Bairro</p>
                        </td>


                        <td>
                            <p>Fornecedor</p>
                        </td>

                        <td>
                            <p></p>
                        </td>

                    </tr>

                    <?php
           if(isset($_GET["cliente"])){
           while($linha = mysqli_fetch_assoc($resultado)){
           ?>



                    <tr id="linha_pesquisa">

                        <td>
                            <p id="nome">
                                <font size="3"><?php echo utf8_encode($linha["razaosocial"])?>
                                </font>
                               
                            </p>
                        </td>

                        <td>
                            <font size="2"><?php echo formatCnpjCpf($linha["cpfcnpj"])?></font>
                        </td>
                        <td>
                            <font size="2"> <?php echo utf8_encode($linha["cidade"])?>
                            </font>
                        </td>

                        <td>
                            <font size="2"> <?php echo utf8_encode($linha["bairro"])?></font>
                        </td>

                        <td>
                            <font size="2"><?php if ($linha["clienteftID"] == 1){
                            echo  "CLIENTES";
                            }
                            if ($linha["clienteftID"] == 2){
                                echo  "FORNECEDOR";
                                }

                                if ($linha["clienteftID"] == 3){
                                    echo "TRANSPORTADOR";
                                    }?> </font>
                        </td>

                        



                        <td id="botaoSelect">
                        
                                <button type="button" id="botaoSelecione" class="btn btn-info" name="editar">Selecione</button>

                                    
                        </td>
                    </tr>



                    <?php
             }
            }
            ?>
                </tbody>
            </table>

        </form>

    </main>

</body>

<script>
//abrir uma nova tela de cadastro
function abrepopupcliente() {

    var janela = "cadastro_cliente.php";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function sendvaluecliente()
{
   window.close();	
}

</script>





</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>