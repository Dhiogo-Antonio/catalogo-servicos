<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Catálogo de Serviços</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    />

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f8fafc;
            color:#0f172a;
        }

        header{
            width:100%;
            padding:22px 8%;

            display:flex;
            justify-content:space-between;
            align-items:center;

            background:#fff;

            border-bottom:
            1px solid #e2e8f0;
        }

        .logo{
            font-size:28px;
            font-weight:bold;
            color:#2563eb;
        }

        nav{
            display:flex;
            gap:35px;
            align-items:center;
        }

        nav a{
            text-decoration:none;
            color:#334155;
            font-size:15px;
            transition:.3s;
        }

        nav a:hover{
            color:#2563eb;
        }

        .auth{
            display:flex;
            gap:15px;
            align-items:center;
        }

        .btn-login{

            text-decoration:none;

            color:#2563eb;

            font-weight:bold;
        }

        .btn-register{

            text-decoration:none;

            background:#2563eb;

            color:#fff;

            padding:12px 22px;

            border-radius:10px;

            font-weight:bold;

            transition:.3s;
        }

        .btn-register:hover{
            background:#1d4ed8;
        }

        .hero{

            width:100%;
            min-height:85vh;

            padding:80px 8%;

            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:60px;
        }

        .hero-text{
            flex:1;
        }

        .hero-text span{

            background:#dbeafe;

            color:#2563eb;

            padding:10px 18px;

            border-radius:999px;

            font-size:14px;

            font-weight:bold;
        }

        .hero-text h1{

            font-size:64px;

            line-height:1.1;

            margin-top:30px;
            margin-bottom:25px;
        }

        .hero-text p{

            font-size:19px;

            color:#64748b;

            line-height:1.8;

            margin-bottom:40px;

            max-width:650px;
        }

        .search-box{

            width:100%;

            max-width:650px;

            background:#fff;

            border-radius:18px;

            padding:12px;

            display:flex;
            align-items:center;

            gap:10px;

            box-shadow:
            0 8px 25px rgba(0,0,0,.06);
        }

        .search-box i{
            color:#94a3b8;
            margin-left:10px;
        }

        .search-box input{

            flex:1;

            border:none;

            outline:none;

            padding:14px;

            font-size:16px;
        }

        .search-box button{

            border:none;

            background:#2563eb;

            color:#fff;

            padding:16px 28px;

            border-radius:14px;

            cursor:pointer;

            font-weight:bold;

            transition:.3s;
        }

        .search-box button:hover{
            background:#1d4ed8;
        }

        .hero-info{

            display:flex;
            gap:40px;

            margin-top:40px;
        }

        .hero-info div h3{

            font-size:28px;

            color:#2563eb;
        }

        .hero-info div p{

            margin-top:5px;

            font-size:15px;

            color:#64748b;
        }

        .hero-image{

            flex:1;

            display:flex;
            justify-content:center;
            align-items:center;
        }

        .image-box{

            width:100%;
            max-width:520px;
            height:520px;

            background:
            linear-gradient(
                135deg,
                #2563eb,
                #7c3aed
            );

            border-radius:35px;

            position:relative;

            overflow:hidden;

            display:flex;
            justify-content:center;
            align-items:center;

            box-shadow:
            0 20px 50px rgba(37,99,235,.25);
        }

        .floating-card{

            position:absolute;

            background:#fff;

            padding:18px;

            border-radius:18px;

            box-shadow:
            0 10px 25px rgba(0,0,0,.1);
        }

        .card-1{
            top:40px;
            left:40px;
        }

        .card-2{
            bottom:40px;
            right:40px;
        }

        .floating-card h4{
            margin-bottom:8px;
            font-size:16px;
        }

        .floating-card p{
            color:#64748b;
            font-size:14px;
        }

        .main-icon{

            width:170px;
            height:170px;

            border-radius:40px;

            background:
            rgba(255,255,255,.15);

            backdrop-filter:blur(10px);

            display:flex;
            justify-content:center;
            align-items:center;

            border:
            1px solid rgba(255,255,255,.2);
        }

        .main-icon i{

            font-size:75px;

            color:#fff;
        }

    </style>
</head>
<body>

    <header>

        <div class="logo">
            Catálogo de Serviços
        </div>

        <div class="auth">

            <a href="login.php" class="btn-login">
                Entrar
            </a>

            <a href="cadastro.php" class="btn-register">
                Cadastrar
            </a>

        </div>

    </header>



    <section class="hero">

        <div class="hero-text">

            <span>
                Plataforma
            </span>

            <h1>
                Encontre profissionais
                para qualquer serviço
            </h1>

            <p>
                Contrate designers, desenvolvedores,
                especialistas em marketing e diversos
                profissionais para seu projeto.
            </p>



            <form class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    placeholder="O que você precisa?"
                >

                <button>
                    Buscar
                </button>

            </form>



            <div class="hero-info">

                <div>

                    <h3>
                        +10k
                    </h3>

                    <p>
                        Serviços publicados
                    </p>

                </div>


                <div>

                    <h3>
                        +5k
                    </h3>

                    <p>
                        Prestadores ativos
                    </p>

                </div>


                <div>

                    <h3>
                        98%
                    </h3>

                    <p>
                        Clientes satisfeitos
                    </p>

                </div>

            </div>

        </div>





        <div class="hero-image">

            <div class="image-box">

                <div class="floating-card card-1">

                    <h4>
                        Desenvolvimento Web
                    </h4>

                    <p>
                        A partir de R$ 500
                    </p>

                </div>



                <div class="main-icon">

                    <i class="fa-solid fa-laptop-code"></i>

                </div>



                <div class="floating-card card-2">

                    <h4>
                        Design UI/UX
                    </h4>

                    <p>
                        A partir de R$ 250
                    </p>

                </div>

            </div>

        </div>

    </section>

</body>
</html>