<?php

class ServicoModel {

    private $pdo;

    public function __construct($pdo){

        $this->pdo = $pdo;
    }

    public function listar(){

        $sql = "SELECT servicos.*, usuarios.nome AS prestador
                FROM servicos

                INNER JOIN usuarios
                ON usuarios.id = servicos.usuario_id";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}