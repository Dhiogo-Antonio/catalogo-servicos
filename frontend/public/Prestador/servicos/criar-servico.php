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
    null

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

    <link
        rel="stylesheet"
        href="../css/style.css"
    >

    <style>

        .page {
            width: min(700px, calc(100% - 32px));
            margin: 40px auto;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #dde3ee;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .form-box h1 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #c8d2df;
            border-radius: 8px;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #2557a7;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #1d478a;
        }

        .mensagem {
            margin-bottom: 16px;
            padding: 12px;
            border-radius: 8px;
            background: #e4f7eb;
            color: #1f6f43;
            font-weight: bold;
        }

    </style>

</head>
<body>

<div class="page">

    <div class="form-box">

        <h1>
            Criar Serviço
        </h1>

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