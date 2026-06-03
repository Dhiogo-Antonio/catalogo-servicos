<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";

if (!isset($_SESSION['usuario'])) {

    header("Location: ../../login.php");
    exit;
}

if ($_SESSION['usuario']['tipo'] !== 'prestador') {

    header("Location: ../../home.php");
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {

    header("Location: meus-servicos.php");
    exit;
}

$servicoController = new ServicoController($pdo);

$servicoController->deletarServico(
    $id,
    $_SESSION['usuario']['id']
);

header("Location: meus-servicos.php");
exit;