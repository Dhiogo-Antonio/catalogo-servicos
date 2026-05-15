<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";

$servicoController = new ServicoController($pdo);

$servicos = $servicoController->listar();

?>     

<h1>Serviços</h1>

<div class="servicos">

<?php foreach($servicos as $servico): ?>

    <div class="card">

        <h3>
            <?= $servico['nome_servico'] ?>
        </h3>

        <p>
            <?= $servico['descricao'] ?>
        </p>

        <span>
            R$ <?= $servico['preco'] ?>
        </span>

        <small>
            Prestador:
            <?= $servico['prestador'] ?>
        </small>

    </div>

<?php endforeach; ?>

</div>