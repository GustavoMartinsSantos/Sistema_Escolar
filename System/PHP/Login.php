<?php
  if(isset($_POST['e-mail'])) {
    $email = $_POST['e-mail'];
    $senha = $_POST['senha'];

    require("../../../ConexaoSQLServer/Connection.php");

    $conecta = Conecta();

    $query = "SELECT Nome FROM tbl_Pessoa
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
        if($row == FALSE) {
          /*header("Location: ../HTML/index.html");
          die();*/
          header("Location: ../PHP/Escolas.php");
        } else {
          session_start();
          $_SESSION['user'] = $row[0]['Nome'];

          header("Location: ../PHP/Escolas.php");
        }
    } catch(Exception $e) {
        echo "ERRO: " . $e->getMessage();
        exit;
    }
  } else {
    header("Location: ../HTML/index.html");
    die();
  }
?>