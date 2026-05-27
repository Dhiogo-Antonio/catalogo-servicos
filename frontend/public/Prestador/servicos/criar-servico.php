<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";

$servicoController = new ServicoController($pdo);

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nomeServico = $_POST['nome_servico'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $prazo = $_POST['prazo'];
    $categoriaId = $_POST['categoria_id'];
    $localizacao = $_POST['localizacao'];

    $usuarioId = $_SESSION['usuario']['id'];

    $criou = $servicoController->criar(
    $usuarioId,
    $categoriaId,
    $nomeServico,
    $descricao,
    $preco,
    $prazo,
    $localizacao

);

    if ($criou) {

        $mensagem = "Serviço criado com sucesso!";

        header("Location: meus-servicos.php");
        exit;
    } else {

        $mensagem = "Erro ao criar serviço.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Criar Serviço
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link
        rel="stylesheet"
        href="../css/style.css"
    >

    <link rel="stylesheet" href="../../css/criar-servico.css">


</head>
<body>
    

<div class="page">

    <div class="form-box">

    <div class="logo">
            <div class="logo-icon">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <div class="logo-text">
                <span class="logo-name">ProServiços</span>
            </div>
        </div>
        <br>


        <?php if($mensagem): ?>

            <div class="mensagem">
                <?= $mensagem ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="form-group">

                <label>
                    Nome do serviço
                </label>

                <input
                    type="text"
                    name="nome_servico"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Descrição
                </label>

                <textarea
    name="descricao"
    maxlength="3000"
    placeholder="Descreva detalhadamente seu serviço..."
    required
></textarea>

            </div>


            <div class="form-group">

                <label>
                    Preço
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="preco"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Prazo (dias)
                </label>

                <input
                    type="number"
                    name="prazo"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Categoria
                </label>

                <select name="categoria_id" required>

                    <option value="">
                        Selecione
                    </option>

                    <option value="1">
                        Design
                    </option>

                    <option value="2">
                        Marketing
                    </option>

                    <option value="3">
                        Desenvolvimento
                    </option>

                    <option value="4">
                        Consultoria
                    </option>

                    <option value="5">
                        Manutenção
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>
                    Localização
                </label>

                <input
                    type="text"
                    name="localizacao"
                >

            </div>


            <button
                type="submit"
                class="btn-submit"
            >
                Publicar Serviço
            </button>

        </form>

    </div>

</div>

</body>
</html>