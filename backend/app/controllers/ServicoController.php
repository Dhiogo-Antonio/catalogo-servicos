<?php

require_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/models/ServicoModel.php";

class ServicoController {
    private $servicoModel;

    public function __construct($pdo) {
        $this->servicoModel = new ServicoModel($pdo);
    }

    public function listar() {
        return $this->servicoModel->listar();
        include_once "C:/Turma2/xampp/htdocs/catalogo-servicos/backend/app/view/Servicos/listar.php";
        return;
    }

    public function buscarServico($id){
        $servico = $this->servicoModel->buscarServico($id);
        return $servico;
    }

    public function cadastrar($nome_servico, $descricao, $preco, $categoria_id, $prazo, $disponibilidade, $avaliacao, $localizacao){
        $this->servicoModel->cadastrar($nome_servico, $descricao, $preco, $categoria_id, $prazo, $disponibilidade, $avaliacao, $localizacao);
    }

    public function editar($nome_servico, $descricao, $preco, $prazo, $disponibilidade, $avaliacao, $localizacao, $id){
        $this->servicoModel->editar($nome_servico, $descricao, $preco, $prazo, $disponibilidade, $avaliacao, $localizacao, $id);
    }

    public function deletar($id){
        $servico = $this->servicoModel->deletar($id);
        return $servico;
    }
}
?>