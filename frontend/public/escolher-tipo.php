<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $tipo = $_POST['tipo'];

    $usuarioId = $_SESSION['usuario_temp']['id'];

    $sql = "UPDATE usuarios SET tipo = ? WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$tipo, $usuarioId]);

    
    $sqlUsuario = "SELECT * FROM usuarios WHERE id = ?";

    $stmtUsuario = $pdo->prepare($sqlUsuario);

    $stmtUsuario->execute([$usuarioId]);

    $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);


    
    $_SESSION['usuario'] = [
        'id' => $usuario['id'],
        'nome' => $usuario['nome'],
        'email' => $usuario['email'],
        'tipo' => $tipo
    ];


    
    unset($_SESSION['usuario_temp']);

    
    header("Location: home.php");

    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Escolher Tipo de Conta</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            min-height:100vh;

            display:flex;
            justify-content:center;
            align-items:center;

            padding:30px;

            background:#f5f5f5;
            color:#1e3a8a;
        }

        .content{
            width:100%;
            max-width:1100px;
        }

        .titulo{
            text-align:center;
            margin-bottom:60px;
            color:#1e3a8a;
        }

        .titulo h1{
            font-size:52px;
            margin-bottom:15px;
            font-weight:800;
        }

        .titulo p{
            font-size:19px;
            color:#1e3a8a;
        }

        .container{
            display:flex;
            justify-content:center;
            gap:35px;
            flex-wrap:wrap;
        }

        form{
            flex:1;
            min-width:320px;
            max-width:430px;
        }

        .card{
            position:relative;

            height:100%;

            padding:45px 35px;

            border-radius:28px;

            background:
            rgba(255,255,255,.08);

            backdrop-filter:blur(18px);

            border:
            1px solid rgba(255,255,255,.15);

            overflow:hidden;

            cursor:pointer;

            transition:.35s;

            box-shadow:
            0 10px 30px rgba(0,0,0,.25);
        }

        .card::before{
            content:"";

            position:absolute;

            top:0;
            left:-100%;

            width:100%;
            height:100%;

            background:
            linear-gradient(
                120deg,
                transparent,
                rgba(255,255,255,.12),
                transparent
            );

            transition:.6s;
        }

        .card:hover::before{
            left:100%;
        }

        .card:hover{
            transform:
            translateY(-12px)
            scale(1.02);

            border-color:
            rgba(255,255,255,.35);

            box-shadow:
            0 20px 45px rgba(0,0,0,.35);
        }

        .icon{
            width:75px;
            height:75px;

            border-radius:20px;

            display:flex;
            justify-content:center;
            align-items:center;

            font-size:34px;

            margin-bottom:30px;

            background:
            rgba(255,255,255,.12);

            border:
            1px solid #1e3a8a;

            color:#1e3a8a;
        }

        .card h2{
            font-size:34px;
            color:#1e3a8a;
            margin-bottom:18px;
        }

        .card p{
            color:#64748b;
            line-height:1.8;
            font-size:16px;
        }

        .tag{
            display:inline-block;

            margin-top:30px;

            padding:12px 20px;

            border-radius:999px;

            background:
            rgba(255,255,255,.12);

            color:#222;

            font-size:14px;
            font-weight:bold;

            border:
            1px solid rgba(255,255,255,.1);
        }


    </style>
</head>
<body>

    <div class="content">

        <div class="titulo">

            <h1>
                Escolha seu tipo de conta
            </h1>

            <p>
                Defina como deseja utilizar a plataforma.
            </p>

        </div>



        <div class="container">

            <form
                method="POST"
                action="finalizar-cadastro.php"
            >

                <input
                    type="hidden"
                    name="tipo"
                    value="cliente"
                >

                <div
                    class="card"
                    onclick="this.closest('form').submit()"
                >

                    <div class="icon">
                        <img src="../img/prestador.png" alt="" width="50px">
                    </div>

                    <h2>
                        Cliente
                    </h2>

                    <p>
                        Encontre profissionais,
                        contrate serviços,
                        acompanhe pedidos
                        e converse diretamente
                        com prestadores.
                    </p>

              

                </div>

            </form>





            <form
                method="POST"
                action="finalizar-cadastro.php"
            >

                <input
                    type="hidden"
                    name="tipo"
                    value="prestador"
                >

                <div
                    class="card"
                    onclick="this.closest('form').submit()"
                >

                    <div class="icon">
                        <img src="../img/maleta.png" alt="" width="50px">
                    </div>

                    <h2>
                        Prestador
                    </h2>

                    <p>
                        Crie serviços,
                        receba pedidos,
                        converse com clientes
                        e venda seus serviços
                        na plataforma.
                    </p>

                   
                </div>

            </form>

        </div>

    </div>

</body>
</html>