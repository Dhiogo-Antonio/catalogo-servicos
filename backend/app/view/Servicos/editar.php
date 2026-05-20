<?php

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";

$ServicoController = new ServicoController($pdo);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $servico = $ServicoController->buscarServico($id);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço</title>
</head>
<body>
    <form method="post">
        <label for="nome_servico">Nome do Serviço: </label>
        <input type="text" name="nome_servico" value="<?= $servico['nome'] ?>" required><br>

        <label for="descricao">Descrição: </label>
        <textarea name="descricao" required><?= $servico['descricao'] ?></textarea><br>

        <label for="preco">Preço: </label>
        <input type="number" name="preco" step="0.01" value="<?= $servico['preco'] ?>" required><br>

        <label for="prazo">Prazo: </label>
        <input type="text" name="prazo" value="<?= $servico['prazo'] ?>" required><br>

        <label for="disponibilidade">Disponibilidade: </label>
        <input type="checkbox" name="disponibilidade" value="1" <?= $servico['disponibilidade'] ? 'checked' : '' ?>><br>

        <label for="avaliacao">Avaliação: </label>
        <input type="number" name="avaliacao" min="1" max="5" value="<?= $servico['avaliacao'] ?>" required><br>

        <label for="localizacao">Localização: </label>
        <input type="text" name="localizacao" value="<?= $servico['localizacao'] ?>" required><br>

        <input type="submit" value="Atualizar"> 
    </form>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome_servico = $_POST['nome_servico'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $prazo = $_POST['prazo'];
    $disponibilidade = isset($_POST['disponibilidade']) ? 1 : 0;
    $avaliacao = $_POST['avaliacao'];
    $localizacao = $_POST['localizacao'];

    $ServicoController->editar($nome_servico, $descricao, $preco, $prazo, $disponibilidade, $avaliacao, $localizacao, $id);

    header('Location: ../../../index.php');
}
else {
    header('Location: Listar.php');
}
?>