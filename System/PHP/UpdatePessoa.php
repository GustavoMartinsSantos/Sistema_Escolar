<?php
    session_start();

    if(!isset($_SESSION['user']))
        header("Location: index.php");

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
    $Rua           = $_POST["rua"];
    $Bairro        = $_POST["bairro"];
    $Cidade        = $_POST["cidade"];

    $query =  "UPDATE tbl_Pessoa
               SET Email         = '{$Email}',
                   Senha         = '{$Senha}',
                   Data_Nasc     = '{$Data_Nasc}',
                   Numero        = {$Num},
                   Nome          = '{$Nome}',
                   Sobrenome     = '{$Sobrenome}',
                   Sexo          = '{$Sexo}',
                   Codigo_Acesso = '{$Codigo_Acesso}',
                   RG            = '{$RG}',
                   CPF           = '{$CPF}',
                   Cidade        = '{$Cidade}',
                   Bairro        = '{$Bairro}',
                   Rua           = '{$Rua}'
               WHERE Email = '{$Email}'";

    try {
      $stmt = $conecta->prepare($query);
      $stmt->execute();
      
      if ($stmt) {
        $_SESSION['valido'] = true;
        header("location: MeusDados.php");
      } else {
        echo "Erro na consulta ao banco.";
        echo "<br>";
      }
    } catch(Exception $e) {
      echo "ERRO: " . $e->getMessage();
      exit;
    }
?>