<?php
        session_start();

        require_once __DIR__ . '/../../backend/app/database/database.php';

        if (isset($_SESSION['usuario_id'])) {
         header('Location: index.php');
         exit;
}

        $erro = '';
        $email = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($email === '' || $senha === '') {
        $erro = 'Informe e-mail e senha.';
}       else {
        $stmt = $pdo->prepare('SELECT id, nome, email, senha, tipo FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        $senhaValida = false;
        if ($usuario) {
            $senhaValida = password_verify($senha, $usuario['senha']) || hash_equals($usuario['senha'], $senha);
}

        if ($usuario && $senhaValida) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];

         header('Location: index.php');
         exit;
}

        $erro = 'E-mail ou senha invalidos.';
}
}
?>
   <!DOCTYPE html>
       <html lang="pt-br">
       <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Catalogo de Servicos</title>
        <link rel="stylesheet" href="css/style.css">
        </head>
        <body class="auth-page">
        <main class="auth-shell">
        <section class="auth-panel">
        <a class="brand-link" href="index.php">Catalogo de Servicos</a>
        <h1>Entrar</h1>
        <p class="muted">Acesse sua conta para continuar.</p>

        <?php if ($erro): ?>
        <p class="alert error"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form method="post" class="form-card">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>

        <button type="submit">Entrar</button>
        </form>

            <p class="auth-footer">Nao tem conta? <a href="cadastro.php">Cadastrar</a></p>
        </section>
    </main>
</body>
</html>
