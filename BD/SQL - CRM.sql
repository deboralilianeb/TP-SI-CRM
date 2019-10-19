create database crm;

create table Usuario (
	nome VARCHAR(50) NOT NULL,
    login VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(50) NOT NULL,
    tipo ENUM('ADMIN', 'CLIENTE') NOT NULL
);

alter table Usuario
add constraint pk_login primary key (login);

-- Inserção de admins --

insert into usuario
(nome, login, email, senha, tipo)
values ('Paulo Borges', 'paulo', 'paulobmatos17@gmail.com', md5('paulo'), 'ADMIN');

insert into usuario
(nome, login, email, senha, tipo)
values ('Debora Liliane', 'debora', 'deboraliliane81@gmail.com', md5('debora'), 'ADMIN');

insert into usuario
(nome, login, email, senha, tipo)
values ('David Jansen', 'david', 'davidwalterjansen@gmail.com', md5('david'), 'ADMIN');

select * from usuario;
