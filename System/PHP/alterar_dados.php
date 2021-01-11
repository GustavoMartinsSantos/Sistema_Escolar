<?php
    session_start();

    if(!isset($_SESSION['user']))
        header("Location: ../HTML/index.html");

    require("../../../ConexaoSQLServer/Connection.php");

    $conecta = Conecta();

    $mascaras_campo = array(" ",".","(",")","-");

    $Email         = $_POST["email"];
    $Senha         = str_replace(" ", "", $_POST['senha']);
    $Data_Nasc     = $_POST["data"];
    $Num           = $_POST["numero_residencial"];
    $Nome          = str_replace(" ", "", $_POST["nome"]);
    $Sobrenome     = $_POST["sobrenome"];
    $Sexo          = $_POST["sexo"];
    $Codigo_Acesso = $_POST["codigo"];
    $RG            = str_replace($mascaras_campo, "", $_POST["rg"]);
    $CPF           = str_replace($mascaras_campo, "", $_POST["cpf"]);
    $DDD           = intval(substr($_POST["telefone"], 1, 2));
    $Telefone      = substr(str_replace($mascaras_campo, "", $_POST["telefone"]), 2, 9);
    $Tipo_telefone = $_POST["tipo_telefone"];
    $Rua           = $_POST["rua"];
    $Bairro        = $_POST["bairro"];
    $Cidade        = $_POST["cidade"];

    $query =  "EXEC AlterarDados
                  @Email         = '{$Email}',
                  @Senha         = '{$Senha}',
                  @Data_Nasc     = '{$Data_Nasc}',
                  @Num           = {$Num},
                  @Nome          = '{$Nome}',
                  @Sobrenome     = '{$Sobrenome}',
                  @Sexo          = '{$Sexo}',
                  @Codigo_Acesso = '{$Codigo_Acesso}',
                  @RG            = '{$RG}',
                  @CPF           = '{$CPF}',
                  @DDD           = {$DDD},
                  @Telefone      = '{$Telefone}',
                  @Tipo          = '{$Tipo_telefone}',
                  @Cidade        = '{$Cidade}',
                  @Bairro        = '{$Bairro}',
                  @Rua           = '{$Rua}'";

    try {
      $stmt = $conecta->query($query);

      if ($stmt) {
        echo "Alteração feita com sucesso.";
        echo "<br>";
      } else {
        echo "Erro na consulta ao banco.";
        echo "<br>";
      }
    } catch(Exception $e) {
      echo "ERRO: " . $e->getMessage();
      exit;
    }
?>