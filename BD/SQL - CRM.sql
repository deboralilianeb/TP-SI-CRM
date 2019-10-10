create database crm;

create table Usuario (
	nome VARCHAR(50) NOT NULL,
    login VARCHAR(25) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE,
    senha VARCHAR(30) NOT NULL,
    tipo ENUM('ADMIN', 'CLIENTE') NOT NULL
);

alter table Usuario
add constraint pk_login primary key (login);