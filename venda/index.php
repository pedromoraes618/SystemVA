<html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="js/style.css">
</head>

<body>
    <header>
        <h1>Minha loja</h1>
    </header>
  
        <main>
            <div class="title">
                <h2>Produtos</h2>
                <span>Lista de produtos da minha loja</span>

            </div>

            <div class="card">
                <div class="lineInput">
                    <label>produto</label>
                    <input type="text" name="produto" id="produto" placeholder="valor do produto">
                </div>

                <div class="lineInput">
                    <label>Preco</label>
                    <input type="text" id="preco" placeholder="Valor do produto">
                </div>

                <button name="salvar" id="salvar" onclick="produto.salvar();">Salvar</button>
                <button onclick="produto.cancelar();">Cancelar</button>
                <?php if(isset($_POST['salvar'])){
               print_r($_POST['produto']);
            }       
?>
            </div>

            <div class="content">
                <table border="1">
                    <thead>
                        <th class="center">ID</th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </thead>
                    <tbody id="tbody">

                    </tbody>

                </table>


            </div>
        </main>

</body>

</html>

<script>
class Produto {
    constructor() {
        this.id = 0;
        this.arrayProdutos = [];

    }
    salvar() {
        let produto = this.lerDados();
        if (this.validaCampos(produto)) {
            this.adicionar(produto);
            document.getElementById('preco').value = "";
            document.getElementById('produto').value = "";


        }
        this.listaTabela();
        console.log(this.arrayProdutos)

    }

    listaTabela() {
        let tbody = document.getElementById('tbody');
        tbody.innerText = '';

        for (let i = 0; i < this.arrayProdutos.length; i++) {
            let tr = tbody.insertRow();

            let td_id = tr.insertCell();
            let td_produto = tr.insertCell();
            let td_valor = tr.insertCell();
            let td_acores = tr.insertCell();

            td_id.innerText = this.arrayProdutos[i].id;
            td_produto.innerText = this.arrayProdutos[i].nomeProduto;
            td_valor.innerText = this.arrayProdutos[i].preco;
            td_id.classList.add('center');


        }
    }

    adicionar(produto) {
        this.arrayProdutos.push(produto);
        this.id++;

    }

    lerDados() {
        let produto = {}
        produto.id = this.id;
        produto.nomeProduto = document.getElementById('produto').value;
        produto.preco = document.getElementById('preco').value;
        return produto;
    }

    validaCampos(produto) {
        let msg = '';

        if (produto.nomeProduto == '') {
            msg += '- informe o nome do produto \n';
        }

        if (produto.preco == '') {
            msg += '- informe o nome do produto \n';
        }

        if (msg != '') {
            alert(msg);
            return false;
        }
        return true;
    }

    cancelar() {

        document.getElementById('preco').value = "";
        document.getElementById('produto').value = "";
    }


}

var produto = new Produto();
</script>