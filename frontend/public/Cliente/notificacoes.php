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

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:"Poppins", sans-serif;
            background:#11172a;
            color:#fff;
            line-height:1.6;

            padding:40px 8%;
        }

        .topo{
            display:flex;
            align-items:center;
            gap:20px;

            margin-bottom:40px;
        }

        .btn-back{
            width:48px;
            height:48px;

            display:flex;
            align-items:center;
            justify-content:center;

            border-radius:14px;

            background:#fff;
            color:#11172a;

            text-decoration:none;

            transition:.3s;
        }

        .btn-back:hover{
            transform:translateY(-3px);
            background:#e2e8f0;
        }

        .topo h1{
            font-size:38px;
            font-weight:700;
            color:#fff;
        }

        .notificacoes-grid{
            display:flex;
            flex-direction:column;
            gap:25px;
        }

        .card{
            background:#fff;
            border-radius:24px;

            padding:28px;

            color:#11172a;

            box-shadow:0 10px 30px rgba(0,0,0,.18);
        }

        .card h3{
            font-size:24px;
            margin-bottom:10px;
        }

        .card p{
            color:#475569;
            margin-bottom:10px;
        }

        .status{
            display:inline-block;

            margin-top:10px;

            padding:8px 14px;

            border-radius:999px;

            font-size:12px;
            font-weight:700;

            text-transform:uppercase;
        }

        .pendente{
            background:#facc15;
            color:#111827;
        }

        .aceito{
            background:#22c55e;
            color:#fff;
        }

        .recusado{
            background:#ef4444;
            color:#fff;
        }

        .concluido{
            background:#2563eb;
            color:#fff;
        }

        .vazio{
            background:#fff;

            color:#11172a;

            padding:70px 30px;

            border-radius:24px;

            text-align:center;
        }

        .vazio i{
            font-size:60px;
            margin-bottom:20px;
            color:#64748b;
        }

    </style>

</head>

<body>

    <div class="topo">

        <a href="../home.php" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <h1>Minhas Contratações</h1>

    </div>

    <?php if (count($contratos) > 0): ?>

        <div class="notificacoes-grid">

            <?php foreach ($contratos as $contrato): ?>

                <div class="card">

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

                    <span class="status <?= $contrato['status'] ?>">
                        <?= $contrato['status'] ?>
                    </span>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="vazio">

            <i class="fa-solid fa-bell-slash"></i>

            <h2>Nenhuma contratação encontrada</h2>

            <p>
                Você ainda não contratou nenhum serviço.
            </p>

        </div>

    <?php endif; ?>

</body>

</html>