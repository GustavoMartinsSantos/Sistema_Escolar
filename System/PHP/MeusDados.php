<?php
    function webClient($url) {
        $ch = curl_init();
   
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   
        $data = curl_exec($ch);
   
        curl_close($ch);
   
        return $data;
    }

    function get_cep($rua, $cidade, $uf) {
        $rua = str_replace(" ", "%20", 
        preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/",
                           "/(é|è|ê|ë)/","/(É|È|Ê|Ë)/",
                           "/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/",
                           "/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/",
                           "/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/"),
        explode(" ","a A e E i I o O u U"), $rua));

        $url = sprintf('https://viacep.com.br/ws/%s/%s/%s/json/ ', $uf, $cidade, $rua);
        $result = json_decode(webClient($url));

        return $result[0]->cep;
    }

    session_start();

    if(!isset($_SESSION['user']))
        header("Location: ../HTML/index.html");

    require_once("../../../ConexaoSQLServer/Connection.php");

    $conecta = Conecta();

    $query = "SELECT Email, Senha, Data_Nasc, Numero, Nome, 
                     Sobrenome, Sexo, Codigo_Acesso, RG, CPF,
                     Rua, Bairro, Cidade, Estado,
                     DDD, Telefone, Tipo
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
        <link rel="stylesheet" type="text/css" href="../CSS/cadastro.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script src="../JS/Validacao_Form.js"></script>
        <script src="../JS/Mascaras_Campos.js"></script>
        <script src="../JS/Endereco.js"></script>
    </head>
    <body>
        <header>
            <a href="Principal.php"><div id="logo">Grade Yourself</div></a>
        </header>

        <div id="titulo">Minhas Informações</div>
        <form name="cadastro" method="post" action="UpdatePessoa.php" 
        onSubmit="return valida_form()" autocomplete="off" id="AlterarDados">
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
            
            <label for="cep" class="label">CEP</label>
            <input type="text" class="inputs" id="cep" name="cep" 
            value="<?php echo $cep ?>" onblur="pesquisacep(this.value)" required>

            <label for="sobrenome" class="label">Sobrenome</label> 
            <input type="text" class="inputs" id="sobrenome" name="sobrenome" size="25" maxlength="50"
            value="<?php echo $row[0]['Sobrenome'] ?>" required>

            <label for="rua" class="label">Rua</label>
            <input type="text" class="inputs" id="rua" name="rua" size="34" readonly="readonly">

            <label for="bairro" class="label">Bairro</label>
            <input type="text" class="inputs" id="bairro" name="bairro" size="31" readonly="readonly">
            
            <label for="cidade" class="label">Cidade</label>
            <input type="text" class="inputs" id="cidade" name="cidade" size="30" readonly="readonly">
            
            <label for="cidade" class="label">Estado</label>
            <input type="text" class="inputs" id="estado" name="estado" size="31" readonly="readonly">
            
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
            value="<?php echo $row[0]['DDD'] . $row[0]['Telefone'] ?>">
            
            <select class="inputs" id="tipo_telefone" name="tipo_telefone">
                <option value='CEL'>Celular</option>
                <option <?php echo ($row[0]['Tipo'] == 'RES') ? "selected" : null ?>
                value='RES'>Residencial</option>
            </select>

            <label for="cpf" class="label">CPF</label>
            <input type="text" class="inputs" id="cpf" name="cpf" size="33" pattern=".{14,}"
            value="<?php echo $row[0]['CPF'] ?>" required>

            <span class="grupo_botoes">
                <input type="submit" value="Salvar Alterações" id="Cadastrar">
            </span>
        </form>
    </body>
</html>