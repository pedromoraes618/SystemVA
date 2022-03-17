<?php require_once("../../conexao/conexao.php"); 

//adicionar a variavel de sessão
session_start();

if(isset($_POST["usuario"])){
    $usuario =  $_POST["usuario"];
    $senha =  $_POST["senha"];

    $login = "SELECT * FROM usuarios WHERE usuario = '{$usuario}' and senha='{$senha}'";

    $acesso = mysqli_query($conecta, $login);

    if( !$acesso ){
        die("Falha na consulta ao banco de dados");
    }

    $informacao = mysqli_fetch_assoc($acesso);
    if (empty($informacao)){
        $mensagem = "login sem sucesso";
    
    }else{
        $_SESSION["user_portal"] = $informacao["usuarioID"];
        header("Location:../unidade_04/inicial.php");

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
      
        <?php include_once("../_incluir/funcoes.php"); ?>
        
        <main>  
            <div id="janela_login">
                <form action="login.php" method="post">
                    <h2>Login</h2>
                   <p class="textousuario">Usuário</p>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuário" required placeholder="Digite o seu usuario">
                    <p class="textosenha">Senha</p>
                    <input type="password" name="senha" placeholder="Senha" required placeholder="Digite a sua senha">
                    <input type="checkbox" name="conectado" id="conectado" ><label for="conectado"> Manter conectado</label>
                    <input type="submit" name="Login" placeholder="Login">
                    
                    <?php
                    if(isset ($mensagem)){

                    ?>
                        <p>
                        <?php
                        echo $mensagem;
                        ?>    
                        <p>


                    <?php
                     }
                    ?>
                <div id="footer">
                    <p><a href="Cadastrar_usuario.php">Cadastre-se<a></a>
                    </div>  
            </div>
        </main>

      
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>