<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Landing Page</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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

    <div class="auth">
        <a href="#" class="btn-login">Entrar</a>
        <a href="#" class="btn-register">Cadastrar</a>
    </div>

</header>


<section class="hero">

    <div class="hero-text">

        <span class="badge">Plataforma</span>

        <h1>
            Encontre profissionais<br>
            para qualquer serviço
        </h1>

        <p>
            Conecte-se com designers, desenvolvedores e especialistas
            em marketing para acelerar seus projetos com qualidade profissional.
        </p>

        <div class="hero-actions">
            <a href="login.php" class="btn-primary">Começar agora</a>
            <a href="#como-funciona" class="btn-secondary">Ver como funciona</a>
        </div>

        <div class="hero-stats">
            <div>
                <h3>+10k</h3>
                <span>Serviços</span>
            </div>
            <div>
                <h3>+5k</h3>
                <span>Profissionais</span>
            </div>
            <div>
                <h3>98%</h3>
                <span>Satisfação</span>
            </div>
        </div>

    </div>

    <div class="hero-image">

        <div class="image-glow"></div>

        <img src="../img/hero-image.png" alt="Hero">

        <div class="floating-card card-1">
    <h4><i class="fa-solid fa-rocket"></i> Projetos ativos</h4>
    <p>+1.240 online</p>
</div>

<div class="floating-card card-2">
    <h4><i class="fa-solid fa-briefcase"></i> Contratações</h4>
    <p>Alta demanda hoje</p>
</div>

<div class="floating-card card-3">
    <h4><i class="fa-solid fa-star"></i> Avaliação média</h4>
    <p>4.9 / 5.0</p>
</div>

    </div>

    <!-- COLOQUE ISSO NO FINAL DA HERO -->
<div class="scroll-indicator" id="scrollIndicator">
    <i class="fa-solid fa-chevron-down"></i>
</div>

</section>




<section class="como-funciona" id="como-funciona">

    <div class="section-header">
        <span class="section-badge">Como funciona</span>

        <h2>
            Contratar profissionais nunca foi tão simples
        </h2>

        <p>
            Encontre especialistas qualificados, converse diretamente
            e acompanhe seus projetos em poucos passos.
        </p>
    </div>

    <div class="steps">

        <div class="step-card">
            <div class="step-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>

            <span class="step-number">01</span>

            <h3>Pesquise serviços</h3>

            <p>
                Explore categorias e encontre profissionais ideais
                para o seu projeto.
            </p>
        </div>

        <div class="step-card">
            <div class="step-icon">
                <i class="fa-solid fa-comments"></i>
            </div>

            <span class="step-number">02</span>

            <h3>Converse e negocie</h3>

            <p>
                Fale diretamente com os profissionais,
                combine valores e detalhes.
            </p>
        </div>

        <div class="step-card">
            <div class="step-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <span class="step-number">03</span>

            <h3>Receba o resultado</h3>

            <p>
                Acompanhe o progresso e receba
                serviços com qualidade profissional.
            </p>
        </div>

    </div>

</section>

</body>
</html>
<script>
    const scrollIndicator = document.getElementById("scrollIndicator");

window.addEventListener("scroll", () => {

    if(window.scrollY > 80){
        scrollIndicator.classList.add("hide");
    }else{
        scrollIndicator.classList.remove("hide");
    }

});

scrollIndicator.addEventListener("click", () => {

    window.scrollTo({
        top: window.innerHeight,
        behavior: "smooth"
    });

});
</script>