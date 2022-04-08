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


    <main>
        <form action="" method="post">
            <div id="titulo">
                </p>Dados do Cliente</p>
            </div>


            <table width=100%>

                <tr>
                    <td>Código:</td>
                    <td align=left><input readonly type="text" size="10" id="txtcodcliente" name="txtcodcliente"
                            value="<?php echo $clienteID;?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Razão Social: *</b></td>
                    <td align=left><input type="text" size=60 name="txtrazaosocial" value="<?php echo $razao_social ?>">
                    </td>
                    <td><b>Nome Fantasia:</b></td>
                    <td><input type="text" size=60 id="txtnomefantasia" name="txtnomefantasia"
                            value="<?php echo $nome_fantasia ?>">
                    </td>
                </tr>

                <tr>
                    <td align=left><b>CPF/CNPJ:</b></td>
                    <td align=left><input type="text" size=60 name="cpfcnpj"
                            value="<?php echo formatCnpjCpf($cpfcnpj)?>"> </td>
                    <td><b>Inscrisão estadual:</b></td>
                    <td><input type="text" size=60 id="inscricao_estadual" name="inscricao_estadual"
                            value="<?php echo $inscricao_estadual ?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Cidade:</b></td>
                    <td align=left><input type="text" size=30 name="cidade" value="<?php echo $cidade ?>">
                        <!-- uf -->
                        <b>UF:</b>
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

                    <td align=left><b>Bairro:</b></td>
                    <td align=left><input type="text" size=30 name="bairro" value="<?php echo $bairro;?>"><b>C/F/T</b>

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
                    <td align=left><b>Email:</b></td>
                    <td align=left><input type="email" size=60 id="email" name="email" value="<?php echo $email;?>">
                    </td>
                    <td><b>Enderço:</b></td>
                    <td><input type="text" size=60 id="endereco" name="endereco" value="<?php echo $endereco;?>"> </td>
                </tr>

                <tr>
                    <td align=left><b>Telefone:</b></td>
                    <td align=left><input type="text" size=60 id="telefone" name="telefone"
                            value="<?php echo $telefone?>"> </td>
                    <td align=left><b>Informação bancaria:</b></td>
                    <td align=left><input type="text" size=60 id="informacao_bancaria" name="informacao_bancaria"
                            value="<?php echo $informacao_bancaria?>">
                    </td>
                </tr>

                <tr>
                    <td><b>Conta agência:</b></td>
                    <td><input type="text" size=30 id="conta_agencia" name="conta_agencia"
                            value="<?php echo $conta_agencia?>">
                    </td>
                    <td><b>Pix:</b></td>
                    <td><input type="text" size=60 id="pix" name="pix" value="<?php echo $pix?>"> </td>

                </tr>

                <tr>
                    <td align=left><b>Observação:<b></td>
                    <td><textarea rows=4 cols=60 name="observacao" id="observacao"><?php echo $observacao ?></textarea>
                    </td>
                </tr>


                <table width=100%>
                    <tr>
                        <div id="botoes">

                            <input type="submit" name="btnsalvar" value="Salvar" class="btn btn-info btn-sm"></input>

                            <a href="consulta_cliente.php">
                       
                                <button type="button"  class="btn btn-secondary">Voltar</button>

                                </a>

                            <input id="remover" type="submit" name="btnremover" value="Remover" class="btn btn-danger"
                                onClick="return confirm('Confirma Remoção do CLienter? Verifique se o cliente tem movimentação');"></input>


                            <input id="" type="submit" name="brncomprador" value="Comprador" class="btn btn-dark"
                                onClick="abrepopupConsultaComprador();"></input>
                        </div>
                    </tr>

                    </talbe>



        </form>

        </talbe>




    </main>
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