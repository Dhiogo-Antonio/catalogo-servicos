
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
    <link rel="stylesheet" href="css/home.css">
    <title>Catálogo de Serviços</title>

    
</head>
<body>

    <header>

        <div class="logo">
            Catálogo Serviços
        </div>

        <nav>

    <?php if(isset($_SESSION['usuario'])): ?>

        

        
        <?php if($_SESSION['usuario']['tipo'] === 'prestador'): ?>

            <a href="Prestador/servicos/meus-servicos.php">
                Meus serviços
            </a>

            <a href="servicos/criar.php">
                Criar serviço
            </a>

        <?php endif; ?>

        
        <a href="logout.php">
            Sair
        </a>

    <?php else: ?>

        <a href="login.php">
            Entrar
        </a>

        <a href="cadastro.php">
            Cadastrar
        </a>

    <?php endif; ?>

</nav>

    </header>


    <section class="search-area">

        <form class="search-box">

            <input
                type="text"
                placeholder="Buscar serviços"
            >

            <select>
                <option>Categoria</option>
                <option>Design</option>
                <option>Marketing</option>
                <option>Desenvolvimento</option>
                <option>Consultoria</option>
            </select>

            <button>
                Buscar
            </button>

        </form>

    </section>


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


    <section class="servicos">

        <h2 class="section-title">
            Serviços em destaque
        </h2>

        <div class="servicos-grid">

            <?php foreach($servicos as $servico): ?>

                <div class="card-servico">

                    <div class="card-img"></div>

                    <div class="card-content">

                        <h3>
                            <?= $servico['titulo'] ?>
                        </h3>

                        <p class="descricao">
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

                        <div class="prestador">
                            Prestador:
                            <?= $servico['prestador'] ?>
                        </div>

                        <a href="servico.php?id=<?= $servico['id'] ?>"
                           class="btn-servico">
                            Ver serviço
                        </a>

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

</body>
</html>

