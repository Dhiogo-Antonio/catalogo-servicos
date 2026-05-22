<?php

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/models/CategoriaModel.php";

class CategoriaController {

    private $categoriaModel;

    public function __construct($pdo) {

        $this->categoriaModel = new CategoriaModel($pdo);
    }

    public function listar() {

        return $this->categoriaModel->listar();
    }

    public function buscarPorId($id) {

        return $this->categoriaModel->buscarPorId($id);
    }
}