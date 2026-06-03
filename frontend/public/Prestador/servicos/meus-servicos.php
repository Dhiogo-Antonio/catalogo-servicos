<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/middleware/auth.php";


if (!isset($_SESSION['usuario'])) {

    header("Location: ../login.php");
    exit;
}


if ($_SESSION['usuario']['tipo'] !== 'prestador') {

    header("Location: ../home.php");
    exit;
}

$servicoController = new ServicoController($pdo);

$prestadorId = $_SESSION['usuario']['id'];

$servicos = $servicoController->listarPorPrestador($prestadorId);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Meus Serviços</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/meus-servicos.css">
</head>

<body>


    <div class="topo">

        <a href="../../perfil.php" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <h1>
            Meus Serviços
        </h1>

        <a href="criar-servico.php" class="btn-criar">
            + Criar serviço
        </a>

    </div>

    <section class="servicos">

        <?php if (empty($servicos)): ?>

            <div class="vazio">

                <i class="fa-solid fa-briefcase"></i>

                <h2>
                    Nenhum serviço criado
                </h2>

                <p>
                    Crie seu primeiro serviço para começar a receber clientes.
                </p>

            </div>

        <?php else: ?>

            <div class="servicos-grid">

                <?php foreach ($servicos as $servico): ?>

                    <div class="card-servico">

    <h3>
        <?= $servico['nome_servico'] ?>
    </h3>

    <p class="descricao">
        <?= $servico['descricao'] ?>
    </p>

    <div class="info">

        <span>
    <i class="fa-regular fa-clock"></i>
    <?= $servico['prazo'] ?> dia(s)
</span>

<div class="preco">
        R$ <?= number_format($servico['preco'], 2, ',', '.') ?>
    </div>
    </div>

    

    <div class="acoes">

        <button
            class="btn-editar"
            onclick="abrirModal(
                '<?= $servico['id'] ?>',
                '<?= $servico['nome_servico'] ?>',
                '<?= $servico['descricao'] ?>',
                '<?= $servico['preco'] ?>',
                '<?= $servico['prazo'] ?>',
                '<?= $servico['localizacao'] ?>',
                '<?= $servico['categoria_id'] ?>'
            )"
        >
            Editar
        </button>

        <a href="deletar-servico.php?id=<?= $servico['id'] ?>">
            Excluir
        </a>

    </div>

</div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </section>
    <div class="modal" id="modalEditar">

    <div class="modal-content">

        <div class="modal-header">

            <h2>
                Editar Serviço
            </h2>

            <span
                class="fechar"
                onclick="fecharModal()">
                &times;
            </span>

        </div>

        <form
            method="POST"
            action="editar-servico.php">

            <input
                type="hidden"
                name="id"
                id="edit-id">

            <div class="form-group">

                <label>
                    Nome do serviço
                </label>

                <input
                    type="text"
                    name="nome_servico"
                    id="edit-nome"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Descrição
                </label>

                <textarea
                    name="descricao"
                    id="edit-descricao"
                    required></textarea>

            </div>

            <div class="form-group">

                <label>
                    Preço
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="preco"
                    id="edit-preco"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Prazo (dias)
                </label>

                <input
                    type="number"
                    name="prazo"
                    id="edit-prazo"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Categoria
                </label>

                <select
                    name="categoria_id"
                    id="edit-categoria"
                    required
                >

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

                </select>

            </div>

            <div class="form-group">

                <label>
                    Localização
                </label>

                <input
                    type="text"
                    name="localizacao"
                    id="edit-localizacao">

            </div>

            <button
                type="submit"
                class="btn-salvar">

                Salvar alterações

            </button>

        </form>

    </div>

</div>
</body>

</html>
<script src="../../js/meus-servicos.js"></script>