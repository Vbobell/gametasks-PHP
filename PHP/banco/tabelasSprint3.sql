-- Database: "gameTasks"

-- DROP DATABASE "gameTasks";

CREATE DATABASE "gameTasks";

/*criação de tabelas*/
create table personagens(
	idPersonagem int not null AUTO_INCREMENT PRIMARY key,
    caminhoFoto varchar(50) not null,
	caminhoBanner varchar(50) not null
);

create table usuario(
	idUsuario int not null AUTO_INCREMENT PRIMARY key,
	nome varchar(50) not null,
	email varchar(50) not null,
	senha varchar(20) not null,
 	CPF varchar(11) not null UNIQUE,
	funcao char(20) not null,
	personagem int not null,
	xpMes double not null DEFAULT 0,
	xpTotal double not null DEFAULT 0,
    foreign key (personagem) references personagens(idPersonagem)
	);

create table tarefa(
	idTarefa int not null AUTO_INCREMENT PRIMARY key,
	mestre int not null,
	titulo varchar (100) not null,
	descricao text not null,
	status varchar (20) not null,
	valorXP int not null,
	dataInicio date not null,
	dataLimite date not null,
	foreign key (mestre) references usuario(idUsuario)
	);
	

create table relacaoEquipe(
	idEquipe int not null,
    idTarefa int not null,
	idUsuario int not null,
	statusMissao varchar (20) not null,
	primary key (idEquipe,idTarefa,idUsuario),
    foreign key (idTarefa) references tarefa (idTarefa),
	foreign key (idUsuario) references usuario (idUsuario)
);

create table comentario(
	idComentario int not null AUTO_INCREMENT PRIMARY key,
	idEquipe int not null,
	textoComentario text not null,
	foreign key (idEquipe) references relacaoEquipe (idEquipe)
);


-- inserir as fotos e o caminho das imagens.

insert into personagens (caminhoFoto,caminhoBanner) values ('/gametasks/imagens/mestre.png','/gametasks/imagens/bannerCinza.png');
insert into personagens (caminhoFoto,caminhoBanner) values ('/gametasks/imagens/arqueira.png','/gametasks/imagens/bannerRoxo.png');
insert into personagens (caminhoFoto,caminhoBanner) values ('/gametasks/imagens/guerreiro.png','/gametasks/imagens/bannerVermelho.png');
insert into personagens (caminhoFoto,caminhoBanner) values ('/gametasks/imagens/mago.png','/gametasks/imagens/bannerAzul.png');
insert into personagens (caminhoFoto,caminhoBanner) values ('/gametasks/imagens/goblim.png','/gametasks/imagens/bannerVerde.png');

-- inserir usuario
insert into usuario (nome, email, senha, CPF, funcao, personagem)
	values('admin','mestre@gametasks.com.br','123456','99988877766','gerente',1);

insert into usuario (nome, email, senha, CPF, funcao, personagem)
	values('arqueira','arqueira@gametasks.com.br','123456','12345678910','analista de testes',2);

insert into usuario (nome, email, senha, CPF, funcao, personagem)
	values('guerreiro','guerreiro@gametasks.com.br','123456','11122233344','desenvolvedor',3);

insert into usuario (nome, email, senha, CPF, funcao, personagem)
	values('mago','mago@gametasks.com.br','123456','22233344455','DBA',4);

insert into usuario (nome, email, senha, CPF, funcao, personagem)
	values('goblin','goblin@gametasks.com.br','123456','00000000000','Estágiario',5);
	
-- inserir tarefa
INSERT INTO tarefa (mestre, titulo, descricao, status, valorXP, dataInicio, dataLimite)
	VALUES (2,'O que é Lorem Ipsum','é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.','aberta',100,'2016-12-03','2016-12-03');

INSERT INTO tarefa (mestre, titulo, descricao, status, valorXP, dataInicio, dataLimite)
	VALUES (3,'O que é Lorem Ipsum','é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.','aberta',50,'2016-12-03','2016-12-03');

INSERT INTO tarefa (mestre, titulo, descricao, status, valorXP, dataInicio, dataLimite)
	VALUES (2,'O que é Lorem Ipsum','é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.','aberta',150,'2016-12-03','2016-12-03');

INSERT INTO tarefa (mestre, titulo, descricao, status, valorXP, dataInicio, dataLimite)
	VALUES (4,'O que é Lorem Ipsum','é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.','aberta',100,'2016-12-03','2016-12-03');

INSERT INTO tarefa (mestre, titulo, descricao, status, valorXP, dataInicio, dataLimite)
	VALUES (5,'O que é Lorem Ipsum','é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.','aberta',50,'2016-12-03','2016-12-03');

-- inserir relacao de equipe	
INSERT INTO relacaoEquipe (idTarefa, idUsuario)
	VALUES (1,2);

INSERT INTO relacaoEquipe (idTarefa, idUsuario)
	VALUES (2,3);

INSERT INTO relacaoEquipe (idTarefa, idUsuario)
	VALUES (3,2);

INSERT INTO relacaoEquipe (idTarefa, idUsuario)
	VALUES (3,4);

INSERT INTO relacaoEquipe (idTarefa, idUsuario)
	VALUES (5,5);


