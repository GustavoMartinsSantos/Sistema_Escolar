<!DOCTYPE html>
    <head>
        <title>Bem-vindo(a)</title>
        <meta charset="UTF-8">
        <link type="image/x-icon" rel="shortcut icon" href="../IMG/logo-icone.ico">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
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


        <form name="tela-inicial" method="POST" id="formTelaInicial" action="../PHP/Login.php">
            <?php if(isset($_SESSION['invalido'])) { ?>
                <center><img src="../IMG/Logo_erro.png"></img></center>
            <?php } else { ?>
                <center><img src="../IMG/Logo.png"></img></center>
            <?php } unset($_SESSION['invalido']); ?>

            <label class="lblLogin">E-mail</label>
            <input type="email" name="e-mail" class="inputs LoginInputs" size="22" maxlength="50" autofocus required>

            <label class="lblLogin">Senha</label>
            <input type="password" name="senha" class="inputs LoginInputs" size="22" maxlength="10" required>

            <span class="grupo_botoes">
                <input type="submit" id="Entrar" value="Entrar">
            </span>
            <a class="loginLinks" href="#">Esqueci minha senha</a>
            <a class="loginLinks" href="FormCadastroPessoa.php">Criar uma conta</a>
        </form>
    </body>
</html>