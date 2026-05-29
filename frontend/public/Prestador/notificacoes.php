<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ContratacaoController.php";


$contratacaoController = new ContratacaoController($pdo);

$prestadorId = $_SESSION['usuario']['id'];

if (isset($_GET['acao'], $_GET['id'])) {

    $id = $_GET['id'];

    if ($_GET['acao'] === 'aceitar') {

        $contratacaoController->atualizarStatus(
            $id,
            'aceito'
        );

    } elseif ($_GET['acao'] === 'recusar') {

        $contratacaoController->deletar($id);

    } elseif ($_GET['acao'] === 'concluir') {

        $contratacaoController->atualizarStatus(
            $id,
            'concluido'
        );
    }

    header("Location: notificacoes.php");
    exit;
}

$contratos = $contratacaoController->listarParaPrestador($prestadorId);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notificações</title>
    <link rel="stylesheet" href="../css/notificacoes.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<div class="topo">

    <a href="../home.php" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <h1>
        <i class="fa-solid fa-bell"></i>
        Notificações
    </h1>

</div>

<?php if (count($contratos) > 0): ?>

<div class="notificacoes-grid">

<?php foreach ($contratos as $contrato): ?>

<div class="card-notificacao">

    <div class="card-topo">

        <div class="cliente">

            <div class="icon-cliente">
                <img
        src="<?= !empty($cliente['foto'])
            ? '../../uploads/' . $cliente['foto']
            : '../../img/user.jpg' ?>"
        alt="Cliente"
        class="foto-cliente">
            </div>

            <div class="info-cliente">

                <h3>
                    <?= $contrato['cliente'] ?>
                </h3>

                <span>
                    Quer contratar seu serviço
                </span>:
                    <?= $contrato['nome_servico'] ?>
                </span>

            </div>

        </div>

        <div class="status <?= $contrato['status'] ?>">
            <?= $contrato['status'] ?>
        </div>

    </div>

    <p class="mensagem">
        <?= $contrato['mensagem'] ?>
    </p>

    <?php if (strtolower(trim($contrato['status'])) === 'pendente'): ?>

<div class="acoes">

    <a
        href="?acao=aceitar&id=<?= $contrato['id'] ?>"
        class="btn-acao btn-aceitar">

        <i class="fa-solid fa-check"></i>
        Aceitar

    </a>

    <a
        href="?acao=recusar&id=<?= $contrato['id'] ?>"
        class="btn-acao btn-recusar"
        onclick="return confirmarRecusa()">
        

        <i class="fa-solid fa-xmark"></i>
        Recusar

    </a>

</div>

<?php endif; ?>


<?php if ($contrato['status'] === 'aceito'): ?>

<div class="acoes">

    <a
        href="?acao=concluir&id=<?= $contrato['id'] ?>"
        class="btn-acao btn-concluir">

        <i class="fa-solid fa-circle-check"></i>
        Concluir serviço

    </a>

</div>

<?php endif; ?>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<div class="vazio">

    <i class="fa-regular fa-bell-slash"></i>

    <h2>
        Nenhuma notificação
    </h2>

    <p>
        Você ainda não recebeu solicitações de contratação.
    </p>

</div>

<?php endif; ?>

</body>
</html>
<script src="../js/notificacoes-prestador.js"></script>