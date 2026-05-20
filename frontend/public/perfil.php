<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

$servicoController = new ServicoController($pdo);

$servicos = $usuario['tipo'] === 'prestador'
    ? $servicoController->listarPorPrestador($usuario['id'])
    : [];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Perfil</title>

<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#fafafa;
    color:#111;
}

/* CONTAINER */
.container{
    max-width:1000px;
    margin:0 auto;
}

/* BANNER MAIS LIMPO */
.banner{
    height:180px;
    background:linear-gradient(90deg,#2563eb,#1e3a8a);
}

/* HEADER PERFIL */
.profile{
    background:#fff;
    border-radius:12px;
    margin-top:-50px;
    padding:20px;
    display:flex;
    gap:15px;
    align-items:center;
    border:1px solid #eee;
}

.profile img{
    width:85px;
    height:85px;
    border-radius:50%;
    object-fit:cover;
}

.name{
    font-size:20px;
    font-weight:700;
}

.meta{
    font-size:13px;
    color:#666;
}

.badge{
    display:inline-block;
    padding:3px 10px;
    font-size:12px;
    background:#f3f4f6;
    border-radius:20px;
    margin-top:5px;
}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:15px;
    margin-top:15px;
}

/* CARD BASE */
.card{
    background:#fff;
    border:1px solid #eee;
    border-radius:12px;
    padding:16px;
}

/* SERVIÇOS */
.service{
    padding:12px 0;
    border-bottom:1px solid #f0f0f0;
}

.service:last-child{
    border-bottom:none;
}

.service h4{
    margin:0;
    font-size:15px;
}

.service p{
    margin:5px 0 0;
    font-size:13px;
    color:#666;
}

.price{
    margin-top:6px;
    font-weight:700;
    color:#2563eb;
}

/* BTN */
.btn{
    display:inline-block;
    margin-top:12px;
    background:#111827;
    color:#fff;
    padding:10px 14px;
    border-radius:8px;
    text-decoration:none;
    font-size:13px;
}

.info p{
    margin:8px 0;
    font-size:14px;
    color:#444;
}

.rating{
    font-size:13px;
    color:#f59e0b;
    margin-top:4px;
}

</style>

</head>

<body>

<div class="container">

    <div class="banner"></div>

    <!-- PERFIL -->
    <div class="profile">

        <img src="<?= $usuario['foto'] ?? 'img/user.png' ?>">

        <div>

            <div class="name"><?= $usuario['nome'] ?></div>

            <div class="meta"><?= $usuario['email'] ?></div>

            <div class="badge"><?= $usuario['tipo'] ?></div>

            <div class="rating">★★★★★ 4.8</div>

        </div>

    </div>

    <!-- GRID -->
    <div class="grid">

        <!-- SERVIÇOS -->
        <div class="card">

            <h3 style="margin-top:0;">Serviços</h3>

            <?php foreach ($servicos as $s): ?>

                <div class="service">

                    <h4><?= $s['nome_servico'] ?></h4>

                    <p><?= mb_strimwidth($s['descricao'],0,110,'...') ?></p>

                    <div class="price">
                        R$ <?= number_format($s['preco'],2,',','.') ?>
                    </div>

                </div>

            <?php endforeach; ?>

            <a class="btn" href="Prestador/servicos/meus-servicos.php">
                Ver todos os serviços
            </a>

        </div>

        <!-- INFO -->
        <div class="card info">

            <h3 style="margin-top:0;">Informações</h3>

            <p><strong>Email:</strong><br><?= $usuario['email'] ?></p>

            <p><strong>Telefone:</strong><br><?= $usuario['telefone'] ?></p>

            <p><strong>Tipo:</strong><br><?= $usuario['tipo'] ?></p>

        </div>

    </div>

</div>

</body>

</html>