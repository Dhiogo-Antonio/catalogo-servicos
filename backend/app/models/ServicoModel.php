<?php

class ServicoModel {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // LISTAR TODOS (HOME)
    public function listar(){

        $sql = "SELECT 
                    s.*,
                    u.nome AS prestador,
                    c.nome AS categoria
                FROM servicos s
                INNER JOIN usuarios u ON u.id = s.usuario_id
                INNER JOIN categorias c ON c.id = s.categoria_id
                ORDER BY s.id DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // LISTAR SERVIÇOS DO USUÁRIO LOGADO (PRESTADOR)
    public function listarPorUsuario($usuarioId){

        $sql = "SELECT 
                    s.*,
                    c.nome AS categoria
                FROM servicos s
                INNER JOIN categorias c ON c.id = s.categoria_id
                WHERE s.usuario_id = ?
                ORDER BY s.id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuarioId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BUSCAR POR ID
    public function buscarPorId($id){

        $sql = "SELECT 
                    s.*,
                    u.nome AS prestador,
                    c.nome AS categoria
                FROM servicos s
                INNER JOIN usuarios u ON u.id = s.usuario_id
                INNER JOIN categorias c ON c.id = s.categoria_id
                WHERE s.id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CRIAR SERVIÇO
    public function criar(
        $usuarioId,
        $categoriaId,
        $nomeServico,
        $descricao,
        $preco,
        $prazo,
        $imagem = null,
        $localizacao = null
    ){

        $sql = "INSERT INTO servicos 
                (usuario_id, categoria_id, nome_servico, descricao, preco, prazo, imagem, localizacao)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $usuarioId,
            $categoriaId,
            $nomeServico,
            $descricao,
            $preco,
            $prazo,
            $imagem,
            $localizacao
        ]);
    }

    // EDITAR
    public function editar(
        $id,
        $categoriaId,
        $nomeServico,
        $descricao,
        $preco,
        $prazo
    ){

        $sql = "UPDATE servicos
                SET categoria_id = ?,
                    nome_servico = ?,
                    descricao = ?,
                    preco = ?,
                    prazo = ?
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $categoriaId,
            $nomeServico,
            $descricao,
            $preco,
            $prazo,
            $id
        ]);
    }

    // DELETAR
    public function deletar($id){

        $sql = "DELETE FROM servicos WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }
}