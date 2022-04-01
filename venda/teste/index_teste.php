<?php 
session_start();






if(isset($_SESSION['venda'])){
}else{
    $_SESSION['venda'] = array();
}


if (isset($_GET["enviar"])){
    print_r($_SESSION['venda']);
    echo '</br>';
    $_GET['id']+=1;
    if($_GET['id'] == ""){
        $_GET['id'] =  0;
    }else{
        $id = $_GET['id'];
        $contador = $id + 1;
    }
    }
  
    if(isset($_GET['id'])){
        array_push($_SESSION['venda'], $_GET);
        var_dump( $_SESSION['venda']);
        
      
    }

    if(isset($_GET['del'])){
        $delete = $_GET['del'];
        unset($_SESSION['venda'][$delete]);
        var_dump( $_SESSION['venda'],[$delete]);
    }
    

require_once("../../conexao/conexao.php");
         

/*
if(isset($_GET['teste'])){
    $_SESSION['venda'] = [];
}

*/


/*
if(isset($_GET['del'])){
    print_r($_SESSION['venda']);
    $del = $_GET['del'];
   
  
  
   }
   */

?>


<?php 

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


    <form action="index_teste.php" method="get">
        <input type="text" id="id" name="id" value="">
        <input type="text" id="campo" name="campo">
        <input type="text" id="qtd" name="qtd">
        <input type="text" id="valor" name="valor">

        <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"></input>



        <table width="700" border="1">
            <tr>
                <td>id</td>
                <td>Produto</td>
                <td>Quantidade</td>
                <td>valor</td>
                <td>Ações</td>
            </tr>

            <?php
        foreach($_SESSION['venda'] as  $chave => $valor):
                if(isset($valor['campo'])){
                echo '<tr>';
                echo '<td>'.$chave  .'</td>';
                echo '<td>'. ($valor['campo']) .'</td>';
                echo '<td>'. ($valor['qtd']) .'</td>';
                echo '<td>'. ($valor['valor']) .'</td>';
                echo '<td><a href="index_teste.php?del='.$chave.'"> X </a></td>';
                

                echo '</tr>';
                

                
            }
        endforeach;


        ?>

        </table>

</body>

</html>