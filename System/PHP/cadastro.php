<?php
  function get_endereco($cep){
      // formatar o cep removendo caracteres nao numericos
      $cep = preg_replace("/[^0-9]/", "", $cep);
      $url = "http://viacep.com.br/ws/$cep/xml/";

      $xml = simplexml_load_file($url);

      if($xml->erro == true)
            return false;
        return $xml;
    }

  if(isset($_POST["cep"]) && get_endereco($_POST["cep"]) == true) {
    $endereco = get_endereco($_POST["cep"]);
    $Rua    = $endereco->logradouro;
    $Bairro = $endereco->bairro;
    $Cidade = $endereco->localidade;
    $Estado = $endereco->uf;

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

      if ($stmt) {
        echo "Cadastro feito com sucesso.";
        echo "<br>";
      } else {
        echo "Erro na consulta ao banco.";
        echo "<br>";
      }
    } catch(Exception $e) {
      echo "ERRO: " . $e->getMessage();
      exit;
    }
        
    $connection = null;
  } else {
    header("Location: ../HTML/cadastro.html");
    die();
  }
?>