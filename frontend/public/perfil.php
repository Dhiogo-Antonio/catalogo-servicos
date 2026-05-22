<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/UsuarioController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/services/PerfilService.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ContratacaoController.php";

$contratacaoController = new ContratacaoController($pdo);

if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];

$usuarioController = new UsuarioController($pdo);
$servicoController = new ServicoController($pdo);
$perfilService = new PerfilService($usuarioController);

$usuario = $usuarioController->buscarUsuario($usuarioId);

$servicos = $usuarioController->listarServicosDoPerfil(
    $usuarioId,
    $usuario['tipo'],
    $servicoController,
    $contratacaoController
);

$mensagem = "";


if ($usuario['tipo'] === 'prestador') {

    $servicos = $servicoController->listarPorPrestador($usuarioId);
}


/* ALTERAR SENHA */

if (isset($_POST['alterar_senha'])) {

    $mensagem = $perfilService->alterarSenha(

        $usuarioId,

        trim($_POST['email']),

        trim($_POST['nova_senha']),

        trim($_POST['confirmar_senha'])
    );
}


/* ALTERAR FOTO */

if (isset($_POST['alterar_foto'])) {

    $mensagem = $perfilService->alterarFoto(

        $usuarioId,

        $_FILES['foto']
    );

    $usuario = $usuarioController->buscarUsuario($usuarioId);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Perfil</title>

    <link
        rel="stylesheet"
        href="css/perfil.css">

</head>

<body>

    <a href="home.php" class="btn-back">

        <svg
            class="icon-back"
            viewBox="0 0 24 24"
            fill="none">

            <path
                d="M15 18l-6-6 6-6"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round" />

        </svg>

    </a>


    <div class="container">

        <div class="banner"></div>


        <!-- PERFIL -->

        <div class="profile-bar">

            <div class="profile-left">

                <div class="avatar-wrap">

                    <img
                        class="avatar"
                        src="<?= !empty($usuario['foto']) ? $usuario['foto'] : '../img/user.jpg' ?>"
                        alt="Foto de perfil">


                    <form
                        method="POST"
                        enctype="multipart/form-data"
                        class="foto-form">

                        <label
                            for="foto"
                            class="camera-btn">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="none"
                                viewBox="0 0 24 24">

                                <path
                                    d="M4 7h3l2-2h6l2 2h3v11H4V7z"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />

                                <circle
                                    cx="12"
                                    cy="13"
                                    r="3"
                                    stroke="currentColor"
                                    stroke-width="2" />

                            </svg>

                        </label>


                        <input
                            type="file"
                            name="foto"
                            id="foto"
                            accept="image/*"
                            onchange="this.form.submit()"
                            hidden>

                        <input
                            type="hidden"
                            name="alterar_foto"
                            value="1">

                    </form>

                </div>


                <div class="profile-info">

                    <div class="name">

                        <?= htmlspecialchars($usuario['nome']) ?>

                    </div>

                    <div class="meta">

                        <?= htmlspecialchars($usuario['email']) ?>

                    </div>

                    <div class="tags">

                        <span class="badge badge-tipo">

                            <?= htmlspecialchars($usuario['tipo']) ?>

                        </span>

                    </div>

                </div>

            </div>


            <div class="profile-actions">

                <a href="logout.php">

                    Sair

                </a>

            </div>

        </div>



        <!-- GRID -->
<div class="grid">


    <!-- LADO ESQUERDO -->

    <div>


        <!-- INFORMAÇÕES -->

        <div class="card">

            <div class="card-title">

                <h2>Informações</h2>

            </div>


            <div class="info-row">

                <div class="info-icon">✉</div>

                <div>

                    <div class="info-label">
                        Email
                    </div>

                    <div class="info-val">
                        <?= htmlspecialchars($usuario['email']) ?>
                    </div>

                </div>

            </div>



            <div class="info-row">

                <div class="info-icon">☎</div>

                <div>

                    <div class="info-label">
                        Telefone
                    </div>

                    <div class="info-val">
                        <?= htmlspecialchars($usuario['telefone']) ?>
                    </div>

                </div>

            </div>



            <div class="info-row">

                <div class="info-icon">◈</div>

                <div>

                    <div class="info-label">
                        Tipo de conta
                    </div>

                    <div class="info-val">
                        <?= htmlspecialchars($usuario['tipo']) ?>
                    </div>

                </div>

            </div>

        </div>



        <!-- ALTERAR SENHA -->

        <div class="card" style="margin-top: 25px;">

            <div class="card-title">

                <h2>Alterar Senha</h2>

            </div>


            <?php if (!empty($mensagem)): ?>

                <div class="msg-alert">

                    <?= $mensagem ?>

                </div>

            <?php endif; ?>


            <form
                method="POST"
                class="form-senha">


                <div class="input-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Digite seu email"
                        required>

                </div>



                <div class="input-group">

                    <label>Nova senha</label>

                    <input
                        type="password"
                        name="nova_senha"
                        placeholder="Digite sua nova senha"
                        required>

                </div>



                <div class="input-group">

                    <label>Confirmar senha</label>

                    <input
                        type="password"
                        name="confirmar_senha"
                        placeholder="Confirme sua nova senha"
                        required>

                </div>



                <button
                    type="submit"
                    name="alterar_senha"
                    class="btn-salvar">

                    Alterar Senha

                </button>

            </form>

        </div>

    </div>




    <!-- LADO DIREITO -->

   <div class="card card-services">

    <div class="card-title">
        <h2>Seus Serviços</h2>
    </div>

    <?php $limite = 5; $i = 0; ?>

    <?php if (!empty($servicos)): ?>

        <?php foreach ($servicos as $s): ?>

            <?php if ($i++ >= $limite) break; ?>

            <div class="service">

                <div class="service-info">

                    <h4>
                        <?= htmlspecialchars($s['nome_servico'] ?? 'Serviço') ?>
                    </h4>

                    <p>
                        <?= htmlspecialchars($s['solicitacao'] ?? $s['descricao'] ?? 'Sem descrição') ?>
                    </p>

                </div>

                <div class="price">
                    R$ <?= number_format($s['preco'] ?? 0, 2, ',', '.') ?>
                </div>

                

            </div>

            

        <?php endforeach; ?>

         <a
    class="btn"
    href="<?= $usuario['tipo'] === 'prestador'
        ? 'Prestador/servicos/meus-servicos.php'
        : 'Cliente/servicos-contratados.php' ?>">

    Ver Mais
</a>

        <?php if (count($servicos) > $limite): ?>
            <a
    class="btn"
    href="<?= $usuario['tipo'] === 'prestador'
        ? 'Prestador/servicos/meus-servicos.php'
        : 'Cliente/servicos-contratados.php' ?>">

    Ver Mais
</a>
        <?php endif; ?>

    <?php else: ?>

        <p>
            Nenhum serviço encontrado.
        </p>

    <?php endif; ?>

</div>

</div>

    </div>

</body>

</html>