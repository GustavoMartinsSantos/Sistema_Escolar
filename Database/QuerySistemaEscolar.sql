CREATE TABLE tbl_Pessoa (
    Email VARCHAR(30) PRIMARY KEY NOT NULL,
    Nome VARCHAR(30) NOT NULL,
    Senha CHAR(8) NOT NULL,
    Codigo_Acesso CHAR(10) NOT NULL UNIQUE,
    RG CHAR(9) NOT NULL UNIQUE,
    CPF CHAR(11) NOT NULL UNIQUE,
    Data_Nasc DATE NOT NULL,
    Estado CHAR(2) NOT NULL,
    Cidade VARCHAR(30) NOT NULL,
    Bairro VARCHAR(30) NOT NULL,
    Rua VARCHAR(30) NOT NULL,
    Numero INT NOT NULL
);

CREATE TABLE tbl_Escola (
    Codigo CHAR(10) PRIMARY KEY NOT NULL,
    Nome VARCHAR(30) NOT NULL,
    Estado CHAR(2) NOT NULL,
    Cidade VARCHAR(30) NOT NULL,
    Bairro VARCHAR(30) NOT NULL,
    Rua VARCHAR(30) NOT NULL,
    Numero INT NOT NULL,
    Email_Pessoa VARCHAR(30) NOT NULL
    FOREIGN KEY (Email_Pessoa)
    REFERENCES tbl_Pessoa(Email)
);

CREATE TABLE tbl_Curso (
    ID INT PRIMARY KEY IDENTITY(1,1),
    Nome VARCHAR(30) UNIQUE NOT NULL,
    Periodo VARCHAR(20) NOT NULL,
    Carga_Horaria INT
);

CREATE TABLE tbl_Materia (
    Codigo INT PRIMARY KEY IDENTITY(1,1),
    Nome VARCHAR(30) NOT NULL UNIQUE,
);

CREATE TABLE tbl_Turma (
    Codigo INT PRIMARY KEY IDENTITY(1,1),
    Nome VARCHAR(20) NOT NULL,
    ID_Curso INT NOT NULL
    FOREIGN KEY (ID_Curso)
    REFERENCES tbl_Curso(ID),
    Codigo_Escola CHAR(10) NOT NULL
    FOREIGN KEY (Codigo_Escola)
    REFERENCES tbl_Escola(Codigo)
);

CREATE TABLE tbl_MaxXTurma (
    Codigo_Turma INT NOT NULL
    FOREIGN KEY (Codigo_Turma)
    REFERENCES tbl_Turma(Codigo),
    Codigo_Materia INT NOT NULL
    FOREIGN KEY (Codigo_Materia)
    REFERENCES tbl_Materia(Codigo)
);

CREATE TABLE tbl_Telefone (
    Numero VARCHAR(20) UNIQUE,
    Email_Pessoa VARCHAR(30) NOT NULL
    FOREIGN KEY (Email_Pessoa)
    REFERENCES tbl_Pessoa(Email)
);

CREATE TABLE tbl_Estuda (
    Codigo_Materia INT NOT NULL
    FOREIGN KEY (Codigo_Materia)
    REFERENCES tbl_Materia(Codigo),
    Email_Pessoa VARCHAR(30) NOT NULL
    FOREIGN KEY (Email_Pessoa)
    REFERENCES tbl_Pessoa(Email)
);

CREATE TABLE tbl_Ensina (
    Codigo_Materia INT NOT NULL
    FOREIGN KEY (Codigo_Materia)
    REFERENCES tbl_Materia(Codigo),
    Email_Pessoa VARCHAR(30) NOT NULL
    FOREIGN KEY (Email_Pessoa)
    REFERENCES tbl_Pessoa(Email)
);

CREATE TABLE tbl_Boletim (
    Primeiro_BM FLOAT,
    Segundo_BM FLOAT,
    Terceiro_BM FLOAT,
    Quarto_BM FLOAT,
    Media FLOAT,
    Faltas INT,
    Email_Pessoa VARCHAR(30) NOT NULL
    FOREIGN KEY (Email_Pessoa)
    REFERENCES tbl_Pessoa(Email),
    Codigo_Materia INT NOT NULL
    FOREIGN KEY (Codigo_Materia)
    REFERENCES tbl_Materia(Codigo)
);

