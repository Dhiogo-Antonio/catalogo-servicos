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

    public function listarPorCliente($clienteId) {

        return $this->contratacaoModel->listarPorCliente($clienteId);
    }
}