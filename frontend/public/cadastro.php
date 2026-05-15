<?php
session_start();

       require_once __DIR__ . '/../../backend/app/database/database.php';

       $erro = '';
       $sucesso = '';   
       $nome = '';
       $email = '';
       $telefone = '';
       $tipo = 'cliente';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $telefone = trim($_POST['telefone'] ?? '');
        $tipo = $_POST['tipo'] ?? 'cliente';
        $tiposPermitidos = ['cliente', 'prestador'];

        if ($nome === '' || $email === '' || $senha === '' || $telefone === '') {
        $erro = 'Preencha todos os campos obrigatorios.';
}       elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Informe um e-mail valido.';
}       elseif (!in_array($tipo, $tiposPermitidos, true)) {
        $erro = 'Tipo de usuario invalido.';
}       else {
        try {
        $stmt = $pdo->prepare(
        'INSERT INTO usuarios (nome, email, senha, telefone, tipo) VALUES (:nome, :email, :senha, :telefone, :tipo)'
);

        $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT),
        ':telefone' => $telefone,
        ':tipo' => $tipo,
]);

        $sucesso = 'Cadastro realizado com sucesso. Agora voce ja pode entrar.';
        $nome = '';
        $email = '';
        $telefone = '';
        $tipo = 'cliente';
}       catch (PDOException $e) {
        if ($e->getCode() === '23000') {
        $erro = 'Este e-mail ja esta cadastrado.';
}       else {
        $erro = 'Nao foi possivel concluir o cadastro.';
}
}
}
}
?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro | Catalogo de Servicos</title>
        <link rel="stylesheet" href="css/cadastro-login.css">
        </head>
        <body class="auth-page">
        <main class="auth-shell">
        <section class="auth-panel">
        <a class="brand-link" href="index.php">Catalogo de Servicos</a>
        <h1>Criar conta</h1>
        <p class="muted">Cadastre-se para contratar ou divulgar servicos.</p>

        <?php if ($erro): ?>
        <p class="alert error"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <?php if ($sucesso): ?>
        <p class="alert success"><?= htmlspecialchars($sucesso) ?></p>
        <?php endif; ?>

        <form method="post" class="form-card">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>

        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($telefone) ?>" required>

        <label for="tipo">Tipo de conta</label>
        <select id="tipo" name="tipo">
        <option value="cliente" <?= $tipo === 'cliente' ? 'selected' : '' ?>>Cliente</option>
        <option value="prestador" <?= $tipo === 'prestador' ? 'selected' : '' ?>>Prestador</option>
        </select>

        <button type="submit">Cadastrar</button>
        </form>

        <p class="auth-footer">Ja tem conta? <a href="login.php">Entrar</a></p>
        </section>
    </main>
</body>
</html>