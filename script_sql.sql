


insert into usuarios values (null, 'pdmr123@hotmail.com','pedro','henrique','adm');
insert into ativo values (null, 'SIM');
insert into ativo values (null, 'NAO');

insert into categoria_produto values (null, 'HIDRÁULICO');
insert into categoria_produto values (null, 'INFORMÁTICA');
insert into categoria_produto values (null, 'DIVERSOS');
insert into categoria_produto values (null, 'ELÉTRICO');


describe clientes;

ALTER TABLE clientes ADD COLUMN informacao_bancaria VARCHAR(50);
ALTER TABLE clientes ADD COLUMN conta_agencia VARCHAR(50);
ALTER TABLE clientes ADD COLUMN pix VARCHAR(50);
ALTER TABLE clientes ADD COLUMN obeservacao VARCHAR(50);
ALTER TABLE clientes ADD COLUMN obeservacao VARCHAR(50);
ALTER TABLE clientes ADD COLUMN cpfcnpj VARCHAR(50);
ALTER TABLE clientes ADD COLUMN inscricao_estadual VARCHAR(50);
ALTER TABLE clientes ADD COLUMN fornecedor_cliente VARCHAR(30);
ALTER TABLE clientes ADD COLUMN nome_fantasia VARCHAR(100);
alter table produtos add column nome_categoria varchar(50);
alter table produtos add column nome_ativo varchar(50);


alter table clientes change clienteftID inscricao_estadual varchar(30) ;

alter table clientes change fornecedor_cliente clienteftID tinyint(3) ;

ALTER TABLE clientes ADD COLUMN bairro VARCHAR(50);


