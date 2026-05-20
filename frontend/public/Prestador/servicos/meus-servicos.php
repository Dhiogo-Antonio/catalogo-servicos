<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";


if(!isset($_SESSION['usuario'])){

    header("Location: ../login.php");
    exit;

}


if($_SESSION['usuario']['tipo'] !== 'prestador'){

    header("Location: ../home.php");
    exit;

}

$servicoController = new ServicoController($pdo);

$prestadorId = $_SESSION['usuario']['id'];

$servicos = $servicoController->listarPorUsuario($prestadorId);

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

        <?php if(empty($servicos)): ?>

            <p>
                Você ainda não criou serviços.
            </p>

        <?php endif; ?>


        <?php foreach($servicos as $servico): ?>

            <div class="card-servico">

                <h3>
                    <?= $servico['titulo'] ?>
                </h3>

                <p>
                    <?= $servico['descricao_curta'] ?>
                </p>

                <div class="info">

                    <span>
                        <?= $servico['prazo'] ?> dias
                    </span>

                    <span>
                        ⭐ <?= $servico['avaliacao'] ?>
                    </span>

                </div>

                <div class="preco">
                    R$ <?= $servico['preco'] ?>
                </div>

                <div class="acoes">

                    <a href="editar.php?id=<?= $servico['id'] ?>">
                        Editar
                    </a>

                    <a href="deletar.php?id=<?= $servico['id'] ?>">
                        Excluir
                    </a>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>

</body>
</html>