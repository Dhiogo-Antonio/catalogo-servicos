<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";


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
    <link rel="stylesheet" href="../../css/meus-servicos.css">
</head>

<body>

    <header>

        <div class="logo">
            Catálogo de Serviços
        </div>

        <nav>

            <a href="../home.php">
                Voltar
            </a>



            <a href="criar-servico.php" class="btn-primary">
                + Criar serviço
            </a>

        </nav>

    </header>


    <section class="servicos">

        <h2>Seus serviços</h2>

        <div class="servicos-grid">

            <?php if (empty($servicos)): ?>

                <p>
                    Você ainda não criou serviços.
                </p>

            <?php endif; ?>


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
                            <?= $servico['prazo'] ?> dias
                        </span>

                        <span>
                            ⭐ <?= $servico['avaliacao'] ?? 0 ?>
                        </span>

                    </div>

                    <div class="preco">
                        R$ <?= $servico['preco'] ?>
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
                    Prazo
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
<script>

function abrirModal(
    id,
    nome,
    descricao,
    preco,
    prazo,
    localizacao,
    categoria
){

    document.getElementById('edit-id').value = id;

    document.getElementById('edit-nome').value = nome;

    document.getElementById('edit-descricao').value = descricao;

    document.getElementById('edit-preco').value = preco;

    document.getElementById('edit-prazo').value = prazo;

    document.getElementById('edit-localizacao').value = localizacao;

    document.getElementById('edit-categoria').value = categoria;

    document.getElementById('modalEditar').style.display = 'flex';
}

function fecharModal(){

    document.getElementById('modalEditar').style.display = 'none';
}

</script>