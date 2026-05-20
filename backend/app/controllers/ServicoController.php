<?php

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/models/ServicoModel.php";

class ServicoController {

    private $servicoModel;

    public function __construct($pdo) {
        $this->servicoModel = new ServicoModel($pdo);
    }

    public function listar() {
        return $this->servicoModel->listar();
    }

    public function listarPorUsuario($usuarioId) {
        return $this->servicoModel->listarPorUsuario($usuarioId);
    }

    public function buscarPorId($id) {
        return $this->servicoModel->buscarPorId($id);
    }

    public function criar(
        $usuarioId,
        $categoriaId,
        $nomeServico,
        $descricao,
        $preco,
        $prazo,
        $imagem = null,
        $localizacao = null
    ) {
        return $this->servicoModel->criar(
            $usuarioId,
            $categoriaId,
            $nomeServico,
            $descricao,
            $preco,
            $prazo,
            $imagem,
            $localizacao
        );
    }

    public function editar(
        $id,
        $categoriaId,
        $nomeServico,
        $descricao,
        $preco,
        $prazo
    ) {
        return $this->servicoModel->editar(
            $id,
            $categoriaId,
            $nomeServico,
            $descricao,
            $preco,
            $prazo
        );
    }

    public function deletar($id) {
        return $this->servicoModel->deletar($id);
    }
}