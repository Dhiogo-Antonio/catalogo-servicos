<?php

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/models/ServicoModel.php";

class ServicoController
{

    private $servicoModel;

    public function __construct($pdo)
    {
        $this->servicoModel = new ServicoModel($pdo);
    }

    // LISTAR TODOS (HOME)
    public function listar()
    {
        return $this->servicoModel->listar();
    }

    // LISTAR POR PRESTADOR
    public function listarPorPrestador($prestadorId)
    {
        return $this->servicoModel->listarPorPrestador($prestadorId);
    }

    // BUSCAR POR ID
    public function buscarPorId($id)
    {
        return $this->servicoModel->buscarPorId($id);
    }

    // CRIAR SERVIÇO
    public function criar(
        $titulo,
        $descricaoCurta,
        $descricao,
        $preco,
        $prazo,
        $usuarioId,
        $categoriaId
    ) {
        return $this->servicoModel->criar(
            $titulo,
            $descricaoCurta,
            $descricao,
            $preco,
            $prazo,
            $usuarioId,
            $categoriaId
        );
    }

    // EDITAR SERVIÇO
    public function editar(
        $id,
        $nome_servico,
        $descricao,
        $preco,
        $prazo,
        $categoria_id

    ) {
        return $this->servicoModel->editar(
        $id,
        $nome_servico,
        $descricao,
        $preco,
        $prazo,
        $categoria_id
        );
    }

    public function deletar($id)
    {
        return $this->servicoModel->deletar($id);
    }
}
