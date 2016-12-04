-- Database: "gameTasks"

-- DROP DATABASE "gameTasks";

CREATE DATABASE "gameTasks";

/*Comandos para reiniciar a base*/
drop table usuario, tarefa, relacaoEquipe;

/*criação de tabelas*/
create table usuario(
	idUsuario int not null AUTO_INCREMENT PRIMARY key,
	nome varchar(50) not null,
	email varchar(50) not null,
	senha varchar(20) not null,
 	CPF varchar(11) not null UNIQUE,
	funcao char(20) not null,
	foto varchar(50) not null,
	xpMes int not null DEFAULT 0,
	xpTotal int not null DEFAULT 0
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
	idEquipe int not null AUTO_INCREMENT PRIMARY key,
	idTarefa int not null,
	idUsuario int not null,
	foreign key (idTarefa) references tarefa (idTarefa),
	foreign key (idUsuario) references usuario (idUsuario)
);


-- inserir usuario
insert into usuario (nome, email, senha, CPF, funcao, foto)
	values('teste1','teste1@teste1','senha1','123','DBA','/teste');
	
-- inserir tarefa
INSERT INTO tarefa (mestre, titulo, descricao, status, valorXP, dataInicio, dataLimite)
	VALUES (1,'tarefa','teste','aberta',100,'2010-10-10','2010-10-10');

-- inserir relacao de equipe	
INSERT INTO relacaoEquipe (idTarefa, idUsuario)
	VALUES (1,1);