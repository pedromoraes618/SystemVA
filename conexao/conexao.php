<?php
//passo1 criando a conexão com o banco de dados
$servidor="localhost";
$usuario="root";
$senha="";
$banco="sistemaphp";
$conecta=mysqli_connect($servidor, $usuario, $senha, $banco);

//passo2 verificando se a conexão com o banco de dados
if(mysqli_connect_errno()){
    die("conexão falhou:".mysqli_connect_errno());
}

?>
