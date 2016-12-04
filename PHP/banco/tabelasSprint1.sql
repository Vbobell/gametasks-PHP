-- Database: "gameTasks"

-- DROP DATABASE "gameTasks";

CREATE DATABASE "gameTasks"
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'Portuguese_Brazil.1252'
       LC_CTYPE = 'Portuguese_Brazil.1252'
       CONNECTION LIMIT = -1;

/*Comandos para reiniciar a base*/
drop table usuario, tarefa, desenvolvimento;

/*criação de tabelas*/
create table usuario(
	idUsuario int not null AUTO_INCREMENT,
	nome varchar(50) not null,
	senha varchar(20) not null,
 	CPF varchar(11) not null UNIQUE,
	funcao char(20) not null,

	primary key (idUsuario));

create table tarefa(
	idTarefa int not null AUTO_INCREMENT,
	titulo varchar (100) not null,
	descricao text not null,
	status varchar (20) not null,
	valor int not null,
	dataInicio date not null,
	dataLimite date not null,
	primary key (idTarefa));
	

create table desenvolvimento(
	idDesenvolvimento int not null AUTO_INCREMENT,
	idUsuario int not null,
	idTarefa int not null,
	dataEntrega date not null,
	dataTermino date,

	primary key (idDesenvolvimento),
	foreign key (idUsuario) references usuario (idUsuario),
	foreign key (idTarefa) references tarefa (idTarefa)
);

insert into usuario values(1,'teste','123456789','a');
INSERT INTO `tarefa`(`titulo`, `descricao`, `status`, `valor`, `dataInicio`, `dataLimite`) VALUES ( "tarefa","teste","aberta",100,"2010-10-10","2010-10-10")
INSERT INTO `desenvolvimento`(`idDesenvolvimento`, `idUsuario`, `idTarefa`, `dataEntrega`, `dataTermino`) VALUES (1,1,1,"2016-09-19","2016-09-19")