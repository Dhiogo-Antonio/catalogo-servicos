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
    <link rel="stylesheet" href="css/escolher-tipo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
                        <i class="fa-solid fa-user-tie"></i>
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
                        <i class="fa-solid fa-briefcase"></i>
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