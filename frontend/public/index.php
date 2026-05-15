<?php
   session_start();

   require_once __DIR__ . '/../../backend/app/database/database.php';

   if (isset($_GET['sair'])) {
   session_destroy();
   header('Location: login.php');
   exit;
}

   $servicos = [];
   $erro = '';

    try {  
    $sql = "SELECT servicos.*, usuarios.nome AS prestador, categorias.nome AS categoria
    FROM servicos
    INNER JOIN usuarios ON usuarios.id = servicos.usuario_id
    LEFT JOIN categorias ON categorias.id = servicos.categoria_id
    WHERE servicos.disponibilidade = 1
    ORDER BY servicos.criado_em DESC";

     $stmt = $pdo->query($sql);
     $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}    catch (PDOException $e) {
     $erro = 'Nao foi possivel carregar os servicos.';
}

     $usuarioLogado = isset($_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo de Servicos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body> 
                <header class="site-header">
                <nav class="nav">
                <a class="logo" href="index.php">Catalogo de Serviços</a>
                <div class="nav-actions">
                <?php if ($usuarioLogado): ?>
                <span>Ola, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
                <?php if (($_SESSION['usuario_tipo'] ?? '') === 'prestador'): ?>
                <a class="button" href="cadastrar_servico.php">Cadastrar servico</a>
                <?php endif; ?>
                <a class="button ghost" href="index.php?sair=1">Sair</a>
                <?php else: ?>
                <a href="login.php">Entrar</a>
                <a class="button" href="cadastro.php">Cadastrar</a>
                <?php endif; ?>
               </div>
              </nav>
              </header>

            <main>
            <section class="hero">
            <div>
            <p class="eyebrow">Encontre profissionais</p>
            <h1>Serviços perto de você, em um só lugar.</h1>
            <p>Consulte prestadores, compare valores e escolha o serviço ideal para sua necessidade.</p>
            </div>
            </section>

            <section class="content-section">
            <div class="section-title">
            <h2>Serviços disponiveis</h2>
            <p><?= count($servicos) ?> resultado(s)</p>
            </div>

            <?php if ($erro): ?>
            <p class="alert error"><?= htmlspecialchars($erro) ?></p>
            <?php elseif (empty($servicos)): ?>
            <div class="empty-state">
            <h3>Nenhum serviço cadastrado ainda</h3>
            <p>Quando houver serviços disponiveis, eles aparecerão aqui.</p>
            </div>
            <?php else: ?>
            <div class="service-grid">
            <?php foreach ($servicos as $servico): ?>
            <article class="service-card">
            <div>
            <span class="tag"><?= htmlspecialchars($servico['categoria'] ?? 'Servico') ?></span>
            <h3><?= htmlspecialchars($servico['nome_servico']) ?></h3>
            <p><?= htmlspecialchars($servico['descricao'] ?? 'Sem descricao informada.') ?></p>
            </div>
            <div class="service-meta">
            <strong>R$ <?= number_format((float) $servico['preco'], 2, ',', '.') ?></strong>
            <span><?= (int) $servico['prazo'] ?> dia(s)</span>
            </div>
            <div class="provider">
            <span>Prestador</span>
            <strong><?= htmlspecialchars($servico['prestador']) ?></strong>
</div>
</article>
<?php endforeach; ?>
</div>
<?php endif; ?>
</section>
</main>
</body>
</html>
