<?php
  if(!isset($_POST['Email'])) {
    header("Location: FormCadastroPessoa.php");
  }
    
  $mascaras_campo = array(" ",".","(",")","-");

  $Email         = $_POST["email"];
  $Senha         = str_replace(" ", "", $_POST['senha']);
  $Data_Nasc     = $_POST["data"];
  $Num           = $_POST["numero_residencial"];
  $Nome          = str_replace(" ", "", $_POST["nome"]);
  $Sobrenome     = trim(preg_replace('/\s+/', " ", $_POST["sobrenome"]));
  $Sexo          = $_POST["sexo"];
  $Codigo_Acesso = $_POST["codigo"];
  $RG            = str_replace($mascaras_campo, "", $_POST["rg"]);
  $CPF           = str_replace($mascaras_campo, "", $_POST["cpf"]);
  $DDD           = intval(substr($_POST["telefone"], 1, 2));
  $Telefone      = substr(str_replace($mascaras_campo, "", $_POST["telefone"]), 2, 9);
  $Tipo_telefone = $_POST["tipo_telefone"];
  $Estado        = $_POST["estado"];
  $Cidade        = $_POST["cidade"];
  $Bairro        = $_POST["bairro"];
  $Rua           = $_POST["rua"];

  require("../../../ConexaoSQLServer/Connection.php");
    
  $conecta = Conecta();

  $query =  "EXEC InserirPessoa
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
              @Estado        = '{$Estado}',
              @Cidade        = '{$Cidade}',
              @Bairro        = '{$Bairro}',
              @Rua           = '{$Rua}'";

  try {
    $stmt = $conecta->query($query);

    session_start();
    if ($stmt) {
      $_SESSION['user']  = $Nome;
      $_SESSION['sexo']  = $Sexo;
      $_SESSION['email'] = $Email;

      header("location: Principal.php");
    } else {
      echo "Erro na consulta ao banco.";
      echo "<br>";
    }
  } catch(Exception $e) {
    echo "ERRO: " . $e->getMessage();
    exit;
  }
?>