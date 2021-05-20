<?php
    session_start();
    if(!isset($_SESSION['email']))
        header("Location: index.php");
    
        require_once("../../../ConexaoSQLServer/Connection.php");
    $conecta = Conecta();

    $mascaras_campo = array(" ",".","(",")","-");
    $phoneRows = count($_POST["telefone"]);
  
    $phone_query = "DELETE FROM tbl_Telefone WHERE Email_Pessoa = '{$_SESSION['email']}';";
    for($i = 0; $i < $phoneRows; $i++) {
        $telefone = substr(str_replace($mascaras_campo, "", $_POST["telefone"][$i]), 2, 9);
        $DDD = intval(substr($_POST["telefone"][$i], 1, 2));
        $tipo_telefone = $_POST["tipo_telefone"][$i];
  
        $phone_query .= "INSERT INTO tbl_Telefone VALUES(";
        $phone_query .= "{$DDD}, '{$telefone}', '{$tipo_telefone}', '{$_SESSION['email']}');";
    }

    try {
        $stmt = $conecta->prepare($phone_query);
        $stmt->execute();

        if($stmt) {
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