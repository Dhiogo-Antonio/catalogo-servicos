<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/UsuarioController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];

$usuarioController = new UsuarioController($pdo);
$servicoController = new ServicoController($pdo);

$usuario = $usuarioController->buscarUsuario($usuarioId);
$servicos = [];


if ($usuario['tipo'] === 'prestador') {
    $servicos = $servicoController->listarPorPrestador($usuarioId);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Perfil</title>
<link rel="stylesheet" href="css/perfil.css">
</head>

<body>

<a href="home.php" class="btn-back">
    <svg class="icon-back" viewBox="0 0 24 24" fill="none">
        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>

<div class="container">

    <div class="banner"></div>

    <div class="profile-bar">
        <div class="profile-left">
            <div class="avatar-wrap">
                <img class="avatar" src="<?= !empty($servico['foto']) ? $servico['foto'] : '../img/user.jpg' ?>">
                <div class="avatar" style="display:none;">
                    <?= strtoupper(substr($usuario['nome'], 0, 2)) ?>
                </div>
                <div class="online-dot"></div>
            </div>
            <div class="profile-info">
                <div class="name"><?= htmlspecialchars($usuario['nome']) ?></div>
                <div class="meta"><?= htmlspecialchars($usuario['email']) ?></div>
                <div class="tags">
                    <span class="badge badge-tipo"><?= htmlspecialchars($usuario['tipo']) ?></span>
                </div>
            </div>
        </div>
        <div class="profile-actions">
            <a href="logout.php">Sair</a>
        </div>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Serviços</div>
            <div class="stat-value"><?= count($servicos) ?></div>
            <div class="stat-sub">ativos</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Avaliação</div>
            <div class="stat-value">4.8</div>
            <div class="stat-sub">38 avaliações</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Concluídos</div>
            <div class="stat-value">94</div>
            <div class="stat-sub">96% satisfação</div>
        </div>
    </div>

    <div class="grid">

        <div class="card">
            <div class="card-title"><h2>Seus Serviços</h2></div>

            <?php foreach ($servicos as $s): ?>
            <div class="service">
                <div>
                    <h4><?= htmlspecialchars($s['nome_servico']) ?></h4>
                    <p><?= mb_strimwidth(htmlspecialchars($s['descricao']), 0, 100, '...') ?></p>
                </div>
                <div class="price">
                    R$ <?= number_format($s['preco'], 2, ',', '.') ?>
                </div>
            </div>
            <?php endforeach; ?>

            <a class="btn" href="Prestador/servicos/meus-servicos.php">
                Ver todos os serviços →
            </a>
        </div>

        <div class="card">
            <div class="card-title"><h2>Informações</h2></div>

            <div class="info-row">
                <div class="info-icon">✉</div>
                <div>
                    <div class="info-label">Email</div>
                    <div class="info-val"><?= htmlspecialchars($usuario['email']) ?></div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">☎</div>
                <div>
                    <div class="info-label">Telefone</div>
                    <div class="info-val"><?= htmlspecialchars($usuario['telefone']) ?></div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">◈</div>
                <div>
                    <div class="info-label">Tipo de conta</div>
                    <div class="info-val"><?= htmlspecialchars($usuario['tipo']) ?></div>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>