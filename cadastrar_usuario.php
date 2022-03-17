<?php require_once("conexao/conexao.php"); 

//adicionar a variavel de sessão
session_start();

//inserção no banco de dados
if(isset($_POST["usuario"])){
   
    $usuario = utf8_decode($_POST["usuario"]);
    $senha = utf8_decode($_POST["senha"]);
    $email = utf8_decode($_POST["email"]);
    $nivel = utf8_decode($_POST["nivel"]);

    $inserir = "INSERT INTO usuarios ";
    $inserir .= "(email,usuario,senha,nivel)";
    $inserir .= " Values ";
    $inserir .= "('$email','$usuario','$senha','$nivel')";
    
    $operacao_inserir = mysqli_query($conecta, $inserir);

    if(!$operacao_inserir){
        die("Erro no banco de dados Linha 21 inserir_transportadora");
    }

   



}


?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/login.css" rel="stylesheet">
    </head>

    <body>
      
        <?php include_once("_incluir/funcoes.php"); ?>
        
        <main>  
            <div id="janela_principal">
                <form action="cadastrar_usuario.php" method="post">
                    <h2>Cadastro</h2>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuário" required placeholder="Digite o seu usuario">
                    <input type="password" name="senha" placeholder="Senha" required placeholder="Digite a sua senha">
                    <input type="email" name="email" id="email" placeholder="Digite o seu Email" ></input>
                    
                            <select name="nivel">
                                <option value="Administrador1">Administrador</option>
                                <option value="usuario">usuario</option>
                            </select>

                
                    <input type="submit" name="cadastrar" placeholder="cadastrar" value="Cadastrar">
                    <?php
                  
                  if(isset($_POST["usuario"])){
                    ?>
                        <p>
                        <?php
                    
                       print_r ("Cadastrado com sucesso");

                        ?>    
                        <p>

                    <?php
                     }
                    ?>
                    <div id="footer">
                    <p><a href="login.php">Login<a></a>
                    </div>  
                
            </div>

            
        </main>

      
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>