<?php
require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/models/UsuarioModel.php";
class UsuarioController {
    private $usuarioModel;
   
    public function __construct($pdo) {
        $this->usuarioModel = new UsuarioModel($pdo);

    }
    public function listar() {
        $usuarios = $this->usuarioModel->buscarTodos();
        include_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/view/Usuario/listar.php";
        return;
    }

    public function listarServicosDoPerfil($usuarioId, $tipo, $servicoController, $contratacaoController)
{
    if ($tipo === 'prestador') {
        return $servicoController->listarPorPrestador($usuarioId);
    }

    
    return $contratacaoController->listarPorCliente($usuarioId);
}

    public function buscarUsuario($id){
        $usuario = $this->usuarioModel->buscarUsuario($id);
        return $usuario;
    }

    public function cadastrar($nome, $email, $senha, $telefone, $tipo){
        $this->usuarioModel->cadastrar($nome, $email, $senha, $telefone, $tipo);
    }
    
    public function editar($nome,$email, $senha, $telefone, $id){
        $this->usuarioModel->editar($nome, $email, $senha, $telefone, $id);

    }

    public function deletar($id){
        $usuario = $this->usuarioModel->deletar($id);
        return $usuario;
    }

    public function login($email, $senha){

    $usuario = $this->usuarioModel->buscarPorEmail($email);

    if($usuario){

        if($senha == $usuario['senha']){

            return $usuario;

        }

    }

    return false;

}

public function alterarFoto($foto, $id){

    return $this->usuarioModel->alterarFoto(
        $foto,
        $id
    );
}

public function alterarSenha($senha, $id){

    return $this->usuarioModel->alterarSenha(
        $senha,
        $id
    );
}

}

