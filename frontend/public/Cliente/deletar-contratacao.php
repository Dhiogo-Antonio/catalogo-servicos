<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "
        DELETE FROM contratacoes
        WHERE id = ?
        AND cliente_id = ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $id,
        $_SESSION['usuario']['id']
    ]);
}

header("Location: servicos-contratados.php");
exit;