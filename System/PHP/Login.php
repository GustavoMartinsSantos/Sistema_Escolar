<?php
  if(isset($_POST['e-mail'])) {
    $email = $_POST['e-mail'];
    $senha = $_POST['senha'];

    require_once("../../../ConexaoSQLServer/Connection.php");

    $conecta = Conecta();

    $query = "SELECT Email, Nome, Sexo FROM tbl_Pessoa
              WHERE Email = :email AND Senha = :senha";
    
    try {
        $stmt = $conecta->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();
  
        if (!$stmt) {
          echo "Erro na consulta ao banco.";
          echo "<br>";
        }

        // transforma a consulta em um array  
        $row = $stmt->fetchAll();
        
        session_start();
        // se "$row" for falso, a entrada no sistema não é feita
        if($row == false) {
          $_SESSION['invalido'] = true;
          header("Location: index.php");
        } else {
          $_SESSION['user']  = $row[0]['Nome'];
          $_SESSION['sexo']  = $row[0]['Sexo'];
          $_SESSION['email'] = $row[0]['Email'];

          header("Location: Principal.php");
        }
    } catch(Exception $e) {
        echo "ERRO: " . $e->getMessage();
        exit;
    }
  } else {
    header("Location: index.php");
    die();
  }
?>