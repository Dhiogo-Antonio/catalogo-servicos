<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Serviço</title>
</head>
<body>
    <form method="post">
        <label for="nome_servico">Nome do Serviço: </label>
        <input type="text" name="nome_servico" required><br>

        <label for="descricao">Descrição: </label>
        <textarea name="descricao" required></textarea><br>

        <label for="preco">Preço: </label>
        <input type="number" name="preco" step="0.01" required><br>

        <label for="categoria_id">Categoria: </label>
        <select name="categoria_id" required>
            <option value="1">Design</option>
            <option value="2">Marketing</option>
            <option value="3">Desenvolvimento</option>
            <option value="4">Consultoria</option>
        </select><br>

        <label for="prazo">Prazo: </label>
        <input type="text" name="prazo" required><br>

        <label for="disponibilidade">Disponibilidade: </label>
        <input type="checkbox" name="disponibilidade" value="1"><br>

        <label for="avaliacao">Avaliação: </label>
        <input type="number" name="avaliacao" min="1" max="5" required><br>

        <label for="localizacao">Localização: </label>
        <input type="text" name="localizacao" required><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>

<?php  

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";

$ServicoController = new ServicoController($pdo);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome_servico = $_POST['nome_servico'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];
    $prazo = $_POST['prazo'];
    $disponibilidade = isset($_POST['disponibilidade']) ? 1 : 0;
    $avaliacao = $_POST['avaliacao'];
    $localizacao = $_POST['localizacao'];

    $ServicoController->cadastrar($nome_servico, $descricao, $preco, $categoria_id, $prazo, $disponibilidade, $avaliacao, $localizacao);
    header('Location: ../../../index.php');
}
?>