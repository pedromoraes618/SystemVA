
class Produto{
    constructor(){
        this.id = 0;
        this.arrayProdutos = [];
     
    }
    salvar(){
       let produto = this.lerDados();
       if( this.validaCampos(produto)){
           this.adicionar(produto);
           document.getElementById('preco').value = "";
           document.getElementById('produto').value = "";


       }
        this.listaTabela(); 
        console.log(this.arrayProdutos)
        
    }
    
    listaTabela(){
        let tbody = document.getElementById('tbody');
        tbody.innerText = '';

        for(let i = 0; i< this.arrayProdutos.length; i++){
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

    adicionar(produto){
        this.arrayProdutos.push(produto);
        this.id++;

    }

    lerDados(){
            let produto = {}
            produto.id= this.id;
            produto.nomeProduto = document.getElementById('produto').value;
            produto.preco = document.getElementById('preco').value;
            return produto;
    }

    validaCampos(produto){
        let msg = '';

            if(produto.nomeProduto == ''){
                    msg += '- informe o nome do produto \n';  
            }

            if(produto.preco == ''){
                msg += '- informe o nome do produto \n';  
        }

        if(msg!=''){
            alert(msg);
            return false;
        }
        return true;
    }

    cancelar(){

        document.getElementById('preco').value = "";
     document.getElementById('produto').value = "";
    }


}

var produto = new Produto();
