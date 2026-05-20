<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";



$servicoController = new ServicoController($pdo);


$servicos = $servicoController->listar();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Catálogo de Serviços</title>


</head>

<body>

    <header>

        <div class="logo">
            Catálogo Serviços
        </div>

        <nav>

         <form class="search-box">

            <input
                type="text"
                placeholder="Buscar serviços">

            <button>
                <i class="fa-solid fa-magnifying-glass" style="color: #111827;"></i>
            </button>
    
        </form>

            <?php if (!empty($_SESSION['usuario'])): ?>

    <?php if (($_SESSION['usuario']['tipo'] ?? '') === 'prestador'): ?>

    <?php endif; ?>

    <a href="perfil.php" class="icon-user">
        <i class="fa-solid fa-user"></i>
    </a>

<?php else: ?>

    <a href="login.php">Entrar</a>
    <a href="cadastro.php">Cadastrar</a>

<?php endif; ?>


        </nav>

    </header>


    <section class="categorias">

        <h2 class="section-title">
            Categorias
        </h2>

        <div class="categorias-grid">

            <div class="categoria-card">
                <h3>Design</h3>
            </div>

            <div class="categoria-card">
                <h3>Marketing</h3>
            </div>

            <div class="categoria-card">
                <h3>Desenvolvimento</h3>
            </div>

            <div class="categoria-card">
                <h3>Consultoria</h3>
            </div>

            <div class="categoria-card">
                <h3>Manutenção</h3>
            </div>

        </div>

    </section>

    <hr style="color: #111827; max-width: 84%; margin-left: 9.5rem    ;">

    <section class="servicos">

        <h2 class="section-title">
            Serviços em destaque
        </h2>

        <div class="servicos-grid">

            <?php foreach ($servicos as $servico): ?>

                <div class="card-servico">

                    <div class="top-card">

                        <div class="perfil-area">

                            <img
                                src="<?= !empty($servico['foto']) ? $servico['foto'] : '../img/user.jpg' ?>"
                                alt="Prestador"
                                class="foto-prestador">

                            <div class="perfil-info">

                                <span class="nome-prestador">
                                    <?= $servico['prestador'] ?>
                                </span>

                                <h3>
                                    <?= $servico['nome_servico'] ?>
                                </h3>

                            </div>

                        </div>

                    </div>

                    <div class="card-content">

                        <p class="descricao">
                            <?= mb_strimwidth($servico['descricao'], 0, 120, '...') ?>
                        </p>

                        <p class="localizacao">
                            <i class="fa-solid fa-location-dot"></i>
                            <?= $servico['localizacao'] ?>
                        </p>

                        <div class="info-servico">

                            <div class="info-box">

                                <span class="label">
                                    Prazo
                                </span>

                                <strong>
                                    <?= $servico['prazo'] ?> dias
                                </strong>

                            </div>

                            <div class="info-box">

                                <span class="label">
                                    Preço
                                </span>

                                <strong class="preco">
                                    R$ <?= number_format($servico['preco'], 2, ',', '.') ?>
                                </strong>

                            </div>

                        </div>

                        <?php if (
                            isset($_SESSION['usuario']) &&
                            $_SESSION['usuario']['tipo'] === 'prestador'
                        ): ?>

                            <button
                                class="btn-ver-servico"
                                onclick="abrirModalServico(
        '<?= $servico['nome_servico'] ?>',
        '<?= $servico['prestador'] ?>',
        '<?= $servico['descricao'] ?>',
        '<?= $servico['prazo'] ?>',
        '<?= $servico['preco'] ?>',
        '<?= $servico['localizacao'] ?>',
        '<?= !empty($servico['foto']) ? $servico['foto'] : '../img/user.jpg' ?>'
    )">
                                Ver serviço
                            </button>

                        <?php else: ?>

                            <a
                                href="servico.php?id=<?= $servico['id'] ?>"
                                class="btn-contratar">
                                Contratar
                            </a>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </section>


    <footer>
        <p>
            © 2026 Catálogo Serviços - Todos os direitos reservados.
        </p>
    </footer>


    <div class="modal-servico" id="modalServico">

        <div class="modal-box">

            <span
                class="fechar-modal"
                onclick="fecharModalServico()">
                &times;
            </span>

            <div class="modal-topo">

                <img
                    src=""
                    id="modal-foto"
                    class="modal-foto">

                <div>

                    <span class="modal-prestador" id="modal-prestador"></span>

                    <h2 id="modal-titulo"></h2>

                </div>

            </div>

            <div class="modal-info">

                <p id="modal-descricao"></p>

                <div class="modal-detalhes">

                    <div class="detalhe-box">

                        <span>
                            Prazo
                        </span>

                        <strong id="modal-prazo"></strong>

                    </div>

                    <div class="detalhe-box">

                        <span>
                            Preço
                        </span>

                        <strong id="modal-preco"></strong>

                    </div>

                </div>

                <div class="modal-localizacao">

                    📍 <span id="modal-localizacao"></span>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
<script>
    function abrirModalServico(
        nome,
        prestador,
        descricao,
        prazo,
        preco,
        localizacao,
        foto
    ) {

        document.getElementById('modal-titulo').innerText = nome;

        document.getElementById('modal-prestador').innerText = prestador;

        document.getElementById('modal-descricao').innerText = descricao;

        document.getElementById('modal-prazo').innerText = prazo + ' dias';

        document.getElementById('modal-preco').innerText =
            'R$ ' + parseFloat(preco).toFixed(2);

        document.getElementById('modal-localizacao').innerText =
            localizacao;

        document.getElementById('modal-foto').src = foto;

        document.getElementById('modalServico').style.display = 'flex';
    }

    function fecharModalServico() {

        document.getElementById('modalServico').style.display = 'none';
    }
</script>