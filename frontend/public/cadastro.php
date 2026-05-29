<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}



if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $_SESSION['cadastro'] = [

        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'senha' => $_POST['senha']

    ];

    header('Location: escolher-tipo.php');

    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Cadastro
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link
        rel="stylesheet"
        href="css/cadastro-login.css"
    >

</head>

<body class="auth-page">

    <main class="auth-shell">

        <section class="auth-panel">

           <div class="logo">
            <div class="logo-icon">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <div class="logo-text">
                <span class="logo-name">ProServiços</span>
            </div>
        </div>

            <p class="muted">
                Cadastre-se para contratar serviços
                ou divulgar seu trabalho na plataforma.
            </p>

            <form
                method="POST"
                class="form-card"
            >

                <label for="nome">
                    Nome
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Digite seu nome"
                    required
                >



                <label for="email">
                    E-mail
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    required
                >



                <label for="telefone">
                    Telefone
                </label>

                <input
                    type="text"
                    id="telefone"
                    name="telefone"
                    placeholder="(00) 00000-0000"
                    required
                >



                <label for="senha">
                    Senha
                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Crie uma senha"
                    required
                >



                <button type="submit">

                    Continuar

                </button>

            </form>



            <p class="auth-footer">

                Já possui conta?

                <a href="login.php">

                    Entrar

                </a>

            </p>

        </section>

    </main>

</body>
</html>