<?php
    session_start();

    if(!isset($_SESSION['user']))
        header("Location: index.php");

    require_once("../../../ConexaoSQLServer/Connection.php");
    require_once("FuncoesEndereco.php");

    $conecta = Conecta();

    $query = "SELECT Email, Senha, Data_Nasc, Numero, Nome, 
                     Sobrenome, Sexo, Codigo_Acesso, RG, CPF,
                     Rua, Bairro, Cidade, Estado
              FROM tbl_Pessoa
              WHERE Email = :email";

    try {
        $stmt = $conecta->prepare($query);
        $stmt->bindValue(":email", $_SESSION['email']);
        $stmt->execute();

        if(!$stmt) {
            echo "Erro na consulta ao banco.";
            echo "<br>";
        }

        $row = $stmt->fetchAll();

        $cep = get_cep($row[0]['Rua'], $row[0]['Cidade'], $row[0]['Estado']);
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script src="../JS/Validacao_Form.js"></script>
        <script src="../JS/Mascaras_Campos.js"></script>
        <script src="../JS/Endereco.js"></script>
    </head>
    <body>
        <header>
            <div id="logo"><a href="Principal.php">Grade Yourself</a></div>
        </header>

        <div id="titulo">Minhas Informações</div>

        <?php if(isset($_SESSION['valido'])) { ?>
                <center><div class="JanelaModal" style="background-color: rgb(0, 232, 89); color: white">
                    Alteração feita com sucesso
                </div></center> <br>
        <?php } unset($_SESSION['valido']); ?>

        <form id="formUpdate" method="POST" action="UpdatePessoa.php" 
        onSubmit="return valida_form()" autocomplete="off">
            <label class="label">E-mail</label>
            <input type="email" class="inputs" id="email" name="email" size="31" autofocus
            value="<?php echo $row[0]['Email'] ?>" required>

            <label class="label">Senha</label> 
            <input type="text" class="inputs" id="senha" name="senha" size="31" minlength="8" maxlength="10"
            value="<?php echo $row[0]['Senha'] ?>" required>

            <label class="label">Data de Nascimento</label> 
            <input type="date" class="inputs" name="data" id="datas" min="1920-01-01" max="2020-01-01"
            value="<?php echo $row[0]['Data_Nasc'] ?>" required>

            <label class="label">Número Residencial</label>
            <input type="number" class="inputs" id="numero_residencial" name="numero_residencial"
            value="<?php echo $row[0]['Numero'] ?>" required>

            <label class="label">Nome</label>
            <input type="text" class="inputs" id="nome" name="nome" size="32" maxlength="30"
            value="<?php echo $row[0]['Nome'] ?>" required>
                
            <label class="label">CEP</label>
            <input type="text" class="inputs" id="cep" name="cep" 
            value="<?php echo $cep ?>" onblur="pesquisacep(this.value)" required>

            <label class="label">Sobrenome</label> 
            <input type="text" class="inputs" id="sobrenome" name="sobrenome" size="25" maxlength="50"
            value="<?php echo $row[0]['Sobrenome'] ?>" required>

            <label class="label">Rua</label>
            <input type="text" class="inputs" id="rua" name="rua" size="34" readonly>

            <label class="label">Bairro</label>
            <input type="text" class="inputs" id="bairro" name="bairro" size="31" readonly>
                
            <label class="label">Cidade</label>
            <input type="text" class="inputs" id="cidade" name="cidade" size="30" readonly>
                
            <label class="label">Estado</label>
            <input type="text" class="inputs" id="estado" name="estado" size="31" readonly>
                
            <label class="label">Sexo</label> 
            <input type="radio" class="radios" name="sexo" value="M" id="M"
            <?php echo ($_SESSION["sexo"] == 'M') ? "checked" : null ?> required>
            <label class="radio-labels">Masculino</label>

            <input type="radio" class="radios" name="sexo" value="F" id="F"
            <?php echo ($_SESSION["sexo"] == 'F') ? "checked" : null ?>>
            <label class="radio-labels">Feminino</label>
            <br>

            <label class="label">Código de Acesso</label>
            <input type="text" class="inputs" id="codigo" name="codigo" size="18" minlength="10" maxlength="10"
            value="<?php echo $row[0]['Codigo_Acesso'] ?>" required>

            <label class="label">RG</label>
            <input type="text" class="inputs" id="rg" name="rg" size="34" pattern=".{12,}" maxlength="9"
            value="<?php echo $row[0]['RG'] ?>" required>

            <button id="btnEditTel">Editar telefone</button>
            <script>
                function redireciona(event) {
                    window.location.href='FormEditarTelefone.php';
                            
                    event.preventDefault();
                    event.stopPropagation();
                }

                document.getElementById("btnEditTel").addEventListener("click", redireciona);
            </script>
                
            <label class="label">CPF</label>
            <input type="text" class="inputs" id="cpf" name="cpf" size="33" pattern=".{14,}"
            value="<?php echo $row[0]['CPF'] ?>" required>

            <span class="grupo_botoes">
                <input type="submit" value="Salvar Alterações" id="Cadastrar">
            </span>
        </form>
    </body>
</html>