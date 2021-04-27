<!DOCTYPE html>
    <head>
        <title>Bem-vindo(a)</title>
        <meta charset="UTF-8">
        <link type="image/x-icon" rel="shortcut icon" href="../IMG/logo-icone.ico">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/login.css">
    </head>
    <body>
        <header>
            <div id="logo">Grade Yourself</div>
        </header>

        <?php session_start();
            if(isset($_SESSION['invalido'])) { ?>
                <center><div class="JanelaModal" style="background-color: rgb(241, 56, 0); color: white">
                    Email ou senha incorretos
                </div></center> <br>
        <?php } ?>


        <form name="tela-inicial" method="POST" id="tela-inicial" action="../PHP/Login.php">
            <?php if(isset($_SESSION['invalido'])) { ?>
                <center><img src="../IMG/Logo_erro.png"></img></center>
            <?php } else { ?>
                <center><img src="../IMG/Logo.png"></img></center>
            <?php } unset($_SESSION['invalido']); ?>

            <label for="email">E-mail</label>
            <input type="email" name="e-mail" class="inputs" size="22" maxlength="50" autofocus required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" class="inputs" size="22" maxlength="10" required>

            <span class="grupo_botoes">
                <input type="submit" id="Entrar" value="Entrar">
            </span>
            <a href="#">Esqueci minha senha</a>
            <a href="FormCadastroPessoa.php">Criar uma conta</a>
        </form>
    </body>
</html>