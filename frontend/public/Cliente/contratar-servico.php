<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ServicoController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/UsuarioController.php";
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/ContratacaoController.php";

if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit;
}

$servicoController = new ServicoController($pdo);
$usuarioController = new UsuarioController($pdo);
$contratacaoController = new ContratacaoController($pdo);

$usuario = $usuarioController->buscarUsuario($_SESSION['usuario']['id']);

$id = $_GET['id'] ?? null;

$servico = $servicoController->buscarPorId($id);

if (!$servico) {

    echo "Serviço não encontrado.";
    exit;
}



if ($servico['usuario_id'] == $_SESSION['usuario']['id']) {

    echo "Você não pode contratar o próprio serviço.";
    exit;
}




if (isset($_POST['contratar'])) {

    $clienteId = $_SESSION['usuario']['id'];

    $texto = trim($_POST['mensagem']);

    $contratacaoController->contratar(

        $clienteId,
        $id,
        $texto

    );

    header("Location: servicos-contratados.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Contratar Serviço</title>

    <link
        rel="stylesheet"
        href="../css/contratar-servico.css">

</head>

<body>

    <a href="../home.php" class="btn-back">

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

        <div class="card-servico">


            <div class="topo-servico">

                <img
                    src="<?= !empty($servico['foto']) ? '../' . $servico['foto'] : '../img/user.jpg' ?>"
                    class="foto-prestador">

                <div>

                    <span class="prestador">

                        <?= htmlspecialchars($servico['prestador']) ?>

                    </span>

                    <h1>

                        <?= htmlspecialchars($servico['nome_servico']) ?>

                    </h1>

                </div>

            </div>




            <div class="descricao-box">

                <h3>
                    Sobre o serviço
                </h3>

                <p>

                    <?= htmlspecialchars($servico['descricao']) ?>

                </p>

            </div>




            <div class="infos">

                <div class="info-card">

                    <span>Preço</span>

                    <strong>

                        R$ <?= number_format(
                                $servico['preco'],
                                2,
                                ',',
                                '.'
                            ) ?>

                    </strong>

                </div>


                <div class="info-card">

                    <span>Prazo</span>

                    <strong>

                        <?= $servico['prazo'] ?> dias

                    </strong>

                </div>


                <div class="info-card">

                    <span>Localização</span>

                    <strong>

                        <?= htmlspecialchars($servico['localizacao']) ?>

                    </strong>

                </div>

            </div>



            <form
                method="POST"
                class="form-contratar">

                <label>

                    Descreva o que você precisa

                </label>

                <textarea
                    name="mensagem"
                    placeholder="Explique detalhes do serviço..."
                    required></textarea>


                    <div class="input-group">

    <label>
        Método de pagamento
    </label>

    <select
        name="pagamento"
        id="pagamento"
        onchange="toggleCartao()"
        required>

        <option value="">
            Selecione
        </option>

        <option value="pix">
            PIX
        </option>

        <option value="cartao">
            Cartão
        </option>

    </select>

</div>


<div
    class="cartao-fields"
    id="cartaoFields">

    <div class="input-group">

        <label>
            Número do cartão
        </label>

        <input
            type="text"
            name="numero_cartao"
            placeholder="0000 0000 0000 0000">

    </div>


    <div class="row-cartao">

        <div class="input-group">

            <label>
                Validade
            </label>

            <input
                type="text"
                name="validade_cartao"
                placeholder="MM/AA">

        </div>


        <div class="input-group">

            <label>
                CVV
            </label>

            <input
                type="text"
                name="cvv_cartao"
                placeholder="123">

        </div>

    </div>

</div>

<div
    class="pix-box"
    id="pixBox">

    <h3>
        Pagamento via PIX
    </h3>

    <p>

        Utilize a chave PIX abaixo para realizar o pagamento:

    </p>

    <div class="pix-chave">

        <?= htmlspecialchars($servico['email']) ?>

    </div>

    <p class="pix-info">

        Após o pagamento, clique em contratar serviço.

    </p>

</div>


                <button
                    type="submit"
                    name="contratar">

                    Contratar Serviço

                </button>

            </form>

        </div>

    </div>

</body>

</html>

<script>

function toggleCartao() {

    const pagamento =
        document.getElementById('pagamento').value;

    const camposCartao =
        document.getElementById('cartaoFields');

    const pixBox =
        document.getElementById('pixBox');

    if (pagamento === 'cartao') {

        camposCartao.style.display = 'block';
        pixBox.style.display = 'none';

    }

    else if (pagamento === 'pix') {

        camposCartao.style.display = 'none';
        pixBox.style.display = 'block';

    }

    else {

        camposCartao.style.display = 'none';
        pixBox.style.display = 'none';
    }
}

</script>