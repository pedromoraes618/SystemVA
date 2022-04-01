<?php 
session_start();

if(isset($_GET['vendas']) && $_GET['del'] == "del"){
    $id = $_GET['del'];
    unset($_SESSION['vendas'][$id]);
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index_teste.php"/>';


}

?>