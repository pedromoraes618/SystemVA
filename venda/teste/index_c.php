<?php 
session_start();



if(isset($_SESSION['venda'])){

}else{
    $_SESSION['venda'] = array();
}

print_r($_SESSION['venda']);

require_once("../../conexao/conexao.php");

print_r($_SESSION['venda']);
if(isset($_GET['par'])){
    $produto = $_GET['par'];
   $_SESSION['venda'][$produto] = 1;

}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho compras</title>
</head>

<h1>Produtos</h1>

<body>



<?php

if(isset($_GET["Editar"])){
    $hoje = date('Y-m-d'); 
     $nproduto = utf8_decode($_GET["nproduto"]);}?>

    <span><input type="text" name="nproduto" id="nproduto"></input></span>
    <a href="index_c.php?par=<?php echo $nproduto?>">
        <button type="button" name="Editar">Editar</button>
    </a>
   

    <table width="700" border="1">
        <tr>
            <td>Produto</td>
            <td>valor</td>
            <td>Quantidade</td>
            <td>Ações</td>
        </tr>

        <?php
        foreach($_SESSION['venda'] as  $prod => $quantidade):
            $sqlcarrinho = "SELECT * from produtos where produtoID = '$prod' ";
            $sqlc = mysqli_query($conecta,$sqlcarrinho);
            $realassoc = mysqli_fetch_assoc($sqlc);
            if(!$realassoc){
                die("Falaha no banco de dados ||   falha de conexão de red || select clientes");
            }else{
                echo '<tr>';
                echo '<td>'.$realassoc['nomeproduto'] .'</td>';
                echo '<td>'.$realassoc['precovenda'].'</td>';
                echo '<td>'.$quantidade.'</td>';
                echo '<td>&nbsp;</td>';
                echo '</tr>';
            }

            endforeach
        ?>

    </table>
</body>

</html>