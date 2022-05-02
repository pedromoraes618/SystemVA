<?php require_once("../conexao/conexao.php"); ?>
<?php

include("../conexao/sessao.php");



  
    //consultar
    if(isset($_GET["campoPesquisa"]) && ["campoPesquisaData"] && ["campoPesquisaDataf"])  {

        $pesquisaData = $_GET["campoPesquisaData"];
        $pesquisaDataf = $_GET["campoPesquisaDataf"];
     
    
        if($pesquisaData==""){
              
        }else{
            $div1 = explode("/",$_GET['campoPesquisaData']);
            $pesquisaData = $div1[2]."-".$div1[1]."-".$div1[0];  
           
        }
        if($pesquisaDataf==""){
           
        }else{
        $div2 = explode("/",$_GET['campoPesquisaDataf']);
        $pesquisaDataf = $div2[2]."-".$div2[1]."-".$div2[0];
        }
    
      

    $select = " SELECT nfe_entradaID,numero_nf,razao_social,cnpj_cpf,prot_autorizacao,data_entrada,data_emissao,valor_total_nota,valor_total_produtos,valor_desconto from tb_nfe_entrada" ;
    $pesquisa = $_GET["campoPesquisa"];
    $select .= " WHERE data_emissao BETWEEN '$pesquisaData' and '$pesquisaDataf' and  numero_nf  LIKE '%{$pesquisa}%'  ";
    $resultado = mysqli_query($conecta, $select);
    if(!$resultado){
        die("Falha na consulta ao banco de dados");
        
    }else{
            
    }
}

//recuperar valores via get
if (isset($_GET["campoPesquisaData"])){
    $pesquisaData=$_GET["campoPesquisaData"];
  }
  if (isset($_GET["campoPesquisaDataf"])){
    $pesquisaDataf=$_GET["campoPesquisaDataf"];
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

    <a href="https://icons8.com/icon/59832/cardápio"></a>
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include("../_incluir/body.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>


    <main>

        <div id="janela_pesquisa">
            <ul>
                <li>
                    <b> Data emissão</b>
                </li>

            </ul>
            <a
                onclick="window.open('importaXML/index.php', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">
                <input type="submit" style="width:120px;" name="importar_xml" value="Importar_xml">
            </a>



            <form style="width:1500px;" action="" method="get">



                <input style="width: 100px; " type="text" id="campoPesquisaData" name="campoPesquisaData"
                    placeholder="Data incial" onkeyup="mascaraData(this);" value="<?php if( !isset($_GET["campoPesquisa"])){ echo formatardataB(date('Y-m-01')); }
                              if (isset($_GET["campoPesquisaData"])){
                                 echo $pesquisaData;
                     }?>">



                <input style=" width: 100px;" type="text" name="campoPesquisaDataf" placeholder="Data final"
                    onkeyup="mascaraData(this);" value="<?php if(!isset($_GET["campoPesquisa"])){ echo date('d/m/Y');
                    } if (isset($_GET["campoPesquisaDataf"])){ echo $pesquisaDataf;} ?>">



                <input style="margin-left:300px;" type="text" name="campoPesquisa" value="<?php if(isset($_GET['campoPesquisa'])){echo $pesquisa;
                } ?>" placeholder="pesquisa / Nº Orçamento">
                <input type="image" name="pesquisa" src="https://img.icons8.com/ios/50/000000/search-more.png" />




            </form>


        </div>

        <form action="" method="get">

            <table border="0" cellspacing="0" width="100%" class="tabela_pesquisa">
                <tbody>
                    <tr id="cabecalho_pesquisa_consulta">


                        <td>
                            <p>Código</p>
                        </td>
                        <td>
                            <p>Nº NFE</p>
                        </td>

                        <td>
                            <p>Data Entrada</p>
                        </td>
                        <td>
                            <p>Empresa</p>
                        </td>
                        <td>
                            <p>Nº protocolo</p>
                        </td>


                        <td>
                            <p>Data emissão</p>
                        </td>
                        <td>
                            <p>VL produtos</p>
                        </td>
                        <td>
                            <p>Desconto</p>
                        </td>

                        <td>
                            <p>VL Nota</p>
                        </td>


                        <td>
                            <p></p>
                        </td>




                    </tr>
                    <?php   
                    if(isset($_GET["campoPesquisaData"])){
                
           while($linha = mysqli_fetch_assoc($resultado)){
                
            $nfeID = $linha["nfe_entradaID"];
            $numeroNF = $linha["numero_nf"];
            $razaoSocial = $linha["razao_social"];
            $cnpj = $linha["cnpj_cpf"];
            $protocolo = $linha["prot_autorizacao"];
            $dataEntrada = $linha["data_entrada"];
            $dataEmissao = $linha["data_emissao"];
            $valorNota = $linha["valor_total_nota"];
            $valorProduto = $linha["valor_total_produtos"];
            $valorDesconto= $linha["valor_desconto"];
         

         
           ?>


                    <tr id="linha_pesquisa">

                        <td style="width:80px;">
                            <p>
                                <font size="3" style="margin-left:20px"><?php echo $nfeID;?>
                                </font>
                            </p>
                        </td>

                        <td style="width:100px;">
                            <p>
                                <font size="3"><?php echo  $numeroNF;?>
                                </font>
                            </p>
                        </td>


                        <td style="width:120px;">
                            <font size="2"> <?php if($dataEntrada=="0000-00-00") {
                               echo ("");

                                  }elseif($dataEntrada=="1970-01-01"){

                                    echo ("");

                                  }else{echo formatardataB($dataEntrada); } ?></font>
                        </td>

                        <td style="width:350px;">
                            <font size="2"><?php echo utf8_encode($razaoSocial)?></font>
                        </td>
                        <td style="width:150px;">
                            <font size="2"> <?php echo utf8_encode($protocolo)?>
                            </font>
                        </td>

                        <td style="width:100px;">
                            <font size="2"> <?php echo formatardataB($dataEmissao)?></font>
                        </td>

                        <td style="width:100px;">
                            <font size="2"> <?php echo real_format($valorProduto)?></font>
                        </td>
                        <td style="width:100px;">
                            <font size="2"> <?php echo real_format($valorDesconto)?></font>
                        </td>


                        <td style="width:100px;">
                            <font size="2"> <?php echo real_format($valorNota)?></font>
                        </td>




                        <td id="botaoEditar">



                            <a
                                onclick="window.open('editar_nota_fiscal.php?codigo=<?php echo $numeroNF;?>', 
'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1500, HEIGHT=900');">

                                <button type="button" name="Editar">Editar</button>

                            </a>


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
    window.open(janela, 'popuppageCadastrar',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}

function abrepopupEditarCliente() {

    var janela = "editar_cliente.php?codigo=<?php  
       if(isset($_GET["cliente"])){
        while($linha = mysqli_fetch_assoc($resultado)){
         $Idcliente = $linha["clienteID"];
        
        }
    }

    ?>";
    window.open(janela, 'popuppageEditar',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=800,top=100,left=100');
}
</script>

</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>