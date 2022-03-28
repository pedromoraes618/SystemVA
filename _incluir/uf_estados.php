<html>

<?php

require_once("../conexao/conexao.php");

$select = "SELECT estadoID, nome from estados";
$lista_estados = mysqli_query($conecta,$select);
if(!$lista_estados){
    die("Falaha no banco de dados  Linha 31 inserir_transportadora");
}
?>

<select name="estados">

    <?php while($linha = mysqli_fetch_assoc($lista_estados)){
             $estadosPrincipal = utf8_encode($linha["estadoID"]);
                         if(!isset($estados)){
                               
                               ?>
    <option value="<?php echo utf8_encode($linha["estadoID"]);?>">
        <?php echo utf8_encode($linha["nome"]);?>
    </option>
    <?php
                               
                               }else{
   
                                if($estados==$estadosPrincipal){
                                ?> <option value="<?php echo utf8_encode($linha["estadoID"]);?>" selected>
        <?php echo utf8_encode($linha["nome"]);?>
    </option>

    <?php
                                         }else{
                                
                               ?>
    <option value="<?php echo utf8_encode($linha["estadoID"]);?>">
        <?php echo utf8_encode($linha["nome"]);?>
    </option>
    <?php
   
           }
           
       }
   
                             
   }
     ?>

</select>






</html>