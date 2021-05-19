CREATE OR ALTER PROCEDURE [dbo].[InserirPessoa] 
(@Email VARCHAR(50), @Senha VARCHAR(10), @Data_Nasc DATE, @Num INT, @Nome VARCHAR(30), @Sobrenome VARCHAR(50),
 @Sexo CHAR(1), @Codigo_Acesso CHAR(10), @RG CHAR(9), @CPF CHAR(11),  @DDD INT, @Telefone CHAR(9),
 @Tipo CHAR(3), @Estado CHAR(2), @Cidade VARCHAR(30), @Bairro VARCHAR(30), @Rua VARCHAR(30))
AS
	INSERT INTO tbl_Pessoa VALUES(@Email, @Nome, @Sobrenome, @Sexo, @Senha, @Codigo_Acesso, @RG, @CPF, 
	@Data_Nasc, @Estado, @Cidade, @Bairro, @Rua, @Num);

	IF(@Telefone != '') BEGIN
		INSERT INTO tbl_Telefone VALUES(@DDD, @Telefone, @Tipo, @Email);
	END