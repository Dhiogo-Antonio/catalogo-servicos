<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";

$servicoController = new ServicoController($pdo);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id = $_POST['id'];

    $nome_servico = $_POST['nome_servico'];

    $descricao = $_POST['descricao'];

    $preco = $_POST['preco'];

    $prazo = $_POST['prazo'];

    $categoria_id = $_POST['categoria_id'];

    $servicoController->editar(
        $id,
        $nome_servico,
        $descricao,
        $preco,
        $prazo,
        $categoria_id
    );

    header("Location: meus-servicos.php");

    exit;
}
?>