<?php
require_once "C:\Turma2\xampp\htdocs\catalogo-servicos\backend\app\models\UsuarioModel.php";
class UsuarioController {
    private $usuarioModel;
   
    public function __construct($pdo) {
        $this->usuarioModel = new UsuarioModel($pdo);

    }
    public function listar() {
        $usuarios = $this->usuarioModel->buscarTodos();
        include_once "C:\Turma2\xampp\htdocs\catalogo-servicos\backend\app\view\Usuario\listar.php";
        return;
    }

    public function buscarUsuario($id){
        $usuario = $this->usuarioModel->buscarUsuario($id);
        return $usuario;
    }

    public function cadastrar($nome, $email, $senha, $telefone){
        $this->usuarioModel->cadastrar($nome, $email, $senha, $telefone);
    }
    
    public function editar($nome,$email, $senha, $telefone, $id){
        $this->usuarioModel->editar($nome, $email, $senha, $telefone, $id);

    }

    public function deletar($id){
        $usuario = $this->usuarioModel->deletar($id);
        return $usuario;
    }

}

