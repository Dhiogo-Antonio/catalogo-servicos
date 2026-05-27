<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/CategoriaController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ContratacaoController.php";

$categoriaController = new CategoriaController($pdo);
$categorias = $categoriaController->listar();



$servicoController = new ServicoController($pdo);


$q = $_GET['q'] ?? null;
$categoriaId = $_GET['categoria'] ?? null;

$servicos = $servicoController->buscarFiltrados($q, $categoriaId);


$notificacoes = 0;

if (
    !empty($_SESSION['usuario']) &&
    $_SESSION['usuario']['tipo'] === 'prestador'
) {

    $contratacaoController = new ContratacaoController($pdo);

    $notificacoes = $contratacaoController
        ->contarPendentes($_SESSION['usuario']['id']);
}

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
            <div class="logo-icon">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <div class="logo-text">
                <span class="logo-name">ProServiços</span>
            </div>
        </div>

        <nav>

    <?php

    $linkNotificacao = "#";

    if (!empty($_SESSION['usuario'])) {

        if ($_SESSION['usuario']['tipo'] === 'prestador') {

            $linkNotificacao = "Prestador/notificacoes.php";

        } else {

            $linkNotificacao = "Cliente/notificacoes.php";
        }
    }

    ?>

    <form class="search-box" method="GET" action="home.php">

        <input
            type="text"
            name="q"
            placeholder="Buscar serviços"
            value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass" style="color: #111827;"></i>
        </button>

        <?php if (!empty($_SESSION['usuario'])): ?>

            <a href="<?= $linkNotificacao ?>" class="icon-user notificacao-icon">

                <i class="fa-solid fa-bell"></i>

                <?php if ($notificacoes > 0): ?>

                    <span class="badge-notificacao">
                        <?= $notificacoes ?>
                    </span>

                <?php endif; ?>

            </a>

        <?php endif; ?>

    </form>

    <?php if (!empty($_SESSION['usuario'])): ?>

        <a href="perfil.php" class="icon-user">
            <i class="fa-solid fa-user"></i>
        </a>

    <?php else: ?>

        <a href="login.php">Entrar</a>
        <a href="cadastro.php">Cadastrar</a>

    <?php endif; ?>

</nav>

    </header>

    <section class="welcome-section">

        <div class="welcome-text">

            <h1>
                Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Visitante') ?>
            </h1>

            <p>
                <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] === 'prestador'): ?>
                    Gerencie seus serviços e aumente suas oportunidades de clientes.
                <?php else: ?>
                    Encontre profissionais qualificados e contrate seu primeiro serviço.
                <?php endif; ?>
            </p>

        </div>

        <div class="recommendation-card">

            <?php if (!empty($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] === 'prestador'): ?>

                <h3>Crie seu primeiro serviço</h3>

                <p>
                    Publique um serviço e comece a receber propostas de clientes agora mesmo.
                </p>

                <a href="prestador/criar-servico.php" class="btn-recomendacao">
                    Criar serviço
                </a>

            <?php else: ?>

                <h3>
                    <i class="fa-solid fa-briefcase"></i>
                    Encontre seu primeiro serviço
                </h3>

                <p>
                    Explore categorias e contrate profissionais confiáveis perto de você.
                </p>

                <a href="#servicos" class="btn-recomendacao">
                    Ver serviços
                </a>

            <?php endif; ?>

        </div>

    </section>

    <section class="categorias-menu">

        <h2 class="section-title">
            Serviços em destaque
        </h2>

        <button class="btn-categorias" onclick="toggleCategorias()">
            Categorias
            <i class="fa-solid fa-chevron-down" id="icon-main"></i>
        </button>

        <div class="categorias-dropdown" id="categoriasDropdown">

            <a href="home.php" class="categoria-item">Todas</a>

            <?php foreach ($categorias as $cat): ?>
                <a href="home.php?categoria=<?= $cat['id'] ?>" class="categoria-item">
                    <?= htmlspecialchars($cat['nome']) ?>
                </a>
            <?php endforeach; ?>



        </div>

    </section>

    <hr style="color: #111827; max-width: 100%; margin-left: 0.5rem; margin-bottom: 2rem;">

    <section class="servicos categorias-menu">



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

                            <div class="botoes">

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

                                <a
                                    href="Cliente/contratar-servico.php?id=<?= $servico['id'] ?>"
                                    class="btn-contratar">
                                    Contratar
                                </a>

                            <?php endif; ?>

                            </div>

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

    function toggleCategorias() {
        const dropdown = document.getElementById('categoriasDropdown');
        dropdown.classList.toggle('ativo');
    }

    function toggleExpandir(event) {
        event.stopPropagation();

        const extra = document.getElementById('categoriasExtra');
        const icon = document.getElementById('icon-expand');

        extra.classList.toggle('ativo');
        icon.classList.toggle('fa-rotate-180');
    }

    // fecha ao clicar fora
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('categoriasDropdown');
        const btn = document.querySelector('.btn-categorias');

        if (!menu.contains(e.target) && !btn.contains(e.target)) {
            menu.classList.remove('ativo');
        }
    });
</script>