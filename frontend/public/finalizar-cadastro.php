<?php

session_start();

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/database/database.php";

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/controllers/UsuarioController.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}



if(!isset($_SESSION['cadastro'])){

    header("Location: cadastro.php");
    exit;
}


$tipo = $_POST['tipo'] ?? '';


if(
    $tipo != 'cliente' &&
    $tipo != 'prestador'
){

    header("Location: escolher-tipo.php");
    exit;
}


$dados = $_SESSION['cadastro'];

$nome = $dados['nome'];
$email = $dados['email'];
$telefone = $dados['telefone'];
$senha = $dados['senha'];


$usuarioController = new UsuarioController($pdo);


$usuarioController->cadastrar(

    $nome,
    $email,
    $senha,
    $telefone,
    $tipo

);

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$email]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);


$_SESSION['usuario'] = [

    'id' => $usuario['id'],
    'nome' => $usuario['nome'],
    'email' => $usuario['email'],
    'tipo' => $usuario['tipo']

];



unset($_SESSION['cadastro']);

header("Location: home.php");
exit;