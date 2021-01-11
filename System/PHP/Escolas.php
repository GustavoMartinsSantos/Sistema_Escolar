<?php
    session_start();
    /* elimina a variável "user" da sessão
       unset($_SESSION['user']);

       elimina a sessão somente, não suas variáveis
       session_destroy();
       
       elimina a sessão e suas variáveis
       $_SESSION = false;*/

    if(!isset($_SESSION['user']))
        header("Location: ../HTML/index.html");
    
    $sexo;
    if($_SESSION['sexo'] == 'M')
        $sexo = 'o ';
    else
        $sexo = 'a ';
?>

<!DOCTYPE html>
    <head>
        <title>Grade Yourself</title>
        <meta charset="UTF-8">
        <link type="image/x-icon" rel="shortcut icon" href="../IMG/logo-icone.ico">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
    </head>
    <body>
        <header>
            <span style="position: sticky; right: 100%; margin-left: 20px">
                Olá, bem-vind<?php echo $sexo . $_SESSION['user'] ?>
            </span>
            <a href="../PHP/MeusDados.php">Minhas informações</a>
            <a href="#" style="position: sticky; left: 100%; margin-right: 20px">Cadastrar uma escola</a>
        </header>

        <?php
            require("../../../ConexaoSQLServer/Connection.php");

            $conecta = Conecta();
        
            $query = "SELECT Nome FROM tbl_Pessoa
                      WHERE Email = :email AND Senha = :senha";
        ?>
    </body>
</html>