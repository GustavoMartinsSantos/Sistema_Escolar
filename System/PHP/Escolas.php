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
            <div id="logo">Grade Yourself</div>
        </header>
    </body>
</html>