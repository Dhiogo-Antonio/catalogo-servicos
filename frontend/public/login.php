<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/UsuarioController.php";

$usuarioController = new UsuarioController($pdo);

$erro = '';

$email = '';

if(isset($_SESSION['usuario'])){

    header("Location: home.php");

    exit;

}


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = trim($_POST['email']);

    $senha = trim($_POST['senha']);

    $usuario = $usuarioController->login(
        $email,
        $senha
    );

    if($usuario){

        $_SESSION['usuario'] = [

            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'tipo' => $usuario['tipo']

        ];

        header("Location: home.php");

        exit;

    }else{

        $erro = "Email ou senha inválidos.";

    }

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
        Login
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

                Acesse sua conta para continuar.

            </p>



            <?php if($erro): ?>

                <div class="alert error">

                    <?= $erro ?>

                </div>

            <?php endif; ?>



            <form
                method="POST"
                class="form-card"
            >

                <label for="email">

                    Email

                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($email) ?>"
                    placeholder="Digite seu email"
                    required
                >



                <label for="senha">

                    Senha

                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    required
                >



                <button type="submit">

                    Entrar

                </button>

            </form>



            <p class="auth-footer">

                Não possui conta?

                <a href="cadastro.php">

                    Cadastrar

                </a>

            </p>

        </section>

    </main>

</body>
</html>