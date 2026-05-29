<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";

if (!isset($_SESSION['usuario'])) {

    header("Location: ../login.php");
    exit;
}

$clienteId = $_SESSION['usuario']['id'];

$sql = "SELECT
            c.*,
            s.nome_servico,
            u.nome AS prestador
        FROM contratacoes c
        INNER JOIN servicos s
            ON s.id = c.servico_id
        INNER JOIN usuarios u
            ON u.id = s.usuario_id
        WHERE c.cliente_id = ?
        AND c.status != 'pendente'
        ORDER BY c.id DESC";
$stmt = $pdo->prepare($sql);

$stmt->execute([$clienteId]);

$contratos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Minhas Contratações</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/notificacoes-cliente.css">

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

                <div class="card">

                    <a
                        href="deletar-notificacao.php?id=<?= $contrato['id'] ?>"
                        class="btn-fechar">
                        <i class="fa-solid fa-xmark"></i>
                    </a>

                    <h3>
                        <?= htmlspecialchars($contrato['nome_servico']) ?>
                    </h3>

                    <p>
                        Prestador:
                        <strong>
                            <?= htmlspecialchars($contrato['prestador']) ?>
                        </strong>
                    </p>

                    <p>
                        <?= htmlspecialchars($contrato['mensagem']) ?>
                    </p>

                    <?php if ($contrato['status'] === 'recusado'): ?>

                        <div class="alerta-recusa">

                            <i class="fa-solid fa-triangle-exclamation"></i>

                            <div>

                                <strong style="color: red;">
                                    Contratação recusada
                                </strong>

                                <p>
                                    O valor pago foi devolvido para sua conta.
                                </p>

                            </div>

                        </div>

                    <?php endif; ?>

                    <span class="status <?= $contrato['status'] ?>">
                        <?= $contrato['status'] ?>
                    </span>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="vazio">

            <i class="fa-solid fa-bell-slash"></i>

            <h2>
                Nenhuma notificação
            </h2>

            <p>
                Você ainda não contratou nenhum serviço.
            </p>

        </div>

    <?php endif; ?>

</body>

</html>