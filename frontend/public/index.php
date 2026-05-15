
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

    <title>Catálogo de Serviços</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f5f5f5;
            color:#222;
        }

        header{
            width:100%;
            background:#111827;
            padding:20px 8%;

            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            color:#fff;
            font-size:24px;
            font-weight:bold;
        }

        nav{
            display:flex;
            gap:20px;
            align-items:center;
        }

        nav a{
            color:#fff;
            text-decoration:none;
            font-size:15px;
        }

        .btn-login{
            background:#2563eb;
            padding:10px 18px;
            border-radius:8px;
        }

        .hero{
            width:100%;
            min-height:400px;
            padding:60px 8%;

            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:40px;

            background:linear-gradient(to right, #111827, #1e3a8a);
            color:#fff;
        }

        .hero-text{
            max-width:600px;
        }

        .hero-text h1{
            font-size:52px;
            margin-bottom:20px;
        }

        .hero-text p{
            font-size:18px;
            line-height:1.6;
            margin-bottom:30px;
        }

        .hero-buttons{
            display:flex;
            gap:15px;
        }

        .hero-buttons a{
            text-decoration:none;
            padding:14px 24px;
            border-radius:10px;
            font-weight:bold;
        }

        .btn-primary{
            background:#2563eb;
            color:#fff;
        }

        .btn-secondary{
            background:#fff;
            color:#111827;
        }

        .search-area{
            width:100%;
            padding:40px 8%;
            background:#fff;
        }

        .search-box{
            display:flex;
            gap:15px;
            flex-wrap:wrap;
        }

        .search-box input,
        .search-box select{
            flex:1;
            min-width:200px;
            padding:15px;
            border:1px solid #ddd;
            border-radius:10px;
            font-size:15px;
        }

        .search-box button{
            padding:15px 30px;
            border:none;
            border-radius:10px;
            background:#2563eb;
            color:#fff;
            cursor:pointer;
            font-weight:bold;
        }

        .categorias{
            padding:60px 8%;
        }

        .section-title{
            font-size:32px;
            margin-bottom:30px;
        }

        .categorias-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));
            gap:20px;
        }

        .categoria-card{
            background:#fff;
            padding:30px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
            transition:.3s;
        }

        .categoria-card:hover{
            transform:translateY(-5px);
        }

        .categoria-card h3{
            margin-top:10px;
        }

        .servicos{
            padding:60px 8%;
        }

        .servicos-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
            gap:25px;
        }

        .card-servico{
            background:#fff;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 4px 15px rgba(0,0,0,.06);
            transition:.3s;
        }

        .card-servico:hover{
            transform:translateY(-5px);
        }

        .card-img{
            width:100%;
            height:180px;
            background:#dbeafe;
        }

        .card-content{
            padding:20px;
        }

        .card-content h3{
            margin-bottom:10px;
            font-size:22px;
        }

        .descricao{
            color:#555;
            margin-bottom:15px;
            line-height:1.5;
        }

        .info{
            display:flex;
            justify-content:space-between;
            margin-bottom:15px;
            font-size:14px;
            color:#444;
        }

        .preco{
            font-size:24px;
            font-weight:bold;
            color:#2563eb;
            margin-bottom:15px;
        }

        .prestador{
            margin-bottom:20px;
            color:#666;
        }

        .btn-servico{
            display:block;
            text-align:center;
            text-decoration:none;
            background:#111827;
            color:#fff;
            padding:14px;
            border-radius:10px;
        }

        footer{
            margin-top:60px;
            background:#111827;
            color:#fff;
            padding:30px 8%;
            text-align:center;
        }

        @media(max-width:768px){

            .hero{
                flex-direction:column;
                text-align:center;
            }

            .hero-text h1{
                font-size:36px;
            }

            .hero-buttons{
                justify-content:center;
            }

        }

    </style>
</head>
<body>

    <header>

        <div class="logo">
            Catálogo Serviços
        </div>

        <nav>
            <a href="index.php">Início</a>
            <a href="servicos.php">Serviços</a>
            <a href="cadastro.php">Cadastrar</a>
            <a href="login.php" class="btn-login">
                Entrar
            </a>
        </nav>

    </header>


    <section class="hero">

        <div class="hero-text">

            <h1>
                Encontre profissionais para qualquer serviço
            </h1>

            <p>
                Contrate designers, desenvolvedores, especialistas em marketing,
                consultores e muito mais.
            </p>

            <div class="hero-buttons">

                <a href="servicos.php" class="btn-primary">
                    Explorar serviços
                </a>

                <a href="cadastro.php" class="btn-secondary">
                    Tornar-se prestador
                </a>

            </div>

        </div>

    </section>


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
```
