<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Cadastro</title>
        <meta charset="UTF-8">
        <link type="image/x-icon" rel="shortcut icon" href="../IMG/logo-icone.ico">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/cadastro.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script src="../JS/Validacao_Form.js"></script>
        <script src="../JS/Mascaras_Campos.js"></script>
        <script src="../JS/Endereco.js"></script>
    </head>
    <body>
        <header>
            <div id="logo"><a href="index.php">Grade Yourself</a></div>
        </header>

        <div id="titulo">Cadastro</div>
        <form name="cadastro" method="POST" action="CadastroPessoa.php" 
        onSubmit="return valida_form()" autocomplete="off">
            <label for="email" class="label">E-mail</label>
            <input type="email" class="inputs" id="email" name="email" size="31" required autofocus>

            <label for="senha" class="label">Senha</label> 
            <input type="text" class="inputs" id="senha" name="senha" size="31" minlength="8" maxlength="10" required>

            <label for="data" class="label">Data de Nascimento</label> 
            <input type="date" class="inputs" name="data" id="datas" min="1920-01-01" max="2020-01-01" required>

            <label for="numero" class="label">Número Residencial</label>
            <input type="number" class="inputs" id="numero_residencial" name="numero_residencial" required>

            <label for="nome" class="label">Nome</label>
            <input type="text" class="inputs" id="nome" name="nome" size="32" maxlength="30" required>

            <label for="cep" class="label">CEP</label>
            <input type="text" class="inputs" id="cep" onblur="pesquisacep(this.value)" name="cep" required>

            <label for="rua" class="label">Rua</label>
            <input type="text" class="inputs" id="rua" name="rua" size="34" readonly="readonly">

            <label for="bairro" class="label">Bairro</label>
            <input type="text" class="inputs" id="bairro" name="bairro" size="31" readonly="readonly">
            
            <label for="cidade" class="label">Cidade</label>
            <input type="text" class="inputs" id="cidade" name="cidade" size="30" readonly="readonly">
            
            <label for="cidade" class="label">Estado</label>
            <input type="text" class="inputs" id="estado" name="estado" size="31" readonly="readonly">

            <label for="sobrenome" class="label">Sobrenome</label> 
            <input type="text" class="inputs" id="sobrenome" name="sobrenome" size="25" maxlength="50" required>

            <label for="sexo" class="label">Sexo</label> 
                <input type="radio" class="radios" name="sexo" value="M" id="M" required>
                <label for="M" class="radio-labels">Masculino</label>

                <input type="radio" class="radios" name="sexo" value="F" id="F">
                <label for="F" class="radio-labels">Feminino</label>
            <br>

            <label for="codigo" class="label">Código de Acesso</label>
            <input type="text" class="inputs" id="codigo" name="codigo" size="18" minlength="10" maxlength="10" required>

            <label for="rg" class="label">RG</label>
            <input type="text" class="inputs" id="rg" name="rg" size="34" pattern=".{12,}" maxlength="9" required>

            <label for="telefone" class="label">Telefone</label>
            <input type="text" class="inputs" id="telefone" name="telefone" size="14" pattern=".{14,}">

            <select class="inputs" id="tipo_telefone" name="tipo_telefone">
                <option value='CEL'>Celular</option>
                <option value='RES'>Residencial</option>
            <select>

            <label for="cpf" class="label">CPF</label>
            <input type="text" class="inputs" id="cpf" name="cpf" size="33" pattern=".{14,}" required>

            <span class="grupo_botoes">
                <input type="submit" value="Cadastrar" id="Cadastrar">
            </span>
        </form>
    </body>
</html>