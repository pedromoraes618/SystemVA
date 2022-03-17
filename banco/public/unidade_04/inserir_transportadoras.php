<?php require_once("../../conexao/conexao.php");


//inserção no banco de dados
if(isset($_POST["nometransportadora"])){
    $nome = utf8_decode($_POST["nometransportadora"]);
    $endereco = utf8_decode($_POST["endereco"]);
    $cidade = utf8_decode($_POST["cidade"]);
    $estado = $_POST["estados"];
    $cep = $_POST["cep"];
    $cnpj = $_POST["cnpj"];
    $telefone = $_POST["telefone"];

    $inserir = "INSERT INTO transportadoras ";
    $inserir .= "(nometransportadora,endereco,cidade,estadoID,cep,cnpj,telefone)";
    $inserir .= " Values ";
    $inserir .= "('$nome','$endereco','$cidade',$estado,'$cep','$cnpj','$telefone')";
    
    $operacao_inserir = mysqli_query($conecta, $inserir);
    if(!$operacao_inserir){
        die("Erro no banco de dados Linha 21 inserir_transportadora");
    }


}

//selecão dos estados 
$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
    die("Falaha no banco de dados  Linha 31 inserir_transportadora");
}

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/crud.css" rel="stylesheet">
    </head>

    <body>
          
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id="janela_formulario">
                <form action="inserir_transportadoras.php" method="post">
                    <input type="text" name="nometransportadora" placeholder="Nome da transportadora">
                    <input type="text" name="endereco" placeholder="Endereço">
                    <input type="text" name="telefone" placeholder="Telefone">
                    <input type="text" name="cidade" placeholder="Cidade">
                    <select name="estados">
                        <?php
                        while($linha=mysqli_fetch_assoc($lista_estados)){
                            ?>
                                <option value="<?php echo $linha["estadoID"];?>">
                                <?php echo utf8_encode($linha["nome"]);?>
                            
                            </option>

                            <?php
                            }
                            ?>
                        </select>
                    <input type="text" name="cep" placeholder="CEP">
                    <input type="text" name="cnpj" placeholder="CNPJ">
                    <input type="submit" name="enviar" value="enviar">
            
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>