<?php
    session_start();

    if(!isset($_SESSION['user']))
        header("Location: ../HTML/index.html");

    require("../../../ConexaoSQLServer/Connection.php");

    $conecta = Conecta();

    $query = "SELECT Email, Senha, Data_Nasc, Numero, Nome, 
                     Sobrenome, Sexo, Codigo_Acesso, RG, CPF,
                     Rua, Bairro, Cidade, Estado,
                     Telefone, Tipo
              FROM tbl_Pessoa P
                LEFT JOIN tbl_Telefone T
                ON T.Email_Pessoa = P.Email
              WHERE P.Email = :email";
    
    try {
        $stmt = $conecta->prepare($query);
        $stmt->bindValue(":email", $_SESSION['email']);
        $stmt->execute();

        if (!$stmt) {
            echo "Erro na consulta ao banco.";
            echo "<br>";
        }

        $row = $stmt->fetchAll();
        
    } catch(Exception $e) {
        echo "ERRO: " . $e->getMessage();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Meus dados</title>
        <meta charset="UTF-8">
        <link type="image/x-icon" rel="shortcut icon" href="../IMG/logo-icone.ico">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/cadastro.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script src="../JS/Validacao_Form.js"></script>
        <script src="../JS/Mascaras_Campos.js"></script>
    </head>
    <body>
        <header>
            <a href="Escolas.php"><div id="logo">Grade Yourself</div></a>
        </header>

        <div id="titulo">Minhas Informações</div>
        <form name="cadastro" method="POST" action="../PHP/alterar_dados.php" 
        onSubmit="return valida_form()" autocomplete="off">
            <label for="email" class="label">E-mail</label>
            <input type="email" class="inputs" id="email" name="email" size="31" autofocus
            value="<?php echo $row[0]['Email'] ?>" required>

            <label for="senha" class="label">Senha</label> 
            <input type="text" class="inputs" id="senha" name="senha" size="31" minlength="8" maxlength="10"
            value="<?php echo $row[0]['Senha'] ?>" required>

            <label for="data" class="label">Data de Nascimento</label> 
            <input type="date" class="inputs" name="data" id="datas" min="1920-01-01" max="2020-01-01"
            value="<?php echo $row[0]['Data_Nasc'] ?>" required>

            <label for="numero" class="label">Número Residencial</label>
            <input type="number" class="inputs" id="numero_residencial" name="numero_residencial"
            value="<?php echo $row[0]['Numero'] ?>" required>

            <label for="nome" class="label">Nome</label>
            <input type="text" class="inputs" id="nome" name="nome" size="32" maxlength="30"
            value="<?php echo $row[0]['Nome'] ?>" required>

            <label for="sobrenome" class="label">Sobrenome</label> 
            <input type="text" class="inputs" id="sobrenome" name="sobrenome" size="25" maxlength="50"
            value="<?php echo $row[0]['Sobrenome'] ?>" required>
            
            <label for="rua" class="label">Rua</label>
            <input type="text" class="inputs" id="rua" name="rua" size="34" maxlength="30"
            value="<?php echo $row[0]['Rua'] ?>" required>

            <label for="bairro" class="label">Bairro</label>
            <input type="text" class="inputs" id="bairro" name="bairro" size="31" maxlength="30"
            value="<?php echo $row[0]['Bairro'] ?>" required>

            <label for="cidade" class="label">Cidade</label>
            <input type="text" class="inputs" id="cidade" name="cidade" size="31" maxlength="30"
            value="<?php echo $row[0]['Cidade'] ?>" required>
            
            <label for="sexo" class="label">Sexo</label> 
                <input type="radio" class="radios" name="sexo" value="M" id="M"
                <?php echo ($_SESSION["sexo"] == 'M') ? "checked" : null ?> required>
                <label for="M" class="radio-labels">Masculino</label>

                <input type="radio" class="radios" name="sexo" value="F" id="F"
                <?php echo ($_SESSION["sexo"] == 'F') ? "checked" : null ?>>
                <label for="F" class="radio-labels">Feminino</label>
            <br>

            <label for="codigo" class="label">Código de Acesso</label>
            <input type="text" class="inputs" id="codigo" name="codigo" size="18" minlength="10" maxlength="10"
            value="<?php echo $row[0]['Codigo_Acesso'] ?>" required>

            <label for="rg" class="label">RG</label>
            <input type="text" class="inputs" id="rg" name="rg" size="34" pattern=".{12,}" maxlength="9"
            value="<?php echo $row[0]['RG'] ?>" required>

            <label for="telefone" class="label">Telefone</label>
            <input type="text" class="inputs" id="telefone" name="telefone" size="14" pattern=".{14,}"
            value="<?php echo $row[0]['Telefone'] ?>">

            <select class="inputs" id="tipo_telefone" name="tipo_telefone">
                <option value='CEL'>Celular</option>
                <option <?php echo ($row[0]['Tipo'] == 'RES') ? "selected" : null ?>
                value='RES'>Residencial</option>
            <select>

            <label for="cpf" class="label">CPF</label>
            <input type="text" class="inputs" id="cpf" name="cpf" size="33" pattern=".{14,}"
            value="<?php echo $row[0]['CPF'] ?>" required>

            <span class="grupo_botoes">
                <input type="submit" value="Salvar Alterações" id="Cadastrar">
            </span>
        </form>
    </body>
</html>