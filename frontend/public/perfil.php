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
<style>

*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #11172a;
    color: #0f172a;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin: 20px;
    padding: 10px 14px;
    border-radius: 10px;

    background: #f1f5f9;
    color: #0f172a;

    text-decoration: none;
    font-size: 13px;
    font-weight: 600;

    border: 1px solid #e2e8f0;

    transition: 0.25s ease;
}

.btn-back:hover {
    background: #e2e8f0;
    transform: translateX(-3px);
}

.icon-back {
    width: 16px;
    height: 16px;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding-top: 10rem;
}


/* PROFILE BAR */
.profile-bar {
    background: #fff;
    margin: 0 16px;
    border-radius: 16px;
    margin-top: -56px;
    padding: 20px 24px;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 16px;
}

.profile-left {
    display: flex;
    align-items: flex-end;
    gap: 18px;
}

.avatar-wrap {
    position: relative;
    flex-shrink: 0;
}

.avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    background: #dbeafe;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    font-weight: 700;
    color: #1d4ed8;
}

.online-dot {
    position: absolute;
    bottom: 4px;
    right: 4px;
    width: 14px;
    height: 14px;
    background: #22c55e;
    border-radius: 50%;
    border: 2.5px solid #fff;
}

.profile-info {
    padding-bottom: 4px;
}

.name {
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 3px;
}

.meta {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 8px;
}

.tags {
    display: flex;
    gap: 6px;
    align-items: center;
}

.badge {
    padding: 3px 12px;
    font-size: 11px;
    font-weight: 600;
    border-radius: 20px;
    letter-spacing: .3px;
}

.badge-tipo {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
}

.badge-rating {
    background: #fefce8;
    color: #854d0e;
    border: 1px solid #fef08a;
}

.profile-actions {
    display: flex;
    gap: 8px;
    padding-bottom: 4px;
}

.profile-actions a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-bottom: 1rem;
    padding: 10px 16px;
    border-radius: 10px;

    font-size: 13px;
    font-weight: 600;
    text-decoration: none;

    color: #fff;
    background: #11172a;


    transition: all 0.25s ease;
}

.profile-actions a:hover {
    background: #161e36;
    color: #fff;

    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(22, 35, 71, 0.25);
}



/* STATS */
.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin: 16px 16px 0;
}

.stat-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px 20px;
}

.stat-label {
    font-size: 12px;
    color: #64748b;
    margin-bottom: 6px;
    font-weight: 500;
}

.stat-value {
    font-size: 22px;
    font-weight: 700;
    color: #0f172a;
}

.stat-sub {
    font-size: 11px;
    color: #22c55e;
    margin-top: 2px;
    font-weight: 600;
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 12px;
    margin: 12px 16px 0;
}

/* CARD */
.card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 20px 22px;
}

.card-title {
    display: flex;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f1f5f9;
}

/* SERVIÇOS */
.service {
    padding: 14px 0;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
}

.service:last-of-type {
    border-bottom: none;
}

.service h4 {
    font-size: 14px;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 4px;
}

.service p {
    font-size: 12px;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
}

.price {
    font-size: 15px;
    font-weight: 700;
    color: #1b274c;
    white-space: nowrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 16px;
    background: #11172a;
    color: #fff;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.25s ease;
}

.btn:hover{
    background: #161e36;
    color: #fff;

    transform: translateY(-2px);
}

/* INFORMAÇÕES */
.info-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-row:last-child {
    border-bottom: none;
}

.info-icon {
    width: 36px;
    height: 36px;
    border-radius: 9px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    color: #11172a;
    flex-shrink: 0;
}

.info-label {
    font-size: 11px;
    color: #94a3b8;
    margin-bottom: 1px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .4px;
}

.info-val {
    font-size: 13px;
    color: #0f172a;
    font-weight: 500;
}

</style>
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