<?php

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";

$ServicoController = new ServicoController($pdo);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $ServicoController->deletar($id);
    header('Location: ../../index.php');
} else {
    header('Location: ../../../index.php');
}
?>