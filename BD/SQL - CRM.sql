-- Criação do Base de Dados
create database crm;

-- Criação da Tabela
create table Usuarios (
	nome VARCHAR(50) NOT NULL,
    login VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(50) NOT NULL,
    tipo VARCHAR(10) NOT NULL
);

-- Definição de Constraints
alter table Usuarios
add constraint pk_login primary key (login);

alter table Usuarios
add constraint accepted_types check (tipo = 'Client' or tipo = 'Admin');

-- Inserção no Banco
insert into usuarios
(nome, login, email, senha, tipo)
values ('Paulo Borges', 'paulo', 'paulobmatos17@gmail.com', md5('paulo'), 'Admin');

insert into usuarios
(nome, login, email, senha, tipo)
values ('Debora Liliane', 'debora', 'deboraliliane81@gmail.com', md5('debora'), 'Admin');

insert into usuarios
(nome, login, email, senha, tipo)
values ('David Jansen', 'david', 'davidwalterjansen@gmail.com2', md5('david'), 'Admin');

-- Visualizar tuplas completas
select * from usuarios;