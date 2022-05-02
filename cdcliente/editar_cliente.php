<?php
require_once("../conexao/conexao.php");

include("../conexao/sessao.php");


include_once("../_incluir/funcoes.php");
//inportar a classe com as variaveis do banco de dados
include("../classes/cliente/editar_cliente.php");

?>
<!doctype html>

<html>



<head>
    <meta charset="UTF-8">
    <!-- estilo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="../_css/tela_cadastro_editar.css" rel="stylesheet">

</head>

<body>
    <div id="titulo">
        </p>Dados do Cliente</p>
    </div>
    <div class="tab" style="width: 1500px;">
        <button class="tablinks" onclick="openCity(event, 'p1')" id="defaultOpen">Dados básicos</button>
        <button class="tablinks" onclick="openCity(event, 'p2')">Dados bancário</button>

    </div>

    <main>
        <div style="margin:0 auto; width:1500px; ">
            <form action="" method="post">



                <div id="p1" class="tabcontent">
                    <table style="float:left; width:700px;">
                        <div style="width: 700px; ">
                            <tr>
                                <td>
                                    <label for="txtcodcliente" style="width:120px;"> <b>Código:</b></label>
                                    <input readonly type="text" size="10" id="txtcodcliente" name="txtcodcliente"
                                        value="<?php echo $clienteID;?>">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="txtrazaosocial" style="width:120px;"> <b>Razão Social:</b></label>
                                    <input type="text" size=55 name="txtrazaosocial" id="txtrazaosocial"
                                        value="<?php echo $razao_social ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cpfcnpj" style="width:120px;"> <b>Cnpj/Cpf:</b></label>
                                    <input type="text" size=30 name="cpfcnpj" id="cpfcnpj"
                                        value="<?php echo formatCnpjCpf($cpfcnpj)?>">
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <label for="cidade" style="width:120px;"> <b>Cidade:</b></label>
                                    <input required type="text" size=30 name="cidade" value="<?php echo $cidade ?>">

                                    <label for="estados"><b>UF:</b></label>
                                    <select id="estados" name="estados">
                                        <?php 
                           $meuestado =  $estados;
                           while($linha=mysqli_fetch_assoc($lista_estados)){
                           $estado_principal  = $linha["estadoID"];
                           if($meuestado==$estado_principal){

                         
                        ?>
                                        <option value="<?php echo $linha["estadoID"];?>" selected>
                                            <?php echo utf8_encode($linha["nome"]);?>
                                        </option>

                                        <?php
                         }else{
                         ?>
                                        <option value="<?php echo $linha["estadoID"];?>">
                                            <?php echo utf8_encode($linha["nome"]);?>
                                        </option>
                                        <?php

                         }}
                         
                         ?>

                                    </select>

                                </td>


                            </tr>

                            <tr>
                                <td>
                                    <label for="email" style="width:120px;"> <b>Email:</b></label>
                                    <input type="email" size=30 id="email" name="email" value="<?php echo $email;?>">
                                </td>


                            </tr>

                            <tr>
                                <td>
                                    <label for="telefone" style="width:120px;"> <b>Telefone:</b></label>
                                    <input type="text" size=55 id="telefone" name="telefone"
                                        value="<?php echo $telefone?>">
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <label for="observacao " style="width:120px;"><b>Observação</b></label>
                                    <textarea rows=4 cols=60 name="observacao"
                                        id="observacao"><?php echo $observacao ?></textarea>
                                </td>

                            </tr>
                        </div>

                        <tr>

                            <td>
                                <div style="margin-left: 120px;margin-top:10px">
                                    <input type="submit" name="btnsalvar" value="Salvar"
                                        class="btn btn-info btn-sm"></input>
                                    <button type="button" onclick="fechar();" class="btn btn-secondary">Voltar</button>
                                    <input id="remover" type="submit" name="btnremover" value="Remover"
                                        class="btn btn-danger"
                                        onClick="return confirm('Confirma Remoção do CLienter? Verifique se o cliente tem movimentação');"></input>
                                    <input id="" type="submit" name="brncomprador" value="Comprador"
                                        class="btn btn-dark" onClick="abrepopupConsultaComprador();"></input>
                                </div>
                            </td>
                        </tr>

                    </table>



                    <table style="float:right; width:700px; margin-top:50px;">
                        <tr>
                            <td>
                                <label for="txtnomefantasia " style="width:120px;"><b>Nome Fantasia:</b></label>
                                <input type="text" size=50 id="txtnomefantasia" name="txtnomefantasia"
                                    value="<?php echo $nome_fantasia ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="inscricao_estadual" style="width:120px;"><b>Insc Estadual:</b></label>
                                <input type="text" size=30 id="inscricao_estadual" name="inscricao_estadual"
                                    value="<?php echo $inscricao_estadual ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="bairro" style="width: 120px;"><b>Bairro:</b></label>
                                <input type="text" size=20 name="bairro" id="bairro" value="<?php echo $bairro;?>">

                                <label for="fornecedor_cliente"><b>Clt/For:</b></label>
                                <select style="width: 175px;" id="fornecedor_cliente" name="fornecedor_cliente">

                                    <?php 
                           $cft_selecionado =  $clienteftID;
                           while($linha_cft = mysqli_fetch_assoc($lista_cft)){
                           $ctf_principal  = $linha_cft["clienteftID"];
                           if($cft_selecionado==$ctf_principal){
                               
                        ?>
                                    <option value="<?php echo $linha_cft["clienteftID"];?>" selected>
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>

                                    <?php
                         }else{
                         ?>
                                    <option value="<?php echo $linha_cft["clienteftID"];?>">
                                        <?php echo utf8_encode($linha_cft["nome"]);?>
                                    </option>
                                    <?php
                         }}
                         ?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="endereco" style="width:120px;"><b>Endereço:</b></label>
                                <input type="text" size=60 id="endereco" name="endereco"
                                    value="<?php echo $endereco;?>">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cep" style="width:120px;"><b>Cep:</b></label>
                                <input type="text" size=20 id="cep" name="cep"
                                    value="<?php echo $cep;?>">
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="p2" class="tabcontent">
                    <table style="float:left; width:100% ">
                        <tr>
                            <td>
                                <label for="informacao_bancaria" style="width:120px;"><b>Informação
                                        bancaria:</b></label>
                                <input type="text" size=60 id="informacao_bancaria" name="informacao_bancaria"
                                    value="<?php echo $informacao_bancaria?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="conta_agencia" style="width:120px;"><b>Conta Agência:</b></label>
                                <input type="text" size=30 id="conta_agencia" name="conta_agencia"
                                    value="<?php echo $conta_agencia?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="conta_agencia" style="width:120px;"><b>Pix:</b></label>
                                <input type="text" size=60 id="pix" name="pix" value="<?php echo $pix?>">
                            </td>
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


</html>

<script>
//abrir uma nova tela de cadastro
function abrepopupConsultaComprador() {
    var janela = "comprador_cl/consulta_comprador.php?cliente=<?php echo $clienteID;?>";
    window.open(janela, 'popuppage',
        'width=1500,toolbar=0,resizable=1,scrollbars=yes,height=700,top=100,left=100');
}

function fechar() {
    window.close();
}
</script>

<?php 
mysqli_close($conecta);
?>