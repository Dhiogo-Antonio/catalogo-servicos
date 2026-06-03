<?php

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/models/ServicoModel.php";

class ServicoController
{

    private $servicoModel;

    public function __construct($pdo)
    {
        $this->servicoModel = new ServicoModel($pdo);
    }

    
    public function listar()
    {
        return $this->servicoModel->listar();
    }

    
    public function listarPorPrestador($prestadorId)
    {
        return $this->servicoModel->listarPorPrestador($prestadorId);
    }

    
    public function buscarPorId($id)
    {
        return $this->servicoModel->buscarPorId($id);
    }

    public function buscarFiltrados($q, $categoriaId)
    {
        return $this->servicoModel->buscarFiltrados($q, $categoriaId);
    }

     
     public function listarPorCategoria($categoriaId)
     {
         return $this->servicoModel->listarPorCategoria($categoriaId);
     }

    
    public function criar(
        $usuarioId,
    $categoriaId,
    $nomeServico,
    $descricao,
    $preco,
    $prazo,
    $localizacao
    ) {
        return $this->servicoModel->criar(
           $usuarioId,
    $categoriaId,
    $nomeServico,
    $descricao,
    $preco,
    $prazo,
    $localizacao
        );
    }

   
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

    public function deletarServico($id, $usuarioId)
{
    return $this->servicoModel->deletarServico(
        $id,
        $usuarioId
    );
}

    
}
