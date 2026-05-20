<?php

class ServicoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT s.*, c.nome AS categoria FROM servicos s LEFT JOIN categorias c ON s.categoria_id = c.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarServico($id){
        $stmt = $this->pdo->prepare("SELECT * FROM servicos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome_servico, $descricao, $preco, $categoria_id, $prazo, $disponibilidade, $avaliacao, $localizacao){
        $stmt = $this->pdo->prepare("INSERT INTO servicos (nome, descricao, preco, categoria_id, prazo, disponibilidade, avaliacao, localizacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome_servico, $descricao, $preco, $categoria_id, $prazo, $disponibilidade, $avaliacao, $localizacao]);
    }

    public function editar($nome_servico, $descricao, $preco, $prazo, $disponibilidade, $avaliacao, $localizacao, $id){
        $stmt = $this->pdo->prepare("UPDATE servicos SET nome = ?, descricao = ?, preco = ?, prazo = ?, disponibilidade = ?, avaliacao = ?, localizacao = ? WHERE id = ?");
        $stmt->execute([$nome_servico, $descricao, $preco, $prazo, $disponibilidade, $avaliacao, $localizacao, $id]);
    }

    public function deletar($id){
        $stmt = $this->pdo->prepare("DELETE FROM servicos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
