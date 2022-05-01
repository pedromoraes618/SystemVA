<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");


//inportar a classe com as variaveis do banco de dados
include("../classes/cliente/cadastro_cliente.php");


?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->

    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body>
    <div id="titulo">
        </p>Ficha Cadastral do Ciente</p>
    </div>

    <div class="tab" style="width: 1500px;">
        <button class="tablinks" onclick="openCity(event, 'p1')" id="defaultOpen">Dados básicos</button>
        <button class="tablinks" onclick="openCity(event, 'p2')">Dados bancário</button>

    </div>

    <main>
        <div style="margin:0 auto; width:1500px; ">
            <form action="cadastro_cliente.php" method="post">

                <div id="p1" class="tabcontent">
                    <table style="float:left; width:700px;">
                        <div style="width: 700px; ">

                            <tr>
                                <td>
                                    <label for="txtcodigo" style="width:120px;"> <b>Código:</b></label>
                                    <input readonly type="text" size=10 id="txtcodigo" name="txtcodcliente" value="">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="txtrazaosocial" style="width:120px;"> <b>Razão Social:</b></label>
                                    <input type="text" required size=55 name="txtrazaosocial" id="txtrazaosocial"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($razao_social);}?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cpfcnpj" style="width:120px;"> <b>Cnpj/Cpf</b></label>
                                    <input type="text" size=30 name="cpfcnpj" id="cpfcnpj"
                                        value="<?php if(isset($_POST['enviar'])){ echo $cpfcnpj ;}?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cidade" style="width:120px;"> <b>Cidade:*</b></label>
                                    <input required type="text" size=30 name="cidade" id="cidade"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($cidade);}?>">


                                    <label for="estados"><b>UF:</b></label>
                                    <select name="estados" id="estados">

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

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email" style="width:120px;"> <b>Email:</b></label>
                                    <input type="email" size=30 id="email" name="email"
                                        value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($email);}?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="telefone" style="width:120px;"> <b>Telefone:</b></label>
                                    <input type="text" size=55 id="telefone" name="telefone"
                                        value="<?php if(isset($_POST['enviar'])){ echo $telefone;}?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="observacao" style="width:120px;"> <b>Observação:</b></label>
                                    <textarea rows=4 cols=60 name="observacao"
                                        id="observacao"><?php if(isset($_POST['enviar'])){ echo utf8_encode($observacao);}?></textarea>
                                </td>
                            </tr>

                        </div>

                        <tr>

                            <td style=>
                                <div style="margin-left: 120px;margin-top:10px">
                                    <input type="submit" name=enviar value="Cadastrar" class="btn btn-info btn-sm"
                                        onClick="return confirm('Confirma o cadastro desse cliente?');"></input>

                                    <button type="button" onclick="fechar();" class="btn btn-secondary">Voltar</button>
                                </div>

                            </td>


                        </tr>



                    </table>


                    <table style="float:right; width:700px; margin-top:50px;">

                        <tr>
                            <td>
                                <label for="txtnomefantasia " style="width:120px;"><b>Nome Fantasia:</b></label>
                                <input type="text" size=50 id="txtnomefantasia" name="txtnomefantasia"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($nome_fantasia);}?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="inscricao_estadual" style="width:120px;"><b>Insc Estadual:</b></label>
                                <input type="text" size=20 id="inscricao_estadual" name="inscricao_estadual"
                                    value="<?php if(isset($_POST['enviar'])){ echo $inscricao_estadual;}?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="bairro" style="width: 120px;"><b>Bairro:</b></label>
                                <input type="text" size=20 name="bairro" id="bairro"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($bairro);}?>">
                                <label for="cft"><b>Cli/For:</b></label>
                                <select style="width: 168px;" name="cft" id="cft">

                                    <?php  while($linha_cft  = mysqli_fetch_assoc($lista_cft)){
                                    $clienteftPrincipal = utf8_encode($linha_cft["nome"]);
                                    if(!isset($clienteft)){

                                    ?>
                                    <option value="<?php echo utf8_encode($linha_cft["nome"]);?>">
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>
                                    <?php

                                    }else{

                                    if($clienteft==$clienteftPrincipal){
                                    ?> <option value="<?php echo utf8_encode($linha_cft["nome"]);?>" selected>
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>

                                    <?php
                                    }else{

                                    ?>
                                    <option value="<?php echo utf8_encode($linha_cft["nome"]);?>">
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>
                                    <?php

}

}


}

?>
                                </select>


                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="endereco" style="width:120px;"><b>Endereço:</b></label>
                                <input type="text" size=50 id="endereco" name="endereco"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($endereco);}?>">
                            </td>
                        </tr>

                    </table>




                </div>
                <div id="p2" class="tabcontent">
                    <table style="float:left; width:100% ">
                        <tr>
                            <td align=left style="width: 120px;"><b>Informação bancaria:</b></td>
                            <td align=left><input type="text" size=30 id="informacao_bancaria"
                                    name="informacao_bancaria"
                                    value="<?php if(isset($_POST['enviar'])){ echo utf8_encode($informacao_bancaria);}?>">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Conta agência:</b></td>
                            <td><input type="text" size=30 id="conta_agencia" name="conta_agencia"
                                    value="<?php if(isset($_POST['enviar'])){ echo $conta_agencia;}?>"> </td>
                        </tr>
                        <tr>
                            <td><b>Pix:</b></td>
                            <td><input type="text" size=30 id="pix" name="pix"
                                    value="<?php if(isset($_POST['enviar'])){ echo $pix;}?>"> </td>




                        </tr>
                    </table>
                </div>



            </form>
        </div>
    </main>
    <script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
    </script>
</body>


<script>
function fechar() {
    window.close();
}
</script>

</html>

<?php 

mysqli_close($conecta);
?>