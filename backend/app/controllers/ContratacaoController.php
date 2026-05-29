<?php

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/models/ContratacaoModel.php";

class ContratacaoController {

    private $contratacaoModel;

    public function __construct($pdo) {

        $this->contratacaoModel = new ContratacaoModel($pdo);
    }

    public function contratar($clienteId, $servicoId, $mensagem) {

        return $this->contratacaoModel->contratar(
            $clienteId,
            $servicoId,
            $mensagem
        );
    }

    public function listarParaPrestador($prestadorId)
{
    return $this->contratacaoModel
        ->listarParaPrestador($prestadorId);
}

public function atualizarStatus($id, $status)
{
    return $this->contratacaoModel
        ->atualizarStatus($id, $status);
}

public function atualizarMensagem($id, $mensagem){
    return $this->contratacaoModel->atualizarMensagem($id, $mensagem);
}

    public function listarPorCliente($clienteId) {

        return $this->contratacaoModel->listarPorCliente($clienteId);
    }

    public function contarPendentesPrestador($prestadorId)
{
    return $this->contratacaoModel
        ->contarPendentesPrestador($prestadorId);
}

public function contarPendentesCliente($clienteId)
{
    return $this->contratacaoModel
        ->contarNotificacoesCliente($clienteId);
}

public function deletar($id)
{
    return $this->contratacaoModel->deletar($id);
}
}