<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";

if (!isset($_SESSION['usuario'])) {

    header("Location: ../login.php");
    exit;
}

$clienteId = $_SESSION['usuario']['id'];




$sql = "
    SELECT
        contratacoes.*,
        servicos.nome_servico,
        servicos.preco,
        servicos.prazo,
        servicos.localizacao,
        usuarios.nome AS prestador,
        usuarios.foto

    FROM contratacoes

    INNER JOIN servicos
        ON contratacoes.servico_id = servicos.id

    INNER JOIN usuarios
        ON servicos.usuario_id = usuarios.id

    WHERE contratacoes.cliente_id = ?

    ORDER BY contratacoes.id DESC
";

$stmt = $pdo->prepare($sql);

$stmt->execute([$clienteId]);

$contratacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>Serviços Contratados</title>

    <link
        rel="stylesheet"
        href="../css/servicos-contratados.css">

</head>

<body>

    <a href="../home.php" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i>
    </a>


    <div class="container">

        <div class="top-page">

            <h1>
                Serviços Contratados
            </h1>

            <p>
                Veja todos os serviços que você contratou.
            </p>

        </div>


        <?php if (!empty($contratacoes)): ?>

            <div class="grid">

                <?php foreach ($contratacoes as $c): ?>

                    <div class="card">

                    

                        <div class="top-card">

    <img
        src="<?= !empty($c['foto']) ? '../' . $c['foto'] : '../img/user.jpg' ?>"
        class="foto">

    <div class="content-top">

        <div class="header-servico">

            <div>

                <span class="prestador">
                    <?= htmlspecialchars($c['prestador']) ?>
                </span>

                <h2>
                    <?= htmlspecialchars($c['nome_servico']) ?>
                </h2>

            </div>

            <a 
                href="deletar-contratacao.php?id=<?= $c['id'] ?>"
                class="btn-delete"
                onclick="return confirm('Deseja remover esta contratação?')"
            >
                <i class="fa-solid fa-trash"></i>
            </a>

        </div>

        <div class="status <?= $c['status'] ?>">
            <?= ucfirst($c['status']) ?>
        </div>

    </div>

</div>


                        <div class="info-area">

                            <div class="info-box">

                                <span>Preço</span>

                                <strong>

                                    R$ <?= number_format(
                                            $c['preco'],
                                            2,
                                            ',',
                                            '.'
                                        ) ?>

                                </strong>

                            </div>


                            <div class="info-box">

                                <span>Prazo</span>

                                <strong>

                                    <?= $c['prazo'] ?> dias

                                </strong>

                            </div>

                        </div>


                        <div class="mensagem">

                            <h3>
                                Sua solicitação
                            </h3>

                            <p>

                                <?= htmlspecialchars($c['mensagem']) ?>

                            </p>

                        </div>


                        <div class="localizacao">

                            <i class="fa-solid fa-map-marker-alt"></i>
                            <?= htmlspecialchars($c['localizacao']) ?>

                        </div>

                        



                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="empty">

                <h2>
                    Você ainda não contratou nenhum serviço.
                </h2>

            </div>

        <?php endif; ?>

    </div>

</body>

</html>