CREATE TABLE `forclietrans` (
  `clienteftID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nome` char(20) DEFAULT '0',
  PRIMARY KEY (`clienteftID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


drop table forclietrans;

insert into forclietrans values('null','CLIENTE');
insert into forclietrans values('null','FORNECEDOR');
insert into forclietrans values('null','TRANSPORTADOR');

delete from clientes where clienteID=93;

drop table produtos


CREATE TABLE `usuarios` (
  `usuarioID` int(8) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `usuario` varchar(10) DEFAULT NULL,
  `senha` varchar(10) DEFAULT NULL,
  `nivel` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`usuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*table de produtos */
CREATE TABLE `produtos` (
  `produtoID` int(11) NOT NULL AUTO_INCREMENT,
  `data_cadastro` date ,
  `nomeproduto` varchar(100) DEFAULT NULL,
  `precovenda` decimal(10,2) DEFAULT NULL,
  `precocompra` decimal(10,2) DEFAULT NULL,
  `estoque` mediumint(4) DEFAULT NULL,
  `unidade_medida` varchar(20) DEFAULT NULL,
  `categoriaID` tinyint(3) DEFAULT NULL,
  `ativoID` tinyint(3) DEFAULT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`produtoID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


insert into produtos values (null, '2022-03-11','CHAVE','1500.8','1200','5','UND',1,1,'teste');

CREATE TABLE `categoria_produto` (
  `categoriID` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(30) DEFAULT NULL,
   PRIMARY KEY (`categoriID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `ativo` (
  `ativoiID` int(7) NOT NULL AUTO_INCREMENT,
  `nome_ativo` varchar(20) DEFAULT NULL,
   PRIMARY KEY (`ativoiID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE `pedido_compra` (
  `pedidoID` int(11) NOT NULL AUTO_INCREMENT,
  `data_movimento` date,
  `numero_pedido_compra` varchar(10) DEFAULT NULL,
  `numero_orcamento` varchar(10) DEFAULT NULL,
  `data_emissao_nf` date,
  `data_pagamento` date,
  `forma_pagamento` varchar(30) DEFAULT NULL,
  `cliente` varchar(80) DEFAULT NULL,
  `produto` varchar(80) DEFAULT NULL,
  `status_da_compra` varchar(80) DEFAULT NULL,
  `status_do_pedido` varchar(80) DEFAULT NULL,
  `data_compra` date,
  `entrega_prevista` date,
  `entrega_realizada` date,
  `data_chegada` date,
  `valor_compra` decimal(10,2) DEFAULT NULL,
  `valor_venda` decimal(10,2) DEFAULT NULL,
  `quantidade` decimal(10,2) DEFAULT NULL,
  `desconto`  varchar(50) DEFAULT NULL,
  `margem` decimal(10,2) DEFAULT NULL,
  `unidade_medida` varchar(20) DEFAULT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pedidoID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


create table `forma_pagamento`(
`formapagamentoID` int(11)  NOT NULL AUTO_INCREMENT,
`nome` varchar(30) DEFAULT NULL,
`banco` varchar(30) DEFAULT NULL,
`statuspagamento` varchar(30) DEFAULT NULL,
primary key(`formapagamentoID`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

insert into forma_pagamento values(null,'BOLETO 30/60','','A RECEBER');
insert into forma_pagamento values(null,'BOLETO 30/60/90','','A RECEBER');
insert into forma_pagamento values(null,'A VISTA','','RECEBIDO');


create table status_pagamento(
statuspagamentoID int(5) not null auto_increment,
nome varchar(20) DEFAULT NULL,
primary key(statuspagamentoID)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

insert into status_pagamento values(null,'A RECEBER');
insert into status_pagamento values(null,'RECEBIDO');

describe pedido_compra;

select * from pedido_compra;

delete from pedido_compra where data_movimento = '2022-03-16';


create table status_compra(
statuscompraID int(5) not null auto_increment,
nome varchar(50) DEFAULT NULL,
primary key(statuscompraID)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

drop table status_compra;


insert into status_compra values(null,'Selecione');
insert into status_compra values(null,'Realizada');
insert into status_compra values(null,'Não realizada');
insert into status_compra values(null,'Realizada parcialmente');




create table status_pedido(
statuspedidoID int(5) not null auto_increment,
nome varchar(50) DEFAULT NULL,
primary key(statuspedidoID)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


drop table status_pedido;
insert into status_pedido values(null,'Não definido');
insert into status_pedido values(null,'Entrega antes do prazo');
insert into status_pedido values(null,'Entrega no prazo');
insert into status_pedido values(null,'Entrega fora do prazo');



update pedido_compra set entrega_realizada = null where pedidoID = 1;

select * from pedido_compra;

select clienteID.pedido_compra from ;

SELECT clientes.razaosocial from  clientes
inner join pedido_compra
on pedido_compra.clienteID = clientes.clienteID;


select  * from clientes where clienteID NOT IN (0);

CREATE TABLE `lancamento_financeiro` (
  `lancamentoFinanceiroID` int(11) NOT NULL AUTO_INCREMENT,
  `data_movimento` date,
   `data_a_pagar` date,
    `data_do_pagamento` date,
  `receita_despesa` varchar(20) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `forma_pagamentoID` tinyint(3) DEFAULT NULL,
  `clienteID` tinyint(3) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `grupoID` tinyint(3) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `observacao` varchar(300) DEFAULT NULL,
  
  PRIMARY KEY (`lancamentoFinanceiroID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

create table receita_despesa(
receita_despesaID int(5) not null auto_increment,
nome varchar(50) DEFAULT NULL,
primary key(receita_despesaID)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


insert into receita_despesa value(null,'Receita');
insert into receita_despesa value(null,'Despesa');

create table status_lancamento(
status_lancamentoID int(5) not null auto_increment,
nome varchar(50) DEFAULT NULL,
primary key(status_lancamentoID)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

create table grupo_lancamento(
grupo_lancamentoID int(5) not null auto_increment,
nome varchar(50) DEFAULT NULL,
primary key(grupo_lancamentoID)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
insert into grupo_lancamento value(null,'Selecione');
insert into grupo_lancamento value(null,'DESPESA FIXA - DESPESA');
insert into grupo_lancamento value(null,'DESPESA VARIAVEL - DESPESA');
insert into grupo_lancamento value(null,'CARNÊ - RECEITA');

insert into status_lancamento value(null,'Selecione');

insert into status_lancamento value(null,'Selecione');
insert into status_lancamento value(null,'Recebido');
insert into status_lancamento value(null,'A Receber');
insert into status_lancamento value(null,'Pago');
insert into status_lancamento value(null,'A Pagar');
insert into status_lancamento value(null,'Cancelado');

SELECT  clientes.razaosocial, grupo_lancamento.nome,forma_pagamento.nome, lancamento_financeiro.data_movimento, lancamento_financeiro.data_a_pagar, 
lancamento_financeiro.status,lancamento_financeiro.valor,lancamento_financeiro.documento,
lancamento_financeiro.receita_despesa
from  clientes
inner join lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID
inner join grupo_lancamento on lancamento_financeiro.grupoID = grupo_lancamento.grupo_lancamentoID
inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID
WHERE data_movimento BETWEEN '2022-09-20' and '2022-10-20' and clientes.razaosocial LIKE '%eletrocabos%' or lancamento_financeiro.documento LIKE '%eletrocabos%' 
;



SELECT clientes.razaosocial, pedido_compra.produto, pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, pedido_compra.data_chegada, pedido_compra.entrega_realizada, pedido_compra.entrega_prevista, pedido_compra.valor_compra, 
 pedido_compra.valor_venda from  clientes inner 
 join pedido_compra on pedido_compra.clienteID = clientes.clienteID 


 
describe lancamento_financeiro;

select * from lancamento_financeiro;

select data_movimento, receita_despesa, sum(valor) from lancamento_financeiro where receita_despesa = 'Receita' and data_movimento LIKE '%2022%';


SELECT  clientes.razaosocial, sum(valor_venda) as soma, pedido_compra.produto,pedido_compra.data_movimento,pedido_compra.margem, 
pedido_compra.numero_pedido_compra, pedido_compra.pedidoID, pedido_compra.data_chegada, pedido_compra.entrega_realizada, 
pedido_compra.entrega_prevista, pedido_compra.valor_compra,  pedido_compra.valor_venda
 from  clientes inner join pedido_compra on pedido_compra.clienteID = clientes.clienteID;


select ((sum(valor_venda), sum(valor_compra)) - margem)  from pedido_compra;


SELECT  produtos.produtoID, produtos.nomeproduto, produtos.precovenda,produtos.precocompra,produtos.estoque,  categoria_produto.nome_categoria as categoria_nome,
 ativo.nome_ativo as ativo_nome, produtos.unidade_medida from ativo 
 inner join 
 produtos on produtos.nome_ativo = ativo.ativoID
 INNER Join
 categoria_produto on produtos.nome_categoria = categoria_produto.categoriaID;
 
 SELECT  produtos.produtoID, produtos.nomeproduto, produtos.precovenda,produtos.precocompra,produtos.estoque,  categoria_produto.nome_categoria as categoria_nome, ativo.nome_ativo as ativo_nome, produtos.unidade_medida from ativo  inner join  produtos on produtos.nome_ativo = ativo.ativoID INNER Join categoria_produto on produtos.nome_categoria = categoria_produto.categoriaID

from  clientes inner join 
lancamento_financeiro on lancamento_financeiro.clienteID = clientes.clienteID 
inner join grupo_lancamento on lancamento_financeiro.grupoID = grupo_lancamento.grupo_lancamentoID 
inner join forma_pagamento on lancamento_financeiro.forma_pagamentoID = forma_pagamento.formapagamentoID ;



CREATE TABLE `cotacao` (
  `cotacaoID` int(11) NOT NULL AUTO_INCREMENT,
  `clienteID` tinyint(3),
  `produtoID` tinyint(3),
  `usuarioID` tinyint(3),
  `preco` decimal(10,2) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `observacao` varchar(300) DEFAULT NULL,

  PRIMARY KEY (`cotacaoID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE `vendas` (
  `id_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `preco` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total_venda` float NOT NULL,
  `dataCompra` date NOT NULL,
   PRIMARY KEY (`id_venda`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE `comprador` (
  `id_comprador` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `comprador` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `contato` varchar(120) NOT NULL,
  `dataCadastro` date NOT NULL,
   PRIMARY KEY (`id_comprador`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `teste` (
  `id_teste` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mensagem` varchar(50) NOT NULL,
   PRIMARY KEY (`id_teste`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE `lembrete` (
  `lembreteID` int(11) NOT NULL AUTO_INCREMENT,
  `data_lancamento` date DEFAULT NULL,
  `descricao` varchar(100) NOT NULL,
  `usuarioID` tinyint(3) DEFAULT NULL,
  `clienteID` tinyint(3) DEFAULT NULL,
  `statusID` tinyint(3) DEFAULT NULL,
  
   PRIMARY KEY (`lembreteID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `status_lembrete` (
  `statusLID` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  
   PRIMARY KEY (`statusLID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

insert into status_lembrete values (null,'Não inciado');
insert into status_lembrete values (null,'Não inciado');
insert into lembrete values (null,'2022-04-07','teste','1','2','1');

SELECT  lembrete.lembreteID, lembrete.descricao, clientes.razaosocial, usuarios.usuario, status_lembrete.descricao from clientes
 inner join 
 lembrete on lembrete.clienteID = clientes.clienteID
 INNER Join
 status_lembrete on lembrete.statusID = status_lembrete.statusID
 INNER Join
usuarios on lembrete.usuarioID = usuarios.usuarioID;

insert into clientes(cpfcnpj,inscricao_estadual,razaosocial,cidade,estadoID,endereco,clienteftID,bairro) values('44.983.435/0003-30','12.095.653-5','GRANEL QUÍMICA LTDA-SÃO LUIS I
','Sao Luis','10','PORTO DE ITAQUI','1','ITAQUI');
insert into clientes(cpfcnpj,inscricao_estadual,razaosocial,cidade,estadoID,endereco,clienteftID,bairro) values('44.983.435/0010-60','','GRANEL QUÍMICA LTDA SÃO LUIS II
','Sao Luis','10','RTN do Itaqui','1','ITAQUI');
insert into clientes(cpfcnpj,inscricao_estadual,razaosocial,cidade,estadoID,endereco,clienteftID,bairro) values('05.300.197/0001-06','','ROFE DISTRIBUIDORA','Sao Luis','10','AV. 9','2','MAIOBÃO');

insert into clientes(cpfcnpj,inscricao_estadual,razaosocial,cidade,estadoID,endereco,clienteftID,bairro) values('44.983.435/0003-30','12.095.653-5','GRANEL QUÍMICA LTDA-SÃO LUIS I
','Sao Luis','10','PORTO DE ITAQUI','1','ITAQUI');
  
 
SELECT MAX(id_comprador) FROM comprador;


INSERT into cotacao values(null,'1','1','1',150,'0000-00-00','TESTE');


CREATE TABLE `produto_cotacao` (
  `produto_cotacao` int(11) NOT NULL AUTO_INCREMENT,
  `cotacaoID` tinyint(3),
  `descricao` varchar(10),
  PRIMARY KEY (`produto_cotacao`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `frete` (
  `freteID` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30),
  PRIMARY KEY (`freteID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `status_produto_cotacao` (
  `status_produtoID` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30),
  PRIMARY KEY (`status_produtoID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
insert into status_produto_cotacao values(null,'Aberto');
insert into status_produto_cotacao values(null,'Ganho');
insert into status_produto_cotacao values(null,'Perdido');

insert into frete values(null,'Selecione');
insert into frete values(null,'Por conta do emitente - Cif');
insert into frete values(null,'Por conta do destinatario - Fob');
insert into frete values(null,'terceiros');

TRUNCATE table frete;
select * from frete;

update frete set descricao = 'Terceiros' where freteID = 4 ;

CREATE TABLE `situacao_proposta` (
  `situacaoID` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30),
  PRIMARY KEY (`situacaoID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

insert into situacao_proposta values(null,'Selecione');
insert into situacao_proposta values(null,'Aberta');
insert into situacao_proposta values(null,'Ganha');
insert into situacao_proposta values(null,'Ganha/Parcial');
insert into situacao_proposta values(null,'Perdida');
insert into situacao_proposta values(null,'Perdida/Parcial');



alter table produto_cotacao add column quantidadeProduo decimal(10,2) DEFAULT NULL;
alter table produto_cotacao add column precoCompra decimal(10,2) DEFAULT NULL;
alter table produto_cotacao add column precoVenda decimal(10,2) DEFAULT NULL;
alter table produto_cotacao add column margem decimal(10,2) DEFAULT NULL;


alter table cotacao add column $compradorID tinyint(3);
alter table cotacao add column freteID tinyint(3);
alter table cotacao add column status_proposta tinyint(3);
alter table cotacao add column numero_solicitacao varchar(20);
alter table cotacao add column forma_pagamentoID tinyint(3);
alter table cotacao add column data_recebida date not null;
alter table cotacao add column data_envio date not null;
alter table cotacao add column data_responder date not null;
alter table cotacao add column data_fechamento date not null;
alter table cotacao add column dias_negociacao int(10);
alter table cotacao add column prazo_entrega int(10);
alter table cotacao add column numero_orcamento int(10);
alter table cotacao add column validade int(10);
alter table produto_cotacao add column unidade varchar(20);
alter table produto_cotacao add column status varchar(20);


 SELECT cotacao.numero_orcamento, cotacao.cliente, cotacao.status_proposta,cotacao.validade,cotacao.data_responder,cotacao.data_envio,cotacao.data_envio,
 cotacao.data_fechamento,clientes.razaosocial,situacao_proposta.descricao from clientes
 inner join cotacao on cotacao.clienteID = clientes.clienteID;
 
 
SELECT cotacao.numero_orcamento, clientes.razaosocial,situacao_proposta.descricao as Situacao, cotacao.validade,cotacao.data_responder,cotacao.data_envio, cotacao.data_fechamento from clientes inner join cotacao on cotacao.clienteID = clientes.clienteID INNER Join situacao_proposta on cotacao.status_proposta = situacao_proposta.statusID ; 
 
set @posicao:=0;
select 

status_proposta from cotacao;

SET @posicao:=0; SELECT @posicao:=@posicao+1 as posicao, produto_cotacao,descricao,quantidade,preco_compra,preco_venda from produto_cotacao;
 SELECT @posicao:=@posicao+1 as posicao, cotacaoID,descricao,quantidade,preco_compra,preco_venda,margem from produto_cotacao ;

SET @posicao:=0;
SELECT margem, @posicao:=@posicao+1 as posicao from  produto_cotacao  ;

