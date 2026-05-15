<?php
       session_start();

       require_once __DIR__ . '/../../backend/app/database/database.php';

       if (!isset($_SESSION['usuario_id'])) {
       header('Location: login.php');
       exit;
}        

       if (($_SESSION['usuario_tipo'] ?? '') !== 'prestador') {
       header('Location: index.php');
       exit;
}

$erro = '';
$sucesso = '';
$nomeServico = '';
$descricao = '';  
$preco = '';
$prazo = '';
$categoria = '';
$localizacao = '';

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $nomeServico = trim($_POST['nome_servico'] ?? '');
         $descricao = trim($_POST['descricao'] ?? '');
         $preco = str_replace(',', '.', trim($_POST['preco'] ?? ''));
         $prazo = trim($_POST['prazo'] ?? '');
         $categoria = trim($_POST['categoria'] ?? '');
         $localizacao = trim($_POST['localizacao'] ?? '');

            if ($nomeServico === '' || $preco === '' || $prazo === '' || $categoria === '') {
            $erro = 'Preencha nome, categoria, preco e prazo.';
}           elseif (!is_numeric($preco) || (float) $preco <= 0) {
            $erro = 'Informe um preco valido.';
}           elseif (!ctype_digit($prazo) || (int) $prazo <= 0) {
            $erro = 'Informe o prazo em dias.';
}           else {
            try {
            $pdo->beginTransaction();

            $stmtCategoria = $pdo->prepare('SELECT id FROM categorias WHERE nome = :nome LIMIT 1');
            $stmtCategoria->execute([':nome' => $categoria]);
            $categoriaExistente = $stmtCategoria->fetch(PDO::FETCH_ASSOC);

            if ($categoriaExistente) {
            $categoriaId = $categoriaExistente['id'];
}           else {
            $stmtNovaCategoria = $pdo->prepare('INSERT INTO categorias (nome) VALUES (:nome)');
            $stmtNovaCategoria->execute([':nome' => $categoria]);
            $categoriaId = $pdo->lastInsertId();
}

            $stmtServico = $pdo->prepare(
            'INSERT INTO servicos
            (usuario_id, categoria_id, nome_servico, descricao, preco, prazo, localizacao)
            VALUES
            (:usuario_id, :categoria_id, :nome_servico, :descricao, :preco, :prazo, :localizacao)'
);

            $stmtServico->execute([
            ':usuario_id' => $_SESSION['usuario_id'],
            ':categoria_id' => $categoriaId,
            ':nome_servico' => $nomeServico,
            ':descricao' => $descricao,
            ':preco' => (float) $preco,
            ':prazo' => (int) $prazo,
            ':localizacao' => $localizacao,
]);

            $pdo->commit();

            $sucesso = 'Servico cadastrado com sucesso.';
            $nomeServico = '';
            $descricao = '';
            $preco = '';
            $prazo = '';
            $categoria = '';
            $localizacao = '';
}           catch (PDOException $e) {
            if ($pdo->inTransaction()) {
            $pdo->rollBack();
}

            $erro = 'Nao foi possivel cadastrar o servico.';
}
}
}
?>
<!DOCTYPE html>
      <html lang="pt-br">
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Cadastrar Servico | Catalogo de Servios</title>
       <link rel="stylesheet" href="css/style.css">
</head>
<body>
        <header class="site-header">
        <nav class="nav">
        <a class="logo" href="index.php">Catalogo de Serviços</a>
        <div class="nav-actions">
        <span>Ola, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a class="button ghost" href="index.php">Ver servicos</a>
        <a class="button ghost" href="index.php?sair=1">Sair</a>
        </div>
        </nav>
        </header>

                <main class="page-shell">
                <section class="auth-panel form-panel">
                <a class="brand-link" href="index.php">Voltar para o catalogo</a>
                <h1>Cadastrar servico</h1>
                <p class="muted">Publique um servico para aparecer na pagina inicial.</p>

                <?php if ($erro): ?>
                <p class="alert error"><?= htmlspecialchars($erro) ?></p>
                <?php endif; ?>

                <?php if ($sucesso): ?>
                <p class="alert success"><?= htmlspecialchars($sucesso) ?></p>
                <?php endif; ?>

                <form method="post" class="form-card">
                <label for="nome_servico">Nome do serviço</label>
                <input type="text" id="nome_servico" name="nome_servico" value="<?= htmlspecialchars($nomeServico) ?>" required>

                <label for="categoria">Categoria</label>
                <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($categoria) ?>" placeholder="Ex: Eletrica, Beleza, Informatica" required>

                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($descricao) ?></textarea>

                <div class="form-grid">
                <div>
                <label for="preco">Preço</label>
                <input type="number" id="preco" name="preco" value="<?= htmlspecialchars($preco) ?>" min="0.01" step="0.01" required>
                </div>

                <div>
                <label for="prazo">Prazo em dias</label>
                <input type="number" id="prazo" name="prazo" value="<?= htmlspecialchars($prazo) ?>" min="1" step="1" required>
                </div>
                </div>
                <label for="localizacao">Localização</label>
                <input type="text" id="localizacao" name="localizacao" value="<?= htmlspecialchars($localizacao) ?>" placeholder="Ex: Centro, Sao Paulo">

                <button type="submit">Cadastrar serviço</button>
            </form>
        </section>
    </main>
</body>
</html>