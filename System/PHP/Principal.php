<?php
    session_start();
    /* elimina a variável "user" da sessão
       unset($_SESSION['user']);

       elimina a sessão somente, não suas variáveis
       session_destroy();
       
       elimina a sessão e suas variáveis
       $_SESSION = false;*/

    if(!isset($_SESSION['user']))
        header("Location: index.php");
    
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
            <a>Olá, bem-vind<?php echo $sexo . $_SESSION['user'] ?></a>
            <a href="MeusDados.php">Minhas informações</a>
            <a href="#">Cadastrar uma escola</a>
            <!-- FormCadastroEscola.php -->
        </header>

        <?php
            require("../../../ConexaoSQLServer/Connection.php");

            $conecta = Conecta();
        
            $query = "";
        ?>
    </body>
</html>