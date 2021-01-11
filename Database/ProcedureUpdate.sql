USE Sistema_Escolar;
GO

CREATE OR ALTER PROCEDURE AlterarDados 
(@Email VARCHAR(50), @Senha VARCHAR(10), @Data_Nasc DATE, @Num INT, @Nome VARCHAR(30), @Sobrenome VARCHAR(50),
 @Sexo CHAR(1), @Codigo_Acesso CHAR(10), @RG CHAR(9), @CPF CHAR(11),  @DDD INT, @Telefone CHAR(9),
 @Tipo CHAR(3), @Cidade VARCHAR(30), @Bairro VARCHAR(30), @Rua VARCHAR(30))
AS
	UPDATE tbl_Pessoa 
	SET Email = @Email, Nome = @Nome, Sobrenome = @Sobrenome, Sexo = @Sexo, Senha = @Senha, Codigo_Acesso = @Codigo_Acesso, RG = @RG, CPF = @CPF, 
	Data_Nasc = @Data_Nasc, Cidade = @Cidade, Bairro =  @Bairro, Rua = @Rua, Numero = @Num
	WHERE Email = @Email;

	IF(@Telefone != '') BEGIN
		UPDATE tbl_Telefone
		SET DDD = @DDD, Telefone = @Telefone, Tipo = @Tipo, Email_Pessoa = @Email
		WHERE Email_Pessoa = @Email;
	END
GO