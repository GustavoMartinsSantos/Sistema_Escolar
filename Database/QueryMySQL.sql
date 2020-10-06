CREATE database Sistema_Escolar;
USE Sistema_Escolar;

CREATE TABLE tbl_Pessoa (
    Email VARCHAR(30) PRIMARY KEY,
    Nome VARCHAR(30) NOT NULL,
    Sobrenome VARCHAR(30) NOT NULL,
    Senha CHAR(8) NOT NULL,
    Codigo_Acesso CHAR(10) NOT NULL UNIQUE,
    RG CHAR(9) NOT NULL,
    CPF CHAR(11) NOT NULL UNIQUE,
    Data_Nasc DATE NOT NULL,
    Estado CHAR(2) NOT NULL,
    Cidade VARCHAR(30) NOT NULL,
    Bairro VARCHAR(30) NOT NULL,
    Rua VARCHAR(30) NOT NULL,
    Numero INT NOT NULL
);

CREATE TABLE tbl_Escola (
    ID INT PRIMARY KEY auto_increment,
    Nome VARCHAR(30) NOT NULL,
    Estado CHAR(2) NOT NULL,
    Cidade VARCHAR(30) NOT NULL,
    Bairro VARCHAR(30) NOT NULL,
    Rua VARCHAR(30) NOT NULL,
    Numero INT NOT NULL,
    Email_Pessoa VARCHAR(30) NOT NULL
);

CREATE TABLE tbl_Curso (
    ID INT PRIMARY KEY auto_increment,
    Nome VARCHAR(30) NOT NULL,
    Periodo VARCHAR(20) NOT NULL,
    Carga_Horaria INT
);

CREATE TABLE tbl_Materia (
    ID INT PRIMARY KEY auto_increment,
    Nome VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE tbl_Turma (
    ID INT PRIMARY KEY auto_increment,
    Nome VARCHAR(20) NOT NULL,
    ID_Curso INT NOT NULL,
    ID_Escola INT NOT NULL
);

CREATE TABLE tbl_MatXTurma (
    ID_Turma INT,
    ID_Materia INT
);

CREATE TABLE tbl_Telefone (
    ID INT PRIMARY KEY auto_increment,
    DDD INT,
    Numero CHAR(9),
    Email_Pessoa VARCHAR(30) NOT NULL
);

CREATE TABLE tbl_Estuda (
    ID_Materia INT,
    Email_Pessoa VARCHAR(30)
);

CREATE TABLE tbl_Ensina (
    ID_Materia INT,
    Email_Pessoa VARCHAR(30)
);

CREATE TABLE tbl_Boletim (
    ID INT PRIMARY KEY auto_increment,
    1Bim FLOAT,
    2Bim FLOAT,
    3Bim FLOAT,
    4Bim FLOAT,
    Faltas INT,
    Email_Pessoa VARCHAR(30) NOT NULL,
    ID_Materia INT NOT NULL
);

ALTER TABLE tbl_MatXTurma
ADD CONSTRAINT PK_MatXTurma 
PRIMARY KEY CLUSTERED (ID_Turma, ID_Materia);

ALTER TABLE tbl_Ensina
ADD CONSTRAINT PK_Ensina 
PRIMARY KEY CLUSTERED (ID_Materia, Email_Pessoa);

ALTER TABLE tbl_Estuda
ADD CONSTRAINT PK_Estuda 
PRIMARY KEY CLUSTERED (ID_Materia, Email_Pessoa);

ALTER TABLE tbl_Escola 
ADD CONSTRAINT FK_Escola_Pessoa 
FOREIGN KEY(Email_Pessoa)
REFERENCES tbl_Pessoa(Email);

ALTER TABLE tbl_Turma
ADD CONSTRAINT FK_Turma_Curso
FOREIGN KEY(ID_Curso)
REFERENCES tbl_Curso(ID);

ALTER TABLE tbl_Turma
ADD CONSTRAINT FK_Turma_Escola
FOREIGN KEY(ID_Escola)
REFERENCES tbl_Escola(ID);

ALTER TABLE tbl_MatXTurma
ADD CONSTRAINT FK_Mat_Turma
FOREIGN KEY (ID_Turma)
REFERENCES tbl_Turma(ID);

ALTER TABLE tbl_MatXTurma
ADD CONSTRAINT FK_Turma_Mat
FOREIGN KEY (ID_Materia)
REFERENCES tbl_Materia(ID);

ALTER TABLE tbl_Telefone 
ADD CONSTRAINT FK_Telefone_Pessoa
FOREIGN KEY (Email_Pessoa)
REFERENCES tbl_Pessoa(Email);

ALTER TABLE tbl_Estuda
ADD CONSTRAINT FK_Estuda_Pessoa
FOREIGN KEY (ID_Materia)
REFERENCES tbl_Materia(ID);

ALTER TABLE tbl_Estuda
ADD CONSTRAINT FK_Estuda_Materia
FOREIGN KEY (Email_Pessoa)
REFERENCES tbl_Pessoa(Email);

ALTER TABLE tbl_Ensina
ADD CONSTRAINT FK_Ensina_Pessoa
FOREIGN KEY (ID_Materia)
REFERENCES tbl_Materia(ID);

ALTER TABLE tbl_Ensina
ADD CONSTRAINT FK_Ensina_Materia
FOREIGN KEY (Email_Pessoa)
REFERENCES tbl_Pessoa(Email);

ALTER TABLE tbl_Boletim
ADD CONSTRAINT FK_Boletim_Pessoa
FOREIGN KEY (Email_Pessoa)
REFERENCES tbl_Pessoa(Email);

ALTER TABLE tbl_Boletim
ADD CONSTRAINT FK_Boletim_Materia
FOREIGN KEY (ID_Materia)
REFERENCES tbl_Materia(ID);