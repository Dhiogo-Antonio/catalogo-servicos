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
}