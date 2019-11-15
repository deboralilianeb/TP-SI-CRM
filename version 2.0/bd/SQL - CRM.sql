-- Criação do Base de Dados
--create database crm;

-- Criação da Tabela
create table Usuarios (
	id SERIAL,
	nome VARCHAR(50) NOT NULL,
    login VARCHAR(25) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(256) NOT NULL,
    tipo VARCHAR(10) NOT NULL,
	estado BOOLEAN DEFAULT TRUE
);

-- Definição de Constraints
alter table Usuarios
add constraint pk_usuarios primary key (id);

alter table Usuarios
add constraint accepted_types check (tipo = 'Client' or tipo = 'Admin');

-- Inserção no Banco
insert into usuarios
(nome, login, email, senha, tipo)
values ('Paulo Borges', 'paulo', 'paulobmatos17@gmail.com', encode(sha384('paulo'), 'hex'), 'Admin');

insert into usuarios
(nome, login, email, senha, tipo)
values ('Debora Liliane', 'debora', 'deboraliliane81@gmail.com', encode(sha384('debora'), 'hex'), 'Admin');

insert into usuarios
(nome, login, email, senha, tipo)
values ('David Jansen', 'david', 'davidwalterjansen@gmail.com2', encode(sha384('david'), 'hex'), 'Admin');


-- Visualizar tuplas completas
select * from usuarios;